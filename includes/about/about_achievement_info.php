<?php 
if(isset($_SESSION['uid']) == "" && isset($_SESSION['fname']) == "" && isset($_SESSION['batch']) == "")
{
	header("Location: index.php");
}
?>

<div>
<div class="row">
<div class="panel panel-default">
  <div class="panel-heading" ><h3 style="color:#4682b4; margin:0px;">Achievement</h3></div>
  <div class="panel-body">
		
						<div>
							<table class="table table-condensed table-hover">
			
							

	
		
			
								<tbody> 
	
<?php 
	$ach_sql = "SELECT  ach_content FROM achievement WHERE ach_uid=$user_id";
				$ach_retval = mysql_query($ach_sql);
				if(! $ach_retval )
				{
					die('Could not get data: ' . mysql_error());
				}
   
				while( $ach_row = mysql_fetch_array($ach_retval, MYSQL_ASSOC)){
?>			
									<tr> 
										<td><?php echo $ach_row['ach_content'];?></td>
									
					
									</tr>
<?php } ?>	
				
								</tbody>
			
			
		</table>
	
		
	
		
	</div>
  </div>
</div>
</div>
</div>