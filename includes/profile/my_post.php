<?php 
if(isset($_SESSION['uid']) == "" && isset($_SESSION['fname']) == "" && isset($_SESSION['batch']) == "")
{
	header("Location: index.php");
}
?>
<script>
	
function delete_post(){

var del=confirm("Are you sure you want to delete this post?");

return del;
}
</script>
<div style="margin-bottom:10px;">
	<ul class="nav nav-pills nav-justified">
		<li class="active"><a href="profile.php">My Post</a></li>
		<li><a href="profile.php?m_rcol=stories">My Stories</a></li>
		<li><a href="profile.php?m_rcol=document">My Document</a></li>
		<li><a href="profile.php?m_rcol=wall">My Wall</a></li>
</ul>
</div>
<?php 
$post_uid = $_SESSION['uid'];

		$sql = "SELECT * FROM posts WHERE post_uid = $post_uid ORDER BY post_id DESC ";
	$retval = mysql_query( $sql);
   
	if(! $retval )
	{
		die('Could not get data: ' . mysql_error());
	}
   
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
	{	
		$post_id = $row['post_id'];
		$post_uid = $row['post_uid'];
		$post_type = $row['post_type'];
		$post_title = strip_tags(htmlentities($row['post_title']));
		$post_content = strip_tags(htmlentities($row['post_content']));
		$post_image_dir = strip_tags(htmlentities($row['post_image_dir']));
		$timestamp = strtotime($row['post_timestamp'].'+12hour30min');
		
		$post_time=  date("g:i a F j, Y", $timestamp);
		
		  $select_user = "SELECT fname,lname,course,branch,yog,profpic_dir FROM usersregister where uid=$post_uid";
		  $run_user = mysql_query( $select_user );
		  while($user_row = mysql_fetch_array($run_user, MYSQL_ASSOC))
		  {
			$user_name = strip_tags(htmlentities($user_row['fname'])) . ' ' . strip_tags(htmlentities($user_row['lname']));
			$user_details = $user_row['course'] .' '. $user_row['branch'] . '-' . $user_row['yog'];
			$user_profile = strip_tags(htmlentities($user_row['profpic_dir']));
		  }
	
	
   
	
   	
  
?>

	
		
	<div class="panel panel-primary" style="">
		<div class="panel-heading" style="padding:5px; background:#4682b4 ;">
		<div class="row">
		<div class="col-md-7">
			<div class="media">
				<div class="pull-left"> 
					<img class="img-rounded" src="<?php if($user_profile !=""){echo $user_profile;}else{echo 'images\defaultprofpic.jpg';}?>" alt="Media Object" width="40px" height="40px" style="margin-top:2px;">
				</div>
				<div class="media-body"> 
					<p style="margin:0px; padding:0px;">
						<span style="color:white; font-size:17px;"><b> <?php echo $user_name ;?> </b></span>
						<span style="font-size:13px; margin:0px; padding:0px; color:white;"> <?php echo $user_details;?> </span></br>
						<span style="font-size:12px; margin:0px; padding:0px; color:silver;"> <?php echo $post_time ;?> </span>
					</p>
				</div> 
			</div>
		</div>
		
		<div class="col-md-3">
			<span style="color:white; font-size:20px;"> <?php echo $post_type;?> </span>
			
		
		</div>
		<div class="col-md-2">
		
		
			<form method="post" action="del_post.php">
				<input type="hidden" value="<?php echo $row['post_id'];?>" name="post_id">
				<input type="hidden" value="<?php echo $row['post_image_dir'];?>" name="post_image_dir">
				<button type="submit" name="del_post_btn" class="btn btn-link" style="color:white;" onclick="return delete_post()">
					<span class="glyphicon glyphicon-trash"></span> Delete
				</button>
			</form>
		</div>
		</div>
		</div>
	<div class="panel-body" >
	<div >
		<p style="font-size:25px;"> <?php echo $post_title;?> </p>
	</div>
	
	<?php if( $post_image_dir != '') {?>
	<div>
		
		<img src="<?php echo $post_image_dir;?>" class="img-responsive" style="max-height:400px;" alt="post image">
	</div>
	<?php } ?>
	
	<div class="row" style="margin:5px;">
		<p><?php echo nl2br($post_content);?></p>
	</div>
	</div>
</div>
<?php }
?>