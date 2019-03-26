<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';

	//Table Names 
	$tbl_service = "service_installer"; 
	
	$error=0;

	//Store Posted Data To PHP Variable
	$servicers_installers_name= ucwords(mysqli_real_escape_string($conn,$_POST['ui_servicers_installers_name']));
	$servicers_installers_contact_number= mysqli_real_escape_string($conn,$_POST['ui_servicers_installers_contact_number']);
	$servicers_installers_alternate_contact_number= mysqli_real_escape_string($conn,$_POST['ui_servicers_installers_alternate_contact_number']);
	$servicers_installers_email= strtolower(mysqli_real_escape_string($conn,$_POST['ui_servicers_installers_email']));
	$servicers_installers_about= mysqli_real_escape_string($conn,$_POST['ui_servicers_installers_about']);
	$servicers_installers_type= mysqli_real_escape_string($conn,$_POST['ui_servicers_installers_type']);
	$servicers_installers_info= mysqli_real_escape_string($conn,$_POST['ui_servicers_installers_info']);
	$location=mysqli_real_escape_string($conn,$_POST['location']);
	$user_id= mysqli_real_escape_string($conn,$_POST['user_id']);

	//Insert Query
	$query = "INSERT INTO $tbl_service(service_installer_name, service_installer_contact_number, service_installer_alternate_contact_number, service_installer_email, service_installer_about, service_installer_type, service_installer_info,data_entered_by,location,delete_status) VALUES ('$servicers_installers_name','$servicers_installers_contact_number','$servicers_installers_alternate_contact_number','$servicers_installers_email','$servicers_installers_about','$servicers_installers_type','$servicers_installers_info','$user_id','$location',0)";
	
	//Execute The Query
	if (mysqli_query($conn, $query)) 
	{
		$error=1;
	}
	
	
	
	if ($error==1) 
	{
		//On Successful
		header("Location:../../html/add_servicers_installers.php");
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
