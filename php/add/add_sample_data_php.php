<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';

	//Table Names 
	$tbl_name = "sample_data"; 

	//Store Posted Data To PHP Variable
	$v_catalogue_sample_name= mysqli_real_escape_string($conn,$_POST['catalogue_sample_name']);
	$v_brand_name= mysqli_real_escape_string($conn,$_POST['ui_brand_name']);
	$v_catalogue_sample_number= mysqli_real_escape_string($conn,$_POST['catalogue_sample_number']);
	$v_ui_type= mysqli_real_escape_string($conn,$_POST['ui_type']);
	$v_ui_section= mysqli_real_escape_string($conn,$_POST['ui_section']);
	$v_ui_description= mysqli_real_escape_string($conn,$_POST['ui_description']);
	$user_id= mysqli_real_escape_string($conn,$_POST['user_id']);
	$location=mysqli_real_escape_string($conn,$_POST['location']);

	//Insert Query
	$sql="INSERT INTO $tbl_name(sample_catalogue_name, brand_id, sample_catalogue_number, sample_catalogue_type,sample_catalogue_section, sample_catalogue_description,data_entered_by,location,delete_status) VALUES ('$v_catalogue_sample_name','$v_brand_name','$v_catalogue_sample_number','$v_ui_type','$v_ui_section','$v_ui_description','$user_id','$location',0)";
	if (mysqli_query($conn, $sql)) 
	{
		//On Successful
		header("Location:../../html/sample_data_html.php");
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