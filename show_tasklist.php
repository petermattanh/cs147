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

		$taskListHtml = '<ul data-role="listview"><li data-role="fieldcontain"><fieldset data-role="controlgroup">';				
		foreach($categories as $source => $cat) {
			if(!$cat) {
				$cat = array();
			}
			for($i=0; $i < count($cat); $i++) {
				if( $source == "Youtube") {
					$taskListHtml .= '<input type="submit" name="'.$source.'-'.$cat[$i].'" value=" Watch '.$cat[$i].' videos on Youtube" data-icon="delete"/>';
				} 
				else {
					$taskListHtml .= '<input type="submit" name="'.$source.'-'.$cat[$i].'" value=" Read '.$cat[$i].' articles on ';
					if($source == "washingtonpost"){
						$taskListHtml .= ' The Washington Post." data-icon="delete"/>';
					}
					if($source == "economist"){
						$taskListHtml .= ' The Economist." data-icon="delete"/>';
					}
					if($source == "nytimes"){
						$taskListHtml .= ' The New York Times." data-icon="delete"/>';
					}
				}

			}
		}	
		$taskListHtml .= '</fieldset></li></ul>';
	}
	else {
		header('Location: login.php'); // should provide a login
	}
}
?>