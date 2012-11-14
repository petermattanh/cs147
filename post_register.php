<?php
	session_start();
	include_once("../connect.php");

	$username = $_POST["username"];
	$password = $_POST["password"];
	$default = $_POST["default"];
	
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
	
	if($default == "yes"){
		$timeblocks = array(5, 10, 20); // set default time blocks
				// insert this time block as default
		$update = $mysqli->stmt_init();
		$update->prepare("UPDATE users SET timeblock=? WHERE id=?");
		$update->bind_param('si', $timeblocksStr, $userData['user_id']);
		$timeblocksStr = serialize($timeblocks);
		$update->execute();
		$update->close();

		$list = array("washingtonpost"=>3, "Youtube"=>1, "nytimes"=>2, "economist"=>2);
		$categories = array
		 (
		  "washingtonpost"=>array
		  (
		  "lifestyle"
		  ),
		  "Youtube"=>array
		  (
		  "comedy"
		  ),
		  "nytimes"=>array
		  (
		  "world"
		  ),
		  "economist"=>array
		  (
		  "business"
		  )
		 );

		$listupdate = $mysqli->stmt_init();
		$listupdate->prepare("UPDATE users SET list=? WHERE id=?");
		$listupdate->bind_param('si', $listStr, $userData['user_id']);
		$listStr = serialize($list);
		$listupdate->execute();
		$listupdate->close();
		
		$catUpdate = $mysqli->stmt_init();
		$catUpdate->prepare("UPDATE users SET categories=? WHERE id=?");
		$catUpdate->bind_param("si", $categoriesStr, $userData['user_id']);
		$categoriesStr = serialize($categories);
		$catUpdate->execute();
		$catUpdate->close();
	}
	$cookie = $mysqli->stmt_init();
	$cookie->prepare("UPDATE users SET cookie=? WHERE id=?");
	$cookie->bind_param('si', $userDataStr, $userId);
	$cookie->execute();
	$cookie->close();
	$mysqli->close();
	$_SESSION['last_page'] = 1;

	if($default == "yes") header('Location: index.php');
	else header('Location: taskedit.php');
?>
