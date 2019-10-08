<?php
session_start();
include_once 'includes/dbconnect.php';
if(isset($_SESSION['uid'])!="" && isset($_SESSION['fname'])!="" && isset($_SESSION['batch'])!="")
{
	header("Location: home.php");
}

if(isset($_POST['login']))
{
	$loginemail = mysql_real_escape_string($_POST['loginemail']);
	$loginpass = mysql_real_escape_string($_POST['loginpass']);
	$res=mysql_query("SELECT * FROM usersregister WHERE email='$loginemail'");
	$row=mysql_fetch_array($res);
	
	if($row['pass']==md5($loginpass))
	{
		
		$_SESSION['uid'] = $row['uid'];
		$_SESSION['fname'] = $row['fname'];
		$_SESSION['batch'] = $row['branch'] . '-' . $row['yog'];
		header("Location: home.php");
	}
	else
	{
		?>
        <script>alert('wrong details');</script>
        <?php
	}
	
}
?>
<!doctype html>
<html lang="en">
	<head>
	
	<link rel="shortcut icon campustray.com" type="image/x-icon" href="images/campustray_logo_small.png" />
		<title>campustray.com -move beyond the limit...</title>
		<!-- Latest compiled and minified CSS -->
		<!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="design/css/bootstrap.min.css">

		<!-- jQuery library -->
		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
		
		<script src="design/jquery.min.js"></script>
		
		<!-- Latest compiled JavaScript -->
		<!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->
		<script src="design/js/bootstrap.min.js"></script>
		
		
		
		<!-- Optional theme 
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		-->
		<META name="keywords" content="biet jhansi alumni campustray" />
		<meta name="description" content="Campustray.com biet jhansi alumni bundelkhand institute"/>
		
		<meta charset="utf-8">
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<script>
$(document).ready(function(){
    // this is the id of the form
$("#index_forget_pass_form").submit(function(e) {

    var url = "send_email_link.php"; // the script where you handle the form input.
	
    $.ajax({
           type: "POST",
           url: url,
           data: $("#index_forget_pass_form").serialize(),		   // serializes the form's elements.
            beforeSend: function() {
				$("#index_forget_pass_loading_div").show();
			},
		   success: function(data)
           {	
		   
		   $("#index_forget_pass_loading_div").hide();
		   $("#index_forget_pass_form_div").html(data);
               // show response from the php script.
           }
         });

    e.preventDefault(); // avoid to execute the actual submit of the form.
});
});
</script>
		
		
	</head>
	<body>
		<!-- Wrap all page content here -->
<div id="wrap">
  
<header>
	<?php include 'includes/header1.php'; ?>   <!-- including header--> 
</header>

	<!-- test design-->
	
	<div class="intro-header" style=" background:#c8daea; background-size: cover; padding-top: 50px; ">
        <div class="container">

					
					<div class="row">
						<div class="col-md-4" >
							<form role="form" method="post" action="index.php">
								<div class="form-group">
									<label for="email">Email address:</label>
									<input type="email" class="form-control" name="loginemail" id="email" required/>
								</div>
								<div class="form-group">
									<label for="pwd">Password:</label>
									<input type="password" class="form-control" name="loginpass" id="pwd" required/>
								</div>
								
								<div class="checkbox">
									<label><input type="checkbox"> Remember me</label>
									
									<!-- Trigger the modal with a button -->
									<!-- Links -->
								 &nbsp;&nbsp; <a data-toggle="modal" href="#myModal">Forget Password?</a>
								</div>
								
								<div>
								</div>
								<center>
								<button type="submit" class="btn btn-info" name="login" style="width:130px;">Submit</button>
								</center>
							</form>
									

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="margin-top:90px; background-color:;">
      <div class="modal-header" style="background-color: #4682b4;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Do you want to reset your password?</h4>
      </div>
      <div class="modal-body">
        <div id="index_forget_pass_form_div">
			<form role="form" id="index_forget_pass_form">
				<div class="form-group">
					<label for="usrname"><span class="glyphicon glyphicon-envelope"></span> Enter your email </label>
					<input type="email" class="form-control" name="email_pass" placeholder="Enter email" required>
					
				</div>
			
				<div align="right">
					<input type="submit" id="index_forget_pass_form_submit_btn" value="Submit" class="btn btn-success">
				</div>
			</form>
		</div>
		<div id="index_forget_pass_loading_div" style="display:none;">
			<center><img src="images/loading.gif"></center>
		</div>
		
	 </div>
    </div>

  </div>
