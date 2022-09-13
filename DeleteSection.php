<?php require('./includes/connection.php'); 

$courseID="";
$sectionID="";
if(isset($_GET['sectionID']) && $_GET['sectionID'] != "" && $_GET['courseID'] && $_GET['courseID'] != ""){
    $courseID = $_GET['courseID'];
    $sectionID = $_GET['sectionID'];
    $sql = "SELECT COUNT(*) AS tot FROM Chapters WHERE section_id='$sectionID'";
    $stmt = sqlsrv_query( $conn, $sql );
    $result =sqlsrv_query($conn,$sql);
    $result2 =sqlsrv_fetch_array($result);
    $row_count = sqlsrv_num_rows( $stmt );
    if($result2['tot'] == 0){  
        
        $sql = "DELETE FROM Sections WHERE section_id = '$sectionID'";
        $params = array();
        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
        $result =sqlsrv_query($conn,$sql);
        $row = sqlsrv_num_rows($stmt);
 
        $_SESSION['Succesmsg'] = "Deleted Successfully";
        header("location:courses-details.php?courseID=".$courseID);
      
    }
else{

    $_SESSION['DeleteMsg'] = "Delete Chapters First";
    header("location:courses-details.php?courseID=".$courseID);
  
}   
}
?>
<script src="./js/function.js"></script>