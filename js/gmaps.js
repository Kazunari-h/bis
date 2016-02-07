/*
 * sample-7.js
 * Directions Serviceを利用する | Lopan.jp
 */

var directionsDisplay;
var directionsService;
var map;

var center = new google.maps.LatLng(35.681382, 139.766084);
var start = '東京駅';
var end = '八王子';

function initialize(x,y) {
  var mapOptions = {
    zoom: 14,
    center: new google.maps.LatLng(x, y),
    disableDefaultUI: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);

  directionsDisplay = new google.maps.DirectionsRenderer();
  directionsDisplay.setMap(map);
  directionsDisplay.setPanel(document.getElementById('directionsPanel'));
}

function calcRoute() {
  var request = {
    origin: start,
    destination: end,
    travelMode: google.maps.TravelMode.DRIVING,
    avoidHighways: true,
  };
  directionsService = new google.maps.DirectionsService();
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
    } else {
      alert('ルートが見つかりませんでした…');
    }
  });
}

google.maps.event.addDomListener(window, 'load', function() {
  if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(successCallback,errorCallback);
  } else {
      alert("Geolocationが利用できません");
  }
  function successCallback(pos) {
      var Potition_latitude = pos.coords.latitude;
      var Potition_longitude = pos.coords.longitude;
      initialize(Potition_latitude,Potition_longitude);
      calcRoute();
  }
  function errorCallback(error) {
      //失敗のときの処理
      alert('Geolocationが利用できません');
  }
});
