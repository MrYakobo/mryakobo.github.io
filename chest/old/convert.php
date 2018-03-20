<?php
include_once("BrowserDetection.php");

function browserString($browser){
	//Chrome
	$browserName = $browser->getName();
	//Android
	$platformFamily  = $browser->getPlatform();
	//5.1.1
	$platformVer = $browser->getPlatformVersion(true);
	//Lollipop
	$platformName = $browser->getPlatformVersion();
	return "$platformFamily $platformVer ($platformName) @ $browserName";
}

$file = file_get_contents("visits.json");
$arr = explode("-----\n", $file);

$json = [];
$format = 'd-m-Y H:i';
foreach ($arr as $visit) {
	$props = explode(";IP", $visit);
	$rawBrowser = $props[0];
	$ip = explode("'", $props[1])[1];
	$dRaw = str_replace("\n-----","",explode(";Date: ", $props[1])[1]);
	$date = date($format,strtotime($dRaw));
	$browser = new BrowserDetection($rawBrowser);

	if(isset($json[$ip])){
		$json[$ip]["visits"][] = $date;
	}
	else{
	$obj = [];
	$obj["visits"] = [$date];

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
	file_put_contents("converted.json", json_encode($json));
}
?>