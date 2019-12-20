<?php
include 'admin-includes/admin-header.php';
if (!$admin->isLoggedIn()) {
  Redirect::to('admin-login.php');
}
?>
<div class='maincontainer'>
  <div id="accordion">
  <h3>Nove voznje:</h3>
  <div>
  <table id="contactsTable" class="display">
      <thead>
        <tr align="left">
          <th>Od:</th>
          <th>Do:</th>
          <th class="time" data-type="unass" data-sort="rides.time" data-order="ASC">Vreme:</th>
          <th>Ime:</th>
          <th>Telefon:</th>
          <th class="time" data-type="unass" data-sort="rides.time_booked" data-order="ASC">Naruceno u:</th>
        </tr>
      </thead>
      <tbody id="new-rides">
      </tbody>
    </table>
  </div>
  <h3>Poslato vozacu:</h3>
  <div>
  <table id="contactsTable" class="display">
      <thead>
        <tr align="left">
          <th>Od:</th>
          <th>Do:</th>
          <th class="time" data-type="assigned" data-sort="rides.time" data-order="ASC">Vreme:</th>
          <th>Ime:</th>
          <th>Telefon:</th>
          <th class="time" data-type="assigned" data-sort="rides.time_booked" data-order="ASC">Naruceno u:</th>
          <th></th>
        </tr>
      </thead>
      <tbody id="assigned-rides">
      </tbody>
    </table>
  </div>
  <h3>Prihvacene voznje:</h3>
  <div>
  <table id="contactsTable" class="display">
      <thead>
        <tr align="left">
          <th>Od:</th>
          <th>Do:</th>
          <th class="time" data-type="accepted" data-sort="rides.time" data-order="ASC">Vreme:</th>
          <th>Ime:</th>
          <th>Telefon:</th>
          <th class="time" data-type="accepted" data-sort="rides.time_booked" data-order="ASC">Naruceno u:</th>
          <th></th>
        </tr>
      </thead>
      <tbody id="accepted-rides">
      </tbody>
    </table>
  </div>
  <h3>Odbijene voznje:</h3>
  <div>
  <table id="contactsTable" class="display">
      <thead>
        <tr align="left">
          <th>Od:</th>
          <th>Do:</th>
          <th class="time" data-type="declined" data-sort="rides.time" data-order="ASC">Vreme:</th>
          <th>Ime:</th>
          <th>Telefon:</th>
          <th class="time" data-type="declined" data-sort="rides.time_booked" data-order="ASC">Naruceno u:</th>
          <th></th>
        </tr>
      </thead>
      <tbody id="declined-rides">
      </tbody>
    </table>
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
  <script src="js/view-rides.js"></script>
  </body>
</html>
