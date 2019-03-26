<?php
session_start();
include '../../dbconnect/dbconnect.php';

//Table name 
$tbl_name = "pre_enquiry_details"; 
$tb2_name = "pre_enquiry_product";

//Create a variable
$enquiry_id= mysqli_real_escape_string($conn,$_POST['edit_enquiry_id']);
//$pre_enquiry_product_id= mysqli_real_escape_string($conn,$_POST['edit_enquiry_product_id']);
$enquiry_name= mysqli_real_escape_string($conn,$_POST['enquiry_name']);
$customer_name= mysqli_real_escape_string($conn,$_POST['customer_name']);
$enquiry_priority= mysqli_real_escape_string($conn,$_POST['enquiry_priority']);
$customer_email= mysqli_real_escape_string($conn,$_POST['customer_email']);
$contact_number= mysqli_real_escape_string($conn,$_POST['contact_number']);
$sales_assignee_name= mysqli_real_escape_string($conn,$_POST['sales_assignee_name']);
$vendor_assignee_name= mysqli_real_escape_string($conn,$_POST['vendor_assignee_name']);
$need_sample= mysqli_real_escape_string($conn,$_POST['need_sample']);
$need_alternate = mysqli_real_escape_string($conn,$_POST['need_alternate']);

$query_dispatch = "UPDATE $tbl_name SET
enquiry_name='$enquiry_name',
customer_name='$customer_name',
enquiry_priority='$enquiry_priority',
customer_email='$customer_email',
contact_number='$contact_number',
sales_assignee_name='$sales_assignee_name',
vendor_assignee_name='$vendor_assignee_name',
need_sample='$need_sample',
need_alternate='$need_alternate'
WHERE pre_enquiry_id=".$enquiry_id;

mysqli_query($conn, $query_dispatch);

	$pro_quantity=$_POST['pro_quantity'];
	$pre_enquiry_product_array=$_POST['edit_enquiry_product_id'];

	
	foreach($pro_quantity as $a => $b)
	{
		//Pass each variable from php variable array to php variable
		
		$v_pro_quantity=$pro_quantity[$a];
		$v_pre_enquiry_product_array=$pre_enquiry_product_array[$a];
		
	$query_dispatch_product = "UPDATE $tb2_name SET 
	pro_quantity='$v_pro_quantity'
	WHERE pre_enquiry_product_id=".$v_pre_enquiry_product_array;
}
mysqli_query($conn, $query_dispatch_product);

	$edit_pro_names=$_POST['edit_pro_names'];
	$edit_pro_descriptions=$_POST['edit_pro_descriptions'];
	$edit_pro_quantitys=$_POST['edit_pro_quantitys'];

	foreach($edit_pro_names as $a => $b)
	{
		//Pass each variable from php variable array to php variable
		$v_edit_pro_names=$edit_pro_names[$a];
		$v_edit_pro_descriptions=$edit_pro_descriptions[$a];
		$v_edit_pro_quantitys=$edit_pro_quantitys[$a];
	$query_dispatch_products = "INSERT INTO $tb2_name(pre_enquiry_id,pro_name,pro_description,pro_quantity) VALUES ('$enquiry_id','$v_edit_pro_names','$v_edit_pro_descriptions','$v_edit_pro_quantitys')";
mysqli_query($conn, $query_dispatch_products);
}	
mysqli_close($conn);
?>