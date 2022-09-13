<?php require('./hf/header.php'); //Muallim's Main Header ?>
<?php require('./panel-header.php'); //Muallim's Panel Header ?>
<script src="./js/function.js"></script>
<?php 
$ocid = $offer_date = $course_duration="";

if(isset($_GET['ocid ']) && $_GET['ocid'] != ""){
    echo "hi";
    die();
    $ocid  = $_GET['ocid'];
    echo $ocid;
    die();
    $sql = "SELECT * FROM OfferCourse WHERE ocid = '$ocid'";
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt = sqlsrv_query( $conn, $sql , $params, $options );
    $result =sqlsrv_query($conn,$sql);

    $row_count = sqlsrv_num_rows( $stmt );
    if($row_count == 1){
        if($row = sqlsrv_fetch_array( $stmt)){
            $course_duration = $row['course_duration'];
            $offercourse = $row['offercourse'];
          

        }
    }else{
        header("location:viewcoursesoffered.php");
        exit();
    }
    

}else{
    header("location:viewcoursesoffered.php");
    exit();
}

 if(!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0){
	$_SESSION['errors'] = array();
}

if(isset($_POST['SaveChanges'])){ 
	

	

if(empty($_POST['course_duration'])){ 
	array_push($_SESSION['errors'],'course Description is Required');
	}else{
	$course_duration = $_POST['course_duration']; 
	}

 	



		
$query = "UPDATE OfferCourse SET course_duration = '$course_duration'";
/* echo $query;
die(); */
if(count($_SESSION['errors']) == 0){

$result =sqlsrv_query($conn,$query);
	if($result){
		$_SESSION['successMsg'] = "Course Updated Successfully";
		header("location:Courses.php");
		exit();
	}
}
}
?> 

<div class="reg-wrapper reg-page ">
	<div class="reg-outer">
		<div class="reg-inner">
		<div style="border: 1px solid #E1E1E1; text:bold black; padding: 2px;5px; text-size:19px; box-shadow: 0 1px 4px ;background;white;margin:15px;   display: inline-block;width:50.5%;">
		<i class="fas fa-pencil-alt"></i>Course Update
</div>
<div id="Edit-Courses" class="tabcontent">

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
						<input type="text" class="form-control" id="course_description" name="course_description" placeholder="course_description" value="<?php echo $course_description; ?>" >
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