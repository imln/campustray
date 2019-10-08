<?php


if(isset($_SESSION['uid'])=="" && isset($_SESSION['fname'])=="" && isset($_SESSION['batch'])=="")
{
	header("Location: index.php");
}

?>
<div>
		
		<div >
			<div class="panel panel-primary" >
					<div class="panel-heading" style="background:#4682b4;">
						<form role="form" method="POST" id = "form_input">
						<center>
							<div class="row">
								<div class="col-md-9">
									<input type = "text" class="form-control" style="" name = "message" placeholder="Enter Message..." id = "message">
								</div>
								<div class="col-md-3">
									<input type = "submit" class="btn btn-info" style="" name = "submit" id = "submit" value = "Send">
								</div>
							</div>
						</center>
							
							
						</form>	
						<div id = "feedback"></div>
					</div>
					<div class="panel-body" style="height:800px; padding:0px; overflow-y:scroll;">
						<div id="messages"  >
			
						</div><!--Messages-->
					</div>
			</div>
			
		</div>
		
		
		
		<!--Javascript-->
		<script type = "text/javascript" src = "scripts/js/jquery-1.11.3.min.js"></script>
		<script type = "text/javascript" src = "scripts/js/auto_chat.js"></script>
		<script type = "text/javascript" src = "scripts/js/send.js"></script>
</div>