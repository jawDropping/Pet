<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" href="style.css" /> 

<form action="" method="post">
	<div class="row">		
		<div class="col-sm-4">	
			<div class="form-group">
				<input type='text' name='searchAddress' class="form-control" placeholder='Enter address here' />
			</div>
		</div>
		<div class="form-group">
			<input type='submit' value='Find' class="btn btn-success" />
		</div>
	</div>
</form>	


<?php
function getGeocodeData($address) { 
    $address = urlencode($address);     
    $googleMapUrl = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=AIzaSyCLYHCyN0VxERxata_hRKZ_AsgzFmAFEUk&callback=initMap";
    $geocodeResponseData = file_get_contents($googleMapUrl);
    $responseData = json_decode($geocodeResponseData, true);
    if($responseData['status']=='OK') {
        $latitude = isset($responseData['results'][0]['geometry']['location']['lat']) ? $responseData['results'][0]['geometry']['location']['lat'] : "";
        $longitude = isset($responseData['results'][0]['geometry']['location']['lng']) ? $responseData['results'][0]['geometry']['location']['lng'] : "";
        $formattedAddress = isset($responseData['results'][0]['formatted_address']) ? $responseData['results'][0]['formatted_address'] : "";         
        if($latitude && $longitude && $formattedAddress) {         
            $geocodeData = array();                         
            array_push(
                $geocodeData, 
                $latitude, 
                $longitude, 
                $formattedAddress
            );             
            return $geocodeData;             
        } else {
            return false;
        }         
    } else {
        echo "ERROR: {$responseData['status']}";
        return false;
    }
}
?>

<?php
if($_POST) { 
	// get geocode address details
	$geocodeData = getGeocodeData($_POST['searchAddress']); 
	if($geocodeData) {         
		$latitude = $geocodeData[0];
		$longitude = $geocodeData[1];
		$address = $geocodeData[2];                     
	?> 
	<div id="gmap">Loading map...</div>
	<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyCLYHCyN0VxERxata_hRKZ_AsgzFmAFEUk&callback=initMap"></script>   
	<script type="text/javascript">
		function init_map() {
			var options = {
				zoom: 14,
				center: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>),
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			map = new google.maps.Map($("#gmap")[0], options);
			marker = new google.maps.Marker({
				map: map,
				position: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>)
			});
			infowindow = new google.maps.InfoWindow({
				content: "<?php echo $address; ?>"
			});
			google.maps.event.addListener(marker, "click", function () {
				infowindow.open(map, marker);
			});
			infowindow.open(map, marker);
		}
		google.maps.event.addDomListener(window, 'load', init_map);
	</script> 
	<?php 
	} else {
		echo "Incorrect details to show map!";
	}
}
?>