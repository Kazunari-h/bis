
var apiKey = 'AIzaSyDVXUkJfb-QQJHLKH2PixU0tFwshlr4qnU';

var placeIdArray = [];
var polylines = [];
var snappedCoordinates = [];

var map;
var timer;
var btnFlg = false;

var center = new google.maps.LatLng(35.681382, 139.766084);
var pathList = new Array();

var lat1,lon1;

function initialize(x,y) {
  pathList.push(x + "," + y)
  var mapOptions = {
    zoom: 14,
    center: new google.maps.LatLng(x, y),
    disableDefaultUI: true,
    mapTypeControlOptions: { mapTypeIds: ['flat', google.maps.MapTypeId.ROADMAP] },
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);

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

}

function createMarker() {
  if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(successCallback,errorCallback);
  }

  function successCallback(pos) {
    lat1 = pos.coords.latitude
    lat2 = pos.coords.longitude
    var marker1 = new google.maps.Marker({
        position: new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude),
        map:map
    });
  }

  function errorCallback(error) {
      //失敗のときの処理
      alert('現在、Geolocationが利用できません');
  }
}

//スタートクリック時
function clickButton() { //スタートボタン
  btnFlg = !btnFlg
  if(btnFlg){
    timer = setInterval("createMarker()",1000);
  } else {
    clearInterval(timer);
    //ロードマップの描画
    runSnapToRoad(pathList)
  }
}

function getDistance(lat1, lng1, lat2, lng2) {
  function radians(deg){
    return deg * Math.PI / 180;
  }
  return 6378.14 * Math.acos(Math.cos(radians(lat1))*
    Math.cos(radians(lat2))*
    Math.cos(radians(lng2)-radians(lng1))+
    Math.sin(radians(lat1))*
    Math.sin(radians(lat2)));
}

google.maps.event.addDomListener(window, 'load', function() {
  if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(successCallback,errorCallback);
  } else {
      alert("Geolocationが利用できません");
  }

  function successCallback(pos) {
      lat1 = pos.coords.latitude;
      lon1 = pos.coords.longitude;
      initialize(lat1,lon1);
  }

  function errorCallback(error) {
      //失敗のときの処理
      alert('Geolocationが利用できません');
  }
});

function runSnapToRoad(path) {
  $.get('https://roads.googleapis.com/v1/snapToRoads', {
    interpolate: true,
    key: apiKey,
    path: path.join('|')
  }, function(data) {
    processSnapToRoadResponse(data);
  });
}

function processSnapToRoadResponse(data) {
  snappedCoordinates = [];
  placeIdArray = [];
  for (var i = 0; i < data.snappedPoints.length; i++) {
    var latlng = new google.maps.LatLng(
      data.snappedPoints[i].location.latitude,
      data.snappedPoints[i].location.longitude
    );
    snappedCoordinates.push(latlng);
    placeIdArray.push(data.snappedPoints[i].placeId);
  }
  createLine();
}

function createLine() {
  //// ラインを引く座標の配列を作成
  //var points = snappedCoordinates
  console.log(snappedCoordinates.length);

  // ラインを作成
  var polyLineOptions = {
      path: snappedCoordinates,
      strokeWeight: 80,
      strokeColor: "#ffffff",
      strokeOpacity: "0.5"
  };

  // ラインを設定
  var poly = new google.maps.Polyline(polyLineOptions);
  poly.setMap(map);
}
