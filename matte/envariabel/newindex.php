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
            max-width: 100%;
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

        span.flow-text{
            vertical-align: 100%;
        }
    </style>
</head>

<body style="width:95%;" class="container center-align teal lighten-4 white-text">
    <?php
        $j = json_decode(file_get_contents("things.json"),true);
        $title = $j["title"];
        unset($j["title"]);
        ?>
        <h3 class='card-panel indigo darken-2 z-depth-1'><?= $title ?></h3>
        <div class='yellow lighten-2 card-panel'>
        <div class='row'>
        <a class="col s12 l4 offset-l4 waves-effect waves-dark btn purple lighten-1 z-depth-2" href="analysformel.pdf" target="_blank">Formelblad</a>
        </div>
        <div class='row'>
        <?php
        $d = scandir(getcwd() . "/tentor");
        rsort($d);
        foreach($d as $file){
            if(strpos($file,".pdf") > -1){
                $name = "Tenta 20" . substr($file,2,2);
                ?>
                <div class='col s12 m4 l4'>
                <a class='col s12 waves-effect waves-dark btn purple darken-2' target='_blank' href="<?= "tentor/$file" ?>"><?= $name ?></a>
                </div>
                <?php
            }
        }
        ?>
        </div>
        </div>
        <?php
        foreach($j as $topic => $props){
            echo "<div class='row card-panel teal'>";
            if(strlen($topic) > 15){
                echo "<h4>$topic</h4>";
            }
            else{
                echo "<h2>$topic</h2>";
            }
            foreach($props as $propTitle => $propValue){
                $c = "teal";
                if(mb_strtoupper($propTitle, 'utf-8') == $propTitle)
                    $c = "red";
                    
                echo "<div style='padding-bottom:2px;' class='card teal darken-1 z-depth-2'>";
                echo "<h4 class='card-panel $c darken-3 z-depth-3'>$propTitle</h4>";
                foreach($propValue as $value){
                    if(is_array($value)){
                        echo "<div style='padding-bottom:2px;' class='card purple darken-3 z-depth-4'><h4 class='card-panel purple darken-4 z-depth-4'>Exempel</h4>";
                        foreach($value as $example){
                            //If this example is an image
                            if(strpos($example, '.PNG') !== false){
                                echo "<img src='img/$example'>";
                            }
                            else{
                                $example = preg_replace('/`(.*)`/im','<p class="orange">$1</p>',$example);
                                echo "<p class='flow-text'>$example</p>";
                            }
                        }
                        echo "</div>";
                    }
                    else{
                        if(strpos($value, '.PNG') !== false){
                            echo "<img src='img/$value'>";
                        }
                        else{
                        $value = preg_replace('/`(.*?)`/im','<span style="font-weight:600;">$1</span>',$value);
                        // echo $value;
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