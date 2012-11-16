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
			$_SESSION['last_page'] = 1;
		}
	?>

	<div data-role="content" data-theme="a">
				<form name="timeform" id="timeform" action="set_time.php" method="post" data-ajax="false">
				<div data-role="fieldcontain" data-theme="a">
					<label for="timeblock">Free Time (in minutes):</label>
 					<input type="range" name="timeblock" id="slider" data-highlight="true" data-theme="b" value="1" min="1" max="60" /><br><br>
 					<input type="submit" value="Add Timeblock!" data-disabled="false"/>
				</div>				
				</form>
				<h2>Your TimeBlocks:</h2>

			<?php echo $timeBlockHtml; ?>
		
	</div><!-- /content -->
	<div data-role="popup" id="help">
		<h2> Time Edit Help </h2>
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
		<div data-role="collapsible-set">

			<div data-role="collapsible">
				<h3>What am I doing here?</h3>
				<p>You're here to add or delete time blocks.</p>
				<div data-role="collapsible">
					<h3>How do I do it?</h3>
					<div data-role="collapsible">
						<h3>Add Time</h3>
						<p></p>
					</div>
					<div data-role="collapsible">
						<h3>Delete Time</h3>
						</p></p>
					</div>		
				</div>
			</div>
			<div data-role="collapsible">
				<h3>Other tips</h3>
				<p> Tips </p>
			</div>
	
		</div>
	<?php /*
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
	<p>Are there certain amounts of time that you know you'll have free on a regular basis? If so, add them to your list of time blocks to avoid having to manually input them each time!</p>
	<p><b>To add:</b> Drag the slider bar to the desired amount of time (the time is indicated in minutes), and click "Add Timeblock!" to add it to your list of free time chunks! </p>
	<p><b>To remove:</b> Click on the button with the timeblock you'd like to remove from the list to delete it.</p>
	<?php
			if(!isset($_SESSION['last_page'])) {
			echo '<p> When finished, click "Finished" to return to the settings menu! </p>';
		}
	?>
	*/
	?>
	</div>
	<?php include('settings_footer.php'); ?>
</div>

<!-- End of home page -->


</body>
</html>