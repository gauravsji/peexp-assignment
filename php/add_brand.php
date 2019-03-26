<?php
session_start();
include '../dbconnect/dbconnect.php';
include '../php/add/add_activity_log.php';
	
//Table name 
$tbl_name = "brand"; 

//Create a variable
$product_set_id= $_POST['product_set_id'];
$brand_name= $_POST['brand_name'];
$brand_description= $_POST['brand_description'];
$brand_company_connect= $_POST['brand_company_connect'];
$brand_company_number= $_POST['brand_company_number'];
$user_id= $_POST['user_id'];
$location= $_POST['location'];

$sql = "INSERT INTO $tbl_name(product_set_id,brand_name,brand_description,brand_company_connect,brand_company_connect_contact_number,data_entered_by,location) VALUES ('$product_set_id','$brand_name','$brand_description','$brand_company_connect','$brand_company_number','$user_id','$location')";
mysqli_query($conn, $sql);
$last_id = mysqli_insert_id($conn); 
fn_add_activity_log("Brand",$last_id,"Brand Added",$user_id,$conn);
echo $last_id;
mysqli_close($conn);
?>