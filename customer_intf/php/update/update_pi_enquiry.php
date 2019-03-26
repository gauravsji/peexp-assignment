<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';
	include '../../constants.php';
	//Table Names
	$tbl_name = "rfq";
	$error=0;

	//Store Posted Data To PHP Variable
	$draft_id= mysqli_real_escape_string($conn,$_POST['draft_id']);

	$date = explode('/', mysqli_real_escape_string($conn, $_POST['ui_rfq_date']));
	$time = mktime(0,0,0,$date[1],$date[0],$date[2]);
	$enquiry_date = date( 'Y-m-d', $time );

  $end_date = explode('/', mysqli_real_escape_string($conn, $_POST['ui_rfq_edd']));
	$time = mktime(0,0,0,$end_date[1],$end_date[0],$end_date[2]);
	$enquiry_end_date = date( 'Y-m-d', $time );

	if(!(isset($_POST['ui_customer_name'])))
	{
		$customer_id = NULL;
	}
	else $customer_id =  mysqli_real_escape_string($conn,$_POST['ui_customer_name']);

	if(!(isset($_POST['ui_project_name'])))
	{
		$project_id = 'NULL';
	}
	else $project_id =  mysqli_real_escape_string($conn,$_POST['ui_project_name']);

  $assigne_name = mysqli_real_escape_string($conn,$_POST['enquired_by']);
  $project_priority = mysqli_real_escape_string($conn,$_POST['ui_project_priority']);
  $rfq_name = mysqli_real_escape_string($conn,$_POST['rfq_name']);
  $rfq_details = mysqli_real_escape_string($conn ,$_POST['rfq_details']);
  $enquiry_status = mysqli_real_escape_string($conn ,'Enquiry Created');
	//Update Query
	$sql1 = "UPDATE $tbl_name
	SET
	enquiry_name='$rfq_name',
	project_id = $project_id,
	enquiry_details='$rfq_details',
	enquiry_assignee=$customer_id,
	data_entered_by = $assigne_name,
	enquiry_status='$enquiry_status',
	end_date = '$enquiry_end_date',
	enquiry_priority='$project_priority',
	updated_at =  CURDATE()
	WHERE rfq_id = $draft_id";

	if(mysqli_query($conn, $sql1))
	{
		$error=1;
	}
	else
	{
		$error=0;
	}

	if ($error==1)
	{
		//On Successful
		fn_add_activity_log("Enquiry",$enquiry_id,"Enquiry Updated",$user_id,$conn);
		header("Location:../../html/edit_pi_html.php?id=".$enquiry_id."");
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
