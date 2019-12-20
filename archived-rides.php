<?php 
require_once '../../../core/init.php';
$admin = new Admin();
if (!$admin->isLoggedIn()) {
    Redirect::to('admin-login.php');
}
if (Input::exists('post') || Input::exists('get')) {
    $results['successful'] = [];
    $results['failed'] = [];
    $rides = new Rides();
    $successful = $rides->findNew('successful', Input::get('sortSuccessful'), Input::get('orderSuccessful'))->results();
    $failed = $rides->findNew('failed', Input::get('sortFailed'), Input::get('orderFailed'))->results();
    foreach ($successful as $key => $value) {
        if ($value->from_to == 'from') {
            $from = 'Aiport';
            $to = $value->district . ', ' . $value->street;
        } else {
            $to = 'Aiport';
            $from = $value->district . ', ' . $value->street;
        }
        $results['successful'][] = array('id' => $value->id, 'from' => $from, 'to' => $to, 'time' => $value->flight_time, 'name' => $value->name, 'mobile' => $value->mobile, 'time_booked' => $value->time_booked, 'status' => $value->status);
    }
    foreach ($failed as $key => $value) {
        if ($value->from_to == 'from') {
            $from = 'Aiport';
            $to = $value->district . ', ' . $value->street;
        } else {
            $to = 'Aiport';
            $from = $value->district . ', ' . $value->street;
        }
        $results['failed'][] = array('id' => $value->id, 'from' => $from, 'to' => $to, 'time' => $value->flight_time, 'name' => $value->name, 'mobile' => $value->mobile, 'time_booked' => $value->time_booked, 'status' => $value->status);
    }
    $results['token'] = Token::generate();
    echo json_encode($results);
}
?>