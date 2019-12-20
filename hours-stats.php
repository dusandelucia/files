<?php 
	require_once '../../../core/init.php'; 
  $admin = new Admin();
  if (!$admin->isLoggedIn()) {
  Redirect::to('../admin-login.php');
  }
    	$rides = new Rides();
			for ($i=0; $i < 24; $i++) { 
        $startPoint = ($i < 10 ? '0'.$i.':00' : $i.':00');
        $endPoint = ($i < 10 ? '0'.($i+1).':00' : ($i+1).':00');
        $result = $rides->hoursStats($startPoint, $endPoint)->first()->counter;
        $results['stats'][] = $result;
      }
			echo json_encode($results);
	
 ?>