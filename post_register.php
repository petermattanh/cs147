<?php
	session_start();
	include_once("../connect.php");

	$username = $_POST["username"];
	$password = $_POST["password"];
	
	$stmt = $mysqli->stmt_init();
	$stmt->prepare("INSERT INTO users(username, password) VALUES(?, ?)");
	$stmt->bind_param("ss", $username, $password);
	$stmt->execute();
	$stmt->close();

	$id = $mysqli->stmt_init();
	$id->prepare("SELECT id FROM users WHERE username=? AND password=?");
	$id->bind_param('ss', $username, $password);
	$id->bind_result($userId);
	$id->execute();
	$id->fetch();

	$expire = time()+60*60*24*30; // a month
	$userData = array(
		"user_id" => $userId,
		"init" => true);
	$userDataStr = serialize($userData);
	$_SESSION['user_id'] = $userId;
	setcookie('user', $userDataStr, $expire);
	// redirect back to home page
	$id->close();
	$mysqli->close();
	$_SESSION['last_page'] = 1;
	header('Location: taskedit.php');
?>
