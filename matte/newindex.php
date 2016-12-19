<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../material/css/materialize.min.css">
    <style>
        img{
            margin: auto;
            margin-top: 30px;
            border-radius: 10px;
            border: 3px solid rgba(0,0,0,.2);
        }
        table{
            width: auto;
            display: table;
            margin: auto;
            font-size: 1.4em;
            border: 1px solid #fff;
            border-radius:2px;
            padding:2px;
        }
    </style>
</head>
    <body class="container center-align teal lighten-4">
        <?php
        $j = json_decode(file_get_contents("things.json"),true);
        foreach($j as $topic => $props){
            echo "<div class='row card-panel teal white-text'>";
            echo "<h2>$topic</h2>";
            foreach($props as $propTitle => $propValue){
                $c = "teal";
                if(mb_strtoupper($propTitle, 'utf-8') == $propTitle)
                    $c = "red";
                    
                echo "<div class='card-panel teal darken-1 z-depth-2'>";
                echo "<h3 class='card-panel $c darken-3 z-depth-3'>$propTitle</h3>";
                foreach($propValue as $value){
                    if(is_array($value)){
                        echo "<div class='card-panel purple darken-3 z-depth-4'><h4 class='card-panel purple darken-4 z-depth-4'>Exempel</h4>";
                        foreach($value as $example){
                            //If this example is an image
                            if(strpos($example, '.PNG') !== false){
                                echo "<img class='materialboxed' src='img/$example'>";
                            }
                            else{
                                $example = preg_replace('/`(.*)`/im','<blockquote class="mono">$1</blockquote>',$example);
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
    <script src="../material/js/materialize.min.js"></script>
</html>
