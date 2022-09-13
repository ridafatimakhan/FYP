<?php 
include "./includes/Connection.php";

$asgID=$_POST['AsgID'];
$chkerID=$_POST['chkeruserID'];
$asgUserID=$_POST['AsguserID'];
$questID=$_POST['questID'];


if(isset($_POST['option1'])){
    $maxp=$_POST['option1'];

    $query = "INSERT INTO PR_results (assign_id,checkerID,asgUserID,questID,marks) 
                VALUES ('$asgID','$chkerID','$asgUserID','$questID','$maxp')";
    $result =sqlsrv_query($conn,$query);
    if($result){
        header("Location:checkPeerAss.php?AssignID=$asgID&userID=$chkerID");

            exit(0);
    }

}else if(isset($_POST['option2'])){
    $avgp=$_POST['option2'];

    $query = "INSERT INTO PR_results (assign_id,checkerID,asgUserID,questID,marks) 
                VALUES ('$asgID','$chkerID','$asgUserID','$questID','$avgp')";
    $result =sqlsrv_query($conn,$query);

    if($result){
        header("Location:checkPeerAss.php?AssignID=$asgID&userID=$chkerID");

            exit(0);
    }

}else if(isset($_POST['option3'])){
    $minp=$_POST['option3'];
    $query = "INSERT INTO PR_results (assign_id,checkerID,asgUserID,questID,marks) 
                VALUES ('$asgID','$chkerID','$asgUserID','$questID','$minp')";
    
    $result =sqlsrv_query($conn,$query);

    if($result){
        header("Location:checkPeerAss.php?AssignID=$asgID&userID=$chkerID");

            exit(0);
    }


}else{
    $query = "INSERT INTO PR_results (assign_id,checkerID,asgUserID,questID,marks) 
                VALUES ('$asgID','$chkerID','$asgUserID','$questID','0')";
    
    $result =sqlsrv_query($conn,$query);

    if($result){
        header("Location:checkPeerAss.php?AssignID=$asgID&userID=$chkerID");
            exit(0);
    }

}


?>