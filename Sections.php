

<?php require('./hf/header.php'); //Muallim's Main Header ?>
<?php require('./panel-header.php'); echo"hi" ;//Muallim's Panel Header ?>
<script src="./js/function.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

<!-- Muallim's Inner Page Content Start -->
<div class="ip-banner">
	<div class="color-bg"></div>
	<div class="img-bg"></div>
	<div class="container">	
		<div class="ip-banner-blurb">	
			,,
			<h2>Let's Learn Seerat-un-Nabi(PBUH)</h2>

			<div class="courses-btn">
				<a class="ex-btn btn-border" href="#basic"><i class="fas fa-link"></i>Basic Learning</a><br>
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
		<?php require('./sidebar.php'); //Muallim's Sidebar ?>
		<div class="ip-main">

			<div class="courses-list" id="basic">
				<br>
				<ul>
				<h3>Seerah Sections</h3>
				<ul>
				<?php
		                    $sql = "SELECT * FROM Sections ";
                            $params = array();
                            $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                            $stmt = sqlsrv_query( $conn, $sql , $params, $options );
							$result =sqlsrv_query($conn,$sql);

                            $row_count = sqlsrv_num_rows( $stmt );
                            
                            if($row_count>0){
?>
<?php while ( $row = sqlsrv_fetch_array( $stmt) ){
	?>
	<li>
	        <div class="list-inner">
		    <a class="list-blurb" href="section-detail.php?ID=<?php echo $row['']; ?>">
			<img class="list-icon" src="images/Sectionlogo.jpg" alt="">
			<h5>Section Name:<?php echo $row['section_name']; ?></span></h5>
			<h5>Total Chapters<?php echo $row['total_chapters']; ?></span></h5>
		
		
		</a>
	</div>
</li>

<?php    }
				} else {
				    echo "0 results found";
				}

				?>


				<?php //if($user_data && $user_data['user_role'] == 'admin') { ?>
					<li class="add-btn">
						<div class="list-inner">
							<div class="list-blurb">
								<a class="trs-03" href="Add-Section.php">
                                <i class="fa fa-plus-circle"><br><span>Add New Section</span></i>
								</a>
							</div>
						</div>
					</li>
					<li class="add-btn">
						<div class="list-inner">
							<div class="list-blurb">
								<a class="trs-03" href="viewSections.php">
								<i class="fas fa-eye"><br><span>View All Sections</span></i>
								</a>
							</div>
						</div>
        </li>
				
									
				</ul>
			</div>
			
		</div>
	</div>
</div>
<!-- Muallim's Inner Page Content End -->




<?php //require('footerNOMAN.php'); //Muallim's Main footer ?>