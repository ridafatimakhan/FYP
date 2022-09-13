
<?php require('./includes/connection.php'); 
$courseID=$sectionID=$chapter_id="";
if(isset($_GET['sectionID']) && $_GET['sectionID'] != "" && isset($_GET['courseID']) && $_GET['courseID'] !="" && isset($_GET['chapter_id']) && $_GET['chapter_id'] !=""){
  
    $courseID = $_GET['courseID'];
    $sectionID = $_GET['sectionID'];
    $chapter_id = $_GET['chapter_id'];

    $sql = "SELECT COUNT(*) AS tot FROM Concepts WHERE chapter_id = '$chapter_id'";

    $stmt = sqlsrv_query( $conn, $sql );
    $result =sqlsrv_query($conn,$sql);
    $result2 =sqlsrv_fetch_array($result);
    $row_count = sqlsrv_num_rows( $stmt );
    if($result2['tot'] == 0){  
        
        $sql = "DELETE FROM Chapters WHERE chapter_id = '$chapter_id'";
        $params = array();
        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
        $result =sqlsrv_query($conn,$sql);
        $row = sqlsrv_num_rows($stmt);

     $_SESSION['Succesmsg'] = "Deleted Successfully";
    header("location:section-details.php?courseID=".$courseID."&sectionID=".$sectionID);
  
}
else{

    $_SESSION['DeleteMsg'] = "Delete Concepts First";
    header("location:section-details.php?courseID=".$courseID."&sectionID=".$sectionID);
  
}   
}
?>
<script src="./js/function.js"></script>