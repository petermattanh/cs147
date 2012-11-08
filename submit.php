<?php
	session_start();
	include_once("../connect.php");
	$username = $_POST['username'];
	$password = $_POST['password'];

	$stmt = $mysqli->stmt_init();

	if($stmt->prepare("SELECT cookie FROM users WHERE username=? AND password=?")) {
		$stmt->bind_param('ss', $username, $password);
		$stmt->execute();
		$stmt->bind_result($cookie);
		if($stmt->fetch()) {
			$expire = time()+60*60*24*30; // a month
			// set cookie so that when user logs in, they will not be redirected
			setcookie('user', $cookie, $expire);
			header('Location: index.php');
		} else {
			$_SESSION['error'] = 'Password and username combination is incorrect. Please try again.';
			header('Location: login.php');
		}
	}
	$stmt->close();
	$mysqli->close();
?>