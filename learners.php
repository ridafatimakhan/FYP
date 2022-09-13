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
                <?php
include('top.html');?>
					<h4><i class="fas fa-book-open"></i>Muallim's Users</h4>

					<div class="table-sec" style="font-family:Jameel Noori Nastaleeq;font-size:20px; ">
						<?php
		                    $sql = "SELECT * FROM users WHERE user_role = 'L' ";
                            $params = array();
                            $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                            $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                            $row_count = sqlsrv_num_rows( $stmt );
                            
                            if($row_count>0){

                            $srNo=1;
						 ?>
 <table cellpadding="0" cellspacing="0">
                    <tr>
								<th  scope="col">SrNo</th>
                                <th  scope="col">Image</th>
								<th  scope="col">Full Name</th>
								<th  scope="col">User Name</th>
								<th  scope="col">Email</th>
								<th  scope="col">Gender</th>
								<th  scope="col">DOB</th>
								<th  scope="col">Contact</th>
								<th  scope="col">CNIC</th>
                                <th  scope="col">Status</th>
                                <th  scope="col">Learner's Detail</th>
							</tr>
                            <?php while ( $row = sqlsrv_fetch_array( $stmt) ){
                                ?>
                                <tr>
                                    <td><?php echo $srNo; ?></td>

                                    <td>

                                        <?php if($row['user_image'] != "" && file_exists($row['user_image'])){
                                            ?>
                                            <img src="<?php echo $row['user_image'];?>" style="width:50px; height:50px; border-radius:100px;" /> 
                                            <?php
                                        }else{
                                            echo "N/A";
                                        } ?>
                                    </td>
                                    <td><?php echo $row['user_firstName']." ".$row['user_lastName']; ?></td>
                                    <td><?php echo $row['user_name']; ?></td>
                                    <td><?php echo $row['user_email']; ?></td>
                                    <td><?php echo getGenderTitle($row['gender']); ?></td>
                                    <td><?php                                    
                                    ?></td>
                                    <td><?php echo $row['contactNo']; ?></td>
                                    <td><?php echo $row['cnicNo']; ?></td>


                                    <td><?php echo $row['user_status']; ?></td>
                                    <td><a class="btn btn-success" href="learnersregistration.php?userID=<?php  echo $row['user_id'] ?>">Details</a></td>
  



                                </tr>
                                <?php
                                $srNo++;
                                }?>
                        </table>
                    <?php }else{
                        echo "No Learner Record Found";
                    } ?>

					</div>
				</div>
			</div>
		</div>
	</div>

<!-- Muallim's Inner Page Content End -->

                </div>


<?php require('./hf/footerNOMAN.php'); //Muallim's Main footers