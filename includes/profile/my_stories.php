<?php 
if(isset($_SESSION['uid']) == "" && isset($_SESSION['fname']) == "" && isset($_SESSION['batch']) == "")
{
	header("Location: index.php");
}
?>
<script>
	
function delete_story(){

var del=confirm("Are you sure you want to delete this story?");

return del;
}
</script>


<div>
<div style="margin-bottom:10px;">
	<ul class="nav nav-pills nav-justified">
		<li><a href="profile.php">My Post</a></li>
		<li class="active"><a href="profile.php?m_rcol=stories">My Stories</a></li>
		<li><a href="profile.php?m_rcol=document">My Document</a></li>
		<li><a href="profile.php?m_rcol=wall">My Wall</a></li>
	</ul>
</div>

<div>
<?php 

	$story_uid = $_SESSION['uid'];
	$sql = "SELECT * FROM stories WHERE story_uid = $story_uid ORDER BY story_id DESC ";
	$retval = mysql_query( $sql);
   
	if(! $retval )
	{
		die('Could not get data: ' . mysql_error());
	}
   
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
	{	
		
		$story_id = $row['story_id'];
		$story_content = strip_tags(htmlentities($row['story_content']));
		$timestamp = strtotime($row['story_timestamp'].'+12hour30min');
		$story_time = date("g:i a F j, Y", $timestamp);
		
		 $select_user = "SELECT fname,lname,course,branch,yog FROM usersregister where uid= $story_uid ";
		  $run_user = mysql_query( $select_user );
		  while($user_row = mysql_fetch_array($run_user, MYSQL_ASSOC))
		  {
			$user_name = strip_tags(htmlentities($user_row['fname'])) . ' ' . strip_tags(htmlentities($user_row['lname']));
			$user_details = $user_row['course'] .' '. $user_row['branch'] . '-' . $user_row['yog'];
			
		  }
		
		
?>

	
	<div class="panel panel-info" style="margin-top:10px;"> 
	<div class="panel-heading" style="background-color:;"> 
			<form align="right" method="post" action="del_post.php">
				<input type="hidden" value="<?php echo $story_id;?>" name="story_id">
				
				<button type="submit" name="del_story_btn" class="btn btn-link"  onclick="return delete_story()">
					<span class="glyphicon glyphicon-trash"></span> Delete
				</button>
			</form>
		<p><?php echo $story_time; ?></p>
			
		
		<p style="color:black;">
			&nbsp;&nbsp;&nbsp;&nbsp;<?php echo nl2br($story_content); ?>
		</p>
		<p align="right"><span class="glyphicon glyphicon-pencil"></span> <b><?php echo $user_name;?></b><br/><span><?php echo $user_details;?></span> </p>

	</div> 
 
	</div>	
	
<?php } ?>
</div>

</div>