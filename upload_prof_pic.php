<?php 
session_start();
include_once 'includes\dbconnect.php';
if(isset($_SESSION['uid']) =="" && isset($_SESSION['fname']) =="" && isset($_SESSION['batch']) =="")
{
	header("Location:index.php");
}
	if(isset($_POST['upload'])){
		
		$post_uid = $_SESSION['uid'];
		
		$target_dir = "images/profile/";
		$profpic_image = mysql_real_escape_string($_FILES["profpic"]["name"]);
		$image_tmp = $_FILES["profpic"]["tmp_name"];
		$imageFileType = strtolower(pathinfo($profpic_image,PATHINFO_EXTENSION));
		if($profpic_image == ''){
			echo "<script>alert('No file chosen....'); window.open('profile.php?rcol=profpic','_self'); </script>";
		}else{
			
			if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" ){
				if ($_FILES["profpic"]["size"] < 500000){
					$profpic_image_dir = $target_dir .date("Y-m-d").rand(100000,999999).'.'. $imageFileType;
					
					if(! move_uploaded_file($image_tmp, $profpic_image_dir)){
						echo "<script>alert('Error while uploading.....'); window.open('profile.php?rcol=profpic','_self'); </script>";
					}else{
						
						$sql = "SELECT profpic_dir FROM usersregister WHERE uid=$post_uid ";
						$retval = mysql_query($sql);
						if(! $retval )
						{
							die('Could not get data: ' . mysql_error());
						}
   
						$row = mysql_fetch_array($retval, MYSQL_ASSOC);
		
						$previous_profpic_dir = $row['profpic_dir'];
						
						if( @unlink($previous_profpic_dir) || $previous_profpic_dir == "" ){
							if( mysql_query(" UPDATE usersregister SET profpic_dir='$profpic_image_dir' WHERE uid='$post_uid' ")){
			
							echo "<script>alert('Successfully Changed....'); window.open('profile.php?rcol=profpic','_self'); </script>";
							}
						}else{
							echo "<script>alert('Something going wrong.....'); window.open('profile.php?rcol=profpic','_self'); </script>";
						}	
					}
					
				}else{
					echo "<script>alert('File is too large'); window.open('profile.php?rcol=profpic','_self'); </script>";
				}
			}else{
				echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed..'); window.open('profile.php?rcol=profpic','_self'); </script>";
				
			}
		}
		
		}
	
	
?>	
