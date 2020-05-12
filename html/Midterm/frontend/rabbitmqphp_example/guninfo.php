<!DOCTYPE HTML>
<html>
        <head>
        <meta charset="utf-8">
        <title>Gun Information</title>
        </head>

        <body>
                <h1>Selected gun name goes here</h1>

        </body>
</html>

<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$client = new rabbitMQClient("infoDisplay.ini", "DataAccess");

$request = array();
$request['type'] = "gun";
$request['item'] = "M4A1";
$request['message'] = $msg;

$response = $client->send_request($request);

echo "Client received response: ".PHP_EOL;
print_r($response);
echo "\n\n";
echo $argv[0]." DONE".PHP_EOL;

?>

