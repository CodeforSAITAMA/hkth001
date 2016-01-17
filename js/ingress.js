function getIngressUrl(){
    if (!map) return "";
    var latlng = map.getCenter();
    var lat = latlng.lat();
    var lng = latlng.lng();
    var ingressTpl="https://www.ingress.com/intel?ll=%lat%,%lng%&z=17";
    return ingressTpl.replace("%lat%",lat).replace("%lng%",lng);
}

function openIngress(){
    var url = getIngressUrl();
    if (url){
        $.colorbox({href: url, iframe: true, width:"90%",height:"90%"});
    }
}
