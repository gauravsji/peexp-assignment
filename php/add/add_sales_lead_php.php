<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';
	include '../../php/add/add_activity_log.php';\

	//Table Names 
	$tbl_name = "sales_lead"; 

	//Store Posted Data To PHP Variable
	$sales_lead_name=  ucwords(mysqli_real_escape_string($conn,$_POST['sales_lead_name']));
	$sales_lead_contact_number=  mysqli_real_escape_string($conn,$_POST['sales_lead_contact_number']);
	$sales_lead_email=  strtolower(mysqli_real_escape_string($conn,$_POST['sales_lead_email']));
	$sales_lead_city=  mysqli_real_escape_string($conn,$_POST['sales_lead_city']);
	$sales_lead_firm_name=  ucwords(mysqli_real_escape_string($conn,$_POST['sales_lead_firm_name']));
	$sales_lead_reference=  ucwords(mysqli_real_escape_string($conn,$_POST['sales_lead_reference']));
	$sales_lead_address= mysqli_real_escape_string($conn,$_POST['sales_lead_address']);
	$sales_lead_additional_info=mysqli_real_escape_string($conn,$_POST['sales_lead_additional_info']);
	$location=mysqli_real_escape_string($conn,$_POST['location']);
	$user_id= mysqli_real_escape_string($conn,$_POST['user_id']);
	$sales_lead_status= mysqli_real_escape_string($conn,$_POST['ui_sales_lead_status']);

	//Insert Query
	$sql = "INSERT INTO $tbl_name(sales_lead_name,sales_lead_contact_number,sales_lead_firm,sales_lead_email,sales_lead_city,sales_lead_address,sales_lead_reference,sales_lead_additional_info,sales_lead_status,data_entered_by,location,delete_status) VALUES ('$sales_lead_name','$sales_lead_contact_number','$sales_lead_firm_name','$sales_lead_email','$sales_lead_city','$sales_lead_address','$sales_lead_reference','$sales_lead_additional_info','$sales_lead_status','$user_id','$location',0)";
	
	//Execute The Query
	if(mysqli_query($conn, $sql)) 
	$error=1;

	 if ($error==1) 
	{
		//On Successful
		//Get Last Inserted ID
		$last_inserted_id=mysqli_insert_id($conn);
		fn_add_activity_log("Sales Lead",$last_inserted_id,"Sales Lead Added",$user_id,$conn);
		header("Location:../../html/add_sales_lead_html.php");
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