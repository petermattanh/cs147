<?php

session_start();
include('../connect.php');

$stmt = $mysqli->stmt_init();

// get post data
$source = $_POST['source'];
$category = $_POST['category'];
$priority = $_POST['priority'];

// get current list and categories
$stmt->prepare("SELECT list, categories FROM users WHERE id=?");
$stmt->bind_param('i', $id);
$id = $_SESSION['data']['user_id'];

$stmt->bind_result($list, $categories);
$stmt->execute();
$stmt->fetch();

if(!$list) {
	$list = array();
} else {
	$list = unserialize(stripslashes(($list)));
}

if(!$categories) {
	$categories = array();
} else {
	$categories = unserialize(stripslashes($categories));
}

// set priority
$list[$source] = $priority;

if(!$categories[$source]) {
	$categories[$source] = array();
}

if(!in_array($category, $categories[$source])) {
	// add category to source if it's not in there
	$categories[$source][] = $category;
}

$listStr = serialize($list);
$categoriesStr = serialize($categories);

$stmt->close();

$update = $mysqli->stmt_init();
$update->prepare("UPDATE users SET list=? WHERE id=?");
$update->bind_param('si', $listStr, $id);
$update->execute();
$update->close();

$catUpdate = $mysqli->stmt_init();
$catUpdate->prepare("UPDATE users SET categories=? WHERE id=?");
$catUpdate->bind_param("si", $categoriesStr, $id);
$catUpdate->execute();
$catUpdate->close();

$mysqli->close();

header('Location: taskedit.php');
?>