<div data-role="footer" data-id="samebar" class="nav-glyphish-example" data-position="fixed" data-tap-toggle="false">
	<div data-role="navbar" class="nav-glyphish-example" data-grid="a">
		<ul>
			<li><a href="#settings" class="pageButton" data-role="button">Settings</a></li>
			<li><a href="#help" class="pageButton" data-role="button">Help</a></li>
		</ul>
	</div>
</div>

<script type="text/javascript">

/* The script below will insert the username wherever it finds the
 * #username id */
if($.cookie('username') != null){//This checks whether the username cookie exists.
	$('#username').text($.cookie('username'));
} else {
	$('#username').text("ERROR: NO USERNAME FOUND");
}

</script>
