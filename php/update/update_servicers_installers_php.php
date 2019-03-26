<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';

	//Table Names 
	$tbl_service = "service_installer"; 
	
	$error=0;

	//Store Posted Data To PHP Variable
	$service_installer_id=mysqli_real_escape_string($conn,$_POST['ui_service_installer_id']);
	$servicers_installers_name= ucwords(mysqli_real_escape_string($conn,$_POST['ui_servicers_installers_name']));
	$servicers_installers_contact_number= mysqli_real_escape_string($conn,$_POST['ui_servicers_installers_contact_number']);
	$servicers_installers_alternate_contact_number= mysqli_real_escape_string($conn,$_POST['ui_servicers_installers_alternate_contact_number']);
	$servicers_installers_email= strtolower(mysqli_real_escape_string($conn,$_POST['ui_servicers_installers_email']));
	$servicers_installers_about= mysqli_real_escape_string($conn,$_POST['ui_servicers_installers_about']);
	$servicers_installers_type= mysqli_real_escape_string($conn,$_POST['ui_servicers_installers_type']);
	$servicers_installers_info= mysqli_real_escape_string($conn,$_POST['ui_servicers_installers_info']);

	//Insert Query
	$query = "UPDATE $tbl_service 
	SET 
	service_installer_name='$servicers_installers_name',
	service_installer_contact_number='$servicers_installers_contact_number',
	service_installer_alternate_contact_number='$servicers_installers_alternate_contact_number',
	service_installer_email='$servicers_installers_email',
	service_installer_about='$servicers_installers_about',
	service_installer_type='$servicers_installers_type',
	service_installer_info='$servicers_installers_info' 
	WHERE service_installer_id=".$service_installer_id;

	//Execute The Query
	if (mysqli_query($conn, $query)) 
	{
		$error=1;
	}
		 mysqli_error($conn);
	
	if ($error==1) 
	{
		//On Successful
		header("Location:../../html/edit_servicers_installers_html.php?id=".$service_installer_id);
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
