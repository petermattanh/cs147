	<?php
	session_start();
	if(isset($_COOKIE['user'])) {
		$userData = unserialize(stripslashes($_COOKIE['user']));

		if($userData['init']) {
			include_once('../connect.php');
			$timeblocks;

			$query = 'SELECT * FROM users WHERE id="'. $userData['user_id'] .'"';
			$query = mysql_query($query, $con);

			if(!$query) {
				$_SESSION['error'] = 'Error: Malformed cookie, no user exists in database by id of ' . $userData['user_id'];
				die('ERROR');
				header('Location: login.php');
			}


			// should only be one row
			$row = mysql_fetch_array($query);
			$_SESSION['username'] = $row['username'];
			$_SESSION['data'] = unserialize(stripslashes($row['cookie']));
			$_SESSION['list'] = unserialize(stripslashes($row['list']));
			$timeblocks = unserialize(stripslashes($row['timeblock']));
			if(!$timeblocks) {
				$timeblocks = array(); // set default time blocks
			}
			// timeblocks should be an array of times

			$timeBlockHtml = '<ul data-role="listview"><li data-role="fieldcontain"><fieldset data-role="controlgroup">';
			for($i=0; $i < count($timeblocks); $i++) {
				$timeBlockHtml .= '<input type="submit" name="'.$timeblocks[$i].'" value="'.$timeblocks[$i].' minutes" data-icon="delete"/>';
			}	
	
			$timeBlockHtml .= '</fieldset></li></ul>';
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

<div data-role="page" data-theme="a" id="timeedit" class="buttonNav" data-add-back-btn="true">
	<div data-role="header" data-theme="a">
		<h1>Edit TaskList!</h1>
	</div><!-- /header -->
	<?php
		if(isset($_SESSION['last_page'])) {
			echo '<p> Your tasklist has been successfully saved! Now set up your time blocks! </p>';
			$_SESSION['last_page'] = 2;
		}
	?>

	<div data-role="content" data-theme="a">
			<div style="background-color:#cfcfcf;">
				<form name="timeform" id="timeform" action="set_time.php" method="post" data-ajax="false">
				<div data-role="fieldcontain" data-theme="a">
					<label for="slider">Free Time (in minutes):</label>
 					<input type="range" name="timeblock" id="slider" value="1" min="1" max="60" />
 					<input type="submit" value="Add Timeblock!" data-disabled="false"/>
				</div>				
				</form>
			</div>
			<div>
				<form name="delete" id="delete" action="delete_time.php" method="post" data-ajax="false">
					<?php echo $timeBlockHtml; ?>
				</form>
			</div>
		
	</div><!-- /content -->
	<div data-role="popup" id="help">
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
	...popup contents go here...
	</div>
	<?php include('settings_footer.php'); ?>
</div>

<!-- End of home page -->


</body>
</html>