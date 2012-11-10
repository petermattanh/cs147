<?php
	session_start();
	include_once("../connect.php");
	$userData = $_SESSION['data'];

	$list = array();
	
	// timeblock array, if your settings form modifies gives users the option
	// of adding their own timeblock, $timeBlocks should be modified
	$stmt = $mysqli->stmt_init();
	$stmt->prepare("SELECT timeblock FROM users WHERE id=?");

	$stmt->bind_param('i', $userData['user_id']);
	$stmt->bind_result($timeblock);
	$stmt->execute();
	$stmt->fetch();

	if(!$timeblock) {
		$timeblock = array();
	} else {
		$timeblock = unserialize(stripslashes(($timeblock)));
	}
	$stmt->close();

	if(!in_array($_POST['timeblock'], $timeblock)) {
		$timeblock[] = $_POST['timeblock'];
		$add = $mysqli->stmt_init();
		if(!$add->prepare("UPDATE users SET timeblock=? WHERE id=?")) {
			die($add->error);
		}
		$timeblock = serialize($timeblock);
		$add->bind_param('si', $timeblock, $userData['user_id']);
		$add->execute();
		$add->close();
	}

	$mysqli->close();

	header('Location: timeedit.php');
?>
