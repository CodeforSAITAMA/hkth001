<?php
header("Content-Type: text/plain");
set_time_limit(0);

$url = "https://bonsai.localwiki.org/api/v4/maps/?format=json&points__within=". urlencode("{\"type\":\"Polygon\",\"coordinates\":[[[139.6291708946228,35.923028528854026],[139.6291708946228,35.9290058359523],[139.6349000930786,35.9290058359523],[139.6349000930786,35.923028528854026],[139.6291708946228,35.923028528854026]]]}");

$main_ary = array();

getUrlToArray($url);

//必要なものに限定
$result_ary = array();
foreach ($main_ary as $data){
    $location =$data["points"]["coordinates"][0];
    $data["location"] = $location;
    $page = $data["page"];
    $data["contents"] = getContents($page);
    $tags = $data["contents"]["tags"];
    unset($data["url"]);
    unset($data["region"]);
    unset($data["geom"]);
    unset($data["lines"]);
    unset($data["polys"]);
    unset($data["length"]);
    unset($data["points"]);
    $result_ary[] = $data;
}

$fp = fopen("/var/www/vhosts/kumagaya.code4saitama.org/httpdocs/js/bonsai.json","w");
fwrite($fp, json_encode($result_ary));
fclose($fp);
echo "end";
exit;

function getUrlToArray($url){
    global $main_ary;
    $ary = json_decode(file_get_contents($url), true);
    //printf("ARY: %s\n", print_r($ary));
    $main_ary = array_merge($main_ary, $ary["results"]);
    $next = $ary["next"];
    printf("NXT: %s\n", $next);
    if ($next){
        getUrlToArray($next);
    }
}

function getContents($url){
    $url .= "?format=json";
    $ary = json_decode(file_get_contents($url), true);
    $ary["url"] = "https://ja.localwiki.org/bonsai/". urlencode($ary["slug"]);
    return $ary;
}
?>
