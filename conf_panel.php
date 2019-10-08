
<div style="margin:5px;  word-wrap: break-word;">

<?php 
include_once 'includes/dbconnect.php';
	
    $conf_sql = "SELECT conf_content,conf_date FROM anony_confession ORDER BY conf_id DESC LIMIT 50";
	$conf_retval = mysql_query($conf_sql);
	if(! $conf_retval )
	{
		die('Could not get data: ' . mysql_error());
	}
   
	while($conf_row = mysql_fetch_array($conf_retval, MYSQL_ASSOC))
	{
		$conf_content = $conf_row['conf_content'];
		
		$conf_timestamp = strtotime($conf_row['conf_date'] .'+12hour30min');
		
		$post_time=  date("g:iA d-m-Y", $conf_timestamp);
	
?>
				
			<span style=" font-family:'Comic Sans MS', cursive, sans-serif; word-wrap: break-word;" >
				<span style="color:gray; font-size:12px;"> <?php echo $post_time; ?>:</span>
				<span style="word-wrap: break-word;">
				<?php echo $conf_content;?>
				</span>		
			</span>
			<hr style="margin:5px; border:1px solid #4682b4 ;"/>
				
<?php } ?>				
</div>