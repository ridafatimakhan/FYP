<?php require('./hf/header.php'); //Muallim's Main Header ?>
<script src="./js/function.js"></script>

<!-- Muallim's Inner Page Content Start -->
<div class="ip-banner">
	<div class="color-bg"></div>
	<div class="img-bg"></div>
	<div class="container">
		<div class="ip-banner-blurb">			
			<h2>Contact us</h2>
		</div>
	</div>
</div>




<div class="content ip-content">
	<div class="container-fw">
	<?php require('./sidebar.php'); //Muallim's Sidebar ?>
		<div class="ip-main">
			<div class="contact-us">
				<div class="contact-form">
					<h1>Contact Us Here</h1>
					<form action="" method="POST" role="form" >
						<div class="form-group">
							<label for="f-name">Full name</label>
							<input type="text" class="form-control" id="f-name" placeholder="Full Name">
						</div>
						<div class="form-group">
							<label for="">Email</label>
							<input type="email" class="form-control" id="email" placeholder="Email">
						</div>
						<div class="form-group">
							<label for="">Phone</label>
							<input type="text" class="form-control" id="phone" placeholder="Phone">
						</div>
						<div class="form-group">
							<label for="">Discription</label>
							<textarea name="" id="discription" class="form-control" placeholder="Your Message"></textarea>
						</div>
						<button type="submit" class="ex-btn">Submit</button>
					</form>
					<a class="have-account" href="tel:03450571037"><b><i>or <i>Call us 0342-1704904</i></i></b></a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Muallim's Inner Page Content End -->
<?php require('./hf/footerNOMAN.php'); //Muallim's Main Header ?>


