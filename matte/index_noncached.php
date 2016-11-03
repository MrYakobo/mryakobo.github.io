<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">
<head>
    <meta property="og:image" content="http://jakoblindskog.tk/matte/ogimage.PNG" />
    <meta property="og:description" content="Jag har listat alla svåra begrepp här...typ">
    
    <link rel="stylesheet" href="style.css">
    <link async href="https://fonts.googleapis.com/css?family=Roboto+Mono:500|PT+Sans:400,700|Roboto+Condensed" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#2793d6">
    <link rel="icon" href="icon.png">
    <title>Viktiga saker tills tentan</title>
</head>

<body>
    <div class="wrapper">
    <header>
        <h1>Viktiga saker att komma ihåg till tentan</h1>
        <p>(Algebra och diskret matematik)</p>
    </header>
        <?php
        $j = json_decode(file_get_contents("things.json"),true);
        foreach($j as $topic => $props){
            echo "<div class='topic'>";
            echo "<h2>$topic</h2>";
            foreach($props as $propTitle => $propValue){
                echo "<div class='prop'>";
                echo "<h3>$propTitle</h3>";
                foreach($propValue as $value){
                    if(is_array($value)){
                        echo "<div class='examples'><h4>Exempel</h4>";
                        foreach($value as $example){
                            //If this example is an image
                            if(strpos($example, '.PNG') !== false){
                                echo "<img src='img/$example'>";
                            }
                            else{
                                $example = preg_replace('/`(.*)`/im','<span class="mono">$1</span>',$example);
                                echo "<p>$example</p>";
                            }
                        }
                        echo "</div>";
                    }
                    else{
                        if(strpos($value, '.PNG') !== false){
                            echo "<img src='img/$value'>";
                        }
                        else{
                        $value = preg_replace('/`(.*?)`/im','<span class="mono">$1</span>',$value);
                        echo "<p class='explain'>$value</p>";
                        }
                    }
                }
                echo "</div>";
            }
            echo "</div>";
        }
        ?>
    </div>
</body>

</html>