<?php
	$timewanted = $_POST['time'];
	$redir = 'content.php?time='.($timewanted*60);
	header('Location: ' .$redir);
?>