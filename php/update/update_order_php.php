<?php
	session_start();
	include '../../dbconnect/dbconnect.php';
	include '../../php/add/add_activity_log.php';
	//Include Connection PAGE

	//Table names 
	$tbl_ss_order = "ss_order";
	$tbl_order_product ="order_product";
	$tbl_order_transport ="order_transport";
	$tbl_order_account ="order_account";

	//Get order details data from edit_order_html.php 
	$date = explode('/', $_POST['ui_order_date']);
	$time = mktime(0,0,0,$date[1],$date[0],$date[2]);
	$order_date = date( 'Y-m-d', $time );
	$current_date = date('Y-m-d');

	$ss_order_id= $_POST['ui_ss_order_id'];
	$ord=$ss_order_id;
	
	$vendor_id= mysqli_real_escape_string($conn,$_POST['ui_vendor_name']);
	$customer_id= mysqli_real_escape_string($conn,$_POST['ui_customer_name']);
	$project_id= mysqli_real_escape_string($conn,$_POST['ui_project_name']);
	$brief_order_details= mysqli_real_escape_string($conn,$_POST['ui_brief_order_details']);
	$order_placed_by= mysqli_real_escape_string($conn,$_POST['ui_order_placed_by']);
	$confirmation_type= mysqli_real_escape_string($conn,$_POST['ui_confirmation_type']);
	$order_assignee_name= mysqli_real_escape_string($conn,$_POST['ui_assignee_name']);
	$vendor_assignee_name= mysqli_real_escape_string($conn,$_POST['ui_vendor_assignee_name']);
	$transport_assignee_name= mysqli_real_escape_string($conn,$_POST['ui_transport_assignee_name']);
	$order_status= mysqli_real_escape_string($conn,$_POST['ui_order_status']);
	$related_orders= mysqli_real_escape_string($conn,$_POST['ui_related_orders']);
	$order_remarks= mysqli_real_escape_string($conn,$_POST['ui_order_remarks']);
	$brief_order_details= mysqli_real_escape_string($conn,$_POST['ui_brief_order_details']);
	$user_id= mysqli_real_escape_string($conn,$_POST['user_id']);
	$with_bill= mysqli_real_escape_string($conn,$_POST['ui_with_bill']);
	
	//Update table ss_order 
	$sql_update_tbl_ss_order = "UPDATE $tbl_ss_order
	SET 
	order_date = '$order_date',
	vendor_id='$vendor_id',
	customer_id='$customer_id',
	project_id='$project_id',
	order_placed_by='$order_placed_by',
	order_confirmation_type='$confirmation_type',
	order_assignee='$order_assignee_name',
	vendor_assignee='$vendor_assignee_name',
	operations_assignee='$transport_assignee_name',
	order_status='$order_status',
	related_orders='$related_orders',
	order_remarks='$order_remarks',	
	order_brief_details='$brief_order_details',
	order_with_bill='$with_bill',
	last_update_date = '$current_date',
	data_entered_by='$user_id'
	WHERE order_id = '$ss_order_id'";
	if(mysqli_query($conn, $sql_update_tbl_ss_order))
	$error=1; 
	//If error=1 query executed successfully

	//Get transport data from edit_order_html.php 
	$v_transportation_type=mysqli_real_escape_string($conn,$_POST['ui_transport_type']);
	$v_transportation_charge=mysqli_real_escape_string($conn,$_POST['ui_transport_charge']);
	$ui_delivery_location=mysqli_real_escape_string($conn,$_POST['ui_delivery_location']);
	$v_delivery_remarks=mysqli_real_escape_string($conn,$_POST['ui_delivery_remarks']);
	
	$date = explode('/', mysqli_real_escape_string($conn,$_POST['ui_delivery_date']));
	$time = mktime(0,0,0,$date[1],$date[0],$date[2]);
	$v_delivery_date = date( 'Y-m-d', $time );

	$sql_update_tbl_order_transport = "UPDATE $tbl_order_transport
	SET 
	order_transportation_type = '$v_transportation_type',
	order_transportation_charge='$v_transportation_charge',
	order_delivery_location='$ui_delivery_location',
	order_delivery_date='$v_delivery_date',
	order_delivery_remarks='$v_delivery_remarks'
	WHERE order_id = '$ss_order_id'";

	if(mysqli_query($conn, $sql_update_tbl_order_transport))
	$error=1; //If error=1 query executed successfully

	//Get accounts data from edit_order_html.php
	$v_estimate_number=mysqli_real_escape_string($conn,$_POST['ui_estimate_number']);
	$v_e_sugam_number=mysqli_real_escape_string($conn,$_POST['ui_e_sugam_number']);
	$v_purchase_bill_number=mysqli_real_escape_string($conn,$_POST['ui_purchase_bill_number']);
	$v_ss_invoice_number=mysqli_real_escape_string($conn,$_POST['ui_ss_invoice_number']);
	
	
	$sql_update_tbl_order_account= "UPDATE $tbl_order_account
	SET 
	order_estimate_number = '$v_estimate_number',
	order_e_sugam_number='$v_e_sugam_number',
	order_purchase_bill_number='$v_purchase_bill_number',
	order_ss_invoice_number='$v_ss_invoice_number'
	WHERE order_id = '$ss_order_id'";

	
	if(mysqli_query($conn, $sql_update_tbl_order_account))
	{
	$error=1; //If error=1 query executed successfully
	fn_add_activity_log("Order",$ss_order_id,"Order Updated",$user_id,$conn);
	}
	echo mysqli_error($conn);
	header("Location:../../html/edit_order_html.php?id=". $ord . "");
	mysqli_close($conn);
	//Close Mysql connection

?>