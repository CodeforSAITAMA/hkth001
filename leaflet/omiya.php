<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>leaflet</title>

<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta http-equiv="cleartype" content="on">

<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.css" />
<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
<script src="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>

<link rel="stylesheet" href="leaflet.css" />
<!--[if lte IE 8]>
    <link rel="stylesheet" href="leaflet.ie.css" />
<![endif]-->

<script src="leaflet.js"></script>
  
<script>
var samplePoints = [
	[40.719595,-96.629784],
	[40.782735,-96.616524],
	[40.834705,-96.629059],
	[40.796735,-96.623574],
	[40.796735,-96.623574],
	[40.834360,-96.642919],
	[40.797980,-96.771649],
	[40.797980,-96.771649],
	[40.798440,-96.653624],
	[40.843750,-96.731199],
	[40.850260,-96.719444]
];

var map, minimal, midnightCommander, motorways
var waypoints = [];
var direction_pos = 0;


$("#test").live('pageinit', function() {

	resizeMap();

	var resizeTimer;
	$(window).resize(function() {
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout(resizeMap, 100);
	});
	
	setTimeout(function() {
		
		map = new L.Map('map_canvas', {center: new L.LatLng(35.906295,139.623999), zoom: 14});
        
		map.addControl(layersControl);
	}, 400);
	

});

function resizeMap() {

	var mapheight = $(window).height();
	var mapwidth = $(window).width();
	$("#map_canvas").height(mapheight);
	$("#map_canvas").width(mapwidth);
	
}

</script>
  
</head>
<body>

<div data-role="page" id="test">

	<div data-role="header">
		<h1>Map</h1>
	</div>
	
	<div data-role="content" style="padding:0px; height:100%">	

	  <div id="map_canvas" style="float:left;width:70%;height:100%"></div>
  
	</div>
	
</div>

</body>
</html>
