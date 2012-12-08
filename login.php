<?php session_start(); ?>
<!DOCTYPE html> 
<html> 
<?php include('header.php'); ?>	
<body> 

<div data-role="page" data-theme="a" id="login">
	<div data-role="popup" id="Announcements">
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete">Close</a>
		<p>November 24th 2012</p>
		<p>Time Hacks version 1.0 currently allows subscriptions to the New York Times, the Washington Post, and the Economist.</p>
		<p>Version 2.0 will allow:
			<ul style="list-style:none;">
			<li>- Syncing to an E-Reader(e.g. Kindle) to add books to the task list</li>
			<li>- Blog and Magazine Subscriptions</li>
			<li>- Subscriptions to audio intake(podcast, audio ebooks, etc.);</li>
		</ul>
		</p>
	</div>

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
		<p><a href="#Announcements" data-role="button" data-icon="info" data-iconpos="notext" data-rel="popup" data-inline="true">Notice</a><b>Announcements!</b></p>
		<h2>New to TimeHacks? <a href="register.php" data-ajax="false" >Sign up</a> today and start managing your free time.</h2>
			<div align="center" style="background-color:#cfcfcf; opacity:0.5; margin-left:auto; margin-right:auto; width:80%; padding:3%; color:#000000;">
			<form action="submit.php" method="post" data-ajax="false">

			<div data-role="fieldcontain" data-theme="a">
				<label>Username: <input type="text" name="username" id="username"/></label>
			</div>
		
			<div data-role="fieldcontain" data-theme="a">
				<label>Password: <input type="password" name="password" autocapitalize="off" /></label>
    		</div>
		
			<input type="submit" name="Submit" value="Login&raquo;" data-disabled="false" />
			
	    	
			</form>
			</div>	

	</div><!-- /content -->
	<div data-role="footer" data-id="samebar" class="nav-glyphish-example" data-position="fixed" data-tap-toggle="false">
		<div data-role="navbar" class="nav-glyphish-example">
			<ul>
				<li><a href="#help" class="pageButton" data-role="button" data-theme="b" data-rel="popup" data-position-to="window">What is TimeHacks?</a></li>				
			</ul>
		</div>
	</div>
<div data-role="popup" id="help">
	<h2> Login Help </h2>
	<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
	<div data-role="collapsible-set">

			<div data-role="collapsible" data-collapsed="false">
				<h3>What is TimeHacks?</h3>
				<p>TimeHacks, new from PMA Labs, gives you the latest news and videos 
when and where you want them.  With a click of a button, you can 
catch up on up-to-the-minute events and the hottest viral videos.
Short on time? No worries.  TimeHacks gives you the content that can exactly
fit your schedule.</p>
				</div>
			<div data-role="collapsible">
				<h3>Creators</h3>
				<p> PMA Labs- Peter Phan, Matthew Mau, Anh Truong </p>
			</div>
	

		</div>

	</div>
</div>
	<!-- 
	<div data-role="footer" data-theme="a" data-position="fixed">
		<h2>   New to <?php echo $title; ?>? Sign up <a href='register.php' data-disabled="false">here</a>!</h2>
	</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>
<script type='text/javascript'>
  window.setTimeout("$('#Announcements').popup('open')", 200);
</script>
