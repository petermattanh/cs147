<<<<<<< HEAD
<div data-theme="a" data-role="page" id="settings">

	<div data-role="header" data-theme="a">
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="back" data-iconpos="notext" class="ui-btn-left">Back</a>
		<h1>Settings</h1>
	</div><!-- /header -->

	<div data-role="content">
		
			<div data-role="content" data-theme="a">
				<div data-role="fieldcontain" data-theme="a">
					<a href="taskedit.php" data-role="button" data-ajax="false">Edit Tasklist</a>
				</div>
				<div data-role="fieldcontain" data-theme="a">
					<a href="timeedit.php" data-role="button" data-ajax="false">Edit Time Blocks</a>
				</div><br>
				<div data-role="fieldcontain" data-theme="b">
					<a href="index.php" data-role="button" data-ajax="false">Back To Home</a>
				</div>
	</div><!-- /content -->

	<div data-role="popup" id="help">
		
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
		<div data-role="collapsible-set">

			<div data-role="collapsible">
				<h3>What do I do?</h3>
				<p>Here's where you can edit your task and time preferences for <?php echo $title ?>!</p>
			</div>
			<div data-role="collapsible">
				<h3>How do I do it?</h3>
					<p>Choose <b>"Edit TaskList"</b> to add and remove items from the list of content you'd like to view in your free time.</p>
					<p>Choose <b>"Edit TimeBlocks"</b> to change the chunked amounts of free time that you previously set.</p>
			</div>
			<div data-role="collapsible">
				<h3>Other Tips</h3>
					<p>Clicking <b>"Back To Home Screen"</b> to go back to the home screen. </p>
			</div>

		
				
	</div>
	<div data-role="footer" data-id="samebar" class="nav-glyphish-example" data-position="fixed" data-tap-toggle="false" data-theme="b">
		<div data-role="navbar" class="nav-glyphish-example" data-grid="a">
			<ul>
				<li><form action="logout.php" method="post" data-ajax="false"><input type="submit" value="Log Out" data-disabled="false"/></form></li>
				<li><a href="#help" class="pageButton" data-role="button" data-rel="popup" data-position-to="window">Help</a></li>

			</ul>
		</div>
	</div>
=======
<div data-theme="a" data-role="page" id="settings">

	<div data-role="header" data-theme="a">
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="back" data-iconpos="notext" class="ui-btn-left">Back</a>
		<h1>Settings</h1>
	</div><!-- /header -->

	<div data-role="content">
		
			<div data-role="content" data-theme="a">
				<div data-role="fieldcontain" data-theme="a">
					<a href="taskedit.php" data-role="button" data-ajax="false">Edit Activities</a>
				</div>
				<div data-role="fieldcontain" data-theme="a">
					<a href="timeedit.php" data-role="button" data-ajax="false">Edit Times</a>
				</div><br>
				<div data-role="fieldcontain" data-theme="b">
					<a href="index.php" data-role="button" data-ajax="false">Finished Editing!</a>
				</div>
	</div><!-- /content -->

	<div data-role="popup" id="help">
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
		<p>Here's where you can edit your task and time preferences for <?php echo $title ?>!</p>
		<p>Choose <b>"Edit TaskList"</b> to add and remove items from the list of content you'd like to view in your free time.</p>
		<p>Choose <b>"Edit TimeBlocks"</b> to change the chunked amounts of free time that you previously set.</p>
		<p>Click <b>"Finished Editing"</b> to go back to the home screen. </p>
		<p>**Please note, clicking "Finished Editing" will not take you back to the page you were previously at. To do that, click on the back button in the upper left hand corner. Your settings will all still be saved. </p>
	</div>
	<div data-role="footer" data-id="samebar" class="nav-glyphish-example" data-position="fixed" data-tap-toggle="false" data-theme="b">
		<div data-role="navbar" class="nav-glyphish-example" data-grid="a">
			<ul>
				<li><form action="logout.php" method="post" data-ajax="false"><input type="submit" value="Log Out" data-disabled="false"/></form></li>
				<li><a href="#help" class="pageButton" data-role="button" data-rel="popup">Help</a></li>

			</ul>
		</div>
	</div>
>>>>>>> 58e1d36a034b4d5c3b02b84a004d7680b8a6beda
</div>