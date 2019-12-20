<?php 
require_once '../../../core/init.php';
$admin = new Admin();
if (!$admin->isLoggedIn()) {
    Redirect::to('../admin-login.php');
}
$ride = new Rides();
for ($i = 1; $i < 7; $i++) {
    $start = date("Y-m-1 00:00", strtotime("-" . $i . " month"));
    $end = date("Y-m-t 23:59", strtotime("-" . $i . " month"));
    $month = date("m", strtotime("-" . $i . " month"));
    $monthName = date('F', mktime(0, 0, 0, $month, 10));
    $stats = $ride->monthStats($start, $end)->first()->counter;
    $result['stats'][] = $stats;
    $result['month'][] = $monthName;
}
$currentMonthStart = date("Y-m-1 00:00");
$currentMonthEnd = date("Y-m-t 23:59");
$currentMonth = $ride->monthStats($currentMonthStart, $currentMonthEnd)->first()->counter;
$m = date("m");
$currentMonthName = date('F', mktime(0, 0, 0, $m, 10));
$result['current']['currentMonth'] = $currentMonthName;
$result['current']['currentMonthRides'] = $currentMonth;
$todayStart = date("Y-m-d 00:00");
$todayEnd = date("Y-m-d 23:59");
$today = $ride->monthStats($todayStart, $todayEnd)->first()->counter;
$result['current']['todayRides'] = $today;
echo json_encode($result);
?>