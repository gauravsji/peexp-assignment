<?php
session_start();
include '../../dbconnect/dbconnect.php';

//Table name 
$tbl_name = "pre_enquiry_details"; 
$tb2_name = "pre_enquiry_product";

//Create a variable
$enquiry_date= mysqli_real_escape_string($conn,$_POST['enquiry_date']);
$enquiry_name= mysqli_real_escape_string($conn,$_POST['enquiry_name']);
$customer_name= mysqli_real_escape_string($conn,$_POST['customer_name']);
$enquiry_priority= mysqli_real_escape_string($conn,$_POST['enquiry_priority']);
$customer_email= mysqli_real_escape_string($conn,$_POST['customer_email']);
$contact_number= mysqli_real_escape_string($conn,$_POST['contact_number']);
$sales_assignee_name= mysqli_real_escape_string($conn,$_POST['sales_assignee_name']);
$vendor_assignee_name= mysqli_real_escape_string($conn,$_POST['vendor_assignee_name']);
$need_sample= mysqli_real_escape_string($conn,$_POST['need_sample']);
$need_alternate = mysqli_real_escape_string($conn,$_POST['need_alternate']);

$date = str_replace('/','-',$enquiry_date);
$chgdate =date('Y-m-d' , strtotime($date));

$query_dispatch = "INSERT INTO $tbl_name(enquiry_date,enquiry_name,customer_name,enquiry_priority,customer_email,contact_number,sales_assignee_name,vendor_assignee_name,need_sample,need_alternate) VALUES ('$chgdate','$enquiry_name','$customer_name','$enquiry_priority','$customer_email','$contact_number','$sales_assignee_name','$vendor_assignee_name','$need_sample','$need_alternate')";

mysqli_query($conn, $query_dispatch);
$last_id = mysqli_insert_id($conn);

	$pro_name=$_POST['pro_name'];
	$pro_description=$_POST['pro_description'];
	$pro_quantity=$_POST['pro_quantity'];

	foreach($pro_name as $a => $b)
	{
		//Pass each variable from php variable array to php variable
		$v_product_name=$pro_name[$a];
		$v_pro_description=$pro_description[$a];
		$v_pro_quantity=$pro_quantity[$a];
	$query_dispatch_product = "INSERT INTO $tb2_name(pre_enquiry_id,pro_name,pro_description,pro_quantity) VALUES ('$last_id','$v_product_name','$v_pro_description','$v_pro_quantity')";
mysqli_query($conn, $query_dispatch_product);
}	
mysqli_close($conn);
?>