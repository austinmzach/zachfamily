<?php session_start();

	session_destroy();

	$page = "index";
	header("Location: login.php?page=$page");
?>