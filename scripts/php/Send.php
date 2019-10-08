<?php
session_start();
	include('../../includes/core.inc.php');
	
		if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
			$sender = $_SESSION['uid'];
			if(isset($_GET['message']) && !empty($_GET['message'])) {
				$message = $_GET['message'];
				
				if(send_msg($sender,$message)) {
					echo 'Message Sent..';
				}else{
					echo 'Message wasn\'t sent';
				}
				
			}else{
				echo 'No message was entered';
			}

		}else{
			echo 'No name was entered..';
		}
	

?>