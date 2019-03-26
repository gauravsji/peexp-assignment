<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';

	//Table names 
	$tbl_key_value = "key_value"; 

	//Store Posted Data To PHP Variable
	$key_name= strtoupper(mysqli_real_escape_string($conn,$_POST['ui_key_column_name']));
	$key_value= ucfirst(mysqli_real_escape_string($conn,$_POST['ui_key_values']));

	//Insert Query
	$query = "INSERT INTO $tbl_key_value(key_column,value,delete_status) VALUES ('$key_name','$key_value',0)";

	//Execute The Query
	if (mysqli_query($conn, $query)) 
	{
		//On Successful
		header("Location:../../html/add_key_value_html.php");
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