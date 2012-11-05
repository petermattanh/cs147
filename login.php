<?php session_start(); ?>
<!DOCTYPE html> 
<html> 
<?php include('header.php'); ?>	
<body> 

<div data-role="page" data-theme="b" id="login">

	<div data-role="header">
		<h1><?php echo $title; ?> Log In</h1>
	</div><!-- /header -->
	<?php
		if(isset($_SESSION['error'])) {
			echo '<p class="error"> '.$_SESSION['error'].'</p>';
			unset($_SESSION['error']);
		}
	?>
	<div data-role="content">
		<form action="submit.php" method="post" data-ajax="false">

		<div data-role="fieldcontain">
			<label>Username: <input type="text" name="username" id="username"/></label>
		</div>
		<div data-role="fieldcontain">
			<label>Password: <input type="password" name="password" autocapitalize="off" /></label>
    	</div>
		
		<input type="submit" name="Submit" value="Log In&raquo;" data-disabled="false" />
	    	
		</form>	
		<p>New to <?php echo $title; ?>? Sign up <a href='register.php'>here</a>!</p>

	</div><!-- /content -->

</div><!-- /page -->

</body>
</html>