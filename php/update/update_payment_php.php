<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';

	//Table Names 
	$tbl_name = "payment"; 

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
	$payment_date = date( 'Y-m-d', $time );
	$amount= mysqli_real_escape_string($conn,$_POST['ui_amount']);
	$transaction_reference_number= mysqli_real_escape_string($conn,$_POST['ui_transaction_reference_number']);
	$payment_remarks= mysqli_real_escape_string($conn,$_POST['ui_payment_remarks']);
	$payment_id= mysqli_real_escape_string($conn,$_POST['ui_payment_id']);

	//Update Query
	$sql = "UPDATE $tbl_name
	SET 
	payment_date='$payment_date',
	customer_id='$customer_id',
	project_id='$project_id',
	vendor_id='$vendor_id',
	payment_amount='$amount',
	payment_type='$payment_type',
	payment_transaction_ref_no='$transaction_reference_number',
	payment_method='$payment_method',
	payment_remarks='$payment_remarks',
	quickbook_entry='$quickbook_entry'
	WHERE payment_id = '$payment_id'";

	//Execute The Query
	if (mysqli_query($conn, $sql)) 
	{
		//On Successful
		header("Location:../../html/view_payment_html.php?id=". $payment_id."");
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