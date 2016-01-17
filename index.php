<!DOCTYPE html> 
<html lang="ja"> 
<head>
<title>岩槻会場</title>
<meta charset="UTF-8" />
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.js"></script>
<style>
body,html {
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
}
#map {
    width: 100%;
    height: calc(100% - 100px);
}
</style>
<link rel="stylesheet" href="js/colorbox/colorbox.css" />
<script src="js/colorbox/jquery.colorbox.js"></script>
<script src="leaflet/leaflet.js"></script>
<script>
var lat=35.949975,lng=139.693;

//leaflet OSM map
function init() {

    // create a map in the "map_elemnt" div,
    // set the view to a given place and zoom
    var map = L.map('map_elemnt');
    map.setView([lat, lng], 11);

    // add an OpenStreetMap tile layer
    var tileLayer = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution : '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    });
    tileLayer.addTo(map);


    //old saitama
    var oldSaitama01 = L.tileLayer('http://ktgis.net/kjmapw/kjtilemap/kanto/01/{z}/{x}/{y}.png', {
        attribution : '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    });
    oldSaitama01.addTo(map);

    var oldSaitama03 = L.tileLayer('http://ktgis.net/kjmapw/kjtilemap/kanto/03/{z}/{x}/{y}.png', {
        attribution : '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    });
    oldSaitama03.addTo(map);

    var oldSaitama03 = L.tileLayer('http://ktgis.net/kjmapw/kjtilemap/kanto/03/{z}/{x}/{y}.png', {
        attribution : '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    });
    oldSaitama03.addTo(map);


    // add a marker in the given location,
    // attach some popup content to it and open the popup
    var mapMarker = L.marker([lat, lng]);
    mapMarker.addTo(map);
    mapMarker.bindPopup('CSS3 popup. <br> ここはどこでしょうか？');
    mapMarker.openPopup();
     
    // add layers
    var baseLayers = {
        "OpenStreetMap": tileLayer
    };
    var overlays = {
        "Marker": mapMarker,
    };
    L.control.layers(baseLayers, overlays).addTo(map);

    // add control scale 
    L.control.scale().addTo(map);
</script> 
</head>
<body onload="init">
<div id="mapLoad" data-role="page">
    <div id="map" data-role="content"></div>
    <div data-role="footer" data-position="fixed" data-id="persist">
    </div>
</div>
</body>
</html>
