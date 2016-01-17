<!DOCTYPE html> 
<html lang="ja"> 
<head>
<title>中浦和会場</title>
<meta charset="UTF-8" />
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
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
<link rel="stylesheet" href="/js/colorbox/colorbox.css" />
<script src="/js/colorbox/jquery.colorbox.js"></script>
<script>
var lat=35.853808,  lng=139.637444;
</script> 
</head>
<body>
<div id="mapLoad" data-role="page">
    <div id="map" data-role="content"></div>
    <script src="js/map.js"></script>
    <div data-role="footer" data-position="fixed" data-id="persist">
    </div>
</div>
</body>
</html>
