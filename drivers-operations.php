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
						    'unique' => 'drivers'
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
						      $admin->createDriver(array(
						        'username' => Input::get('username'),
						        'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT),
						        'name' => Input::get('name'),
						        'last_name' => Input::get('last_name'),
						        'email' => Input::get('email'),
						        'mobile' => Input::get('mobile'),
						      ));
						      echo "You created a new Driver";
						    } catch (Exception $e) {
						      die($e->getMessage());
						    }
						} else {
						  foreach ($validation->errors() as $error) {
						    echo $error. '<br>';
						  }
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
						    $driver = new Driver();
						    try {
						      $check = $driver->login(Input::get('username'), Input::get('password'));
						      if($check){
						      	echo "Welcome Driver";
						      }else{
						      	echo "Your username and password are wrong";
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
						$db->delete("drivers", array('id', '=', Input::get('id')));
						if($db->count() > 0){
							echo "You deleted a driver";
						}else{
							echo "Driver can't be deleted";
						}
					break;
			}
		}else{echo 'los token';}
	}
 ?>
 <script>
  $('.all-drivers').empty();
  getDrivers('<?php echo Token::generate(); ?>', 'delete');
  </script>