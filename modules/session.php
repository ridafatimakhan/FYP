<?php 
/*
* Stop execution if someone tried to get file directly.
*/
// if ( !defined( 'ABSPATH' ) ) exit;

						//======================================================================//
								// Class to login the users //
						//======================================================================//
class ML_SESSION {

	/*
	* Initate objects and variables
	*/
	function __construct(){
		// $this->login();
		// $this->signup();
	}

	function signup(){
		$signup_form = null;
		$mesage = null;


		if(isset($_POST['signup-btn']) && !empty($_POST['sign-name']) && !empty($_POST['sign-pass']) && !empty($_POST['sign-email'])){
			$sign_username = $_POST['sign-name'];
			$sign_password = $_POST['sign-pass'];
			$sign_email = $_POST['sign-email'];
			$sign_role = $_POST['role'];
 			
			$signup_con = new ML_CONNECTION();
			$signup = $signup_con->connection_db();

			$check_user_query = "SELECT user_id FROM users WHERE user_name = '$sign_username'";

			$user_checked = $signup->query($check_user_query);

			if(empty($user_checked->num_rows)){
				$signupquery = "INSERT INTO users (user_name, user_password, user_email, user_role) VALUES ('$sign_username', '$sign_password', '$sign_email', '$sign_role');";
				$result = $signup->query($signupquery);
				
					$mesage = 'signup successful';	
				
			}else{
				$mesage = 'Sorry, '.$sign_username.' have already joined Muallim';
			}
		//echo '<pre>'; print_r($user_checked); exit;

			
		}

		$signup_form = '';
			return $signup_form;
	}

}/* ML_SESSION Class Ends Here */
$ML_SESSION = new ML_SESSION();