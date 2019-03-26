<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';

	$tbl_name = "meeting"; // Table name 

	//Store Posted Data To PHP Variable
	$meeting_id= mysqli_real_escape_string($conn,$_POST['ui_meeting_id']);
	$date = explode('/', mysqli_real_escape_string($conn,$_POST['ui_meeting_date']));
	$time = mktime(0,0,0,$date[1],$date[0],$date[2]);
	$meeting_date = date( 'Y-m-d', $time );

	$meeting_time = date("H:i:s", strtotime($_POST['ui_meeting_time']));
	$meeting_venue= mysqli_real_escape_string($conn,$_POST['ui_meeting_venue']);
	$meeting_connect_name= mysqli_real_escape_string($conn,$_POST['ui_connect_name']);
	$meeting_contact_number= mysqli_real_escape_string($conn,$_POST['ui_contact_number']);
	$meeting_title= mysqli_real_escape_string($conn,$_POST['ui_meeting_title']);
	$meeting_with= mysqli_real_escape_string($conn,$_POST['ui_meeting_with']);
	$meeting_assignee= mysqli_real_escape_string($conn,$_POST['ui_assignee_name']);	
	$meeting_agenda= mysqli_real_escape_string($conn,$_POST['ui_meeting_agenda']);
	$meeting_notes= mysqli_real_escape_string($conn,$_POST['ui_meeting_notes']);
	$meeting_status= mysqli_real_escape_string($conn,$_POST['ui_meeting_status']);	
	$location=mysqli_real_escape_string($conn,$_POST['location']);

	$sql = "UPDATE $tbl_name
	SET 
	meeting_date='$meeting_date',
	meeting_time='$meeting_time',
	meeting_venue='$meeting_venue',
	meeting_connect_name='$meeting_connect_name',
	meeting_contact_number='$meeting_contact_number',
	meeting_title='$meeting_title',
	meeting_with='$meeting_with',
	meeting_assignee='$meeting_assignee',
	meeting_agenda='$meeting_agenda',
	meeting_notes='$meeting_notes',
	meeting_status='$meeting_status'
	WHERE meeting_id = '$meeting_id'";

	if (mysqli_query($conn, $sql)) 
	{
		//On Successful
		header("Location:../../reports/meeting_report_html.php");
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