<html>

<head>
    <meta name="theme-color" content="#0066b1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Jakob Lindskogs officiella hemsida</title>
    <link href="https://fonts.googleapis.com/css?family=Galada|Droid+Sans|Dosis:600" rel="stylesheet">
    <link rel="icon" href="icon.png">
    <link rel="stylesheet" href="style.css">
    <?php
    include("lang.php");
    
    function getAge($date) {
        return intval(date('Y', time() - strtotime($date))) - 1970;
    }
    ?>
    
</head>

<body>
    <?php include('nav.php') ?>
    <div class="wrapper">
        <h1><?= s("Om JakobLindskog","About JakobLindskog") ?><span style="color:#ff0000;font-size:.6em">.tk</span></h1>
        <div class="paragraph">
            <?php $age = getAge("2014-01-01"); ?>
            <?= s("<p>jakoblindskog.tk grundades för $age år sedan i vardagsroligheternas namn.</p>
            <p>Den här hemsidan skall på ett koncist och elegant sätt visa att webbprogrammering inte bara är pest och pina, utan också kan vara roligt. Var och varannan dag läggs det upp saker här, så håll ögonen öppna för nya, färska webbprojekt! &hearts;</p>","<p>jakoblindskog.tk was founded for $age years ago in the name of monday-fun.</p>
            <p>This website shall, in a very consice and elegant way show that web development isn't all about pain and bad feelings, but that it instead can be *really* fun. Every sometimes I'll be uploading things here, so stay tuned for more awesome, fresh web projects! &hearts;</p>") ?>
            <hr>
            <div class="creator">
                <?php $age = getAge("1997-12-30"); ?>
                <?= s("<p>jakoblindskog.tk har nu funnits på webben sedan 2014. Innehavaren är en pojk på $age år, <span class='creator'>Jakob Lindskog</span></p>","<p>jakoblindskog.tk has now been on the web since 2014. The founder is a boy at $age years old, named <span class='creator'>Jakob Lindskog</span></p>");
                ?>
                <img src="arrow.png" class="arrow">
                <img src="https://scontent-amt2-1.xx.fbcdn.net/v/t1.0-9/13516518_1071076016288247_4880219997897763494_n.jpg?oh=0ca21c7408636e5da181b0c7b56b8da0&oe=5812EA90">
            </div>
        </div>
    </div>
    <!---<footer>
        <?php    
        /*$src = "visits.json";
        $handle = fopen($src,"r+");
        //Reads the contents of visits.json and converts it to array
        $visits = json_decode(fread($handle,filesize($src)),true);
        //Not entirely safe method to get ip, but after all it's not all serious business
        $ip = $_SERVER['REMOTE_ADDR'];
        array_push($visits,$ip);
        $amount = count($visits);
        $str = $amount === 1 ? "gång" : "gånger";
        echo "<p>Den här sidan har visats $amount $str.</p>";
        //Truncs the file
        ftruncate($handle,0);
        rewind($handle);
        fwrite($handle, json_encode($visits));*/
        ?>
    </footer>
-->
</body>
</html>