<?php
 require('includes/Connection.php'); 
 require('includes/functions.php'); //Muallim's Main Functions 

$chapterID = $_POST['chapID'];
$userid = $_POST['userid'];

if(checkChapterReadStatus($chapterID,$userid) == 0){


$query="INSERT INTO chapterreadstatus (user_id,chapter_id)VALUES('$userid','$chapterID')";
$options = sqlsrv_query($conn , $query);
}
echo 1;

?>