<?php
session_start();
include_once 'includes\dbconnect.php';
if(isset($_SESSION['uid']) == "" && isset($_SESSION['fname']) == "" && isset($_SESSION['batch']) == "")
{
	header("Location: index.php");
}

$sql = "SELECT * FROM maploc";
	$retval = mysql_query($sql);
	if(! $retval )
	{
		die('Could not get data: ' . mysql_error());
	}
	

?>
<!doctype html>
<html>
	<head>
	<link rel="shortcut icon" type="image/x-icon" href="images\campustray_logo_small.png" />
		<title>campustray.com | Map</title>
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
		
		<script src="http://maps.googleapis.com/maps/api/js">
      </script>
	<script>
		jQuery(function($) {
    // Asynchronously Load the map API 
    var script = document.createElement('script');
    script.src = "http://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize";
    document.body.appendChild(script);
});

function initialize() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };
                    
    // Display a map on the page
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
    map.setTilt(45);
        
    // Multiple Markers
    var markers = [
		<?php 
			while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){
			$uid = $row['maploc_uid'];
			$usersql = "SELECT * FROM usersregister WHERE uid = $uid";
			$result = mysql_query($usersql);
			if(! $result )
			{
				die('Could not get data: ' . mysql_error());
			}
			$userrow = mysql_fetch_array($result, MYSQL_ASSOC);
				echo "['".$userrow['fname']." ".$userrow['lname']." ".$userrow['course']." ".$userrow['branch']. "-".$userrow['yog']. "',". $row['maploc_lat'] . "," . $row['maploc_lng'] . "],";
			}
		?>
       ['NIVAS Inc., London', 51.503454,-0.119562]
        
    ];
                        
    // Info Window Content
	
/*
    var infoWindowContent = [
        ['<div class="info_content">' +
        '<h3>London Eye</h3>' +
        '<p>The London Eye is a giant Ferris wheel situated on the banks of the River Thames. The entire structure is 135 metres (443 ft) tall and the wheel has a diameter of 120 metres (394 ft).</p>' +        '</div>'],
        ['<div class="info_content">' +
        '<h3>Palace of Westminster</h3>' +
        '<p>The Palace of Westminster is the meeting place of the House of Commons and the House of Lords, the two houses of the Parliament of the United Kingdom. Commonly known as the Houses of Parliament after its tenants.</p>' +
        '</div>']
    ];
*/        
    // Display multiple markers on a map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Loop through our array of markers & place each one on the map  
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: markers[i][0]
        });
        
        // Allow each marker to have an info window    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(markers[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Automatically center the map fitting all markers on the screen
        map.fitBounds(bounds);
    }

    // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(2);
        google.maps.event.removeListener(boundsListener);
    });
    
}
	</script>

		
	</head>
	<body>
	
	
	
				<!--including home header1-->
			<header>
				<?php include 'includes\header2.php';?>
			</header>
			<div id="map_wrapper" class="container" style="margin-top:100px; height: 550px;">
				<div id="map_canvas" style=" width: 100%;height: 100%;" class="mapping"></div>
			</div>

	

	</body>
</html>