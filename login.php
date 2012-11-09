<?php session_start(); ?>
<!DOCTYPE html> 
<html> 
<?php include('header.php'); ?>	
<body> 

<div data-role="page" data-theme="a" id="login">

	<div data-role="header" data-theme="a">
		<h1><?php echo $title; ?></h1>
	</div><!-- /header -->
	<?php
		if(isset($_SESSION['error'])) {
			echo '<p class="error"> '.$_SESSION['error'].'</p>';
			unset($_SESSION['error']);
		}
	?>
	<div data-role="content">
		<h2>Log In:</h2>
			<div align="center" style="background-color:#cfcfcf; opacity:0.5; margin-left:auto; margin-right:auto; width:80%; padding:3%; color:#000000;">
			<form action="submit.php" method="post" data-ajax="false">

			<div data-role="fieldcontain" data-theme="a">
				<label>Username: <input type="text" name="username" id="username"/></label>
			</div>
		
			<div data-role="fieldcontain" data-theme="a">
				<label>Password: <input type="password" name="password" autocapitalize="off" /></label>
    		</div>
		
			<input type="submit" name="Submit" value="Go!&raquo;" data-disabled="false" />
			
	    	
			</form>
			</div>	

	</div><!-- /content -->
	<div data-role="footer" data-theme="a" data-position="fixed">
		<h2>   New to <?php echo $title; ?>? Sign up <a href='register.php' data-disabled="false">here</a>!</h2>
	</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>