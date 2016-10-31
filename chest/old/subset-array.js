fs = require('fs');
fs.readFile('cycle.json', 'utf8', function (err, data) {
    if (err) {
        return console.log(err);
    }
    var chests = JSON.parse(data);
    //First index: 38 (Gold)
    //Last index: 50 (Silver)
    //Next: 51 (Giant)
    var seq = ["Gold", "Silver", "Silver", "Silver", "Silver", "Gold", "Silver", "Silver", "Gold", "Silver", "Silver", "Silver", "Silver", "Giant"];
    //ex: seq = ["Silver","Silver","Gold","Silver","Silver","Silver","Silver","Magic"]
    //ex: chests = ["Silver","Gold","Silver","Silver","Silver","Silver","Magic"]
    var tot = [];
    for (var k = 0; k < seq.length; k++) {
        var n = [];
        for (var i = k; i < seq.length; i++) {
            /*
            i = 0:
                j = 0:
                    Gold === Silver?
                    Nej.
                j = 1:
                    Gold === Gold?
                    Ja. i++ => i = 1
                j = 2:
                    Silver === Silver?
                    Ja. i++ => i = 2
                j = 3:
                    Silver === Silver?
                    Ja. i++     
            ...
            */
            var streak = [];
            for (var j = 0; j < chests.length; j++) {
                if (seq[i] == chests[j]) {
//                    streak.push("Sequence #" + i + " == chests #" + j);
                    streak.push(i + ":" + j);
//                    streak.push(j);
//                    console.log(seq[i] + " == " + chests[j] + " @ i:" + i + " && j:" + j);
                    //Because this matched, check next sequence chest as well.
                    if (i + 1 < seq.length){
                        i++;
                    }
                }
                //If the chests didn't match, and there was a streak before, add it to the log
                else {
                    if(streak.length > 0){
//                        if(streak.length > largestStreak)
//                            largestStreak = streak.length;
//                        console.log(streak.length);
                        n.push(streak);
                        streak = [];
                    }
                }
            }
            
        }
        tot.push(n);
    }
    console.log(tot);
//    console.log(largestStreak);
    if (n.length === seq.length) {
        var lastIndex = n[n.length - 1];
        console.log("Your next chest: " + chests[lastIndex + 1] + " (#" + (lastIndex + 1) + ")");
    }
});