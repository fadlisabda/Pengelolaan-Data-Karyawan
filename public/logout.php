<?php 
	require '../app/config/config.php';
	session_start();
	$_SESSION = [];
	session_unset();
	session_destroy();
	header("Location: ".BASEURL);
	exit;
 ?>