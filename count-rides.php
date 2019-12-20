<?php 
require_once '../../../core/init.php';
$admin = new Admin();
if (!$admin->isLoggedIn()) {
    Redirect::to('admin-login.php');
}
$rides = new Rides();
$unass = $rides->countRide('new-unass')->first();
$accepted = $rides->countRide('new-accepted')->first();
$declined = $rides->countRide('new-declined')->first();
$results['unass'] = $unass;
$results['accepted'] = $accepted;
$results['declined'] = $declined;
echo json_encode($results);
?>