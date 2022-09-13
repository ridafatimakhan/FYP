<?php if(isset($_SESSION) && !empty($_SESSION)){
 //	$current_user_id = $_SESSION['userid'];
 	//$user_data = ml_get_user_data($current_user_id);
}else{
	$redirect_url = ml_get_option('site_url');
 	header('location:'. $redirect_url .' ');
}

