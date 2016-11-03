<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=0">
    <script src="jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <meta name="theme-color" content="#000000">
    <title>Efternamnsgenerator</title>
    <link rel="stylesheet" href="style.css">
    <meta name="theme-color" content="#003598">
    <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet" type="text/css"> </head>

<body>
    <h1 class="main-title">Efternamnsgeneratorn</h1>
    <div>
        <h2 class="intro">Är du inte säker på vad ditt nya efternamn ska vara? Har du och din partner idétorka på namn? Då är den här sidan för dig.</h2> <code>Skriv in två valfria namn för att kombinera dem. Generatorn ger dig ett antal förslag på nya efternamn.</code> </div>
    <input type="text" placeholder="Namn 1" id="name1" value="Bokerud">
    <input type="text" placeholder="Namn 2" id="name2" value="Adamsson">
    <div class="form">
        <div class="form">
            <input type="checkbox" id="wordlist">
            <label for="wordlist">Kolla med ordlista</label>
        </div> <code>(kan ta extra lång tid och ge skumma resultat)</code> </div>
    <div class="hidden" data-dialog="result">
        <h1 class="result">Resultat</h1>
        <p id="result">Resultatet visas här</p>
    </div>
    <button onclick="gen()" data-dialog="result">Generera efternamn!!</button>
</body>
<script>
    function gen() {
        var time = Date.now();
        var n = document.getElementById("name1").value;
        var m = document.getElementById("name2").value;
        var checked = document.getElementById("wordlist").checked;
        if (checked) {
            $.get("php/generate.php", {
                name1: n, name2: m }, function (data) {
                data = JSON.parse(data);
                var html = "";
                for (let i = 0; i < data.length - 1; i++) {
                    html += data[i] + ", ";
                }
                html += data[data.length - 1];
                var diff = Date.now() - time;
                document.getElementById("result").innerHTML = html + "<br>Executed in " + diff + " milliseconds";
                dialog("result");
            });
        }
        else{
            
        }
    }
</script>
<script src="http://vab.kodlabb.se/Library/dialog/dialog.js"></script>

</html>