<?php 
if(isset($_SESSION['uid']) == "" && isset($_SESSION['fname']) == "" && isset($_SESSION['batch']) == "")
{
	header("Location: index.php");
}
?>
<div>
<ul class="nav nav-pills nav-justified">
		<li><a href="about.php?a=<?php echo $user_id;?>">Post</a></li>
		<li class="active"><a href="about.php?a=<?php echo $user_id;?>&a_main_ref=stories">Stories</a></li>
		<li><a href="about.php?a=<?php echo $user_id;?>&a_main_ref=document">Document</a></li>
		<li><a href="about.php?a=<?php echo $user_id;?>&a_main_ref=wall">Wall</a></li>
</ul>

<div>
<?php 
	$sql = "SELECT * FROM stories WHERE story_uid=$user_id ORDER BY story_id DESC ";
	$retval = mysql_query( $sql);
   
	if(! $retval )
	{
		die('Could not get data: ' . mysql_error());
	}
   
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
	{	
		
		$story_uid = $row['story_uid'];
		$story_content = $row['story_content'];
		$timestamp = strtotime($row['story_timestamp']);
		$story_time = date("g:i a F j, Y", $timestamp);
		
		
?>

	
	<div class="panel panel-info" style="margin-top:10px;"> 
	<div class="panel-heading" style="background-color:;"> 
		<p><?php echo $story_time; ?></p>
		<p style="color:black;">
			&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $story_content; ?>
		</p>
		<p align="right"><span class="glyphicon glyphicon-pencil"></span> <b><?php echo strip_tags(htmlentities($user_row['fname'])) . ' ' . strip_tags(htmlentities($user_row['lname']));?></b><br/><span><?php echo $user_row['course']. '  ' .$user_row['branch']. '-' .$user_row['yog'];?></span> </p>

	</div> 
 
	</div>	
	
<?php } ?>
</div>

</div>