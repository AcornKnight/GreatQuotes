<?php
session_start();
// if the user is not logged in, redirect them to the public page

	unset($_SESSION['username']);
	header('location: ../../index.php');
// use the following guidelines to create the function in auth.php
$_SESSION['logged']=false;
session_destroy();
// redirect the user to the public page.
header('location: ../../index.php');
?>