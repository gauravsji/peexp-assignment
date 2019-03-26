<?php
session_start();
include '../../dbconnect/dbconnect.php';

//Table name 
$tbl_name = "pre_enquiry_vendor_details"; 
$tb2_name = "pre_enquiry_vendor_product";

//Create a variable
$vendor_name= mysqli_real_escape_string($conn,$_POST['vendor_name']);
$vendor_number= mysqli_real_escape_string($conn,$_POST['vendor_number']);
$vendor_email= mysqli_real_escape_string($conn,$_POST['vendor_email']);
$vendor_assignee_name= mysqli_real_escape_string($conn,$_POST['vendor_assignee_name1']);
$enquiry_id=$_POST['enquiry_id'];
	foreach($enquiry_id as $c => $d)
	{
		//Pass each variable from php variable array to php variable
		$v_enquiry_id=$enquiry_id[$c];
	}
$query_dispatch = "INSERT INTO $tbl_name(enquiry_id,vendor_name,vendor_number,vendor_email,vendor_assignee_name) VALUES ('$v_enquiry_id','$vendor_name','$vendor_number','$vendor_email','$vendor_assignee_name')";
mysqli_query($conn, $query_dispatch);
$last_id = mysqli_insert_id($conn);


	$product_id=$_POST['product_id'];
	$pro_name_modal=$_POST['pro_name_modal'];
	$pro_description_modal=$_POST['pro_description_modal'];
	$pro_quantity_modal=$_POST['pro_quantity_modal'];
	$pro_price=$_POST['pro_price'];
	$tax_type=$_POST['tax_type'];
	$tax_rate=$_POST['tax_rate'];


	foreach($pro_name_modal as $a => $b)
	{
		//Pass each variable from php variable array to php variable
		$v_product_name=$pro_name_modal[$a];
		$v_pro_description=$pro_description_modal[$a];
		$v_pro_quantity=$pro_quantity_modal[$a];
		$v_product_id=$product_id[$a];
		$v_pro_price=$pro_price[$a];
		$v_tax_type=$tax_type[$a];
		$v_exclusive_tax=$tax_rate[$a];
	$query_dispatch_product = "INSERT INTO $tb2_name(enquiry_id,product_id,pre_enquiry_vendor_id,pro_name,pro_description,pro_quantity,pro_price,tax_type,exclusive_tax) VALUES ('$v_enquiry_id','$v_product_id','$last_id','$v_product_name','$v_pro_description','$v_pro_quantity','$v_pro_price','$v_tax_type','$v_exclusive_tax')";
mysqli_query($conn, $query_dispatch_product);
}
mysqli_close($conn);
?>