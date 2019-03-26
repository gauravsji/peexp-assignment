<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';

	//Table Names 
	$tbl_name = "sample_log"; 

	//Store Posted Data To PHP Variable
	$date = explode('/', $_POST['ui_date']);
	$time = mktime(0,0,0,$date[1],$date[0],$date[2]);
	$v_date = date( 'Y-m-d', $time );

	$v_vendor_name= mysqli_real_escape_string($conn,$_POST['ui_vendor_name']);
	$v_brand_name= mysqli_real_escape_string($conn,$_POST['ui_brand_name']);
	$v_sample_type= mysqli_real_escape_string($conn,$_POST['ui_sample_type']);
	$v_sample_status= mysqli_real_escape_string($conn,$_POST['ui_sample_status']);
	$v_sample_description= mysqli_real_escape_string($conn,$_POST['ui_sample_description']);
	$user_id= mysqli_real_escape_string($conn,$_POST['user_id']);
	$location=mysqli_real_escape_string($conn,$_POST['location']);

	//Insert Query
	$sql = "INSERT INTO $tbl_name(vendor_id,brand_id,sample_date,sample_type,sample_status,sample_description,data_entered_by,location,delete_status) VALUES ('$v_vendor_name','$v_brand_name','$v_date','$v_sample_type','$v_sample_status','$v_sample_description','$user_id','$location',0)";

	if (mysqli_query($conn, $sql)) 
	{
		//On Successful
		header("Location:../../html/sample_log_html.php");
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