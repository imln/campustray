<?php 
session_start();
include_once 'dbconnect.php';
if(isset($_SESSION['uid']) =="" && isset($_SESSION['fname']) =="" && isset($_SESSION['batch']) =="")
{
	header("Location:index.php");
}

	if(isset($_POST['story_content'])){
		
		$story_uid = $_SESSION['uid'];
		$story_content = mysql_real_escape_string($_POST['story_content']);
		echo $story_content;
		$story_ip = $_SERVER['REMOTE_ADDR'];
		
		$story_query = "INSERT INTO stories(story_uid,story_content,story_ip) VALUES('$story_uid','$story_content','$story_ip')";
		if(!mysql_query($story_query)){
			
			die('could not saved ' . mysql_error());
			echo "<script>alert('error while posting....'); </script>";
				
		}
		
		
	}
?>


