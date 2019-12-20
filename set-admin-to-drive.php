<?php
include 'admin-includes/admin-header.php';
if (!$admin->isLoggedIn()) {
    Redirect::to('admin-login.php');
}
if (Input::exists('post')) {
    $rides = new Rides();
    $rides->setStatus(Input::get('ride_id'), 'accepted');
}
?>

