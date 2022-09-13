<?php require('./hf/header.php'); //Muallim's Main Header ?>
<script src="./js/function.js"></script>

<?php 
if(isset($_SESSION) && !empty($_SESSION)){
 	$current_user_id = $_SESSION['userid'];
 	$user_status = 'login';
}else{
	$user_status = 'notlogin';
}
?>

<!-- Muallim's Inner Page Content Start -->
<div class="ip-banner">
	<div class="color-bg"></div>
	<div class="img-bg"></div>
	<div class="container">
		<div class="ip-banner-blurb">			
			<h2>Test your understanding <br>of Quran-il-Hakeem</h2>
		</div>
	</div>
</div>


<div class="content ip-content">
	<div class="container-fw">
	<?php require('./sidebar.php'); //Muallim's Sidebar ?>
		<div class="ip-main">
			<h4><i class="fas fa-book-open"></i> Test your Knowlegde about Seerat-un-Nabi(PBUH)</h4>
			<p>Muallim's Testing Environment is help the learner’s, in evaluation of their understanding through the well-defined set of questions of his own choice of topics. Being an Web-based system, the software enables the user to learn Seerat-un-Nabi(PBUH) on their own pace, beyond the geographical boundaries.</p>
			<h3>How to start testing your Seerat-un-Nabi(PBUH) knowlegde and understanding</h3>
			<p>Select your Level of testing and confirm your test schedule then we will send you confirmation email and further details</p>
			<hr class="bg">
			<div class="test-select">
				<table cellpadding="0" cellspacing="0">
					<tr>
						<th>Intermediate Level</th>
						<th>Advanced Level</th>
						<th>Beginner Level</th>
					</tr>
					<tr>
						<td><i class="fas fa-check"></i> Basic Questions</td>
						<td><i class="fas fa-check"></i> Subject Oriented Questions</td>
					</tr>
					<tr>
						<td><i class="fas fa-check"></i> Short Questions</td>
						<td><i class="fas fa-check"></i> Summary Questions</td>
					</tr>
					<tr>
						<td><i class="fas fa-check"></i> Introductory Questions</td>
						<td><i class="fas fa-check"></i> Contextual Questions</td>
					</tr>
					<tr>
						<?php if($user_status == 'login'){ ?>
							<td colspan="2"><a class="start-test" href="test-list.php?testType=basic">Schedule test <i class="fas fa-chevron-right"></i></a></td>
							<!-- <td><a class="start-test" href="test-list.php?testType=advanced">Schedule test<i class="fas fa-chevron-right"></i></a></td> -->
						<?php }else{ ?>
							<td><a class="start-login inter" href="signin.php">Please Login to start Schedule Intermediate test <i class="fas fa-chevron-right"></i></a></td>
							<td><a class="start-login" href="signin.php">Please Login to start Schedule Advanced test<i class="fas fa-chevron-right"></i></a></td>
						<?php }?>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Muallim's Inner Page Content End -->




<?php require('./hf/footerNOMAN.php'); //Muallim's Main footer