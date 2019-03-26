<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';
	include '../../php/add/add_activity_log.php';

	//Table Names
	$tbl_payment = "payment"; 

	//Store Posted Data To PHP Variable
	if(isset($_POST['ui_customer_name']))
	{
		$customer_id = mysqli_real_escape_string($conn,$_POST['ui_customer_name']);
	}
	else
	{
		$customer_id = "";
	}
	if(isset($_POST['ui_project_name']))
	{
		$project_id = mysqli_real_escape_string($conn,$_POST['ui_project_name']);
	}
	else
	{
		$project_id = "";
	}

	if(isset($_POST['ui_vendor_name']))
	{
		$vendor_id = mysqli_real_escape_string($conn,$_POST['ui_vendor_name']);
	}
	else
	{
		$vendor_id = "";
	}
	
	if(isset($_POST['ui_payment_method']))
	{
		$payment_method = mysqli_real_escape_string($conn,$_POST['ui_payment_method']);
	}
	else
	{
		$payment_method = "";
	}
	
	$quickbook_entry= mysqli_real_escape_string($conn,$_POST['ui_quickbook_entry']);
	$payment_type= mysqli_real_escape_string($conn,$_POST['ui_payment_type']);
	$date = explode('/', mysqli_real_escape_string($conn,$_POST['ui_date']));
	$time = mktime(0,0,0,$date[1],$date[0],$date[2]);
	$date = date( 'Y-m-d', $time );
	$amount= mysqli_real_escape_string($conn,$_POST['ui_amount']);
	$transaction_reference_number= mysqli_real_escape_string($conn,$_POST['ui_transaction_reference_number']);
	$payment_remarks= mysqli_real_escape_string($conn,$_POST['ui_payment_remarks']);
	$user_id= mysqli_real_escape_string($conn,$_POST['user_id']);
	$location=mysqli_real_escape_string($conn,$_POST['location']);
	
	//Insert Query
	$query = "INSERT INTO $tbl_payment(payment_date,customer_id,project_id,vendor_id,payment_amount,payment_type,payment_transaction_ref_no,payment_method,payment_remarks,quickbook_entry,data_entered_by,location,delete_status) VALUES ('$date','$customer_id','$project_id','$vendor_id','$amount','$payment_type','$transaction_reference_number','$payment_method','$payment_remarks','$quickbook_entry','$user_id','$location',0)";

	//Execute The Query
	if (mysqli_query($conn, $query)) 
	{
		//On Successful
		//Get Last Inserted ID
		$last_inserted_id=mysqli_insert_id($conn);
		fn_add_activity_log("Payment",$last_inserted_id,"Payment Added",$user_id,$conn);
		header("Location:../../html/add_payment_html.php");
	}
	else
	{
		//On Error 
		$_SESSION['error']=mysqli_error($conn);
		header("Location:../../extra/error.php");
	}
	//Close Mysqli Connection
	mysqli_close($conn);
?>