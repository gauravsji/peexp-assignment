<?php
session_start();
include '../../dbconnect/dbconnect.php';

//Table name 
$tbl_name = "enquiry_product"; 
	$error=0;


//Create a variable
$draft_id= mysqli_real_escape_string($conn,$_POST['draft_id']);
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
$remarks= mysqli_real_escape_string($conn,$_POST['remarks']);
$status= mysqli_real_escape_string($conn,$_POST['status']);

$product_total= mysqli_real_escape_string($conn,$_POST['product_total']);

$sql = "INSERT INTO $tbl_name(enquiry_id,enquiry_product_name,enquiry_product_description,enquiry_product_quantity,enquiry_buying_price,enquiry_discount_percent,enquiry_discounted_price,enquiry_total_of_buying,enquiry_selling_percentage,enquiry_selling_price,enquiry_tax,tax_inclusive,enquiry_total,enquiry_remarks,enquiry_status,delete_status) VALUES ('$draft_id','$product_name','$product_description','$product_quantity','$product_buying_price','$product_discount_price','$discounted_price','$total_of_buying','$product_selling_percent','$product_selling_price','$product_tax','$product_tax_inclusive','$product_total','$remarks','$status',0)";
//mysqli_query($conn, $sql);
		if(mysqli_query($conn, $sql))
		{
			$error=1;
		}
		else
		{
			fn_add_activity_log("Enquiry",0,mysqli_error($conn),$user_id,$conn);
		}
$last_id = mysqli_insert_id($conn); 
echo $last_id;
mysqli_close($conn);
?>