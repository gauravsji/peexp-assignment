<?php
/*	
//This is credentials while using it on local server
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$dbname="smartstorey"; // Database name 
*/

/* This is credentials while using it on AWS server */
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password="Sph!nx2g0!!"; // Mysql password 
$dbname="smartstorey"; // Database name 

// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);
// Check connection
if (!$conn)
{
	header("Location:../extra/connection_failed.php");
	//die("Connection failed: " . mysqli_connect_error());
}
?>
