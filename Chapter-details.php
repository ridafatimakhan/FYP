<?php require('./hf/header.php'); //Muallim's Main Header ?>
<?php require('./panel-header.php'); //Muallim's Panel Header ?>
<script src="./js/function.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
<style>
.table table-striped table-success a {
color:green;

}
</style>

<?php
include('top.html');
$sectionID = $chapter_name = $total_concepts = $chapter_description = $chapter_id = $courseID = $chapter_pdf = "";
if (isset($_GET['sectionID']) && $_GET['sectionID'] != "" && $_GET['courseID'] && $_GET['courseID'] != "" && $_GET['chapter_id'] && $_GET['chapter_id'] != "") {


	$courseID = $_GET['courseID'];
	$sectionID = $_GET['sectionID'];
	$chapter_id = $_GET['chapter_id'];

	$sql = "SELECT * FROM Chapters WHERE chapter_id = '$chapter_id'";
	$params = array();
	$options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET);
	$stmt = sqlsrv_query($conn, $sql, $params, $options);
	$result = sqlsrv_query($conn, $sql);

	$row_count = sqlsrv_num_rows($stmt);
	if ($row_count == 1) {
		if ($row = sqlsrv_fetch_array($stmt)) {
			$course_id = $row['course_id'];
			$sectionID = $row['section_id'];
			$chapter_id = $row['chapter_id'];
			$chapter_no = $row['chapter_no'];
			$chapter_name = $row['chapter_name'];
			$chapter_description = $row['chapter_description'];
			$total_concepts = $row['total_concepts'];
			$chapter_pdf = $row['chapter_pdf'];
			$course_name = getCourseName($row['course_id']);
			$section_name = getSectionName($row['section_id']);
		}
	} else {
		header("location:courses-details.php");
		exit();
	}
} else {
	// header("location:courses-details.php");
	exit();
}
?>

<!-- Muallim's Inner Page Content Start -->
<div class="ip-banner">
	<div class="color-bg"></div>
	<div class="img-bg"></div>
	<div class="container">
		<div class="ip-banner-blurb">
			<div class="courses-btn">
				<a class="ex-btn btn-border" href="#basic"><i class="fas fa-link"></i> Basic Learning</a><br>
				<!-- <a class="ex-btn btn-border" href="#advance"><i class="fas fa-link"></i> Advanced Learning</a> -->
			</div>
		</div>
	</div>
</div>
<div class="bred-contain">
	<div class="container" id="top">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active"><a href="#">Courses</a></li>
		</ol>
	</div>
</div>

<div class="content ip-content">
	<div class="container-fw">
		<?php require('./sidebar-panel.php'); //Muallim's Sidebar 
		?>
		<div class="ip-main">

			<div class="courses-list" id="basic">
				<?php
				if (isset($_SESSION['Succesmsg'])) {
				?>
					<div class="alert alert-danger text-center">

						<i class="fa fa-trash fa-0x" aria-hidden="true"></i>
						<?php echo $_SESSION['Succesmsg'] ?></h5>

					</div>
				<?php  }
				unset($_SESSION['Succesmsg']) ?>

				<ul>
					<?php
					$sql = "SELECT * FROM Concepts WHERE chapter_id = '$chapter_id' ORDER BY concept_id DESC";
					$params = array();
					$options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET);
					$stmt = sqlsrv_query($conn, $sql, $params, $options);
					$result = sqlsrv_query($conn, $sql);

					$row_count = sqlsrv_num_rows($stmt); ?>

<h4 style="color: #286029;	font-family:Calibri; line-height: 45px; background: #fff; border-top: 5px solid #286029;">
					<center><?php echo $chapter_name; ?> </center></h4>

					<table class="table table-striped table-success" style="font-family:Calibiri;

	font-family:Calibri;
 font-size:15px; ">
						<thead>
							<tr>
							<!-- 	<th scope="col">Chapter ID </th> -->
								<th scope="col">Chapter Name</th>
								<th scope="col">Chapter No</th>
								<th scope="col">Total Concepts</th>

								<th scope="col">Section Name</th>
								<th scope="col">Course Name</th>
								<th scope="col">Chapter PDF</th> 
	<th scope="col">Test list</th>
