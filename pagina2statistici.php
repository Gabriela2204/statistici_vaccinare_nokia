<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='utf-8' />
  <title>Statistici</title>
  <meta name='viewport' content='width=device-width, initial-scale=1' />
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js'></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js'></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/require.js/2.3.4/require.js"></script>
  <link href='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css' rel='stylesheet' />
<link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css' type='text/css' />
<script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>

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
    <a href="grafice2.php"> <button id='butonStatistici'> Grafice Statistici</button> </a>
  </div>

  <?php
  include 'config.php';
  $sth = mysqli_query($conn, "SELECT * FROM judet_vaccinati");
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
for(var i=0;i<Vaccine.length;i++){

  var john = escape(JSON.stringify(parseFloat(Vaccine[i].Vaccinati)));
  var john2 = escape(JSON.stringify(parseFloat(Vaccine[i].Nevaccinati)));


   console.log(john);
   localStorage.setItem("Vaccinati", john );
   localStorage.setItem("Nevaccinati", john2 );

  var marker = new mapboxgl.Marker()
   .setLngLat([Vaccine[i].Lat, Vaccine[i].Lon])
   .setPopup(
     new mapboxgl.Popup({ offset: 10 })
      .setHTML(
         `<p>Persoane Vaccinate: ${john}</p><p>Persoane Nevaccinate: ${john2}</p>`

        )
      )
   .addTo(map);

}
//<p>Persoane Vaccinate: ${john}</p><p>Persoane Nevaccinate: ${john2}</p>

  const geocoder = new MapboxGeocoder({
  // Initialize the geocoder
  accessToken: mapboxgl.accessToken, // Set the access token
  placeholder: 'Search for places in Romania',
  mapboxgl: mapboxgl, // Set the mapbox-gl instance
  marker: false, // Do not use the default marker style

  proximity: {
    longitude: 25.0094303,
    latitude: 45.9442858
  }
});

// Add the geocoder to the map
map.addControl(geocoder);
 

</script>

</div>
</body>
</html>
