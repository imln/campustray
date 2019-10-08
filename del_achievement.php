<?php 
session_start();
include_once 'includes\dbconnect.php';
if(isset($_SESSION['uid']) =="" && isset($_SESSION['fname']) =="" && isset($_SESSION['batch']) =="")
{
	header("Location:index.php");
}

	if(isset($_POST['del_ach_btn'])){
		$ach_id = $_POST['ach_id'];
		$del_sql = " DELETE FROM achievement WHERE ach_id= $ach_id ";
		$retval = mysql_query($del_sql);
			if(! $retval )
			{
				die('Error while deleting.... ' . mysql_error());
			}else{
				echo "<script>alert('Record Deleted..'); window.open('profile.php?rcol=achievement','_self'); </script>";
			}
	}else{
		echo "<script> window.open('home.php','_self'); </script>";
	}
?>