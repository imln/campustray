   <div>
<script type="text/javascript" language="javascript">
$(document).ready(function() {
	$("#write_post_btn").click(function () {
		$("#write_post_form_box").slideToggle(400);
	});
	
	
$("form#post_form").submit(function(){

    var formData = new FormData($(this)[0]);
	$('#write_post_loading_gif_div').show();

    $.ajax({
        url: 'uploadpost.php',
        type: 'POST',
        data: formData,
        async: false,
		beforeSend: function()
			{
			
			$("#write_post_form_box").hide();
			
			
			
			
			},
        success: function (data) {
             
			 $('#post_result_div').load(location.href + " #post_result_div");
			   

			  $('#write_post_loading_gif_div').hide();
			  
			  $('#write_post_loading_result').html(data); 
			  
        },
        cache: false,
        contentType: false,
        processData: false
    });

    return false;
});		

	

});



</script>

	<div>
		<button type="button" id="write_post_btn" class="btn btn-info btn-md btn-block"><span class="glyphicon glyphicon-pencil"></span> <b>Click To Post</b></button>
		<div id="write_post_form_box" style="display:none;">
			
				<div class="well" > 
					<form id="post_form" method="post"   >
						<div class="form-group">
							<label for="sel1">Post as:</label>
							<select class="form-control" id="" name="type">
								<option value="Post">Post</option>
								<option value="News">News</option>
								<option value="Event">Event</option>
								<option value="Council">Council</option>
								<option value="Announcement">Announcement</option>
								<option value="Achievement">Achievement</option>
								<option value="Wish">Wish</option>
								<option value="Job">Job</option>
								<option value="Carrier">Carrier</option>
								<option value="Internship">Internship</option>
								<option value="Help">Help</option>
							</select>
						</div>
						
						<div class="form-group">
							<label for="title">Title:</label>
							<input type="text" id="post_title" name="title" class="form-control" id="usr" maxlength="60" placeholder="approx 50 characters" required/>
						</div>
						
						<div class="form-group">
							<label for="content">Content (optional):</label>
							<textarea class="form-control" id="post_content" name="content" rows="3" style="resize: vertical;"></textarea>
						</div>
						<div class="form-group">
							<label for="image">Choose Image (optional):</label>
							<input type="file" id="post_image" name="postimage"  accept="image/*" >
						</div>
						<div class="form-group">
							<center><input type="submit" class="btn btn-info"   id="submit_story_btn" value="Submit"></center>
						</div>
					</form>
				</div>
			
		</div>
		<div id="write_post_loading_gif_div" style="display:none;">
			<center><img src="images/loading.gif"></center>
		</div>
		<div id="write_post_loading_result" style="">
			
		</div>
		
		
	</div>


<div id="post_result_div" style="margin-top:10px;">


<?php
	
	$rec_limit = 15;
	
	 /* Get total number of records */
         $sql = "SELECT count(post_id) FROM posts ";
         $retval = mysql_query( $sql);
         
         if(!$retval)
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
	
	$sql = "SELECT * FROM posts ORDER BY post_id DESC LIMIT $offset, $rec_limit";
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
					<img class="img-rounded" src="<?php if($user_profile !=""){echo $user_profile;}else{echo 'images/defaultprofpic.jpg';}?>" alt="Media Object" width="40px" height="40px" style="margin-top:2px;">
				</div>
				<div class="media-body"> 
				
					<p style="margin:0px; padding:0px;">
				<a href="about.php?a=<?php echo $post_uid;?>" style="color:white;">
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
	<div class="panel-body" style="background:;">
	<div >
		<p style="font-size:25px;"> <?php echo $post_title;?> </p>
	</div>
	
	<?php if( $post_image_dir != '') { ?>
	
		
		<img src="<?php echo $post_image_dir;?>" class="img-responsive"  style="max-height:400px;" alt="post image">
	
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
			<li class="previous"><a href="home.php?page=<?php echo $last; ?>">&larr; Previous</a></li> 
			<li class="next"><a href="home.php?page=<?php echo $page; ?>">Next &rarr;</a></li>
		</ul>
		
        <?php 
         }
         
         else if( $page == 0 )
         {	
		 ?>
			<ul class="pager">
				<li class="next"><a href="home.php?page=<?php echo $page; ?>">Next &rarr;</a></li>
			</ul>
		<?php
		}
			
         else if( $left_rec < $rec_limit )
         {
            $last = $page - 2;
		?>
            <li class="previous"><a href="home.php?page=<?php echo $last; ?>">&larr; Previous</a></li> 
        <?php }
         
        
      ?>	
</div>
</div>