#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");


$request = array();
$request['type'] = "Login";
$request['username'] = $_POST["username"];
$request['password'] = $_POST["password"];
$request['message'] = $msg;
$response = $client->send_request($request);
//$response = $client->publish($request);

if ($response == true)
	{
		header("Location: ../html/successpage.html");
	}
else
	{
		header("Location: ../html/failpage.html");

	}

echo "client received response: ".PHP_EOL;
print_r($response);
echo "\n\n";

echo $argv[0]." END".PHP_EOL;

