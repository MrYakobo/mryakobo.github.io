<html>

<head>
    <script src="tinycolor-min.js"></script>
    <meta name="theme-color" content="#0066b1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="icon" href="icon.png">
    <title>Jakob Lindskogs officiella hemsida</title>
    <link href="https://fonts.googleapis.com/css?family=Galada|Pacifico|Dosis:600" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <?php
    include("lang.php");
    ?>
</head>

<body>
    <?php include('nav.php') ?>
    <div class="wrapper">
        <h1 class="main-title">Jakob Lindskog<span style="color:#ff0000;font-size:.6em">.tk</span></h1>
        <h2 class="main-title"><?= s("En ovanligt innovativ hemsida","A very prestigeful site") ?></h2>
        <img class="arrow handwriting" src="arrow.png">
        <a href="insider<?= langUrl() ?>" class="handwriting"><?= s("Följ med och kolla in sidan!","C'mon and let's check out the page!") ?></a><img class="arrow handwriting" src="arrow.png" style="transform:scaleX(-1)">
    </div>
</body>

</html>