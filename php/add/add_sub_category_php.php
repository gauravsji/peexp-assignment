<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';

	//Table Names 
	$tbl_sub_category = "sub_category"; 

	//Store Posted Data To PHP Variable
	$category_id=mysqli_real_escape_string($conn,$_POST['ui_category']); 
	$sub_category_name= mysqli_real_escape_string($conn,$_POST['ui_sub_category_name']);
	$sub_category_description= mysqli_real_escape_string($conn,$_POST['ui_sub_category_description']);
	$user_id= mysqli_real_escape_string($conn,$_POST['user_id']);
	$location=mysqli_real_escape_string($conn,$_POST['location']);

	//Insert Query
	$query = "INSERT INTO $tbl_sub_category(category_id,sub_category_name,sub_category_description,data_entered_by,location,delete_status) VALUES ('$category_id','$sub_category_name','$sub_category_description','$user_id','$location',0)";

	//Execute The Query
	if (mysqli_query($conn, $query)) 
	{
		//On Successful
		header("Location:../../html/add_sub_category_html.php");
	}
	else
	{
		//On Error 
		echo mysqli_error($conn);
		header("Location:../../extra/error.php");
	}
	//Close Mysqli Connection
	mysqli_close($conn);
?>