<?php 
if(isset($_SESSION['uid']) == "" && isset($_SESSION['fname']) == "" && isset($_SESSION['batch']) == "")
{
	header("Location: index.php");
}
?>

<script type="text/javascript" language="javascript">
	$(document).ready(function(){
		
		$("#write_on_wall_form").submit(function(e){
		var wall_url = "upload_wall.php";
		$.ajax({
			
			type: "POST",
			url: wall_url,
			data: $('#write_on_wall_form').serialize(),
			cache:false,
			beforeSend: function()
			{
			$('#wall_content_input').val('');
			
			$('#wall_loading_gif').show();
			
			},
			success: function()
			{
               		   // show response from the php script.
			   
				$("#wall_result").load(location.href + " #wall_result");
				$('#wall_loading_gif').hide();
			}
			
		});	
		
		 e.preventDefault(); // avoid to execute the actual submit of the form.
			
		});
		
		
		
	});
</script>

<div>
<ul class="nav nav-pills nav-justified">
		<li><a href="about.php?a=<?php echo $user_id;?>">Post</a></li>
		<li><a href="about.php?a=<?php echo $user_id;?>&a_main_ref=stories">Stories</a></li>
		<li><a href="about.php?a=<?php echo $user_id;?>&a_main_ref=document">Document</a></li>
		<li class="active"><a href="about.php?a=<?php echo $user_id;?>&a_main_ref=wall">Wall</a></li>
</ul>

</div>

<div style="margin-top:5px;">
	
	<form  role="form" id="write_on_wall_form">
	<div class="form-group col-md-10">
		<input type="hidden" value="<?php echo $user_id;?>" name="wall_rcvr_uid">
		<input type="text" class="form-control" name="wall_content" id="wall_content_input" placeholder="Write Here..." required> 
		
	</div> 
	<div class="form-group">
		<center><input type="submit" class="btn btn-success" value="Submit"></center>
	</div>
	</form>
		<div style="display:none;" id="wall_loading_gif">
			<center><img  src="images/loading.gif"></center>
		</div>
	
</div>

<div id="wall_result">
<?php include 'includes/about/wall_result.php';?>
</div>
