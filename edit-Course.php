<?php require('./hf/header.php'); //Muallim's Main Header ?>
<?php require('./panel-header.php'); //Muallim's Panel Header ?>
<script src="./js/function.js"></script>
<?php $courseID = $course_name = ""; 

$course_code = $course_name = $course_description = $total_sections = $total_chapters = $total_concepts = $defined_by = $defined_date= " ";

if(isset($_GET['courseID']) && $_GET['courseID'] != ""){
			$courseID = $_GET['courseID'];
			$sql = "SELECT * FROM Courses WHERE course_id = '$courseID'";
			$params = array();
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$stmt = sqlsrv_query( $conn, $sql , $params, $options );
			$result =sqlsrv_query($conn,$sql);
           $row_count = sqlsrv_num_rows( $stmt );
			if($row_count == 1){
				if($row = sqlsrv_fetch_array( $stmt)){
					$course_name = $row['course_name'];
					$course_code = $row['course_code'];
					$course_description = $row['course_description'];
					$total_chapters = $row['total_concepts'];
					$total_sections = $row['total_sections'];
					$total_concepts= $row['total_concepts'];
					$credit_hours= $row['credit_hours'];
					$defined_by= $row['defined_by'];

				}
			}else{
				header("location:Courses.php");
				exit();
			}
			
        }else{
			header("location:Courses.php");
			exit();
		}

		if(!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0){
			$_SESSION['errors'] = array();
		}

		if(isset($_POST['SaveChanges'])){ 
			
			if(empty($_POST['course_code'])){
				array_push($_SESSION['errors'],'Course Code is Required');
			}else{
				if(checkCourseCode($_POST['course_code'],$courseID) == 0 ){
					$course_code = $_POST['course_code'];
				}else{
					array_push($_SESSION['errors'],'This Course Code already exist');
				}
			}

		
			if(empty($_POST['course_name'])){ 
				array_push($_SESSION['errors'],'Course Name is Required');
				}else{
				$course_name= $_POST['course_name']; 
				}
        if(empty($_POST['course_name'])){ 
			array_push($_SESSION['errors'],'Course Name is Required');
			}else{
			$course_name = $_POST['course_name']; 
			}
        if(empty($_POST['total_sections'])){ 
				array_push($_SESSION['errors'],'Fill the Total Sections Field');
				}else{
				$total_sections = $_POST['total_sections'];
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
			$_SESSION['credit_hours'] = $total_concepts;
			}	 
		if(empty($_POST['credit_hours'])){ 
		array_push($_SESSION['errors'],'Credit Hours are Required');
			}else{
		$credit_hours= $_POST['credit_hours'];
		$_SESSION['credit_hours'] = $credit_hours;

		}


	
$createdDate=date('Y-m-d');


	


		
$query = "UPDATE Courses SET course_code ='$course_code',course_name='$course_name',course_description='$course_description',total_sections='$total_sections',total_chapters='$total_chapters',total_concepts='$total_concepts', credit_hours='$credit_hours',defined_by='$defined_by' WHERE course_id ='$courseID'";

if(count($_SESSION['errors']) == 0){

$result =sqlsrv_query($conn,$query);
	if($result){
		$_SESSION['successUpdateMsg'] = "Course Updated Successfully";
	
		header("location:Courses.php");
		
		exit();
	}
}
}
?> 

<div class="reg-wrapper reg-page ">
	<div class="reg-outer">
		<div class="reg-inner">

<div id="Edit-Courses" class="tabcontent">
<div class="alert alert-success text-center">
								<i class="fas fa-book-pencil"> </i   > Add Changes to your Course
					</div>
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
		} ?>
             	<form action="edit-Course.php?courseID=<?php echo $courseID; ?>" method="POST"  enctype="multipart/form-data">
			
				<div class="form-group">
					<label for="">Course Code </label>
					<input type="text" class="form-control" id="" name="course_code" placeholder="Course Code" value="<?php echo $course_code; ?>" >
				</div>
				<div class="form-group">
					<label for="">Course Name</label>
					<input type="text" class="form-control" id="Coursename" name="course_name" placeholder="CourseName" value="<?php echo $course_name; ?>" >
				</div>
				<div class="form-group">
					<label for="">Course Description</label>
					<input type="text" class="form-control" id="course_description" name="course_description" placeholder="course_description" value="<?php echo $course_description; ?>">
				</div>
				<div class="form-group">
			    <label>Total Sections</label>
				<input class="form-control"  id="totalsections" name="total_sections" placeholder="Total Sections a Course Contains"value="<?php echo $total_sections; ?> " ></input>
				</div> 

				<div class="form-group">
			    <label>Total Chapters</label>
				<input class="form-control"  id="totalchapters" name="total_chapters" placeholder="Total Chapters a Course Contains"   value="<?php echo $total_chapters; ?> " ></input>
				</div> 


				<div class="form-group">
			    <label>Total Concepts</label>
				<input class="form-control"  id="totalconcepts" name="total_concepts" placeholder="Total Concepts a Course Contains"   value="<?php echo $total_concepts; ?> " ></input>
				</div> 


				 <div class="form-group">
				<label for=""> Credit Hours</label>
                 <input class="form-control"  id="CourseHours" name="credit_hours" placeholder="Total Credit Hours of Course"value="<?php echo $credit_hours; ?>"></input>
                 </div>

				<div class="form-group">
			    <label>Defined By</label>
				<input class="form-control"  id="DefinedBy" name="defined_by" placeholder="There Name of Person who is going to define this Course"value="<?php echo $defined_by; ?>"></input>
				</div>

		<div class="form-group">
		<input id="offer-btn" type="submit" class="ex-btn" name="SaveChanges" value="Save Changes" >
		</div>
		<br>
		</form>

		</div>
	</div>
	<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="./js/Event.js"></script>
<head>
</div>