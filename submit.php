<?php
	include_once("../connect.php");
	$username = $_POST['username'];
	$password = $_POST['password'];

	// need to grab user id from DB
	$query = "SELECT id FROM users WHERE username='$username' AND password='$password'";
	$query = mysql_query($query, $con);
	if($query) {
		while($row = mysql_fetch_array(($query))) {
			redirect('index.php');
		}
		$_SESSION['error'] = 'Password and username combination is incorrect. Please try again.';
		redirect('login.php')	
	}

?>