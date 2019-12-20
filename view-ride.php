<?php
include 'admin-includes/admin-header.php';
if (!$admin->isLoggedIn()) {
  Redirect::to('admin-login.php');
}
if (Input::exists('post') || Input::exists('get')) {
  $rides = new Rides();
  $ride = $rides->find(Input::get('id'));
  $drivers = $rides->db()->query('SELECT * FROM drivers')->results();
  if ($ride->status == 'new-unass') {
    $rides->setStatus(Input::get('id'), 'unass');
  } elseif ($ride->status == 'new-accepted') {
    $rides->setStatus(Input::get('id'), 'accepted');
  } elseif ($ride->status == 'new-declined') {
    $rides->setStatus(Input::get('id'), 'declined');
  }
  if ($ride->from_to == 'from') {
    $from = 'Airport';
    $to = $ride->district . ', ' . $ride->street;
  } else {
    $to = 'Airport';
    $from = $ride->district . ', ' . $ride->street;
  }
  if ($ride->drivers_id != '' && $ride->admins_id != '') {
    $driver_data = $rides->db()->get('drivers', array(
      'id', '=',
      $ride->drivers_id
    ))->first();
    $admin_data = $rides->db()->get('admins', array(
      'id', '=',
      $ride->admins_id
    ))->first();
    $driverFullName = $driver_data->name . ' ' . $driver_data->last_name;
    $adminFullName = $admin_data->name . ' ' . $admin_data->last_name;
  } else {
    $driverFullName = '';
    $adminFullName = '';
  }

}
?>
  <div class='maincontainer'>
    <div id="ride">
      <div class="ride-field">Ime</div>
      <div class="ride-value"><?php echo $ride->name; ?></div>
      <div class="ride-field">Email</div>
      <div class="ride-value"><?php echo $ride->email; ?></div>
      <div class="ride-field">Telefon</div>
      <div class="ride-value"><?php echo $ride->mobile; ?></div>
      <div class="ride-field">Vreme Polaska</div>
      <div class="ride-value"><?php echo $ride->flight_time; ?></div>
      <div class="ride-field">Od</div>
      <div class="ride-value"><?php echo $from; ?></div>
      <div class="ride-field">Do</div>
      <div class="ride-value"><?php echo $to; ?></div>
      <div class="ride-field">Broj Kuce</div>
      <div class="ride-value"><?php echo $ride->street_number; ?></div>
      <div class="ride-field">Broj Leta</div>
      <div class="ride-value"><?php echo $ride->flight_number; ?></div>
      <div class="ride-field">Broj Putnika</div>
      <div class="ride-value"><?php echo $ride->number_of_people; ?></div>
      <div class="ride-field">Broj Kofera</div>
      <div class="ride-value"><?php echo $ride->suitcases; ?></div>
      <div class="ride-field">Sedista za Decu</div>
      <div class="ride-value"><?php echo $ride->child_seats; ?></div>
      <div class="ride-field">Dodeljeni Vozac</div>
      <div class="ride-value"><?php echo $driverFullName; ?></div>
      <div class="ride-field">Admin koji je dodelio</div>
      <div class="ride-value"><?php echo $adminFullName; ?></div>
      <div class="ride-field">Duzina Puta</div>
      <div class="ride-value"><?php echo $ride->distance . ' km'; ?></div>
      <div class="ride-field">Cena</div>
      <div class="ride-value"><?php echo $ride->price . ' euros'; ?></div>
      <div class="ride-field">Vreme Narucivanja</div>
      <div class="ride-value"><?php echo $ride->time_booked; ?></div>
      <div class="ride-field">Komentar</div>
      <div class="ride-value"><?php echo $ride->comment; ?></div>
      <div class="ride-buttons">
        <button id="set-driver">Izaberite Vozaca</button>
        <button id="flag-ride">Prihvati Voznju</button>
      </div>
    </div>
    <a href="view-rides.php" style="font-size: 18px; font-weight: bold; color:white; margin:auto; width: 20%; height: 70px; display: block; background-color: black; text-align: center; padding: 20px;">Vrati se nazad</a>
<!-- ////////////////////DIALOG/////////////////////////////////// -->
          <div id="dialogRide" title="Izaberi Vozaca">
              <form action="set-admin-and-driver.php" method="POST" id="formSetDriver">
                <select id="drivers" name="drivers" size="10">
        <?php foreach ($drivers as $key => $value) { ?>
                  <option value="<?php echo $value->id; ?>"><?php echo $value->name . ' ' . $value->last_name; ?></option>
        <?php 
      } ?>
                </select>
                <input type="hidden" value="<?php echo $admin->data()->id; ?>" name="admin" id="admin">
                <input type="hidden" value="<?php echo Input::get('id'); ?>" name="ride_id" id="ride_id">
                <br><br>
              </form>
            </div>
  </div> <!-- //maincontainer -->
  <script src="js/Classes/UI.js"></script>
  <script>
    $( "#dialogRide" ).dialog({
      autoOpen: false,
      width: 400,
      buttons: [
        {
          text: "Izaberi",
          click: function(e) {
            e.preventDefault();
            $.post('set-admin-and-driver.php', {
              ride_id: $('#ride_id').val(),
              drivers: $('#drivers').val(),
              admin: $('#admin').val()
            }, function(data) {
              window.location.href = 'view-rides.php';
            });
          }
        },
        {
          text: "Otkazi",
          click: function() {
            $( this ).dialog( "close" );
          }
        }
      ]
    });
    $('#set-driver').click(function(event) {
      $( "#dialogRide" ).dialog( "open" );
          event.preventDefault();
    });
    $('#flag-ride').on('click', function(){
      $.post('set-admin-to-drive.php', {
        ride_id: $('#ride_id').val()
      }, function(data) {
        window.location.href = 'view-rides.php';
      });
    });
  </script>
<?php
include 'admin-includes/admin-footer.php';
?>

