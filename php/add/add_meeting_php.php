<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';

	//Table Names 
	$tbl_meeting = "meeting"; 

	//Store Posted Data To PHP Variable
	$date = explode('/', mysqli_real_escape_string($conn,$_POST['ui_meeting_date']));
	$time = mktime(0,0,0,$date[1],$date[0],$date[2]);
	$meeting_date = date( 'Y-m-d', $time );
	
	$meeting_time = date("H:i:s", strtotime($_POST['ui_meeting_time']));
	$meeting_venue=  ucwords(mysqli_real_escape_string($conn,$_POST['ui_meeting_venue']));
	$meeting_connect_name=  ucwords(mysqli_real_escape_string($conn,$_POST['ui_connect_name']));
	$meeting_contact_number= mysqli_real_escape_string($conn,$_POST['ui_contact_number']);
	$meeting_title=  ucwords(mysqli_real_escape_string($conn,$_POST['ui_meeting_title']));
	$meeting_with= mysqli_real_escape_string($conn,$_POST['ui_meeting_with']);
	$meeting_assignee= mysqli_real_escape_string($conn,$_POST['ui_assignee_name']);	
	$meeting_agenda= mysqli_real_escape_string($conn,$_POST['ui_meeting_agenda']);
	$meeting_notes= mysqli_real_escape_string($conn,$_POST['ui_meeting_notes']);
	$meeting_status= mysqli_real_escape_string($conn,$_POST['ui_meeting_status']);	
	$user_id= mysqli_real_escape_string($conn,$_POST['user_id']);
	$location=mysqli_real_escape_string($conn,$_POST['location']);

	//Insert Query
	$query = "INSERT INTO $tbl_meeting(meeting_date,meeting_time, meeting_venue, meeting_connect_name, meeting_contact_number, meeting_title, meeting_with, meeting_assignee, meeting_agenda, meeting_notes, meeting_status, data_entered_by,location, delete_status) VALUES ('$meeting_date','$meeting_time','$meeting_venue','$meeting_connect_name','$meeting_contact_number','$meeting_title','$meeting_with','$meeting_assignee','$meeting_agenda','$meeting_notes','$meeting_status','$user_id','$location',0)";
	
	//Execute The Query
	if (mysqli_query($conn, $query)) 
	{
		//On Successful
		header("Location:../../html/add_meeting_html.php");
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
