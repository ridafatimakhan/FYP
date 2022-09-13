
<?php require('./hf/header.php'); //Muallim's Main Header ?>
<?php require('./panel-header.php'); //Muallim's Panel Header ?>
<script src="./js/function.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>//sweetalert
<script type="text/javascript">
    
</script>
<?php if(isset($_SESSION['message'])){
    $msg = $_SESSION['message'];
	echo '<script type="text/javascript">';
	echo 'swal("Message", "'.$msg.'", "success");';
	echo '</script>';
    
	unset($_SESSION['message']);
} ?>


<?php
if(isset($_GET['notiID'])){
	$notiID = $_GET['notiID'];
	$query ="UPDATE Notification SET noti_status='1' WHERE noti_id='$notiID' ";
	$params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt = sqlsrv_query( $conn, $query, $params, $options );
   	$result =sqlsrv_query($conn,$query);


}


?>
<!-- Muallim's Panel Start -->
<div class="content ip-content admin-panel">
	<div class="container-fw">

		<div class="ip-main">
			<div class="t-wrap">

				<?php require('./panel-head-option.php'); //Muallim's Sidebar ?>

				<div class="panel-content">
					<h4><i class="fas fa-book-open"></i>Muallim's Learner Registered Courses</h4>


	 <?php 
     $regCourseID="";
	
     if(isset($_GET['regCourseID']))
     {
         $regCourseID = $_GET['regCourseID'];

		$sql = "SELECT * FROM Notification WHERE noti_type_id = '$regCourseID'";
	 	$params = array();
    	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
   		 $stmt = sqlsrv_query( $conn, $sql , $params, $options );
   		$result =sqlsrv_query($conn,$sql);
     }
     ?> 

<?php

$sql = "SELECT *FROM users u
 		INNER JOIN RegistrationCourse r on u.user_id=r.reg_userid
		INNER JOIN OfferCourse o on r.reg_course=o.offercourse
 		INNER JOIN Courses c on o.offercourse=c.course_id";
		                    
		$params = array();
    	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
		$result =sqlsrv_query($conn,$sql);
        $row_count = sqlsrv_num_rows( $stmt );
                            
        if($row_count>0){
    	
							
?>


<div class="table-sec" style="font-family:Jameel Noori Nastaleeq;font-size:20px; ">          

				<table cellpadding="0" cellspacing="0">
				    <tr>
					 		 <th scope="col">Registered ID</th>
							<th scope="col">User Name</th>
							<th scope="col">Course Name</th>
							<th scope="col">Course Description</th>
							<th scope="col">Learner Status</th>
							<th scope="col">Action</th>

				     </tr>
		
							<?php while ( $row = sqlsrv_fetch_array( $stmt) ){?>
				<tr>
				
							<td><?php echo $row['reg_id']; ?> </td>
							<td><?php echo $row['user_firstName']; ?> </td>
							<td><?php echo $row['course_name']; ?> </td>
							<td><?php echo $row['course_description']; ?> </td>
							<td><?php echo $row['reg_status']; ?> </td>
						
							<td>
								<?php if($row['reg_status'] == "Pending"){?>
						<a class="btn btn-success" href="viewRegDetails.php?regid=<?php echo $row['reg_id'] ?>&status=approved&notiForID=<?php echo $row['reg_userid']; ?>">Approve</a>
										
										
						<a class="btn btn-danger" href="viewRegDetails.php?regid=<?php echo $row['reg_id'] ?>&status=reject&notiForID=<?php echo $row['reg_userid']; ?>">Reject</a>
						<?php
						}else  if($row['reg_status'] == "approved"){
						?>
					<a class="btn btn-danger" href="viewRegDetails.php?regid=<?php echo $row['reg_id'] ?>&status=reject&notiForID=<?php echo $row['reg_userid']; ?>">Reject</a>
					<?php
					}else  if($row['reg_status'] == "reject"){
					?>
					<a class="btn btn-success" href="viewRegDetails.php?regid=<?php echo $row['reg_id'] ?>&status=approved&notiForID=<?php echo $row['reg_userid']; ?>">Approve</a>
					</td>
				</tr>			
					<?php
				}} ?>
		
               	 </table>	
				</div>
					
<?php
						}
?>
 <?php
  $reg_id = "";
				
 if(isset($_GET['status']) && isset($_GET['regid']) && isset($_GET['notiForID']))
 {
	 $reg_id = $_GET['regid'];
	 $status = $_GET['status'];
	 $notiForID = $_GET['notiForID'];
	 $notiFor = "L";
	 $notiStatus = '0';
	 $notiType = "CR";
	 $notiTypeID = $reg_id;

 	$query ="UPDATE RegistrationCourse SET reg_status='$status' WHERE reg_id='".$reg_id."'";
	$params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt = sqlsrv_query( $conn, $query, $params, $options );
   $result =sqlsrv_query($conn,$query);
	if($status == "approved"){
		$_SESSION['message']="Course Registration Has been Approved";

		$notiTitle = "Your Course Registration Has been Approved by Admin";
	}else if($status == "reject"){
		$_SESSION['message']="Course Registration Has been Rejected";
		$notiTitle = "Your Course Registration Has been Rejected by Admin";

	}
	$q="INSERT INTO  Notification (noti_title,
	noti_for,
	noti_for_id,
	noti_type,
	noti_type_id
	,noti_status)VALUES('$notiTitle',
						'$notiFor',
						'$notiForID',
						'$notiType',
						'$notiTypeID',
						'$notiStatus')";
$r =sqlsrv_query($conn,$q);	
	echo '<script type="text/javascript">';
	 echo 'window.location.href="viewRegDetails.php"';
	// echo 'alert("User Approved")';
	echo '</script>';
}
?>
