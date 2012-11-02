<?php
	include_once("../connect.php");

	// there's no santizing forms... i'm too lazy
	// no salt and hash either =O
	$username = $_POST['username'];
	$password = $_POST['password'];

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
	$timeBlocksStr = serialize($timeBlocks);
	$listStr       = serialize($list);

	$query = "INSERT INTO users(username, password, list, timeblock)
	VALUES ('$username', '$password', '$listStr', '$timeBlocksStr')";
	$query = mysql_query($query, $con);
	if(!$query) {
		die('Error: ' . mysql_error());
	}

	// need to grab user id from DB
	$query = "SELECT id FROM users WHERE username='$username' AND password='$password'";
	$query = mysql_query($query, $con);
	if(!$query) {
		die('Error: ' . mysql_error());
	}

	$userId;
	// should only be one row
	while($row = mysql_fetch_array($query)) {
		$userId = $row['id'];
	}
	$userData = array("user_id" => $userId,
						"init" => true);
	$userDataStr = serialize($userData);

	// store userData array
	$query = "UPDATE users SET cookie='$userDataStr' WHERE id=$userId";
	$query = mysql_query($query, $con);
	if(!$query) die('Error: ' . mysql_error());


	echo 'successsss';
	// redirect back to home page
	//header('Location: index.php');


?>