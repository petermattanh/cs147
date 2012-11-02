<?php
/*
	Two cookies
	$_COOKIE['user']
		has serialized data that should contain
		- user id into users table
		- init (boolean that tells you whether the user has initialized and set up yet)
	
	$_COOKIE['timeblock'] which should be a serialized array of time blocks

*/
	if(isset($_COOKIE['user'])) {
		$userData = unserialize($_COOKIE['user']);
		include('connect.php');
		

		if($userData['init']) {
			// user already has cookie and initialized
			$timeblocks = unserialize($_COOKIE['timeblock']);
			// timeblocks should be an array of times

			$timeBlockHtml = '<ul id="pages">';
			for($i=0; $i < count($timeblocks); $i++) {
				$timeBlockHtml .= '<li><a href="#task" class="pageButton" data-role="button">';
				$timeBlockHtml .= 'I have ' . $timeblocks[$i] . ' minutes!</a></li>';
			}

			$timeBlockHtml .= '</ul>';

		} else {
			// not initialized yet
			header('Location: initialize.php');
		}
	} else {
		$expire = time()+60*60*24*30; // a month
		/*
		$array = array(
			"init" => false,
			"user_id" => NULL);
		setcookie('user', serialize($array), $expire);
		header('Location: register.php');
		*/

		$array = array(
			"init" => true,
			"user_id" => 5);
		$timeblock = array(5, 10, 15);
		setcookie('user', serialize($array), $xpire);
		setcookie('timeblock', serialize($timeblock), $expire);
		header('Location: index.php');
	}
	
?>
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
	<?php
		echo $timeBlockHtml;
		/*
		<ul id="pages">		
			<li><a href="#task" class="pageButton" data-role="button">I have 5 minutes!</a></li>
			<li><a href="#task" class="pageButton" data-role="button">I have 10 minutes!</a></li>
			<li><a href="#task" class="pageButton" data-role="button">I have 15 minutes!</a></li>
		</ul>
		*/
	?>
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