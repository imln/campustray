<?php 
session_start();
include_once 'includes/dbconnect.php';
if(isset($_SESSION['uid']) =="" && isset($_SESSION['fname']) =="" && isset($_SESSION['batch']) =="")
{
	header("Location:index.php");
}

	if(isset($_POST['del_post_btn'])){
		$post_id = $_POST['post_id'];
		$post_image = $_POST['post_image_dir'];
		$del_sql = " DELETE FROM posts WHERE post_id= $post_id ";
		$retval = mysql_query($del_sql);
			if(! $retval )
			{
				die('Error while deleting.... ' . mysql_error());
			}else{
				if($post_image != ""){
				@unlink($post_image);
				}
				
				header("location:profile.php");
			
			}
	}
	elseif(isset($_POST['del_story_btn'])){
		
		$story_id = $_POST['story_id'];
		$del_story_sql = "DELETE FROM stories WHERE story_id = $story_id";
		$result = mysql_query($del_story_sql);
			if(! $result ){
				die('Error while deleting....'. mysql_error());
			}else{
				header("location:profile.php?m_rcol=stories");
			}
		
		
	}
	elseif(isset($_POST['del_doc_btn'])){
		
		$doc_id = $_POST['doc_id'];
		$doc_url = $_POST['doc_url'];
		$del_doc_sql = "DELETE FROM doc_details WHERE doc_id = $doc_id";
		$result_del = mysql_query($del_doc_sql);
			if(! $result_del ){
				die('Error while deleting...' . mysql_error());
			}else{
				@unlink($doc_url);
				header("location:profile.php?m_rcol=document");
				
			}
		
	}
	elseif(isset($_POST['del_wall_btn'])){
		$wall_id = $_POST['wall_number'];
		$del_wall_sql = "DELETE FROM wall_details WHERE wall_id = $wall_id ";
		$result_wall_del = mysql_query($del_wall_sql);
		if(! $result_wall_del ){
			die('Error while deleting...' . mysql_error());
		}else{
			header("location:profile.php?m_rcol=wall");
		}
	}
	else{
		header("location:home.php");
	}
?>