<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';
	include '../../php/add/add_activity_log.php';

	//Table Names 
	$tbl_name = "enquiry_product"; 

	//Insert Query
	$quick_product_id=$_POST['qp_id'];
	$quick_product_quantity=$_POST['qp_quantity'];
	
	$sql = "SELECT * FROM quick_product where quick_product_id = " . $quick_product_id;
	$result = mysqli_query($conn, $sql);
	$qp_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
	
$enquiry_id=$_POST['draft_id'];
$enquiry_product_name=$qp_result['quick_product_name'];
$enquiry_product_description=$qp_result['quick_product_description'];
$enquiry_product_quantity=$quick_product_quantity;
$enquiry_buying_price=$qp_result['quick_product_bp'];
$enquiry_discount_percent=0;
$enquiry_discounted_price=$enquiry_buying_price;
$enquiry_selling_price=$qp_result['quick_product_sp'];
$enquiry_tax=$qp_result['quick_product_tax'];
$tax_inclusive=0;
$enquiry_remarks=NULL;
$enquiry_status='Available';
$delete_status=0;
$enquiry_total_of_buying=$enquiry_buying_price*$enquiry_product_quantity*(1+($enquiry_tax/100));
$enquiry_total=$enquiry_selling_price*$enquiry_product_quantity*(1+($enquiry_tax/100));
$enquiry_selling_percentage=($enquiry_selling_price*100/$enquiry_buying_price)-100;

	$query = "Insert into $tbl_name (enquiry_id,enquiry_product_name,enquiry_product_description,enquiry_product_quantity,enquiry_buying_price,enquiry_discount_percent,enquiry_discounted_price,enquiry_total_of_buying,enquiry_selling_percentage,enquiry_selling_price,enquiry_tax,tax_inclusive,enquiry_total,enquiry_remarks,enquiry_status,delete_status)
	values ($enquiry_id,'$enquiry_product_name','$enquiry_product_description',$enquiry_product_quantity,$enquiry_buying_price,$enquiry_discount_percent,$enquiry_discounted_price,$enquiry_total_of_buying,$enquiry_selling_percentage,$enquiry_selling_price,'$enquiry_tax',$tax_inclusive,$enquiry_total,'$enquiry_remarks','$enquiry_status',$delete_status)";

	//Execute The Query
	if (mysqli_query($conn, $query)) 		
	{
		$error=1;
		echo 'Success';
	}
	else
	{
		$error =  mysqli_error($con);
		echo $error;
	}
	//Get Last Inserted Id of Customer Table and Create an Adhoc Project a Customer
	
?>