
	
<div class="row">
	
	<div class="panel panel-default">
		<div class="panel-heading" ><h3 style="color:#4682b4; margin:0px;">Add Education Info</h3></div>
		<div class="panel-body">
	<form role="form" method="post" name="add_education" action="upload_education_info.php" onsubmit="return validateData()">
		<div class="row">
			<div class="col-md-6" >
				<div class="form-group">
					<label for="fname">Year Of Joining</label>
					<input type="number" class="form-control" name="edu_yoj"  min="1960" max="2020"required/>
				</div>
				
			</div>
			<div class="col-md-6" >
				<div class="form-group">
					<label for="lname">Year Of Completion</label>
					<input type="number" class="form-control" name="edu_yoc"  min="1960" max="2020" required/>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6" >
				<div class="form-group">
					<label for="fname">Institution</label>
					<input type="text" class="form-control" name="edu_inst" required/>
				</div>
			</div>
			<div class="col-md-6" >
				<div class="form-group">
					<label for="fname">Education Description</label>
					<input type="text" class="form-control" name="edu_desc" required/>
				</div>
			</div>
			
		</div>
		
		<center>
			<button type="submit" class="btn btn-info" name="addbtn" style="width:130px;">Add</button>
		</center>
	</form>
</div>
</div>
</div>