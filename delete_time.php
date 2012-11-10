<?php 
	session_start();
	$index = $_GET['index'];

	include('../connect.php');

	// get current timeblocks
	$select = $mysqli->stmt_init();
	$select->prepare("SELECT timeblock FROM users WHERE id=?");
	$select->bind_param('i', $_SESSION['data']['user_id']);
	$select->bind_result($timeblock);
	$select->execute();
	$select->fetch();

	$timeblock = unserialize(stripslashes(($timeblock)));

	unset($timeblock[$index]);

	// reindex
	$timeblock = array_values($timeblock);
	$select->close();

	// update timeblocks
	$delete = $mysqli->stmt_init();
	$delete->prepare("UPDATE users SET timeblock=? WHERE id=?");
	$delete->bind_param('si', $timeblock, $_SESSION['data']['user_id']);
	$timeblock = serialize($timeblock);

	$delete->execute();
	$delete->close();

	$mysqli->close();

	header('Location: timeedit.php');

?>