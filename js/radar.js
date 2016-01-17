var showRadar = function(){
var img = {
    url: "/images/radar.png",
    origin: new google.maps.Point(0,0),
    anchor: new google.maps.Point(150, 150),
    scaleSize: new google.maps.Point(300, 300)
}
var radar = new google.maps.Marker({
    icon: img,
    map: map,
    opacity: 0.3
});
radar.bindTo("position", map, "center");
}

