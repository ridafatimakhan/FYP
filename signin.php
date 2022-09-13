<?php require('./hf/header.php'); //Muallim's Main Header ?>
<script src="./js/function.js"></script>
<?php
	if(checkLogin() == true){
		if($_SESSION['userRole'] == "A"){
			header("location:panel.php");
			exit();
		}else if($_SESSION['userRole'] == "L"){
			header("location:panel.php");
			exit();
		}
	}

	if(!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0){
		$_SESSION['errors'] = array();
	}
	if(isset($_POST['login-btn'])){

		if(empty($_POST['username'])){
			array_push($_SESSION['errors'],'Username is Required');
		}else{
			$username = $_POST['username'];
		}

		if(empty($_POST['password'])){
			array_push($_SESSION['errors'],'password is Required');
		}else{
			$password = $_POST['password'];
		}



		if(count($_SESSION['errors']) == 0){
			$sql = "SELECT * FROM users WHERE user_name = '$username' AND user_password = HASHBYTES('SHA1','$password') ";
	
			//$result =sqlsrv_query($conn,$sql);

		//	$sql = "SELECT * FROM users";
			$params = array();
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$stmt = sqlsrv_query( $conn, $sql , $params, $options );

			$row_count = sqlsrv_num_rows( $stmt );
			
			if($row_count == 1){
				if ( $record = sqlsrv_fetch_array( $stmt) )
				{
					//echo $record["user_id"] .", ". $record["user_name"] ."<br />";

					$_SESSION['userID'] = $record['user_id'];
					$_SESSION['userName'] = $record['user_name'];
					$_SESSION['userFullName'] = $record['user_firstName']." ".$record['user_lastName'] ;

					$_SESSION['userRole'] = $record['user_role'];

				

			
						header("location:courses-detail2.php");
						exit();
						
					//}

				}
		
			}else{
				array_push($_SESSION['errors'],'Username or password is invalid Please enter the correct username & password.');
				
			}
		
		} 

	}
?>
<div class="reg-wrapper reg-page">
	<div class="reg-outer">
		<div class="reg-inner">
			<div class="reg-title">
				<h5>Muallim</h5>
				<p> Learning and Testing System.</p>
			</div>

			<!-- Tab content -->
			<div id="login" class="tabcontent active">

			<div class="alert alert-success text-center mt-n4"  style="background-color:#286029; color:white;">
			Sign In
           </div>


		   
				<?php 
				if(isset($_SESSION['successMsg'])){
					?>
					<div class="alert alert-success">
						<?php 
							echo $_SESSION['successMsg'];
							unset($_SESSION['successMsg']);
	
						?>
					</div>
					<?php
				}
				if(isset($_SESSION['errors'])){
					$errors = $_SESSION['errors'];
					foreach($errors as $error){
						?>
						<div class="alert alert-danger">
							<?php echo $error; ?>
						</div>
						<?php
					}
					unset($_SESSION['errors']);
					?>
					<?php
				}
				
				?>
				

				<form action="<?php ml_current_url();?>" method="POST" id="signinForm" role="form">
					
				
				
				
				
				
				
				
				
				
				
				<div class="form-group">
						<label for="">User Name</label>
						<input type="text" class="form-control" id="loginUserName" name="username" placeholder="User Name " required>
					</div>
					<div class="form-group">
						<label for="">Password</label>
						<input type="password" class="form-control" id="loginpass" name="password" placeholder="Password" required>
					</div>
					<br>
					<!-- <a href="#" class="text-link"><b>Forgot password?</b></a><br> -->
					<div class="form-group">
						<input id="login-btn" type="submit" class="ex-btn" name="login-btn" value="Log in">
					</div>
					<div class="message login-message"></div>
				</form>
				<p>New to Muallim? 
				<a class="have-account" href="./signup.php"><b><i>Create an account</i></b></a>
			</p>
			</div>

		</div>
	</div>
</div>

<!-- Muallim's Landing Page Content End -->
<?php include('./hf/footerNOMAN.php');

