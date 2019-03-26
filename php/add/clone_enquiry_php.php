<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';
	include '../../php/add/add_activity_log.php';
	
	//Table names 
	$tbl_enquiry = "enquiry"; 
	$tbl_enquiry_product="enquiry_product";	
	$error=0;

	//fetch enquiry details
		$enquiry_clone_id=$_GET["id"];
		$sql = "SELECT * FROM enquiry e where e.enquiry_id =" . $enquiry_clone_id ;
		$result = mysqli_query($conn, $sql);
		$enquiry_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
		
	$customer_id = $enquiry_result['customer_id'];
	$project_id = $enquiry_result['project_id'];
	//$sales_lead_id = $enquiry_result['sales_lead_id'];
	//$enquiry_date = 
	
	$enquiry_name=  $enquiry_result['enquiry_name'].'_clone';
	$enquiry_details= $enquiry_result['enquiry_details'];
	$transport_charge= $enquiry_result['transport_charge'];
	$assignee_name= $enquiry_result['assignee_name'];
	$enquiry_status= 'OPEN - QUOTE TO BE SENT';
	$enquiry_priority= $enquiry_result['enquiry_priority'];	
	$user_id= $enquiry_result['user_id'];
	$location= $enquiry_result['location'];

	//Insert Query
	$query1 = "INSERT INTO $tbl_enquiry(customer_id,project_id,enquiry_date,enquiry_name,enquiry_details,enquiry_transport_charge,enquiry_assignee,enquiry_status,enquiry_priority,data_entered_by,location,created_date, last_update_date, delete_status) VALUES ($customer_id,$project_id,CURDATE(),'$enquiry_name','$enquiry_details','$transport_charge','$assignee_name','$enquiry_status','$enquiry_priority','$user_id','$location',CURDATE(),CURDATE(),0)";
	
	echo $query1;
	
 	//Execute The Query
	if (mysqli_query($conn, $query1)) 
	{
			$error=1;
	}
	else
	{
			echo "Error: ".mysqli_error($conn);
	}
	
	//Add data to products
	
	if ($error=1)
	{
	$last_inserted_id=mysqli_insert_id($conn);
	
	$query5 = "insert into enquiry_product(enquiry_id,enquiry_product_name,enquiry_product_description,enquiry_product_quantity,enquiry_buying_price,enquiry_discount_percent,enquiry_discounted_price,enquiry_total_of_buying,enquiry_selling_percentage,enquiry_selling_price,enquiry_tax,tax_inclusive,enquiry_total,enquiry_remarks,enquiry_status,delete_status) 
	select $last_inserted_id,enquiry_product_name,enquiry_product_description,enquiry_product_quantity,enquiry_buying_price,enquiry_discount_percent,enquiry_discounted_price,enquiry_total_of_buying,enquiry_selling_percentage,enquiry_selling_price,enquiry_tax,tax_inclusive,enquiry_total,enquiry_remarks,enquiry_status,delete_status from enquiry_product where enquiry_id = $enquiry_clone_id";
	
	echo $query5;
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
		fn_add_activity_log("Enquiry",$last_inserted_id,"Enquiry Created",$user_id,$conn);
		header("Location:../../html/view_enquiry_html.php?id=".$last_inserted_id);
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