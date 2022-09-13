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
?>
<?php 
if(!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0){
	$_SESSION['errors'] = array();
}
$firstName =$password= $lastName = $userContactNo = $userName = $userDOB = $userGender = $userEmail = $userCNIC = $userAddress = $userLastQualification = $userFatherName ="";


if(isset($_POST['signup-btn'])){
	$user_role = "L";
	$user_status="pending";

	if(empty($_POST['firstName'])){
		array_push($_SESSION['errors'],'Fisrt Name is Required');
	}else{
		 $firstName = $_POST['firstName'];
	}

	if(empty($_POST['userName'])){
		array_push($_SESSION['errors'],'Username is Required');
	}else{
		if(checkUserNameExist($_POST['userName']) == 0 ){
			$userName = $_POST['userName'];
		}else{
			array_push($_SESSION['errors'],'User name already exist');
		}
	}

	if(empty($_POST['userEmail'])){
		array_push($_SESSION['errors'],'UserEmail is Required');
	}else{
		if(checkEmailExist($_POST['userEmail']) == 0 ){
			$userEmail = $_POST['userEmail'];
		}else{
			array_push($_SESSION['errors'],'User Email already exist');
		}
	}

	if(empty($_POST['userPassword']))
	{
		array_push($_SESSION['errors'],'Userpassword is required');

	}
	else{
		$password = $_POST['userPassword'];
	}

	if(checkCnicNoExist($_POST['userCNIC']) == 0 ){
		$userCNIC = $_POST['userCNIC'];
	}else{
		array_push($_SESSION['errors'],'CNICNO already exist');
	}
	$lastName = $_POST['lastName'];
	$userContactNo=$_POST['userContactNo'];
	$userDOB=$_POST['userDOB'];
	$userCNIC=$_POST['userCNIC'];
	$userAddress=$_POST['address'];
	$userLastQualification=$_POST['last-qualification'];
	$userFatherName=$_POST['userFatherName'];

	if(empty($_POST['userGender']))
	{
		array_push($_SESSION['errors'],'User Gender is required');

	}
	else{
		$userGender = $_POST['userGender'];
	}
	$userPic = "";
	if(basename($_FILES["userPic"]["name"]) !=""){
		$target_dir = "uploads/learnersImages/";

		$check = getimagesize($_FILES["userPic"]["tmp_name"]);
		if($check !== false) {
			$target_file = $target_dir .time()."_". basename($_FILES["userPic"]["name"]);

			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));	
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
					array_push($_SESSION['errors'],"Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
					;
			}
			
			if(count($_SESSION['errors']) == 0){
				if (move_uploaded_file($_FILES["userPic"]["tmp_name"], $target_file)) {
				$query= " INSERT INTO users
				 (user_name,user_password,user_email,user_firstName,user_lastName,user_fatherName,gender,birthdate,cnicNo,contactNo,address,lastQualification,user_role,user_status,user_image) VALUES('$userName',HASHBYTES('SHA1','$password'),'$userEmail','$firstName','$lastName','$userFatherName','$userGender','$userDOB','$userCNIC','$userContactNo','$userAddress','$userLastQualification','$user_role','$user_status','$target_file')";

					}

			}

		}else{
		array_push($_SESSION['errors'],'Please');

		}
	}
	
	else{
		
		$query= " INSERT INTO users (user_name,user_password,user_email,user_firstName,user_lastName,user_fatherName,gender,birthdate,cnicNo,contactNo,address,lastQualification,user_role,user_status) VALUES('$userName',HASHBYTES('SHA1','$password'),'$userEmail','$firstName','$lastName','$userFatherName','$userGender','$userDOB','$userCNIC','$userContactNo','$userAddress','$userLastQualification','$user_role','$user_status')";

	}
	
	if(count($_SESSION['errors']) == 0){
		
		$result =sqlsrv_query($conn,$query);
		if($result){
			$userID = "";
			$notiTitle = "Learner ".$firstName." Send New Account Registration Request";
			$notiFor = "A";
			$notiForID = getAdminID();
			$notiStatus = '0';

			/*--Code for Getting the last Id inserted in users table ---Start*/
			$sqlID = "SELECT @@IDENTITY AS user_id";
			$params = array();
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$stmt = sqlsrv_query( $conn, $sqlID , $params, $options );
			$result =sqlsrv_query($conn,$sqlID);
			$row = sqlsrv_fetch_array( $stmt);
			/*--Code for Getting the last Id inserted in users table ---End*/
			$notiTypeID = $row['user_id']; //User of last user Inserted
			$notiType = "AR";
			//$_SESSION['successMsg'] = "Registered Successfully"; // new account ban ,sir show kiu nahi hu rhi notification?

			$q="INSERT INTO  Notification(noti_title,
												noti_for,
												noti_for_id,
												noti_type,
												noti_type_id
												,noti_status)VALUES('$notiTitle',
																	'$notiFor',
																	'$notiForID',
																	'$notiType',
																	'$notiTypeID',
																	'$notiStatus')";
			
			$r =sqlsrv_query($conn,$q);
			//header("location:showlearnercourses.php");
			//exit();
			$_SESSION['successMsg'] = "Your Learner Account Request has been sent to Admin, After Admin Approval You can login into our Portal";
			header("location:signin.php");
			exit();

		}
			
	}else{
	}
}
					 
				

