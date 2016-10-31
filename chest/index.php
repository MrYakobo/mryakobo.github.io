<html>

<head>
    <link rel="icon" href="giantchest.gif">
    <meta name="theme-color" content="#00933e">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link async href="https://fonts.googleapis.com/css?family=Raleway:600|Roboto:900" rel="stylesheet">
    <title>Chest Cycle List</title>
    <link rel="stylesheet" href="new-style.css">
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>-->
    <script src="jquery.min.js"></script>
</head>
<?php
    $c = json_decode(file_get_contents("cycle.json"));

    $table = "<table id='table'>";

    $big = array();

    for($i = 0; $i < count($c); $i++){
        $chest = $c[$i];

        $lowercase = strtolower($chest);
        if($lowercase === "giant" || $lowercase === "magic"){
            $big[$i] = $chest;
        }
        $table .= "<tr class='$lowercase'><td>$i</td><td>$chest</td></tr>";
    }
    $table .= "</table>";
    $max = count($c)-1;
    ?>

    <body>
        <div class="main-title">
            <h1>Chest Cycle list</h1>
            <h2>in Clash Royale</h2>
        </div>
        <button class="general" onclick="theme()">Dark</button>
        <script>
        function theme(){
            $("body,#table").toggleClass("dark");
        }
        </script>
        
        <div class="tip"> <span>Tip! Note your current chest number here:</span>&nbsp;&nbsp;
            <p style="font-size:.6em">(will get saved on this device)</p>
            <table class="menu">
                <tr>
                    <td class="inc">
                        <button class="minus" onclick="inc(-1)">-</button>
                    </td>
                    <td>
                        <input min="0" max="<?= $max ?>" value="0" type="number" id="index"> </td>
                    <td class="inc">
                        <button onclick="inc(1)">+</button>
                    </td>
                    <td>
                        <table style="height:50px;width:100px">
                            <tr id="currChest">
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <p id="tip">&nbsp;</p>
                    </td>
                </tr>
            </table>
<!--
            <div class="dialog minimized">
                <h1 style="text-decoration:underline">Chest Identifier</h1>
                <button class="close" onclick="toggle()">X</button>
                <br>
                <p>Have no clue about your current chest? Nemas problemas! Click on the chests below that you've gotten so far (in order).</p>
                <div id="click">
                    <button onclick="tag('Silver')" class="silver">Silver</button>
                    <button onclick="tag('Gold')" class="Gold">Gold</button>
                    <button onclick="tag('Giant')" class="Giant">Giant</button>
                    <button onclick="tag('Magic')" class="Magic">Magic</button>
                </div>
                <div class="tableHolder">
                    <table id="tot"></table>
                </div>
                <button style="margin:20px auto;" class="general" onclick="$('#tot').html('');toggleDisplay(true)">Clear All</button>
                <p id="guess">&nbsp;</p> <img id="img" src="http://i.giphy.com/Ve20ojrMWiTo4.gif" style="display:none;width:100%;max-width: 300px;border-radius: 20px;border: 5px solid;padding: 2px;"> </div>
-->
        </div>
<!--        <button class="general" onclick="toggle()">Don't know your current chest?</button>-->
        <?= $table ?>
            <footer> Chest order from <a href="https://www.reddit.com/r/ClashRoyale/comments/4hm9at/new_chest_cycle_decrypted_clash_royale_132/">Reddit</a>. <span style="color:#a0a0a0">(updated May 2016)</span>
                <br> My custom, extracted JSON-file (from the link above) that is used to generate this table is available <a href="cycle.json">here</a>. </footer>
            <!--        </div>-->
    </body>
    <script>
        var bigChests = <?= json_encode($big) ?>;
        var chests = <?= json_encode($c) ?>;
        var max = <?= $max ?>;

        function inc(n) {
            var currIndex = parseInt($("#index").val());
            var newIndex = -1;
            if (currIndex + n < 0) newIndex = max;
            else if (currIndex + n > max) newIndex = 0;
            else newIndex = currIndex + n;
            $("#index").val(newIndex);
            updateChest();
        }
        //load from localstorage
        var previous = localStorage.getItem("chest");
        if (previous === null || previous == "undefined") {
            previous = 0;
        }
        $("#index").val(previous);
        
        setInterval(updateChest, 100);
        var oldNumberInput = null;
        updateChest();

        function updateChest() {
            let numberInput = $("#index").val();
            if (numberInput !== oldNumberInput) {
                for (var key in bigChests) {
                    if (bigChests.hasOwnProperty(key)) {
                        //key is index of chest, obj is the chest-type
                        var obj = bigChests[key];
                        var diff = key - numberInput;
                        //if end of cycle, should cycle back (and suggest that the magic chest is next)
                        if(numberInput >= 230){
                            diff = 240 - numberInput + parseInt(key);
                        }
                        if (diff > 0) {
                            let s = diff === 1 ? "" : "s";
                            //Tip-chest:
                            $("#tip").html(diff + " chest" + s + " from <table style='display:inline;'><tr class='"+obj+"'><td>" + obj + "</td></tr></table>");
                            $("#tip").css("opacity", 1 - diff / 50);
                            break;
                        }
                        else {
                            $("#tip").html("&nbsp;");
                        }
                    }
                }
                oldNumberInput = numberInput;
                let currChest = $($($("#table tr")[numberInput]).children()[1]).text();
                $("#currChest").removeClass();
                $("#currChest").addClass(currChest.toLowerCase());
                $("#currChest").html("<td>" + currChest + "</td>");
//                $(".active").removeClass("active");
//                $($($("#table tr")[numberInput]).children()[2]).addClass("active");
                localStorage.setItem("chest", numberInput);
            }
        }
        $.post("visit.php");
    </script>

</html>