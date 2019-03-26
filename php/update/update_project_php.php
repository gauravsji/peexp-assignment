<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';

	//Table Names 
	$tbl_name = "project"; 

	//Store Posted Data To PHP Variable
	$project_id= mysqli_real_escape_string($conn,$_POST['project_id']);
	$customer_id= mysqli_real_escape_string($conn,$_POST['customer_id']);
	$project_name= mysqli_real_escape_string($conn,$_POST['project_name']);
	$client_name= mysqli_real_escape_string($conn,$_POST['client_name']);
	$site_address= mysqli_real_escape_string($conn,$_POST['site_address']);
	$site_incharge_name= mysqli_real_escape_string($conn,$_POST['site_incharge_name']);
	$type_of_project= mysqli_real_escape_string($conn,$_POST['type_of_project']);	
	$site_incharge_contact_number= mysqli_real_escape_string($conn,$_POST['project_incharge_contact_number']);
	$project_landmark= mysqli_real_escape_string($conn,$_POST['project_landmark']);
	$billing_details= mysqli_real_escape_string($conn,$_POST['billing_details']);

	//Update Query
	$sql = "UPDATE $tbl_name
	SET 
	customer_id='$customer_id',
	project_name='$project_name',
	project_client_name='$client_name',
	project_site_address='$site_address',
	project_site_incharge_name='$site_incharge_name',
	project_type_of_project='$type_of_project',
	project_site_incharge_contact_number='$site_incharge_contact_number',
	billing_details = '$billing_details',
	project_landmark='$project_landmark'
	WHERE project_id = '$project_id'";

	//Execute The Query
	if (mysqli_query($conn, $sql)) 
	{
		//On Successful
		header("Location:../../html/edit_project_html.php?id=". $project_id . "");
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