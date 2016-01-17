var map;
function mapCanvas() {
    console.log("Map: lat, lng", lat, lng);
    if (!(lat && lng)) {
        setTimeout(mapCanvas, 1000);
    }
	var latlng = new google.maps.LatLng(lat,lng);
	var myOptions = {
			zoom: 14,
			center: latlng,
			mapTypeControl: false,
			navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
			mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById("map"), myOptions);
    makeMarker();
	var pageHeight = $(document).height();
	$("#map").css("height",pageHeight-100);
}

var markers = [];
function makeMarker(){
    $.getJSON("/js/omiya.json", function(data){
    //    console.log(data);
        for(var i=0; i<data.length;i++){
            var latlng = new google.maps.LatLng(data[i].lat,data[i].lng);
            var content = data[i].name;
            var icon = "/images/" + data[i].art + ".png";
            console.log(i, data[i], latlng, icon);
           // console.log(latlng, content);
            createMarker(latlng, "", icon);
        }
    });
}

function createMarker(latlng, content, icon){
    var marker = new google.maps.Marker({
        position: latlng,
        _contents: content,
        icon: icon,
        map: map,
    });
    google.maps.event.addListener(marker, 'click', function() {
        console.log(marker, content);
        map.setCenter(marker.getPosition()); 
        $.get("/temp.php",function(content){
            $.colorbox({html: content, width:"90%", height:"90%"});
        });
    });
    markers.push(marker);
}

$('#mapLoad').bind('pageshow',mapCanvas);
