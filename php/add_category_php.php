<?php
session_start();
include '../dbconnect/dbconnect.php';
include '../php/add/add_activity_log.php';

//Table name 
$tbl_name = "category"; 

//Create a variable
$category_name= $_POST['text1'];
$category_description= $_POST['text2'];
$user_id= $_POST['user_id'];
$location= $_POST['location'];

$sql = "INSERT INTO $tbl_name(category_name,category_description,data_entered_by,location) VALUES ('$category_name','$category_description','$user_id','$location')";
mysqli_query($conn, $sql);
$last_id = mysqli_insert_id($conn); 
fn_add_activity_log("Category",$last_id,"Category Added",$user_id,$conn);
echo $last_id;
mysqli_close($conn);
?>