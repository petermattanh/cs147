<<<<<<< HEAD
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
	<div data-role="popup" id="Announcements">
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete">Close</a>
		<p>November 24th 2012</p>
		<p>Time Hacks version 1.0 currently allows subscriptions to the New York Times, the Washington Post, and the Economist.</p>
		<p>Version 2.0 will allow:
			<ul style="list-style:none;">
			<li>- Syncing to an E-Reader(e.g. Kindle) to add books to the task list</li>
			<li>- Blog and Magazine Subscriptions</li>
			<li>- Subscriptions to audio intake(podcast, audio ebooks, etc.);</li>
		</ul>
		</p>
	</div>
	<div data-role="popup" id="explain">
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete">Close</a>
		<p>Time blocks are estimates of how much free time you normally have.  If for example, you usually have 30 minututes free</p>
		<p>everyday, then you should add a time block of 30 minutes.</p>
		<p>Later on, when you want to receive an activity, we'll give you content that fits into 30 minutes of your free time.</p>
		<p>Have a time block of 15 minutes? Next time you're free for 15 minutes, you could receive a 15 minute youtube video to watch!</p> 
	</div>
	<div data-role="content" data-theme="a">
	<p><a href="#Announcements" data-role="button" data-icon="info" data-iconpos="notext" data-rel="popup" data-inline="true">Notice</a><b>Announcements!</b></p>
	<p><a href="#explain" data-role="button" data-icon="info" data-iconpos="notext" data-rel="popup" data-inline="true">What do I do?></a><b>What do I do? / What are time blocks?</b></p>
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

			<div data-role="collapsible" data-collapsed="true">
				<h3>What am I doing here?</h3>
				<p>Are there certain amounts of time that you know you'll have free on a regular basis? If so, add them to your list of time blocks to avoid having to manually input them each time!</p>
			</div>
			<div data-role="collapsible">
				<h3>How do I do it?</h3>
				<div data-role="collapsible" data-collapsed="true">
					<h3>Add TimeBlock</h3>
					<p>Drag the slider bar to the desired amount of time (the time is indicated in minutes), and click "Add Timeblock!" to add it to your list of free time chunks! </p>
				</div>
				<div data-role="collapsible" data-collapsed="true">
					<h3>Delete TimeBlock</h3>
					</p> Click on the button with the timeblock you'd like to remove from the list to delete it.</p>
				</div>		
			</div>

			<div data-role="collapsible" data-collapsed="true">
				<h3>Other tips</h3>
				<?php
				if(!isset($_SESSION['last_page'])) 
					echo '<p> When finished, click "Finished" to return to the settings menu! </p>';
				else echo '<p> When finished, click "Finished" to return to the finish initialization! </p>';
				?>
			</div>
	
		</div>
	</div>
	<?php include('settings_footer.php'); ?>
</div>

<!-- End of home page -->


</body>
=======
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
		<h1>Edit Times!</h1>
	</div><!-- /header -->
	<?php
		if(isset($_SESSION['last_page'])) {
			echo '<p> Your preferences have been saved! Now pick a time to spend on your activity. </p>';
			$_SESSION['last_page'] = 1;
		}
	?>

	<div data-role="content" data-theme="a">
				<form name="timeform" id="timeform" action="set_time.php" method="post" data-ajax="false">
				<div data-role="fieldcontain" data-theme="a">
					<label for="timeblock">Free Time (in minutes):</label>
 					<input type="range" name="timeblock" id="slider" data-highlight="true" data-theme="b" value="1" min="1" max="60" /><br><br>
 					<input type="submit" value="Add this time!" data-disabled="false"/>
				</div>				
				</form>
				<h2>Your Times:</h2>

			<?php echo $timeBlockHtml; ?>
		
	</div><!-- /content -->
	<div data-role="popup" id="help">
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
	<p>Are there certain amounts of time that you know you'll have free on a regular basis? If so, add them to your list of time blocks to avoid having to manually input them each time!</p>
	<p><b>To add:</b> Drag the slider bar to the desired amount of time (the time is indicated in minutes), and click "Add Timeblock!" to add it to your list of free time chunks! </p>
	<p><b>To remove:</b> Click on the button with the timeblock you'd like to remove from the list to delete it.</p>
	<?php
			if(!isset($_SESSION['last_page'])) {
			echo '<p> When finished, click "Finished" to return to the settings menu! </p>';
		}
	?>
	</div>
	<?php include('settings_footer.php'); ?>
</div>

<!-- End of home page -->


</body>
>>>>>>> 58e1d36a034b4d5c3b02b84a004d7680b8a6beda
</html>