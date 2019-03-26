<?php
session_start();
include '../../dbconnect/dbconnect.php';
	include '../../php/add/add_activity_log.php';
//Table name 
$tbl_name = "sales_lead"; 

//Create a variable
$sales_lead_name=ucwords(mysqli_real_escape_string($conn,$_POST['sales_lead_name']));
$sales_lead_contact_person= ucwords(mysqli_real_escape_string($conn, $_POST['sales_lead_contact_person']));
$sales_lead_cnt_no= mysqli_real_escape_string($conn, $_POST['sales_lead_cnt_no']);
$sales_lead_email=  strtolower(mysqli_real_escape_string($conn, $_POST['sales_lead_email']));
$sales_lead_address= mysqli_real_escape_string($conn, $_POST['sales_lead_address']);
$user_id= mysqli_real_escape_string($conn,$_POST['user_id']);
$location= mysqli_real_escape_string($conn, $_POST['modal_sales_lead_location']);


$sql = "INSERT INTO $tbl_name(sales_lead_name,sales_lead_contact_number,sales_lead_reference,sales_lead_email,sales_lead_address,data_entered_by,location,delete_status) VALUES ('$sales_lead_name','$sales_lead_cnt_no','$sales_lead_contact_person','$sales_lead_email','$sales_lead_address','$user_id','$location',0)";
mysqli_query($conn, $sql);

$last_id = mysqli_insert_id($conn); 

fn_add_activity_log("Sales Lead",$last_id,"Sales Lead Added",$user_id,$conn);
echo $last_id;
mysqli_close($conn);
?>