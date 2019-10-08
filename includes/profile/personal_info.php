
<div>
<?php 
	$uid = $_SESSION['uid'];
    $sql = "SELECT * FROM pinfo WHERE pinfo_uid=$uid";
	$retval = mysql_query($sql);
	if(! $retval )
	{
		die('Could not get data: ' . mysql_error());
	}
   
	$row = mysql_fetch_array($retval, MYSQL_ASSOC);
	
		
	
?>
	<div class="row">
	
		<div class="panel panel-default">
		<div class="panel-heading" ><h3 style="color:#4682b4; margin:0px;">Personal Info</h3></div>
		<div class="panel-body">
		<table class="table table-hover">
			
				
			
			<tr>
				<td><b>Date Of Birth</b></td>
				<td><?php echo $row['pinfo_dob'];?></td>
			</tr>
			<tr>
				<td><b>Contact No.</b></td>
				<td><?php echo strip_tags(htmlentities($row['pinfo_cno']));?></td>
			</tr>
		
			<tr>
				<td><b>Email</b></td>
				<td><?php echo strip_tags(htmlentities($row['pinfo_email']));?></td>
			</tr>
			<tr>
				<td><b>Home Town</b></td>
				<td><?php echo strip_tags(htmlentities($row['pinfo_home']));?></td>
			</tr>
			<tr>
				<td><b>Relationship</b></td>
				<td><?php echo $row['pinfo_relation'];?></td>
			</tr>
			
			
		</table>
	
	<center> <a class="btn btn-primary" href="profile.php?rcol=editpersonalinfo">Update</a> </center>
	
	</div>
</div>
</div>	
	
</div>