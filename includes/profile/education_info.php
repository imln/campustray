<div>
<script>
	
function delete_edu_info(){

var del=confirm("Are you sure you want to delete this record?");

return del;
}
</script>

	<div class="row">
	<div class="panel panel-default">
		<div class="panel-heading" ><h3 style="color:#4682b4; margin:0px;">Education Info</h3></div>
		<div class="panel-body">
		<table class="table table-hover">
		
			
				
	

	
			<thead>
				<tr>
					<th>Batch</th>
					<th>Institution</th>
					<th>Education Description</th>
				</tr> 
			</thead>
			
			<tbody> 

<?php 
	$edu_uid = $_SESSION['uid'];
    $sql = "SELECT * FROM edu_info WHERE edu_uid=$edu_uid ORDER BY edu_yoj DESC";
	$retval = mysql_query($sql);
	if(! $retval )
	{
		die('Could not get data: ' . mysql_error());
	}
   
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
	{
	
?>
			
				<tr> 
					<td><?php echo $row['edu_yoj'].'-'.$row['edu_yoc'];?></td>
					<td><?php echo strip_tags(htmlentities($row['edu_inst']));?></td>
					<td><?php echo strip_tags(htmlentities($row['edu_desc']));?></td>
					<td>
						<form method="post" action="del_education_info.php">
							<input type="hidden" value="<?php echo $row['edu_id'];?>" name="education_info_id">
							<button type="submit" name="del_edu_info_btn" class="btn btn-link" onclick="return delete_edu_info()">
								<span class="glyphicon glyphicon-trash"></span> Delete
							</button>
							
							
						</form>
					</td>
				</tr>
<?php } ?>				
				
			</tbody>
			
			
		</table>
	
		<center><a class="btn btn-primary" href="profile.php?rcol=addeducationinfo">Add New</a></center>
	
	</div>
	</div>
	</div>
</div>