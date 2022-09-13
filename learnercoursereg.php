<?php require('./hf/header.php'); //Muallim's Main Header ?>
<?php require('./panel-header.php'); //Muallim's Panel Header ?>
<script src="./js/function.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

<!-- Muallim's Panel Start -->
<div class="content ip-content admin-panel">
	<div class="container-fw">

		<div class="ip-main">
			<div class="t-wrap">

				<?php require('./panel-head-option.php'); //Muallim's Sidebar ?>

				<div class="panel-content">
					<h4><i class="fas fa-book-open"></i>Muallim's Learner Registered Courses</h4>
                    
					<div class="table-sec" style="font-family:Jameel Noori Nastaleeq;font-size:20px; ">
					
                        <?php				
                        include('top.html');?>		
                        <?php				

		                    $sql = "SELECT * FROM RegistrationCourse";
                            $params = array();
                            $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                            $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                           $row_count = sqlsrv_num_rows( $stmt );
                            
                            if($row_count>0){

                            $srNo=1;
						 ?>

						<table cellpadding="0" cellspacing="0">
							<tr>
								<th>SrNo</th>
                                <th>User Name</th>
								<th>Course</th>
								<th>Registered Date</th>
								<th>Status</th>
                                <th>Details</th>
                                <th>View Progress</th>
								
							</tr>
                            <?php while ( $row = sqlsrv_fetch_array( $stmt) ){
                                ?>
                                <tr>
                                    <td><?php echo $srNo; ?></td>

                                    <td><?php echo getUserName($row['reg_userid']); ?></td>
                                    <td><?php echo getCourseName($row['reg_course']); ?></td>
                                    <td><?php echo date("d-m-Y",strtotime($row['reg_date']));
                                     ?></td>
                                    <td><?php echo $row['reg_status']; ?></td>
                                    <td><a class="btn btn-success" href="viewRegDetails.php?regCourseID=<?php  echo $row['reg_id'] ?>">Details</a></td>
                                    <td><a class="btn btn-success" href="ILprogress.php?reg_course=<?php  echo $row['reg_course'];?>&userid=<?php echo $row['reg_userid']?> ">Progress</a></td>
                        
                                </tr>
                                <?php
                                $srNo++;
                                }?>
                        </table>
                    <?php }
                    else{
                        echo "No Learner Course Registration Found";
                   } ?>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Muallim's Inner Page Content End -->

<?php require('./hf/footerNOMAN.php'); //Muallim's Main footer