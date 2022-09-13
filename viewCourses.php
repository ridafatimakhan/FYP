<?php require('./hf/header.php'); //Muallim's Main Header ?>
<?php require('./panel-header.php');//Muallim's Panel Header ?>
<script src="./js/function.js"></script>

<!-- Muallim's Panel Start -->
<div class="content ip-content admin-panel">
		<div class =" container-fw">

		<div class="ip-main">
			<div class="t-wrap">

				<?php require('./panel-head-option.php'); //Muallim's Sidebar ?>

				<div class="panel-content">
					<h4><i class="fas fa-book-open"></i>Muallim's Courses</h4>
					<div class="table-sec">
						<?php
		                    $sql = "SELECT * FROM Courses";
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
                    
								<th>Course Id</th>
								<th>Course Code</th>
								<th>Course Name</th>
								<th>Course description</th>
								<th>Defined Date</th>
								
							</tr>
                            <?php while ( $row = sqlsrv_fetch_array( $stmt) ){
                                ?>
                                <tr>
                                    <td><?php echo $srNo; ?></td>
 
                                    <td><?php echo $row['course_id']; ?></td>
                                    <td><?php echo $row['course_code']; ?></td>
                                    <td><?php echo $row['course_name']; ?></td>
                                    <td><?php echo $row['course_description']; ?></td>
                                

                                </tr>
                                <?php
                                $srNo++;
                                }?>
                        </table>
                    <?php }else{
                        echo "No Course Added yet";
                    } ?>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Muallim's Inner Page Content End -->


