<?php
	$link = mysql_connect('mysql-user-master.stanford.edu', 'ccs147pphan92', 'aihietho');
	if(!$link) {
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db('c_cs147_pphan92');
?>