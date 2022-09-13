
<?php require('./hf/header.php'); //Muallim's Main Header ?>
<?php require('./panel-header.php'); //Muallim's Panel Header ?>
<script src="./js/function.js"></script>

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
		<h4 style="color: #286029; line-height: 45px; padding-left: 2%; background: #fff; border-top: 5px solid #286029; @font-face {
	font-family: 'Jameel Noori Nastaleeq'"</h4>

	    Offered Courses  </h4>
		 <?php if(isset($_SESSION['successMsg'])){
								?>
							<div class="alert alert-success text-center">

							<i class="fa fa-trash fa-0x" aria-hidden="true"></i>
							<?php echo $_SESSION['successMsg']?></h5>

							</div>
							<?php  } 
							unset($_SESSION['successMsg'])?>
        <ul> 
<?php	$sql="Select c.course_id, c.course_code,c.course_name,c.course_description,O.course_duration,O.ocid From Courses c Inner Join OfferCourse O on c.course_id=O.offercourse";
		                    
							$params = array();
                            $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                            $stmt = sqlsrv_query( $conn, $sql , $params, $options );
							$result =sqlsrv_query($conn,$sql);

                            $row_count = sqlsrv_num_rows( $stmt );
                            
                            if($row_count>0){
                            while ( $row = sqlsrv_fetch_array( $stmt) ){
	            ?>

                      <li>

					  <div class="list-inner">
				<a class="list-blurb"  href="javascript:;" style="text-decoration:none;">
					<img class="card-img-top" src="images/courseslogo.jpeg" alt=""> 
					<div class="text-center text-success" style="font-family:Jameel Noori Nastaleeq;font-size:20px;  font-weight: bold;">
					<h2><span><?php echo $row['course_name']; ?></span></h2>
					<h5>Course Code: <?php echo $row['course_code'];  ?></span></h6>
								<h5>Course Duration: <?php echo $row['course_duration']; ?></span></h6>
				                <h5>Offer Course Id: <?php echo $row['ocid']; ?></h6>
								
				
				
				</div>
				</a>
			
								<?php
								// checkCourseRegExist($row['course_id'],$_SESSION['userID']);
								if( checkCourseRegExist($row['course_id'],$_SESSION['userID'])==false)
								{
								?>
								<div style="border: 1px solid #E1E1E1; padding:5px;  box-shadow: 0 1px 4px rgb(31 31 31 / 12%);  background: #ffffff; display: inline-block;width: 99.5%;">
					            <a class="reg-confirm" style="display: inline-block;width: 90%;text-align: center; border-radius:5px; background: green;color: #ffffff;padding: 5px;float:left;margin-left: 9px;"   href="regcourse.php?courseID=<?php echo $row['course_id']; ?>">Register Now</a> 
				                </div>
								
								<?php
								}
								else if( checkCourseRegExist($row['course_id'],$_SESSION['userID'])=='A')
								{
									?>
									<div style="border: 1px solid #E1E1E1; padding:5px;  box-shadow: 0 1px 4px rgb(31 31 31 / 12%);  background: #ffffff; display: inline-block;width: 99.5%;">
									<a class="reg-confirm" style="display: inline-block;width: 90%;text-align: center; border-radius:5px; background: green;color: #ffffff;padding: 5px;float:left;margin-left: 9px;">Approved</a> 
									</div>
									<?php
								}
								else if( checkCourseRegExist($row['course_id'],$_SESSION['userID'])=='P')
								{
									?>
									<div style="border: 1px solid #E1E1E1; padding:5px;  box-shadow: 0 1px 4px rgb(31 31 31 / 12%);  background: #ffffff; display: inline-block;width: 99.5%;">
									<a class="reg-confirm" style="display: inline-block;width: 90%;text-align: center; border-radius:5px; background: green;color: #ffffff;padding: 5px;float:left;margin-left: 9px;">Pending</a> 
									</div>
									<?php
							

								}
							?>
							</li>
								
						<?php	}
						}
						else{
               echo "No Course Offered";
						}
						?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    
$('.reg-confirm').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
        title: 'Are you sure?',
        text: 'Are you sure to register this Course',
        icon: 'warning',
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
        icon: 'warning',
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
</div>
</div>
</div></div>
</div></div>

<?php require('./hf/footerNOMAN.php'); //Muallim's Main footer