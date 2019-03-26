<?php
	//Start New Or Resume Existing Session
	session_start();

	//Include Database Connection
	include '../../dbconnect/dbconnect.php';
	include '../../php/add/add_activity_log.php';

	//Table names
	$tbl_name="users";

	//Username and password sent from form
	$email = mysqli_real_escape_string($conn,$_POST['login_email']);
	$pass = mysqli_real_escape_string($conn,$_POST['login_password']);

	$pass=md5($pass);

	//Query
	$sql_query="SELECT * FROM $tbl_name WHERE email='$email' and password='$pass' and authenticate=1";
	$result=mysqli_query($conn,$sql_query);
	$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
	$count=mysqli_num_rows($result);// If result matched $email and $password, table row must be 1 rows
	$count_log=$row['login_count'];
	$count_log=$count_log+1;
	if($count==1)
	{
		// Update the login count
		$sql = "UPDATE users SET login_count ='$count_log' WHERE email = '$email'";
		mysqli_query($conn, $sql);

		$sql1 = "SELECT * FROM $tbl_name where email ='$email'";
		$result1 = mysqli_query($conn, $sql1);
		$users_result = mysqli_fetch_array($result1,MYSQLI_ASSOC);

		fn_add_activity_log("Users",$users_result['id'],$users_result['name']." Logged In",$users_result['id'],$conn);

		$_SESSION['name']= $users_result['name'];
		$_SESSION['id'] = $users_result['id'];
		$_SESSION['email_address']=$users_result['email'];
		//Redirect to home page on successful login
		header("Location:../../html/dashboard.php");
	}
	else
	{
		//On Error
		$_SESSION['errMsg'] = "Invalid Email/password or user not authenticated ";
		header("Location:../../html/login_html.php");
	}
	//Close Mysqli Connection
	mysqli_close($conn);
?>
