<?php
include 'admin-includes/admin-header.php';
if (!$admin->isLoggedIn()) {
  Redirect::to('admin-login.php');
}
?>
  <div class='maincontainer'>
  <p id="success"></p>
  <table id="contactsTable" class="display">
    <thead>
      <tr align="left">
        <th>Korisnicko ime:</th>
        <th>Ime:</th>
        <th>Prezime:</th>
        <th>Email:</th>
        <th>Telefon:</th>
        <th>Ubacen u sistem:</th>
        <?php if ($admin->superAdmin()) { ?>
          <th>Izmeni:</th>
         <th>Obrisi:</th>
        <?php
      } ?>
      </tr>
    </thead>
    <tbody id="drivers">
     <tr>
       <?php if ($admin->superAdmin()) { ?>
       <td id="btnCreateDriver" colspan="8" style="background-color: #080808;"><a href="">Dodaj novog vozaca</a></td>
     <?php
  } ?>
     </tr>
    </tbody>
  </table>
  </div> <!-- //maincontainer -->

<!--   ////////////////////////   DIALOGS    /////////////////////////////////////-->
  <div id="dialogRegisterDriver" title="Dodaj vozaca"><!-- CREATE NEW DRIVER DIALOG -->
    <form class="" action="" method="post">
      <p id="message"></p>

      <div class="field form-group">
        <label for="username">Korisnicko ime:</label>
        <input type="text" class="form-control" name="username" value="" id="username" autocomplete="off">
      </div>

      <div class="field form-group">
        <label for="password">Izaberite sifru:</label>
        <input type="password" class="form-control" name="password" value="" id="password" autocomplete="off">
      </div>

      <div class="field form-group">
        <label for="password_again">Ponovite sifru:</label>
        <input type="password" class="form-control" name="password_again" value="" id="password_again" autocomplete="off">
      </div>

      <div class="field form-group">
        <label for="name">Ime:</label>
        <input type="text" class="form-control" name="name" value="" id="name" autocomplete="off">
      </div>

      <div class="field form-group">
        <label for="last_name">Prezime:</label>
        <input type="text" class="form-control" name="last_name" value="" id="last_name" autocomplete="off">
      </div>

      <div class="field form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" value="" id="email" autocomplete="off">
      </div>

      <div class="field form-group">
        <label for="mobile">Telefon:</label>
        <input type="text" class="form-control" name="mobile" value="" id="mobile" autocomplete="off">
      </div>
    </form>
  </div><!-- CCREATE DRIVER DIALOG END-->
  <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" id="token">
  <div id="dialogUpdateDriver" title="Izmeni vozaca:"><!-- UPDATE NEW DRIVER DIALOG -->
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
  </div><!-- UPDATE DRIVER DIALOG END-->
<!--   /////////////////////  DIALOGS END ////////////////////////////// -->
<script src="js/Classes/UI.js"></script>
  <script>
    //////GETING ALL DRIVERS/////////////////
      var x = "<?php echo ($admin->superAdmin()) ? 'delete' : 'not'; ?>";
      var token = "<?php echo Token::generate(); ?>";
      getDrivers(token, x);
  </script>
<?php
include 'admin-includes/admin-footer.php';
?>
