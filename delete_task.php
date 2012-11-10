<?php
	session_start();
	include('../connect.php');

	$query = $_GET['task'];
	$pos = strpos($query, '-');
	$medium = substr($query, 0, $pos);

	$category = substr($query, $pos+1);
	$stmt = $mysqli->stmt_init();
	$stmt->prepare("SELECT list, categories FROM users WHERE id=?");
	$stmt->bind_param('i', $_SESSION['data']['user_id']);
	$stmt->bind_result($list, $categories);
	$stmt->execute();

	if($stmt->fetch()) {
		$categories = unserialize(stripslashes($categories));
		
		$cats = $categories[$medium];
		$length = count($cats);
		for($i=0; $i<$length; $i++) {

			// find category to unset
			if($cats[$i] == $category) {
				unset($cats[$i]);
				$stmt->close();
	
				$cats = array_values($cats);
				
				if(count($cats) == 0) {
					// medium no longer has any categories
					// so remove from categories
					unset($categories[$medium]);

					// remove from list if no categories remain
					$list = unserialize(stripslashes($list));
					unset($list[$medium]);

					// update list
					$updateList = $mysqli->stmt_init();
					$updateList->prepare("UPDATE users SET list=? WHERE id=?");
					$updateList->bind_param('si', $list, $_SESSION['data']['user_id']);

					$list = serialize($list);

					if(!$updateList->execute()) die($updateList->error);
					$updateList->close();

				} else {
					$categories[$medium] = $cats;
				}
						
				$categories = serialize($categories);

				// update categories
				$updateCat = $mysqli->stmt_init();
				$updateCat->prepare("UPDATE users SET categories=? WHERE id=?");
				$updateCat->bind_param('si', $categories, $_SESSION['data']['user_id']);
						
				$updateCat->execute();
				$updateCat->close();
				$mysqli->close();
				header('Location: taskedit.php');
				exit();
			}
		}

	} else {
		die($stmt->error);
	}
