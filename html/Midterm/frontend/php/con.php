
<?php
session_start();

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);

//Access to RMQ
include("callofduty.php");
include("callofduty1.php");

//From blog.html
$u =$_POST['User'];
$p =$_POST['Pass'];
$type =$_POST['type'];

//DB entrance
$host = "10.0.0.22";
$user = "db1user";
$pass = "Admin1!Admin1!";
$dbase = "db1";

if($type == "Login")    {

        //Session incase user,password,type needed elsewhere 
        $_SESSION["username"] = $u;
        $_SESSION["password"] = $p;
        $_SESSION["type"] = $type;
	$_SESSION["message"] = "Member Login attempt";
	//RMQ message
	 header("refresh:1; url = 'callofduty.php'"); }

$con = mysqli_connect($host, $user, $pass, $dbase);

        $q = mysqli_query($con, "SELECT * from user WHERE Username = '$u' && Password='$p'");
        $rows = mysqli_num_rows($q);

        if($rows==1) {  $_SESSION["message"]= "Access GRANTED";
		      	//RMQ message
                         header("refresh:1; url = 'callofduty1.php'");
		      	//Access to API
			header("refresh:1; url = 'https://spoonacular.com/food-api'");    }
                                
	else {	 $_SESSION["message"]= "Not A Member";
	      	//RMQ message
                 header("refresh:1; url = 'callofduty.php'");
	      	//Redirect back to Registation page
                 $url = "register.html";
                 header ("refresh:2; url =$url");  }



?>

~                                                                               
~                                                                               
~                                                                               
~                                                                               
~                                                                               
~       
