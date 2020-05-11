#!/usr/bin/php

<?php 

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

//session_start();
//$USER = ($_POST["user"]);
//$PASS = ($_POST["pass"]);
//$NAME = ($_POST["text"]);
//$EMAIL =  ($_POST["email"]);
//$TYPE = "register";

$client = new rabbitMQClient("callofduty.ini", "DatabaseAccess");

$request = array(); //added this just now
$request['type'] = "register";
$request['username'] = $_POST["user"];
$request['password'] = $_POST["pass"];
$request['name'] = $_POST["text"];
$request['email'] = $_POST["email"];
$request['message'] = $msg;

$response = $client->send_request($request);
//$response = $client->publish($request); 

if ($response == true)
	{
		
		header("Location: ../html/registersuccess.html");

	}
else
	{
		
		header("Location: ../html/registered.html");

	}

echo "Client received response: ".PHP_EOL;
print_r($response);
echo "\n\n";
echo $argv[0]." DONE".PHP_EOL;

?>
