
<?php 

if(isset($_SESSION['uid']) =="" && isset($_SESSION['fname']) =="" && isset($_SESSION['batch']) =="")
{	
	header("Location:../index.php");
}


?>

<div id="post_result_div" style="margin-top:10px;">


<?php
	
	$rec_limit = 50;
	
	$wall_rcvr_uid = $_SESSION['uid'];
	
	 /* Get total number of records */
         $sql = "SELECT count(wall_id) FROM wall_details";
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
	
	$sql = "SELECT * FROM wall_details  ORDER BY wall_id DESC LIMIT $offset, $rec_limit";
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
		
		$wall_content = strip_tags(htmlentities($row['wall_content']));
		
		$timestamp = strtotime($row['wall_time'].'+12hour30min');
		
		$wall_time=  date("g:i a F j, Y", $timestamp);
		
		  $select_user = "SELECT fname,lname,course,branch,yog,profpic_dir FROM usersregister where uid = $wall_sndr_uid";
		  $run_user = mysql_query( $select_user );
		  while($user_row = mysql_fetch_array( $run_user , MYSQL_ASSOC))
		  {
			$user_name = strip_tags(htmlentities($user_row['fname'])) . ' ' . strip_tags(htmlentities($user_row['lname']));
			$user_details = $user_row['course'] .' '. $user_row['branch'] . '-' . $user_row['yog'];
			
			$user_profile = strip_tags(htmlentities($user_row['profpic_dir']));
		  }
		   $select_wall_rcvr = "SELECT fname,lname,course,branch,yog,profpic_dir FROM usersregister where uid = $wall_rcvr_uid";
		  $run_wall_rcvr_sql = mysql_query( $select_wall_rcvr );
		  while($rcvr_row = mysql_fetch_array( $run_wall_rcvr_sql , MYSQL_ASSOC))
		  {
			$rcvr_name = strip_tags(htmlentities($rcvr_row['fname'])) . ' ' . strip_tags(htmlentities($rcvr_row['lname']));
			$rcvr_details = $rcvr_row['course'] .' '. $rcvr_row['branch'] . '-' . $rcvr_row['yog'];
			
			
		  }
	
	
   
	
   	
  
?>

<div>
	<div class="media">
	<a class="pull-left" href="#">
	<img class="media-object" width="50" height="50px" src="<?php if($user_profile != ""){echo $user_profile;}else{ echo 'images/defaultprofpic.jpg';} ?>" alt="Media Object"> 
	</a>
	<div class="media-body"> 
	
	
		
	
	
	<p class="media-heading"><b><a><?php echo $user_name; ?></a></b> <span style="font-size:10px; color:gray"> <?php echo $user_details; ?></span> <span style="color:#4682b4; " class="glyphicon glyphicon-chevron-right"></span> <b><a><?php echo $rcvr_name; ?></a></b> <span style="font-size:10px; color:gray"> <?php echo $rcvr_details; ?></span>  &nbsp; &nbsp; <span style="font-size:12px;"><?php echo $wall_time; ?></span></p>
	
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
			<li class="previous"><a href="home.php?midcol=wall_feed&page=<?php echo $last; ?>">&larr; Previous</a></li> 
			<li class="next"><a href="home.php?midcol=wall_feed&page=<?php echo $page; ?>">Next &rarr;</a></li>
		</ul>
		
        <?php 
         }
         
         else if( $page == 0 )
         {	
		 ?>
			<ul class="pager">
				<li class="next"><a href="home.php?midcol=wall_feed&page=<?php echo $page; ?>">Next &rarr;</a></li>
			</ul>
		<?php
		}
			
         else if( $left_rec < $rec_limit )
         {
            $last = $page - 2;
		?>
            <li class="previous"><a href="home.php?midcol=wall_feed&page=<?php echo $last; ?>">&larr; Previous</a></li> 
        <?php }
         
        
      ?>	
</div>


