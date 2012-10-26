<!DOCTYPE html> 
<html>
<?php include('header.php'); ?>	
<body> 

<!-- Start of home page: #home -->
<div data-role="page" id="home">
	<div data-role="header">
		<h1>Blist</h1>
	</div><!-- /header -->

	<div data-role="content">	
		<ul id="pages">
			<li><a href="#time" class="pageButton" data-role="button">I have time!</a></li>
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