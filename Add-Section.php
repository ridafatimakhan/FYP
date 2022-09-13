<?php 
require('./hf/header.php');
 if(!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0){
	$_SESSION['errors'] = array();
}
/* Unsetting session variables */
function unsetSessions(){
	unset($_SESSION['section_name']);
	unset($_SESSION['section_no']);
	unset($_SESSION['section_description']);
	unset($_SESSION['total_chapters']);
	unset($_SESSION['learning_effort']);
	unset($_SESSION['section_description']);

}
$section_name = $section_no = $section_description = $total_chapters = $learning_effort = $section_prerequisite=$course_id ="";
$courseID = $courseTitle = $section_id= ""; 

			if(isset($_GET['courseID']) && $_GET['courseID'] != ""){
				$courseID = $_GET['courseID'];
			
			}else{
				header("location:Courses.php");
				exit();
			}

			if(isset($_POST['Section'])){ 
					
				if(empty($_POST['section_name'])){ 
					array_push($_SESSION['errors'],'Section Name is Required');
				}else{
					$section_name = $_POST['section_name']; 
				}

				if(empty($_POST['section_no'])){
					array_push($_SESSION['errors'],'Section No is Required');
				}else{
					if(checkSectionNoExist($_POST['section_no']) == 0 ){
						$section_no = $_POST['section_no'];
						$_SESSION['section_no'] = $section_no;
					}else{
						array_push($_SESSION['errors'],' Section No already exists');
					}
				}
				if(empty($_POST['section_description'])){ 
					array_push($_SESSION['errors'],'Section Description is Required');
				}else{
					$section_description = $_POST['section_description']; 
					$_SESSION['section_description'] = $section_description;
				}
				
				if(empty($_POST['total_chapters'])){ 
					array_push($_SESSION['errors'],'Fill the Total Chapters Field');
				}else{
					$total_chapters = $_POST['total_chapters']; 
					$_SESSION['total_chapters'] = $total_chapters;
				}
				if(empty($_POST['learning_effort'])){ 
					array_push($_SESSION['errors'],'Fill the learning Effort Field');
					
				}else{
					$learning_effort = $_POST['learning_effort']; 
					$_SESSION['learning_effort'] = $learning_effort;
				}
				$section_prerequisite= $_POST['section_prerequisite']; 
				$_SESSION['section_prerequisite']= $section_prerequisite; 

				$course_id = $courseID; 

                              /*----------------Insertion Query for Sections---------------> */
 $query="INSERT INTO Sections(section_name,section_no,section_description,total_chapters,learning_effort,section_prerequisite,course_id) VALUES (
	'$section_name','$section_no','$section_description','$total_chapters','$learning_effort','$section_prerequisite','$course_id')";

if(count($_SESSION['errors']) == 0){
$result =sqlsrv_query($conn,$query);
if($result){
		$sqlID = "SELECT @@IDENTITY AS secID";
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmt = sqlsrv_query( $conn, $sqlID , $params, $options );
		$result =sqlsrv_query($conn,$sqlID);
		$row = sqlsrv_fetch_array( $stmt);
		$secID = $row['secID'];
		
		$_SESSION['successMsg'] = "New Course Section Added";
		unsetSessions();
		header("location:courses-details.php?sectionID=".$secID."&courseID=".$courseID);

		exit();
	}
}
}
?> 
<script src="./js/function.js"></script>
<div class="reg-wrapper reg-page">
	<div class="reg-outer">
		<div class="reg-inner">
		   <div id="Add-Section" class="tabcontent">
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
		        <!------------------------- Forms for section adding------>
              	<form style="font-family:Montserrat ;" action="Add-Section.php?courseID=<?php echo $courseID; ?>" method="POST" id="" role="form">
				<div class="form-group">
				    <div class="alert alert-success text-center mt-n4"  style="background-color:#286029; color:white;">
								<i class="fas fa-book-open"> </i   > Please Provide Section Information
					</div>
								<div class="form-group">
										<label for="">Section name</label>
										<input type="text" class="form-control" id="Sectionname" name="section_name" placeholder="Section name i.e: مکی دور" value="<?php echo $section_name; ?>" >
								</div>
								<div class="form-group">
										<label for="">Section No</label>
										<input type="text" class="form-control" id="Sectionno" name="section_no" placeholder="Section No i.e:2" value="<?php echo $section_no; ?>" >
								</div>
                                <div class="form-group">
										<label for="">Section Description</label>
										<textarea type="text" class="form-control" id="Sectiondescription" name="section_description" placeholder="Basic Description of Section i.e:XYZ"  value="<?php echo $section_description; ?>"></textarea>
							    </div>
				               <div class="form-group">
									    <label for="">Total Chapters</label>
										<input type="text" class="Total Chapters" id="TotalChapters" name="total_chapters" placeholder="No of Chapters included in this Section i.e:12" value="<?php echo $total_chapters; ?>">
							    </div>
							    <div class="form-group">
							            <label for="">Learning Effort</label>
							            <input type="text" class="form-control" id="Learningeffort" name="learning_effort" placeholder="Learning Effort required to Complete this Section i.e: 10 hours" value="<?php echo $learning_effort; ?>">
							     </div>
	<!-------------------------------------- Data fetching for section Prerequiste --------------------------->
								<?php 
								$query="SELECT section_id,section_no,section_name FROM Sections WHERE course_id='$courseID' ORDER BY section_id DESC";
								
								$params = array();
								
								$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
								$stmt = sqlsrv_query( $conn, $query , $params, $options );
								$result =sqlsrv_query($conn,$query);
								$row_count = sqlsrv_num_rows( $stmt );
								print_r(sqlsrv_errors(),true);?>
                                 <div class="form-group">
				                         <label>Section Prerequisite <span class="text-danger">*</span></label>
	                                     <select class="form-control" name="section_prerequisite" required>
										<!------------ Data fetching for section Prerequiste ------->
										<?php if($row_count>0){
										while ( $row = sqlsrv_fetch_array( $stmt)):
										?>
										<option class="text-capitalize" value="<?php echo $row['section_id']?>" >
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
					                    <input id="SaveSection-btn" type="submit" class="ex-btn" name="Section" value="Add-Sections">
					           </div>	
          </form>
		</div>
	</div>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="./js/Event.js"></script>
<head>