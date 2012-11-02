<?php
/* Added this code in for testing but its not working.  Cookies are not being
 * read here. */
	$expire = time()+60*60*24*30; // a month
	$array = array(
		"init" => true,
		"user_id" => 'test');
	setcookie('user', serialize($array), $expire);
	setcookie('timeblock', null);
	/* This doesn't bypass the registration page thats unimplemented. */
?>
<!DOCTYPE html> 
<html>
<?php include('header.php'); ?>	
<body> 

<div data-role="page" data-theme="b" id="home">
	<div data-role="header" data-theme="b">
		<h1><?php echo $title; ?></h1>
	</div><!-- /header -->

	<div data-role="content">
		<h2>Welcome <?php echo $_SESSION['username']; ?> </h2>
		<h2> We're working on it. The registration page will be up in no time. </h2>
		
		
	</div><!-- /content -->
	<?php include('footer.php'); ?>
</div>
<!-- End of home page -->

<?php include('time.php'); ?>

<!-- Settings page -->
<?php include('settings.php'); ?>

</body>
</html>