<?php
session_start();
if(isset($_SESSION['uid'])!="" && isset($_SESSION['fname'])!="" && isset($_SESSION['batch'])!="")
{
	header("Location:home.php");
}
include_once 'includes\dbconnect.php';

if(isset($_POST['submit']))
{ 
	if($_POST['pass1'] == $_POST['pass2'])
	{
	$fname = mysql_real_escape_string($_POST['fname']);
	$lname = mysql_real_escape_string($_POST['lname']);
	$gender = mysql_real_escape_string($_POST['gender']);
	$email = mysql_real_escape_string($_POST['email']);
	$rollno = mysql_real_escape_string($_POST['rollno']);
	$course = mysql_real_escape_string($_POST['course']);
	$branch = mysql_real_escape_string($_POST['branch']);
	$yoe = mysql_real_escape_string($_POST['yoe']);
	$yog = mysql_real_escape_string($_POST['yog']);
	$pass = md5(mysql_real_escape_string($_POST['pass1']));
	
	$uip = $_SERVER['REMOTE_ADDR'];
	$query = "INSERT INTO usersregister(fname,lname,gender,email,rollno,course,branch,yoe,yog,pass,uip) VALUES('$fname','$lname','$gender','$email','$rollno','$course','$branch','$yoe','$yog','$pass','$uip')";
	if(mysql_query($query))
	{
		?>
        <script>
			alert('successfully registered ');
			window.open('index.php','_self');
		</script>;
        <?php
    }
	else
	{
		?>
        <script>alert('error while registering you...');</script>
        <?php
	}
	}
	else{
		?>
        <script>alert('password does not match');</script>
        <?php
	}
}
?>

<!doctype html>
<html lang="en">
	<head>
	
	<link rel="shortcut icon" type="image/x-icon" href="images\campustray_logo_small.png" />
		<title>campustray.com | Register</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="design/css/bootstrap.min.css">

		<!-- jQuery library 
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
		<script src="design/jquery.min.js"></script>
		 <!--<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.3.min.js"></script>  -->
		<!-- Latest compiled JavaScript 
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->
		<script src="design/js/bootstrap.min.js"></script>
		
		

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">


		
		<meta charset="utf-8">
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<script>
			function validateForm() {
				var yoe = document.forms["registerForm"]["yoe"].value;
				var yog = document.forms["registerForm"]["yog"].value;
				if ( yoe >= yog ){
					alert("year of graduation must be greater then year of entry");
					return false;
				}
				var pass1 = document.forms["registerForm"]["pass1"].value;
				var pass2 = document.forms["registerForm"]["pass2"].value;
				if( pass1.length < 8 || pass2.length < 8){
					alert("password and confirm password must be atleast 8 character");
					return false;
				}
				if( pass1 != pass2){
					alert("password does't match");
					return false;
				}
			}
		
		</script>
		
		
	</head>
	<body>
		<!-- Wrap all page content here -->
		<div id="wrap">
			<header>
				<?php include 'includes\header1.php'; ?>   <!-- including header--> 
			</header>
		</div>
		
		
		<!-- registration start here -->
		<center style="color:teal;">
			<h1>Registration</h1>
			
		</center>
		
		
		<div>
			<div class="container" style="margin-top:20px; margin-bottom:0px;">
				<div class="jumbotron" style="background:white; padding-top:0px;">
					<center style="margin:10px;">
						We're glad to see you here. Tell us a bit more about yourself.
							</br>This information will also help us verify you as a member.
					</center>
					
				
					<form role="form" method="post" name="registerForm" action="register.php" onsubmit="return validateForm()">
						<div class="row">
							<div class="col-md-6" >
								<div class="form-group">
									<label for="fname">FIRST NAME:</label>
									<input type="text" class="form-control" name="fname" id="fname" required/>
								</div>
							</div>
							<div class="col-md-6" >
								<div class="form-group">
									<label for="lname">LAST NAME:</label>
									<input type="text" class="form-control" name="lname" id="lname" required/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6" >
								<div class="form-group">
									<label for="email">EMAIL:</label>
									<input type="email" class="form-control" name="email" id="email" required/>
								</div>
							</div>
							<div class="col-md-6" >
								<div class="form-group">
									<label for="rollno">ROLL NUMBER:</label>
									<input type="number" class="form-control" name="rollno" id="rollno" required/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6" >
								<div class="form-group">
									<label for="course">COURSE:</label>
									<select class="form-control" name="course" value="" >
										<option value="B.Tech">B.Tech</option>
										<option value="M.Tech">M.Tech</option> 
										<option value="MBA">MBA</option> 
									</select>
								</div>
							</div>
							<div class="col-md-6" >
								<div class="form-group">
									<label for="branch">BRANCH:</label>
									<select class="form-control" name="branch" value="" >
										<option value="CE">Civil Engineering</option>
										<option value="CH">Chemical Engineering</option>
										<option value="CSE">Computer Science & Engineering</option> 
										<option value="EE">Electrical Engineering</option> 
										<option value="EC">Electronics & Communication</option> 
										<option value="IT">Information Technology</option>
										<option value="ME">Mechanical Engineering</option>
										<option value="other">Other</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6" >
								<div class="form-group">
									<label for="yoe">YEAR OF ENTRY:</label>
									<select class="form-control" id="year" name="yoe" id="yoe" required>
  <?php
  for($i = 1980; $i < date("Y")+2; $i++){
	  echo '<option value="'.$i.'">'.$i.'</option>';
  }
  ?>
									</select>
									
								</div>
							</div>
							<div class="col-md-6" >
								<div class="form-group">
									<label for="yog">YEAR OF GRADUATION:</label>
									<select class="form-control" id="year" name="yog" id="yog" required>
  <?php
  for($i = 1982; $i < date("Y")+6; $i++){
	  echo '<option value="'.$i.'">'.$i.'</option>';
  }
  ?>
									</select>
									
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6" >
								<div class="form-group">
									<label for="pass1">PASSWORD:</label>
									<input type="password" class="form-control" name="pass1" id="pass1" placeholder="minimum 8 characters" required/>
								</div>
							</div>
							<div class="col-md-6" >
								<div class="form-group">
									<label for="pass2">CONFIRM PASSWORD:</label>
									<input type="password" class="form-control" name="pass2" id="pass2" placeholder="minimum 8 characters" required/>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12" >
								<div class="form-group">
									<center style="font-size:18px;" >
										<label><input type="radio"  name="gender" value="male" checked> Male </label>
										<label><input type="radio"  name="gender" value="female"> Female</label>	
									</center>
								</div>
							</div>
							
						</div>
						
						<div class="row">
							<div class="col-md-12" >
								<div class="form-group">
									<center><button type="submit" class="btn btn-info"  name="submit" style="width:200px;">Submit</button></center>
								</div>
							</div>
							
						</div>
						
						
					</form>
					
						
						
				</div>
					
			</div>
		</div>
		
		
	</body>
</html>