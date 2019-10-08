	<script>
			function validatePass() {
				
				var pass1 = document.forms["changePass"]["newpass1"].value;
				var pass2 = document.forms["changePass"]["newpass2"].value;
				
				
				if( pass1.length < 8 || pass2.length < 8){
					alert("new password and confirm password must be atleast 8 character");
					return false;
				}
				if( pass1 != pass2){
					alert("password does't match");
					return false;
				}
			}
		
		</script>

<div class="row">

<div class="panel panel-default">
		<div class="panel-heading" ><h3 style="color:#4682b4; margin:0px;">Change Password</h3></div>
		<div class="panel-body">


	<form role="form" method="post" name="changePass" action="update_pass.php" onsubmit="return validatePass();" >
		<div class="form-group">
		<label for="title">Enter Old Password:</label>
		<input type="password" name="oldpass" class="form-control" id="usr"  placeholder="Old password" required/>
		</div>
		
		<div class="form-group">
		<label for="title">Enter New Password:</label>
		<input type="password" name="newpass1" class="form-control" id="usr"  placeholder="Min. 8 Character" required/>
		</div>
		
		<div class="form-group">
		<label for="title">Re-enter New Password:</label>
		<input type="password" name="newpass2" class="form-control" id="usr"  placeholder="Min. 8 Character" required/>
		</div>
		
		<div class="form-group">
		<center>
		<input type="submit" class="btn btn-primary" name="changePassBtn" value="Change" class="form-control" >
		</center>
		</div>
	</form>
</div>
</div>
</div>