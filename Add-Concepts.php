<?php 
require('./hf/header.php');

 if(!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0){
	$_SESSION['errors'] = array();
}
function unsetSessions(){
	unset($_SESSION['concept_no']);
	unset($_SESSION['concept_name']);
	unset($_SESSION['concept_text']);

}
 $concept_no =$concept_name =$concept_text=$chapter_id= $sectionID = $courseID="";

	if(isset($_GET['chapter_id']) && $_GET['chapter_id'] != "" && isset($_GET['sectionID']) && $_GET['sectionID'] != "" && isset($_GET['courseID']) && $_GET['courseID'] != ""){
		$courseID = $_GET['courseID'];
		$sectionID = $_GET['sectionID'];
		$chapter_id = $_GET['chapter_id'];
	
	
	}else{
		header("location:Chapter-details.php");
		exit();
	}
if(isset($_POST['concept'])){ 
	
	if(empty($_POST['concept_no'])){ 
		array_push($_SESSION['errors'],'Concept No is Required');
	}else{
        if(checkConceptNoExist($_POST['concept_no']) == 0 ){
            $concept_no = $_POST['concept_no'];
            $_SESSION['concept_no'] = $concept_no;
        }else{
            array_push($_SESSION['errors'],'Concept No already exists');
        }
    }


	if(empty($_POST['concept_name'])){
		array_push($_SESSION['errors'],'Concept Name is Required');
	}else{
	
			$concept_name = $_POST['concept_name'];
            $_SESSION['concept_name']=$concept_name;
	
	}
	if(empty($_POST['concept_text'])){ 
		array_push($_SESSION['errors'],'Concept text is Required');
	}else{
		$concept_text= $_POST['concept_text']; 
        $_SESSION['concept_text']=$concept_text;
	}

	if(count($_SESSION['errors']) == 0){                                            

	  $query="INSERT INTO Concepts(concept_no,concept_name,concept_text,course_id,section_id,chapter_id
				) VALUES (
				'$concept_no','$concept_name','$concept_text','$courseID','$sectionID','$chapter_id')";
				$result =sqlsrv_query($conn,$query);
		    	
				if($result){

				    $_SESSION['successMsg'] = "New concept  Added";
				
					header("location:Chapter-details.php?sectionID=".$sectionID."&courseID=".$courseID."&chapter_id=".$chapter_id);
                	exit();
						
			     }
                 
	
				
        }
			
		
        }
    

?> 
<script src="./js/function.js"></script>
<div class="reg-wrapper reg-page Add-Concepts">
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
              	<form action="Add-Concepts.php?courseID=<?php echo $courseID; ?>&sectionID=<?php echo $sectionID; ?>&chapter_id=<?php echo $chapter_id;?>" method="POST" id="" role="form" enctype="multipart/form-data"> 
                <div class="form-group">
				<div class="alert alert-success text-center mt-n4"  style="background-color:#286029; color:white;">
              <i class="fas fa-book-open"> </i   >Please fill information about Concepts
              </div>
					
					<div class="form-group">
						<label for="">Concept No</label>
						<input type="text" class="form-control" id="concept_no" name="concept_no" placeholder="Concept No i.e: 1"value="<?php echo $concept_no?>">
					</div>
					<div class="form-group">
						<label for="">Concept Name</label>
						<input type="text" class="form-control" id="concept_name" name="concept_name" placeholder="Concept Name i.e: XYZ" value="<?php echo $concept_name; ?>">
					</div>
                    <div class="form-group">
						<label for="">Concept Text</label>
						<textarea class="form-control" id="concept_text" name="concept_text" placeholder="Full Description of text" rows="4"></textarea>
	                </div>
			
                        <div class="form-group">
						<input id="SaveChapter-btn" type="submit" class="ex-btn" name="concept" value="Add Concept">
					</div>

</form>
  
 	</div>
	</div>
	<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/Event.js"></script>
<head>

