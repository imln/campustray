<div>
<?php 
	$uid = $_SESSION['uid'];
    $sql = "SELECT * FROM usersregister WHERE uid=$uid";
	$retval = mysql_query($sql);
	if(! $retval )
	{
		die('Could not get data: ' . mysql_error());
	}
   
	$row = mysql_fetch_array($retval, MYSQL_ASSOC);
	
		
	
?>
	
	<div class="row">
	
	<div class="panel panel-default">
		<div class="panel-heading" ><h3 style="color:#4682b4; margin:0px;">Basic Info</h3></div>
		<div class="panel-body">
		<table class="table table-hover">
			
			
			
			<tr>
				<td><b>Name</b></td>
				<td><?php echo strip_tags(htmlentities($row['fname'])) . ' ' . strip_tags(htmlentities($row['lname']));?></td>
			</tr>
			<tr>
				<td><b>Gender</b></td>
				<td><?php echo strip_tags(htmlentities($row['gender']));?></td>
			</tr>
			<tr>
				<td><b>Email</b></td>
				<td><?php echo strip_tags(htmlentities($row['email'])); ?></td>
			</tr>
			<tr>
				<td><b>Roll No</b></td>
				<td><?php echo strip_tags(htmlentities($row['rollno']));?></td>
			</tr>
			<tr>
				<td><b>Course</b></td>
				<td><?php echo strip_tags(htmlentities($row['course']));?></td>
			</tr>
			<tr>
				<td><b>Branch</b></td>
				<td><?php echo strip_tags(htmlentities($row['branch']));?></td>
			</tr>
			<tr>
				<td><b>Year Of Entry</b></td>
				<td><?php echo $row['yoe'];?></td>
			</tr>
			<tr>
				<td><b>Year Of Graduation</b></td>
				<td><?php echo $row['yog']; ?></td>
			</tr>
			
		</table>
	
	</div>
	</div>
	</div>	
	
	
</div>