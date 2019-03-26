<?php
session_start();
include '../../dbconnect/dbconnect.php';

//Table name 
$tbl_name = "order_product"; 

//Create a variable
$order_product_id= mysqli_real_escape_string($conn,$_POST['order_product_id']);
$product_name= mysqli_real_escape_string($conn,$_POST['product_name']);
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

$sql = "
UPDATE $tbl_name 
SET 
order_product_name='$product_name',
order_product_description='$product_description',
order_buying_price='$product_buying_price',
order_product_quantity='$product_quantity',
order_discount_percent='$product_discount_price',
order_discounted_price='$discounted_price',
order_total_of_buying='$total_of_buying',
order_selling_percentage='$product_selling_percent',
order_selling_price='$product_selling_price',
order_tax='$product_tax',
tax_inclusive='$product_tax_inclusive',
order_total='$product_total'
WHERE order_product_id=".$order_product_id;


$sql1 = "SELECT * FROM order_product where delete_status<>1 and order_product_id = " . $order_product_id;
$result1 = mysqli_query($conn, $sql1);
$order_product_result = mysqli_fetch_array($result1,MYSQLI_ASSOC);


if (mysqli_query($conn, $sql)) 
{
	echo $order_product_result['order_id'];
}

mysqli_close($conn);
?>