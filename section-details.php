<?php require('./hf/header.php'); //Muallim's Main Header ?>
<?php require('./panel-header.php') ;//Muallim's Panel Header ?>
<script src="./js/function.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
<style>
</style>

<button onclick="topFunction()" id="myBtn" title="Go to top"> <i class="fas fa-long-arrow-alt-up"></i> Top</button>
<?php $sectionID = $sectionname = $sectiondescription =$section_prerequisite =$learning_effort =$TotalChapters=""; 
$courseID= $courseName = $secPreRecName = "";
if(isset($_GET['sectionID']) && $_GET['sectionID'] != "" && $_GET['courseID'] && $_GET['courseID'] != ""){
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
            
            $sectionID = $row['section_id'];
            $sectionno = $row['section_no'];
            $sectionname = $row['section_name'];
            $sectiondescription = $row['section_description'];
			$secPreRecName = getSectionName($row['section_prerequisite']);
            $learning_effort= $row['learning_effort'];
            $TotalChapters  = $row['total_chapters'];
			$courseName = getCourseName($row['course_id']);
        }

	}else{
        header("location:courses-details.php");
        exit();
    }
    

}else{
    header("location:courses-details.php");
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
			

			<div class="courses-list" id="basic">
			<h4 style="color: #286029;	font-family:Calibri; line-height: 45px; background: #fff; border-top: 5px solid #286029;">
					<center><?php echo $sectionname; ?> </center></h4>
	
			<?php 
							if(isset($_SESSION['Succesmsg'])){
								?>
							<div class="alert alert-success text-center">

							<i class="fa fa-trash fa-0x" aria-hidden="true"></i>
							<?php echo $_SESSION['Succesmsg']?></h5>

							</div>
							<?php  } 
							unset($_SESSION['Succesmsg'])?>

                       <?php     if(isset($_SESSION['successMsg'])){
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

							<i class="fa fa-warning" aria-hidden="true"></i>
							<?php echo $_SESSION['DeleteMsg']?></h5>

							</div>
							<?php  } 
							unset($_SESSION['DeleteMsg'])?>
				<ul>
		<?php
		$sql = "SELECT * FROM Chapters WHERE section_id = '$sectionID' ORDER BY chapter_id DESC";
					$params = array();
					$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
					$stmt = sqlsrv_query( $conn, $sql , $params, $options );
					$result =sqlsrv_query($conn,$sql);
					$row_count = sqlsrv_num_rows($stmt); ?>
                  <table class="table table-striped table-success"  style=" text-decoration:none; font-family:Calibri; font-size:15px; ">
			    <thead>
			     	<tr>
						
							<th scope="col">Section Name</th>
							<th scope="col">Section Description</th>
							<th scope="col">Total Chapters</th>
							<th scope="col">Learning Effort</th>
							<th scope="col">Section Prerequisite</th>
						    <th scope="col" style="font-family:Jameel Noori Nastaleeq;" >Course Name</th>
				     </tr>
			      </thead>
			    <tbody>
                <tr>
	                       
 
		                        <td ><?php echo  $sectionname; ?> </td>
								<td   ><?php echo  $sectiondescription; ?> </td>
                                <td><?php echo  $TotalChapters;?> </td>
                                <td><?php echo  $learning_effort; ?> </td>
                                <td><?php echo  $secPreRecName;?> </td>
		                        <td ><?php echo  $courseName; ?> </td>
                </tr>
                </table>
			
<br>
					
<div class="alert alert-" style="background-color:#286029; color:#fff;font-family:Calabiri;font-size:20px;  ">
<i class="fas fa-obook-open"></i> Chapters of Section <strong><?php echo $sectionname;?> <strong>
<?php   if($_SESSION['userRole'] == 'A') {?>
<a  href="Add-Chapters.php?courseID=<?php echo $courseID; ?>&sectionID=<?php echo $sectionID ?>" style=margin-left:47%;margin-bottom:0%;margin-top:0%; type="button" class="btn btn-success btn-lg" > Add  Chapter</a>
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
				  <img class="card-img-top" src="images/Chapter1.jpg" alt=""> 
				     <div class="text-center text-success "style="font-family:Calibiri;font-size:20px; "><h2 style="text-decoration:none;"><?php echo $row['chapter_name']; ?></h2></div>
				 </a>	
				<?php   if($_SESSION['userRole'] == 'A') {?>	
					<div class="text-center text-success" style="border: 1px solid #E1E1E1; padding:5px;  box-shadow: 0 1px 4px rgb(31 31 31 / 12%);  background: #ffffff; display: inline-block;width: 99.5%;"
					>
					<a class= "text-success"  style="font-weight: normal; text-decoration:none ;"href="Chapter-details.php?courseID=<?php echo $courseID; ?>&sectionID=<?php echo $sectionID ?>&chapter_id=<?php echo $row['chapter_id']; ?>"> View</a>
					<a class= "text-success"  style="font-weight: normal; text-decoration:none; "href="Chapter-edit.php?courseID=<?php echo $courseID; ?>&sectionID=<?php echo $row['section_id']; ?>&chapter_id=<?php echo $row['chapter_id'];?>"> Edit</a>
					<a class=" text-success delete"   style="font-weight: normal; text-decoration:none;text-color:green;"href="DeleteChapters.php?courseID=<?php echo $courseID; ?>&sectionID=<?php echo $row['section_id']; ?>&chapter_id=<?php echo $row['chapter_id']; ?>">Delete</a> 
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
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    
$('.delete').on('click', function (event) {
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

<?php require('./hf/footerNOMAN.php'); ?>


						
</div>
					        	</div>
					             	</div>
									 <?php include('top.html');?>