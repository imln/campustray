<?php 
	$feedback = array();
	function get_msg(){
	
		$query = "SELECT `Sender`,`Message`,`msg_timestamp` FROM `campusculture`.`chat` ORDER BY `Msg_ID` DESC LIMIT 100";
		
		$run= mysql_query($query);
		
		$messages= array();
		
		while($message = mysql_fetch_assoc($run)){
			$messages[] = array('sender'=>$message['Sender'],
								'message'=>$message['Message'],
								'msg_timestamp'=>$message['msg_timestamp']);
		}
		
		return $messages;
	
	
	}


?>