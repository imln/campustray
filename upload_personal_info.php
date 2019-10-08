<?php 
session_start();
include_once 'includes\dbconnect.php';
if(isset($_SESSION['uid']) =="" && isset($_SESSION['fname']) =="" && isset($_SESSION['batch']) =="")
{
	header("Location:index.php");
}
	if(isset($_POST['pinfosave'])){
		$pinfo_uid = $_SESSION['uid'];
		$pinfo_dob = mysql_real_escape_string($_POST['pinfo_dob']);
		$pinfo_cno = mysql_real_escape_string($_POST['pinfo_cno']);
		$pinfo_email = mysql_real_escape_string($_POST['pinfo_email']);
		$pinfo_home = mysql_real_escape_string($_POST['pinfo_home']);
		$pinfo_relation = mysql_real_escape_string($_POST['pinfo_relation']);
		
		
  $sql = "SELECT * FROM pinfo WHERE pinfo_uid=$pinfo_uid ";
	$retval = mysql_query($sql);
	if(! $retval )
	{
		die('Could not get data: ' . mysql_error());
	}
	if(mysql_fetch_assoc($retval) == ""){
		if(mysql_query("INSERT INTO pinfo (pinfo_uid,pinfo_dob,pinfo_cno,pinfo_email,pinfo_home,pinfo_relation) VALUES ('$pinfo_uid', '$pinfo_dob', '$pinfo_cno','$pinfo_email','$pinfo_home','$pinfo_relation')")){
		
		echo "<script>alert('Successfully Inserted....'); window.open('profile.php?rcol=personalinfo','_self'); </script>";
		}else{
		
			echo "<script>alert('Error while Inserting....'); window.open('profile.php?rcol=personalinfo','_self'); </script>";
		}
	}else{
		if(mysql_query(" UPDATE pinfo SET pinfo_dob='$pinfo_dob',pinfo_cno='$pinfo_cno',pinfo_email='$pinfo_email',pinfo_home='$pinfo_home',pinfo_relation='$pinfo_relation' WHERE pinfo_uid='$pinfo_uid' ")){
			
			echo "<script>alert('Successfully Updated....'); window.open('profile.php?rcol=personalinfo','_self'); </script>";
		}else{
			
			echo "<script>alert('Error While Updating....'); window.open('profile.php?rcol=personalinfo','_self'); </script>";
		}
	}

		
	}else{
		echo "<script> window.open('home.php','_self'); </script>";
	}
?>