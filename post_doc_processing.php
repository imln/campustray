<?php 
session_start();
include_once 'includes/dbconnect.php';
if(isset($_SESSION['uid']) =="" && isset($_SESSION['fname']) =="" && isset($_SESSION['batch']) =="")
{
	header("Location:index.php");
}

if(isset($_POST['submit_doc'])){
	
	$doc_uid = $_SESSION['uid'];
	$doc_content = mysql_real_escape_string($_POST["doc_content"]);
	$doc_help = mysql_real_escape_string($_POST["doc_help"]);
	$doc_ip = $_SERVER['REMOTE_ADDR'];
	$doc_target_dir = "document/download/";
	$doc_file_size = mysql_real_escape_string($_FILES["doc_file"]["size"]);
	$doc_file_name = mysql_real_escape_string($_FILES["doc_file"]["name"]);
	
	$doc_file_type = strtolower(pathinfo($doc_file_name,PATHINFO_EXTENSION));
	
	if($doc_file_type == 'pdf' || $doc_file_type == 'ppt' || $doc_file_type == 'pptx' || $doc_file_type == 'doc' || $doc_file_type == 'docx'){
		if($doc_file_size <= 4194304){
			$doc_url = $doc_target_dir . date("Ymd") .'_'. rand(10,99) .'_'. $doc_file_name;
			
			if( move_uploaded_file( $_FILES["doc_file"]["tmp_name"], $doc_url) ){
				
				$doc_query = "INSERT INTO doc_details(doc_uid,doc_url,doc_content,doc_help,doc_type,doc_size,doc_ip) VALUES('$doc_uid','$doc_url','$doc_content','$doc_help','$doc_file_type','$doc_file_size','$doc_ip')";
				
				if(mysql_query($doc_query)){
					header( "Location:home.php?midcol=document" );
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

?>