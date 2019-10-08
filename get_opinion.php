<?php
session_start();
include_once 'includes/dbconnect.php';
if(isset($_SESSION['uid']) == "" && isset($_SESSION['fname']) == "" && isset($_SESSION['batch']) == "")
{
	header("Location: index.php");
}

$info = mysql_real_escape_string($_POST['info']);

echo $info;

?>