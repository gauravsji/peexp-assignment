<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../dbconnect/dbconnect.php';
	//Table names
	$tbl_name="users";

	//Username and password sent from form
	$user_email = mysqli_real_escape_string($conn,$_POST['login_user_email']);
	$user_password = mysqli_real_escape_string($conn,$_POST['login_user_password']);
	$pass=md5($user_password);

	//Query
	$sql_query="SELECT * FROM $tbl_name WHERE user_email='$user_email'";
	$result=mysqli_query($conn,$sql_query);
	$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
	$count=mysqli_num_rows($result);// If result matched $email and $password, table row must be 1 rows
	$count_log=$row['login_count'];
	$count_log=$count_log+1;
	if($count==1)
	{	
		// Update the login count
		$sql = "UPDATE users SET login_count ='$count_log' WHERE user_email = '$user_email'";
		mysqli_query($conn, $sql);
		$sql1 = "SELECT * FROM $tbl_name where user_email ='$user_email'";
		$result1 = mysqli_query($conn, $sql1);
		$users_result = mysqli_fetch_array($result1,MYSQLI_ASSOC);
		$_SESSION['user_id'] = $users_result['user_id'];
		$_SESSION['user_name']= $users_result['user_name'];
		$_SESSION['user_email']=$users_result['user_email'];
		$_SESSION['user_password']=$users_result['user_password'];
		header("Location:../user_dashboard.php");
	}
	else
	{		
		//On Error
		$_SESSION['errMsg'] = "Invalid Email/password or user not authenticated ";
		header("Location:../signup.php");
	}
	//Close Mysqli Connection
	mysqli_close($conn);
?>