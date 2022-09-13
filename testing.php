<?php include "includes/Connection.php"; 




$stmt = "SELECT * From Questions where ques_no=1";
$params=array();

$query = sqlsrv_query( $conn, $stmt); 
while($row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC )){ ?>


<h1><?php echo $row['ques_statement']; ?></h1><br>
<h3><?php echo $row['option1']; ?></h3><br>
<h3><?php echo $row['option2']; ?></h3><br>
<h3><?php echo $row['option3']; ?></h3><br>
<h3><?php echo $row['option4']; ?></h3><br>
<h3><?php echo $row['hint1']; ?></h3><br>

<?php }





?>