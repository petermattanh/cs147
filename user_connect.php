<?php
if($_SESSION['register']) {
	include('register.php');
} else {
	include('login.php');
}