<?php
include 'admin-includes/admin-header.php';
if (!$admin->isLoggedIn()) {
    Redirect::to('admin-login.php');
}
?>
<div class='maincontainer'>
  <div id="accordion">
  <h3 style="background:#4ca44c;color:white;">Uspesne Voznje:</h3>
  <div>
  <table id="contactsTable" class="display">
      <thead>
        <tr align="left">
          <th>Od:</th>
          <th>Do:</th>
          <th class="time" data-type="successful" data-sort="rides.time" data-order="ASC">Vreme:</th>
          <th>Ime:</th>
          <th>Telefon:</th>
          <th class="time" data-type="successful" data-sort="rides.time_booked" data-order="ASC">Naruceno u:</th>
          <th></th>
        </tr>
      </thead>
      <tbody id="successful-rides">
      </tbody>
    </table>
  </div>
  <h3 style="background:red;color:white;">Neuspesne Voznje:</h3>
  <div>
  <table id="contactsTable" class="display">
      <thead>
        <tr align="left">
          <th>Od:</th>
          <th>Do:</th>
          <th class="time" data-type="failed" data-sort="rides.time" data-order="ASC">Vreme:</th>
          <th>Ime:</th>
          <th>Telefon:</th>
          <th class="time" data-type="failed" data-sort="rides.time_booked" data-order="ASC">Naruceno u:</th>
          <th></th>
        </tr>
      </thead>
      <tbody id="failed-rides">
      </tbody>
    </table>
  </div>
  <h3 style="background:white;color:black;">Pronadji Voznje:</h3>
  <div>
  
  </div>
</div>
    <p id="message"></p>
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" id="token">
  </div> <!-- //maincontainer -->
  <script>
  $( function() {
    $( "#accordion" ).accordion({
      heightStyle: "content",
      active: false,
      collapsible: true
    });
  } );
  </script>
  <script src="js/Classes/UI.js"></script>
  <script src="js/archive.js"></script>
  <?php
    include 'admin-includes/admin-footer.php';
    ?>
