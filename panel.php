<?php require('./hf/header.php'); //Muallim's Main Header ?>
<?php require('./panel-header.php'); //Muallim's Panel Header ?>
<script src="./js/function.js"></script>

<!-- Muallim's Panel Start -->
<div class="content ip-content admin-panel">
	<div class="container-fw">

		<div class="ip-main">
			<div class="t-wrap">

				<?php require('./panel-head-option.php'); //Muallim's Sidebar ?>
				

				<div class="panel-content">

					<div class="test-profile profile">
						<div class="profile-header"><label><i class="fas fa-user-alt"></i> <b>Your Profile</b></label></div>
						<div class="profile-pic">
							<img src="images/users/<?php //echo $user_data['user_image'];?>" alt="">
						</div>
						<div class="profile-info">
							<div class="info-text">
								<label for="">Welcome </label> <label for=""><?php echo getUserTypeTitle()." ".$_SESSION['userFullName'];?></label>
							</div>
							
							
							
							
							
							
						</div>
					</div>

				</div>
			</div>
		</div>
	</div> 
 </div> 
<!-- Muallim's Inner Page Content End -->
<?php include('./hf/footerNOMAN.php');




