<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';
	include '../../constants.php';
	// include '../../php/add/add_activity_log.php';

	//Table Names
	$tbl_name = "customer";
	$tbl_contact="contacts";

	//Store Posted Data To PHP Variable
	$customer_id= mysqli_real_escape_string($conn,$_POST['customer_id']);
	$customer_name= ucwords(mysqli_real_escape_string($conn,$_POST['customer_name']));
	$customer_contact_number= mysqli_real_escape_string($conn,$_POST['contact_number']);
	$customer_email= strtolower(mysqli_real_escape_string($conn,$_POST['customer_email']));
	$category = implode(',',$_POST['ui_category_name']);
	$user_id=mysqli_real_escape_string($conn,$_POST['user_id']);
	$role = ($_POST['ui_customer_role'] == "admin"? "user_admin":"user_user");

	//Update Query
	$sql = "UPDATE $tbl_name
	SET
	customer_name = '$customer_name',
	customer_contact_number='$customer_contact_number',
	customer_email='$customer_email',
	category = '$category',
	role = '$role'
	WHERE customer_id = '$customer_id'";

	//Execute The Query
	if (mysqli_query($conn, $sql))
	{
		$error=1;
	}
	if($error==1)
	{
		//On Successful
		// fn_add_activity_log("Customer",$customer_id,"Customer Updated",$user_id,$conn);
		header("Location:".$GLOBALS['view_user_html']."?id=". $customer_id . "");
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
