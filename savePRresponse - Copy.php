<?php
    include "./includes/Connection.php";
    $courseID=$_POST['courseID'];
    $AssignID=$_POST['AssignID'];
    $ChapID=$_POST['ChapID'];
    $questID=$_POST['AssignQuesID'];
    $Answer=$_POST['answer'];

    $userID = $_SESSION['userID'];
    
    $query = "INSERT INTO PRresponses (userID,questID,assign_id,answer) VALUES ('$userID','$questID','$AssignID','$Answer')";
    //$stmt = sqlsrv_query( $conn, $sqlID , $params, $options );
    $result =sqlsrv_query($conn,$query);
    if($result){
        header("Location:checkPeerAss.php?AssignID=$AssignID&userID=$userID");
        // header("Location:prAssignment.php?courseID=$courseID");
            exit(0);
    }

?>