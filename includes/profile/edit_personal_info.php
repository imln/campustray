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
		<div class="panel-heading" ><h3 style="color:#4682b4; margin:0px;">Update Personal Info</h3></div>
		<div class="panel-body">
		
	<form role="form" method="post"  action="upload_personal_info.php">
		
		<table class="table table-hover">	
				
			
			<tr>
				<td><b>Date Of Birth</b></td>
				<td><input type="date" class="form-control" value="<?php echo $row['pinfo_dob'];?>" name="pinfo_dob" ></td>
			</tr>
			<tr>
				<td><b>Contact No.</b></td>
				<td><input type="number" class="form-control" value="<?php echo strip_tags(htmlentities($row['pinfo_cno']));?>" name="pinfo_cno" ></td>
			</tr>
		
			<tr>
				<td><b>Email</b></td>
				<td><input type="email" class="form-control" value="<?php echo strip_tags(htmlentities($row['pinfo_email']));?>" name="pinfo_email" ></td>
			</tr>
			<tr>
				<td><b>Home Town</b></td>
				<td><input type="text" class="form-control" value="<?php echo strip_tags(htmlentities($row['pinfo_home']));?>" name="pinfo_home" maxlength="95"></td>
			</tr>
			<tr>
				<td><b>Relationship</b></td>
				<td><select class="form-control" value="<?php echo $row['pinfo_relation'];?>" name="pinfo_relation" value="" >
					
					<option value="Single">Single</option>
					<option value="Married">Married</option> 
					
				</select></td>
				
			</tr>
			
			
		</table>
		<center>
			<button type="submit" class="btn btn-primary" name="pinfosave" style="width:130px;">Save Change</button>
		</center>
	</form>
	</div>
	</div>
	</div>	
	</div>
