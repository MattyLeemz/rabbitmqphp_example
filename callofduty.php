#!/usr/bin/php

<?php 

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

session_start();
$USER = ($_SESSION["username"]);
$PASS = ($_SESSION["password"]);
$TYPE = ($_SESSION["type"]);
$msg =  ($_SESSION["message"]);

$client = new rabbitMQClient("callofduty.ini", "DatabaseAccess");

$login->select = $TYPE;
$login->username = $USER;
$login->password = $PASS;
$login->message = $msg;

//JSON 
$request = json_encode($login);

$response = $client->send_request($request);
//$response = $client->publish($request); 

echo "NJIT Diner Client received response: ".PHP_EOL;
print_r($response);
echo "\n";
echo $argv[0]." DONE".PHP_EOL;

?>
