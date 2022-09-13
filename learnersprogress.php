<?php require('./hf/header.php'); //Muallim's Main Header ?>
<?php require('./panel-header.php'); //Muallim's Panel Header ?>
<script src="./js/function.js"></script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

<!-- Muallim's Inner Page Content Start -->
	<div class="ip-banner">
		<div class="color-bg"></div>
		    <div class="img-bg"></div>
		        <div class="container">	
		          <div class="ip-banner-blurb">	
		<h1 style="color:white; text-align:center;font-family: 'Jameel Noori Nastaleeq'">Muallim User's Monitoring</h1>

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
	font-family: 'Jameel Noori Nastaleeq';"</h4>

Learners Progress Monitoring  </h4>
<?php				
include('top.html');?>		


<?php $approved = $rejected = $pending = 0;


$approved = getTotLearners("approved");
$pending = getTotLearners("pending");
$rejected = getTotLearners("reject");

?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>


<canvas id="myChart" style="width:100%;max-width:600px"></canvas>

<script>
var xValues = ["Reject", "Approved", "Pending"];
var yValues = [<?php echo $rejected; ?>, <?php echo $approved; ?>, <?php echo $pending; ?>];
var barColors = ["red", "lightgreen","blue"];

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
      text: ""
    }
  }
});
</script>


<script>
@font-face {
	font-family: 'Jameel Noori Nastaleeq';
	src: url('http://www.fontsaddict.com/fontface/jameel-noori-nastaleeq.ttf');
  }
</script>	  
</div>
</div>
</div>
<div>

</div>
</div>
<?php require('./hf/footerNOMAN.php'); ?>

</div>


