<?php
session_start();
include '../../dbconnect/dbconnect.php';

//Table name 
$tbl_name = "vendor_brand"; 

//Create a variable
$vendor_id= $_POST['vendor_id'];
$brand_id= $_POST['brand_id'];
$discount= $_POST['discount'];

$sql = "INSERT INTO $tbl_name(vendor_id,brand_id,vendor_discount,delete_status) VALUES ('$vendor_id','$brand_id','$discount',0)";
mysqli_query($conn, $sql);
$last_id = mysqli_insert_id($conn); 
echo $last_id;
mysqli_close($conn);
?>