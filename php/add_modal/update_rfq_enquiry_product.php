<?php
session_start();
include '../../dbconnect/dbconnect.php';

//Table name
$tbl_name = "customer_rfq_enquiry";

//Create a variable
$id= mysqli_real_escape_string($conn,$_POST['id']);
$product_name= mysqli_real_escape_string($conn,$_POST['product_name']);
$product_description= mysqli_real_escape_string($conn,$_POST['product_description']);
$product_quantity= mysqli_real_escape_string($conn,$_POST['product_quantity']);
$product_buying_price= mysqli_real_escape_string($conn,$_POST['product_buying_price']);
$product_discount_price= mysqli_real_escape_string($conn,$_POST['product_discount_price']);
$discounted_price= mysqli_real_escape_string($conn,$_POST['discounted_price']);
$total_of_buying= mysqli_real_escape_string($conn,$_POST['total_of_buying']);
$product_selling_percent= mysqli_real_escape_string($conn,$_POST['product_selling_percent']);
$product_selling_price= mysqli_real_escape_string($conn,$_POST['product_selling_price']);
$product_tax_inclusive= mysqli_real_escape_string($conn,$_POST['product_tax_inclusive']);
$remarks= mysqli_real_escape_string($conn,$_POST['remarks']);
$status= mysqli_real_escape_string($conn,$_POST['status']);
$product_total= mysqli_real_escape_string($conn,$_POST['product_total']);
$product_tax= mysqli_real_escape_string($conn,$_POST['product_tax']);
$sql = "UPDATE customer_rfq_enquiry SET
product_name='$product_name',
product_description='$product_description',
product_quantity='$product_quantity',
enquiry_buying_price='$product_buying_price',
enquiry_discount_percent='$product_discount_price',
enquiry_discounted_price='$discounted_price',
enquiry_total_of_buying='$total_of_buying',
enquiry_selling_percentage='$product_selling_percent',
enquiry_selling_price='$product_selling_price',
enquiry_tax='$product_tax',
tax_inclusive='$product_tax_inclusive',
enquiry_total='$product_total',
product_remarks='$remarks',
product_status='$status'
WHERE id=".$id;

$sql1 = "SELECT * FROM customer_rfq_enquiry where delete_status<>1 and id = " . $id;
$result1 = mysqli_query($conn, $sql1);
$enquiry_product_result = mysqli_fetch_array($result1,MYSQLI_ASSOC);

if (mysqli_query($conn, $sql))
{
	echo $enquiry_product_result['enquiry_id'];
}

mysqli_close($conn);
?>