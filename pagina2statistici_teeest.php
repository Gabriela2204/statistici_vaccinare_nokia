<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='utf-8' />
  <title>Statistici</title>
  <meta name='viewport' content='width=device-width, initial-scale=1' />
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js'></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js'></script>
    <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
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

.sparkline {
    height: 100px;
    width: 200px;
}
  </style>
</head>
<body>

  <div id='map'></div>
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

  //var myLayer = map.featureLayer().addTo(map);
  map.addSource('single-point', {
   type: 'geojson', // specify the kind of data being added
   data: {
     type: 'FeatureCollection',
     features: []
   }
 });
 map.addLayer({
  id: 'point', // the layer's ID
  source: 'single-point',
  type: 'circle', // the layer type
  paint: {
    'circle-radius': 10,
    'circle-color': '#007cbf'
  }
});
   var portGeoJSON = {
              "type": "FeatureCollection",
                  "features": [{
                  "type": "Feature",
                      "geometry": {
                      "type": "Point",
                          "coordinates": [Vaccine[i].Lat, Vaccine[i].Lon]
                  },
                      "properties": {
                      "title": " YORK",
                          "est_value": 13639833,
                          "marker-color": "#0000ff",
                          "marker-size": "medium",
                          "marker-symbol": "harbor"
                  }
              }]
          };

  var lineChartOptions = {
              title: {
                  text: null
              },
              legend: {
                  enabled: false
              },
              credits: {
                  enabled: false
              },
              exporting: {
                  enabled: false
              },
              tooltip: {
                  backgroundColor: {
                      linearGradient: [0, 0, 0, 60],
                      stops: [
                          [0, '#FFFFFF'],
                          [1, '#E0E0E0']
                      ]
                  },
                  borderWidth: 1,
                  useHTML: true,
                  borderColor: '#AAA'
              },
              yAxis: {
                  min: 0,
                  lineWidth: 1,
                  tickWidth: 1,
                  title: {
                      text: null
                  },
                  labels: {
                      style: {
                          'fontSize': '10px'
                      }
                  }
              },
              xAxis: {
                  type: 'datetime',
                  labels: {
                      style: {
                          'fontSize': '10px'
                      }
                  }
              },
              plotOptions: {
                  series: {
                      cursor: 'pointer',
                      connectNulls: false
                  }
              }
          };

  myLayer.on('layeradd', function(e) {
      var marker = e.layer,
          feature = marker.feature;


      lineChartOptions.tooltip.formatter = function() {
                  var y = "$" + this.y;
                  return '<center>' + Highcharts.dateFormat('%b \'%y', new Date(this.x)) + '</center></b><center><b>' + y + '</b></center>';
              };
      lineChartOptions.series = [{
                  pointInterval: 24 * 3600 * 1000 * 30.41667,
                  pointStart: 1393632000000,
                  data: [
                  58044, 60871, 29738, null, 804997, 628727, 20678, null,
                  100606, 122195, 981459, 39840]
              }];


       // HTML content for port pop-up
             var popupContent = '<div id="popup_template">' +
          '<div class="port_header marker-title">' +e.layer.feature.properties.title.toUpperCase() +'</div>' +
          '<div class="est_value marker-title">'+
                 'Est. Value: $' + e.layer.feature.properties.est_value
                 +'</div>' +
          '<div id="est_value_sparkline" class="sparkline"></div>';


      var container = $('<div id="popup_template"/>');


      container.html( '<div class="port_header marker-title">' +e.layer.feature.properties.title.toUpperCase() +'</div>' +
          '<div class="est_value marker-title">'+
                 'Est. Value: $' + e.layer.feature.properties.est_value
                 +'</div>' +
          '<div id="est_value_sparkline" class="sparkline"></div>');

  // Delegate all event handling for the container itself and its contents to the container
  container.find('#est_value_sparkline').highcharts(lineChartOptions);
      marker.bindPopup(container[0]);
  });
  myLayer.setGeoJSON(portGeoJSON);

}
//<p>Persoane Vaccinate: ${john}</p><p>Persoane Nevaccinate: ${john2}</p>

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
<div id = "myModal" class="modal">
   <div class="modalContent">
      <span class = "close"> &times; </span>
      <canvas id="myChart"></canvas>
</div>
</div>
</body>
</html>
