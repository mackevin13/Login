<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'useraccounts');
 
/* Attempt to connect to MySQL database */
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if ($conn === false) {
    exit;
}
?>

<!-- <?php

//$hostname     = "localhost";
//$username     = "root";
//$password     = "";
//$databasename = "useraccounts";

//$conn = mysqli_connect($hostname,$username, $password,$databasename);

//if ($conn == false) { 
	//die("Unable to Connect database: " .mysqli_connect_error());
 



?> -->