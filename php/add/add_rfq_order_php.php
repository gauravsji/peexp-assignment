<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';
	include 'add_activity_log.php';

	//Table Names
	$tbl_ss_order = "ss_order";
	$tbl_order_product ="order_product";
	$tbl_order_transport ="order_transport";
	$tbl_order_account ="order_account";
	$tbl_order_product_clone ="order_product_clone";
	$tb2_name = "dispatch_list_details";
	$tb1_rfq = 'rfq';
	$error=0;

	//Store Posted Data To PHP Variable
	$date = explode('/', mysqli_real_escape_string($conn,$_POST['ui_order_date']));
	$time = mktime(0,0,0,$date[1],$date[0],$date[2]);
	$order_date = date( 'Y-m-d', $time );

	$draft_id= mysqli_real_escape_string($conn,$_POST['draft_id']);
	$vendor_id= mysqli_real_escape_string($conn,$_POST['ui_vendor_name']);
	$customer_id= mysqli_real_escape_string($conn,$_POST['ui_customer_name']);
	$project_id= mysqli_real_escape_string($conn,$_POST['ui_project_name']);
	$brief_order_details= mysqli_real_escape_string($conn,$_POST['ui_brief_order_details']);
	$order_placed_by= mysqli_real_escape_string($conn,$_POST['ui_order_placed_by']);
	$confirmation_type= mysqli_real_escape_string($conn,$_POST['ui_confirmation_type']);
	$order_assignee_name= mysqli_real_escape_string($conn,$_POST['ui_assignee_name']);
	$order_status= mysqli_real_escape_string($conn,$_POST['ui_order_status']);
	$order_remarks= mysqli_real_escape_string($conn,$_POST['ui_order_remarks']);
	$with_bill= mysqli_real_escape_string($conn,$_POST['ui_with_bill']);

	//User Name Who Submitted The Data
	$order_by=mysqli_real_escape_string($conn,$_POST['user_id']);
	$location=mysqli_real_escape_string($conn,$_POST['location']);
  $rfq_id = mysqli_real_escape_string($conn,$_POST['rfq_id']);
	//Insert Query

	$query1 = "INSERT INTO $tbl_ss_order(vendor_id,customer_id,project_id,order_date,order_placed_by,order_confirmation_type,order_assignee,order_status,order_remarks,order_brief_details,order_with_bill,data_entered_by,location,created_date, last_update_date, delete_status,created_from_id) VALUES ('$vendor_id','$customer_id','$project_id','$order_date','$order_placed_by','$confirmation_type','$order_assignee_name','$order_status','$order_remarks','$brief_order_details','$with_bill','$order_by','$location', CURDATE(), CURDATE(),0,'rfq-$rfq_id')";

	//Execute The Query
	if(mysqli_query($conn, $query1))
	{
		$error=1;
	}
	else
	{
	echo mysqli_error($conn);
	}
	$error=1;

	//Get Last Inserted ID
	$last_inserted_id=mysqli_insert_id($conn);

  	//Store Posted Data To PHP Variable
  	$v_transportation_type=mysqli_real_escape_string($conn,$_POST['ui_transport_type']);
  	$v_transportation_charge=mysqli_real_escape_string($conn,$_POST['ui_transport_charge']);
  	$v_ui_delivery_location=mysqli_real_escape_string($conn,$_POST['ui_delivery_location']);
  	$date = explode('/', mysqli_real_escape_string($conn,$_POST['ui_delivery_date']));
  	$time = mktime(0,0,0,$date[1],$date[0],$date[2]);
  	$v_delivery_date = date( 'Y-m-d', $time );
  	$v_delivery_remarks=mysqli_real_escape_string($conn,$_POST['ui_delivery_remarks']);

  	//Insert Query
  	$query3 = "INSERT INTO $tbl_order_transport(order_id,order_transportation_type,order_transportation_charge,order_delivery_location,order_delivery_date,order_delivery_remarks,delete_status) VALUES ('$last_inserted_id','$v_transportation_type','$v_transportation_charge','$v_ui_delivery_location','$v_delivery_date','$v_delivery_remarks',0)";

  	//Execute The Query
  	if(mysqli_query($conn, $query3)) echo mysqli_error($conn);
  	$error=1;

  	//Store Posted Data To PHP Variable
  	$v_estimate_number=mysqli_real_escape_string($conn,$_POST['ui_estimate_number']);
  	$v_e_sugam_number=mysqli_real_escape_string($conn,$_POST['ui_e_sugam_number']);
  	$v_purchase_bill_number=mysqli_real_escape_string($conn,$_POST['ui_purchase_bill_number']);
  	$v_ss_invoice_number=mysqli_real_escape_string($conn,$_POST['ui_ss_invoice_number']);

  	//Insert Query
  	$query4 = "INSERT INTO $tbl_order_account(order_id,order_estimate_number,order_e_sugam_number,order_purchase_bill_number,order_ss_invoice_number,delete_status) VALUES ('$last_inserted_id','$v_estimate_number','$v_e_sugam_number','$v_purchase_bill_number','$v_ss_invoice_number',0)";


  	//Execute The Query
  	if(mysqli_query($conn, $query4)) echo mysqli_error($conn);
  	$error=1;

  	$order_prod_sql = "SELECT * FROM order_product where order_id='$draft_id'";
    $result_product_clone = mysqli_query($conn, $order_prod_sql);
  	echo mysqli_error($conn);
  	$row_product_clone=mysqli_num_rows($result_product_clone);


  	for($i=0;$i<$row_product_clone;$i++)
  	{
  		//Update Query
  		$query5="UPDATE $tbl_order_product SET order_id=".$last_inserted_id." WHERE order_id='$draft_id'";

  		$querys5="UPDATE $tb2_name SET order_id=".$last_inserted_id." WHERE order_id='$draft_id'";

  		//Execute The Query
  		if(mysqli_query($conn, $query5) && mysqli_query($conn, $querys5))
  		echo mysqli_error($conn);
  		$error=1;
  	}




  	$query6="SELECT o_product_id, order_discounted_price FROM order_product WHERE order_id = ".$last_inserted_id;
  	$result6=mysqli_query($conn, $query6);
  	$rowcount=mysqli_num_rows($result6);
  		// echo $rowcount;
      while($vendor_product_row=mysqli_fetch_array($result6))
  		{
  			$query6="UPDATE vendor_product
  			SET
  			product_vendor_price= '".$vendor_product_row['order_discounted_price']."'
  			WHERE vendor_product_id=".$vendor_product_row['o_product_id']." and vendor_id=".$vendor_id."";
  			//echo $query6;
  			mysqli_query($conn, $query6);
  			echo mysqli_affected_rows($conn);
  			$affected_count=mysqli_affected_rows($conn);
  			if($affected_count<1)
  			{
  			$query7="INSERT INTO vendor_product(vendor_id, product_id, product_vendor_price) VALUES (".$vendor_id.",".$vendor_product_row['o_product_id'].",'".$vendor_product_row['order_discounted_price']."')";
  			//echo $query7;
  			$result7=mysqli_query($conn, $query7);
  			}
  		}

  	$query8="SELECT o_product_id, order_selling_price FROM order_product WHERE order_id = ".$last_inserted_id;
  	$result8=mysqli_query($conn, $query8);
  	$rowcount=mysqli_num_rows($result8);
  		while($customer_product_row=mysqli_fetch_array($result8))
  		{
  			$query9="UPDATE customer_product
  			SET
  			product_customer_price= '".$customer_product_row['order_selling_price']."'
  			WHERE customer_product_id=".$customer_product_row['o_product_id']." and customer_id=".$customer_id."";
  			mysqli_query($conn, $query9);
  			$affected_count=mysqli_affected_rows($conn);
  			if($affected_count<1)
  			{
  			$query10="INSERT INTO customer_product(customer_id, product_id, product_customer_price) VALUES (".$customer_id.",".$customer_product_row['o_product_id'].",'".$customer_product_row['order_selling_price']."')";
  			$result10=mysqli_query($conn, $query10);
  			}
  		}

		$update_rfq_query = "UPDATE $tb1_rfq SET enquiry_status='Order Received' where rfq_id='$rfq_id'";
		$update_rfq_result=mysqli_query($conn, $update_rfq_query);
	if($error==1)
	{
		fn_add_activity_log("Order",$last_inserted_id,"Order Created",$order_by,$conn);
		//On Successful
		header("Location:../../html/edit_order_html.php?id=". $last_inserted_id . "");
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
