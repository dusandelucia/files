<?php
require_once '../../core/init.php';
$admin = new Admin();
if (!$admin->isLoggedIn()) {
    Redirect::to('admin-login.php');
}
?>
<!DOCTYPE html>
<html>
  <head><meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Taxi</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../../css/jquery-ui.css">
    <link rel="stylesheet" href="css/admin-styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/bootstrap-datetimepicker.min.css">
    <script src="../../js/jquery.js"></script>
    <script src="../../js/jquery-ui.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
    <script>
      $(document).ready(function($){
          var fullpath = window.location.pathname;
          var str = fullpath.split('/');
          var url = str[str.length - 1];
          $('.nav li a[href="'+url+'"]').parent().addClass('active');
      });
    </script>
    <style>
        #ui-id-2 {
            position: relative;
            background-color: white;
            color: black;
            font-weight: bold;
            font-size: 26px;
        }
        .ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active, a.ui-button:active, .ui-button:active, .ui-button.ui-state-active:hover {
            border: 3px solid #3277b2;
            border-bottom-width: 4px;
            background: none;
            font-weight: normal;
            color: #ffffff;
        }
        .ui-tabs .ui-tabs-panel{
            background:black;
        }
        .datetimepicker td, .datetimepicker th{
            color:black;
        }
        th{
            background-color:#3277b2;
        }
        .ion-ios-arrow-thin-right::before {
            content: ">";
            font-weight:900;
            font-size:25px;
        }
        .ion-ios-arrow-thin-left::before {
            content: "<";
            font-weight:900;
            font-size:25px;
        }
        #bookTo,
        #bookFrom{
            margin-top:15px;
        }
        .form-control{
            padding:0;
        }
    </style>
  </head>
  <body>

    <div class="container">
    <div class="row">

      <?php if ($admin->isLoggedIn()) { ?>
      <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="admin.php"><i class="fas fa-warehouse"></i></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="view-admins.php"><i class="fas fa-user"></i></a></li>
            <li><a href="view-drivers.php"><i class="fas fa-taxi"></i></a></li>
            <li><a href="address.php"><i class="fas fa-location-arrow"></i></a></li>
            <li><a href="archive.php"><i class="fas fa-archive"></i></a></li>
            <li><a href="view-rides.php"><i class="fas fa-plane-departure"></i></a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="create-ride.php"><i class="fas fa-plus"></i></a></li>
            <li><a href="trash.php"><i class="fas fa-trash"></i></a></li>
            <li><a href="admin-logout.php"><i class="fas fa-sign-out-alt"></i></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <?php 
} ?>
<div class='maincontainer'>
    <div id="tabs">
        <ul>
            <li><a href="#tabs-1">Do Aerodroma</a></li>
            <li><a href="#tabs-2">Od Aerodroma</a></li>
        </ul>
        <div id="tabs-1">
            <div class="col-md-6 col-xs-12 form-group">
                <label for="nameTo">Ime i Prezime</label>
                <input type="text" name="nameTo" id="nameTo" class="form-control" placeholder="Ime i Prezime">
            </div>
            <div class="col-md-6 col-xs-12 form-group">
                <label for="mobileTo">Telefon</label>
                <input type="text" name="mobileTo" id="mobileTo" class="form-control" placeholder="Telefon">
            </div>
            <div class="col-md-6 col-xs-12 form-group">
                <label for="emailTo">Email</label>
                <input type="text" name="emailTo" id="emailTo" class="form-control" placeholder="Email" value="narucenoPrekoTelefona@gmail.com">
            </div>
            <div class="col-md-6 col-xs-12 form-group">
                <label for="datetimeTo">Datum i Vreme</label>
                <input size="16" type="text" class="datetime form-control" id="datetimeTo" autocomplete="off" placeholder="Datum i Vreme">
            </div>
            <div class="col-md-6 col-xs-12 form-group">
                <label for="ortTo">Grad</label>
                <select name="ortTo" id="ortTo" class="form-control"></select>
            </div>
            <div class="col-md-6 col-xs-12 form-group">
                <label for="dustrictTo">Opstina</label>
                <select name="plzTo" id="plzTo" class="form-control"></select>
            </div>
            <div class="col-md-6 col-xs-12 form-group">
                <label for="exampleInputPassword1">Ulica</label>
                <select name="streetTo" id="streetTo" class="form-control"></select>
            </div>
            <div class="col-md-6 col-xs-12 form-group">
                <label for="hausnummerTo">Broj Kuce</label>
                <input type="text" name="hausnummerTo" id="hausnummerTo" class="form-control" placeholder="Broj Kuce">
            </div>
            <div class="col-md-4 col-xs-12 form-group">
                <label for="numOffPassengersTo">Broj Putnika</label>
                <input type="number" id="numOffPassengersTo" min="1" max="8" class="form-control" placeholder="Broj Putnika">
            </div>
            <div class="col-md-4 col-xs-12 form-group">
                <label for="suitcasesTo">Broj Kofera</label>
                <input type="number" id="suitcasesTo" min="0" max="4" class="form-control" placeholder="Broj Kofera">
            </div>
            <div class="col-md-4 col-xs-12 form-group">
                <label for="childSeatsTo">Sedista za decu</label>
                <input type="number" id="childSeatsTo" min="0" max="4" class="form-control" placeholder="Sedista za decu">
            </div>
            <label for="commentTo">Komentar</label>
            <textarea id="commentTo" style="width:70%;" class="form-control" placeholder="Komentar"></textarea>
            <button id="bookTo" class="btn btn-primary">Upisi Voznju</button>
            </div>
        <div id="tabs-2">
            <div class="col-md-6 col-xs-12 form-group">
                <label for="nameFrom">Ime i Prezime</label>
                <input type="text" name="nameFrom" id="nameFrom" class="form-control" placeholder="Ime i Prezime">
            </div>
            <div class="col-md-6 col-xs-12 form-group">
                <label for="mobileFrom">Telefon</label>
                <input type="text" name="mobileFrom" id="mobileFrom" class="form-control" placeholder="Telefon">
            </div>
            <div class="col-md-6 col-xs-12 form-group">
                <label for="emailFrom">Email</label>
                <input type="text" name="emailFrom" id="emailFrom" class="form-control" placeholder="Email">
            </div>
            <div class="col-md-3 col-xs-12 form-group">
                <label for="datetimeFrom">Datum i Vreme</label>
                <input size="16" type="text" class="datetime form-control" id="datetimeFrom" autocomplete="off" placeholder="Datum i Vreme">
            </div>
            <div class="col-md-3 col-xs-12 form-group">
                <label for="flightNumberFrom">Broj i ime leta</label>
                <input type="text" name="flightNumberFrom" id="flightNumFrom" class="form-control" placeholder="Broj i ime leta">
            </div>
            <div class="col-md-6 col-xs-12 form-group">
                <label for="ortFrom">Grad</label>
                <select name="ortFrom" id="ortFrom" class="form-control"></select>
            </div>
            <div class="col-md-6 col-xs-12 form-group">
                <label for="dustrictFrom">Opstina</label>
                <select name="plzFrom" id="plzFrom" class="form-control"></select>
            </div>
            <div class="col-md-6 col-xs-12 form-group">
                <label for="exampleInputPassword1">Ulica</label>
                <select name="streetFrom" id="streetFrom" class="form-control"></select>
            </div>
            <div class="col-md-6 col-xs-12 form-group">
                <label for="hausnummerFrom">Broj Kuce</label>
                <input type="text" name="hausnummerFrom" id="hausnummerFrom" class="form-control" placeholder="Broj Kuce">
            </div>
            <div class="col-md-4 col-xs-12 form-group">
                <label for="numOffPassengersFrom">Broj Putnika</label>
                <input type="number" id="numOffPassengersFrom" min="1" max="8" class="form-control" placeholder="Broj Putnika">
            </div>
            <div class="col-md-4 col-xs-12 form-group">
                <label for="suitcasesFrom">Broj Kofera</label>
                <input type="number" id="suitcasesFrom" min="0" max="4" class="form-control" placeholder="Broj Kofera">
            </div>
            <div class="col-md-4 col-xs-12 form-group">
                <label for="childSeatsFrom">Sedista za decu</label>
                <input type="number" id="childSeatsFrom" min="0" max="4" class="form-control" placeholder="Sedista za decu">
            </div>
            <label for="commentFrom">Komentar</label>
            <textarea id="commentFrom" style="width:70%;" class="form-control" placeholder="Komentar"></textarea>
            <button id="bookFrom" class="btn btn-primary">Upisi Voznju</button>
            </div>
        </div>
        <div id="ride-info">
            <div class="col-md-12 col-sm-4 col-xs-4">
                <div class="time">
                    <div class="col-sm-6 col-xs-12">Ungefähre Zeit: </div>
                    <div class="col-sm-6 col-xs-12"><strong class="dur"></strong></div>
                </div>
            </div>
            <div class="col-md-12 col-sm-4 col-xs-4">
                <div class="distance">
                    <div class="col-sm-6 col-xs-12">Entfernung: </div>
                    <div class="col-sm-6 col-xs-12"><strong class="dist"></strong></div>
                </div>
            </div>
            <div class="col-md-12 col-sm-4 col-xs-4">
                <div class="ride-price">
                    <div class="col-sm-6 col-xs-12">Preis: </div>
                    <div class="col-sm-6 col-xs-12"><span><strong class="ride-pr"></strong><strong> euros</strong></span></div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- //maincontainer -->
<script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
</script>
<script type="text/javascript" src="../../js/bootstrap-datetimepicker.js"></script>
<script src="js/Classes/Validation.js"></script>
<script src="js/Classes/UI.js"></script>
<script src="js/streets.js"></script>
<script src="js/map.js"></script>
<script src="js/create-ride.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlv5bPQPltMXnSlkuGkamekXb7fa0vyx8&callback=initMap"></script>
<?php
include 'admin-includes/admin-footer.php';
?>
