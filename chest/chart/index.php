<!DOCTYPE html>
<html lang="en">
<?php
    date_default_timezone_set("Europe/Stockholm");
?>
<head>
    <!--Metadata:-->
    <meta name="theme-color" content="#279549">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Statistics</title>
    <!--Style-->
    <link rel="icon" href="../icon.png">
    <link rel="stylesheet" href="style.css">
    <link async href="https://fonts.googleapis.com/css?family=Exo+2:800" rel="stylesheet">
    <!--Scripts-->
    <script src="chart.bundle.min.js"></script>
    <script src="jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.0/moment.min.js" integrity="sha256-o1yDQgIyAVnPU1ckXVUlCOBMX+NIJLnaQk/9dBTSaYk=" crossorigin="anonymous"></script>
    <script>
        <?php
            $jsonRaw = file_get_contents("visitsWithCountry.json");
            $json = json_decode($jsonRaw,true);
            $count = 0;
            foreach($json as $j){
                $count += count($j["visits"]);
            }
            $usersCount = count($json);
        ?>
        var json = JSON.parse(<?= json_encode($jsonRaw) ?>);
        var countries = JSON.parse(<?= json_encode(file_get_contents("countries.json")) ?>);
    </script>
</head>

<body>
    <div class="container">
        <h1>Statistics</h1> <span>(updated <?= date("m-d H:i",filemtime("visitsWithCountry.json")) ?>)</span>
        <p><?= $count ?> visits, <?= $usersCount ?> users</p>
        <h2>County popularities</h2>
        <canvas id="countries" width="300px" height="250px"></canvas>
        <hr>
        <h2>Browsers</h2>
        <canvas id="browser" width="300px" height="250px"></canvas>
        <hr>
        <h2>OS</h2>
        <canvas id="os" width="300px" height="250px"></canvas>
        <hr>
        <h2>Cities</h2>
        <canvas id="cities" width="300px" height="250px"></canvas>
        <hr>
        <h2>Time of day (UTC+2)</h2>
        <canvas id="time" width="300px" height="250px"></canvas>
    </div>
</body>
<script src="main.js"></script>
</html>