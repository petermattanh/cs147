<!DOCTYPE html> 
<?php
	if($_COOKIE["user"]) {
		print_r($_COOKIE["user"]);
		die();
		// make queries and show normal buttons
	} else {
		// redirect to register
	}

?>

<html>
<?php include('header.php'); ?>	
<body> 

<!-- Start of home page: #home -->
<div data-role="page" id="home">
	<div data-role="header">
		<h1>Blist</h1>
	</div><!-- /header -->

	<div data-role="content">
		<h2>Welcome <span id="username"></span></h2>
		<ul id="pages">		
			<li><a href="#task" class="pageButton" data-role="button">I have 5 minutes!</a></li>
			<li><a href="#task" class="pageButton" data-role="button">I have 10 minutes!</a></li>
			<li><a href="#task" class="pageButton" data-role="button">I have 15 minutes!</a></li>
			<li><a href="#settings" class="pageButton" data-role="button">Settings</a></li>
			<li><a href="#exit" class="pageButton" data-role="button">Exit</a></li>
		</ul>
	</div><!-- /content -->
	<?php include('footer.php'); ?>
</div>
<!-- End of home page -->

<!-- maybe instead of including all of these pages, we can just update
	what goes in content using the DOM object -->
<!-- I have time! page -->
<?php include('time.php'); ?>

<!-- Settings page -->
<?php include('settings.php'); ?>

<!-- Exit button... probably involves some script, does nothing for now -->
<div data-role="page" id="exit"></div>

</body>
</html>