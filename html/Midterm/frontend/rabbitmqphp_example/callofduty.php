#!/usr/bin/php

<?php 

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

session_start();
$USER = ($_POST["user"]);
$PASS = ($_POST["pass"]);
$NAME = ($_POST["text"]);
$EMAIL =  ($_POST["email"]);
$TYPE = "register";

$client = new rabbitMQClient("callofduty.ini", "DatabaseAccess");

$login->select = $TYPE;
$login->username = $USER;
$login->password = $PASS;
$login->name= $NAME;
$login->email = $email;

//JSON 
$request = json_encode($login);

$response = $client->send_request($request);
//$response = $client->publish($request); 

echo "Client received response: ".PHP_EOL;
print_r($response);
echo "\n";
echo $argv[0]." DONE".PHP_EOL;

?>
