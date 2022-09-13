
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
					<h4><i class="fas fa-book-open"></i>Detail of Muallim's Users</h4>


	 <?php 
     $userID="";
	
     if(isset($_GET['userID']))
     {
         $userID = $_GET['userID'];

		$sql = "SELECT * FROM Notification WHERE noti_for_id = '$userID'";
	 	$params = array();
    	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
   		 $stmt = sqlsrv_query( $conn, $sql , $params, $options );
   		$result =sqlsrv_query($conn,$sql);
     }
     ?> 

<?php
$sql = "SELECT *FROM users WHERE user_role='L'";
		                    
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

								<th>Full Name</th>
                                <th>Image</th>
								<th>Email</th>
								<th>Gender</th>
                                <th>Learner Status</th>	
                                <th>Detail</th>						

				   </tr>
				<?php   while ( $row = sqlsrv_fetch_array( $stmt) ){?>
			  
                <tr>
				               <td><?php echo $row['user_firstName']." ".$row['user_lastName']; ?></td>	
                               <td><?php echo $row['user_image']; ?> </td>					
							<td><?php echo $row['user_email']; ?> </td>
							<td><?php echo $row['gender']; ?> </td>
                            <td><?php echo $row['user_status']; ?> </td>
						
							<td >
							<?php if($row['user_status'] == "pending"){
									?>
										<a class="btn btn-success"
                                         href="learnersregistration.php?userID=<?php echo $row['user_id'] ?>&user_status=approved&notiForID=<?php echo $row['user_id']; ?>">Approve</a>
										
										
										<a class="btn btn-danger" href="learnersregistration.php?userID=<?php echo $row['user_id'] ?>&user_status=reject&notiForID=<?php echo $row['user_id']; ?>">Reject</a>
										<?php
								}else  if($row['user_status'] == "approved"){
									?>
									<a class="btn btn-danger" href="learnersregistration.php?userID=<?php echo $row['user_id'] ?>&user_status=reject&notiForID=<?php echo $row['user_id']; ?>">Reject</a>
									<?php
								}else  if($row['user_status'] == "reject"){
									?>
									<a class="btn btn-success" href="learnersregistration.php?userID=<?php echo $row['user_id'] ?>&user_status=approved&notiForID=<?php echo $row['user_id']; ?>">Approve</a>
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
  $userID = "";
  if(isset($_GET['userID']))
{


  $notiForID = getAdminID();
}
 if(isset($_GET['user_status']) && isset($_GET['notiForID']))
 {
	 $userID = $_GET['userID'];
	 $user_status = $_GET['user_status'];
	 $notiForID = $_GET['notiForID'];
	 $notiFor = "L";
	 $notiStatus = '0';
	 $notiType = "AR";
	 $notiTypeID = $userID;

 	$query ="UPDATE users SET user_status='$user_status' WHERE user_id='".$userID."'";
	$params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt = sqlsrv_query( $conn, $query, $params, $options );
   $result =sqlsrv_query($conn,$query);
	if($user_status == "approved"){
		$_SESSION['message']="Learner Registration Has been Approved";

		$notiTitle = "Your Account Registration Has been Approved by Admin";
	}else if($user_status == "reject"){
		$_SESSION['message']="Learner Registration Has been Rejected";
		$notiTitle = "Your Acount Registration Has been Rejected by Admin";

	}
	$q="INSERT INTO  Notification(  noti_title,
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
	 echo 'window.location.href="learnersregistration.php"';
	// echo 'alert("User Approved")';
	echo '</script>';
}
?>
