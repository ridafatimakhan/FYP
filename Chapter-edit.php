<?php require('./hf/header.php'); //Muallim's Main Header ?>
<?php require('./panel-header.php'); //Muallim's Panel Header ?>
<script src="./js/function.js"></script>
<?php 

$sectionID=$chapter_name=$total_concepts=$chapter_description=$chapter_id=$courseID=$chapter_pdf=""; 
if(isset($_GET['sectionID']) && $_GET['sectionID'] != "" && isset($_GET['courseID']) && $_GET['courseID'] !="" && $_GET['chapter_id'] && $_GET['chapter_id'] != ""){
    $courseID = $_GET['courseID'];
    $sectionID = $_GET['sectionID'];
    $chapter_id= $_GET['chapter_id'];
    $sql = "SELECT * FROM Chapters WHERE chapter_id= '$chapter_id'";
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt = sqlsrv_query( $conn, $sql , $params, $options );
    $result =sqlsrv_query($conn,$sql);

    $row_count = sqlsrv_num_rows( $stmt );
    if($row_count == 1){
        if($row = sqlsrv_fetch_array( $stmt)){
            $chapter_name = $row['chapter_name'];
			$chapter_no = $row['chapter_no'];
           $chapter_description=$row['chapter_description'];
            $sectionID = $row['section_id'];
            $chapter_id = $row['chapter_id'];
            $chapter_pdf = $row['chapter_pdf'];
			
        }
    }else{
 
        header("location:chapters-details.php");
        exit();
    }
    

}else{
    header("location:courses-details.php");
    exit();
}

 if(!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0){
	$_SESSION['errors'] = array();
}

if(isset($_POST['Chapter'])){ 
	
	if(empty($_POST['chapter_no'])){
		array_push($_SESSION['errors'],'Chapter No is Required');
	}else{
			$chapter_no = $_POST['chapter_no'];
		

		}
	
	

	if(empty($_POST['chapter_name'])){ 
		array_push($_SESSION['errors'],'Chapter Name is Required');
	}else{
		$chapter_name = $_POST['chapter_name']; 
	}

    if(empty($_POST['chapter_description'])){ 
		array_push($_SESSION['errors'],'Section Description is Required');
	}else{
		$chapter_description = $_POST['chapter_description']; 
	}
        
    if(empty($_POST['total_concepts'])){ 
		array_push($_SESSION['errors'],'total concepts are Required ');
	}else{
		$total_concepts= $_POST['total_concepts']; 
	}


 
		
$query = "UPDATE Chapters SET chapter_no = '$chapter_no',chapter_name='$chapter_name',chapter_description='$chapter_description' ,total_concepts='$total_concepts',chapter_pdf='$chapter_pdf' WHERE course_id='$courseID' AND section_id = '$sectionID' AND chapter_id = '$chapter_id'";
/*   echo $query;
 die();  */
if(count($_SESSION['errors']) == 0){

$result =sqlsrv_query($conn,$query);
	if($result){
		$_SESSION['successMsg'] = "chapter Updated Successfully";
		header("location:section-details.php?courseID=".$courseID."&sectionID=".$sectionID."&chapter_id=$chapter_id");
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
             	<form action="Chapter-edit.php?courseID=<?php echo $courseID; ?>&sectionID=<?php echo $sectionID; ?>&chapter_id=<?php echo $chapter_id; ?>" method="POST"  enctype="multipart/form-data">
			
				     <div class="form-group">
					
					<div class="form-group">
						<label for="">Chapter Name</label>
						<input type="text" class="form-control" id="chapter_name" name="chapter_name" placeholder="Chapter Name"value="<?php echo $chapter_name ?>">
					</div>
					<div class="form-group">
						<label for="">Chapter No</label>
						<input type="text" class="form-control" id="chapter_no" name="chapter_no" placeholder="chapter_no" value="<?php echo $chapter_no; ?>">
					</div>
                    <div class="form-group">
						<label for="">Total Concepts</label>
						<input type="text" class="form-control" id="TotalConcepts" name="total_concepts" placeholder="total_concepts" value="<?php echo $total_concepts; ?> ">
					</div>
					<div class="form-group">
						<label for="">Chapter Description</label>
						<input type="text" class="form-control" id="chapterdescription" name="chapter_description" placeholder="chapterdescription"value="<?php echo $chapter_description;?>">
					</div>




         


					<div class="form-group">
						<label for="">Upload  Chapter</label>
						<input style="width:100%;" type="file" name="chapter_pdf">
						</div>
                        <div class="form-group">
						<input id="SaveChapter-btn" type="submit" class="ex-btn" name="Chapter" value="Add Chapter">
					</div>

</form>
  
 	</div>
	</div>
