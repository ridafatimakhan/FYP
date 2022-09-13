
<?php require('./includes/connection.php'); 

$courseID="";

session_start();
if( isset($_GET['courseID']) && $_GET['courseID'] !=""){
    $courseID = $_GET['courseID'];
    $sql = "SELECT COUNT(*) AS tot FROM Sections WHERE course_id='$courseID'";
    $stmt = sqlsrv_query( $conn, $sql );
    $result =sqlsrv_query($conn,$sql);
    $result2 =sqlsrv_fetch_array($result);
    $row_count = sqlsrv_num_rows( $stmt );
 
    if($result2['tot'] == 0){  
    $sql = "DELETE FROM Courses WHERE course_id = '$courseID'";
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt = sqlsrv_query( $conn, $sql , $params, $options );
    $result =sqlsrv_query($conn,$sql);
    $row = sqlsrv_num_rows($stmt);
    header("location:courses-details.php?courseID=".$courseID);
    $_SESSION['SDeleteMsg'] = " Course Succesfully Deleted";
  
    }
else{
    $_SESSION['DeleteMsg'] = "Delete Sections First";
    header("location:courses-details.php?courseID=".$courseID);
  
}   
}
?>
<script src="./js/function.js"></script>