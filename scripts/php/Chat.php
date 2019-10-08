<?php
	include('../../includes/core.inc.php');
	include('../../includes/dbconnect.php');
	
	$messages = get_msg();
			foreach($messages as $message){
				$sndr_uid = $message['sender'];
				
				$time=  date("g:i a d-m-y", strtotime($message['msg_timestamp']));
				  
				$sql = "SELECT * FROM usersregister WHERE uid = $sndr_uid";
				$retval = mysql_query($sql);
				
				$row = mysql_fetch_array($retval , MYSQL_ASSOC);
?>
					<div class="well well-sm" style="margin:10px; padding:5px;">
						<a href="about.php?a=<?php echo $row['uid'];?>">
						<b><span style="color:#008080; margin-left:5px;"><?php echo $row['fname'].' '.$row['lname'];?></span> 
						</a>
						<span style="font-size:11px; color:navy;"><?php echo $row['course'].' '.$row['branch'].'-'.$row['yog'];?></span>  <span style="font-size:11px; float:right;margin-right:10px; margin-top:1px; color:navy;"><?php echo $time;?></span>
						</b><br/><span style="margin-left:5px;  word-wrap: break-word;"><?php echo $message['message'];?></span>
					</div>
<?php } ?>