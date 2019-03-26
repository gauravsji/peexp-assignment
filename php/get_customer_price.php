<?php
// This file makes a connection with mysql database. 
require_once("../dbconnect/dbconnect.php");
$customer_id=$_POST['customer_id'];
$product_id=$_POST['product_id'];
$sql = "SELECT * FROM customer_product WHERE customer_id = $customer_id and product_id = $product_id and delete_status <>1";
$rs = mysqli_query($conn,$sql);
while ($res = mysqli_fetch_array($rs)) 
{
echo $res['product_customer_price'];
}
?>