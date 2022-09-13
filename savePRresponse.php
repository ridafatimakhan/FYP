<?php
    include "./includes/Connection.php";
    $AssignID=$_POST['AssignID'];
    $questID=$_POST['AssignQuesID'];
    $Answer=$_POST['answer'];
    
    $query = "INSERT INTO PRresponses (questID,assign_id,answer) VALUES ('$questID','$AssignID','$Answer')";
    //$stmt = sqlsrv_query( $conn, $sqlID , $params, $options );
    $result =sqlsrv_query($conn,$query);
    if($result){
        echo "Done successfully";
    }

?>