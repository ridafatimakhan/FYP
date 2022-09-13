<?php 
require('./hf/header.php');
 if(!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0){
	$_SESSION['errors'] = array();
}
function unsetSessions(){
	unset($_SESSION['chapter_name']);
	unset($_SESSION['chapter_no']);
	unset($_SESSION['chapter_description']);
	unset($_SESSION['total_concepts']);
	unset($_SESSION['chapter_description']);
	unset($_SESSION['chapter_pdf']);


}
$chapter_name = $chapter_no =$total_concepts= $chapter_description=$section_id =$courseID =$chapter_pdf="";

if(isset($_GET['sectionID']) && $_GET['sectionID'] != "" && isset($_GET['courseID']) && $_GET['courseID'] != ""){
    $courseID = $_GET['courseID'];
	$sectionID = $_GET['sectionID'];
 
}else{
    header("location:section-details.php");
    exit();
}
if(isset($_POST['Chapter'])){ 
	
	
	if(empty($_POST['chapter_name'])){ 
		array_push($_SESSION['errors'],'Chapter Name is Required');
	}else{
		$chapter_name = $_POST['chapter_name']; 
	}


	if(empty($_POST['chapter_no'])){
		array_push($_SESSION['errors'],'Chapter No is Required');
	}else{
	
			$chapter_no = $_POST['chapter_no'];
	
	}
	

	if(empty($_POST['total_concepts'])){ 
		array_push($_SESSION['errors'],'Total Concepts are Required');
	}else{
		$total_concepts = $_POST['total_concepts']; 
	}
	
	if(empty($_POST['chapter_description'])){ 
		array_push($_SESSION['errors'],'Chapter Description is Required');
	}else{
		$chapter_description= $_POST['chapter_description']; 
	}
	


			$chapterpdf = "";
			if(basename($_FILES["chapterpdf"]["name"]) !=""){

				
			$target_dir = "uploads/uploadchapters/";

			$target_file = $target_dir .time()."_". basename($_FILES["chapterpdf"]["name"]);

			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));	
			if($imageFileType != "pdf" && $imageFileType != "docx"  ) {
			array_push($_SESSION['errors'],"Sorry, only pdf files are allowed.");

			}
          	
	
	
			if(count($_SESSION['errors']) == 0){
				if (move_uploaded_file($_FILES["chapterpdf"]["tmp_name"], $target_file)) {
	$query="INSERT INTO Chapters(chapter_name,chapter_no,total_concepts,chapter_description
				,section_id,course_id,chapter_pdf) VALUES (
				'$chapter_name','$chapter_no','$total_concepts','$chapter_description','$sectionID','$courseID','$target_file')"; 

$result =sqlsrv_query($conn,$query);
		
	
				if($result){
				    $_SESSION['successMsg'] = "New Chapter  Added";
					header("location:section-details.php?courseID=".$courseID."&sectionID=".$sectionID);
					exit();
				}			
			}
			}else{
			array_push($_SESSION['errors'],'Please');

			}
			
		}


}
?> 

<script src="./js/function.js"></script>
<div class="reg-wrapper reg-page">
	<div class="reg-outer">
		<div class="reg-inner">
		<div id="Add-Chapters" class="tabcontent">
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
              	<form action="Add-Chapters.php?courseID=<?php echo $courseID; ?>&sectionID=<?php echo $sectionID; ?>" method="POST" id="" role="form" enctype="multipart/form-data"> 
                <div class="form-group">
				<div class="alert alert-success text-center mt-n4"  style="background-color:#286029; color:white;">
                <i class="fas fa-book-open"> </i> Please Provide Information for Chapter
                </div>
					
					<div class="form-group">
						<label for="">Chapter Name</label>
						<input type="text" class="form-control" id="chapter_name" name="chapter_name" placeholder="Chapter Name"value="<?php echo $chapter_name ?>">
					</div>
					<div class="form-group">
						<label for="">Chapter No</label>
						<input type="text" class="form-control" id="chapter_no" name="chapter_no" placeholder="Chapters No" value="<?php echo $chapter_no; ?>">
					</div>
                    <div class="form-group">
						<label for="">Total Concepts</label>
						<input type="text" class="form-control" id="TotalConcepts" name="total_concepts" placeholder="Total Concepts" value="<?php echo $total_concepts; ?> ">
					</div>
					<div class="form-group">
						<label for="">Chapter Description</label>
						<textarea type="text" class="form-control" id="chapterdescription" name="chapter_description" placeholder="Chapter Description"value="<?php echo $chapter_description;?>"></textarea>
					</div>

				
					




					<div class="form-group">
						<label for="">Upload  Chapter</label>
						<input style="width:100%;" type="file" name="chapterpdf">
						</div>
										
                        <div class="form-group">
						<input id="SaveChapter-btn" type="submit" class="ex-btn" name="Chapter" value="Add Chapter">
					</div>

</form>
  
 	</div>
	</div>
	<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/Event.js"></script>
<head>
