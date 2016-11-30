<!DOCTYPE html>
<html>

<head>
    <!--Charset and viewport optimization-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#d40606">
    <link rel="icon" href="http://heartlandfamilyservice.org/wp-content/themes/hfs/img/icon-wishlist.png">
    <title>Jakobs önskelista</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <h1>Jakobs önskelista</h1>
        <ul>
        <?php
        $wishes = ["Old Spice","Fred på jorden","Kul tshirt","Nespresso-maskin (ej viktigt att den e ny eller dyr)","Wunderbaum (äpplesmak! Viktigt)","Kalsingar","Jacka? (ej så viktigt, endast förslag)"];
        foreach($wishes as $w){
            ?>
            <li><?= $w ?></li>
        <?php
        }
        ?>
            
            </ul>
    </div>
</body>

</html>