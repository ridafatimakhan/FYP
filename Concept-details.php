<?php require('./hf/header.php'); //Muallim's Main Header ?>
<script src="./js/function.js"></script>
<?php require('./panel-header.php') ;//Muallim's Panel Header 

if(isset($_GET['sectionID']) && $_GET['sectionID'] != "" && isset($_GET['courseID']) && $_GET['courseID'] !="" && isset($_GET['chapter_id']) && $_GET['chapter_id'] !=""  && isset($_GET['concept_id']) && $_GET['concept_id'] !=""){
    $courseID = $_GET['courseID'];
    $sectionID = $_GET['sectionID'];
    $chapter_id = $_GET['chapter_id'];
    $concept_id = $_GET['concept_id'];

}else{
    header("location:Concept-details.php?courseID=".$courseID."&sectionID=".$sectionID."&chapter_id=".$chapter_id."&concept_id=".$concept_id);
     exit();
   }
?>
<!-- 
	Muallim's Inner Page Content Start -->
<div class="ip-banner">
	<div class="color-bg"></div>
	    <div class="img-bg"></div>
	      <div class="container">	
		    <div class="ip-banner-blurb">	
		    <div class="courses-btn">
				<a class="ex-btn btn-border" href="#basic"><i class="fas fa-link"></i> Basic Learning</a><br>
				<!-- <a class="ex-btn btn-border" href="#advance"><i class="fas fa-link"></i> Advanced Learning</a> -->
			</div>
		</div>
	</div>
</div>
<div class="bred-contain">
	<div class="container" id="top">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active"><a href="#">Courses</a></li>
		</ol>
	</div>
</div>

<div class="content ip-content">
	<div class="container-fw">
		<?php require('./sidebar-panel.php'); //Muallim's Sidebar ?>
		<div class="ip-main">
			
        <div class="courses-list" id="basic">
        <a href="Add-Questions.php?courseID=<?php echo $courseID; ?>&sectionID=<?php echo $sectionID ?>&chapter_id=<?php echo $chapter_id; ?>&concept_id=<?php echo $concept_id; ?>" class="btn btn-success btn-lg active" role="button" aria-pressed="true">Add Questions</a>
</div>
        </div>
    </div>
</div>

