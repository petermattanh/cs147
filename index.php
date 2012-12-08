<<<<<<< HEAD
<?php
	session_start();

	if(isset($_COOKIE['user'])) {
		$userData = unserialize(stripslashes($_COOKIE['user']));

		if($userData['init']) {
			include_once('../connect.php');
			$timeblocks;
			$stmt = $mysqli->stmt_init();
			if($stmt->prepare('SELECT username, categories, cookie, list, timeblock FROM users WHERE id=?')) {
				// Bind parameters
				$stmt->bind_param('i', $userData['user_id']);

				$stmt->execute();

				// bind results
				$stmt->bind_result($username, $categories, $cookie, $list, $timeblock);
				while($stmt->fetch()) {
					$_SESSION['username']   = $username;
					$_SESSION['categories'] = unserialize(stripslashes($categories));
					$_SESSION['data']       = unserialize(stripslashes($cookie));
					$_SESSION['list']       = unserialize(stripslashes($list));
					
					$timeblocks             = unserialize(stripslashes($timeblock));
				}
			}
			$stmt->close();
			
			if(!$timeblocks || empty($timeblocks)) {
				$timeblocks = array(5, 10, 15);
				$timeblocksStr = serialize(($timeblocks));
				$stmt = $mysqli->stmt_init();
				$stmt->prepare("UPDATE users SET timeblock=? WHERE id=?");
				$stmt->bind_param('si', $timeblocksStr, $userData['user_id']);
				$stmt->execute();
				$stmt->close();
			}
			// timeblocks should be an array of times

			$timeBlockHtml = '<ul id="pages">';
			for($i=0; $i < count($timeblocks); $i++) {
				$timeBlockHtml .= '<li><a href="content.php?time='.($timeblocks[$i]*60).'" class="pageButton" data-theme="a" data-role="button" data-ajax="false">';
				$timeBlockHtml .= 'I have ' . $timeblocks[$i] . ' minutes!</a></li>';
			}	
	
			$timeBlockHtml .= '</ul>';
			$mysqli->close();
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
		<p><a href="#Announcements" data-role="button" data-icon="info" data-iconpos="notext" data-rel="popup" data-inline="true">Notice</a><b>Announcements!</b></p>
		<h2>Welcome <?php echo $_SESSION['username']; ?> </h2>
		<h3>How much time do you have?</h3>
		<p><b>Choose from your preset TimeBlocks:</b></p>
		<p><a href="#explain" data-role="button" data-icon="info" data-iconpos="notext" data-rel="popup" data-inline="true">What do I do?></a><b>What do I do? / What are these time blocks buttons?</b></p>
		<?php echo $timeBlockHtml; ?>
		<form name="taskform" id="taskform" action="newtime.php" method="post" data-ajax="false">
			<label for="timewanted"><b>Or input a new time (in minutes):</b></label>
			<input type="range" name="time" id="timewanted" value="1" min="1" max="60" data-highlight="true" data-mini="true" />
			<input type="submit" id="sbmt" value="Go!" data-disabled="false" data-inline="true" data-theme="b"/>
		</form>
				
	</div><!-- /content -->
	<div data-role="popup" id="explain">
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete">Close</a>
		<p>Press one of the time block buttons for how much time you have free or how much time you want to spend on the application.  We will give you a task to do in the time you've entered. </p>
	</div>
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
	<div data-role="popup" id="help">
		<h2> Home Page Help </h2>
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
		<div data-role="collapsible-set">

			<div data-role="collapsible">
				<h3>What do I do?</h3>
				<p>Choose the amount of free time you currently have and upon selecting that amount, you will be given a story based on this indication and the items you indicated in your tasklist.</p>
			</div>
			<div data-role="collapsible">
				<h3>How do I do it?</h3>
					<p> Either choose your amount of free time from the preset timeblocks you created or by dragging the slider to the desired number in minutes and clicking "go"!. </p>
			</div>
	
		</div>
		<?php /*
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
		<p>Get started by choosing the amount of free time you have either from the preset timeblocks you created or by dragging the slider to the desired number in minutes and clicking "go"!. </p>
		<p>Upon selecting the amount of free time you have, you will be given a story based on this amount of time and the items you indicated in your tasklist.</p> 	
		*/ ?>
	</div>
	<?php include('footer.php'); ?>
</div>
<!-- End of home page -->

<!-- Settings page -->
<?php include('settings.php'); ?>

</body>
=======
<?php
	session_start();

	if(isset($_COOKIE['user'])) {
		$userData = unserialize(stripslashes($_COOKIE['user']));

		if($userData['init']) {
			include_once('../connect.php');
			$timeblocks;
			$stmt = $mysqli->stmt_init();
			if($stmt->prepare('SELECT username, categories, cookie, list, timeblock FROM users WHERE id=?')) {
				// Bind parameters
				$stmt->bind_param('i', $userData['user_id']);

				$stmt->execute();

				// bind results
				$stmt->bind_result($username, $categories, $cookie, $list, $timeblock);
				while($stmt->fetch()) {
					$_SESSION['username']   = $username;
					$_SESSION['categories'] = unserialize(stripslashes($categories));
					$_SESSION['data']       = unserialize(stripslashes($cookie));
					$_SESSION['list']       = unserialize(stripslashes($list));
					
					$timeblocks             = unserialize(stripslashes($timeblock));
				}
			}
			$stmt->close();
			
			if(!$timeblocks || empty($timeblocks)) {
				$timeblocks = array(5, 10, 15);
				$timeblocksStr = serialize($timeblocks);
				$stmt = $mysqli->stmt_init();
				$stmt->prepare("UPDATE users SET timeblock=? WHERE id=?");
				$stmt->bind_param('si', $timeblocksStr, $userData['user_id']);
				$stmt->execute();
				$stmt->close();
			}
			// timeblocks should be an array of times

			$timeBlockHtml = '<ul id="pages">';
			for($i=0; $i < count($timeblocks); $i++) {
				$timeBlockHtml .= '<li><a href="content.php?time='.($timeblocks[$i]*60).'" class="pageButton" data-theme="a" data-role="button" data-ajax="false">';
				$timeBlockHtml .= 'I have ' . $timeblocks[$i] . ' minutes!</a></li>';
			}	
	
			$timeBlockHtml .= '</ul>';
			$mysqli->close();
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
		<h3>How much time do you have?</h3>
		<p><b>Choose from your preset times:</b></p>
		<?php echo $timeBlockHtml; ?>
		<form name="taskform" id="taskform" action="newtime.php" method="post" data-ajax="false">
			<label for="timewanted"><b>Or input a new time (in minutes):</b></label>
			<input type="range" name="time" id="timewanted" value="1" min="1" max="60" data-highlight="true" data-mini="true" />
			<input type="submit" id="sbmt" value="Go!" data-disabled="false" data-inline="true" data-theme="b"/>
		</form>
				
	</div><!-- /content -->
	<div data-role="popup" id="help">
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
		<p>Get started by choosing the amount of free time you have either from the preset timeblocks you created or by dragging the slider to the desired number in minutes and clicking "go"!. </p>
		<p>Upon selecting the amount of free time you have, you will be given a story based on this amount of time and the items you indicated in your tasklist.</p> 	
	</div>
	<?php include('footer.php'); ?>
</div>
<!-- End of home page -->

<!-- Settings page -->
<?php include('settings.php'); ?>

</body>
>>>>>>> 58e1d36a034b4d5c3b02b84a004d7680b8a6beda
</html>