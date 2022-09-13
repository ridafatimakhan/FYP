 <?php 
 require('./includes/connection.php'); 
$courseID=$sectionID=$chapter_id=$concept_id="";

if(isset($_GET['sectionID']) && $_GET['sectionID'] != "" && isset($_GET['courseID']) && $_GET['courseID'] !="" && isset($_GET['chapter_id']) && $_GET['chapter_id'] !=""  && isset($_GET['concept_id']) && $_GET['concept_id'] !=""){
 
    $sectionID = $_GET['sectionID'];
    $courseID = $_GET['courseID'];
    $chapter_id = $_GET['chapter_id'];
  
   $concept_id = $_GET['concept_id'];

   $sql = "DELETE FROM Concepts WHERE concept_id = '$concept_id'";

    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt = sqlsrv_query( $conn, $sql , $params, $options );
    $result =sqlsrv_query($conn,$sql);
   
    $row = sqlsrv_num_rows($stmt);
    if($result){
    echo "Deleted Successfully";
        header("location:Chapter-details.php?sectionID=".$sectionID."&courseID=".$courseID."&chapter_id=".$chapter_id);
        exit();
    }
    else{
        echo "no";
    header("location:Chapter-details.php?courseID=".$courseID."&sectionID=".$sectionID."&chapterid=".$chapter_id);
    }}
    ?>
    <script src="./js/function.js"></script>