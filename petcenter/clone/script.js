mapboxgl.accessToken = 'pk.eyJ1IjoianVkYW1hZTAyIiwiYSI6ImNsMHJ1enJraTA3NTEzaXBreHNsN3ZjczYifQ.XnmiN0j7-0mJYbH7cDS_Zg';
navigator.geolocation.getCurrentPosition(successLocation, errorLocation, {enableHighAccuracy: true})

function successLocation(position){
   console.log(position)
   setUpMap([position.coords.longitude, position.coords.latitude])
}

function errorLocation(){
   setUpMap([-123.8854, 10.3157])
}

function setUpMap(center){
   const map = new mapboxgl.Map({
       container:'map',
       style: 'mapbox://styles/mapbox/streets-v11',
       center: center,
       zoom: 14
   })

   const nav = new mapboxgl.NavigationControl();
   map.addControl(nav)

   var directions = new MapboxDirections({
       accessToken:  mapboxgl.accessToken
     });
     
     map.addControl(directions, 'top-left');
}