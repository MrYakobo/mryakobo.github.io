fs = require('fs')
fs.readFile('countries.json', 'utf8', function (err,data) {
  if (err) {
    return console.log(err);
  }
  /*
  json:{
      "SE":"Sweden",
      "GB":"Great Britain"
  }
  */
  var obj = {};
  
  data = JSON.parse(data);
  
  for(var key in data){
      obj[data[key]["code"]] = data[key]["name"];
  }

  fs.writeFile("countries2.json", JSON.stringify(obj), function(err) {
    if(err) {
        return console.log(err);
    }

    console.log("The file was saved!");
}); 
});