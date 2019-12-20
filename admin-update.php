<?php 
	require_once '../../../core/init.php'; 
	if (Input::exists('post') || Input::exists('get')) {
	    if (Token::check(Input::get('token'))) {
	    	$validate = new Validate();
	    	$validation = $validate->check($_POST, array(
	    	  'username' => array(
	    	    'min' => 2,
	    	    'max' => 20,
	    	    'unique' => 'admins'
	    	  ),
	    	  'password' => array(
	    	    'min' =>  6
	    	  ),
	    	  'old_password' => array(
	    	    'required' =>  (Input::get('password') != "" && !empty(Input::get('password')))? true:false
	    	  ),
	    	  'password_again' => array(
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
	    		if (!empty(Input::get('password'))) {
	    			$admin = new Admin();
	    			$check = $admin->find(Input::get('id'));
	    			if ($check) {
	    				if(password_verify(Input::get('old_password'), $admin->data()->password)){
	    					try {
	    					  $username = (Input::get('username') == '')? Input::get('currentUsername'):Input::get('username');
	    					  $admin->update(array(
	    					    'username' => $username,
	    					    'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT),
	    					    'name' => Input::get('name'),
	    					    'last_name' => Input::get('last_name'),
	    					    'email' => Input::get('email'),
	    					    'mobile' => Input::get('mobile'),
	    					  ), Input::get('id'));
	    					  echo "You updated Admin";
	    					} catch (Exception $e) {
	    					  die($e->getMessage());
	    					}
	    				}else{echo "Current password is worng";}
	    			}
	    		}else{
	    			try {
	    			$admin = new Admin();
    				$username = (Input::get('username') == '')? Input::get('currentUsername'):Input::get('username');
	    			  $admin->update(array(
	    			    'username' => $username,
	    			    'name' => Input::get('name'),
	    			    'last_name' => Input::get('last_name'),
	    			    'email' => Input::get('email'),
	    			    'mobile' => Input::get('mobile'),
	    			  ), Input::get('id'));
	    			  echo "You updated Admin";
	    			} catch (Exception $e) {
	    			  die($e->getMessage());
	    			}
	    		}
	    	} else {
	    	  foreach ($validation->errors() as $error) {
	    	    echo $error, '<br>';
	    	  }
	    	}
		}else{echo "wrong token";}
	}
 ?>
 <script>
 	var check = '<?php  echo Input::get("username");?>';
 	if (check != '') {
 		$('#currentUsername').val(check);
 	}
	 $('.all-admins').empty();
	 getAdmins('<?php echo Token::generate(); ?>', 'delete');
  </script>