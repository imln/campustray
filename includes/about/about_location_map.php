<?php 
if(isset($_SESSION['uid']) == "" && isset($_SESSION['fname']) == "" && isset($_SESSION['batch']) == "")
{
	header("Location: index.php");
}
?>

<div>
<div class="row">
<div class="panel panel-default">
  <div class="panel-heading" ><h3 style="color:#4682b4; margin:0px;">Location Map</h3></div>
  <div class="panel-body">
		<div>
		
							
<?php 
	
	
	$sql = "SELECT * FROM maploc WHERE maploc_uid=$user_id";
	$retval = mysql_query($sql);
	if(! $retval )
	{
		die('Could not get data: ' . mysql_error());
	}
	$row = mysql_fetch_array($retval, MYSQL_ASSOC);
	if($row['maploc_id'] == ""){
?>
<div class="row"><h4>No Location Found</h4></div>
<?php 
	}else{
		$lat = $row['maploc_lat'];
		$lng = $row['maploc_lng'];
		$geocode=file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$lng&sensor=false");
		$output= json_decode($geocode);
  
 ?>
		<div style="color:navy; font-size:18px;">
		<?php
    $geocode=file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$lng&sensor=false");

        $output= json_decode($geocode);

    for( $j=2 ; $j < count($output->results[0]->address_components)-1 ; $j++ ){
                echo $output->results[0]->address_components[$j]->long_name. ', ';
            }
?>
		</div>
 



<script src="http://maps.googleapis.com/maps/api/js"></script>
<script>
var myCenter=new google.maps.LatLng(<?php echo $row['maploc_lat'];?>,<?php echo $row['maploc_lng'];?>);

function initialize()
{
var mapProp = {
  center:myCenter,
  zoom:8,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };

var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

var marker=new google.maps.Marker({
  position:myCenter,
  });

marker.setMap(map);
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>


<div  id="googleMap" style="width:100%; height:300px;"></div>
<?php } ?>

						</div>
  </div>
</div>
</div>
</div>