</div>
								
						</div>
						<div class="col-md-1"></div>
						<div class="col-md-7">
							<h2 align="center">Let's start BIET-Jhansi</h2>
							<h3 align="center"> If you have no account then first register and then login.</h3>
							<br/>
							
							<center>
							<a href="register.php" class="btn btn-success" role="button" style="width:200px;">Click to Register</a>
							</center>
						</div>
						
					</div>
					
					
					
					
					

        </div>
        <!-- /.container -->

    </div>
	
	
	<!--end test design-->
	
	
	
		 <section id="services"  style=" background: #c8daea; /* For browsers that do not support gradients */
    background: -webkit-linear-gradient(#c8daea, white); /* For Safari 5.1 to 6.0 */
    background: -o-linear-gradient(#c8daea, white); /* For Opera 11.1 to 12.0 */
    background: -moz-linear-gradient(#c8daea, white); /* For Firefox 3.6 to 15 */
    background: linear-gradient(#c8daea, white); /* Standard syntax */">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2  >Features Inside</h2>
                    <hr style="margin-top:0px; border:2px solid #4682b4;; width:200px;">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
			
				<div class="col-md-3 col-sm-6 text-center">
					<div class="thumbnail" style="padding-top:15px">
						<img src="images/new_features_myclass.png" alt="My Class">
						<div class="caption" align="center">
							<h4>Myclass</h4>
							<p>Go back to class and relive those moments</p>
						</div>
					</div> 
				</div>
				
				<div class="col-md-3 col-sm-6">
					<div class="thumbnail" style="padding-top:15px"> 
						<img src="images/new_features_job.png" alt="Job Portal">
						<div class="caption" align="center">
							<h4>Job Portal</h4>
							<p>Exclusive career opportunities by alumni</p>
						</div>
					</div> 
				</div>
				
				<div class="col-md-3 col-sm-6">
					<div class="thumbnail" style="padding-top:15px">
						<img src="images/new_features_gallery.png" alt="Gallery">
						<div class="caption" align="center">
							<h4>Gallery</h4>
							<p>Revisit the good college days with photos</p>
						</div>
					</div> 
				</div> 
				 
				
				<div class="col-md-3 col-sm-6">
					<div class="thumbnail" style="padding-top:15px">
						<img src="images/new_features_stories.png" alt="Stories">
						<div class="caption" align="center">
							<h4>Stories</h4>
							<p>Share priceless stories of college times</p>
						</div>
					</div> 
				</div> 
			
                
               
               
            </div>
			
			<div class="row">
				<div class="col-md-3 col-sm-6">
					<div class="thumbnail" style="padding-top:15px"> 
						<img src="images/group_chat_icon.png" alt="chat with friends">
						<div class="caption" align="center">
							<h4>Group Chat</h4>
							<p>Discuss any problem with your friends</p>
						</div>
					</div> 
				</div>
				
				
				<div class="col-md-3 col-sm-6">
					<div class="thumbnail" style="padding-top:15px"> 
						<img src="images/askme_icon.png" alt="chat with friends">
						<div class="caption" align="center">
							<h4>Ask Me</h4>
							<p>Ask solution to your problem with your friends and alumini.</p>
						</div>
					</div> 
				</div>
				
				<div class="col-md-3 col-sm-6">
					<div class="thumbnail" style="padding-top:15px"> 
						<img src="images/confession_icon.png" alt="chat with friends">
						<div class="caption" align="center">
							<h4>Tweets & Confession</h4>
							<p>Tweet and confess your feeling with your friends</p>
						</div>
					</div> 
				</div>
				
				
				<div class="col-md-3 col-sm-6">
					<div class="thumbnail" style="padding-top:15px"> 
						<img src="images/group_study_icon.png" alt="chat with friends">
						<div class="caption" align="center">
							<h4>Study Circle</h4>
							<p>Prepare your exam in group with your collegemate.</p>
						</div>
					</div> 
				</div>
			</div>
        </div>
    </section>

		
		<!--middle content-->
		
		
			
		<div class="container">	
			
			
			
			
			
			
			
			
			<!-- people join with us start here-->
			<div>
				
			</div>
			
			
			
		</div>
	<!-- map image div -->
	<div class="container" >
		<div class="row">
			<div>
				
				<h2 align="center" style="color:gray;">Explore Colleague & Alumni On World Map</h2>
			</div>
			<div align="center">
				<img src="images/worldmap.png" class="img-responsive"  width="700px" alt="world_map_image">
			</div>
			
		</div>
	</div>


	
	
		
		
		
  

  
</div><!--/wrap-->




<?php include 'includes/footer1.php'; ?>   <!-- including footer-->


	</body>
</html>