?>
<!-- ///////////////////// -->
<div class="reg-wrapper reg-page signup">
	<div class="reg-outer">
		<div class="reg-inner">
			<div class="reg-title">
				<h5>Muallim</h5>
				<p>Learning and Testing System.</p>
			</div>

			
			<div id="signup" class="tabcontent">
			<div class="alert alert-success text-center mt-n4" style="background-color:#286029; color:white;" >
			Sign Up 
           </div>
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
				<form method="post" action="signup.php" enctype="multipart/form-data">

					<div class="form-group">
						<div class="col">
							<label for="">First Name <span>*</span></label>
							<input type="text" class="form-control" name="firstName" placeholder="First Name"  value="<?php echo $firstName; ?>">
						</div>
						<div class="col">
							<label for="">Last Name</label>
							<input type="text" class="form-control" name="lastName" placeholder="Last Name"  value="<?php echo $lastName; ?>" >
						</div>
					</div>
					

					<div class="form-group">
						<div class="col">
							<label for="">Username <span>*</span></label>
							<input type="text" class="form-control" name="userName" placeholder="Username"  value="<?php echo $userName; ?>">
						</div>
						<div class="col">
							<label for="">Father Name</label>
							<input type="text" class="form-control" name="userFatherName" placeholder="Fathername"   value="<?php echo $userFatherName; ?>">
						</div>
					</div>
					

					<div class="form-group">
					<div class="col">
						<label for="">Email <span>*</span></label>
						<input type="email" class="form-control" id="sign-email" name="userEmail" placeholder="Email"   value="<?php echo $userEmail; ?>">
					</div>
					<div class="col">
							<label for="">Password <span>*</span></label>
							<input type="password" class="form-control" name="userPassword" placeholder="Password" value=<?php echo $password ?> >
						</div>
					</div>
				

					<div class="form-group">
					<div class="col">
							<label for="">CNIC No</label>
							<input type="number" class="form-control" id="cnic-no" name="userCNIC" placeholder="CNIC Number"   value="<?php echo $userCNIC; ?>">
						</div>
						<div class="col">
							<label for="">Contact No</label>
							<input type="number" class="form-control" id="contact-no" name="userContactNo" placeholder="Contact Number"   value="<?php echo $userContactNo; ?>" >
						</div>
					</div>


					<div class="form-group">
					<div class="col">
							<label for="">Last Qualification</label>
						<select class="form-control">
									<option>Choose...</option>
									<option>Matric</option>
									<option>Intermediate</option>
									<option>Graduate</option>
						</select>
					</div>

					
						<div class="col">
							<label for="">Date Of Birth</label>
							<input type="date" class="form-control" id="dob" name="userDOB" placeholder="Date of Birth"  value="<?php echo $userDOB; ?>"> 	
						</div>
					</div>
			


					<div class="form-group role">
					<div class="col">
							<label for="">Gender</label>
							<label for="g1"><input <?php if($userGender == "M"){echo "selected";} ?> type="radio" id="userGender" name="userGender" value="M" checked="checked"> Male</label>
							<label for="g2"><input type="radio" <?php if($userGender == "F"){echo "selected";} ?> id="g2" name="userGender" value="F"> Female</label>
						</div>
						<div class="col">
							<label for="">Address</label>
							<textarea name="address" id="userAddress" class="form-control" placeholder="Address"   value="<?php echo $userAddress; ?>"></textarea>
						</div>
					
					</div>


						<div class="form-group role">
						<label for="">Upload Your Photo</label>
						<input style="width:100%;" type="file" name="userPic">
						</div>
			
					

				<input id="signup-btn" type="submit" name="signup-btn" class="ex-btn" value="Join Muallim">
				<div class="message signup-message"></div>
				</form>
				<a class="have-account" href="signin.php"><b><i>or I have an Account</i></b></a>
			</div>

		</div>
	</div>
</div>

<!-- Muallim's Landing Page Content End -->

<?php include('./hf/footerNOMAN.php');

