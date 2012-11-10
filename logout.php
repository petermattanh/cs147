<?php
	session_start();
	include('../connect.php');

	$expire = time()-3600;
	$stmt = $mysqli->stmt_init();

	setcookie('user', "", $expire);
	header('Location: login.php');
	session_destroy();
?>