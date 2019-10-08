<?php 
session_start();
include_once 'includes\dbconnect.php';
if(isset($_SESSION['uid']) =="" && isset($_SESSION['fname']) =="" && isset($_SESSION['batch']) =="")
{
	header("Location:index.php");
}

	if(isset($_POST['del_emp_info_btn'])){
		$emp_id = $_POST['emp_info_id'];
		$del_sql = " DELETE FROM emp_info WHERE emp_id= $emp_id ";
		$retval = mysql_query($del_sql);
			if(! $retval )
			{
				die('Error while deleting.... ' . mysql_error());
			}else{
				echo "<script>alert('Record Deleted..'); window.open('profile.php?rcol=employmentinfo','_self'); </script>";
			}
	}else{
		echo "<script> window.open('home.php','_self'); </script>";
	}
?>