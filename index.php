<?php
	if(isset($_COOKIE['user'])) {
		$userData = unserialize(stripslashes($_COOKIE['user']));

		if($userData['init']) {
			include_once('../connect.php');
			$timeblocks;

			// start session to store username and relevant data
			session_start();

			$query = 'SELECT * FROM users WHERE id="'. $userData['user_id'] .'"';
			$query = mysql_query($query, $con);

			if(!$query) {
				$_SESSION['error'] = 'Error: Malformed cookie, no user exists in database by id of ' . $userData['user_id'];
				die('ERROR');
				header('Location: register.php');
			}

			// should only be one row
			$row = mysql_fetch_array($query);
			$_SESSION['username'] = $row['username'];
			$_SESSION['data'] = unserialize(stripslashes($row['cookie']));
			$_SESSION['list'] = unserialize(stripslashes($row['list']));
			$timeblocks = unserialize(stripslashes($row['timeblock']));
			if(!$timeblocks) {
				$timeblocks = array(5, 10, 15); // set default time blocks
			}
			// timeblocks should be an array of times

			$timeBlockHtml = '<ul id="pages">';
			for($i=0; $i < count($timeblocks); $i++) {
				$timeBlockHtml .= '<li><a href="time.php?time='.$timeblocks[$i].'" class="pageButton" data-role="button" data-ajax="false">';
				$timeBlockHtml .= 'I have ' . $timeblocks[$i] . ' minutes!</a></li>';
			}	
	
			$timeBlockHtml .= '</ul>';
		}
	} else {
		$expire = time()+60*60*24*30; // a month
		$array = array(
			"init" => false,
			"user_id" => NULL);
		setcookie('user', serialize($array), $expire);
		header('Location: login.php'); // should provide a login
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
		<h2>Welcome <?php echo $_SESSION['username']; ?> </h2>
		<?php echo $timeBlockHtml; ?>
	</div><!-- /content -->
	<?php include('footer.php'); ?>
</div>
<!-- End of home page -->

<!-- Settings page -->
<?php include('settings.php'); ?>

</body>
</html>