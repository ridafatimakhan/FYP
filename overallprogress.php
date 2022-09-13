<?php require('./hf/header.php'); //Muallim's Main Header ?>
<?php require('./panel-header.php'); //Muallim's Panel Header ?>
<script src="./js/function.js"></script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
<style>
   h5{
      color:green;
         font-size:20px;
          font-weight:bolder; 
   }

</style>
<!-- Muallim's Inner Page Content Start -->
	<div class="ip-banner">
		<div class="color-bg"></div>
		    <div class="img-bg"></div>
		        <div class="container">	
		          <div class="ip-banner-blurb">	
		<h1 style="color:white; text-align:center;font-family: 'Jameel Noori Nastaleeq'"></h1>

		    <div class="courses-btn">
		    <a class="ex-btn btn-border" href="#basic"><i class="fas fa-link"></i></a><br>
		<!-- <a class="ex-btn btn-border" href="#advance"><i class="fas fa-link"></i> Advanced Learning</a> -->
    </div>
		</div>
		     </div>
                  </div>
                  
<div class="content ip-content">
	<div class="container-fw">
		<?php require('./sidebar-panel.php'); //Muallim's Sidebar ?>
		<div class="ip-main">
		<div class="courses-list" id="basic">
		<h4 style="color: #286029; line-height: 45px; padding-left: 2%; background: #fff; border-top: 5px solid #286029; @font-face {
	font-family: 'Jameel Noori Nastaleeq';">

Overall Course Progress  </h4>



<h5  >Chapters </h5>
<?php
$user_id=$_SESSION['userID'];
$sql = "SELECT * FROM chapters";

$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$result =sqlsrv_query($conn,$sql);

$row_count = sqlsrv_num_rows( $stmt );

if($row_count>0){    
    ?>
    <table class="table">
            <thead>
                <tr>
                    <th>Sr #</th>
                    <th>Chapter Name</th>
                    <th>Read Status</th>

                </tr>
            </thead>
            <tbody>
            <?php
            $srno = 1;
            while ($row = sqlsrv_fetch_array( $stmt)){
               
                $chapter_id = $row['chapter_id'];
                
                $user_id=$_SESSION['userID'];

                $checkStatus = checkChapterReadStatus($chapter_id,$user_id);
                ?>
                <tr>
                    <td><?php echo $srno; ?></td>
                    <td><?php echo $row['chapter_name']; ?></td>
                    <td><?php if($checkStatus == 1){ ?><img src="images/check.png" style="height:30px; width:30px;"> <?php echo "Done "; }else{  ?> <img src="images/expired.png" style="height:30px; width:30px;"> <?php echo "Pending";} ?></td>
                </tr>

                <?php
                $srno++;

            }
            ?>
            </tbody>
        </table>
    <?php
}
?>










<h5> Concepts </h5>
<?php
$sql = "SELECT * FROM Concepts "; 
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$result =sqlsrv_query($conn,$sql);

$row_count = sqlsrv_num_rows( $stmt );

if($row_count>0){    
    ?>
    <table class="table">
            <thead>
                <tr>
                    <th>Sr #</th>
                    <th>Concept Name</th>
                    <th>Status</th>

                </tr>
            </thead>
            <tbody>
            <?php
            $srno = 1;
            while ($row = sqlsrv_fetch_array( $stmt)){
                $courseID = $row['course_id'];
                $sectionID = $row['section_id'];
                $chapter_id = $row['chapter_id'];
                $conceptID= $row['concept_id'];
                $user_id=$_SESSION['userID'];

                $checkStatus = checkConceptAttempt($courseID,$sectionID,$chapter_id,$conceptID,$user_id);
                ?>
                <tr>
                    <td><?php echo $srno; ?></td>
                    <td><?php echo $row['concept_name']; ?></td>
                    <td><?php if($checkStatus == 1){ ?><img src="images/check.png" style="height:30px; width:30px;"> <?php echo "Done "; }else{  ?> <img src="images/expired.png" style="height:30px; width:30px;"> <?php echo "Pending";} ?></td>
            </tr>

                <?php
                $srno++;

            }
            ?>
            </tbody>
        </table>
    <?php
}
?>


<!--- Graded Test -->





<h5>GradedTest </h5>
<?php
$user_id=$_SESSION['userID'];
$sql = "SELECT * FROM chapters";

$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$result =sqlsrv_query($conn,$sql);

$row_count = sqlsrv_num_rows( $stmt );

if($row_count>0){    
    ?>
    <table class="table">
            <thead>
                <tr>
                    <th>Sr #</th>
                    <th>Chapter Name</th>
                    <th>Test Status</th>

                </tr>
            </thead>
            <tbody>
            <?php
            $srno = 1;
            while ($row = sqlsrv_fetch_array( $stmt)){
                $courseID = $row['course_id'];
                $sectionID = $row['section_id'];
                $chapter_id = $row['chapter_id'];
                
                $user_id=$_SESSION['userID'];

                $checkStatus = checkGradedAttempt($courseID,$sectionID,$chapter_id,$user_id);
                ?>
                <tr>
                    <td><?php echo $srno; ?></td>
                    <td><?php echo $row['chapter_name']; ?></td>
                    <td><?php if($checkStatus == 1){ ?><img src="images/check.png" style="height:30px; width:30px;"> <?php echo "Done "; }else{  ?> <img src="images/expired.png" style="height:30px; width:30px;"> <?php echo "Pending";} ?></td>
               </tr>

                <?php
                $srno++;

            }
            ?>
            </tbody>
        </table>
    <?php
}




?>

