<?php

$n = $_GET["name1"];
$m = $_GET["name2"];
//$wordlist = $_GET["wordlist"];

$words = explode("\n",file_get_contents("../svenska.txt"));

$firstPart = array();
$secondPart = array();

foreach ($words as $word) {
    $r1 = '/'. strtolower(str_replace("\r","", $word)) . '/';
    $nRes = preg_match($r1,$n);
    $mRes = preg_match($r1,$m);

    if($nRes){
        preg_match($r1,$n,$matches);
        if(strlen($matches[0])>1)
            array_push($firstPart,$matches[0]);
    }
    if($mRes){
        preg_match($r1,$m,$matches);
        if(strlen($matches[0])>1)
            array_push($secondPart,$matches[0]);
    }
}
//print_r($firstPart);
//print_r($secondPart);
//dump($firstPart); echo "<br>";
//dump($secondPart);

echo json_encode(mixArrays($firstPart,$secondPart));

function mixArrays($a,$b){
    $retVal = array();
    foreach($a as $celement){
        foreach($b as $felement){
            $s1 = "$celement$felement";
            $s2 = "$felement$celement";
            array_push($retVal,ucfirst($s1));
            
            if($s1 !== $s2){
                array_push($retVal,ucfirst($s2));
            }
        }
    }
    //Removes duplicates
    for($i = 0; $i < count($retVal); $i++){
        for($j = 0; $j < count($retVal); $j++){
            if($retVal[$i] === $retVal[$j])
                array_splice($retVal,$j,1);
        }
    }
    return $retVal;
}

function dump($arr){
    echo "<table>";
    foreach($arr as $key => $element){
        echo "<tr>";
        if(is_array($element)){
            foreach($element as $k => $e){
                echo "<td style='background:#ff0'>$k</td><td>$e</td>";
            }
        }
        else
            echo "<td>$key</td><td>$element</td>";
        echo "</tr>";
    }
    echo "</table>";
}

function p($var,$varname){
    echo "<strong>$varname</strong>: <strong>$var</strong><br>";
}
?>