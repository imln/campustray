


<?php 
session_start();
include_once 'includes\dbconnect.php';
if(isset($_SESSION['uid']) =="" && isset($_SESSION['fname']) =="" && isset($_SESSION['batch']) =="")
{
	header("Location:index.php");
}

	if(isset($_POST['del_edu_info_btn'])){
		$edu_id = $_POST['education_info_id'];
		$del_sql = " DELETE FROM edu_info WHERE edu_id= $edu_id ";
		$retval = mysql_query($del_sql);
			if(! $retval )
			{
				die('Error while deleting.... ' . mysql_error());
			}else{
				echo "<script>alert('Record Deleted..'); window.open('profile.php?rcol=educationinfo','_self'); </script>";
			}
	}else{
		echo "<script> window.open('home.php','_self'); </script>";
	}
?>