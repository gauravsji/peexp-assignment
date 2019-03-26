<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';

	//Table Names
	$tbl_name = "transport_team"; 

	//Store Posted Data To PHP Variable
	$v_transport_team_id= mysqli_real_escape_string($conn,$_POST['ui_transport_team_id']);
	$v_transport_person_name= mysqli_real_escape_string($conn,$_POST['ui_transport_person_name']);
	$v_transport_contact_number= mysqli_real_escape_string($conn,$_POST['ui_transport_contact_number']);
	$v_transport_alternate_contact_number= mysqli_real_escape_string($conn,$_POST['ui_transport_alternate_contact_number']);
	$v_transport_company_name= mysqli_real_escape_string($conn,$_POST['ui_company_name']);
	$v_transport_vehicle_name= mysqli_real_escape_string($conn,$_POST['ui_transport_vehicle_name']);
	$v_transport_vehicle_number= mysqli_real_escape_string($conn,$_POST['ui_vehicle_number']);
	$v_transport_load_capacity= mysqli_real_escape_string($conn,$_POST['ui_load_capacity']);
	$v_transport_vehicle_type= mysqli_real_escape_string($conn,$_POST['ui_vehicle_type']);
	$transport_team_email= mysqli_real_escape_string($conn,$_POST['transport_team_email']);
	$transport_team_additional_info= mysqli_real_escape_string($conn,$_POST['transport_team_additional_info']);

	$sql = "UPDATE $tbl_name
			SET 
			transport_team_person_name='$v_transport_person_name',
			transport_team_contact_number='$v_transport_contact_number',
			transport_team_alternate_contact_number='$v_transport_alternate_contact_number',
			transport_team_company_name='$v_transport_company_name',
			transport_team_vehicle_name='$v_transport_vehicle_name',
			transport_team_vehicle_number='$v_transport_vehicle_number',
			transport_team_load_capacity='$v_transport_load_capacity',
			transport_team_vehicle_type='$v_transport_vehicle_type',
			transport_team_email='$transport_team_email',
			transport_team_additional_info='$transport_team_additional_info'
			WHERE transport_team_id = '$v_transport_team_id'";
	if (mysqli_query($conn, $sql)) 
	{
		//On Successful
		header("Location:../../reports/transport_team_report_html.php");
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