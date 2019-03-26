<?php
session_start();
include '../../dbconnect/dbconnect.php';

//Table name 
$tbl_name = "project"; 

//Create a variable
$customer_id= mysqli_real_escape_string($conn,$_POST['customer_id']);
$project_name= mysqli_real_escape_string($conn,$_POST['project_name']);
$user_id= mysqli_real_escape_string($conn,$_POST['user_id']);
$location= mysqli_real_escape_string($conn,$_POST['location']);

$sql = "INSERT INTO $tbl_name(customer_id,project_name,data_entered_by,location) VALUES ('$customer_id','$project_name','$user_id','$location')";
mysqli_query($conn, $sql);
$last_id = mysqli_insert_id($conn); 
echo $last_id;
mysqli_close($conn);
?>