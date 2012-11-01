<!DOCTYPE html> 
<html>
<?php include('header.php'); ?>	
<body> 

<!-- Start of home page: #home -->
<div data-role="page" data-theme="b" id="home">
	<div data-role="header" data-theme="b">
		<h1><?php echo $title; ?></h1>
	</div><!-- /header -->

	<div data-role="content">
		<h2>Welcome <span id="username"></span></h2>
		<ul id="pages">		
			<li><a href="#task" class="pageButton" data-role="button">I have 5 minutes!</a></li>
			<li><a href="#task" class="pageButton" data-role="button">I have 10 minutes!</a></li>
			<li><a href="#task" class="pageButton" data-role="button">I have 15 minutes!</a></li>
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

</body>
</html>