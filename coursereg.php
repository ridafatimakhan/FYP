<?php require('./hf/header.php'); //Muallim's Main Header ?>
<?php require('./panel-header.php') ;//Muallim's Panel Header ?>
<script src="./js/function.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">





<!-- Muallim's Inner Page Content Start -->
	<div class="ip-banner">
		<div class="color-bg"></div>
		    <div class="img-bg"></div>
		        <div class="container">	
		          <div class="ip-banner-blurb">	
		<h1 style="color:white; text-align:center;">Let's Learn Seerat-un-Nabi(PBUH)</h1>

		    <div class="courses-btn">
		    <a class="ex-btn btn-border" href="#basic"><i class="fas fa-link"></i> Basic Learning</a><br>
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

Courses Progress Monitoring  </h4>
<?php				
include('top.html');?>		
<?php

$data = getTotCourse();
// print_r($data);

?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>


<canvas id="myChart1" style="width:100%;"></canvas>

<script>

var xValues = [];
var yValues = [];
<?php    
foreach ($data as $courseName => $studentCount){
    //echo $courseName;
	//echo "Key-value pair is: "."(".$courseName.", ".$studentCount.")";
   //echo "<br>";
   ?>
   xValues.push("<?php echo $courseName;?>");
   yValues.push("<?php echo $studentCount; ?>");


   <?php
}
?>

 var barColors = ["#cfe0e8", "#f9d5e5","#d6d4e0","#96ceb4"];

new Chart("myChart1", {
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
      text: "Muallim Courses Progress"
    }
  }
});
</script>

    
			
		

			<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    
$('.delete').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
        title: 'Are you sure?',
        text: 'You want to delete this Course',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {
        if (value) {
            window.location.href = url;
        }
    });
});
</script>

<script>
<?php if(isset($_SESSION['successMsg'])){
    $msg = $_SESSION['successMsg'];
	?>
    event.preventDefault();
    swal({
        title: 'Success Message?',
        text: '<?php echo $msg; ?>',
        icon: 'trash',
        buttons: ["OK", "Yes!"],
    }).then(function(value) {
        if (value) {
            // window.location.href = url;
        }
    });
    <?php
	unset($_SESSION['successMsg']);
} ?>
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



