<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';
	// include '../../php/add/add_activity_log.php';

	//Table Names
	$tbl_category = "category";

	//Store Posted Data To PHP Variable
	$category_name= ucwords(mysqli_real_escape_string($conn,$_POST['category_name']));
	$category_description= mysqli_real_escape_string($conn,$_POST['category_description']);
	$location=mysqli_real_escape_string($conn,$_POST['location']);
	$user_id= mysqli_real_escape_string($conn,$_POST['user_id']);

	//Insert Query
	$query = "INSERT INTO $tbl_category(category_name,category_description,data_entered_by_customer,location,delete_status) VALUES ('$category_name','$category_description','$user_id','$location',0)";
	
	//Execute The Query
	if (mysqli_query($conn, $query))
	{
		//On Successful
		//Get Last Inserted ID
		$last_inserted_id=mysqli_insert_id($conn);
		echo "Done";
		// fn_add_activity_log("Category",$last_inserted_id,"Category Added",$user_id,$conn);
		// header("Location:../../html/add_category_html.php");
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
