<?php
header("Content-Type: text/plain");
set_time_limit(0);

$url = "https://kmgy.localwiki.org/api/v4/maps/?format=json&points__within=%7B%22type%22%3A%22Polygon%22%2C%22coordinates%22%3A%5B%5B%5B139.44677%2C36.083669%5D%2C%5B139.300618%2C36.111246%5D%2C%5B139.314815%2C36.146557%5D%2C%5B139.289754%2C36.160663%5D%2C%5B139.333038%2C36.179971%5D%2C%5B139.347251%2C36.253626%5D%2C%5B139.444139%2C36.196797%5D%2C%5B139.41663%2C36.188097%5D%2C%5B139.44677%2C36.083669%5D%5D%5D%7D";

$main_ary = array();

//タグとiconの読み替え
$icons = array(
    "portal" => "/images/portal.png",
    "coolshare" => "/images/cool.png",
    "直実武蔵武士史跡" => "/images/naozane.gif"
);

$iconkeys = array_keys($icons);

getUrlToArray($url);

//必要なものに限定
$result_ary = array();
foreach ($main_ary as $data){
    $location =$data["points"]["coordinates"][0];
    $data["location"] = $location;
    $page = $data["page"];
    $data["contents"] = getContents($page);
    $tags = $data["contents"]["tags"];
    $data["contents"]["icon"] = tags2icon($tags);
    unset($data["url"]);
    unset($data["region"]);
    unset($data["geom"]);
    unset($data["lines"]);
    unset($data["polys"]);
    unset($data["length"]);
    unset($data["points"]);
    $result_ary[] = $data;
}

$fp = fopen("/var/www/vhosts/kumagaya.code4saitama.org/httpdocs/js/kumagaya.json","w");
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
    //printf("NXT: %s\n", $next);
    if ($next){
        getUrlToArray($next);
    }
}

function getContents($url){
    $url .= "?format=json";
    $ary = json_decode(file_get_contents($url), true);
    $ary["url"] = "https://ja.localwiki.org/kmgy/". urlencode($ary["slug"]);
    return $ary;
}

function tags2icon($tags = array()){
    global $icons, $iconkeys;
    $icon = "";
    if (count($tags)){
        foreach ($tags as $k => $v){
            if (isset($icons[$v])){
                $icon = $icons[$v];
                break;
            }
        }
    }
    return $icon;
}
?>
