<?php 
if(isset($_SESSION['uid']) == "" && isset($_SESSION['fname']) == "" && isset($_SESSION['batch']) == "")
{
	header("Location: index.php");
}
?>
<div>
<ul class="nav nav-pills nav-justified">
		<li><a href="about.php?a=<?php echo $user_id;?>">Post</a></li>
		<li><a href="about.php?a=<?php echo $user_id;?>&a_main_ref=stories">Stories</a></li>
		<li  class="active"><a href="about.php?a=<?php echo $user_id;?>&a_main_ref=document">Document</a></li>
		<li><a href="about.php?a=<?php echo $user_id;?>&a_main_ref=wall">Wall</a></li>
</ul>

</div>

<div id="doc_result_div">
<?php		
	
	
	 
	
	$sql = "SELECT * FROM doc_details WHERE doc_uid=$user_id ORDER BY doc_id DESC";
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
		<div class="col-md-8">
			<div class="media">
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
						}?>" 
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
				<div class="media-body"> 
				
					<p style="margin:0px; padding:0px;">
				<a href="about.php?a=<?php echo $doc_uid;?>" style="">
						<span style="font-size:17px;"><b> <?php echo $user_name; ?> </b></span>
				</a>		
						<span style="font-size:12px; margin:0px; padding:0px; "> <?php echo $user_details; ?> </span></br>
						<span style="font-size:12px; margin:0px; padding:0px; color:gray;"> <?php echo $doc_time; ?> </span></br>
						<b><?php echo $doc_content; ?></b>
					</p>
					
					<p style="margin-top:10px;"><span style="font-size:12px;  margin-top:30px; color:#4682b4;"><?php echo substr_replace($doc_url,'',0,30);?></span>
					</p>
				
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
         
        
      ?>
	</div>