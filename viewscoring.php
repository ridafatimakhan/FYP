<?php require('./hf/header.php'); //Muallim's Main Header ?>
<?php require('./panel-header.php'); //Muallim's Panel Header ?>
<script src="./js/function.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

<!-- Muallim's Panel Start -->
<div class="content ip-content admin-panel">
	<div class="container-fw">

		<div class="ip-main">
			<div class="t-wrap">

				<?php require('./panel-head-option.php'); //Muallim's Sidebar ?>

				<div class="panel-content">
                <?php
include('top.html');?>
					<h4><i class="fas fa-book-open"></i>Learners Garded Test Record</h4>

					<div class="table-sec" style="font-family:Jameel Noori Nastaleeq;font-size:20px; ">
						<?php
		                    $sql = "SELECT * FROM GradedTest" ;
                            $params = array();
                            $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                            $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                            $row_count = sqlsrv_num_rows( $stmt );
                            
                            if($row_count>0){

                            $srNo=1; ?>
						
 <table cellpadding="0" cellspacing="0">
 <tr>
 <th  scope="col">Sr No</th>
 <th  scope="col">User Name</th>
 <th  scope="col">Start Time</th>
 <th  scope="col">End Time</th>

 <th  scope="col">correct Answers</th>
 <th  scope="col">Total Questions</th>
 <th  scope="col">Obatined Score</th>
 <th  scope="col">Total Marks</th>

</tr>
<?php while ( $row = sqlsrv_fetch_array( $stmt) ){
 ?>
 <tr>
     <td><?php echo $srNo; ?></td>
     <td><?php echo getUserName($row['user_id']); ?> </td>
     <td><?php echo $row['start_time']; ?></td>
   
     <td><?php echo $row['end_time']; ?></td>
   
 
     
     <td><?php echo $row['correct_answers']; ?></td>
     <td><?php echo $row['total_questions']; ?></td>
     <td><?php echo $row['score']; ?></td>
     <td><?php echo $row['total_marks']; ?></td>


 </tr>
 <?php
 $srNo++;
 }?>
</table>
<?php }else{
echo "No Learner Record Found";
} ?>

</div>
</div>
</div>
</div>
</div>

<!-- Muallim's Inner Page Content End -->

</div>


<?php require('./hf/footerNOMAN.php'); //Muallim's Main footers