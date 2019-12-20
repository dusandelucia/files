<?php
include 'admin-includes/admin-header.php';
if (!$admin->isLoggedIn()) {
  Redirect::to('admin-login.php');
}
?>
  <div class='maincontainer'>
  <table id="contactsTable" class="display">
    <thead>
      <tr align="left">
        <th>Korisnicko ime:</th>
        <th>Ime:</th>
        <th>Prezime:</th>
        <th>Email:</th>
        <th>Telefon:</th>
        <th>Pristupio:</th>
        <?php if ($admin->superAdmin()) { ?>
          <th>Izmeni:</th>
         <th>Obrisi:</th>
        <?php
      } ?>
      </tr>
    </thead>
    <tbody id="admins">
     <tr>
       <?php if ($admin->superAdmin()) { ?>
       <td colspan="8" style="background-color: #080808;"><a href="admin-register.php">Dodaj novog admina</a></td>
     <?php
  } ?>
     </tr>
    </tbody>
  </table>
  <p id="message"></p>
<!--   ///////////////////DIALOGS START//////////////////////// -->
<input type="hidden" name="token" value="<?php echo Token::generate(); ?>" id="token">
<div id="dialogUpdateAdmin" title="Update Admin"><!-- UPDATE NEW ADMIN DIALOG -->
  <form class="" action="" method="post">
    <p id="updateMessage"></p>
    <div class="field form-group">
      <label for="username">Korisnicko ime:</label>
      <input type="text" class="form-control" name="currentUsername" value="" id="currentUsername" autocomplete="off" readonly>
    </div>

    <div class="field form-group">
      <label for="updateUsername">Novo korisnicko ime:</label>
      <input type="text" class="form-control" name="updateUsername" value="" id="updateUsername" autocomplete="off">
    </div>

    <div class="field form-group">
      <label for="oldPassword">Trenutna sifra:</label>
      <input type="password" class="form-control" name="oldPassword" value="" id="oldPassword" autocomplete="off">
    </div>

    <div class="field form-group">
      <label for="newPassword">Nova sifra:</label>
      <input type="password" class="form-control" name="newPassword" value="" id="newPassword" autocomplete="off">
    </div>

    <div class="field form-group">
      <label for="newPassword_again">Ponovite novu sifru:</label>
      <input type="password" class="form-control" name="newPassword_again" value="" id="newPassword_again" autocomplete="off">
    </div>

    <div class="field form-group">
      <label for="updateName">Ime:</label>
      <input type="text" class="form-control" name="updateName" value="" id="updateName" autocomplete="off">
    </div>

    <div class="field form-group">
      <label for="updateLast_name">Prezime:</label>
      <input type="text" class="form-control" name="updateLast_name" value="" id="updateLast_name" autocomplete="off">
    </div>

    <div class="field form-group">
      <label for="updateEmail">Email:</label>
      <input type="email" class="form-control" name="updateEmail" value="" id="updateEmail" autocomplete="off">
    </div>

    <div class="field form-group">
      <label for="updateMobile">Telefon:</label>
      <input type="text" class="form-control" name="updateMobile" value="" id="updateMobile" autocomplete="off">
    </div>
    <input type="hidden" name="id" value="" id="id">
  </form>
</div><!-- UPDATE ADMIN DIALOG END-->
<!-- ////////////DIALOGS END///////////////////// -->
  </div> <!-- //maincontainer -->
  <script src="js/Classes/UI.js"></script>
  <script>
    $(document).ready(function() {
      var x = "<?php echo ($admin->superAdmin()) ? 'delete' : 'not'; ?>";
      var token = "<?php echo Token::generate(); ?>";
      getAdmins(token, x);
    });
  </script>
<?php
include 'admin-includes/admin-footer.php';
?>
