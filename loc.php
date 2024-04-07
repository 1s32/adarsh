<!DOCTYPE html>
<html>
<head>
    <title>My Store Location</title>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
    <h1>My Store Location</h1>
    <div id="map"></div>

    <script>
        function initMap() {
            // Coordinates of your store location
            var myLatLng = {lat: 40.7128, lng: -74.0060};

            // Create a map object and specify the DOM element for display.
            var map = new google.maps.Map(document.getElementById('map'), {
                center: myLatLng,
                zoom: 15
            });

            // Create a marker and set its position.
            var marker = new google.maps.Marker({
                map: map,
                position: myLatLng,
                title: 'My Store'
            });
        }
    </script>
    <!-- Load the Google Maps JavaScript API with API key -->
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap">
    </script>
</body>
</html>
