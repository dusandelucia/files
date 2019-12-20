<?php
include 'admin-includes/admin-header.php';
?>
  <div class='login-form'>
  <form class="" action="" method="post">

    <div class="field form-group">
      <label for="username">Korisnik:</label>
      <input type="text" class="form-control" name="username" value="" id="username" autocomplete="off" autofocus>
    </div>

    <div class="field form-group">
      <label for="password">Sifra:</label>
      <input type="password" class="form-control" name="password" value="" id="password" autocomplete="off">
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" id="token">
    <input type="submit" class="btn btn-success" value="Login">
    <p id="message"></p>
  </form>
  </div> <!-- //maincontainer -->
  <script>
    $(document).ready(function(){
      $('input[type="submit"]').click(function(event) {
        $("#message").empty();
        event.preventDefault();
        $.post('ajax/admins-operations.php', {
          operation: "login",
          username: $("#username").val(),
          password: $("#password").val(),
          token: $("#token").val()
        }, function(data) {
            $("#message").append(data);
            if ($("#message").text()=="Welcome Admin") {
              setTimeout(function(){ window.location = "view-rides.php"; }, 3000);
            }else{
              $("#password").val("");
            }
        });
      });
    });
  </script>
<?php
include 'admin-includes/admin-footer.php';
?>
