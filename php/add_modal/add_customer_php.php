<?php
session_start();
include '../../dbconnect/dbconnect.php';
include '../../php/add/add_activity_log.php';


//Table name 
$tbl_name = "customer"; 

//Create a variable
$customer_name= mysqli_real_escape_string($conn,$_POST['customer_name']);
$customer_contact_person= mysqli_real_escape_string($conn,$_POST['customer_contact_person']);
$customer_cnt_no= mysqli_real_escape_string($conn,$_POST['customer_cnt_no']);
$customer_email= mysqli_real_escape_string($conn,$_POST['customer_email']);
$customer_address= mysqli_real_escape_string($conn,$_POST['customer_address']);
$user_id= mysqli_real_escape_string($conn,$_POST['user_id']);
$location= mysqli_real_escape_string($conn,$_POST['location']);

$sql = "INSERT INTO $tbl_name(customer_name,customer_address,customer_contact_person,customer_contact_number,customer_email,data_entered_by,location,delete_status) VALUES ('$customer_name','$customer_address','$customer_contact_person','$customer_cnt_no','$customer_email','$user_id','$location',0)";
mysqli_query($conn, $sql);

$last_id = mysqli_insert_id($conn); 

$sql2 = "INSERT INTO project(customer_id,project_name,project_client_name,project_site_address,project_site_incharge_name,project_type_of_project,delete_status) VALUES ('$last_id','Ad Hoc','','$customer_address','','',0)";

mysqli_query($conn, $sql2);

$sql3 = "INSERT INTO contacts(contact_module_name,contact_module_id,delete_status) VALUES ('Customer','$last_id',0)";

fn_add_activity_log("Customer",$last_id,"Customer Created",$user_id,$conn);
mysqli_query($conn, $sql3);
echo $last_id;
mysqli_close($conn);
?>