<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='utf-8' />
  <title>Statistici</title>
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <script src='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js'></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/require.js/2.3.4/require.js"></script>
  <link href='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css' rel='stylesheet' />
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
  </style>
</head>
<body>

  <div id='map'></div>
  <script>
   mapboxgl.accessToken = 'pk.eyJ1IjoiYWxleGFuZHJhMTIyMjIiLCJhIjoiY2t3cm5reDVnMHk4ajJ0cW84OTAydWxicyJ9.pi0OAfwT2lkpUQdEkxDaow';
   const map = new mapboxgl.Map({
  container: 'map', // Container ID
  style: 'mapbox://styles/alexandra12222/ckwrnwy0n0ju815t7f6b23642', // Map style to use
  center: [25.0094303, 45.9442858], // Starting position [lng, lat] lat: 45.9442858, lng: 25.0094303
  zoom: 5, // Starting zoom level
});
</script>

</body>
</html>
