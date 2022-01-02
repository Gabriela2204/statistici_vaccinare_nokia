<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='utf-8' />
  <title>Vreau sa ma vaccinez</title>
  <meta name='viewport' content='width=device-width, initial-scale=1' />
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js'></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js'></script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/require.js/2.3.4/require.js"></script>
  <link href='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css' rel='stylesheet' />
<link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css' type='text/css' />
  <style>
    body {
      margin: 0;
      padding: 0;
    }

    #map {
      position: absolute;
      top: 0;
      bottom: 0;
      width: 100%;
    }
    .mapboxgl-popup {
  max-width: 200px;
}

.mapboxgl-popup-content {
  text-align: center;
  font-family: 'Open Sans', sans-serif;
}

#butonStatistici {
  position: absolute;
  top: 65px;
  left: 20px;
  width: 180px;
  padding: 10px;
  z-index: 100;
  border: 2px solid black;
  background-color: #90EE90;
}
#buton_back {
  position: absolute;
  top: 20px;
  left: 20px;
  width: 180px;
  padding: 10px;
  z-index: 100;
  border: 2px solid black;
  background-color: #90EE90;
}

  </style>
</head>
<body>

  <div id='map'>
      <a href="statistici.php"> <button id='buton_back'>Mergi la pagina principala</button> </a>
    <a href="grafice3.php"> <button id='butonStatistici'> Grafice Doze Valabile</button> </a>
  </div>
  <?php
  include 'config.php';
  $sth = mysqli_query($conn, "SELECT * FROM judet_vaccin");
  $rows=array();
  while($r = mysqli_fetch_assoc($sth)){
    $rows[]=$r;
  }

  //print json_encode($rows);
  ?>
  <script>
   mapboxgl.accessToken = 'pk.eyJ1IjoiYWxleGFuZHJhMTIyMjIiLCJhIjoiY2t3cm5reDVnMHk4ajJ0cW84OTAydWxicyJ9.pi0OAfwT2lkpUQdEkxDaow';
   const map = new mapboxgl.Map({
  container: 'map', // Container ID
  style: 'mapbox://styles/alexandra12222/ckwrnwy0n0ju815t7f6b23642', // Map style to use
  center: [25.0094303, 45.9442858], // Starting position [lng, lat] lat: 45.9442858, lng: 25.0094303
  zoom: 6, // Starting zoom level
});
var jsonStr= '<?php echo json_encode($rows) ?>';
var Vaccine = JSON.parse(jsonStr);
for(var i=0;i<Vaccine.length;i++){//Vaccine.length
  //var latitudine = escape(JSON.stringify(Vaccine[i].Lat));
//  var longitudine = escape(JSON.stringify(Vaccine[i].Lon));

  var john = escape(JSON.stringify(parseFloat(Vaccine[i].Nr_Pfizer)));
  var john2 = escape(JSON.stringify(parseFloat(Vaccine[i].Nr_Moderna)));
  var john3 = escape(JSON.stringify(parseFloat(Vaccine[i].Nr_AstraZeneca)));
  var john4 = escape(JSON.stringify(parseFloat(Vaccine[i].Nr_JohnsonJohnson)));


  var marker = new mapboxgl.Marker()
   .setLngLat([Vaccine[i].Lat, Vaccine[i].Lon])
   .setPopup(
     new mapboxgl.Popup({ offset: 10 })
      .setHTML(
          `<h3>Vaccin disponibil</h3><p>Numar doze Pfizer: ${john}</p><p>Numar doze Moderna: ${john2}</p><p>Numar doze Astra Zeneca: ${john3}</p><p>Numar doze JohnsonJohnson: ${john4}</p>`
        )
      )
   .addTo(map);
}

  const geocoder = new MapboxGeocoder({
  // Initialize the geocoder
  accessToken: mapboxgl.accessToken, // Set the access token
  placeholder: 'Search for places in Romania',
  mapboxgl: mapboxgl, // Set the mapbox-gl instance
  marker: false, // Do not use the default marker style
//  bbox: [19.5057541, 47.1611615, 25.4833039, 42.7249925], //42.7249925 25.4833039  Boundary for Romania
  proximity: {
    longitude: 25.0094303,
    latitude: 45.9442858
  }
});

// Add the geocoder to the map
map.addControl(geocoder);
 // Coordinates of UC Berkeley

</script>

</body>
</html>
    <!--<input
      id="pac-input"
      class="controls"
      type="text"
      placeholder="Search Box"
      <div id="map"></div>
    />-->


    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <!--<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCaLipGKvUk0vzcl8Hd3jUVoVqCUQDndBE&callback=initAutocomplete&libraries=places&v=weekly"
      async
    ></script>-->
