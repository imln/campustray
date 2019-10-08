
<script type="text/javascript" language="javascript">
$(document).ready(function() {
	$("#write_story_btn").click(function () {
		$("#story_input_box").slideToggle(400);
	});
	
	
$("#story_form").submit(function(e) {

    var url = "includes/story_processing.php"; // the script where you handle the form input.

    $.ajax({
           type: "POST",
           url: url,
           data: $('#story_form').serialize(),		   // serializes the form's elements.
		   cache:false,
		   beforeSend: function()
			{
			$('#story_textarea').val('');
			$('#story_input_box').hide();
			$('#loading_gif_div').show();
			
			},
           success: function()
           {
               		   // show response from the php script.
			   
			   $("#story_result_div").load(location.href + " #story_result_div");
			   $('#loading_gif_div').hide();
           }
         });

    e.preventDefault(); // avoid to execute the actual submit of the form.
});		

	

});



</script>



<div>
	
	<div>
		<button type="button" id="write_story_btn" class="btn btn-info btn-md btn-block"><span class="glyphicon glyphicon-pencil"></span> <b>Click To Write Story</b></button>
		<div id="story_input_box" style="display:none;">
			
				<div class="well"> 
					<form id="story_form" >
						<div class="row">
							
							
									
									<textarea  id="story_textarea" name="story_content" style="resize: vertical;" class="form-control" placeholder="Write Here..."></textarea>
								
									<center><input type="submit" class="btn btn-info"  style="margin-top:10px;" id="submit_story_btn" value="Submit"></center>
								
							
							
						
						</div>
					</form>
				</div>
			
		</div>
		<div id="loading_gif_div" style="display:none;">
			<center><img src="images/loading.gif"></center>
		</div>
		<div id="story_result"></div>
		
	</div>
	



<div id="story_result_div">
<?php
	
	$rec_limit = 10;
	
	 /* Get total number of records */
         $sql = "SELECT count(story_id) FROM stories";
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
	
	$sql = "SELECT * FROM stories ORDER BY story_id DESC LIMIT $offset, $rec_limit";
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
		
		  $select_user = "SELECT fname,lname,course,branch,yog FROM usersregister where uid=$story_uid";
		  $run_user = mysql_query( $select_user );
		  while($user_row = mysql_fetch_array($run_user, MYSQL_ASSOC))
		  {
			$user_name = $user_row['fname'] . ' ' . $user_row['lname'];
			$user_details = $user_row['course'] .' '. $user_row['branch'] . '-' . $user_row['yog'];
			
		  }
	
	
   
	
   	
  
?>

	
	<div class="panel panel-info" style="margin-top:10px;"> 
	<div class="panel-heading" style="background-color:;"> 
		<p><?php echo $story_time; ?></p>
		<p style="color:black;">
			&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $story_content; ?>
		</p>
		<p align="right"><span class="glyphicon glyphicon-pencil"></span> <b><?php echo $user_name;?></b><br/><span><?php echo $user_details; ?></span> </p>

	</div> 
 
	</div>	
	
<?php }

		if( $page > 0 )
         {
            $last = $page - 2;
		?>
		<ul class="pager">
			<li class="previous"><a href="home.php?midcol=stories&page=<?php echo $last; ?>">&larr; Previous</a></li> 
			<li class="next"><a href="home.php?midcol=stories&page=<?php echo $page; ?>">Next &rarr;</a></li>
		</ul>
		
        <?php 
         }
         
         else if( $page == 0 )
         {	
		 ?>
			<ul class="pager">
				<li class="next"><a href="home.php?midcol=stories&page=<?php echo $page; ?>">Next &rarr;</a></li>
			</ul>
		<?php
		}
			
         else if( $left_rec < $rec_limit )
         {
            $last = $page - 2;
		?>
            <li class="previous"><a href="home.php?midcol=stories&page=<?php echo $last; ?>">&larr; Previous</a></li> 
        <?php }
         
        
      ?>	
	  
</div>
</div>
