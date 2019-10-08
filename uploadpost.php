<?php 
session_start();
include_once 'includes/dbconnect.php';
if(isset($_SESSION['uid']) =="" && isset($_SESSION['fname']) =="" && isset($_SESSION['batch']) =="")
{
	header("Location:index.php");
}
	
		
		$post_uid = $_SESSION['uid'];
		$post_type = mysql_real_escape_string($_POST["type"]);
		$post_title = mysql_real_escape_string($_POST["title"]);
		$post_content = mysql_real_escape_string($_POST["content"]);
		$post_ip = $_SERVER['REMOTE_ADDR'];
		$target_dir = "images/post images/";
		$post_image = mysql_real_escape_string($_FILES["postimage"]["name"]);
		$image_tmp = mysql_real_escape_string($_FILES["postimage"]["tmp_name"]);
		$imageFileType = strtolower(pathinfo($post_image,PATHINFO_EXTENSION));
		if($post_image == ''){
			$post_image_dir = '';
		}else{
			
			if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" ){
				if ($_FILES["postimage"]["size"] < 5000000){
					$post_image_dir = $target_dir .date("Y-m-d").rand(100000,999999).'.'. $imageFileType;
					
					
					
				}else{
					echo "File is too large";
				}
			}else{
				echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed...";
				
			}
		}
		
		
		if( $post_title != '' ){
		if( $post_image_dir == ""){
			$postquery = "INSERT INTO posts(post_uid,post_type,post_title,post_content,post_image_dir,post_ip) VALUES('$post_uid','$post_type','$post_title','$post_content','$post_image_dir','$post_ip')";
				
				if(mysql_query($postquery)){
					echo "Successfully posted...";
				}else{
					echo "error while posting...";
				}
		}else{
			if( !move_uploaded_file($_FILES["postimage"]["tmp_name"], $post_image_dir) ){
						echo "error while uploading...";
			}else{
				$postquery = "INSERT INTO posts(post_uid,post_type,post_title,post_content,post_image_dir,post_ip) VALUES('$post_uid','$post_type','$post_title','$post_content','$post_image_dir','$post_ip')";
				
				if(mysql_query($postquery)){
					echo "Successfully posted...";
				}else{
					echo "error while posting...";
				}
			}
		}
		}else{
				echo "title is required...";
			}
		
						
		
	
?>