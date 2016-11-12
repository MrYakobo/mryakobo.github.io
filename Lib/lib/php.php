/*Dumps an array to a table*/
function dump($arr){
    echo &quot;&lt;table&gt;&quot;;
    foreach($arr as $key =&gt; $element){
        echo &quot;&lt;tr&gt;&quot;;
        if(is_array($element)){
            foreach($element as $k =&gt; $e){
                echo &quot;&lt;td style='background:#ff0'&gt;$k&lt;/td&gt;&lt;td&gt;$e&lt;/td&gt;&quot;;
            }
        }
        else
            echo &quot;&lt;td&gt;$key&lt;/td&gt;&lt;td&gt;$element&lt;/td&gt;&quot;;
        echo &quot;&lt;/tr&gt;&quot;;
    }
    echo &quot;&lt;/table&gt;&quot;;
}
-----
/*Outputs a variable in h1-tags*/
function h1($str){
    echo &quot;&lt;h1&gt;$str&lt;/h1&gt;&quot;;
}
-----
/*Searches Google images for a string and returns the first image*/
function google($s) {
    $s = str_replace(" ","+",str_replace("%20","+",$s));
    $url = file_get_contents("https://www.google.com/search?q=$s");
    $retValue = explode('"',explode('src="',$url)[2])[0];
    return $retValue;
}