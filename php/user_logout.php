<?php
	//Start New Or Resume Existing Session
	session_start(); 
	//Is Used To Destroy All Sessions
	session_destroy(); 
	//Or
	if(isset($_SESSION['user_name']))
		unset($_SESSION['user_name']); 
		unset($_SESSION['error']); //Is Used To Destroy Specified Session
		header("Location:../index.php"); 
?>