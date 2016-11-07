<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link href="style.css" rel="stylesheet">
		<title>Random Resto</title>
		<meta name="viewport" content="width=device-width, initial-scale=0.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
		<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
    </head>
	
    <body>
		<section>
			<div class="restoCard">
				<div id="restoName"></div>
				<div id="restoRating">★★★★☆</div> <!-- Static (Placeholder) -->
				<div id="restoTags"></div>
				<div id="restoAddress"></div>
			</div>
			
			<div id="map"></div>
		
		</section>
		
		<script>			
			<?php
			$restoList = file_get_contents('resto.json');

			function RandomRestoByInterval($TimeBase, $RestoArray) {

					// Make sure it is a integer
					$TimeBase = intval($TimeBase);

					// How many items are in the array?
					$ItemCount = count($RestoArray);

					// By using the modulus operator we get a pseudo
					// random index position that is between zero and the
					// maximal value (ItemCount)
					$RandomIndexPos = ($TimeBase % $ItemCount);

					// Now return the random array element
					return $RandomIndexPos;

				}

			// Set timezone (UTC)
			date_default_timezone_set('UTC');

			// Use the day of the year to get a daily changing resto
			$DayOfTheYear = date('z'); 

			// Decode Json to Array
			$RandomResto = json_decode($restoList, true);

			$randomRestoArray = RandomRestoByInterval($DayOfTheYear, $RandomResto);
			?>

			var randomRestoName='<?php print ($RandomResto[$randomRestoArray]["name"]);?>';
			var randomRestoAddress='<?php print ($RandomResto[$randomRestoArray]["address"]);?>';
			
			var randomRestoGpsLat='<?php print ($RandomResto[$randomRestoArray]["gpsLat"]);?>';
			var randomRestoGpsLong='<?php print ($RandomResto[$randomRestoArray]["gpsLong"]);?>';

			// For test purposes only
			document.getElementById("restoName").innerHTML = randomRestoName;
			document.getElementById("restoAddress").innerHTML = randomRestoAddress;
			
			
			// Google Map		
			
			var restoLat = parseFloat(randomRestoGpsLat);
			var restoLong = parseFloat(randomRestoGpsLong);	
			
			// Update this variable to change location.
			var myLatLng = {lat: restoLat, lng: restoLong};
		
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
					title: randomRestoName
				});
			}
		</script>
		
		<!-- Google map script -->
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCornig7FoRPEj6_6Ste333dbiyT0p6eT8&callback=initMap"></script>
	</body>
	
</html>