<?php
include 'admin-includes/admin-header.php';
if (!$admin->superAdmin()) {
  Redirect::to('admin-login.php');
}
?>
  <div class='maincontainer'>
  <h1>Postavi novog admina:</h1>
  <form class="" action="" method="post">

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
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" id="token">
    <input type="submit" class="btn btn-success" value="Postavite admina">
    <p id="message"></p>
  </form>
  </div> <!-- //maincontainer -->
  <script>
    $(document).ready(function(){
      $('input[type="submit"]').click(function(event) {
        $("#message").empty();
        event.preventDefault();
        $.post('ajax/admins-operations.php', {
          operation: "register",
          username: $("#username").val(),
          password: $("#password").val(),
          password_again: $("#password_again").val(),
          name: $("#name").val(),
          last_name: $("#last_name").val(),
          email: $("#email").val(),
          mobile: $("#mobile").val(),
          token: $("#token").val()
        }, function(data) {
            $("#message").append(data);
            if ($("#message").text()=="You created a new Admin") {
              setTimeout(function(){ window.location = "admin.php"; }, 3000);
            }
        });
      });
    });
  </script>
<?php
  include 'admin-includes/admin-footer.php';
?>
