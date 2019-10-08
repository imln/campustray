<div>
<?php
	
	$rec_limit = 10;
	
	 /* Get total number of records */
         $sql = "SELECT count(post_id) FROM posts WHERE post_type='job' OR post_type='carrier' or post_type='internship' ";
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
	
	$sql = "SELECT * FROM posts WHERE post_type='job' OR post_type='carrier' or post_type='internship' ORDER BY post_id DESC LIMIT $offset, $rec_limit";
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
		<div class="panel-heading" style="padding:5px; background:#008080;">
		<div class="row">
		<div class="col-md-8">
			<div class="media">
				<div class="pull-left"> 
					<img class="img-rounded" src="<?php if($user_profile !=""){echo $user_profile;}else{echo 'images\defaultprofpic.jpg';}?>" alt="Media Object" width="40px" height="40px" style="margin-top:2px;">
				</div>
				<div class="media-body"> 
				<a href="about.php?a=<?php echo $post_uid;?>" style="color:white;">
					<p style="margin:0px; padding:0px;">
						<span style="color:white; font-size:17px;"><b> <?php echo $user_name ;?> </b></span>
				</a>		
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
	
		
		<img src="<?php echo $post_image_dir;?>" class="img-responsive"  alt="post image">
	
	<?php } ?>
	
	<div class="row" style="margin:5px;">
		<p><?php echo nl2br($post_content);?></p>
	</div>
	</div>
</div>
<?php }

		if( $page > 0 )
         {
            $last = $page - 2;
		?>
		<ul class="pager">
			<li class="previous"><a href="home.php?midcol=job_carrier_intern&page=<?php echo $last; ?>">&larr; Previous</a></li> 
			<li class="next"><a href="home.php?midcol=job_carrier_intern&page=<?php echo $page; ?>">Next &rarr;</a></li>
		</ul>
		
        <?php 
         }
         
         else if( $page == 0 )
         {	
		 ?>
			<ul class="pager">
				<li class="next"><a href="home.php?midcol=job_carrier_intern&page=<?php echo $page; ?>">Next &rarr;</a></li>
			</ul>
		<?php
		}
			
         else if( $left_rec < $rec_limit )
         {
            $last = $page - 2;
		?>
            <li class="previous"><a href="home.php?midcol=job_carrier_intern&page=<?php echo $last; ?>">&larr; Previous</a></li> 
        <?php }
         
        
      ?>	
</div>
