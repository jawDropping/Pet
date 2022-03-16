function initMap(){
    var options = {
        center: {lat:10.3157, lng:-123.8854},
        zoom: 8,    
    }

    map = new google.maps.Map(document.getElementById('map'), options);
}