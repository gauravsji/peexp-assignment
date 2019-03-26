<?php
// This file makes a connection with mysql database. 
require_once("../dbconnect/dbconnect.php");
$vendor_id=$_POST['vendor_id'];
$product_id=$_POST['product_id'];
$sql = "SELECT * FROM vendor_product WHERE vendor_id = $vendor_id and product_id = $product_id and delete_status <>1 order by vp_create_time desc Limit 1";
$rs = mysqli_query($conn,$sql);
while ($res = mysqli_fetch_array($rs)) 
{
echo $res['product_vendor_price'];
}
?>