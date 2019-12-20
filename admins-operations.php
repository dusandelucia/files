<?php
	require_once '../../../core/init.php'; 
	if (Input::exists('post') || Input::exists('get')) {
	    if (Token::check(Input::get('token'))) {
			switch (Input::get('operation')) {
				case 'register':
						$validate = new Validate();
						$validation = $validate->check($_POST, array(
						  'username' => array(
						    'required' => true,
						    'min' => 2,
						    'max' => 20,
						    'unique' => 'admins'
						  ),
						  'password' => array(
						    'required' => true,
						    'min' => 6
						  ),
						  'password_again' => array(
						    'required' => true,
						    'matches' => 'password'
						  ),
						  'name' => array(
						    'required' => true,
						    'min' => 2
						  ),
						  'last_name' => array(
						    'required' => true,
						    'min' => 2
						  ),
						  'email' => array(
						    'required' => true,
						    'valid_email' => true
						  ),
						  'mobile' => array(
						    'required' => true,
						    'min' => 6
						  )
						));

						if ($validation->passed()) {
						    $admin = new Admin();
						    try {
						      $admin->create(array(
						        'username' => Input::get('username'),
						        'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT),
						        'name' => Input::get('name'),
						        'last_name' => Input::get('last_name'),
						        'email' => Input::get('email'),
						        'mobile' => Input::get('mobile'),
						      ));
						      echo "You created a new Admin";
						 
						    } catch (Exception $e) {
						      die($e->getMessage());
						    }

						} else {
						
						  foreach ($validation->errors() as $error) {
						    echo $error. '<br>';
						  }
						  echo "<script>$('#token').val(\"".Token::generate()."\");</script>";
						}
					break;
				case 'login':
						$validate = new Validate();
						$validation = $validate->check($_POST, array(
						  'username' => array(
						    'required' => true
						  ),
						  'password' => array(
						    'required' => true
						  )
						));

						if ($validation->passed()) {
						    $admin = new Admin();
						    try {
						      $check = $admin->login(Input::get('username'), Input::get('password'));
						      if($check){
						      	echo "Welcome Admin";
						      }else{
						      	echo "Your username and password are wrong";
						      	echo "<script>$('#token').val(\"".Token::generate()."\");</script>";
						      }
						
						    } catch (Exception $e) {
						      die($e->getMessage());
						    }

						} else {
						
						  foreach ($validation->errors() as $error) {
						    echo $error. '<br>';
						    echo "<script>$('#token').val(\"".Token::generate()."\");</script>";
						  }
						}
					break;
				
				case 'delete':
						$db = DB::getInstance();
						$db->delete("admins", array('id', '=', Input::get('id')));
						if($db->count() > 0){
							$admin = new Admin();
							$x = ($admin->superAdmin()) ? 'delete':'not';
							echo "You deleted a admin";
							echo "<script>
							$('.all-admins').empty();
							getAdmins(\"".Token::generate()."\",\"".$x."\");</script>";
						}else{
							echo "Admin can't be deleted";
						}
					break;
			}
		}
	}
 ?>