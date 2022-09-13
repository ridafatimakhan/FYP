
<?php require('./hf/header.php'); //Muallim's Main Header ?>
<?php require('./panel-header.php'); //Muallim's Panel Header ?>
<script src="./js/function.js"></script>
<?php
    	if(!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0){
		$_SESSION['errors'] = array();
		}

		function unsetSessions(){

		unset($_SESSION['course_name']);
		unset($_SESSION['course_code']);
		unset($_SESSION['course_description']);
		unset($_SESSION['total_sections']);
		unset($_SESSION['total_chapters']);
		unset($_SESSION['total_concepts']);
		unset($_SESSION['defined_by']);
		unset($_SESSION['credit_hours']);
		unset($_SESSION['defined_by']);

		}

$course_code = $course_name = $course_description = $defined_date =$defined_by=$credit_hours=$total_chapters =$total_concepts=$total_sections="";
/*-----------------------------------------------------------Adding New Course ------------------------------------------*/
if(isset($_POST['Add-Course'])){ 

	 	          if(empty($_POST['course_code'])){
					array_push($_SESSION['errors'],'Course Code is Required');
				}else{
					if(checkCourseCode($_POST['course_code']) == 0 ){
						$course_code = $_POST['course_code'];
						$_SESSION['course_code'] = $course_code;
					}else{
						array_push($_SESSION['errors'],'This Course Code already exist');
					}
				}
				
		    	if(empty($_POST['course_name'])){ 
					array_push($_SESSION['errors'],'Course Name is Required');
					}else{
					$course_name = $_POST['course_name'];
					$_SESSION['course_name'] = $course_name;

					}

            	if(empty($_POST['course_description'])){ 
					array_push($_SESSION['errors'],'Course Description is Required');
					}else{
					$course_description = $_POST['course_description'];
					$_SESSION['course_description'] = $course_description;
	             	}

					
				if(empty($_POST['total_sections'])){ 
					array_push($_SESSION['errors'],'File the Total Sections Field');
					}else{
					$total_sections = $_POST['total_sections'];
					$_SESSION['total_sections'] = $total_sections;
						}

				if(empty($_POST['total_chapters'])){ 
					array_push($_SESSION['errors'],'Fill the Total Chapter Field');
					}else{
					$total_chapters = $_POST['total_chapters'];
					$_SESSION['total_chapters'] = $total_chapters;
						}	 

				if(empty($_POST['total_concepts'])){ 
					array_push($_SESSION['errors'],'Fill the Total Concepts Field');
					}else{
					$total_concepts= $_POST['total_concepts'];
					$_SESSION['total_concepts'] = $total_concepts;
						}	 
				if(empty($_POST['credit_hours'])){ 
					array_push($_SESSION['errors'],'Credit Hours are Required');
					}else{
					$credit_hours= $_POST['credit_hours'];
					$_SESSION['credit_hours'] = $credit_hours;

				}

				if(empty($_POST['defined_by'])){ 
					array_push($_SESSION['errors'],'Defined By is Required');
					}else{
					$defined_by = $_POST['defined_by'];
					$_SESSION['defined_by'] = $defined_by;
	
					}
			
                $createdDate=date('Y-m-d');
				/*  -------------------------------------------Insertion Query for adding new Course--------------------------------*/
			
			
	

$query="INSERT INTO Courses (course_code,course_name,course_description,total_sections,total_chapters,total_concepts,credit_hours,defined_by,defined_dated)VALUES('$course_code','$course_name','$course_description','$total_sections','$total_chapters','$total_concepts','$credit_hours','$defined_by','$createdDate')";
	if(count($_SESSION['errors']) == 0){

			$result =sqlsrv_query($conn,$query);
					
				if($result){
					$sqlID = "SELECT @@IDENTITY AS courseID";
					$params = array();
					$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
					$stmt = sqlsrv_query( $conn, $sqlID , $params, $options );
					$result =sqlsrv_query($conn,$sqlID);
					$row = sqlsrv_fetch_array( $stmt);
					$courseID = $row['courseID'];
					$_SESSION['Succesmsg'] = "New Course Added";
					unsetSessions();
					/*------------------------------------Redirecting page to courses Details affer course Adding--------------------*/
				
				
					header("location:courses-details.php?courseID=".$courseID);
					
					exit();
					
				}
			}
			}
			?> 

			<div class="reg-wrapper reg-page Add-Courses">
				<div class="reg-outer">
					<div class="reg-inner">

			<div id="Add-Courses" class="tabcontent">
			<?php
include('top.html');?>		
					<?php if(isset($_SESSION['errors'])){
						$errors = $_SESSION['errors'];
						foreach($errors as $error){
							?>
							<div class="alert alert-danger" role="alert">
							<?php echo $error;?>
</div>
							

							<?php
						}
						unset($_SESSION['errors']);
					}
					
					?>
						<!--------------Creating Form------------>
		<form action="" method="POST"  enctype="multipart/form-data">
		<div class="alert alert-success text-center mt-n4"  style="background-color:#286029; color:white;>
	    	<i class="fas fa-book-open" style="color: #fff";" > </i> Please Provide Course Information
		</div>
                <div class="form-group">
					<label for="">Course Code </label>
					<input type="text" class="form-control" id="Coursecode" name="course_code" placeholder="for Example 789" value="<?php echo $course_code; ?>" >
				</div>
				<div class="form-group">
					<label for="">Course Name</label>
					<input type="text" class="form-control" id="Coursename" name="course_name" placeholder="for Example سیرت نبوی" value="<?php echo $course_name; ?>" >
				</div>
			
				<div class="form-group">
					<label for=""> Course Description</label>
					<textarea class="form-control"  id="CourseDescription" name="course_description" placeholder="Basic Description About Course"value="<?php echo $course_description; ?>"></textarea>
				</div>

				 <div class="form-group">
					<label>Total Sections</label>
					<input class="form-control"  id="totalsections" name="total_sections" placeholder="Total Sections this Course Contains"value="<?php echo $total_sections; ?>">
				</div> 

				<div class="form-group">
					<label>Total Chapters</label>
					<input class="form-control"  id="totalchapters" name="total_chapters" placeholder="Total Chapters this Course Contains"value="<?php echo $total_chapters; ?>">
				</div> 


				<div class="form-group">
					<label>Total Concepts</label>
					<input class="form-control"  id="totalconcepts" name="total_concepts" placeholder="Total Concepts this Course Contains"value="<?php echo $total_concepts; ?>">
				</div> 


				 <div class="form-group">
					<label for=""> Credit Hours</label>
					<input class="form-control"  id="CourseHours" name="credit_hours" placeholder="Total Credit Hours of Course"value="<?php echo $credit_hours; ?>">
                 </div>

				<div class="form-group">
					<label>Defined By</label>
					<input class="form-control"  id="DefinedBy" name="defined_by" placeholder="There Name of Person who is going to define this Course"value="<?php echo $defined_by; ?>">
				</div>
		        
			   <div class="form-group">
				<input id="offer-btn" type="submit" class="ex-btn" name="Add-Course" value="Add Course" >
				</div>
				<br>
				</form>
</div>
</div>
	</div>
	</div>
		</div>
  
		<?php require('./hf/footerNOMAN.php'); ?>


