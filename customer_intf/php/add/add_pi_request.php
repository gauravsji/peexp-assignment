<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';

	//Table names
	$tbl_enquiry = "rfq";
	$tbl_enquiry_product="customer_rfq_enquiry";
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

	if(!(isset($_POST['ui_sales_lead'])))
	{
		$sales_lead_id = NULL;
	}
	else
	{
		$sales_lead_id =  mysqli_real_escape_string($conn,$_POST['ui_sales_lead']);
	}
  $sales_lead_id = NULL;

  $assigne_name = mysqli_real_escape_string($conn,$_POST['enquired_by']);
  $project_priority = mysqli_real_escape_string($conn,$_POST['ui_project_priority']);
  $rfq_name = mysqli_real_escape_string($conn,$_POST['rfq_name']);
  $rfq_details = mysqli_real_escape_string($conn ,$_POST['rfq_details']);
  $enquiry_status = mysqli_real_escape_string($conn ,'Enquiry Created');
	//Insert Query
	$query1 = "INSERT INTO $tbl_enquiry(
    customer_id,project_id,sales_lead_id,enquiry_date,enquiry_name,
    enquiry_details,enquiry_assignee,enquiry_status,enquiry_priority,delete_status,data_entered_by,end_date,created_at,updated_at) VALUES (
    $customer_id,$project_id,'$sales_lead_id','$enquiry_date',
    '$rfq_name','$rfq_details','$customer_id','$enquiry_status','$project_priority',0,'$assigne_name','$enquiry_end_date',CURDATE(),CURDATE())";
	//Execute The Query
	if (mysqli_query($conn, $query1))
	{
	$error=1;
	}
	else
	{
    	echo "Error: ".mysqli_error($conn);
	}
	$last_inserted_id=mysqli_insert_id($conn);
	$enquiry_prod_sql = "SELECT * FROM $tbl_enquiry_product where  product_enquiry_id ='$draft_id'";
	$result_product_clone = mysqli_query($conn, $enquiry_prod_sql);
	$row_product_clone=mysqli_num_rows($result_product_clone);

	for($i=0;$i<$row_product_clone;$i++)
	{
		//Update Query
		$query5="UPDATE $tbl_enquiry_product SET  product_enquiry_id=".$last_inserted_id." WHERE  product_enquiry_id='$draft_id'";
		//Execute The Query
		if(mysqli_query($conn, $query5))
		{
			$error=1;
		}
		else
		{
			echo mysqli_error($conn);
		}

	}

	if ($error==1)
	{
		//On Successful
		// fn_add_activity_log("Enquiry",$last_inserted_id,"Enquiry Created",$user_id,$conn);
		header("Location:../../html/view_pi_html.php?id=".$last_inserted_id);
	}
	else
	{
		//On Error
		$_SESSION['error']=mysqli_error($conn);

		// header("Location:../../extra/error.php");
	}
	//Close Mysqli Connection
	mysqli_close($conn);
?>
