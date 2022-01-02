function initMap() {
  var myLatLng = { lat: 45.75372 , lng: 21.22571 };
  var map = new google.maps.Map(document.getElementById("map"), {
    zoom: 4,
    center: myLatLng
  });

  var marker = new google.maps.Marker({
    position: myLatLng,
    map: map,
    label:"Timisoaraaaa"
  });
}
