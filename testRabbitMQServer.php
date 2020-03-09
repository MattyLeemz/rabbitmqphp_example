#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

//ERROR LOGGING

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('log_errors', TRUE);
ini_set('error_log', '/home/parthrana/git/rabbitmqphp_example/logging/dbLog');
ini_set('log_errors_max_len', 1024);


function doLogin($user_name,$pass)
{
	// lookup username in databas
	$dbConnect = new mysqli('127.0.0.22','ubuntu','ubuntu','IT490');

	if(! $dbConnect) {
		die("Connection failed");
	}
	echo "Connected To Database";
	echo "<br>";
	// check username and password
	
	$query = "SELECT * FROM Info WHERE username = '$user_name' AND password = '$pass'";
$result = mysqli_query($dbConnect, $query);
echo "<br>";
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
if (!$row == 1) {
	echo "UserName or Password not in database";
	return false;
}else{
	echo "Account is in database";
	return true;
}


	
    //return false if not valid
}

function doRegister($username, $passw){


       // lookup username in databas
	//Connect to DB
        $dbConnect = new mysqli('10.0.0.22','ubuntu','ubuntu','IT490');

        if(! $dbConnect) {
                die("Connection failed");
        }
        echo "Connected To Database";
        echo "<br>";
        // check username and password

	$query = "SELECT * FROM Info WHERE username = '$username'";
	$query2 = "INSERT INTO Info VALUES (NULL,'$username', '$passw')";
$result = mysqli_query($dbConnect, $query);
echo "<br>";
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
if ($row == 1) {
        echo "Username is in database!!!! Recreate Account with different username";
        return false;
}else{
	$createAccount = mysqli_query($dbConnect, $query2);
        echo "Account Created";
        return true;
}




}

function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "login":
      return doLogin($request['username'],$request['password']);
    case "validate_session":
	    return doValidate($request['sessionId']);
   case "register":
	   return doRegister($request['username'],$request['password']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();
?>

