var express = require('express');
var app 	= require('express')();
var server 	= require('http').Server(app);
var path 	= require('path');
var spawn 	= require('child_process').spawn;
var fs 		= require('fs');
var ws      = require('websocket').server;

server.listen(80);
console.log('Linux Dash Server Started!');

app.use(express.static(path.resolve(__dirname + '/../')));

app.get('/', function (req, res) {
	res.sendFile(path.resolve(__dirname + '/../index.html'));
});

app.get('/websocket', function (req, res) {
	res.status(200).send("");
});

wsServer = new ws({
	httpServer: server
});

wsServer.on('request', function(request) {
	var connection = request.accept('linux-dash', request.origin);
	connection.on('message', function(message) {
        if (message.type === 'utf8') {
			var req = JSON.parse(message.utf8Data)

			var shellFile = __dirname + '/modules/shell_files/' + req.module + '.sh';

			if (req.module.indexOf('.') > -1
				|| !req.module
				|| !fs.existsSync(shellFile))
			{
				res.sendStatus(406);
				return;
			}

			var command = spawn(shellFile, [ req.color || '' ]);
			var output  = [];

			command.stdout.on('data', function(chunk) {
				output.push(chunk);
			});

			command.on('close', function(code) {
				if (code === 0) {
					req.output = output.toString();
					connection.sendUTF(JSON.stringify(req));
				}
			});
        }
    });
});

app.get('/datafactory/', function (req, res) {

	var shellFile = __dirname + '/modules/shell_files/' + req.query.module + '.sh';

	if (req.query.module.indexOf('.') > -1
		|| !req.query.module
		|| !fs.existsSync(shellFile))
	{
		res.sendStatus(406);
		return;
	}	

	var command = spawn(shellFile, [ req.query.color || '' ]);
	var output  = [];

	command.stdout.on('data', function(chunk) {
		output.push(chunk);
	}); 

	command.on('close', function(code) {
		if (code === 0) res.send(output.toString());
		else res.sendStatus(500);
	});

});
