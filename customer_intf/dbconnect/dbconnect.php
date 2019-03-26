<?php
$host="localhost"; // Host name
$username="root"; // Mysql username
$password="1234"; // Mysql password
$dbname="dev_snippt"; // Database name

// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn)
{
	header("Location:../extra/connection_failed.php");
}
else {

}
?>
