<?php 
require_once '../../../core/init.php';
$admin = new Admin();
if (!$admin->isLoggedIn()) {
    Redirect::to('admin-login.php');
}
$rides = new Rides();
$rides->checkSuccessfulRides();
$rides->checkFailedRides();
?>