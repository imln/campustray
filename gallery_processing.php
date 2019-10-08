<?php 
session_start();
include_once 'includes/dbconnect.php';
if(isset($_SESSION['uid']) =="" && isset($_SESSION['fname']) =="" && isset($_SESSION['batch']) =="")
{
	header("Location:index.php");
}else{
	
	if(isset($_POST['submit_glry'])){
	
	$glry_uid = $_SESSION['uid'];
	$glry_content = mysql_real_escape_string($_POST["glry_content"]);
	
	$glry_ip = $_SERVER['REMOTE_ADDR'];
	$glry_target_dir = "images/gallery/";
	$glry_file_size = mysql_real_escape_string($_FILES["glry_file"]["size"]);
	$glry_file_name = mysql_real_escape_string($_FILES["glry_file"]["name"]);
	
	$glry_file_type = strtolower(pathinfo($glry_file_name,PATHINFO_EXTENSION));
	
	if($glry_file_type == 'png' || $glry_file_type == 'jpg' || $glry_file_type == 'jpeg' || $glry_file_type == 'gif'){
		if($glry_file_size <= 2097152){
			$glry_image_dir = $glry_target_dir .date("Ymd").rand(10000000,99999999).'.'. $glry_file_type;
			
			
			if( move_uploaded_file( $_FILES["glry_file"]["tmp_name"], $glry_image_dir) ){
				
				$glry_query = "INSERT INTO glry_details(glry_uid,glry_url,glry_content,glry_ip) VALUES('$glry_uid','$glry_image_dir','$glry_content','$glry_ip')";
				
				if(mysql_query($glry_query)){
					header( "Location:home.php?midcol=gallery" );
				}else{
					echo "error while uploading...";
				}
				
			}else{
				echo 'uploaiding failed...';
			}
			
		}else{
			echo 'Large file size...';
			
		}
		
	}else{
		echo 'Invalid format...';
	}
	
}else{
	
	echo 'something going wrong...';
}
}
?>