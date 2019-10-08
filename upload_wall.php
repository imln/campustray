<?php 
session_start();
include_once 'includes/dbconnect.php';
if(isset($_SESSION['uid']) =="" && isset($_SESSION['fname']) =="" && isset($_SESSION['batch']) =="")
{
	header("Location:index.php");
}

	if(isset($_POST['wall_content'])){
		
		$wall_content = mysql_real_escape_string($_POST['wall_content']);
		$wall_rcvr_uid = mysql_real_escape_string($_POST['wall_rcvr_uid']);
		$wall_sndr_uid = mysql_real_escape_string($_SESSION['uid']);
		$wall_ip = $_SERVER['REMOTE_ADDR'];
				
				$wall_query = "INSERT INTO wall_details(wall_rcvr_uid,wall_sndr_uid,wall_content,wall_ip) VALUES('$wall_rcvr_uid','$wall_sndr_uid','$wall_content','$wall_ip')";
				if(mysql_query($wall_query)){
					echo "successfully posted...";
				}else{
					die('error while posting...'.mysql_error());
				}
	}else{
		header("location:home.php");
	}	
?>