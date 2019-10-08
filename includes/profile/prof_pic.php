<?php 
		$post_uid = $_SESSION['uid'];
		$sql = "SELECT profpic_dir FROM usersregister WHERE uid=$post_uid ";
		$retval = mysql_query($sql);
		if(! $retval )
		{
			die('Could not get data: ' . mysql_error());
		}
   
		$row = mysql_fetch_array($retval, MYSQL_ASSOC);
		
		$profpic_dir = strip_tags(htmlentities($row['profpic_dir']));
?>

<div class="row">
	
		
		<img src="<?php echo $profpic_dir;?>" class="img-responsive" alt="user profile">
	
</div>
<div class="row">	
		<div style="margin-top:10px;">
			<p style="color:#4682b4;"><b>Change Here</b></p>
			<p>Valid formats: jpeg, jpg, gif, png, Max upload: 400kb</p>
	
	
	
			<form role="form" id="form" action="upload_prof_pic.php" method="post" enctype="multipart/form-data">
				<input id="uploadImage" type="file" accept="image/*" name="profpic" />
				<div class="form-group" style="margin-top:10px;">
					<center><input class="btn btn-success" id="button" type="submit" name="upload" value="Upload"></center>
				</div>
			</form>
	

	
		</div>
</div>	

