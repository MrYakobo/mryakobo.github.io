<?php
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

date_default_timezone_set("Europe/Stockholm");
$d = date('d-m-Y H:i');

$json = json_decode(file_get_contents("visits.json"),true);
if(!is_array($json)){
	$json = [];
}

/*
{
	"98.2.3.4.5":
	{
		"visits":[
		"22-08-2016 23:38",
		"01-01-2018 00:38",
		],
		"browser":{
			"name":"Chrome",
			"platformFamily":"Android",
			"platformVersion":"5.1.1",
			"platformName":"Lollipop"
		}
	}
}
*/

include_once("BrowserDetection.php");
$browser = new BrowserDetection();

if(isset($json[$ip])){
	$json[$ip]["visits"][] = $d;
}
else{
	$obj = [];
	$obj["visits"] = [$d];

	//Chrome
	$browserName = $browser->getName();
	//Android
	$platformFamily  = $browser->getPlatform();
	//5.1.1
	$platformVer = $browser->getPlatformVersion(true);
	//Lollipop
	$platformName = $browser->getPlatformVersion();

	$obj["browser"]["name"] = $browserName;
	$obj["browser"]["platformFamily"] = $platformFamily;
	$obj["browser"]["platformVersion"] = $platformVer;
	$obj["browser"]["platformName"] = $platformName;

	$json[$ip] = $obj;
}

file_put_contents("visits.json",json_encode($json));
?>