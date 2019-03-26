<?php
session_start();
include '../../dbconnect/dbconnect.php';

$tbl_name = "settings"; // Table name 

// create a variable
$settings_id= $_POST['settings_id'];

if(empty($_POST['view_all_daily_log_records']))
{
	$view_all_daily_log_records=0;
}
else
{
	$view_all_daily_log_records=1;
}


if(empty($_POST['view_all_meeting_records']))
{
	$view_all_meeting_records=0;
}
else
{
	$view_all_meeting_records=1;
}

if(empty($_POST['view_all_sales_lead_records']))
{
	$view_all_sales_lead_records=0;
}
else
{
	$view_all_sales_lead_records=1;
}

//$view_all_sales_lead_records= $_POST['view_all_sales_lead_records'];


if(empty($_POST['view_all_enquiry_records']))
{
	$view_all_enquiry_records=0;
}
else
{
	$view_all_enquiry_records=1;
}

if(empty($_POST['view_all_order_records']))
{
	$view_all_order_records=0;
}
else
{
	$view_all_order_records=1;
}

if(empty($_POST['view_all_customer_records']))
{
	$view_all_customer_records=0;
}
else
{
	$view_all_customer_records=1;
}



if(empty($_POST['view_all_product_set_records']))
{
	$view_all_product_set_records=0;
}
else
{
	$view_all_product_set_records=1;
}


if(empty($_POST['view_all_product_records']))
{
	$view_all_product_records=0;
}
else
{
	$view_all_product_records=1;
}


if(empty($_POST['view_all_category_records']))
{
	$view_all_category_records=0;
}
else
{
	$view_all_category_records=1;
}

if(empty($_POST['view_all_sub_category_records']))
{
	$view_all_sub_category_records=0;
}
else
{
	$view_all_sub_category_records=1;
}


if(empty($_POST['view_all_brand_records']))
{
	$view_all_brand_records=0;
}
else
{
	$view_all_brand_records=1;
}

if(empty($_POST['view_all_vendor_records']))
{
	$view_all_vendor_records=0;
}
else
{
	$view_all_vendor_records=1;
}


if(empty($_POST['view_all_task_records']))
{
	$view_all_task_records=0;
}
else
{
	$view_all_task_records=1;
}


if(empty($_POST['view_all_payment_records']))
{
	$view_all_payment_records=0;
}
else
{
	$view_all_payment_records=1;
}

if(empty($_POST['view_all_transport_team_records']))
{
	$view_all_transport_team_records=0;
}
else
{
	$view_all_transport_team_records=1;
}

if(empty($_POST['view_all_sample_records']))
{
	$view_all_sample_records=0;
}
else
{
	$view_all_sample_records=1;
}

if(empty($_POST['view_all_key_value_records']))
{
	$view_all_key_value_records=0;
}
else
{
	$view_all_key_value_records=1;
}


$sql="UPDATE `settings` 
SET 
view_all_daily_log='$view_all_daily_log_records',
view_all_meeting='$view_all_meeting_records',
view_all_sales_lead='$view_all_sales_lead_records',
view_all_enquiry='$view_all_enquiry_records',
view_all_sales_order='$view_all_order_records',
view_all_customer='$view_all_customer_records',
view_all_product_set='$view_all_product_set_records',
view_all_product='$view_all_product_records',
view_all_category='$view_all_category_records',
view_all_sub_category='$view_all_sub_category_records',
view_all_brand='$view_all_brand_records',
view_all_vendor='$view_all_vendor_records',
view_all_task='$view_all_task_records',
view_all_payment='$view_all_payment_records',
view_all_transport_team='$view_all_transport_team_records',
view_all_sample='$view_all_sample_records',
view_key_value='$view_all_key_value_records' 
WHERE settings_id='$settings_id'";
 if (mysqli_query($conn, $sql)) 
{
	header("Location:../../html/user_profile_html.php");
}
else
{
	 //On Error 
	 $_SESSION['error']=mysqli_error($conn);
     header("Location:../../extra/error.php");
}

mysqli_close($conn);
?>