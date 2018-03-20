var backgrounds = [];
var borders = [];
let c = "#00f";
for (var i = 0; i < Object.keys(json).length; i++) {
    var spin = (i + 1) / Object.keys(json).length * 360 * 3.5;
    backgrounds.push(Color(c).rotate(spin).hexString());
    borders.push(Color(c).rotate(spin).darken(.12).hexString());
}
var countryData = function () {
    let retVal = {};
    let names = [];
    let visits = [];
    for (var ip in json) {
        let countryCode = json[ip]["country"];
        //I want to have the country code in names, and the number of occurances in visits.
        //Log the countryCode, and if it's already in names, inc the property in visits.
        let name = countries[countryCode];
        if (names.indexOf(name) < 0) {
            names.push(name);
            visits[names.indexOf(name)] = 1;
        }
        else {
            visits[names.indexOf(name)]++;
        }
    }
    retVal["labels"] = names;
    retVal["data"] = visits;
    return retVal;
}
var browserData = function () {
    let retVal = {};
    let names = [];
    let visits = [];
    for (var ip in json) {
        let browser = json[ip]["browser"];
        let name = browser["name"];
        if (names.indexOf(name) < 0) {
            names.push(name);
            visits[names.indexOf(name)] = 1;
        }
        else {
            visits[names.indexOf(name)]++;
        }
    }
    retVal["labels"] = names;
    retVal["data"] = visits;
    return retVal;
}
var osData = function () {
    let retVal = {};
    let names = [];
    let visits = [];
    for (var ip in json) {
        let browser = json[ip]["browser"];
        let platformFamily = browser["platformFamily"];
        let platformVersion = browser["platformVersion"];
        let platformName = browser["platformName"];
        let name = `${platformFamily} ${platformName} (${platformVersion})`;
        if (names.indexOf(name) < 0 && name.indexOf("unknown") < 0) {
            names.push(name);
            visits[names.indexOf(name)] = 1;
        }
        else {
            visits[names.indexOf(name)]++;
        }
    }
    retVal["labels"] = names;
    retVal["data"] = visits;
    return retVal;
}

function getGreeting(m) {
    var g = "invalid"; //return g
    if (!m || !m.isValid()) {
        return g;
    } //if we can't find a valid or filled moment, we return.
    var split_afternoon = 12 //24hr time to split the afternoon
    var split_evening = 18 //24hr time to split the evening
    var currentHour = parseFloat(m.format("HH"));
    if (currentHour >= split_afternoon && currentHour <= split_evening) {
        g = "Afternoon";
    }
    else if (currentHour >= split_evening) {
        g = "Evening";
    }
    else {
        g = "Morning";
    }
    return g;
}
var timeData = function () {
    let retVal = {};
    let names = [];
    let values = [];
    for (var ip in json) {
        let visits = json[ip]["visits"];
        for (var i = 0; i < visits.length; i++) {
            if (typeof visits[i] !== "string") {
                continue;
            }
            name = getGreeting(moment(visits[i]));
            if (name === "invalid") continue;
            if (names.indexOf(name) < 0) {
                names.push(name);
                values[names.indexOf(name)] = 1;
            }
            else {
                values[names.indexOf(name)]++;
            }
        }
    }
    retVal["labels"] = names;
    retVal["data"] = values;
    return retVal;
}
var cityData = function () {
    let retVal = {};
    let names = [];
    let values = [];
    for (var ip in json) {
        let name = json[ip]["city"] + " (" + countries[json[ip]["country"]] + ")";
        if (names.indexOf(name) < 0) {
            names.push(name);
            values[names.indexOf(name)] = 1;
        }
        else {
            values[names.indexOf(name)]++;
        }
    }
    retVal["labels"] = names;
    retVal["data"] = values;
    return retVal;
}
//Takes an object with labels (names) and data, a label, which type of diagram and the id of the canvas.
function generate({labels, data}, label, type, id) {
    id = id.replace("#", "");
    var ctx = document.getElementById(id);
    var myChart = new Chart(ctx, {
        type: type,
        data: {
            labels: labels,
            datasets: [{
                label: label,
                data: data,
                backgroundColor: backgrounds,
                borderColor: borders,
                borderWidth: 1
            }]
        },
        options: {
            legend: {
                labels: {
                    fontFamily: "'Ubuntu', 'Helvetica', 'Arial', sans-serif",
                    fontSize: 15
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function (value) {
                            if (!(value % 1)) {
                                return Number(value).toFixed(0);
                            }
                        }
                    }
                }]
            },
            maintainAspectratio: true,
            responsive: true
        }
    });
}
generate(countryData(), "Number of visits", "bar", "#countries");
generate(browserData(), "Number of visits", "bar", "#browser");
generate(osData(), "#Machines with this OS", "bar", "#os");
generate(timeData(), "Humans", "pie", "#time");
generate(cityData(), "Humans", "bar", "#cities");