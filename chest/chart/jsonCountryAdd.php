<?php
$s = file_get_contents("visits.json");
$json = json_decode($s,true);
$newJson = json_decode($s,true);
ini_set('max_execution_time', 0); //infinite
ob_start();
$i = 0;
foreach($json as $key => $value){
    if($i % 100 === 0){
        echo($i);
        //send to browser
        ob_flush();
    }


    if(!isset($value["city"])){
    $ipInfo = json_decode(file_get_contents("http://ipinfo.io/$key/json"),true);
    /*
    ipinfo.io returns:
{
    "ip": "100.6.74.147",
    "hostname": "pool-100-6-74-147.pitbpa.fios.verizon.net",
    "city": "Pittsburgh",
    "region": "Pennsylvania",
    "country": "US",
    "loc": "40.3314,-80.0822",
    "org": "AS701 MCI Communications Services, Inc. d/b/a Verizon Business",
    "postal": "15241"
}
    */
    //I'm interested in getting the country and city, to later inject it into the $json.
    $newJson[$key]["country"] = $ipInfo["country"];
    $loc = $ipInfo["loc"];
    $city = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=$loc&radius=200&key=AIzaSyA5RbW9ArssQ-gYTuXgqyGiXVZ9_Yjb-BU"),true);
    $city = $city["results"][0]["name"];
    $newJson[$key]["city"] = $city;
        }
}

file_put_contents("visitsWithCountry.json",json_encode($newJson));
echo "Wrote to visitsWithCountry.json";
ob_flush();
ob_end_flush(); 
?>