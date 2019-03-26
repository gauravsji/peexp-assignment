<?php
session_start();
include '../../dbconnect/dbconnect.php';

//Table name
$tbl_name = "customer_rfq_enquiry";
$error=0;

//Create a variable

$draft_id= mysqli_real_escape_string($conn,$_POST['draft_id']);
$product_name= mysqli_real_escape_string($conn,$_POST['product_name']);
$product_id = mysqli_real_escape_string($conn,$_POST['product_id']);
$temp_product_id=($product_id == "")?NULL:$product_id;
$product_description= mysqli_real_escape_string($conn,$_POST['product_description']);
$product_quantity= mysqli_real_escape_string($conn,$_POST['product_quantity']);
$remarks= mysqli_real_escape_string($conn,$_POST['product_remarks']);
$status= mysqli_real_escape_string($conn,'');
// $image= $_FILES['product_image'];
// var_dump($image);
// die();
$sql = "INSERT INTO $tbl_name(
	product_enquiry_id,product_name,product_id,product_description,product_quantity
	,product_remarks,product_status,delete_status,created_at,updated_at)
	 VALUES ('$draft_id','$product_name','$product_id','$product_description','$product_quantity',
		 '$remarks','$status',0,CURDATE(),CURDATE())";

//mysqli_query($conn, $sql);
		if(mysqli_query($conn, $sql))
		{
			$error=1;
		}
		else
		{
			// fn_add_activity_log("Enquiry",0,mysqli_error($conn),$user_id,$conn);
		}

var_dump($sql);
$last_id = mysqli_insert_id($conn);
echo $last_id;
mysqli_close($conn);
?>
