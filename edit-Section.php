<?php require('./hf/header.php'); //Muallim's Main Header ?>
<?php require('./panel-header.php'); //Muallim's Panel Header ?>
<script src="./js/function.js"></script>
<?php  $sectionID = ""; 

$section_name=$section_no = $section_description = $total_chapters = $learning_effort= $section_prerequisite ="";

if(isset($_GET['sectionID']) && $_GET['sectionID'] != "" && isset($_GET['courseID']) && $_GET['courseID'] !=""){
    $courseID = $_GET['courseID'];
    $sectionID = $_GET['sectionID'];

    $sql = "SELECT * FROM Sections WHERE section_id = '$sectionID'";
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt = sqlsrv_query( $conn, $sql , $params, $options );
    $result =sqlsrv_query($conn,$sql);

    $row_count = sqlsrv_num_rows( $stmt );
    if($row_count == 1){
        if($row = sqlsrv_fetch_array( $stmt)){
            $section_name = $row['section_name'];
			$section_no = $row['section_no'];
           $section_description=$row['section_description'];
            $section_prerequisite=$row['section_prerequisite'];
			$total_chapters=$row['total_chapters'];
			$learning_effort=$row['learning_effort'];
			
        }
    }else{
 
        header("location:courses-details.php");
        exit();
    }
    

}else{
    header("location:courses-details.php");
    exit();
}

 if(!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0){
	$_SESSION['errors'] = array();
}

if(isset($_POST['SaveChanges'])){ 
	
	if(empty($_POST['section_no'])){
		array_push($_SESSION['errors'],'Section No is Required');
	}else{
		if(checkSectionNoExist($_POST['section_no'],$sectionID) == 0 ){
			$section_no = $_POST['section_no'];
			$_SESSION['section_no'] = $section_no;
		}else{
			array_push($_SESSION['errors'],' Section No already exists');
		}
	}
	

	if(empty($_POST['section_name'])){ 
		array_push($_SESSION['errors'],'Section Name is Required');
	}else{
		$section_name = $_POST['section_name']; 
	}

    if(empty($_POST['section_description'])){ 
		array_push($_SESSION['errors'],'Section Description is Required');
	}else{
		$section_description = $_POST['section_description']; 
	}
        
    if(empty($_POST['total_chapters'])){ 
		array_push($_SESSION['errors'],'total Chapters are Required ');
	}else{
		$total_chapters= $_POST['total_chapters']; 
	}

	if(empty($_POST['learning_effort'])){ 
		array_push($_SESSION['errors'],'Learning effort is  Required ');
	}else{
		$learning_effort= $_POST['learning_effort']; 
	}

	
		$section_prerequisite= $_POST['section_prerequisite']; 

                
		
$query = "UPDATE Sections SET section_no = '$section_no',section_name='$section_name',section_prerequisite='$section_prerequisite',total_chapters='$total_chapters',learning_effort='$learning_effort',section_description='$section_description' WHERE course_id='$courseID' AND section_id = '$sectionID'";

if(count($_SESSION['errors']) == 0){

$result =sqlsrv_query($conn,$query);

	if($result){
		$_SESSION['successMsg'] = "Section Updated Successfully";
		header("location:courses-details.php?courseID=".$courseID);
		exit();
	}
}
}
?> 

<div class="reg-wrapper reg-page Add-Courses">
	<div class="reg-outer">
		<div class="reg-inner">

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
             	<form action="edit-Section.php?courseID=<?php echo $courseID; ?>&sectionID=<?php echo $sectionID; ?>" method="POST"  enctype="multipart/form-data">
			
													
					<div class="alert alert-success text-center">
					<i class="fas fa-pen "> </i>          Update Section 
					</div>
					<div class="form-group">
						<label for="">Section name</label>
						<input type="text" class="form-control" id="Sectionname" name="section_name" placeholder="Section name" value="<?php echo $section_name; ?>" >
					</div>
					<div class="form-group">
						<label for="">Section no</label>
						<input type="text" class="form-control" id="Sectionno" name="section_no" placeholder="Section Number" value="<?php echo $section_no; ?>" >
					</div>
                    <div class="form-group">
						<label for="">Section Description</label>
						<input type="text" class="form-control" id="Sectiondescription" name="section_description" placeholder="section_description" value="<?php echo $section_description; ?>" >
					</div>
					<div class="form-group">
					<label for="">Total Chapters</label>
					<input type="text" class="Total Chapters" id="TotalSChapters" name="total_chapters" placeholder="Total Chapters" value="<?php echo $total_chapters; ?>">
				</div>
				<div class="form-group">
						<label for="">Learning Effort</label>
						<input type="text" class="form-control" id="Learningeffort" name="learning_effort" placeholder="Learning effort" value="<?php echo $learning_effort ?>" >
					</div>    
					<!------------ Data fetching for section Prerequiste ------->
					<?php 
								$query="SELECT section_id,section_no,section_name FROM Sections WHERE course_id='$courseID' AND section_id != '$sectionID' ORDER BY section_id DESC";
								
								$params = array();
								
								$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
								$stmt = sqlsrv_query( $conn, $query , $params, $options );
								$result =sqlsrv_query($conn,$query);
								$row_count = sqlsrv_num_rows( $stmt );?>
                               <div class="form-group">
				                         <label>Section Prerequisite <span class="text-danger">*</span></label>
	                                     <select class="form-control" name="section_prerequisite" required>
										<!------------ Data fetching for section Prerequiste ------->
										<?php if($row_count>0){
										?>
										<option <?php if($section_prerequisite == $row['section_id']){echo "selected";} ?> value="0">NO PREREQUISITE</option>
										<?php
										while ( $row = sqlsrv_fetch_array( $stmt)):
										?>
										<option <?php if($section_prerequisite == $row['section_id']){echo "selected";} ?> class="text-capitalize" value="<?php echo $row['section_id']?>" >
										<?php echo $row['section_no']." - ".$row['section_name']?>
										</option>
										<?php
										endwhile;
									}else{
											?>
											<option value="0">NO PREREQUISITE</option>
											<?php 
										}
                                       ?>
                                      </select>
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