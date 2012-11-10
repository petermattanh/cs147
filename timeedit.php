<?php
	session_start();
	require('show_times.php');
?>
<!DOCTYPE html> 
<html>
<?php include('header.php'); ?>	
<body> 

<div data-role="page" data-theme="a" id="timeedit" class="buttonNav" data-add-back-btn="true">
	<div data-role="header" data-theme="a">
		<h1>Edit TimeList!</h1>
	</div><!-- /header -->
	<?php
		if(isset($_SESSION['last_page'])) {
			echo '<p> Your tasklist has been successfully saved! Now set up your time blocks! </p>';
			$_SESSION['last_page'] = 2;
		}
	?>

	<div data-role="content" data-theme="a">
			<div style="background-color:#cfcfcf;">
				<form name="timeform" id="timeform" action="set_time.php" method="post" data-ajax="false">
				<div data-role="fieldcontain" data-theme="a">
					<label for="timeblock">Free Time (in minutes):</label>
 					<input type="range" name="timeblock" id="slider" value="1" min="1" max="60" />
 					<input type="submit" value="Add Timeblock!" data-disabled="false"/>
				</div>				
				</form>
			</div>
			<?php echo $timeBlockHtml; ?>
		
	</div><!-- /content -->
	<div data-role="popup" id="help">
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
	...popup contents go here...
	</div>
	<?php include('settings_footer.php'); ?>
</div>

<!-- End of home page -->


</body>
</html>