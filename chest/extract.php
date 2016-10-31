<?php
$f = file_get_contents("newchestorder.txt");
$arr = explode("\n",$f);
echo "[";
foreach($arr as $a){
    echo "\"$a\",";
}
echo "]";
?>