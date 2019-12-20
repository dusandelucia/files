<?php
	require_once '../../../core/init.php'; 
	if (Input::exists('post') || Input::exists('get')) {
	    if (Token::check(Input::get('token'))) {
	    	switch (Input::get('data')) {
	    		case 'admins':
	    			$db = DB::getInstance();
					$admins['admins'] = $db->query('SELECT * FROM admins WHERE username != "'.Config::get("superAdmin").'" ')->results();
					$admins['token'] = Token::generate();
					echo json_encode($admins);
	    			break;
	    		case 'drivers':
	    			$db = DB::getInstance();
					$drivers['drivers'] = $db->query('SELECT * FROM drivers')->results();
					$drivers['token'] = Token::generate();
					echo json_encode($drivers);
	    			break;
	    		case 'getDriver':
	    			$db = DB::getInstance();
					$drivers['drivers'] = $db->get('drivers', array('id','=',Input::get('id')))->first();
					$drivers['token'] = Token::generate();
					echo json_encode($drivers);
	    			break;

	    		case 'getAdmin':
	    			$db = DB::getInstance();
					$admins['admins'] = $db->get('admins', array('id','=',Input::get('id')))->first();
					$admins['token'] = Token::generate();
					echo json_encode($admins);
	    			break;
	    	}
		}else{$admins = "Bad token";echo json_encode($admins);}
	}
 ?>

