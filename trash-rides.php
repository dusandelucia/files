<?php 
require_once '../../../core/init.php';
$admin = new Admin();
if (!$admin->isLoggedIn()) {
    Redirect::to('admin-login.php');
}
if (Input::exists('post') || Input::exists('get')) {
    $results['trash'] = [];
    $rides = new Rides();
    $trash = $rides->findTrash(Input::get('sort'), Input::get('order'))->results();
    foreach ($trash as $key => $value) {
        if ($value->from_to == 'from') {
            $from = 'Aiport';
            $to = $value->district . ', ' . $value->street;
        } else {
            $to = 'Aiport';
            $from = $value->district . ', ' . $value->street;
        }
        $results['trash'][] = array('id' => $value->id, 'from' => $from, 'to' => $to, 'time' => $value->flight_time, 'name' => $value->name, 'mobile' => $value->mobile, 'time_booked' => $value->time_booked, 'status' => $value->status);
    }
    $results['token'] = Token::generate();
    echo json_encode($results);
}
?>