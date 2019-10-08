<script type="text/javascript" language="javascript">

$(document).ready(function() {
	$("#share_doc_form_btn").click(function() {
		$("#doc_form_div").slideToggle(400);
	});
	
	$("#doc_file_selector").change(function(){
		var file = this.files[0];
		name = file.name;
		size = file.size;
		type = file.type;
		ext = file.name.split('.').pop().toLowerCase();
		
		if($.inArray(ext,['pdf','ppt','pptx','doc','docx']) == -1 ){
			$("#doc_post_status").html("Invalid Format...");
			$("#submit_doc_button").attr("disabled",true);
			
		}else{
			
			if(size >= 4194304){
				$("#doc_post_status").html("Large File Size...");
				$("#submit_doc_button").attr("disabled",true);
			}else{
				$("#doc_post_status").html("");
				$("#submit_doc_button").attr("disabled",false);
				
			}
			
		}
		
 		
	});
	
	
	
});
	
</script>
<div>
	
	<div>
		<button type="button" id="share_doc_form_btn" class="btn btn-info btn-md btn-block"><span class="glyphicon glyphicon-pencil"></span> <b>Click To Share Document</b></button>
		<div class="well" id="doc_form_div" style="display:none;">
			<form method="post" action="post_doc_processing.php" enctype="multipart/form-data" id="doc_upload_form">
				<label>Only pdf, ppt, pptx, docx, doc ( Max. size 4mb )</label>
				<div id="doc_post_status" style="color:red; font-weight:bold"></div>
				<div class="form-group">
				<input name="doc_file"  type="file"  id="doc_file_selector" required/>
				</div>
				<div class="form-group">
				<label>Write About Document... ( Max. 100 character )</label>
				<textarea  id="about_doc_textarea" name="doc_content" style="resize: none;" maxlength="100" class="form-control" placeholder="Write About Document... ( Max. 100 character )" required></textarea>
				</div>
				
				<div class="form-group">
									<label for="branch">Helpful for:</label>
									<select class="form-control" name="doc_help" required>
										<option value="All">All</option>
										<option value="B.Tech">B.Tech Student</option>
										<option value="M.Tech">M.Tech student</option> 
										<option value="MBA">MBA</option>
										<option value="CE">Civil Engineering</option>
										<option value="CH">Chemical Engineering</option>
										<option value="CSE">Computer Science & Engineering</option> 
										<option value="EE">Electrical Engineering</option> 
										<option value="EC">Electronics & Communication</option> 
										<option value="IT">Information Technology</option>
										<option value="ME">Mechanical Engineering</option>
										<option value="Other">Other</option>
									</select>
								</div>

				<center>
				<input type="submit" name="submit_doc" style="margin-top:10px;" class="btn btn-info"  id="submit_doc_button" value="Upload" />
				</center>
				
			</form>
			
		</div>
	</div>
	
	
	
	<div id="doc_result_div">
<?php		
	$rec_limit = 20;
	
	 /* Get total number of records */
         $sql = "SELECT count(doc_id) FROM doc_details";
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
	
	$sql = "SELECT * FROM doc_details ORDER BY doc_id DESC LIMIT $offset, $rec_limit";
	$retval = mysql_query( $sql);
   
	if(! $retval )
	{
		die('Could not get data: ' . mysql_error());
	}
   
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
	{	
		$doc_id = $row['doc_id'];
		$doc_uid = $row['doc_uid'];
		$doc_timestamp = strtotime($row['doc_timestamp']);
		$doc_url = $row['doc_url'];
		$doc_content = $row['doc_content'];
		$doc_help = $row['doc_help'];
		$doc_type = $row['doc_type'];
		$doc_time=  date("g:i a F j, Y", $doc_timestamp);
		
		  $select_user = "SELECT fname,lname,course,branch,yog FROM usersregister where uid=$doc_uid";
		  $run_user = mysql_query( $select_user );
		  while($user_row = mysql_fetch_array($run_user, MYSQL_ASSOC))
		  {
			$user_name = $user_row['fname'] . ' ' . $user_row['lname'];
			$user_details = $user_row['course'] .' '. $user_row['branch'] . '-' . $user_row['yog'];
			
		  }
	
	
   
	
   	
  
?>

<div>
		<div class="panel-heading" style="padding:5px; margin-top:10px;  background:white;">
		<div class="row">
		<div class="col-md-8" >
			<div class="row" style="margin:0px; ">
			<div class="media" >
				<div class="pull-left"> 
					<img class="img-rounded" height="100px" src="<?php switch($doc_type){
						case "pdf":
							echo 'images/pdf.jpg';
							break;
						case "ppt":
							echo 'images/ppt.jpg';
							break;
						case "pptx":
							echo 'images/pptx.jpg';
							break;
						case "doc":
							echo 'images/doc.jpg';
							break;
						case "docx":
							echo 'images/docx.jpg';
						}?> " 
						alt="<?php switch($doc_type){
						case "pdf":
							echo 'pdf';
							break;
						case "ppt":
							echo 'ppt';
							break;
						case "pptx":
							echo 'pptx';
							break;
						case "doc":
							echo 'doc';
							break;
						case "docx":
							echo 'docx';
						} ?>" >
				</div>
				<div class="media-body" style=""> 
				
					<p style="margin:0px; padding:0px;">
				<a href="about.php?a=<?php echo $doc_uid;?>" style="">
						<span style="font-size:17px;"><b> <?php echo $user_name; ?> </b></span>
				</a>		
						<span style="font-size:12px; margin:0px; padding:0px; "> <?php echo $user_details; ?> </span></br>
						<span style="font-size:12px; margin:0px; padding:0px; color:gray;"> <?php echo $doc_time; ?> </span></br>
						<b><?php echo $doc_content; ?></b>
					</p>
					
					<p><span style="font-size:12px;  margin-top:30px; color:#4682b4;"><?php echo substr_replace($doc_url,'',0,30);?></span>
					</p>
				
				</div>
			</div>
			</div>
		</div>
		
		<div class="col-md-4">
			<p style="font-size:15px;"><span style="color:gray; font-size:13px;">Helpful for  </span><b><?php echo $doc_help; ?></b></p>
			<span style=" font-size:20px;"> 
				<a href="<?php echo $doc_url; ?>" target="_blank">Open</a><br/>
				<a href="<?php echo $doc_url; ?>" download="<?php echo substr_replace($doc_url,'',0,30); ?>">Download</a>
			</span>
		</div>
		</div>
		</div>
	</div>	
		
	
<?php }

		if( $page > 0 )
         {
            $last = $page - 2;
		?>
		<ul class="pager">
			<li class="previous"><a href="home.php?midcol=document&page=<?php echo $last; ?>">&larr; Previous</a></li> 
			<li class="next"><a href="home.php?midcol=document&page=<?php echo $page; ?>">Next &rarr;</a></li>
		</ul>
		
        <?php 
         }
         
         else if( $page == 0 )
         {	
		 ?>
			<ul class="pager">
				<li class="next"><a href="home.php?midcol=document&page=<?php echo $page; ?>">Next &rarr;</a></li>
			</ul>
		<?php
		}
			
         else if( $left_rec < $rec_limit )
         {
            $last = $page - 2;
		?>
            <li class="previous"><a href="home.php?midcol=document&page=<?php echo $last; ?>">&larr; Previous</a></li> 
        <?php }
         
        
      ?>
	</div>
	
	
	
	
	
	
	
</div>