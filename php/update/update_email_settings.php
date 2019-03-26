<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';

	//Table Names 
	$tbl_name = "email_settings";

	$error=0;
	
	//Store Posted Data To PHP Variable
	$ui_email_settings_id= mysqli_real_escape_string($conn,$_POST['ui_email_settings_id']);
	$ui_module_name= strtoupper(mysqli_real_escape_string($conn,$_POST['ui_module_name']));
	$ui_email_address= strtolower (mysqli_real_escape_string($conn,$_POST['ui_email_address']));
	$ui_email_subject= mysqli_real_escape_string($conn,$_POST['ui_email_subject']);
	$ui_email_body= mysqli_real_escape_string($conn,$_POST['ui_email_body']);
	$ui_email_host= strtolower (mysqli_real_escape_string($conn,$_POST['ui_email_host']));
	$ui_email_password= mysqli_real_escape_string($conn,$_POST['ui_email_password']);
	$ui_email_port= mysqli_real_escape_string($conn,$_POST['ui_email_port']);
	
	//Update Query
	$sql = "UPDATE $tbl_name
	SET 
	email_module='$ui_module_name',
	email_address='$ui_email_address',
	email_subject='$ui_email_subject',
	email_body='$ui_email_body',
	email_host='$ui_email_host',
	email_password='$ui_email_password',
	email_port='$ui_email_port'
	WHERE email_settings_id = '$ui_email_settings_id'";

	//Execute The Query
	if (mysqli_query($conn, $sql)) 
	{
		$error=1;
	}	

	if ($error==1) 
	{
		//On Successful
		header("Location:../../html/edit_email_settings_html.php?id=". $ui_email_settings_id . "");
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