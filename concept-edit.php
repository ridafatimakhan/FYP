<?php require('./hf/header.php'); //Muallim's Main Header ?>
<?php require('./panel-header.php'); //Muallim's Panel Header ?>
<script src="./js/function.js"></script>
<?php  $sectionID =$courseID =$concept_id= ""; 

$concept_name=$concept_no = $concept_text="";

if(isset($_GET['sectionID']) && $_GET['sectionID'] != "" && isset($_GET['courseID']) && $_GET['courseID'] !="" && isset($_GET['chapter_id']) && $_GET['chapter_id'] !=""  && isset($_GET['concept_id']) && $_GET['concept_id'] !=""){
    $courseID = $_GET['courseID'];
    $sectionID = $_GET['sectionID'];
    $chapter_id = $_GET['chapter_id'];
    $concept_id = $_GET['concept_id'];

    $sql = "SELECT * FROM Concepts WHERE concept_id = '$concept_id'";
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt = sqlsrv_query( $conn, $sql , $params, $options );
    $result =sqlsrv_query($conn,$sql);

    $row_count = sqlsrv_num_rows( $stmt );
    if($row_count == 1){
        if($row = sqlsrv_fetch_array( $stmt)){
           
			$concept_no = $row['concept_no'];
            $concept_name = $row['concept_name'];
           $section_text=$row['concept_text'];
			
        }
    }else{
 
        header("location:Chapter-details.php");
        exit();
    }
    

}else{
    header("location:Chapter-details.php");
    exit();
}

 if(!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0){
	$_SESSION['errors'] = array();
}

if(isset($_POST['SaveChanges'])){ 
	
	if(empty($_POST['concept_no'])){
		array_push($_SESSION['errors'],'Concept No is Required');
	}else{
		if(checkConceptNoExist($_POST['concept_no'],$concept_id) == 0 ){
			$concept_no = $_POST['concept_no'];
			$_SESSION['concept_no'] = $concept_no;
		}else{
			array_push($_SESSION['errors'],' concept No already exists');
		}
	}
	

	if(empty($_POST['concept_name'])){ 
		array_push($_SESSION['errors'],'Concept Name is Required');
	}else{
        $concept_name = $_POST['concept_name']; 
	}

    if(empty($_POST['concept_text'])){ 
		array_push($_SESSION['errors'],'Concept Text is Required');
	}else{
		$concept_text= $_POST['concept_text']; 
	}
            
		
 $query = "UPDATE Concepts SET concept_no = '$concept_no',concept_name='$concept_name',concept_text='$concept_text' WHERE course_id='$courseID' AND section_id = '$sectionID'  AND chapter_id = '$chapter_id' AND concept_id = '$concept_id'";

if(count($_SESSION['errors']) == 0){

$result =sqlsrv_query($conn,$query);
	if($result){
		$_SESSION['successMsg'] = "Concept Updated Successfully";
		header("location:Chapter-details.php?courseID=".$courseID."&sectionID=".$sectionID."&chapter_id=".$chapter_id);
		exit();
	}
}
}
?> 

<div class="reg-wrapper reg-page Add-Courses">
	<div class="reg-outer">
		<div class="reg-inner">

<div id="" class="tabcontent">
	
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
             	<form action="concept-edit.php?courseID=<?php echo $courseID; ?>&sectionID=<?php echo $sectionID; ?>&chapter_id=<?php echo $chapter_id;?>&concept_id=<?php echo $concept_id;?>" method="POST"  enctype="multipart/form-data">
			
													
					<div class="alert alert-info text-center">
					<i class="fas fa-pen "> </i>    Update Concepts 
					</div>
					<div class="form-group">
						<label for="">Concept No</label>
						<input type="text" class="form-control" id="conceptno" name="concept_no" placeholder="Concept no" value="<?php echo $concept_no; ?>" >
					</div>
                    <div class="form-group">
						<label for="">Concept name</label>
						<input type="text" class="form-control" id="conceptname" name="concept_name" placeholder="Concept name" value="<?php echo $concept_name; ?>" >
					</div>
                    <div class="form-group">
						<label for="">Concept Text</label>
						<input type="text" class="form-control" id="concepttext" name="concept_text" placeholder="Concept name" value="<?php echo $concept_name; ?>" >
					</div>

                    <div class="form-group">
<input id="offer-btn" type="submit" class="ex-btn" name="SaveChanges" value="Update Concepts" >
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