<?php
	include('../../connect.php');

	$id = 3;
	
	$query = 'SELECT * FROM users WHERE id="'. $id .'"';
	$query = mysql_query($query, $con);
	var_dump($query);
	while($row = mysql_fetch_array($query)) {
		echo "<p>" . $row['username'] . "</p>";
		echo "<p>" . $row['password'] . "</p>";
		echo "<p>" . $row['timeblock'] . "</p>";
		echo "<p>" . $row['cookie'] . "</p>";
	}
	// if(!mysql_query($sql,$con)) {
	// 	$_SESSION['error'] = 'Error: Malformed cookie, no user exists in database by id of ' . $userData['user_id'];
	// 	die($_SESSION['error']);
	// }
	// $url = 'http://www.washingtonpost.com/world/national-security/cia-rushed-to-save-diplomats-as-libya-attack-was-underway/2012/11/01/c93a4f96-246d-11e2-ac85-e669876c6a24_story.html?hpid=z1';

	// $file = file_get_contents($url);
	
	// $start = "<div blah blah";
	// $dom = new DOMDocument();
	// @$dom->loadHTML($file);
	// var_dump($dom);
	// $domx = new DOMXPath($dom);
	
?>