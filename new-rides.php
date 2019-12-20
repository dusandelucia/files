<?php 
require_once '../../../core/init.php';
$admin = new Admin();
if (!$admin->isLoggedIn()) {
	Redirect::to('admin-login.php');
}
if (Input::exists('post') || Input::exists('get')) {
	$results['unassigned'] = [];
	$results['assigned'] = [];
	$results['accepted'] = [];
	$results['declined'] = [];
	$rides = new Rides();
	$unassigned = $rides->findNew('unass', Input::get('sortUnass'), Input::get('orderUnass'))->results();
	$assigned = $rides->findNew('assigned', Input::get('sortAssigned'), Input::get('orderAssigned'))->results();
	$accepted = $rides->findNew('accepted', Input::get('sortAccepted'), Input::get('orderAccepted'))->results();
	$declined = $rides->findNew('declined', Input::get('sortDeclined'), Input::get('orderDeclined'))->results();
	foreach ($unassigned as $key => $value) {
		if ($value->from_to == 'from') {
			$from = 'Aiport';
			$to = $value->district . ', ' . $value->street;
		} else {
			$to = 'Aiport';
			$from = $value->district . ', ' . $value->street;
		}
		$results['unassigned'][] = array('id' => $value->id, 'from' => $from, 'to' => $to, 'time' => $value->flight_time, 'name' => $value->name, 'mobile' => $value->mobile, 'time_booked' => $value->time_booked, 'status' => $value->status);
	}
	foreach ($assigned as $key => $value) {
		if ($value->from_to == 'from') {
			$from = 'Aiport';
			$to = $value->district . ', ' . $value->street;
		} else {
			$to = 'Aiport';
			$from = $value->district . ', ' . $value->street;
		}
		$results['assigned'][] = array('id' => $value->id, 'from' => $from, 'to' => $to, 'time' => $value->flight_time, 'name' => $value->name, 'mobile' => $value->mobile, 'time_booked' => $value->time_booked, 'status' => $value->status);
	}
	foreach ($accepted as $key => $value) {
		if ($value->from_to == 'from') {
			$from = 'Aiport';
			$to = $value->district . ', ' . $value->street;
		} else {
			$to = 'Aiport';
			$from = $value->district . ', ' . $value->street;
		}
		$results['accepted'][] = array('id' => $value->id, 'from' => $from, 'to' => $to, 'time' => $value->flight_time, 'name' => $value->name, 'mobile' => $value->mobile, 'time_booked' => $value->time_booked, 'status' => $value->status);
	}
	foreach ($declined as $key => $value) {
		if ($value->from_to == 'from') {
			$from = 'Aiport';
			$to = $value->district . ', ' . $value->street;
		} else {
			$to = 'Aiport';
			$from = $value->district . ', ' . $value->street;
		}
		$results['declined'][] = array('id' => $value->id, 'from' => $from, 'to' => $to, 'time' => $value->flight_time, 'name' => $value->name, 'mobile' => $value->mobile, 'time_booked' => $value->time_booked, 'status' => $value->status);
	}
	$results['token'] = Token::generate();
	echo json_encode($results);
}
?>