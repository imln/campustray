
<div>
<script>
	
function delete_ach_info(){

var del=confirm("Are you sure you want to delete this record?");

return del;
}
</script>


	<div class="row">
	
	<div class="panel panel-default">
		<div class="panel-heading" ><h3 style="color:#4682b4; margin:0px;">Achievement & Activity</h3><p>*Activities define the things you did during and after college.</p></div>
		<div class="panel-body">
		<table class="table table-hover">
		
			
				
	

	
		
			
			<tbody> 
<?php 
	$ach_uid = $_SESSION['uid'];
    $sql = "SELECT * FROM achievement WHERE ach_uid=$ach_uid ";
	$retval = mysql_query($sql);
	if(! $retval )
	{
		die('Could not get data: ' . mysql_error());
	}
   
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
	{
	
?>
			
				<tr> 
					<td><?php echo strip_tags(htmlentities($row['ach_content']));?></td>
					<td>
						<form method="post" action="del_achievement.php">
							<input type="hidden" value="<?php echo $row['ach_id'];?>" name="ach_id">
							<button type="submit" name="del_ach_btn" class="btn btn-link" onclick="return delete_ach_info()">
								<span class="glyphicon glyphicon-trash"></span> Delete
							</button>
							
							
						</form>
					</td>
					
				</tr>
<?php } ?>	
				
			</tbody>
			
			
		</table>
	
		<center><a class="btn btn-primary" href="profile.php?rcol=addachievement">Add New</a></center>
	</div>
	</div>	
	</div>
</div>