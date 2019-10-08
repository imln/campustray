<?php
session_start();

if(isset($_SESSION['uid'])=="" && isset($_SESSION['fname'])=="" && !isset($_SESSION['batch'])=="")

{
	header("Location: index.php");
}else{
	header("Location: home.php");
}

if(isset($_GET['logout']))
{
	session_destroy();
	unset($_SESSION['uid']);
	unset($_SESSION['fname']);
	unset($_SESSION['batch']);
	header("Location: index.php");
}
?>