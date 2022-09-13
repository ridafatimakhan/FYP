<link href="/open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">

<?php require('./includes/Connection.php'); ?>
<?php require('./includes/functions.php'); //Muallim's Main Functions 


?>

<?php //include('includes/notification.php'); 
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta http: charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Muallim | Learning & Testing</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
	<link rel="icon" href="./images/favicon-quran.svg" type="image/svg" sizes="16x16">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"	
	integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="./css/animate.css" />
	
	<link rel="stylesheet" href="./css/style.css">
	<link rel="stylesheet" href="./IL/style_il.css">
	<link rel="stylesheet" href="./css/ridatest.css">
	
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>


	<script src="./js/moment.js"></script>
	<script src="./js/wow.min.js"></script>
	<script>
		new WOW().init();
	</script>
	
</head>

<body>
	<div class="notification">
	</div>
	<div class="header">
		<div class="container-fw">
			<div class="logo">
				<a href="./index.php"><img src="./images/Final_logo.png" alt=""></a>

			</div>

			<div class="center-logo">
<<<<<<< HEAD
				<img src="./images/Surah Ahzaab Ayat 21 (For Hompage Title).jpg" alt="">
=======
				<img src="./images/ayat.jpg" alt="">
>>>>>>> d32b9a08db94467bd58a3d272cbc879457b513b5
			</div>

			<div class="header-right">
				<?php
				if (checkLogin() == false) {

					//echo '<pre>'; print_r(); exit(); 
				?>
					<a class="trs-03 btn-r item signup-reg" href="signup.php">Sign up</a>
					<div class="item active"><a href="./signin.php" class="login-reg">Log in</a></div>


				<?php } else { ?>

					<?php
					$notiFor = $_SESSION['userRole'];
					$notiForID = $_SESSION['userID'];
					$sqlNotification = "SELECT * FROM Notification WHERE noti_for = '$notiFor' AND noti_for_id = '$notiForID' AND noti_status = '0' ORDER BY noti_id DESC ";

					$params = array();
					$options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET);
					$stmtNotifiaction = sqlsrv_query($conn, $sqlNotification, $params, $options);

					$row_count_notifications = sqlsrv_num_rows($stmtNotifiaction);

					$sqlNotification = sqlsrv_num_rows($stmtNotifiaction);
					?>
					<div class="menu-item parent">
						<a href="#" class="ex-btn trs-03"><i class="fas fa-bell" ></i> <?php if ($row_count_notifications > 0) { ?>
								<span style="background:green; width:20px; height:20px; border-radius:70px; color:#ffffff; text-align:center; display:inline-block; line-height:20px; "><?php echo $row_count_notifications; ?></span> <i class="fas fa-chevron-down"></i><?php } ?></a>
						<?php if ($row_count_notifications != 0) {
						?>
							<div class="menu-wrap">
								<ul style="height:300px; overflow-y:auto; overflow-x:hidden; width:230px;" class="submenu">
									<?php while ($row = sqlsrv_fetch_array($stmtNotifiaction)) {
										$notiUrl = "Javascript:;";
										$notiID = $row['noti_id'];
										$notiTypeID = $row['noti_type_id'];
										if ($_SESSION['userRole'] == "A") {
											$notiUrl = "viewRegDetails.php?regCourseID=" . $notiTypeID . "&notiID=" . $notiID;
											$notiUrl = "learnersregistration.php?userID=" . $notiTypeID . "&notiID=" . $notiID;
										} else if ($_SESSION['userRole'] == "L") {
											$notiUrl = "yourcourse.php?regCourseID=" . $notiTypeID . "&notiID=" . $notiID;
										}


									?>
										<li><a href="<?php echo $notiUrl; ?>"><?php echo $row['noti_title']; ?></a></li>
									<?php } ?>
								</ul>
							</div>
						<?php
						} ?>

					</div>


					<body>
			
			<div class="action">
	<div class="profile" onclick="menuToggle();">
		<img src="./images/user.png" alt="">
	</div>
	<div class="menu" style="margin-right:30px;">
	<h3>
                User Account
                <div>
				<h3><?php echo $_SESSION['userFullName']?> </h3>
                </div>
            </h3>
	<ul>
			<li>
				<span class="material-icons icons-size">person</span>
				<a href="panel.php">My Profile</a>
			</li>
			<li>
				<span class="material-icons icons-size">mode</span>
				<a href="changepassword.php">Change Password</a>
			</li>
		   
			<li>
			<span class="material-icons icons-size">account_balance_wallet</span>
				<a href="./logout.php">Log out</a>
			</li>
			
		</ul>
	</div>
