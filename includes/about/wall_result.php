<?php 
if(isset($_SESSION['uid']) =="" && isset($_SESSION['fname']) =="" && isset($_SESSION['batch']) =="")
{
	header("Location:index.php");
}


?>

<div id="post_result_div" style="margin-top:10px;">


<?php
	
	$rec_limit = 25;
	
	$wall_rcvr_uid = $_GET['a'];
	
	 /* Get total number of records */
         $sql = "SELECT count(wall_id) FROM wall_details WHERE wall_rcvr_uid = $wall_rcvr_uid ";
         $retval = mysql_query( $sql);
         
         if(! $retval )
         {
            die('Could not get data: ' . mysql_error());
         }
         $row = mysql_fetch_array($retval, MYSQL_NUM );
         $rec_count = $row[0];
         
         if( isset($_GET{'page'} ) )
         {
            $page = $_GET{'page'} + 1;
            $offset = $rec_limit * $page ;
         }
         else
         {
            $page = 0;
            $offset = 0;
         }
         $left_rec = $rec_count - ($page * $rec_limit);
	
	$sql = "SELECT * FROM wall_details WHERE wall_rcvr_uid = $wall_rcvr_uid ORDER BY wall_id DESC LIMIT $offset, $rec_limit";
	$retval = mysql_query( $sql);
   
	if(! $retval )
	{
		die('Could not get data: ' . mysql_error());
	}
   
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
	{	
		$wall_id = $row['wall_id'];
		$wall_rcvr_uid = $row['wall_rcvr_uid'];
		$wall_sndr_uid = $row['wall_sndr_uid'];
		
		$wall_content = $row['wall_content'];
		
		$timestamp = strtotime($row['wall_time']);
		
		$wall_time=  date("g:i a F j, Y", $timestamp);
		
		  $select_user = "SELECT fname,lname,course,branch,yog,profpic_dir FROM usersregister where uid = $wall_sndr_uid";
		  $run_user = mysql_query( $select_user );
		  while($user_row = mysql_fetch_array( $run_user , MYSQL_ASSOC))
		  {
			$user_name = $user_row['fname'] . ' ' . $user_row['lname'];
			$user_details = $user_row['course'] .' '. $user_row['branch'] . '-' . $user_row['yog'];
			
			$user_profile = $user_row['profpic_dir'];
		  }
	
	
   
	
   	
  
?>

<div>
	<div class="media">
	<a class="pull-left" href="#">
	<img class="media-object" height="40px" src="<?php if($user_profile != ""){echo $user_profile;}else{ echo 'images/defaultprofpic.jpg';} ?>" alt="Media Object"> 
	</a>
	<div class="media-body"> 
	<p class="media-heading"><b><a><?php echo $user_name; ?></a></b> <span style="font-size:12px; color:gray"> <?php echo $user_details; ?></span>&nbsp <span style="font-size:11px;"><?php echo $wall_time; ?></span></p>
	
	<?php echo $wall_content;?>
	</div> 
	</div>
</div>	

<hr style="margin:5px; border-top:1px solid silver;"/>	
<?php }

		if( $page > 0 )
         {
            $last = $page - 2;
		?>
		<ul class="pager">
			<li class="previous"><a href="about.php?a=<?php echo $_GET['a'];?>&a_main_ref=wall&page=<?php echo $last; ?>">&larr; Previous</a></li> 
			<li class="next"><a href="about.php?a=<?php echo $_GET['a'];?>&a_main_ref=wall&page=<?php echo $page; ?>">Next &rarr;</a></li>
		</ul>
		
        <?php 
         }
         
         else if( $page == 0 )
         {	
		 ?>
			<ul class="pager">
				<li class="next"><a href="about.php?a=<?php echo $_GET['a'];?>&a_main_ref=wall&page=<?php echo $page; ?>">Next &rarr;</a></li>
			</ul>
		<?php
		}
			
         else if( $left_rec < $rec_limit )
         {
            $last = $page - 2;
		?>
            <li class="previous"><a href="about.php?a=<?php echo $_GET['a'];?>&a_main_ref=wall&page=<?php echo $last; ?>">&larr; Previous</a></li> 
        <?php }
         
        
      ?>	
</div>


