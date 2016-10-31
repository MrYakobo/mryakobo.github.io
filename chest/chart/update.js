var request = require('request');
request('http://jakoblindskog.tk/chest/chart/update-json.php', function (error, response, body) {
  if (!error && response.statusCode == 200) {
    console.log(body);
  }
});