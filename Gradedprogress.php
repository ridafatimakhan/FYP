<?php require('./hf/header.php'); //Muallim's Main Header ?>
<?php require('./panel-header.php'); //Muallim's Panel Header 

?>


<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

<!-- Muallim's Inner Page Content Start -->
	<div class="ip-banner">
		<div class="color-bg"></div>
		    <div class="img-bg"></div>
		        <div class="container">	
		          <div class="ip-banner-blurb">	
		<h1 style="color:white; text-align:center;font-family: 'Jameel Noori Nastaleeq'">Muallim User's Interactive Learning Monitoring</h1>

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
	<h4>

Learners Graded Tests Progress Monitoring  </h4>
<canvas id="myChart" style="width:100%;max-width:600px"></canvas>
<script>
	function getColorCode() {
      var makeColorCode = '0123456789ABCDEF';
      var code = '#';
      for (var count = 0; count < 6; count++) {
         code =code+ makeColorCode[Math.floor(Math.random() * 16)];
      }
      return code;
   }
	xValues = [];
	yValues = [];
	barColors = [];

<?php
$sql = "SELECT user_id, score FROM GradedTest ORDER BY user_id";
$params = array();
$options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$stmt = sqlsrv_query($conn, $sql, $params, $options);
$result = sqlsrv_query($conn, $sql);

$row_count = sqlsrv_num_rows($stmt); 
if ($row_count > 0) {
	while ($row = sqlsrv_fetch_array($stmt)) {
		?>
		xValues.push("<?php echo getUserName($row['user_id']); ?>");
		yValues.push("<?php echo $row['score'] ?>");
		barColors.push(getColorCode());
		<?php
	}
}
?>

</script>

<canvas id="myChart" style=""></canvas>

<script>

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Muallim Graded Test Progress Monitoring"
    }
  }
});
</script>

<?php include('top.html');?>		

</div>
</div>
</div>
<div>

</div>
</div>
<?php require('./hf/footerNOMAN.php'); ?>

</div>
