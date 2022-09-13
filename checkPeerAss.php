<?php include "./hf/header.php"; 
//session_start();
if($_SESSION['ChkcountPR'] >= 2){
    echo "Peer Review Checker Count == 2";
    header("Location:courses-detail2.php");
    unset($_SESSION['ChkcountPR']);
     exit(0);
}

$AssignID=$_GET['AssignID'];
$userID=$_GET['userID'];

$stmt="Select * from PRASSIGN where assign_id=$AssignID";
$params = array(); 
$query = sqlsrv_query( $conn, $stmt); 
while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC )) {
    $ASSG=$row['assign_tittle']; 
}

?>

<div class="container-fluid border " style=" height:350px; margin-top:105px;">
    <div class="alert alert-success" role="alert" style="font-family:Calibri;">
        <p>You have succesfully submitted the Assignment <?php echo $ASSG; ?></p>    
        <div class="alert alert-warning" role="alert">
            <p>Now Lets check Peers Assignment</p>    
        </div>
    </div>
    <div class="container-fluid border " style=" margin-top:10px;">
<h3 style="font-family:Calibri; ">Users who have Submitted this Assignment</h3>
<ul>
        <?php 

            $sql="select * from PRresponses PR inner join users us on PR.userID=us.user_id where assign_id=$AssignID and userID!=$userID";
            $params = array();
            $query = sqlsrv_query( $conn, $sql); 
            $status = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC );
            if($status){
                $query = sqlsrv_query( $conn, $sql); 
                
            while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC )) {
                $users=$row['userID'];
                // echo $users;
                
            ?>

         <li>  <a href="checkSelectedAss.php?userID=<?php echo $row['userID']; ?>&asgID=<?php echo $row['assign_id']; ?>"><?php  echo $row['user_name']?></a></li>
        <?php    
        }
    }else{
        echo "your IDIOIT";
    }
          ?>
       <ul>
    </div>
</div>