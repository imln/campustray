<?php 

if(isset($_SESSION['uid']) =="" && isset($_SESSION['fname']) =="" && isset($_SESSION['batch']) =="")
{
	header("Location:../index.php");
}
?>





<script type="text/javascript" language="javascript">

$(document).ready(function() {
	$("#glry_form_btn").click(function() {
		$("#glry_form_div").slideToggle(400);
	});
	
	$("#glry_img_selector").change(function(){
		var file = this.files[0];
		name = file.name;
		size = file.size;
		type = file.type;
		ext = file.name.split('.').pop().toLowerCase();
		
		if($.inArray(ext,['png','jpg','jpeg','gif']) == -1 ){
			$("#glry_post_status").html("Invalid Format...");
			$("#submit_glry_button").attr("disabled",true);
			
		}else{
			
			if(size >= 2097152){
				$("#glry_post_status").html("Large File Size...");
				$("#submit_glry_button").attr("disabled",true);
			}else{
				$("#glry_post_status").html("");
				$("#submit_glry_button").attr("disabled",false);
				
			}
			
		}
		
 		
	});
	
	
	
});
	
</script>


	<div style="margin-bottom:10px;">
		<button type="button" id="glry_form_btn" class="btn btn-info btn-md btn-block"><span class="glyphicon glyphicon-pencil"></span> <b>Click To Add Image</b></button>
		<div class="well" id="glry_form_div" style="display:none;">
			<p style="color:green;">Gallery must be related to your college or of college memory...</p>
			<form method="post" action="gallery_processing.php" enctype="multipart/form-data" id="doc_upload_form">
				<label>Only jpg, jpeg, gif, png ( Max. size 2mb )</label>
				<div id="glry_post_status" style="color:red; font-weight:bold"></div>
				<div class="form-group">
					<input name="glry_file"  type="file"  accept="image/*" id="glry_img_selector" required/>
				</div>
				<div class="form-group">
				<label>Write About Images... ( Max. 100 character )</label>
				<textarea  id="about_glry_textarea" name="glry_content" style="resize: none;" maxlength="100" class="form-control" placeholder="Write About Image... ( Max. 100 character )"></textarea>
				</div>
				
				

				<center>
				<input type="submit" name="submit_glry" style="margin-top:10px;" class="btn btn-info"  id="submit_glry_button" value="Upload" />
				</center>
				
			</form>
			
		</div>
	</div>
	


<div id="glry_result_div" class="row">
<?php		
	$rec_limit = 40;
	
	 /* Get total number of records */
         $sql = "SELECT count(glry_id) FROM glry_details";
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
	
	$sql = "SELECT * FROM glry_details ORDER BY glry_id DESC LIMIT $offset, $rec_limit";
	$retval = mysql_query( $sql);
   
	if(! $retval )
	{
		die('Could not get data: ' . mysql_error());
	}
   
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
	{	
		$glry_id = $row['glry_id'];
		$glry_uid = $row['glry_uid'];
		$glry_timestamp = strtotime($row['glry_time']);
		$glry_url = $row['glry_url'];
		$glry_content = $row['glry_content'];
		$glry_time=  date("g:i a F j, Y", $glry_timestamp);
		
		  $select_user = "SELECT fname,lname,course,branch,yog FROM usersregister where uid=$glry_uid";
		  $run_user = mysql_query( $select_user );
		  while($user_row = mysql_fetch_array($run_user, MYSQL_ASSOC))
		  {
			$user_name = $user_row['fname'] . ' ' . $user_row['lname'];
			$user_details = $user_row['course'] .' '. $user_row['branch'] . '-' . $user_row['yog'];
			
		  }
	
	
   
	
   	
  
?>

<div class="col-md-6 col-sm-6" >
      <div class="thumbnail">
        <p><?php echo strip_tags(htmlentities($glry_content));?></p>    
        <a href="#" type="button" class="click_to_zoom"  value="<?php echo strip_tags(htmlentities($glry_url));?>" data-toggle="modal" data-target="#myModal">
			<img class="glry_img_zoom" src="<?php echo strip_tags(htmlentities($glry_url));?>" alt="image" >
		</a>
		<p>Credit - <a href="about.php?a=<?php echo $glry_uid;?>"><b><?php echo strip_tags(htmlentities($user_name));?></b></a> <span style="font-size:12px;"><?php echo strip_tags(htmlentities($user_details));?></span></a>
      </div>
    </div>
		
	
<?php }

		if( $page > 0 )
         {
            $last = $page - 2;
		?>
		<ul class="pager">
			<li class="previous"><a href="home.php?midcol=gallery&page=<?php echo $last; ?>">&larr; Previous</a></li> 
			<li class="next"><a href="home.php?midcol=gallery&page=<?php echo $page; ?>">Next &rarr;</a></li>
		</ul>
		
        <?php 
         }
         
         else if( $page == 0 )
         {	
		 ?>
			<ul class="pager">
				<li class="next"><a href="home.php?midcol=gallery&page=<?php echo $page; ?>">Next &rarr;</a></li>
			</ul>
		<?php
		}
			
         else if( $left_rec < $rec_limit )
         {
            $last = $page - 2;
		?>
            <li class="previous"><a href="home.php?midcol=gallery&page=<?php echo $last; ?>">&larr; Previous</a></li> 
        <?php }
         
        
      ?>
	</div>


 
  
  
  
    	
	
	


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-body" style="background:#DCDCDC;">
		<button type="button" class="close"  data-dismiss="modal">&times;</button>
		<center>
        <img src="images/img3.jpg" id="modal_img_box" class="img-responsive" >
		</center>
      </div>
      
    </div>

  </div>
</div>

<script>
$(document).ready(function(){
    $(".click_to_zoom").click(function(){
		var a = $(this).attr("value");
       $("#modal_img_box").attr("src", a); 
    });
});
</script>

	
	


  
   
   

    
  </body>


  

