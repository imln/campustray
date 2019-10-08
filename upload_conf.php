<?php 
session_start();
include_once 'includes/dbconnect.php';
if(isset($_SESSION['uid']) =="" && isset($_SESSION['fname']) =="" && isset($_SESSION['batch']) =="")
{
	header("Location:index.php");
}

	if(isset($_POST['conf_content'])){
		
		$conf_content = mysql_real_escape_string($_POST['conf_content']);
		$conf_uip = $_SERVER['REMOTE_ADDR'];
				
				$conf_query = "INSERT INTO anony_confession(conf_content,conf_uip) VALUES('$conf_content','$conf_uip')";
				if(mysql_query($conf_query)){
					echo "<script>alert('Successfully posted...'); window.open('home.php','_self'); </script>";
				}else{
					echo "<script>alert('error while posting....'); window.open('home.php','_self'); </script>";
				}
	}else{
		echo "<script> window.open('home.php','_self'); </script>";
	}	
?>