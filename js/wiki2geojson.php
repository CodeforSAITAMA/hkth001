<?php
/************************************************************************************
*
*
*
*
*************************************************************************************/
header("Content-Type: text/plain");
set_time_limit(0);

class wiki2geojson{

    private $main_array = array();
    private $base;
    private $lang = "ja";
    
    private $base_url;
    private $api_url;
    private $output;

    function __construct($base = "", $lang = "ja") { 
        $this->base = $base;
        $this->lang = $lang;
        $this->output = $this->base . ".json";
        $this->api_url = sprintf("https://%s.localwiki.org/api/v4/maps/?format=json", $this->base);
        $this->base_url = sprintf("https://%s.localwiki.org/%s/", $this->lang, $this->base);
        $res = $this->recursiveUrl($this->api_url);
        
        //$this->hasNext($this->requestUrl($this->api_url));
        //$this->writeJSON();
    }

    //データを取得して配列を返す
    function requestUrl($url){
        $ary =  json_decode(file_get_contents($url), true);
        return $ary; 
    }

    function hasNext($ary){
        //print_r($ary);
        return isset($ary["next"]) ? $ary["next"] : "";
    }

    function recursiveUrl($url){
        $ary = $this->requestUrl($url);
        if ($next = $this->hasNext($ary)){
            echo $next;
        }else{
            echo "end";
            return "";
        }
    }


    /*
    function hasNext($array = array()){
        $this->main_array = array_merge($this->main_array, $array["results"]);
        if ($array["next"]){
            //次がある
            $url = $array["next"];
            $ary = $this->requestUrl($url);
            $this->hasNext($ary);
        }
    }
    */

    function createArray(){
        //必要なものに限定
        $result_ary = array();
        foreach ($this->main_array as $key => $data){
            $feature = array();
            $geometry = $data["geom"]["geometries"];
            $properties = $this->requestUrl($data["page"]."?type=json");
            $properties["url"] =  $this->base_url . urlencode($ary["slug"]);
            $feature = array(
                "type" => "Feature",
                "id" => $key,
                "properties" => $properties,
                "geometry" => $geometry);
            $result_ary[] = $feature;      
        }
    }

    function writeJSON(){
        $result = $this->createArray();
        $fp = fopen($this->output, "w");
        fwrite($fp, json_encode($result));
        fclose($fp);
    }
}
$w2g = new wiki2geojson("kmgy");
?>
