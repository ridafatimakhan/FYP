<?php require('./hf/header.php'); //Muallim's Main Header ?>
<?php require('./panel-header.php') ;//Muallim's Panel Header ?>
<script src="./js/function.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">





<!-- Muallim's Inner Page Content Start -->
	<div class="ip-banner">
		<div class="color-bg"></div>
		    <div class="img-bg"></div>
		        <div class="container">	
		          <div class="ip-banner-blurb">	
		<h2>Let's Learn Seerat-un-Nabi(PBUH)</h2>

		    <div class="courses-btn">
		    <a class="ex-btn btn-border" href="#basic"><i class="fas fa-link"></i> Basic Learning</a><br>
		<!-- <a class="ex-btn btn-border" href="#advance"><i class="fas fa-link"></i> Advanced Learning</a> -->
    </div>
		</div>
		     </div>
                  </div>
	

<div class="content ip-content">
	<div class="container-fw">
		<?php require('./sidebar-panel.php'); //Muallim's Sidebar ?>
		<div class="ip-main">
		<div class="courses-list" id="basic">
		<h4 style="color: #286029; line-height: 45px; padding-left: 2%; background: #fff; border-top: 5px solid #286029; @font-face {
	font-family: 'Jameel Noori Nastaleeq';"</h4>

	    Current Courses  </h4>
				<?php 
					if(isset($_SESSION['SDeleteMsg'])){
						?>
					<div class="alert alert-success text-center">

					<i class="fa fa-trash fa-0x" aria-hidden="true"></i>
					<?php echo $_SESSION['SDeleteMsg']?></h5>

					</div>
					<?php  } 
					unset($_SESSION['SDeleteMsg'])?>
					<?php 
					if(isset($_SESSION['DeleteSection'])){
					?>
					<div class="alert alert-danger text-center">

					<i class="fa fa-trash fa-0x" aria-hidden="true"></i>
					<?php echo $_SESSION['DeleteSection']?></h5>

					</div>
					<?php  } 
					unset($_SESSION['DeleteSection'])?>
						<?php 
					if(isset($_SESSION['successUpdateMsg'])){
					?>
					<div  class="alert alert-success text-center">

					<i class="fas fa-pencil-alt"     aria-hidden="true"></i>
					<?php echo $_SESSION['successUpdateMsg']?></h5>

					</div>
					<?php  } 
					unset($_SESSION['successUpdateMsg'])?>

				
<?php  ?>
	<ul> <!-- Unordered list -->
				
				<?php
		                    $sql = "SELECT * FROM Courses ORDER BY course_id DESC";
                            $params = array();
                            $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                            $stmt = sqlsrv_query( $conn, $sql , $params, $options );
							$result =sqlsrv_query($conn,$sql);

                            $row_count = sqlsrv_num_rows( $stmt );
                            
                            if($row_count>0){
                            while ( $row = sqlsrv_fetch_array( $stmt) )
							
							{
							
	            ?>
       <li>
		    <div class="list-inner">
				<a class="list-blurb">
					<img class="card-img-top" src="images/courseslogo.jpeg" alt=""> 
					<div class="text-center text-success" style="font-family:Calibri;font-size:20px;  font-weight: bold;"><h2><span><?php echo $row['course_name']; ?></span></h2></div>
				</a>
				 <?php
				  if($_SESSION['userRole'] == 'A') { ?>
				<div class="text-center" style="text-decoration:none;border: 1px solid #E1E1E1; padding:5px;  box-shadow: 0 1px 4px rgb(31 31 31 / 12%);  background: #ffffff; display: inline-block;width: 99.5%;">
					<a class= "text-success" style="text-decoration:none;font-family:Calibri ;font-weight:bold;" href="courses-details.php?courseID=<?php echo $row['course_id']; ?>">View</a> 
					<a class= "text-success" style="text-decoration:none;font-family:Calibri ;font-weight:bold;" href="edit-Course.php?courseID=<?php echo $row['course_id']; ?>">Edit</a> 
					<a class= "text-success delete"  style=" text-decoration:none;font-family:Calibri; font-weight:bold;"href="Delete-Courses.php?courseID=<?php echo $row['course_id']?>"> Delete</a>
				</div>	
				<?php }
			      	else{ ?>
					<div class="text-center text-success" style="border: 1px solid #E1E1E1; padding:5px;  box-shadow: 0 1px 4px rgb(31 31 31 / 12%);  background: #ffffff; display: inline-block;width: 99.5%;">
					<a  class= "text-success"  style="font-weight:bold;" href="courses-details.php?courseID=<?php echo $row['course_id']; ?>">View</a> 
                    <?php }	?>
	        </div>
    </li>
						<?php   }//end of if statment
					}//end of while statement
			else {    //else statement start
				?>
					<a style="display: inline-block;width: 100%;text-align: center; border-radius:5px; background: red;color: #ffffff;padding: 5px;float:center;margin-left: 5px;">Zero Record Found</a>
		<?php		}

				?>
    </ul>
			<hr class="bg">
			</div>
			</div>
			</div>
			</div>
			</div>
			
		

			<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    
$('.delete').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
        title: 'Are you sure?',
        text: 'You want to delete this Course',
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

<script>
@font-face {
	font-family: 'Jameel Noori Nastaleeq';
	src: url('http://www.fontsaddict.com/fontface/jameel-noori-nastaleeq.ttf');
  }
</script>	  

<?php require('./hf/footerNOMAN.php'); //Muallim's Main footer

