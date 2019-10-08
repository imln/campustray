<?php 
session_start();
include_once 'includes\dbconnect.php';
if(isset($_SESSION['uid']) =="" && isset($_SESSION['fname']) =="" && isset($_SESSION['batch']) =="")
{
	header("Location:index.php");
}

if(isset($_POST['changePassBtn']))
{	
	if( $_POST['oldpass'] != "" && $_POST['newpass1'] != "" && $_POST['newpass2'] != "" && $_POST['newpass1'] === $_POST['newpass2'])
	{
	$oldpass = md5(mysql_real_escape_string($_POST['oldpass']));
	$newpass1 = md5(mysql_real_escape_string($_POST['newpass1']));
	$newpass2 = md5(mysql_real_escape_string($_POST['newpass2']));
	$pass_uid = $_SESSION['uid'];
	
	$sql = "SELECT pass FROM usersregister WHERE uid=$pass_uid ";
	$retval = mysql_query($sql);
	if(! $retval )
	{
		die('Could not get data: ' . mysql_error());
	}else{
		
		$row = mysql_fetch_array($retval, MYSQL_ASSOC);
		if( $row['pass'] === $oldpass  ){
			if(mysql_query(" UPDATE usersregister SET pass='$newpass1' WHERE uid='$pass_uid' ")){
			
			echo "<script>alert('Successfully Changed....'); window.open('profile.php','_self'); </script>";
		}else{
			
			echo "<script>alert('Error While Changing....'); window.open('profile.php?rcol=chngpass','_self'); </script>";
		}
		}else{
			
			echo "<script>alert('Your Old Password Does Not Match!'); window.open('profile.php?rcol=chngpass','_self'); </script>";
		}
		
	}
	
	}else{
			
			echo "<script>alert('Please enter valid password...or your password does not match...'); window.open('profile.php?rcol=chngpass','_self'); </script>";
		}
	
}
else{
		echo "<script> window.open('home.php','_self'); </script>";
	}
?>