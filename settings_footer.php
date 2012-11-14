<div data-role="footer" data-id="samebar" class="nav-glyphish-example" data-position="fixed" data-tap-toggle="false">
	<div data-role="navbar" class="nav-glyphish-example" data-grid="b">
		<ul>
			<li><form action="logout.php" method="post" data-ajax="false"><input type="submit" value="Log Out" data-theme="b" data-disabled="false"/></form></li>
			<li><a href="#help" class="pageButton" data-role="button" data-theme="b" data-rel="popup">Help</a></li>

			<li><a href="index.php#settings" id="next" class="pageButton" data-role="button" data-theme="b" data-ajax="false">Finished Editing</a></li>
			
		</ul>
	</div>
</div>

	<?php
		if(isset($_SESSION['last_page'])) {
			if($_SESSION['last_page'] == 2) {
		 		echo '<script>document.getElementById("next").href="timeedit.php";</script>';
		   	}
		 	else{
		 		echo '<script>document.getElementById("next").href="index.php"</script>';
		 	}
		 }
	?>

<script type="text/javascript">

/* The script below will insert the username wherever it finds the
 * #username id */
if($.cookie('username') != null){//This checks whether the username cookie exists.
	$('#username').text($.cookie('username'));
} else {
	$('#username').text("ERROR: NO USERNAME FOUND");
}

</script>