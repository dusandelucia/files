<?php
include 'admin-includes/admin-header.php';
if (!$admin->isLoggedIn()) {
  Redirect::to('admin-login.php');
}
?>
<div style="width:95%" class='maincontainer'>
  <h3 style="color:white">OBRISANE VOZNJE</h3>
  <table id="contactsTable" class="display">
      <thead>
        <tr align="left">
          <th>Od:</th>
          <th>Do:</th>
          <th class="time" data-sort="rides.time" data-order="ASC">Vreme:</th>
          <th>Ime:</th>
          <th>Telefon:</th>
          <th class="time" data-sort="rides.time_booked" data-order="ASC">Naruceno u:</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody id="trash-rides">
      </tbody>
    </table>
</div>
    <p id="message"></p>
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" id="token">
  </div> <!-- //maincontainer -->
  <script src="js/Classes/UI.js"></script>
  <script src="js/trash.js"></script>
  <?php
  include 'admin-includes/admin-footer.php';
  ?>
