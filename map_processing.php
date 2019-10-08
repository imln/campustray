<?php 



session_start();
include_once 'includes\dbconnect.php';
if(isset($_SESSION['uid'])=="" && isset($_SESSION['fname'])=="" && isset($_SESSION['batch'])=="")
{
	header("Location: index.php");
}



if(isset($_POST['submit'])){
$map_lat = $_POST['latitude'];
$map_lng = $_POST['longitude'];
$map_uid = $_SESSION['uid'];


  $sql = "SELECT * FROM maploc WHERE maploc_uid=$map_uid ";
	$retval = mysql_query($sql);
	if(! $retval )
	{
		die('Could not get data: ' . mysql_error());
	}
	if(mysql_fetch_assoc($retval) == ""){
		if(mysql_query("INSERT INTO maploc (maploc_uid, maploc_lat, maploc_lng) VALUES ('$map_uid', '$map_lat', '$map_lng')")){
		
		echo "<script>alert('Successfully Inserted....'); window.open('profile.php?rcol=maplocation','_self'); </script>";
		}else{
		
			echo "<script>alert('Error while Inserting....'); window.open('profile.php?rcol=maplocation','_self'); </script>";
		}
	}else{
		if(mysql_query(" UPDATE maploc SET maploc_lat='$map_lat',maploc_lng='$map_lng' WHERE maploc_uid='$map_uid' ")){
			
			echo "<script>alert('Successfully Updated....'); window.open('profile.php?rcol=maplocation','_self'); </script>";
		}else{
			
			echo "<script>alert('Error While Updating....'); window.open('profile.php?rcol=maplocation','_self'); </script>";
		}
	}

} 
?>