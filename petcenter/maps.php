<!DOCTYPE hml>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width=device-width,
        initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <style>
            #map{
                height:400px;
                width:100%;
            }
        </style>
    </head>
    <body>
        <h1>My Google Map</h1>
        <div id="map"></div>
        <script>   
            function initMap(){
                var options = {
                    zoom:8;
                    center:{lat:10.3157, lng:-123.8854}
                    mapId: 'e4aee676cea6b399';
                    
                }
                var map = new
                google.maps.Map(document.getElementById('map'), options);
                
            }
        </script>
        <script>
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBm_baEYZMkOdvH95bsgIltBZYqJuDoIBc&v=beta&callback=initMap">
        </script>
    </body>
</html> 