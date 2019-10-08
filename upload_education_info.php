<?php 
session_start();
include_once 'includes\dbconnect.php';
if(isset($_SESSION['uid']) =="" && isset($_SESSION['fname']) =="" && isset($_SESSION['batch']) =="")
{
	header("Location:index.php");
}
	if(isset($_POST['addbtn'])){
		$edu_uid = $_SESSION['uid'];
		$edu_yoj = mysql_real_escape_string($_POST['edu_yoj']);
		$edu_yoc = mysql_real_escape_string($_POST['edu_yoc']);
		$edu_inst = mysql_real_escape_string($_POST['edu_inst']);
		$edu_desc = mysql_real_escape_string($_POST['edu_desc']);
		
		if( $edu_yoc > $edu_yoj){
			if( $edu_inst != "" && $edu_desc != ""){
				$eduquery = "INSERT INTO edu_info(edu_uid,edu_yoj,edu_yoc,edu_inst,edu_desc) VALUES('$edu_uid','$edu_yoj','$edu_yoc','$edu_inst','$edu_desc')";
				if(mysql_query($eduquery)){
					echo "<script>alert('Successfully added...'); window.open('profile.php?rcol=educationinfo','_self'); </script>";
				}else{
					echo "<script>alert('error while posting....'); window.open('profile.php?rcol=addeducationinfo','_self'); </script>";
				}
			}else{
				echo "<script>alert('institution and education description is required'); window.open('profile.php?rcol=addeducationinfo','_self'); </script>";
			}
		}else{
			echo "<script>alert('year of joining must be less then year of completion'); window.open('profile.php?rcol=addeducationinfo','_self'); </script>";
		}
		
	}else{
		echo "<script> window.open('home.php','_self'); </script>";
	}
?>