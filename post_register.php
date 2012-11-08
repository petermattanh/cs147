<?php
	include_once("../connect.php");

	// there's no santizing forms... i'm too lazy
	// no salt and hash either =O
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	$list = array();

	// checks if washingtonpost checkbox was checked
	if(isset($_POST['washingtonpost'])) {
		$list['washingtonpost'] = $_POST['washingtonpost_priority'];
	}

	// checks if youtube checkbox was checked
	if(isset($_POST['youtube'])) {
		$list['youtube'] = $_POST['youtube_priority'];
	}

	// timeblock array, if your settings form modifies gives users the option
	// of adding their own timeblock, $timeBlocks should be modified
	$timeBlocks    = array(5, 10); // time blocks of 5 and 10 minutes
	$listStr       = serialize($list);

	$timeBlocks[]  = intval($_POST['timeblock']);
	$timeBlocksStr = serialize($timeBlocks);

	$stmt = $mysqli->stmt_init();

	$userData;
	$userDataStr;
	$userId;

	$stmt->prepare("INSERT INTO users(username, password, list, timeblock) VALUES (?, ?, ?, ?)");
	$stmt->bind_param('ssss', $username, $password, $listStr, $timeBlocksStr);
	if(!$stmt->execute()) {
		die('Error inserting into DB');
	}
	$stmt->close();


	$select = $mysqli->stmt_init();

	// grab user id
	$select->prepare("SELECT id FROM users WHERE username=? AND password=?");
	$select->bind_param('ss', $username, $password);
	if($select->execute()) {
		$select->bind_result($userId);
		$select->fetch();
		$userData = array("user_id" => $userId,
							"init" => true);
		$userDataStr = serialize($userData);

	} else {
		die('Error: ' . $select->error);
	}

	$select->close();
	$update = $mysqli->stmt_init();

	// store userData array
	$update->prepare("UPDATE users SET cookie=? WHERE id=?");
	$update->bind_param("si", $userDataStr, $userId);
	if(!$update->execute()) {
		die('Error: ' . $update->error);
	}

	$expire = time()+60*60*24*30; // a month

	setcookie('user', $userDataStr, $expire);
	// redirect back to home page
	$update->close();
	$mysqli->close();
	header('Location: index.php');
?>