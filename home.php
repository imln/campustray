<?php
session_start();
include_once 'includes/dbconnect.php';
if(isset($_SESSION['uid']) == "" && isset($_SESSION['fname']) == "" && isset($_SESSION['batch']) == "")
{
	header("Location: index.php");
}
$res=mysql_query("SELECT * FROM usersregister WHERE uid=".$_SESSION['uid']);
$userRow=mysql_fetch_array($res);
?>
<!doctype html>
<html>
	<head>
	
	
	
	<link rel="shortcut icon" type="image/x-icon" href="images/campustray_logo_small.png" />
		<title>campustray.com | Home </title>
		<!-- Latest compiled and minified CSS
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">  -->
		<link rel="stylesheet" href="design/css/bootstrap.min.css">
		
		<link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
		<!-- jQuery library 
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
		<script src="design/jquery.min.js"></script>
		
		<!-- Latest compiled JavaScript -->
		<!--  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>   -->
		<script src="design/js/bootstrap.min.js"></script>
		
		
		
		<meta charset="utf-8">
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<script type="text/javascript">
		function getinfo(value){
			
			
			$.ajax({
           type: "POST",
           url: "searching.php",
           data: {info:value},		   // serializes the form's elements.
		   cache:false,
		   beforeSend: function()
			{
			
			
			$('#search_loading_gif_div').show();
			
			},
           success: function(data)
           {
               		   // show response from the php script.
				$("#results").html(data);
			    $("#search_loading_gif_div").hide();
				
           }
         });
			
		}
		
		
		</script>
		
		<script>
		$(document).ready(function(){
		setInterval(function() {
		$.ajax( {
			url: 'conf_panel.php',
			success: function(data) {
				$('#confession_result_div').html(data);
			}
		});
	},1000);
});
		</script>
		
		
		
		
		
	</head>
	<body style="background:#f0f2f4;">
	
	<!-- facebook plugin -->
	
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
	
				<!--including home header1-->
			<header>
				<?php include 'includes/header2.php';?>
			</header>
<div style="margin-top:70px;">			
		<!--left side bar-->
		<div class="col-md-2" >
			<br/>
			<!-- facebook plugin button -->
			<div>
			<p align="center" style="font-weight:bold; color:teal;">Invite your alumni and colleague via facebook.</p>
			<center><div  class="fb-send" data-href="http://www.campustray.com/"></div></center>
			</div>

			<ul class="nav nav-collapse nav-stacked" >
				<li><a href="home.php"><span class="glyphicon glyphicon-home" ></span> Home</a></li>
				<li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> My Profile</a></li>
				<li><a href="home.php?midcol=document"><span class="glyphicon glyphicon-user"></span> Document </a></li>
				<li><a href="home.php?midcol=wall_feed"><span class="glyphicon glyphicon-user"></span> Wall Feed </a></li>
		   
				<li><a href="exploremap.php"><span class="glyphicon glyphicon-map-marker"></span> Explore Map</a></li>
				<li><a href="home.php?midcol=study"><span class="glyphicon glyphicon-book"></span> Study</a></li>
				<li><a href="home.php?midcol=my_colleague"><span class="glyphicon glyphicon-th-list"></span> My Colleague</a></li>
				<li><a href="home.php?midcol=stories"><span class="glyphicon glyphicon-heart"></span> Stories</a></li>
				<li><a href="home.php?midcol=news_and_announcement"><span class="glyphicon glyphicon-pushpin"></span>News & Announcement</a>
				<li><a href="home.php?midcol=gallery"><span class="glyphicon glyphicon-picture"></span> Gallery</a></li> 
				<li><a href="home.php?midcol=job_carrier_intern"><span class="glyphicon glyphicon-briefcase"></span> Job & Carrier</a></li>
				<li><a href="home.php?midcol=event_council"><span class="glyphicon glyphicon-flag"></span> Event & Council</a></li>
				<li><a href="home.php?midcol=help"><span class="glyphicon glyphicon-eye-open"></span> Help</a></li>				
			</ul>
			
			<div> <!-- face od the day content -->
			

			
			
					<center><h3>Face Of The Day</h3>
					<div class="row">
						<img src="images/lngupta.jpg" class="img-circle" alt="L.N.Gupta's Photo" width="150px">
						<p><b>L.N. Gupta </b><br/> 
							B.Tech IT-2017</p>
					</div>
					
					<div class="row">
						<form role="form" method="POST" id = "form_input" onsubmit="send_opinion(opinion.value)">
						<center>
							<div class="row">
								<input type ="text" class="form-control" name="opinion" placeholder=" Write opinion about him..." >
								
								<input type = "submit" class="btn btn-success" >
								
							</div>
							<div class="row" id="opinion_results">
								
							</div>
						</center>
							
							
						</form>	
					</div>
					<div class="row">
						content
					</div>
					</center>
			</div>
			
			
		</div>
		
		<!--middle content-->
		<div class="col-md-6">
		
			<!-- Search result -->
			<div>
				<div class="well" style="background:#CCE6E6; padding-top:2px; padding-bottom:2px; border:1px solid silver;">
					<input  type="text" class="form-control" placeholder="Find Colleague & Alumni e.g. name, roll no, 1995, m.tech, cse2017, it, microsoft " onkeyup="getinfo(this.value)"/>
				</div>
				<div id="search_loading_gif_div" style="display:none;">
					<center><img src="images/loading.gif"></center>
				</div>
				<div id="results">
					
				</div>
			</div>
		
			
			<?php
				if(isset($_GET['midcol'])){
					
					
					
			$midcol = $_GET['midcol'];

			switch ($midcol) {
				
				case "stories":
				include 'includes/post_stories.php';
				break;
				
				case "gallery":
				include 'includes/post_gallery.php';
				break;
				
				case "document":
				include 'includes/post_document.php';
				break;
				
				case "wall_feed":
				include 'includes/wall_feed.php';
				break;
				
				case "my_colleague":
				include 'includes/my_colleague.php';
				break;
				
				case "study":
				include 'includes/study.php';
				break;
				
				case "news_and_announcement":
				include 'includes/post_news.php';
				break;
				
				case "job_carrier_intern":
				include 'includes/post_carrier.php';
				break;
				
				case "event_council":
				include 'includes/post_event.php';
				break;
				
				case "help":
				include 'includes/post_help.php';
				break;
				
				case "alumni":
				echo "this is alumni wall!";
				break;
				
				case "all_confession":
				include 'includes/all_confession.php';
				break;
				
				default:
				echo "Sorry something going wrong...";
			}

			}else{
				include 'includes/home_view.php';
			}
			?>
			
		</div>
		
		
		<!--right side bar-->
		<div class="col-md-4">
		
			<div class="row">
			<!-- including chat panel -->
			<?php include 'chat_panel.php'; ?>
			</div>
			
			<div class="row">
			<center><p style="color:#008080; font-size:20px;"><b>Anonymous Confession</b></p></center>
			<!-- including confession panel -->
			<?php include 'includes/write_confession.php';?>
			<div id="confession_result_div">
				
			</div>
			</div>
			<div class="row" style="margin:10px;">
			<center><b><a href="home.php?midcol=all_confession">View all confession</a></b></center>
			</div>
		</div>
		
		 
</div>		
		
	</body>
</html>