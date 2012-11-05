<?php
	include_once("../connect.php");
	$username = $_POST['username'];
	$password = $_POST['password'];
	session_start();

	// need to grab user id from DB
	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
	$query = mysql_query($query, $con);
	if($query) {
		if($row = mysql_fetch_assoc(($query))) {
			$expire = time()+60*60*24*30; // a month
			// set cookie so that when user logs in, they will be redirected to index.php
			setcookie('user', $row['cookie'], $expire);
			header('Location: index.php');
			//exit;
		} else {
			$_SESSION['error'] = 'Password and username combination is incorrect. Please try again.';
			header('Location: login.php');
			//exit;
		}
	}

?>