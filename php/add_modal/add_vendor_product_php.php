<?php
session_start();
include '../../dbconnect/dbconnect.php';

//Table name 
$tbl_name = "vendor_product"; 

//Create a variable
$vendor_id= mysqli_real_escape_string($conn,$_POST['vendor_id']);
$product_id= mysqli_real_escape_string($conn,$_POST['product_id']);
$product_price= mysqli_real_escape_string($conn,$_POST['product_price']);

$sql = "INSERT INTO $tbl_name(vendor_id,product_id,product_vendor_price,delete_status) VALUES ('$vendor_id','$product_id','$product_price',0)";
mysqli_query($conn, $sql);
$last_id = mysqli_insert_id($conn); 
echo $last_id;
mysqli_close($conn);
?>