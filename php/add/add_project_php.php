<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';

	//Table Names 
	$tbl_project = "project"; 
	
	//Store Posted Data To PHP Variable
	$customer_id= mysqli_real_escape_string($conn,$_POST['customer_id']);
	$project_name= ucwords(mysqli_real_escape_string($conn,$_POST['project_name']));
	$client_name= ucwords(mysqli_real_escape_string($conn,$_POST['client_name']));
	$site_address= mysqli_real_escape_string($conn,$_POST['site_address']);
	$site_incharge_name= ucwords(mysqli_real_escape_string($conn,$_POST['site_incharge_name']));
	$site_incharge_contact_number= mysqli_real_escape_string($conn,$_POST['project_incharge_contact_number']);
	$type_of_project= mysqli_real_escape_string($conn,$_POST['type_of_project']);
	$project_landmark= mysqli_real_escape_string($conn,$_POST['project_landmark']);
	$billing_details= mysqli_real_escape_string($conn,$_POST['billing_details']);

	//Fetch Billing Details from Customer
	if($billing_details === '') {
	$query = "SELECT * FROM customer WHERE delete_status<>1 and customer_id = ".$customer_id;
    $result2 = mysqli_query($conn, $query);
	$customer_result = mysqli_fetch_array($result2,MYSQLI_ASSOC);
	
	$billing_details = $customer_result['billing_address'];
	}

	//Insert Query
	$query = "INSERT INTO $tbl_project(customer_id,project_name,project_client_name,project_site_address,project_site_incharge_name,project_type_of_project,project_site_incharge_contact_number,project_landmark,billing_details,delete_status) VALUES ('$customer_id','$project_name','$client_name','$site_address','$site_incharge_name','$type_of_project','$site_incharge_contact_number','$project_landmark','$billing_details',0)";

	if ($customer_id == 53) //only Oravel copied to smartstorey
	{
		$query_duplicate = "INSERT INTO $tbl_project(customer_id,project_name,project_client_name,project_site_address,project_site_incharge_name,project_type_of_project,project_site_incharge_contact_number,project_landmark,billing_details,delete_status) VALUES (67,'$project_name','$client_name','$site_address','$site_incharge_name','$type_of_project','$site_incharge_contact_number','$project_landmark','$billing_details',0)";
		mysqli_query($conn, $query_duplicate);
	}
	
	//Execute The Query
	if (mysqli_query($conn, $query)) 
	{
		//On Successful
		header("Location:../../html/add_project_html.php");
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