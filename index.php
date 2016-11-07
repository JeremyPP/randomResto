<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link href="style.css" type="text/css" rel="stylesheet">
		<title>Random Resto</title>
		<meta name="viewport" content="width=device-width, initial-scale=0.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
		<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
		<style type="text/css">
			html, body {
				height: 100%;
				margin: 0;
				padding: 0;
			}
			#map {
				height: 100%;
				width: 50%;
				right: 0;
				position: absolute !important;
				top: 0;
			}
		</style>
    </head>
	
    <body>
	
		<div id="resto"></div>
		
		<div id="map"></div>
		
		<script>
		
		
			// Google Map		
		
			// Update this variable to change location.
			var myLatLng = {lat: 48.868487, lng: 2.345923};
		
			function initMap() {

				// Create a map object and specify the DOM element for display.
				var map = new google.maps.Map(document.getElementById('map'), {
					center: myLatLng,
					scrollwheel: false,
					zoom: 17
				});

				// Create a marker and set its position.
				var marker = new google.maps.Marker({
					map: map,
					position: myLatLng,
					title: 'Hello World!'
				});
			}
			
			
			// 	
			
			<?php
			function RandomRestoByInterval($TimeBase, $RestoArray){
			 
				// Make sure it is a integer
				$TimeBase = intval($TimeBase);
			 
				// How many items are in the array?
				$ItemCount = count($RestoArray);
			 
				// By using the modulus operator we get a pseudo
				// random index position that is between zero and the
				// maximal value (ItemCount)
				$RandomIndexPos = ($TimeBase % $ItemCount);
			 
				// Now return the random array element
				return $RestoArray[$RandomIndexPos];
			}

			// Set timezone (UTC)
			date_default_timezone_set('UTC');

			// Use the day of the year to get a daily changing resto
			$DayOfTheYear = date('z'); 
			 
			// Array
			$RandomResto = array(
				"L&#39;Atelier - Artisan Crepier - GRANDS BOULEVARDS",
				"Little Italy Caffe",
				"Dionysos",
				"Bien Bien",
				"Le plomb du cantal",
				"Hero",
				"Mazzucco"
			);
			?>

			var randomRestoArray='<?php print RandomRestoByInterval($DayOfTheYear, $RandomResto);?>';

			// For test purposes only
			document.getElementById("resto").innerHTML = randomRestoArray;
			console.log(<?php echo $DayOfTheYear; ?>)

		</script>
		
		<!-- Google map script -->
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCornig7FoRPEj6_6Ste333dbiyT0p6eT8&callback=initMap"></script>
	</body>
	
</html>