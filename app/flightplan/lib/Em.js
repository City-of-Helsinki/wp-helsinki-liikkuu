var querystring = require('querystring');
var http = require('http');

var Em  = {};

/**
 * a prompt method to be used during tasks
 */
Em.prompt = function(plan, target, targetName, message){
	if(plan.runtime.target === targetName) {
	    var input = target.prompt(message+' [y]');
	    if(input.indexOf('y') === -1) {
	      plan.abort('User canceled flight!');
	    }
	}
};

Em.getDbCredential = function(target, key){
	return process.env[target.toUpperCase()+'_'+key.toUpperCase()];
};

Em.checkDbCredentials = function(target){
	var required = ['MYSQL_HOST', 'MYSQL_USER', 'MYSQL_PASSWORD', 'MYSQL_DATABASE'];

	for (var i = 0; i < required.length; i++) {
		if(typeof(process.env[target.toUpperCase()+'_'+required[i]]) === 'undefined'){
			return false;
		}
	}

	return true;
};

Em.writeLog = function(target, str) {

	if(process.env.SLACK_CHANNEL === 'undefined' || process.env.SLACK_CHANNEL == '') return true;

    target.log("Send deploy log to slackbot");

    var data = querystring.stringify({
        channel: process.env.SLACK_CHANNEL,
        message: str
    });

    var auth = 'Basic ' + new Buffer('demo' + ':' + 'demo').toString('base64');

    var options = {
        host: 'playground.evermade.fi',
        port: 80,
        path: '/slackbot/index.php',
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'Content-Length': Buffer.byteLength(data),
            'Authorization': auth
        }
    };

    var req = http.request(options, function(res) {
        res.setEncoding('utf8');
        res.on('data', function(chunk) {
            console.log("body: " + chunk);
        });
    });

    req.write(data);
    req.end();

};

module.exports = Em;