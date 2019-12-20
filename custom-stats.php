<?php
require_once '../../../core/init.php';
$admin = new Admin();
if (!$admin->isLoggedIn()) {
    Redirect::to('admin-login.php');
}
if (Input::exists('post') || Input::exists('get')) {
    $start = Input::get('start');
    $end = Input::get('end');
    $driver = Input::get('driver');
    $ride = new Rides();
    $rides = $ride->customStats($start, $end, $driver)->results();
    $results['info'] = $rides;
    $results['token'] = Token::generate();
    echo json_encode($results);
}
?>