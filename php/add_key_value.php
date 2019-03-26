<?php
session_start();
include '../dbconnect/dbconnect.php';

//Table name 
$tbl_name = "key_value"; 

//Create a variable
$unit_of_measurement= ucfirst(mysqli_real_escape_string($conn,$_POST['unit_of_measurement']));
$location= $_POST['location'];

$sql = "INSERT INTO $tbl_name(key_column,value,location) VALUES ('UNIT_OF_MEASUREMENT','$unit_of_measurement','$location')";
mysqli_query($conn, $sql);
$last_id = mysqli_insert_id($conn); 
echo $last_id;
mysqli_close($conn);
?>