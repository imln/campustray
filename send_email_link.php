<?php 
include_once 'includes/dbconnect.php';
if(isset($_POST['email_pass'])){
	
	$user_email = mysql_real_escape_string($_POST['email_pass']);
	
	$count_sql = " SELECT uid FROM usersregister WHERE email = '$user_email' ";
	$retval = mysql_query($count_sql);
	
	if($retval){
		
		$row_no = mysql_num_rows($retval);
        if( $row_no == 1){
			$row = mysql_fetch_array($retval, MYSQL_ASSOC);
			$uid = $row['uid'];
			$string = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$string_shuffled = str_shuffle($string);
			$code = substr($string_shuffled, 1,20);
			$fp_uip = $_SERVER['REMOTE_ADDR'];
			
			$fp_query = "INSERT INTO forget_pass(fp_uid,fp_a_code,fp_uip) VALUES ('$uid','$code','$fp_uip')";
			$fp_query_result = mysql_query($fp_query);
			if($fp_query_result){
				
				$to =  $user_email;
				$subject = "Your password reset link: http://www.campustray.com/reset_password.php?a_code=$code";
			// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$link = "Click this link to reset password: http://www.campustray.com/reset_password.php?a_code=$code";
			// More headers
				$headers .= 'From: <Campustray>' . "\r\n";


				if(mail($to,$subject,$link,$headers)){
					echo "<h3>Password reset link is sended to <a>$user_email</a>. Please check your email.</h3>";
					
				}else{
				
				echo 'Something going wrong...';
			}
			
			
			}else{
				
				echo 'Something going wrong...';
			}
			
			
			
		}else{
			echo 'No user exist with this email id or may be something wrong...';
		}
            
    }else{
		die('Something going wrong... ' . mysql_error());
	}
         
	
	
}else{
	
	echo "Something going wrong...";
}
?>


