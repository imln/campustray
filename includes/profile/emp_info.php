<div>
<script>
	
function delete_emp_info(){

var del=confirm("Are you sure you want to delete this record?");

return del;
}
</script>

	<div class="row">
	<div class="panel panel-default">
		<div class="panel-heading" ><h3 style="color:#4682b4; margin:0px;">Employment Info</h3></div>
		<div class="panel-body">
		<table class="table table-hover">
		
			
				
	

	
			<thead>
				<tr>
					<th>Work At</th>
					<th>Role / Designation</th>
					<th>Start</th>
					<th>End</th>
				</tr> 
			</thead>
			
			<tbody> 

<?php 
	$emp_uid = $_SESSION['uid'];
    $sql = "SELECT * FROM emp_info WHERE emp_uid=$emp_uid ORDER BY emp_sy DESC";
	$retval = mysql_query($sql);
	if(! $retval )
	{
		die('Could not get data: ' . mysql_error());
	}
   
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
	{
	
?>
			
				<tr> 
					<td><?php echo strip_tags(htmlentities($row['emp_workat']));?></td>
					<td><?php echo strip_tags(htmlentities($row['emp_role']));?></td>
					<td><?php echo strip_tags(htmlentities($row['emp_sm'])).' '.strip_tags(htmlentities($row['emp_sy']));?></td>
					<td><?php echo $row['emp_em'].' '.$row['emp_ey'];?></td>
					<td>
						<form method="post" action="del_emp_info.php">
							<input type="hidden" value="<?php echo $row['emp_id'];?>" name="emp_info_id">
							<button type="submit" name="del_emp_info_btn" class="btn btn-link" onclick="return delete_emp_info()">
								<span class="glyphicon glyphicon-trash"></span> Delete
							</button>
							
							
						</form>
					</td>
				</tr>
<?php } ?>				
				
			</tbody>
			
			
		</table>
	
		<center><a class="btn btn-primary" href="profile.php?rcol=addemploymentinfo">Add New</a></center>
	
		
	</div>
</div>
</div>
</div>