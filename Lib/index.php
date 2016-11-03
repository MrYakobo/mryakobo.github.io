<html>

    <head>
        <meta charset="utf-8">
        <link rel="icon" href="icon.png">
        <title>Useful code</title>
        <link href="https://fonts.googleapis.com/css?family=Galada|Lato:900,400|Roboto:700|Ubuntu+Mono" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="scrollbar.css">
        <script src="jquery.min.js"></script>
        <script src="clipboard.js"></script>

        <script src="highlight.pack.js"></script>
        <link id="style" rel="stylesheet" href="styles/hopscotch.css">
    </head>

    <body>
        <h1>Useful code</h1>
        <!--        <p class="intro">Welcome to the Library, the place where functions gets recycled.</p>-->
        <h2>served to you by <a class="jakoblindskog" href="http://jakoblindskog.tk">JakobLindskog<span style="font-size:.8em;color:red">.tk</span></a></h2>
        <div class="menu lang minimized">
            <i class="material-icons">arrow_drop_down_circle</i>
            <span class="header" onclick="minimize(this)" style="background:#36d674">menu</span>
            <div class="choose">
                <h2>Choose highlight theme: </h2>
                <select id="styleSelect" onchange="updateStyle()">
                    <?php
                    $styles = scandir("styles/");
                    foreach($styles as $style){
                        if($style != "." && $style != ".."){
                            $e = str_replace(".css","",$style);
                            if($e == "hopscotch"){
                                echo "<option selected value='styles/$style'>hopscotch (default)</option>";    
                            }
                            else{
                                echo "<option value='styles/$style'>$e</option>";  
                            }
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="preview">
                <h2>Preview:</h2>
                <div class="code">
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 8
        });
      }
                </div>
            </div>
        </div>
        <div class="wrapper">
            <?php
            include('Color.php');
            $p = getcwd() . "/lib/";    
            $a = scandir($p);

            $color = new Color("#9a0000");
            $color = $color->getHsl();
            $i = 0;
            foreach($a as $element){
                $path =  "lib/$element";

                if($element != ".." && $element != "."){
                    $h = htmlspecialchars(file_get_contents($path));
                    $name = explode(".",$element);
                    $name = $name[0];

                    $i++;
                    $color["H"] = $color["H"] + 180/$i;
                    $c = new Color(Color::hslToHex($color));
                    $cBackground = $c->darken(5);

                    //Splits multiple snippets in the same file using the delimiter 5 dashes (-----)
                    $r = explode('-----',$h);
                    $res = "";
                    if(count($r)>0){
                        foreach($r as $snippet){
                            $res .= "<div class='code'>$snippet</div>";
                        }
                    }
                    else{
                        $res = "<div class='code'>$h</div>";
                    }

                    $c = $c->getHex();
                    //        $cBackground = $cBackground->getHex();
                    echo "<div class='lang minimized' style='background:#$cBackground'><i class='material-icons'>arrow_drop_down_circle</i><span class='header' onclick='minimize(this)' style='background:#$c'>$name</span>$res</div>";
                }
            }
            ?>
        </div>
    </body>
    <script>
        function updateStyle() {
            $('#style').attr('href', $('#styleSelect').val());
        }

        function minimize(o) {

            $($(o).parent()).toggleClass("minimized");
            $($(o).parent()).children("i").toggleClass("minimized");
        }
        $(".code").each(function (i, o) {
            $(o).attr("id", "code" + i);
            $(o).wrap("<section></section>");
//            $(o).after("<button data-content='' data-clipboard-target='#code" + i + "'>Copy to clipboard</button>");
            hljs.highlightBlock(o);
        });
        var c = new Clipboard("button");
        c.on("success", function (e) {
            e.clearSelection();
            $(e.trigger).attr("data-content", "Copied!");
            setTimeout(function () {
                $(e.trigger).attr("data-content", "");
            }, 2500);
        })
    </script>

</html>