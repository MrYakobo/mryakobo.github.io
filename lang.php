<?php
//<logic> for determiting the language-changer in the top-right corner
if(isset($_GET["lang"])){
    $lang = $_GET["lang"];
    //Removes get-parameters if present
    $link = strtok($_SERVER["REQUEST_URI"],"?");
    $linkStr = "Svenska";
}
else{
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    $link = $_SERVER["REQUEST_URI"] . "?lang=en";
    $linkStr = "English";
}
//</logic>

//Link-suffix-generation
function langUrl(){
    if(isset($_GET["lang"]))
        return "?lang=" . $_GET["lang"];
    return "";
}
//returns the correct language-string
function s($swe,$eng){
    if($GLOBALS["lang"] == "sv")
        return $swe;
    return $eng;
}

$str = "sv";
if($lang != "sv")
    $str = "en";

echo "<meta lang='$str'>";
?>