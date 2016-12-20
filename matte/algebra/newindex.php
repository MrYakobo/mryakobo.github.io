<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">

<head>
    <meta property="og:image" content="http://jakoblindskog.tk/matte/ogimage.PNG" />
    <meta property="og:description" content="Jag har listat alla svåra begrepp här...typ">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#2793d6">
    <link rel="icon" href="icon.png">
    <title>Viktiga saker tills tentan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
    <style>
        img {
            margin: auto;
            margin-top: 30px;
            border-radius: 10px;
            border: 3px solid rgba(0, 0, 0, .2);
        }
        
        table {
            width: auto;
            display: table;
            margin: auto;
            font-size: 1.4em;
            border: 1px solid #fff;
            border-radius: 2px;
            padding: 2px;
        }
    </style>
</head>

<body class="container center-align teal lighten-4 white-text">
    <?php
        $j = json_decode(file_get_contents("things.json"),true);
        $title = $j["title"];
        unset($j["title"]);
        echo "<h1 class='card-panel indigo z-depth-1'>$title</h1>";
        foreach($j as $topic => $props){
            echo "<div class='row card-panel teal'>";
            echo "<h2>$topic</h2>";
            foreach($props as $propTitle => $propValue){
                $c = "teal";
                if(mb_strtoupper($propTitle, 'utf-8') == $propTitle)
                    $c = "red";
                    
                echo "<div style='padding-bottom:2px;' class='card teal darken-1 z-depth-2'>";
                echo "<h3 class='card-panel $c darken-3 z-depth-3'>$propTitle</h3>";
                foreach($propValue as $value){
                    if(is_array($value)){
                        echo "<div style='padding-bottom:2px;' class='card purple darken-3 z-depth-4'><h4 class='card-panel purple darken-4 z-depth-4'>Exempel</h4>";
                        foreach($value as $example){
                            //If this example is an image
                            if(strpos($example, '.PNG') !== false){
                                echo "<img class='materialboxed' src='img/$example'>";
                            }
                            else{
                                $example = preg_replace('/`(.*)`/im','<p class="mono">$1</p>',$example);
                                echo "<p class='flow-text'>$example</p>";
                            }
                        }
                        echo "</div>";
                    }
                    else{
                        if(strpos($value, '.PNG') !== false){
                            echo "<img class='materialboxed' src='img/$value'>";
                        }
                        else{
                        $value = preg_replace('/`(.*?)`/im','<span class="mono">$1</span>',$value);
                        echo "<p class='flow-text'>$value</p>";
                        }
                    }
                }
                echo "</div>";
            }
            echo "</div>";
        }
        ?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>

</html>