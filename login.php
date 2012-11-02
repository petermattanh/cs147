<!DOCTYPE html> 
<html> 
<?php include('header.php'); ?>	
<body> 

<div data-role="page" data-theme="b" id="login">

	<div data-role="header">
		<h1>BLiST LogIn</h1>
	</div><!-- /header -->
	<?php
		if(isset($_SESSION['error'])) {
			echo '<p> '.$_SESSION['error'].'</p>';
		}
	?>
	<div data-role="content">
		<form action="submit.php" method="post">

		<div data-role="fieldcontain">
			<label>Username: <input type="text" name="username" id="username"/></label>
		</div>
		<div data-role="fieldcontain">
			<label>Password: <input type="password" name="password" autocapitalize="off" /></label>
    	</div>
		
		<input type="submit" name="Submit" value="Log In&raquo;" data-disabled="false"/>
	    	
		</form>	
		<p>New to BLiST? Sign up <a href='register.php'>here</a>!</p>

	</div><!-- /content -->

</div><!-- /page -->

</body>
</html>