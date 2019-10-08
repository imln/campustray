<?php 
if(isset($_SESSION['uid']) == "" && isset($_SESSION['fname']) == "" && isset($_SESSION['batch']) == "")
{
	header("Location: index.php");
}
?>
<div>
<ul class="nav nav-pills nav-justified">
		<li class="active"><a href="about.php?a=<?php echo $user_id;?>">Post</a></li>
		<li><a href="about.php?a=<?php echo $user_id;?>&a_main_ref=stories">Stories</a></li>
		<li><a href="about.php?a=<?php echo $user_id;?>&a_main_ref=document">Document</a></li>
		<li><a href="about.php?a=<?php echo $user_id;?>&a_main_ref=wall">Wall</a></li>
</ul>

<div style="margin-top:10px;">
<?php
	
	
	
	 
	
	$sql = "SELECT * FROM posts WHERE post_uid=$user_id ORDER BY post_id DESC";
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
		$post_title = $row['post_title'];
		$post_content = $row['post_content'];
		$post_image_dir = $row['post_image_dir'];
		$timestamp = strtotime($row['post_timestamp']);
		
		$post_time=  date("g:i a F j, Y", $timestamp);
		
		  $select_user = "SELECT fname,lname,course,branch,yog,profpic_dir FROM usersregister where uid=$post_uid";
		  $run_user = mysql_query( $select_user );
		  while($user_row = mysql_fetch_array($run_user, MYSQL_ASSOC))
		  {
			$user_name = $user_row['fname'] . ' ' . $user_row['lname'];
			$user_details = $user_row['course'] .' '. $user_row['branch'] . '-' . $user_row['yog'];
			
			$user_profile = $user_row['profpic_dir'];
		  }
	
	
   
	
   	//$post_content=substr($row['post_content'],0,200);
  
?>

	
		
	<div class="panel panel-primary" >
		<div class="panel-heading" style="padding:5px; background:#4682b4;">
		<div class="row">
		<div class="col-md-8">
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
		
		<div class="col-md-4"><span style="color:white; font-size:20px;"> <?php echo $post_type;?> </span></div>
		</div>
		</div>
	<div class="panel-body" >
	<div >
		<p style="font-size:25px;"> <?php echo $post_title;?> </p>
	</div>
	
	<?php if( $post_image_dir != '') { ?>
	
		
		<img src="<?php echo $post_image_dir;?>" class="img-responsive" style="max-height:400px;" alt="post image">
	
	<?php } ?>
	
	<div class="row" style="margin:5px;">
		<p><?php echo nl2br($post_content);?></p>
	</div>
	</div>
</div>
<?php }

		
         
        ?>	
</div>


</div>