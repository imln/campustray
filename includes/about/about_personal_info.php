<?php 
if(isset($_SESSION['uid']) == "" && isset($_SESSION['fname']) == "" && isset($_SESSION['batch']) == "")
{
	header("Location: index.php");
}
?>

<div>
<div class="row">
<div class="panel panel-default">
  <div class="panel-heading" ><h3 style="color:#4682b4; margin:0px;">Personal Info</h3></div>
  <div class="panel-body">

	
<?php 
	$pinfo_sql = "SELECT  pinfo_dob,pinfo_cno,pinfo_email,pinfo_home,pinfo_relation FROM pinfo WHERE pinfo_uid=$user_id";
				$pinfo_retval = mysql_query($pinfo_sql);
				if(! $pinfo_retval )
				{
					die('Could not get data: ' . mysql_error());
				}
   
				$pinfo_row = mysql_fetch_array($pinfo_retval, MYSQL_ASSOC);
?>
							
								<table class="table table-hover">
									
									
									<tr>
										<td ><b>Gender</b></td>
										<td><?php echo $user_row['gender'];?></td>
									</tr>
									
									<tr>
										<td><b>Date of Birth</b></td>
										<td><?php echo $pinfo_row['pinfo_dob'];?></td>
									</tr>
									
									<tr>
										<td><b>Contact No.</b></td>
										<td><?php echo $pinfo_row['pinfo_cno'];?></td>
									</tr>
									
									<tr>
										<td><b>Email</b></td>
										<td><?php echo $pinfo_row['pinfo_email'];?></td>
									</tr>
									<tr>
										<td><b>Home Town</b></td>
										<td><?php echo $pinfo_row['pinfo_home'];?></td>
									</tr>
									<tr>
										<td><b>Relationship</b></td>
										<td><?php echo $pinfo_row['pinfo_relation'];?></td>
									</tr>
								</table>
							
							</div>
						</div>
					</div>
</div>