<?php
	session_start();
	if(isset($_COOKIE['user'])) {
		$userData = unserialize(stripslashes($_COOKIE['user']));

		if($userData['init']) {
			include_once('../connect.php');
			$timeblocks;
			$stmt = $mysqli->stmt_init();
			if($stmt->prepare('SELECT username, cookie, list, timeblock FROM users WHERE id=?')) {
				// Bind parameters
				$stmt->bind_param('i', $userData['user_id']);

				$stmt->execute();

				// bind results
				$stmt->bind_result($username, $cookie, $list, $timeblock);
				while($stmt->fetch()) {
					$_SESSION['username'] = $username;
					$_SESSION['data']     = unserialize(stripslashes($cookie));
					$_SESSION['list']     = unserialize(stripslashes($list));
					$timeblocks           = unserialize(stripslashes($timeblock));
				}
			}
			$stmt->close();
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
		header('Location: login.php'); // should provide a login
	}
?>
<!DOCTYPE html> 
<html>
<?php include('header.php'); ?>	
<body> 

<!-- Start of home page: #home -->
<div data-role="page" data-theme="a" id="home">
	<div data-role="header" data-theme="a">
		<h1><?php echo $title; ?></h1>
	</div><!-- /header -->

	<?php
		if(isset($_SESSION['last_page'])) {
			echo '<p> Congratulations! You finished initializing your account! </p>';
			unset($_SESSION['last_page']);
		}
	?>

	<div data-role="content">
		<h2>Welcome <?php echo $_SESSION['username']; ?> </h2>
		<?php echo $timeBlockHtml; ?>
	</div><!-- /content -->
	<div data-role="popup" id="help">
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
	...popup contents go here...
	</div>
	<?php include('footer.php'); ?>
</div>
<!-- End of home page -->

<!-- Settings page -->
<?php include('settings.php'); ?>

</body>
</html>