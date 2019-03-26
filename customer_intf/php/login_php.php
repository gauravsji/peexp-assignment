<?php
	session_start();

	include '../dbconnect/dbconnect.php';
  // include '../../php/add/add_activity_log.php';
	include '../extra/roles_permissions.php';
	// var_dump($conn);
	//Table names
	$tbl_name="customer";
	$tbl_roles = "roles_and_permissions";
	//Username and password sent from form
	$firm = mysqli_real_escape_string($conn,$_POST['firm_name']);
	$email = mysqli_real_escape_string($conn,$_POST['login_email']);
	$pass = mysqli_real_escape_string($conn,$_POST['login_password']);

	$pass=md5($pass);

	//Query
	$sql_query="SELECT * FROM $tbl_name WHERE customer_email='$email' and password='$pass' and firm_name = '$firm' and approved =1";
	$result=mysqli_query($conn,$sql_query);
	$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
	$count=mysqli_num_rows($result);// If result matched $email and $password, table row must be 1 rows
	$count_log=$row['login_count'];
	$count_log=$count_log+1;

	if($count == 1)
	{
		// Update the login count
		$sql = "UPDATE $tbl_name SET login_count ='$count_log' WHERE email = '$email'";

		mysqli_query($conn, $sql);

		$sql1 = "SELECT * FROM $tbl_name where customer_email ='$email'";
		$result1 = mysqli_query($conn, $sql1);

		$users_result = mysqli_fetch_array($result1,MYSQLI_ASSOC);

		// fn_add_activity_log("Users",$users_result['id'],$users_result['name']." Logged In",$users_result['id'],$conn);

		//Setting the role of the user
		$role = $users_result['role'];
		//Get the User Roles and Permissions
		$permissionArray = role_activity_permissions($role,$conn);

		//Assign values to the variables
		$_SESSION['id']= $users_result['customer_id'];
		$_SESSION['name'] = $users_result['customer_name'];
		$_SESSION['email_address'] = $users_result['customer_email'];
		$_SESSION['firm_name'] = $users_result['firm_name'];
		$_SESSION['role'] = $users_result['role'];
		$_SESSION['location'] = $users_result['customer_city'];
		$_SESSION['permissions'] = $permissionArray;
		$_SESSION['groupId'] = $users_result['subset'];
		// if($users_result['subset'] == $users_result['customer_id'])
		// {
		// 	$idsArray = [];
		// 	$subsetId = $users_result['subset'];
		// 	$idsQuery = "SELECT * FROM $tbl_name WHERE subset ='$subsetId'";
		// 	$results = mysqli_query($conn, $idsQuery);
		// 	while($row = mysqli_fetch_array($results))
		// 	{
		// 		array_push($idsArray,$row['customer_id']);
		// 	}
		// 	$_SESSION['ids'] = $idsArray;
		// }
		// else {
		// 	$_SESSION['ids'] = [$users_result['customer_id']];
		// }
		//Redirect to home page on successful login
		header("Location:../php/dashboard.php");

	}
	else
	{
		//On Error
		$_SESSION['errMsg'] = "Invalid Firm Name/Email/password or user not authenticated ";
		header("Location:../html/login_html.php");
	}
	//Close Mysqli Connection
	mysqli_close($conn);
?>
