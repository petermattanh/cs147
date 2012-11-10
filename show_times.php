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
				$timeblocks = array(); // set default time blocks
			}
			// timeblocks should be an array of times

			//$timeBlockHtml = '<ul data-role="listview"><li data-role="fieldcontain"><fieldset data-role="controlgroup">';
			$timeBlockHtml = '<ul data-role"listview" style="list-style: none;">';
			for($i=0; $i < count($timeblocks); $i++) {
				//$timeBlockHtml .= '<input type="submit" name="'.$timeblocks[$i].'" value="'.$timeblocks[$i].' minutes" data-icon="delete"/>';
				$timeBlockHtml .= '<li><a href="delete_time.php?index='.$i.'" data-role="button" data-icon="delete" data-ajax="false" class="delete">'.$timeblocks[$i].'minute(s)</a></li>';
			}	
			$timeBlockHtml .= '</ul>';
			//$timeBlockHtml .= '</fieldset></li></ul>';
		}
	} else {
		header('Location: login.php'); // should provide a login
	}
?>