<?php
session_start();
include '../../dbconnect/dbconnect.php';

//Table name 
$tbl_name = "order_product"; 

//Create a variable
$draft_id= mysqli_real_escape_string($conn,$_POST['draft_id']);
$product_name= mysqli_real_escape_string($conn,$_POST['product_name']);
$product_id= mysqli_real_escape_string($conn,$_POST['product_id']);
$product_description= mysqli_real_escape_string($conn,$_POST['product_description']);
$product_quantity= mysqli_real_escape_string($conn,$_POST['product_quantity']);
$product_buying_price= mysqli_real_escape_string($conn,$_POST['product_buying_price']);
$product_discount_price= mysqli_real_escape_string($conn,$_POST['product_discount_price']);
$discounted_price= mysqli_real_escape_string($conn,$_POST['discounted_price']);
$total_of_buying= mysqli_real_escape_string($conn,$_POST['total_of_buying']);
$product_selling_percent= mysqli_real_escape_string($conn,$_POST['product_selling_percent']);
$product_selling_price= mysqli_real_escape_string($conn,$_POST['product_selling_price']);
$product_tax= mysqli_real_escape_string($conn,$_POST['product_tax']);
$product_tax_inclusive= mysqli_real_escape_string($conn,$_POST['product_tax_inclusive']);

$product_total= mysqli_real_escape_string($conn,$_POST['product_total']);
$location=mysqli_real_escape_string($conn,$_POST['location']);
$user_id= mysqli_real_escape_string($conn,$_POST['user_id']);

$sql = "INSERT INTO $tbl_name(order_id,order_product_name,order_product_description,order_product_quantity,order_buying_price,order_discount_percent,order_discounted_price,order_total_of_buying,order_selling_percentage,order_selling_price,order_tax,tax_inclusive,order_total,o_product_id,data_entered_by,location,delete_status) VALUES ('$draft_id','$product_name','$product_description','$product_quantity','$product_buying_price','$product_discount_price','$discounted_price','$total_of_buying','$product_selling_percent','$product_selling_price','$product_tax','$product_tax_inclusive','$product_total','$product_id','$user_id','$location',0)";
mysqli_query($conn, $sql);
$last_id = mysqli_insert_id($conn); 
echo $last_id;
mysqli_close($conn);
?>