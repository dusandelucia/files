<?php 
	require_once '../../core/init.php';
	$admin = new Admin();
	$admin->logout();
	Redirect::to('admin-login.php');
 ?>