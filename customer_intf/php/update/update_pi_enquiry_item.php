<?php
session_start();
include '../../dbconnect/dbconnect.php';
include '../../constants.php';
//Table name
$tbl_name = "customer_rfq_enquiry";
$error=0;


//Create a variable
$product_id= mysqli_real_escape_string($conn,$_POST['product_id']);
$product_name= mysqli_real_escape_string($conn,$_POST['product_name']);
$product_description= mysqli_real_escape_string($conn,$_POST['product_description']);
$product_quantity= mysqli_real_escape_string($conn,$_POST['product_quantity']);
$remarks= mysqli_real_escape_string($conn,$_POST['product_remarks']);
$product_enquiry_id = $_POST['product_enquiry_id'];

$sql = "UPDATE $tbl_name
  SET
  product_name = '$product_name',
  product_description = '$product_description',
  product_remarks = '$remarks',
  product_quantity = $product_quantity,
  updated_at = CURDATE()
  WHERE id = $product_id";

		if(mysqli_query($conn, $sql))
		{
			$error=1;
		}
		else
		{	// fn_add_activity_log("Enquiry",0,mysqli_error($conn),$user_id,$conn);
		}

echo $product_enquiry_id;
mysqli_close($conn);
?>
