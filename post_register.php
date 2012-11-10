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
	$id->close();
	$expire = time()+60*60*24*30; // a month
	$userData = array(
		"user_id" => $userId,
		"init" => true);
	$_SESSION['data'] = $userData;
	$userDataStr = serialize($userData);
	setcookie('user', $userDataStr, $expire);
	// redirect back to home page

	$cookie = $mysqli->stmt_init();
	$cookie->prepare("UPDATE users SET cookie=? WHERE id=?");
	$cookie->bind_param('si', $userDataStr, $userId);
	$cookie->execute();
	$cookie->close();
	$mysqli->close();
	$_SESSION['last_page'] = 1;
	header('Location: taskedit.php');
?>
