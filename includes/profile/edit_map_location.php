<div class="row">
<div class="panel panel-default">
	<div class="panel-heading" ><h3 style="color:#4682b4; margin:0px;">Edit Map Location</h3></div>
	<div class="panel-body">

<form role="form" id="mapform" >
						<center>
							<div class="row">
								<div class="col-md-9">
									<input  id="mapinput" type="text" class="form-control"  value="" placeholder="Search City" >
								</div>
								<div class="col-md-3">
									<input type="submit"  class="btn btn-info form-control"  value="Find">
								</div>
							</div>
						</center>

	
	
</form> 
<div id="mapdiv" style="height:300px;  margin-top:10px;"></div>

<div id="mapoutput" style="background-color:#4682b4 ; color:white; font-weight: bold;">Latitude:<br>Longitude:</div>
<form action="map_processing.php" method="post">
  <input type="hidden" name="latitude" id="hiddenVal1" />
  <input type="hidden" name="longitude" id="hiddenVal2" />
  
 <center> <input type="submit" class="btn btn-success" style="width:150px; margin-top:15px;" name="submit" id="submit" value="Save Changes" /></center>
</form>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript">
google.maps.event.addDomListener(window, "load", function() {
//
// initialize map
//
var map = new google.maps.Map(document.getElementById("mapdiv"), {
  center: new google.maps.LatLng( 28.755705, 77.066332),
  zoom: 4,
  mapTypeId: google.maps.MapTypeId.ROADMAP
});
//
// initialize marker
//
var marker = new google.maps.Marker({
  position: map.getCenter(),
  draggable: true,
  map: map
});
//
// intercept map and marker movements
//
google.maps.event.addListener(map, "idle", function() {
  marker.setPosition(map.getCenter());
  document.getElementById("mapoutput").innerHTML = "Latitude: " + map.getCenter().lat().toFixed(6) + "<br>Longitude: " + map.getCenter().lng().toFixed(6);
	document.getElementById("hiddenVal1").value = map.getCenter().lat().toFixed(6);
	document.getElementById("hiddenVal2").value = map.getCenter().lng().toFixed(6);
  });




google.maps.event.addListener(marker, "dragend", function(mapEvent) {
  map.panTo(mapEvent.latLng);
});

//
// initialize geocoder
//
var geocoder = new google.maps.Geocoder();
google.maps.event.addDomListener(document.getElementById("mapform"), "submit",      function(domEvent) {
  if (domEvent.preventDefault){
    domEvent.preventDefault();
  } else {
    domEvent.returnValue = false;
  }
  geocoder.geocode({
    address: document.getElementById("mapinput").value
  }, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      var result = results[0];
      document.getElementById("mapinput").value = result.formatted_address;
	  
      if (result.geometry.viewport) {
        map.fitBounds(result.geometry.viewport);
      }
      else {
        map.setCenter(result.geometry.location);
      }
    } else if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
      alert("Sorry, the geocoder failed to locate the specified address.");
    } else {
      alert("Sorry, the geocoder failed with an internal error.");
    }
  });
  });
  });
  

  
  
</script>
</div>
</div>
</div>
