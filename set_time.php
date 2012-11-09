<?php
	include_once("../connect.php");

	if(isset($_COOKIES['user']))
	{
		$username = $_COOKIES['user'];
		$list = array();
		
		// timeblock array, if your settings form modifies gives users the option
		// of adding their own timeblock, $timeBlocks should be modified
		$timeBlocks    = array(); // time blocks of 5 and 10 minutes
		$timeBlocks[]  = intval($_POST['timeblock']);
		$timeBlocksStr = serialize($timeBlocks);
		$query = "UPDATE users SET timeblock='$timeBlockStr' WHERE id='$username'";
		$query = mysql_query($query, $con);
		if(!$query) {
			die('Error: ' . mysql_error());
		}
	}

	
?>