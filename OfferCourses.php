<?php 
    include "./hf/header.php";

?>
<script src="./js/function.js"></script>
<?php

		if(!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0){
			$_SESSION['errors'] = array();
		}

		function unsetSessions(){
		
			
			$course_duration="";
			$terms="";
		

		}
		
		$course_duration="";
		$terms="";

	?>
	<?php	  

/*------------------------------------Offering New Course ------------------------------------------*/
include('top.html');     if(isset($_POST['Offer_Course'])){ 
				$offer_date=date('Y-m-d');
				
          
				if(empty($_POST['course_duration'])){ 
					array_push($_SESSION['errors'],' Course Duration is Required');
					}else{
					$course_duration = $_POST['course_duration'];
					$_SESSION['course_duration'] = $course_duration;
	
					}
			   if(empty($_POST['offercourse'])){ 
				array_push($_SESSION['errors'],'Offer Course is Required');
				}else{
				//	echo checkCourseoffer($_POST['offercourse']);
				//	die;
					if(checkCourseoffer($_POST['offercourse']) == 0 ){
					
						$offercourse = $_POST['offercourse'];
						$_SESSION['offercourse'] = $offercourse;
					}else{
						array_push($_SESSION['errors'],'This Course is already Offered');
					}
				}
				if(empty($_POST['terms'])){ 
					array_push($_SESSION['errors'],'Set Terms & Conditions ');
					}else{
					$terms= $_POST['terms'];
					$_SESSION['terms'] = $terms;
	
					}
					
		

					/*  -----------------------------------------Insertion Query for adding new Course--------------------------------*/
	/* 	echo $query;
		die; */
		
		// echo count($_SESSION['errors']);
		// die;
		if(count($_SESSION['errors']) == 0){
			$query="INSERT INTO OfferCourse (offer_date,course_duration,offercourse,terms)VALUES('$offer_date','$course_duration','$offercourse','$terms')";

			$result =sqlsrv_query($conn,$query);
					
				
				if($result){
				
					$_SESSION['successMsg'] = "New Course offered Successfully";
					unsetSessions();
					/*------------------------------------Redirecting page to courses Details affer course Adding--------------------*/
					header("location:showlearnercourses.php");

					exit();
				}
			}
			}
			?> 

			<div class="reg-wrapper reg-page Add-Courses">
				<div class="reg-outer">
					<div class="reg-inner">

			<div id="Add-Courses" class="tabcontent">

				
					<?php if(isset($_SESSION['errors'])){
						$errors = $_SESSION['errors'];
						foreach($errors as $error){
							?>
							<div class="alert alert-danger">
								<?php echo $error;?>
							</div>
							<?php
						}
						unset($_SESSION['errors']);
					}
				       ?>
						<!--------------Creating Form------------>
                    <form action="" method="POST"  enctype="multipart/form-data">
                    <div class="alert alert-success text-center" style="background-color:#286029; color:white;">
                    <i class="fas fa-book-open" style="color: #fff";> </i > Offer Course
                    </div>
				
                                    <div class="form-group">
					
                    <?php 
								$query="SELECT * FROM Courses  ORDER BY course_id DESC";
								
								$params = array();
								
								$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
								$stmt = sqlsrv_query( $conn, $query , $params, $options );
								$result =sqlsrv_query($conn,$query);
								$row_count = sqlsrv_num_rows( $stmt );
								?>
                               <div class="form-group">
				                         <label>Course Offering <span class="text-danger">*</span></label>
	                                     <select class="form-control" name="offercourse" required>
										<!------------ Data fetching for offering Course Prerequiste ------->
										<?php if($row_count>0){
										while ( $row = sqlsrv_fetch_array( $stmt)):
										?>
										<option class="text-capitalize" value="<?php echo $row['course_id']?>" >
										<?php echo $row['course_code']." - ".$row['course_name']?>
										</option>
										<?php
										endwhile;
										}else{
											?>
											<option value="0">NO Course Found</option>
											<?php 
										}
                                       ?>
                                      </select>
                                </div>


			
				
				<div class="form-group">
					<label for="">Course Duration</label>
					<input type="text" class="form-control" id="course_duration" name="course_duration" placeholder=" Enter Course Duration here" value="<?php echo $course_duration; ?>" >
				</div>

				<div class="form-group">
					<label for="">Terms & Conditions</label>
					<input type="text" class="form-control" id="termsandconditions" name="terms" placeholder=" Enter Terms & Conditions here"  >
				</div>
			
			
				<div class="form-group">
				<input id="offer-btn" type="submit" class="ex-btn" name="Offer_Course" value="Offer Course" >
				</div>
				<br>
				</form>
</div>
</div>
</div>
</div>
</div>
									</div>
									</div>
									<?php require('./hf/footerNOMAN.php'); ?>

