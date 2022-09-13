<div class="test-header">
	<h3><?php echo $_SESSION['userFullName']?> <span><?php echo getUserTypeTitle($_SESSION['userRole']);?></span></h3>

	

</div>

<div class="panel-options">
	
	<?php require('sidebar-panel.php'); //Muallim's Sidebar 

	?>
	
</div>