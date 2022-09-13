<?php require('./hf/header.php'); //Muallim's Main Header ?>
<?php require('./panel-header.php') ;//Muallim's Panel Header ?>
<script src="./js/function.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
<style>

</style>
<?php $courseID = $courseTitle =$course_description=$credit_hours=$total_chapters=$total_sections=$total_chapters=$total_concepts=""; 

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
			$course_Title = $row['course_name'];
			$course_code = $row['course_code'];
			$course_description = $row['course_description'];
			$total_sections = $row['total_sections'];
			$total_concepts= $row['total_concepts'];
			$total_chapters = $row['total_chapters'];
			$credit_hours = $row['credit_hours'];
			$defined_by = $row['defined_by'];

		}
	}else{
        header("location:Add-Section.php");
        exit();
    }
    

}else{
    header("location:Add-Section.php");
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
		<?php require('./sidebar-panel.php'); //Muallim's Sidebar ?>
		<div class="ip-main">
			
<!---------------------------------- Sr Details of specfic Courses ----------------------------------------------->
			<div class="courses-list" id="basic">
			<h4 style="color: #286029;	font-family:Jameel Noori Nastaleeq; line-height: 45px; padding-left: 2%; background: #fff; border-top: 5px solid #286029;">
			<?php echo $course_Title;?>   </h4>
         	<ul>
				<?php 
							if(isset($_SESSION['Succesmsg'])){
								?>
							<div class="alert alert-success text-center">

							<i class="fa fa-trash fa-0x" aria-hidden="true"></i>
							<?php echo $_SESSION['Succesmsg']?></h5>

							</div>
							<?php  }
							unset($_SESSION['Succesmsg'])?>
		                  
				<?php 
				if(isset($_SESSION['successMsg'])){
					?>
				<div class="alert alert-success text-center">

				<i class="fa fa-trash fa-0x" aria-hidden="true"></i>
				<?php echo $_SESSION['successMsg']?></h5>

				</div>
				<?php  }
				unset($_SESSION['successMsg'])?>
						
				<?php 
							if(isset($_SESSION['DeleteMsg'])){
								?>
							<div class="alert alert-danger text-center">

							<i class="fa fa-trash fa-0x" aria-hidden="true"></i>
							<?php echo $_SESSION['DeleteMsg']?></h5>

							</div>
							<?php  } 
							unset($_SESSION['DeleteMsg'])?>

		<?php
		$sql = "SELECT * FROM Sections WHERE course_id = '$courseID' ORDER BY section_id DESC";
					$params = array();
					$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
					$stmt = sqlsrv_query( $conn, $sql , $params, $options );
					$result =sqlsrv_query($conn,$sql);

					$row_count = sqlsrv_num_rows($stmt); ?>
					<div class="row ml-5">
						<div class="col-lg-7 mx-auto ">
					
						</div>
					</div>
			
				<table class="table table-striped table-success "style="font-family:Montserrat ;">
			    <thead>
				    <tr>
							<th scope="col">Sr No</th>
							<th scope="col">Course Code </th>
							<th  scope="col">Course Name</th>
							<th scope="col">Course Description</th>
							<th scope="col">Total Sections</th>
							<th scope="col">Total Chapters</th>
							<th scope="col">Total Concepts</th>
							<th scope="col">Credit Hours</th>
							<th scope="col">Defined By</th>
				   </tr>
			    </thead>
			    <tbody>
                <tr>
							<td> 1 </td>
							<td><?php echo  $course_code ?> </td>
							<td style="font-family:Jameel Noori Nastaleeq;"  ><?php echo  $course_Title ?> </td>
							<td style="font-family:Jameel Noori Nastaleeq;" ><?php echo  $course_description ?> </td>
							<td><?php echo  $total_sections ?> </td>
							<td><?php echo  $total_chapters ?> </td>
							<td><?php echo  $total_concepts  ?> </td>
                            <td><?php echo  $credit_hours ?> </td>
							<td style="font-family:Jameel Noori Nastaleeq;" ><?php echo  $defined_by?> </td>
                </tr>
                </table>
	<div class="alert alert-success " style="font-family:Montserrat ;font-size:20px;">
<i class="fas fa-book-open"></i> Sections of  Course <p style="font-family:Jameel Noori Nastaleeq;"> <?php echo $course_Title;?> </p>
<?php if($_SESSION['userRole'] == 'A') {  ?>
<a href="Add-Section.php?courseID=<?php echo $courseID; ?>" style=margin-left:85%;margin-bottom:0%;margin-top:-15%; type="button" class="btn btn-success btn-lg">Add  Section</a>
<?php }?>
</div>
<br>
	<?php
					if($row_count>0){
					while ( $row = sqlsrv_fetch_array( $stmt) ){
		?>

<li>
<div class="list-inner">
				 <a class="list-blurb">
				  <img class="card-img-top" src="images/Sectionlogo.jpg" alt=""> 
				     <div class="text-center text-success "style="font-family:Jameel Noori Nastaleeq;font-size:20px; "><h2 style="text-decoration:none;"><?php echo $row['section_name']; ?></h2></div>
				 </a>	
				<?php   if($_SESSION['userRole'] == 'A') {?>	
					<div class="text-center " style="border: 1px solid #E1E1E1;    box-shadow: 90 10px 4px rgb(0 89 31 / 12%);  background: #ffffff; display: inline-block;width: 99.5%;">
				<a class= "text-success"  style=" text-decoration:none;"href="section-details.php?courseID=<?php echo $courseID; ?>&sectionID=<?php echo $row['section_id']; ?>"> View</a>
				<a class= "text-success"  style="text-decoration:none;"href="edit-Section.php?courseID=<?php echo $courseID; ?>&sectionID=<?php echo $row['section_id']; ?>">Edit</a> 
                <a class= "text-success delete"  style="text-decoration:none;"href="DeleteSection.php?courseID=<?php echo $courseID; ?>&sectionID=<?php echo $row['section_id']; ?>"> Delete</a>
				
				</div>	
				<?php } else { ?>
					<div class="text-center text-success" style="border: 1px solid #E1E1E1; padding:5px;  box-shadow: 0 1px 4px rgb(31 31 31 / 12%);  background: #ffffff; display: inline-block;width: 99.5%;">

					<a class= "text-success"  style="font-weight: normal; text-decoration:none;"href="Chapter-details.php?courseID=<?php echo $courseID; ?>&sectionID=<?php echo $sectionID ?>&chapter_id=<?php echo $row['chapter_id']; ?>"> View</a>
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

						<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    
$('.delete').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
        title: 'Are you sure?',
        text: 'You want to delete this Section',
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
<?php if(isset($_SESSION['successMsg'])){
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
<?php require('./hf/footerNOMAN.php'); //Muallim's Main footer