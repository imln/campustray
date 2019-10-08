<?php
session_start();
include_once 'includes/dbconnect.php';
if(isset($_SESSION['uid']) == "" && isset($_SESSION['fname']) == "" && isset($_SESSION['batch']) == "")
{
	header("Location: index.php");
}

if(isset($_GET['a'])){
				$user_id = $_GET['a'];
				
				

	$user_sql = "SELECT  fname,lname,gender,course,branch,yoe,yog,profpic_dir FROM usersregister WHERE uid=$user_id";
				$user_retval = mysql_query($user_sql);
				if(! $user_retval )
				{
					die('Could not get data: ' . mysql_error());
				}
   
				$user_row = mysql_fetch_array($user_retval, MYSQL_ASSOC);
?>

<!doctype html>
<html>
	<head>
	
	<link rel="shortcut icon" type="image/x-icon" href="images/campustray_logo_small.png" />
		<title><?php echo $user_row['fname'] . ' ' . $user_row['lname'];?></title>
		<!-- Latest compiled and minified CSS 
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="design/css/bootstrap.min.css">

		<!-- jQuery library 
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
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
			
			
			
			


  
<div class="container ">   

	<div class="col-sm-1 ">
      
    </div>
  
    <div class="col-sm-3">
		<div class="well">
			<div class="row">
				<img  src="<?php echo $user_row['profpic_dir'];?>" class="img-responsive">
			</div>
			<div class="row">
				<p style="margin-left:20px;"><span style="margin:0px; font-size:20px;"><b><?php echo strip_tags(htmlentities($user_row['fname'])) . ' ' . strip_tags(htmlentities($user_row['lname']));?></b></span></br><span><b><?php echo $user_row['course']. ' , ' .$user_row['branch']. ' , ' .$user_row['yoe']. '-' .$user_row['yog'];?></b></span></p>
			</div>
		</div>
     
		<div>
			<ul class="nav nav-pills nav-stacked">
			<li><a href="about.php?a=<?php echo $user_id;?>&a_ref=personal_info">Personal Info</a></li>
			<li><a href="about.php?a=<?php echo $user_id;?>&a_ref=location_map">Location</a></li>
			<li><a href="about.php?a=<?php echo $user_id;?>&a_ref=education_info">Education Info</a></li>
			<li><a href="about.php?a=<?php echo $user_id;?>&a_ref=employment_info">Employment Info</a></li>
			<li><a href="about.php?a=<?php echo $user_id;?>&a_ref=achievement_info">Achievement</a></li>
			</ul>
		</div>
    </div>
    <div class="col-sm-7">
		
		<div>
			<?php if(isset($_GET['a_ref']) && isset($_GET['a'])){
				
				$about_ref = $_GET['a_ref'];
				
				switch($about_ref) {
					
					case "personal_info":
					include 'includes/about/about_personal_info.php';
					break;
					
					case "location_map":
					include 'includes/about/about_location_map.php';
					break;
					
					case "education_info":
					include 'includes/about/about_education_info.php';
					break;
					
					case "employment_info":
					include 'includes/about/about_employment_info.php';
					break;
					
					case "achievement_info":
					include 'includes/about/about_achievement_info.php';
					break;
					
				}
			
			}
			?>
		</div>
		
		<div>
			<?php 
				if(isset($_GET['a']) && isset($_GET['a_main_ref'])){
					
					$about_main_ref = $_GET['a_main_ref'];
					
					switch($about_main_ref) {
						
						case "stories":
						include 'includes/about/about_main_stories.php';
						break;
						
						case "document":
						include 'includes/about/about_main_document.php';
						break;
						
						case "wall":
						include 'includes/about/about_main_wall.php';
						break;
						
						default:
						include 'includes/about/about_main_post.php';
					}
					
				}else{
					include 'includes/about/about_main_post.php';
					
				}
					
			?>
		</div>
		
		
		
     
     
         
    </div>
	<div class="col-sm-1 ">
      
    </div>
   
  
</div>



			
			
			
			
			
<?php } ?>
	</body>
</html>