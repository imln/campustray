<?php 
if(isset($_SESSION['uid']) == "" && isset($_SESSION['fname']) == "" && isset($_SESSION['batch']) == "")
{
	header("Location: index.php");
}
?>

<div>
<div class="row">
<div class="panel panel-default">
  <div class="panel-heading" ><h3 style="color:#4682b4; margin:0px;">Employment Info</h3></div>
  <div class="panel-body">
		<div>
						<table class="table table-condensed table-hover">
			
							
	

	
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
	$emp_sql = "SELECT  emp_workat,emp_role,emp_sm,emp_sy,emp_em,emp_ey FROM emp_info WHERE emp_uid=$user_id ORDER BY emp_sy DESC";
				$emp_retval = mysql_query($emp_sql);
				if(! $emp_retval )
				{
					die('Could not get data: ' . mysql_error());
				}
   
				while( $emp_row = mysql_fetch_array($emp_retval, MYSQL_ASSOC)){
?>
								<tr> 
									<td><?php echo $emp_row['emp_workat'];?></td>
									<td><?php echo $emp_row['emp_role'];?></td>
									<td><?php echo $emp_row['emp_sm'].' '.$emp_row['emp_sy'];?></td>
									<td><?php echo $emp_row['emp_em'].' '.$emp_row['emp_ey'];?></td>
									
								</tr>
<?php } ?>				
				
							</tbody>
			
			
							</table>
					</div>
  </div>
</div>
</div>
</div>