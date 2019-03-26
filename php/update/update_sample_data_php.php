<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';

	//Table Names 
	$tbl_name = "sample_data"; 

	//Store Posted Data To PHP Variable
	$v_catalogue_sample_id= mysqli_real_escape_string($conn,$_POST['catalogue_sample_id']);
	$v_catalogue_sample_name= mysqli_real_escape_string($conn,$_POST['catalogue_sample_name']);
	$v_brand_name= mysqli_real_escape_string($conn,$_POST['ui_brand_name']);
	$v_catalogue_sample_number= mysqli_real_escape_string($conn,$_POST['catalogue_sample_number']);
	$v_ui_type= mysqli_real_escape_string($conn,$_POST['ui_type']);
	$v_ui_section= mysqli_real_escape_string($conn,$_POST['ui_section']);
	$v_ui_description= mysqli_real_escape_string($conn,$_POST['ui_description']);

	//Update Query
	
	$sql="UPDATE $tbl_name SET 
	sample_catalogue_name='$v_catalogue_sample_name'	
	brand_id='$v_brand_name',	
	sample_catalogue_number='$v_catalogue_sample_number',
	sample_catalogue_type='$v_ui_type',
	sample_catalogue_section='$v_ui_section',
	sample_catalogue_description='$v_ui_description',
	WHERE sample_data_id=".$v_catalogue_sample_id;
	
	
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