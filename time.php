<!DOCTYPE html> 
<html>
<?php
	include('header.php'); 
	include('../connect.php'); 
?>	
<body> 


<div data-role="page" data-theme="b" id="task" class="buttonNav" data-add-back-btn="true">

	<div data-role="header" data-theme="b">
		<h1><?php echo $activity; ?></h1>
		<p href="#" id="timer" style="padding: 3px; cursor:pointer;" onclick="thTimer.toggleDisplay()" class="ui-btn-right"></p>
	</div><!-- /header -->

	<div data-role="content">	
		<script type="text/javascript">
			window.onload = thTimer.initTimer('timer', <?php echo $_GET['time']; ?>);
		</script>
		<p><a href="index.php" data-direction="reverse" data-role="button" data-theme="b">Back to Home page</a></p>	
		
	</div><!-- /content -->
	
	<?php include('footer.php'); ?>
</div>
<!-- Settings page -->
<?php include('settings.php'); ?>
</body>
</html>