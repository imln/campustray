<?php
session_start();
include_once 'includes/dbconnect.php';
if(isset($_SESSION['uid'])=="" && isset($_SESSION['fname'])=="" && isset($_SESSION['batch'])=="")
{
	header("Location: index.php");
}

?>
<!doctype html>
<html>
	<head>
	
	<link rel="shortcut icon" type="image/x-icon" href="images/campustray_logo_small.png" />
		<title>campustray.com | Profile</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="design/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="design/jquery.min.js"></script>
		
		<!-- Latest compiled JavaScript -->
		<!--  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>   -->
		<script src="design/js/bootstrap.min.js"></script>
		
		<meta charset="utf-8">
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body style="background:#f0f2f4;">
	
			<!--including home header1-->
			<header style="margin-bottom:100px;">
				<?php include 'includes/header2.php';?>
			</header>
		
		
		
		
		
		
		
		
		
		
		<div>	
		<div class="container">
		
		<div class="col-sm-1 ">
      
		</div>
		
		<!--left side bar-->
		<div class="col-md-3" >
		
			<div class="well">
				<?php include 'includes/profile/prof_pic.php';?>
			</div>
		
			<div> <!--change profile div -->

			<ul class="nav nav-pills nav-stacked">
				<li></li>
				
				<li><a href="profile.php?rcol=basicinfo"><span class="glyphicon glyphicon-asterisk"></span> Basic Info</a></li>
				<li><a href="profile.php?rcol=personalinfo"><span class="glyphicon glyphicon-eye-open"></span> Personal Info</a></li>
				<li><a href="profile.php?rcol=maplocation"><span class="glyphicon glyphicon-map-marker"></span> Map Location</a></li>
				<li><a href="profile.php?rcol=educationinfo"> <span class="glyphicon glyphicon-education"></span> Education Info</a></li>
				<li><a href="profile.php?rcol=employmentinfo"><span class="glyphicon glyphicon-briefcase"></span> Employment Info</a></li>
				<li><a href="profile.php?rcol=achievement"><span class="glyphicon glyphicon-sunglasses"></span> Achievement & Activity</a></li>
				<li><a href="profile.php?rcol=chngpass"><span class="glyphicon glyphicon-lock"></span> Change Password</a></li>				
			</ul>
			
			</div>
		</div>
		
		<!--right content-->
		<div class="col-md-7">
		
		<div>
			
			<?php
				if(isset($_GET['rcol'])){
					
					
					
			$rcol = $_GET['rcol'];

			switch ($rcol) {
				case "basicinfo":
				include 'includes/profile/basic_info.php';
				break;
				
				case "personalinfo":
				include 'includes/profile/personal_info.php';
				break;
				
				case "editpersonalinfo":
				include 'includes/profile/edit_personal_info.php';
				break;
				
				case "maplocation":
				include 'includes/profile/map_location.php';
				break;
				
				case "editmaplocation":
				include 'includes/profile/edit_map_location.php';
				break;
				
				case "educationinfo":
				include 'includes/profile/education_info.php';
				break;
				
				case "addeducationinfo":
				include 'includes/profile/add_education_info.php';
				break;
				
				case "employmentinfo":
				include 'includes/profile/emp_info.php';
				break;
				
				case "addemploymentinfo":
				include 'includes/profile/add_emp_info.php';
				break;
				
				case "achievement":
				include 'includes/profile/achievement.php';
				break;
				
				case "addachievement":
				include 'includes/profile/add_achievement.php';
				break;
				
				case "chngpass":
				include 'includes/profile/change_pass.php';
				break;
				
			}

			}
			?>
		</div>
		
		
		<div>
			
			<?php
			if(isset($_GET['m_rcol'])){
					
					
					
			$main_rcol = $_GET['m_rcol'];

			switch ($main_rcol) {
				case "stories":
				include 'includes/profile/my_stories.php';
				break;
				case "document":
				include 'includes/profile/my_document.php';
				break;
				case "wall":
				include 'includes/profile/main_wall.php';
				
			}
			}else{
				
				include 'includes/profile/my_post.php';
			}
			?>
			
		</div>
		
			
		</div>
		
		<div class="col-sm-1 ">
      
		</div>
		
		</div>
		
		
		
		 
</div>
	</body>
</html>