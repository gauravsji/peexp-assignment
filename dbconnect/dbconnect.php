<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "peerxp";

// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
	//echo "Connected successfully";
?>