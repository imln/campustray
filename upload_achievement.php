<?php 
session_start();
include_once 'includes\dbconnect.php';
if(isset($_SESSION['uid']) =="" && isset($_SESSION['fname']) =="" && isset($_SESSION['batch']) =="")
{
	header("Location:index.php");
}

	if(isset($_POST['addachbtn'])){
		$ach_uid = $_SESSION['uid'];
		$ach_content = mysql_real_escape_string($_POST['ach_content']);
		
		
				$achquery = "INSERT INTO achievement(ach_uid,ach_content) VALUES('$ach_uid','$ach_content')";
				if(mysql_query($achquery)){
					echo "<script>alert('Successfully added...'); window.open('profile.php?rcol=achievement','_self'); </script>";
				}else{
					echo "<script>alert('error while adding....'); window.open('profile.php?rcol=addachievement','_self'); </script>";
				}
	}else{
		echo "<script> window.open('home.php','_self'); </script>";
	}	
?>