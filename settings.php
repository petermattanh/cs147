<div data-theme="a" data-role="page" id="settings">

	<div data-role="header" data-theme="b">
		<h1>Settings</h1>
	</div><!-- /header -->

	<div data-role="content">
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
		
			<div data-role="content" data-theme="a">
				<div data-role="fieldcontain" data-theme="a">
					<a href="taskedit.php" data-role="button" data-ajax="false">Edit Tasklist</a>
				</div>
				<div data-role="fieldcontain" data-theme="a">
					<a href="timeedit.php" data-role="button" data-ajax="false">Edit Time Blocks</a>
				</div><br>
				<div data-role="fieldcontain" data-theme="b">
					<a href="index.php" data-role="button" data-ajax="false">Finished Editing!</a>
				</div>
	</div><!-- /content -->

	<div data-role="popup" id="help">
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
	...popup contents go here...
	</div>
	<div data-role="footer" data-id="samebar" class="nav-glyphish-example" data-position="fixed" data-tap-toggle="false">
		<div data-role="navbar" class="nav-glyphish-example" data-grid="a">
			<ul>
				<li><form action="logout.php" method="post" data-ajax="false"><input type="submit" value="Log Out" data-disabled="false"/></form></li>
				<li><a href="#help" class="pageButton" data-role="button" data-rel="popup">Help</a></li>

			</ul>
		</div>
	</div>
</div>