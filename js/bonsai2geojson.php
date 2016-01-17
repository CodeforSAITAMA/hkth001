<?php
$array = json_decode(file_get_contents("bonsai.json"),true);
$geojoson = array();
foreach ($array as $k => $v){
    $contents = $v["contents"];
    $contents["page"] = $v["page"];
    unset($contents["tags"]);
    unset($contents["slug"]);
    unset($contents["page"]);
    unset($contents["content"]);
    unset($contents["region"]);
    $geometry = array(
        "type" => "Point",
        "coordinates" => $v["location"]
    );

    $json = array(
        "type" => "Feature",
        "properties" => $contents,
        "geometry" => $geometry);
    $geojson[] = $json;
}
header("Content-Type: application/json; charset=utf-8");
print json_encode(array("type" => "FeatureCollection", "features" =>$geojson));
exit;
?>
