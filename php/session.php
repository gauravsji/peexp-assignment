<?php 
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	$host = "localhost";
	$username = "root";
	$password = "";
	$dbname = "peerxp";

	// Create connection
	$conn = mysqli_connect($host, $username, $password, $dbname);

	//code for file.php
	if(!isset($_SESSION['user_id']))
	{
		header("Location:../index.php"); 
		exit();
	}
	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 14400)) {
    //Last request was more than 48 hrs ago
	    session_unset();     // unset $_SESSION variable for the run-time 
	    session_destroy();   // destroy session data in storage
		session_start();
		$_SESSION['errMsg']='No activity from last 2 days, please login again';
		header("Location:../index.php"); 
	}
	$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
	$user_id=$_SESSION['user_id'];
	$sql = "SELECT user_id,user_name,user_email,login_count,user_mobile FROM users where user_id='" . $user_id."'";
	$result = mysqli_query($conn, $sql);
	$user_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
	echo mysqli_error($conn);
?>