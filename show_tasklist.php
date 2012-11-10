<?php
if(isset($_COOKIE['user'])) {
	$userData = unserialize(stripslashes($_COOKIE['user']));

	if($userData['init']) {
		include_once('../connect.php');
		$timeblocks;
		$stmt = $mysqli->stmt_init();
		if($stmt->prepare('SELECT username, cookie, categories FROM users WHERE id=?')) {
			// Bind parameters
			$stmt->bind_param('i', $userData['user_id']);

			$stmt->execute();

			// bind results
			$stmt->bind_result($username, $cookie, $categories);
			while($stmt->fetch()) {
				$_SESSION['username'] = $username;
				$_SESSION['data']     = unserialize(stripslashes($cookie));
				$categories = unserialize(stripslashes($categories));
			}
		}
		$stmt->close();
		if(!$categories) {
			$categories = array(); 
		}

		$taskListHtml = '<ul style="list-style-none">';	
		foreach($categories as $source => $cat) {
			if(!$cat) {
				continue;
			}
			for($i=0; $i < count($cat); $i++) {
				if($source == "Youtube") {
					$taskListHtml .= '<li><a href="delete_task.php?task='.$source.'-'.$cat[$i].'" data-role="button" data-ajax="false" data-icon="delete">'.'Watch '.$cat[$i].' videos on Youtube'.'</a></li>';
				} else {
					$taskListHtml .= '<li><a href="delete_task.php?task='.$source.'-'.$cat[$i].'" data-role="button" data-ajax="false" data-icon="delete">'.'Read '.$cat[$i].' articles on ';
					if($source == "washingtonpost"){
						$taskListHtml .= ' The Washington Post.';
					}
					if($source == "economist"){
						$taskListHtml .= ' The Economist.';
					}
					if($source == "nytimes"){
						$taskListHtml .= ' The New York Times.';
					}
					$taskListHtml .= '</a></li>';
				}

			}
		}
		$taskListHtml .= '</ul>';
	}
	else {
		header('Location: login.php'); // should provide a login
	}
}
?>