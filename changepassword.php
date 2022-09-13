<?php require('./hf/header.php'); //Muallim's Main Header
 ?>
<script src="./js/function.js"></script>
<?php

if(!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0)
{
	$_SESSION['errors'] = array();
}


if(isset($_POST['update-btn'])){

	if(empty($_POST['currentpassword'])){
		array_push($_SESSION['errors'],'currentpassword is Required');
	}else{
		 $currentpassword = $_POST['currentpassword'];

		 if(checkoldpassword($currentpassword) != true){
			 array_push($_SESSION['errors'],"Old Password Not Matched");
		 }
	}

	if(empty($_POST['newpassword'])){
		array_push($_SESSION['errors'],'newpassword is Required');
	}else{
		 $newpassword = $_POST['newpassword'];
	}

	if(empty($_POST['retypenewpassword'])){
		array_push($_SESSION['errors'],'retypenewpassword is Required');
	}else{
		 $retypenewpassword = $_POST['retypenewpassword'];
	}


 
	if($newpassword != $retypenewpassword){
		array_push($_SESSION['errors'],"New Password Not Matched With Retype Password");

	}

	if(count($_SESSION['errors']) == 0){
		$userID=$_SESSION['userID'];

		$sql = "UPDATE users SET user_password = HASHBYTES('SHA1','$newpassword') where user_id = '$userID' ";

		$result =sqlsrv_query($conn,$sql);

		if($result){
			
			$_SESSION['successMsg'] = "Password Updated Successful";
			header("location:logout.php");
			exit();
		}
		

	}

}



?>








<div class="reg-wrapper reg-page">
	<div class="reg-outer">
		<div class="reg-inner">

		<?php if(isset($_SESSION['errors'])){
					$errors = $_SESSION['errors'];
					foreach($errors as $error){
						?>
						<div class="alert alert-danger">
							<?php echo $error; ?>
						</div>
						<?php
					}
					unset($_SESSION['errors']);
				} ?>
			
              	<form action="<?php ml_current_url();?>" method="POST" id="changepassword" role="form">
					<div class="form-group">
						<label for="">Current password</label>
						<input type="password" class="form-control" id="" name="currentpassword" placeholder="Current password" required>
					</div>
					<div class="form-group">
						<label for="">New password</label>
						<input type="password" class="form-control" id="loginpass" name="newpassword" placeholder="New password" required>
					</div>
                    <div class="form-group">
						<label for="">Re-type new password</label>
						<input type="password" class="form-control" id="loginpass" name="retypenewpassword" placeholder="Re-type new password" required>
					</div>
					<br>
					<!-- <a href="#" class="text-link"><b>Forgot password?</b></a><br> -->
					<div class="form-group">
						<input id="update-btn" type="submit" class="ex-btn" name="update-btn" value="Update Password">
					</div>
					<div class="message login-message"></div>
				</form>
				<a class="have-account" href="./signup.php"></a>
			</div>

		</div>
	</div>
</div>
