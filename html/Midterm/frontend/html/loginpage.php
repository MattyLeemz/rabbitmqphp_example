<?php
$servername = "localhost";
$username = "admin"; //username is root by default
$password = "admin"; 
$dbname = "login"; 

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$user=$_POST['username'];
$pass= md5($_POST['password']); //md5 encrypts password
$sql = "SELECT * FROM users WHERE username='$user' and password='$pass'";
//add more in line 18

$data=mysqli_query($conn, $sql); 
if($data->num_rows>0){
echo "User is successfully logged in";
}else{
	  echo "Please try again";
}

mysqli_close($conn);
?>
