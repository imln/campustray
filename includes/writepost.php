<div>


<form role="form" method="post" action="uploadpost.php" onsubmit="return validate();" enctype="multipart/form-data">
	<div class="form-group">
		<label for="sel1">Post as:</label>
		<select class="form-control" id="" name="type">
			<option value="Post">Post</option>
			<option value="News">News</option>
			<option value="Event">Event</option>
			<option value="Council">Council</option>
			<option value="Announcement">Announcement</option>
			<option value="Achievement">Achievement</option>
			<option value="Job">Job</option>
			<option value="Carrier">Carrier</option>
			<option value="Internship">Internship</option>
			<option value="Help">Help</option>
		</select>
	</div>
	<div class="form-group">
		<label for="title">Title:</label>
		<input type="text" name="title" class="form-control" id="usr" maxlength="60" placeholder="approx 50 characters" required/>
	</div>
	<div class="form-group">
		<label for="content">Content:</label>
		<textarea class="form-control" name="content" rows="5" id="comment" placeholder="" required></textarea>
	</div>
	<div class="form-group">
		<label for="image">Choose Image (optional):</label>
		<input type="file" name="postimage"  id="" accept="image/*" style="height:28px; width:175px;">
	</div>
	<div class="form-group">
		<center><button type="submit" name="submit" align="center" class="btn btn-default" style="background:#008080; color:white;">Submit</button></center>
	</div>
</form>
</div>

