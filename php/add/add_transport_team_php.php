<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';

	//Table Names 
	$tbl_name="transport_team"; 

	//Store Posted Data To PHP Variable
	$v_transport_person_name= ucwords(mysqli_real_escape_string($conn,$_POST['ui_transport_person_name']));
	$v_transport_contact_number= mysqli_real_escape_string($conn,$_POST['ui_transport_contact_number']);
	$v_transport_alternate_contact_number= mysqli_real_escape_string($conn,$_POST['ui_transport_alternate_contact_number']);
	$v_transport_company_name= ucwords(mysqli_real_escape_string($conn,$_POST['ui_company_name']));
	$v_transport_vehicle_name= mysqli_real_escape_string($conn,$_POST['ui_transport_vehicle_name']);
	$v_transport_vehicle_number= mysqli_real_escape_string($conn,$_POST['ui_vehicle_number']);
	$v_transport_load_capacity= mysqli_real_escape_string($conn,$_POST['ui_load_capacity']);
	$v_transport_vehicle_type= mysqli_real_escape_string($conn,$_POST['ui_vehicle_type']);
	$transport_team_email= strtolower(mysqli_real_escape_string($conn,$_POST['transport_team_email']));
	$transport_team_additional_info= mysqli_real_escape_string($conn,$_POST['transport_team_additional_info']);
	$location= mysqli_real_escape_string($conn,$_POST['location']);

	//Insert Query
	$sql = "INSERT INTO $tbl_name(transport_team_person_name,transport_team_contact_number,transport_team_alternate_contact_number,transport_team_company_name,transport_team_vehicle_name,transport_team_vehicle_number,transport_team_load_capacity,transport_team_vehicle_type,transport_team_email,transport_team_additional_info,location,delete_status) VALUES ('$v_transport_person_name','$v_transport_contact_number','$v_transport_alternate_contact_number','$v_transport_company_name','$v_transport_vehicle_name','$v_transport_vehicle_number','$v_transport_load_capacity','$v_transport_vehicle_type','$transport_team_email','$transport_team_additional_info','$location',0)";

	//Execute The Query
	if (mysqli_query($conn, $sql)) 
	{
		//On Successful
		header("Location:../../html/add_transport_team_html.php");
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