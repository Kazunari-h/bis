
var apiKey = 'AIzaSyDVXUkJfb-QQJHLKH2PixU0tFwshlr4qnU';

var placeIdArray = [];
var polylines = [];
var snappedCoordinates = [];

var directionsDisplay;
var directionsService;
var map;
var timer;

var center = new google.maps.LatLng(35.681382, 139.766084);
var start = '東京駅';
var end = '八王子';

var pathList = new Array("35.681382, 139.766084","35.681345, 139.768888");

var lat1,lon1;

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

  // timer = setInterval("createMarker()",10000);

  runSnapToRoad(pathList)

}

function calcRoute() {
  var request = {
    origin: start,
    destination: end,
    travelMode: google.maps.TravelMode.DRIVING,
    avoidHighways: true
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

function createMarker() {

  if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(successCallback,errorCallback);
  }

  function successCallback(pos) {
    //if getDistance(lat1,lon1,pos.coords.latitude,pos.coords.longitude) > 200 {
      lat1 = pos.coords.latitude
      lat2 = pos.coords.longitude
      var marker1 = new google.maps.Marker({
          position: new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude),
          map:map
      });
    //}
  }

  function errorCallback(error) {
      //失敗のときの処理
      // alert('Geolocationが利用できません');
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
  initialize(35.681382, 139.766084);
  //calcRoute();

  // if (navigator.geolocation) {
  //     navigator.geolocation.getCurrentPosition(successCallback,errorCallback);
  // } else {
  //     alert("Geolocationが利用できません");
  // }
  // function successCallback(pos) {
  //     lat1 = pos.coords.latitude;
  //     lon1 = pos.coords.longitude;
  //     // initialize(lat1,lon1);
  //     initialize(35.681382, 139.766084);
  //     calcRoute();
  // }
  // function errorCallback(error) {
  //     //失敗のときの処理
  //     alert('Geolocationが利用できません');
  // }
});


// function initialize() {
//   var mapOptions = {
//     zoom: 17,
//     center: {lat: -33.8667, lng: 151.1955}
//   };
//   map = new google.maps.Map(document.getElementById('map'), mapOptions);
//
//   // Adds a Places search box. Searching for a place will center the map on that
//   // location.
//   map.controls[google.maps.ControlPosition.RIGHT_TOP].push(
//       document.getElementById('bar'));
//   var autocomplete = new google.maps.places.Autocomplete(
//       document.getElementById('autoc'));
//   autocomplete.bindTo('bounds', map);
//   autocomplete.addListener('place_changed', function() {
//     var place = autocomplete.getPlace();
//     if (place.geometry.viewport) {
//       map.fitBounds(place.geometry.viewport);
//     } else {
//       map.setCenter(place.geometry.location);
//       map.setZoom(17);
//     }
//   });
//
//   // // Enables the polyline drawing control. Click on the map to start drawing a
//   // // polyline. Each click will add a new vertice. Double-click to stop drawing.
//   // drawingManager = new google.maps.drawing.DrawingManager({
//   //   drawingMode: google.maps.drawing.OverlayType.POLYLINE,
//   //   drawingControl: true,
//   //   drawingControlOptions: {
//   //     position: google.maps.ControlPosition.TOP_CENTER,
//   //     drawingModes: [
//   //       google.maps.drawing.OverlayType.POLYLINE
//   //     ]
//   //   },
//   //   polylineOptions: {
//   //     strokeColor: '#696969',
//   //     strokeWeight: 2
//   //   }
//   // });
//   // drawingManager.setMap(map);
//
//   // Snap-to-road when the polyline is completed.
//   // drawingManager.addListener('polylinecomplete', function(poly) {
//   //   var path = poly.getPath();
//   //   polylines.push(poly);
//   //   placeIdArray = [];
//   //   runSnapToRoad(path);
//   // });
//
//   // Clear button. Click to remove all polylines.
//   // $('#clear').click(function(ev) {
//   //   for (var i = 0; i < polylines.length; ++i) {
//   //     polylines[i].setMap(null);
//   //   }
//   //   polylines = [];
//   //   ev.preventDefault();
//   //   return false;
//   // });
// }

// Snap a user-created polyline to roads and draw the snapped path
function runSnapToRoad(path) {
  $.get('https://roads.googleapis.com/v1/snapToRoads', {
    interpolate: true,
    key: apiKey,
    path: path.join('|')
  }, function(data) {
    processSnapToRoadResponse(data);
    //getAndDrawSpeedLimits();
  });
}

// Store snapped polyline returned by the snap-to-road method.
function processSnapToRoadResponse(data) {
  snappedCoordinates = [];
  placeIdArray = [];
  for (var i = 0; i < data.snappedPoints.length; i++) {
    var latlng = new google.maps.LatLng(
    data.snappedPoints[i].location.latitude,
    data.snappedPoints[i].location.longitude);
    snappedCoordinates.push(latlng);
    placeIdArray.push(data.snappedPoints[i].placeId);
    alert(i);
  }
}

// Gets speed limits (for 100 segments at a time) and draws a polyline
// color-coded by speed limit. Must be called after processing snap-to-road
// response.
//function getAndDrawSpeedLimits() {
//  for (var i = 0; i <= placeIdArray.length / 100; i++) {
//    // Ensure that no query exceeds the max 100 placeID limit.
//    var start = i * 100;
//    var end = Math.min((i + 1) * 100 - 1, placeIdArray.length);
//
//    drawSpeedLimits(start, end);
//  }
//}

// Gets speed limits for a 100-segment path and draws a polyline color-coded by
// speed limit. Must be called after processing snap-to-road response.
//function drawSpeedLimits(start, end) {
//    var placeIdQuery = '';
//    for (var i = start; i < end; i++) {
//      placeIdQuery += '&placeId=' + placeIdArray[i];
//    }
//
//    $.get('https://roads.googleapis.com/v1/speedLimits',
//        'key=' + apiKey + placeIdQuery,
//        function(speedData) {
//          processSpeedLimitResponse(speedData, start);
//        }
//    );
//}

// Draw a polyline segment (up to 100 road segments) color-coded by speed limit.
function processSpeedLimitResponse(speedData, start) {
  var end = start + speedData.speedLimits.length;
  for (var i = 0; i < speedData.speedLimits.length - 1; i++) {
    var speedLimit = speedData.speedLimits[i].speedLimit;
    var color = getColorForSpeed(speedLimit);

    // Take two points for a single-segment polyline.
    var coords = snappedCoordinates.slice(start + i, start + i + 2);

    var snappedPolyline = new google.maps.Polyline({
      path: coords,
      strokeColor: color,
      strokeWeight: 6
    });
    snappedPolyline.setMap(map);
    polylines.push(snappedPolyline);
  }
}

function getColorForSpeed(speed_kph) {
  if (speed_kph <= 40) {
    return 'purple';
  }
  if (speed_kph <= 50) {
    return 'blue';
  }
  if (speed_kph <= 60) {
    return 'green';
  }
  if (speed_kph <= 80) {
    return 'yellow';
  }
  if (speed_kph <= 100) {
    return 'orange';
  }
  return 'red';
}
