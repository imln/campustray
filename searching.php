<?php
session_start();
include_once 'includes/dbconnect.php';
if(isset($_SESSION['uid']) == "" && isset($_SESSION['fname']) == "" && isset($_SESSION['batch']) == "")
{
	header("Location: index.php");
}

$info = mysql_real_escape_string($_POST['info']);
if( $info != ""){
$get_query="SELECT uid AS srh_uid FROM usersregister WHERE CONCAT_WS(' ',fname,lname) LIKE '%$info%' OR CONCAT_WS('',fname,lname) LIKE '%$info%' OR fname LIKE '%$info%' OR lname LIKE '%$info%' OR rollno LIKE '%$info%' OR branch LIKE '%$info%' OR yog LIKE '%$info%' OR CONCAT_WS('',branch,yog) LIKE '%$info%' OR course LIKE '%$info%' 
			UNION SELECT emp_uid AS srh_uid FROM emp_info WHERE emp_workat LIKE '%$info%' OR emp_role LIKE '%$info%'
			UNION SELECT edu_uid AS srh_uid FROM edu_info WHERE edu_inst LIKE '%$info%'
			UNION SELECT ach_uid AS srh_uid FROM achievement WHERE ach_content LIKE '%$info%'
			UNION SELECT pinfo_uid AS srh_uid FROM pinfo WHERE pinfo_home LIKE '%$info%' ORDER BY RAND() LIMIT 5";

$run=mysql_query("$get_query");
if(! $run ){
	die('something going wrong:'. mysql_error());
}else{
?>
<div>
	<table class="table table-condensed table-hover">
<?php 
$count=0;
while($information=mysql_fetch_array($run)){
	
			$info_uid = $information['srh_uid'];
			$sql = "SELECT uid,fname,lname,course,branch,yog,profpic_dir FROM usersregister WHERE uid='$info_uid' ";
			$retval = mysql_query($sql);
			
			if(! $retval )
			{
				die('Could not get data: ' . mysql_error());
			}else{
				$row = mysql_fetch_array($retval, MYSQL_ASSOC);
				
?>
	<tr>
		<td><img src="<?php if( $row['profpic_dir'] != ""){
					echo $row['profpic_dir'];
				}else{
					echo 'images\defaultprofpic.jpg';
				} ?>" class="img-rounded" alt="user profile" width="40" height="40"/>
			<span><a href="about.php?a=<?php echo $row['uid'];?>" style="">
						<span style="font-size:17px;"><b> <?php echo $row['fname'].' '.$row['lname'] ;?> </b></span>
				</a>		
						<span style="font-size:13px; margin:0px; padding:0px; "> <?php echo $row['course'] .' '. $row['branch'] . '-' . $row['yog'];?> </span></br>
						
					</span>
		</td>
		<td>
			<span > <a href="about.php?a=<?php echo $row['uid'];?>" style="color:#008080;">
					<h4><b>	About </b></h4>
				</a> </span>
		</td>
		
	</tr>
<?php				
				
				
				
			}
	

}
?>
</table>
<?php 
}
}
?>
</div>