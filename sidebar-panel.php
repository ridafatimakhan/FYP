<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="sidebar">
	<ul class="side-block">
		<h4 style="color: #286029; line-height: 45px; padding-left: 2%;margin-top:10px; background: #fff; border-top: 5px solid #286029; font-family: 'linux_biolinum_capitsmallcaps';">
		</h4>
		
		<?php if ($_SESSION['userRole'] == "A") { ?>
			<!-- 	
			<li><a href="panel.php"><i class="fas fa-user"></i> Profile</a></li>
			<li><a href="learners.php"><i class="fas fa-users"></i> Learners</a></li>
			<li><a href="changepassword.php"><i class="fas fa-lock"></i> Change Password</a></li>
			<li><a href="Courses.php"><i class="fas fa-book" ></i> Courses</a></li>
			<li><a href="OfferCourses.php"><i class="fas fa-book"></i> Offer Courses</a></li>
			<li><a href="learnercoursereg.php"><i class="fas fa-book"></i> Registered Courses</a></li> -->
			<li>
				<button class="dropdown-btn"> <i class="fas fa-book" style="color:green ;"></i> Course Management
				</button>
				<div class="dropdown-container m-0">
					<hr class="m-0">
					<a href="learnercoursereg.php" style="color:green;">Verify Courses Registration</a>
					<hr class="m-0">
					<a href="coursereg.php" style="color:green;">Course Registration Statistics</a>
					<hr class="m-0">
					<a href="OfferCourses.php" style="color:green;">Offer Courses</a>
					<hr class="m-0">
					<a href="Add-Course.php" style="color:green;">Add New Course</a>
					<hr class="m-0">
					<a href="Courses.php" style="color:green;">View All Courses</a>
					<hr class="m-0">
				</div>
			</li>
			<hr class="m-0">
			<li>
				<button class="dropdown-btn"><i class="fas fa-users" style="color:green"></i> Learner's Management
				</button>
				<div class="dropdown-container m-0">
				<hr class="m-0">
				<a href="learners.php" style="color:green;" >View All Learners</a>
				<hr class="m-0">
				<a href="learnercoursereg.php" style="color:green;">Learners Course Registration</a>
				<hr class="m-0">	
				<a href="learnersprogress.php" style="color:green;">Learners Progress Monitoring</a>
				<hr class="m-0">
				</div>
			</li>
			<hr class="m-0">
			<li>
				<button class="dropdown-btn"> <i class="fas fa-pen"></i>
					Result Management

				</button>
				<div class="dropdown-container">

					<a href="#" style="color:green;">Learners Progress Monitoring</a>
					<hr class="m-0">
					<a href="#" style="color:green;">Certifcate Generate</a>
					<hr class="m-0">

				</div>
			</li>
		<?php } else if ($_SESSION['userRole'] == "L") { ?>

			<li>
				<button class="dropdown-btn"><i class="fas fa-book" style="color:green ;"></i> Courses
				</button>
				<div class="dropdown-container m-0">
					<hr class="m-0">
					<a   href="showlearnercourses.php" style="color:green;">View All Offered Courses</a>
					<hr class="m-0">
					<a  href="yourcourse.php" style="color:green;">Your Course</a>



					<!-- usman ny sidebar panel mn yeh add kiya hai 
			<a href="Interactive_Learning.php?n=1&c=1">Interactive Learning</a> -->
					<hr class="m-0">
			<li>
			
			<li>
				<hr class="m-0">
				<button class="dropdown-btn"><i class="fas fa-users" style="color:green"></i>Settings
				</button>
				<div class="dropdown-container">
					<a href=""  style="color:green;">Profile</a>
					<hr class="m-0">
					<a href="changepassword.php" style="color:green;">Change Password</a>
					<hr class="m-0">


				</div>
			</li>
			<hr class="m-0">
			<li>
				<button class="dropdown-btn"> <i class="fas fa-pen"></i>
					View Progress
				</button>
				<div class="dropdown-container">

					<a href="#" style="color:green;">Graded and Practice Tests Results</a>
					<hr class="m-0">
					<a href="#"  style="color:green;">Assignments Marks</a>
					<hr class="m-0">

				</div>
			</li>


		<?php } ?>

	</ul>
</div>

<script>
	/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
	var dropdown = document.getElementsByClassName("dropdown-btn");
	var i;

	for (i = 0; i < dropdown.length; i++) {
		dropdown[i].addEventListener("click", function() {
			this.classList.toggle("active");
			var dropdownContent = this.nextElementSibling;
			if (dropdownContent.style.display === "block") {
				dropdownContent.style.display = "none";
			} else {
				dropdownContent.style.display = "block";
			}
		});
	}
</script>