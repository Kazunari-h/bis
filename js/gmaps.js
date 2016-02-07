/*
 * sample-7.js
 * Directions Serviceを利用する | Lopan.jp
 */

var directionsDisplay;
var directionsService;
var map;
var timer;

var center = new google.maps.LatLng(35.681382, 139.766084);
var start = '東京駅';
var end = '八王子';

function initialize(x,y) {
  var mapOptions = {
    zoom: 14,
    center: new google.maps.LatLng(x, y),
    disableDefaultUI: true,
    mapTypeControlOptions: { mapTypeIds: ['flat', google.maps.MapTypeId.ROADMAP] },
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);

  directionsDisplay = new google.maps.DirectionsRenderer();
  directionsDisplay.setMap(map);
  directionsDisplay.setPanel(document.getElementById('directionsPanel'));

  /* スタイル付き地図 */
  var styleOptions = [
    { 'featureType': 'road', 'stylers': [{ 'visibility': 'on' }, { 'color': '#ffffff' }] },
    { 'featureType': 'road.arterial', 'stylers': [{ 'visibility': 'on' }, { 'color': '#fee379' }] },
    { 'featureType': 'road.highway', 'stylers': [{ 'visibility': 'on' }, { 'color': '#fee379' }] },
    { 'featureType': 'landscape', 'stylers': [{ 'visibility': 'on' }, { 'color': '#f3f4f4' }] },
    { 'featureType': 'water', 'stylers': [{ 'visibility': 'on' }, { 'color': '#7fc8ed' }] },
    { 'featureType': 'poi.business', 'elementType': 'geometry', 'stylers': [{ 'visibility': 'on' }] },
    { 'featureType': 'transit.line', 'elementType': 'geometry.fill', 'stylers': [{ 'visibility': 'on' }, { 'hue': '#e3b552' }] },
    { 'featureType': 'transit.line', 'elementType': 'geometry.stroke', 'stylers': [{ 'visibility': 'on' }, { 'weight': 1.2 }, { 'color': '#9660ac' }, { 'lightness': 25 }] },
    { 'featureType': 'landscape.man_made', 'elementType': 'geometry', 'stylers': [{ 'weight': 0.9 }, { 'visibility': 'off' }] }
  ];
  var styledMapOptions = { name: 'フラットデザイン' }
  var flatType = new google.maps.StyledMapType(styleOptions, styledMapOptions);
  map.mapTypes.set('flat', flatType);
  map.setMapTypeId('flat');

  timer = setInterval("exec()",10000);
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

func createMarker() {

  if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(successCallback,errorCallback);
  }

  function successCallback(pos) {
      var marker1 = new google.maps.Marker({
          position: new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);,
          map:map
      });
  }

  function errorCallback(error) {
      //失敗のときの処理
      // alert('Geolocationが利用できません');
  }
}

google.maps.event.addDomListener(window, 'load', function() {
  initialize(35.681382, 139.766084);
  calcRoute();

  // if (navigator.geolocation) {
  //     navigator.geolocation.getCurrentPosition(successCallback,errorCallback);
  // } else {
  //     alert("Geolocationが利用できません");
  // }
  // function successCallback(pos) {
  //     var Potition_latitude = pos.coords.latitude;
  //     var Potition_longitude = pos.coords.longitude;
  //     // initialize(Potition_latitude,Potition_longitude);
  //     initialize(35.681382, 139.766084);
  //     calcRoute();
  // }
  // function errorCallback(error) {
  //     //失敗のときの処理
  //     alert('Geolocationが利用できません');
  // }
});
