<html>

<head>
    <meta name="theme-color" content="#0066b1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Jakob Lindskogs officiella hemsida</title>
    <link async href="https://fonts.googleapis.com/css?family=Droid+Sans|Galada|Raleway:800|Dosis:600" rel="stylesheet">
    <link rel="icon" href="icon.png">
    <link rel="stylesheet" href="style.css">
    <?php
        include("lang.php");
    //PHP Version 5.5.38
    ?>
</head>

<body>
    <?php include('nav.php') ?>
        <div class="wrapper">
            <h1 class="smallerMobile"><?= s("Vad finns på den här sidan?","What's on this domain?") ?></h1>
            <h3 style="font-size:.7em"><?= s("Här hittar du länkar till lite allt möjligt jag har gjort. Inga garantier på kvalitét ges på dessa webbprojekt. Enjoyyy","Here, you'll find links to my projects that reside on this domain. Enjoy. :)") ?></h3>
            <?php
    //Echoes out all folders at this domain that have info.json present in the root
    include("Color.php");

    $a = scandir(getcwd());
    //shuffle($a);
    $id = 0;

    $cards = array();

    function latestChangeInDir($path){
        if(is_dir($path)){
            $dir = scandir($path);
            $latest = 0;
            foreach ($dir as $file) {
                $x = filemtime("$path/$file");
                if($x>$latest)
                    $latest = $x;
            }
            return $latest;
        }
        return 0;
    }

foreach($a as $element){
    try{
    $id++;
    if(substr_count($element, ".") == 0 && is_dir($element)){
        //The element is a dir. Let's scan for info.json
        $dir = scandir($element);
        if(in_array("info.json",$dir)){
            //Decodes JSON-information and declares variables for easier use
            $path = "$element/info.json";
            $info = json_decode(file_get_contents($path),true);
            $title = $info['title'];
            
            $description = $info['description'][$str];
            $img = "$element/icon.png";
            $col = $info['background'];
            
            $c = new Color($col);
            $l = $c->lighten(15);
            $d = $c->darken(10);

            $html = "<style> #card$id { background-color:$col; background-image: url('$element/icon.png') } #card$id:hover { background-color: $l} #card$id:active { background-color: $d; } </style> <a href='$element'> <div class='card' id='card$id'> <h1>$title</h1> <p>$description</p></div></a>";
            
            $lastChanged = latestChangeInDir($element);
            $obj = [];
            $obj["html"] = $html;
            $obj["lastChanged"] = $lastChanged;
            $cards[] = $obj;
            }
        }
        }
    catch(Exception $e){
        print_r($e);
    }
    }
    function sortFunc($a, $b){
        if ($a["lastChanged"] == $b["lastChanged"]) {
            return 0;
        }
        if($a["lastChanged"] > $b["lastChanged"]){
            return -1;
        }
        return 1;
    }

    usort($cards,"sortFunc");
    foreach($cards as $c){
        echo $c["html"];
    }
    //Gör en fuling tills jag kommit på något bättre sätt att outputta cardsen i rätt ordning. count($cards) funkar ej då loopen inte kommer gå tillräckligt långt isåfall. Rätt störigt :/
    // for ($i=0; $i < 50; $i++) {
    //     if(isset($cards[$i]))
    //         echo $cards[$i];
    // }
?>
        </div>
</body>
</html>