
<nav class="navbar navbar-inverse navbar-fixed-top" style="background-color:#4682b4; ">
<div class="container-fluid">
	<div class="navbar-header" >
	 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
	
		<a href="home.php" style="color:white;"><img src="images/campustray_logo_small.png" width="50px;" style="margin:0px;"><img src="images\campustray_small.png" width="250px;"></a>
		
	</div>
	<div class="collapse navbar-collapse" id="myNavbar">
	
		 
	
		<ul class="nav navbar-nav navbar-right">
		
			
			<li><h4 style="color:white; font-weight:bold; margin-right:10px; margin-top:15px; ">BIET - Jhansi</h4></li>
			 
			
			<li>
				<img src="
<?php 
$uid = $_SESSION['uid'];
$sql = "SELECT profpic_dir FROM usersregister WHERE uid='$uid' ";
$retval = mysql_query($sql);
if(! $retval )
{
	die('Could not get data: ' . mysql_error());
}else{
	$row = mysql_fetch_array($retval, MYSQL_ASSOC);
	if( $row['profpic_dir'] != ""){
		echo $row['profpic_dir'];
	}else{
		echo 'images\defaultprofpic.jpg';
	}
				
}?>" class="img-rounded" alt="user profile" width="40" height="40" style="margin-top:4px;">
			</li>
			<li>
				<a href="profile.php" style="font-weight:bold; color:white;"><?php echo $_SESSION['fname']; ?> &nbsp; &nbsp; <?php echo $_SESSION['batch']; ?></a>
			</li>
			<li><a href="home.php" style="font-weight:bold; color:white;"><span class="glyphicon glyphicon-home"></span> Home</a></li>
			<li><a style="font-weight:bold; color:white;" href="logout.php?logout"><span class="glyphicon glyphicon-off"></span> Log Out</a></li>
		</ul>
	</div>

	
</div>
	
	
</nav>