<th scope="col">View Results</th>

							</tr>
						</thead>
						<tbody>
							<tr>
							
								<td style="font-family:Calibiri; "><?php echo  $chapter_name ?> </td>
								<td><?php echo  $chapter_no ?> </td>
								<td><?php echo  $total_concepts ?> </td>

								<td style="font-family:Calibiri;  "><?php echo  $section_name ?> </td>
								<td style="font-family:Calibiri;  "><?php echo  $course_name ?> </td>
						<td> <a   style=" color:green; " id="chapDownload" onclick="chapterReadStatus('<?php echo $chapter_id; ?>','<?php echo $chapter_pdf; ?>')"  href="javascript:;<?php //echo  $chapter_pdf ?> "> Download Pdf File</a></td>
							<td><a  style=" color: green; " href="test-list.php?CourseID=<?php echo $courseID; ?>&SectionID=<?php echo $sectionID; ?>&ChapterID=<?php echo $chapter_id;  ?>">Attempt Test</a> 
								

								</td>
								<td>  	<a style=" color: green; "  href="result.php?CourseID=<?php echo $courseID; ?>&SectionID=<?php echo $sectionID; ?>&ChapterID=<?php echo $chapter_id; ?>&showAll=true">see results</a></td> 
							</tr>
					</table>

					<br>

					<div id="fullView" class="tabcontent active">
						<div id="full-view">

							<div class="arabic-text" style="font-family:Calibiri;font-size:15px;">
								<h4>Chapter Description</h4>

								<div class="verses id">
									<div class="v-blurb">
										<div class="a-txt blurb">
											<div class="a-numb " style="font-family:Calibiri;font-size:30px; "> - <?php echo    $chapter_name;  ?></div>
											<br>
											Download PDF file to read Chapter
										</div>

									</div>

								</div>



							</div>

						</div>


						<div class="alert alert-success " style="background-color:#286029; color:#fff; font:Calibiri;font-size:20px;  height: 60px;">
						Concepts  <strong><?php echo $chapter_name; ?> <strong>
									<?php if ($_SESSION['userRole'] == 'A') { ?>
										<a href="Add-Concepts.php?courseID=<?php echo $courseID ?>&sectionID=<?php echo $sectionID ?>&chapter_id=<?php echo $chapter_id ?>" style=margin-left:80%;margin-top:-7%; type="button" class="btn btn-success btn-lg">Add Concept</a>
										<a href="Add-Assignment.php?courseID=<?php echo $courseID?>&sectionID=<?php echo $sectionID ?>&chapter_id=<?php echo $chapter_id ?>"style="margin-left: 56%; margin-top:-15% " 
 type="button" class="btn btn-success btn-lg"> Add  Assignment</a>
									<?php } ?>
						</div>
						<ul></ul>
						<?php
						if ($row_count > 0) {
							while ($row = sqlsrv_fetch_array($stmt)) {?>


		

  <li>
			<div class="list-inner">
				 <a class="list-blurb">
				  <img class="card-img-top" src="images/Concept1.jpg" alt=""> 
				     <div class="text-center text-success "style="font-family:Calibiri;font-size:20px; "><h2 style="text-decoration:none;"><?php echo $row['concept_name']; ?></h2></div>
				 </a>	
				 <?php   if($_SESSION['userRole'] == 'A') {?>	
				
					<div class="text-center text-success" style="border: 1px solid #E1E1E1; padding:5px;  box-shadow: 0 1px 4px rgb(31 31 31 / 12%);  background: #ffffff; display: inline-block;width: 99.5%;"
					>
					<a class= "text-success"  style="font-weight: normal; text-decoration:none ;"href="#"> View</a>
					<a class= "text-success"  style="font-weight: normal; text-decoration:none; " href="Concept-details.php?courseID=<?php echo $courseID; ?>&sectionID=<?php echo $sectionID ?>&chapter_id=<?php echo $row['chapter_id']; ?>&concept_id=<?php echo $row['concept_id']; ?>"> Edit</a>
					<a class="text-success delete" style=" text-decoration:none; font-weight:normal;" class="delete-confirm" href="DeleteConcept.php?courseID=<?php echo $courseID; ?>&sectionID=<?php echo $row['section_id']; ?>&chapter_id=<?php echo $row['chapter_id']; ?>&concept_id=<?php echo $row['concept_id']; ?>">Delete</a>
					</div>
				<?php } else { ?>
					<div class="text-center text-success" style="border: 1px solid #E1E1E1; padding:5px;  box-shadow: 0 1px 4px rgb(31 31 31 / 12%);  background: #ffffff; display: inline-block;width: 99.5%;">

					<a class= "text-success"  style="font-weight: normal; text-decoration:none; color:#aec4dc;"href="Chapter-details.php?courseID=<?php echo $courseID; ?>&sectionID=<?php echo $sectionID ?>&chapter_id=<?php echo $row['chapter_id']; ?>"> View</a>
	            </div>
				<?php }?>
              </li>
                <?php   }//end of if statment
				}
				 else {
				    ?>
	            <a style="display: inline-block;width: 100%;text-align: center; border-radius:5px; background: red;color: #ffffff;padding: 5px;float:center;margin-left: 5px;">Zero Record Found</a>
	    </li>
		   <?php	}?>
		<br>
		<br>

       </ul>


						<hr class="bg">


				</ul>

			</div>
		</div>
	</div>
	</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

	<script>

		function chapterReadStatus(chapID,path){
			//alert(path);
			$.ajax({
					type: "POST",
					url: 'chapterRead.php',
					data: {
						userid: "<?php echo $_SESSION['userID']; ?>",
						chapID:chapID
					},
					success: function(data) {
						if(data == 1){
							// window.location.href= "'"+path+"'";
							window.open(path, "_blank");

						}
					},
					error: function(xhr, status, error) {
						console.error(xhr);
					}
				});
		}
	</script>
	<?php require('./hf/footerNOMAN.php'); ?>

	

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script type="text/javascript">
		$('.delete').on('click', function(event) {
			event.preventDefault();
			const url = $(this).attr('href');
			swal({
				title: 'Are you sure?',
				text: 'You want to delete this Chapter',
				icon: 'error',
				buttons: ["Cancel", "Yes!"],
			}).then(function(value) {
				if (value) {
					window.location.href = url;
				}
			});
		});
	</script>

	<script>
		<?php if (isset($_SESSION['successMsg'])) {
			$msg = $_SESSION['successMsg'];
		?>
			event.preventDefault();
			swal({
				title: 'Success Message?',
				text: '<?php echo $msg; ?>',
				icon: 'trash',
				buttons: ["OK", "Yes!"],
			}).then(function(value) {
				if (value) {
					// window.location.href = url;
				}
			});
		<?php
			unset($_SESSION['successMsg']);
		} ?>


		
	</script>