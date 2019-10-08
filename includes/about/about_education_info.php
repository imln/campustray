<?php 
if(isset($_SESSION['uid']) == "" && isset($_SESSION['fname']) == "" && isset($_SESSION['batch']) == "")
{
	header("Location: index.php");
}
?>

<div>
<div class="row">
<div class="panel panel-default">
  <div class="panel-heading" ><h3 style="color:#4682b4; margin:0px;">Education Info</h3></div>
  <div class="panel-body">
		<div>
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
	$edu_sql = "SELECT edu_yoj,edu_yoc,edu_inst,edu_desc FROM edu_info WHERE edu_uid=$user_id ORDER BY edu_yoj DESC";
				$edu_retval = mysql_query($edu_sql);
				if(! $edu_retval )
				{
					die('Could not get data: ' . mysql_error());
				}
   
				while( $edu_row = mysql_fetch_array($edu_retval, MYSQL_ASSOC)){
?>
			
								<tr> 
									<td><?php echo $edu_row['edu_yoj'].'-'.$edu_row['edu_yoc'];?></td>
									<td><?php echo $edu_row['edu_inst'];?></td>
									<td><?php echo $edu_row['edu_desc'];?></td>
									
								</tr>				
<?php } ?>				
			</tbody>
			
			
		</table>
	
		
	
		
	</div>
  </div>
</div>
</div>
</div>