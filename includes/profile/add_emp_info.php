
	
<div class="row">
<div class="panel panel-default">
		<div class="panel-heading" ><h3 style="color:#4682b4; margin:0px;">Add Employment Info</h3></div>
		<div class="panel-body">
		
	<form role="form" method="post" name="add_emp_info" action="upload_emp_info.php" >
		<div  style="margin-top:15px;">
			<div class="col-md-6" >
				<div class="form-group">
					<label for="">Work At</label>
					<input type="text" class="form-control" name="emp_workat" maxlength="100" required/>
				</div>
			</div>
			<div class="col-md-6" >
				<div class="form-group">
					<label for="">Role / Designation</label>
					<input type="text" class="form-control" maxlength="80" name="emp_role" >
				</div>
			</div>
			
		</div>
		<div  style="margin-top:10px;">
		<div class="form-group">
			<div class="col-md-6" >
				<div class="form-group">
					<label>Start Month</label>
					<select class="form-control" id="year" name="emp_sm">
						<option value="Jan">Jan</option>
						<option value="Feb">Feb</option>
						<option value="Mar">Mar</option>
						<option value="Apr">Apr</option>
						<option value="May">May</option>
						<option value="Jun">Jun</option>
						<option value="Jul">Jul</option>
						<option value="Aug">Aug</option>
						<option value="Sep">Sep</option>
						<option value="Oct">Oct</option>
						<option value="Nov">Nov</option>
						<option value="Dec">Dec</option>
					</select>
					
					<label >Start Year</label>
					<select class="form-control" id="year" name="emp_sy">
  <?php
  for($i = 1970; $i < date("Y")+1; $i++){
	  echo '<option value="'.$i.'">'.$i.'</option>';
  }
  ?>
					</select>
				</div>
				
			</div>
			<div class="col-md-6" >
				<div class="form-group">
					<label >End Month</label>
					<select class="form-control" id="year" name="emp_em">
						<option value="">-</option>
						<option value="Jan">Jan</option>
						<option value="Feb">Feb</option>
						<option value="Mar">Mar</option>
						<option value="Apr">Apr</option>
						<option value="May">May</option>
						<option value="Jun">Jun</option>
						<option value="Jul">Jul</option>
						<option value="Aug">Aug</option>
						<option value="Sep">Sep</option>
						<option value="Oct">Oct</option>
						<option value="Nov">Nov</option>
						<option value="Dec">Dec</option>
					</select>
					<label >End Year / Current</label>
					<select class="form-control" id="year" name="emp_ey">
						<option value="Current">Current</option>
  <?php
  for($i = 1970; $i < date("Y")+1; $i++){
	  echo '<option value="'.$i.'">'.$i.'</option>';
  }
  ?>
					</select>
				</div>
				
			</div>
		</div>
		</div>
		
		
		<center style="margin-top:15px;">
			<button type="submit" class="btn btn-info" name="addempinfobtn" style="width:130px;">Add</button>
		</center>
	</form>
</div>
</div>
</div>