fs = require('fs');
fs.readFile('cycle.json', 'utf8', function (err, data) {
    if (err) {
        return console.log(err);
    }
    var big = JSON.parse(data);
//    var small = ["Gold","Silver","Silver","Giant","Silver","Silver","Silver","Silver","Gold","Silver","Silver","Gold","Silver","Silver","Silver","Silver","Gold","Silver","Silver","Gold","Silver","Silver","Silver","Gold","Silver","Silver","Silver","Silver","Gold","Silver","Gold","Silver","Silver","Silver","Silver","Giant","Silver","Silver","Silver","Silver","Gold","Silver","Silver","Gold","Silver","Silver","Silver","Silver"];
    var small = ["Silver","Gold","Silver","Gold"];
    var res = [];
    loop(0);
    console.log(res);
    function loop(start) {
//        console.time(start);
        for (var j = start; j < big.length; j++) {
            var breakAll = false;
            //Om första matchar denna iterationen
            if (small[0] == big[j]) {
                for (var k = 0; k < small.length; k++) {
                    if (small[k] == big[j + k]) {
                        //Do nothing
                    }
                    else {
                        break;
                    }
                    //If we have iterated through the whole small sequence
                    if (k === small.length - 1) {
                        var newIndex = j + small.length;
//                        console.log("Din nästa chest ligger på index #" + newIndex + " och det är en " + big[newIndex] + " chest.");
                        res.pushUnique(newIndex);
                        loop(newIndex);
                        break;
                        breakAll = true;
                    }
                }
            }
            if (breakAll) {
                break;
            }
        }
    }
});

Array.prototype.pushUnique = function (item){
    if(this.indexOf(item) == -1) {
    //if(jQuery.inArray(item, this) == -1) {
        this.push(item);
        return true;
    }
    return false;
}