<?php 
session_start();
include_once 'includes\dbconnect.php';
if(isset($_SESSION['uid']) =="" && isset($_SESSION['fname']) =="" && isset($_SESSION['batch']) =="")
{
	header("Location:index.php");
}

	if(isset($_POST['addempinfobtn'])){
		$emp_uid = $_SESSION['uid'];
		$emp_workat = mysql_real_escape_string($_POST['emp_workat']);
		$emp_role = mysql_real_escape_string($_POST['emp_role']);
		$emp_sm = mysql_real_escape_string($_POST['emp_sm']);
		$emp_sy = mysql_real_escape_string($_POST['emp_sy']);
		$emp_em = mysql_real_escape_string($_POST['emp_em']);
		$emp_ey = mysql_real_escape_string($_POST['emp_ey']);
		
				$eduquery = "INSERT INTO emp_info(emp_uid,emp_workat,emp_role,emp_sm,emp_sy,emp_em,emp_ey) VALUES('$emp_uid','$emp_workat','$emp_role','$emp_sm','$emp_sy','$emp_em','$emp_ey')";
				if(mysql_query($eduquery)){
					echo "<script>alert('Successfully added...'); window.open('profile.php?rcol=employmentinfo','_self'); </script>";
				}else{
					echo "<script>alert('error while adding....'); window.open('profile.php?rcol=addemploymentinfo','_self'); </script>";
				}
	}else{
		echo "<script> window.open('home.php','_self'); </script>";
	}	
?>