</div>

<script>
	function menuToggle(){
		const toggleMenu = document.querySelector('.menu');
		toggleMenu.classList.toggle('active')
	}
</script>
</body>
				











				<?php } ?>
<style>
	
.icons-size{
    color: #333;
   
}
.action{
    position: fixed;
    right: 10px;
    top:25px
}
.action .profile{
    border-radius: 50%;
    cursor: pointer;
    height: 40px;
    overflow: hidden;
    position: relative;
    width: 40px;
}
.action .profile img{
    width: 100%;
    top:0;
    position: absolute;
    object-fit: cover;
    left: 0;
    height: 100%;
}
.action .menu{
    background-color:rgb(207, 228, 215);
    box-sizing:0 5px 25px rgba(0,0,0,0.1);
    border-radius: 10px;
    padding: 10px 10px;
    position: absolute;
    right: -40px;
    width: 250px;
    transition: 0.5s;
    top: 100px;
    visibility: hidden;
    opacity: 0;
}
.action .menu.active{
    opacity: 1;
    top: 75px;
    visibility: visible;
}
.action .menu::before{
    background-color:#fff;
    content: '';
    height: 20px;
    position: absolute;
    right: 100px;
    transform:rotate(45deg);
    top:-5px;
    width: 20px;
}
.action .menu h3{
    color: #555;
    font-size: 25px;
    font-weight: 400;
    line-height: 1em;
    padding: 0px 0px;
    text-align: left;
    width: 100%;
	font-family:'calibri';
}
.action .menu h3 div{
    color: #818181;
    font-size: 20px;
    font-weight: 400;
	font-family:'calibri';
	padding: 0px 0px;
}
.action .menu ul li{
    align-items: center;
    border-top:1px solid rgba(0,0,0,0.05);
    display: flex;
    justify-content: left;
    list-style: none;
    padding: 5px 0px;
}
.action .menu ul li img{
    max-width: 20px;
    margin-right: 10px;
    opacity: 0.5;
    transition:0.5s
}
.action .menu ul li a{
    display: inline-block;
    color: #555;
    font-size: 15px;
    font-weight: 600;
    padding-left: 10px;
    text-decoration: none;
    text-transform: uppercase;
    transition: 0.5s;
	font-family:"calibri";
	
}
.action .menu ul li:hover img{
    opacity: 1;
}
.action .menu ul li:hover a{
    color:#286029;
}
	</style>
	
	<div class="menu">
					<div class="menu-item parent">
						<a href="#" class="ex-btn trs-03">Explore <i class="fas fa-chevron-down"></i></a>
						<div class="menu-wrap">
							<ul class="submenu">
								<li><a href="learningservice.php">Learning Service</a><i class="fas fa-chevron-right"></i></li>
								<li><a href="test-service.php">Testing Service</a><i class="fas fa-chevron-right"></i></li>
							
								<li><a href="about.php">About Muallim</a><i class="fas fa-chevron-right"></i></li>
								<li><a href="about-team.php">About Team</a><i class="fas fa-chevron-right"></i></li>
								<li><a href="authenticity.php">Authenticity</a><i class="fas fa-chevron-right"></i></li>
								<li><a href="contact.php">Contact</a><i class="fas fa-chevron-right"></i></li>
							</ul>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>