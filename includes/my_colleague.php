<?php


if(isset($_SESSION['uid']) == "" && isset($_SESSION['fname']) == "" && isset($_SESSION['batch']) == "")
{
	header("Location: index.php");
}

 
	if(isset($_GET['mc_ref'])){
		
		$my_class_ref = $_GET['mc_ref'];
		
		switch($my_class_ref){
			
			case "my_class":
			include 'includes/my_colleague_ref_my_class.php';
			break;
			
			case "my_batch":
			include 'includes/my_colleague_ref_my_batch.php';
			break;
			
			case "my_branch":
			include 'includes/my_colleague_ref_my_branch.php';
			break;
			
			case "all_colleague":
			include 'includes/my_colleague_ref_all.php';
			
			default:
			include 'includes/my_colleague_ref_my_class.php';
			
		}
		
	}
	else{
		
		include 'includes/my_colleague_ref_my_class.php';
	}
?>
	



