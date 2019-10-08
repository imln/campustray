<?php 
if(isset($_SESSION['uid']) == "" && isset($_SESSION['fname']) == "" && isset($_SESSION['batch']) == "")
{
	header("Location: index.php");
}
?>

<div>
<script type="text/javascript" language="javascript">
$(document).ready(function() {
		
$("#confession_form").submit(function(e) {

    var url = "upload_conf.php"; // the script where you handle the form input.

    $.ajax({
           type: "POST",
           url: url,
           data: $('#confession_form').serialize(),		   // serializes the form's elements.
		   cache:false,
		   beforeSend: function()
			{
			$('#confession_textarea').val('');
			
			$('#confession_loading_gif_div').show();
			
			},
           success: function()
           {
               		   // show response from the php script.
			   
			   
			   $('#confession_loading_gif_div').hide();
           }
         });

    e.preventDefault(); // avoid to execute the actual submit of the form.
});	



	

	

});



</script>

<form role="form" id="confession_form" >
	
	<div class="form-group">
		
		<textarea class="form-control" id="confession_textarea" name="conf_content" rows="3" style="resize: none;" maxlength="400" placeholder="Write Anonymous Confession Here... (Max. 350 character)" required></textarea>
	</div>
	
	<div class="form-group">
		<center><input type="submit" class="btn btn-info"   id="submit_story_btn" value="Submit"></center>
	</div>
</form>
	<div id="confession_loading_gif_div" style="display:none;">
		<center><img src="images/loading.gif"></center>
	</div>

</div>

