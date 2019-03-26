<?php
session_start();
include '../../dbconnect/dbconnect.php';
include '../../php/add/add_activity_log.php';
//Table name 
$tbl_name = "vendor"; 

//Create a variable
$vendor_name= ucwords(mysqli_real_escape_string($conn,$_POST['vendor_name']));
$vendor_city= mysqli_real_escape_string($conn,$_POST['vendor_city']);
$contact_person= ucwords(mysqli_real_escape_string($conn,$_POST['contact_person']));
$contact_number= mysqli_real_escape_string($conn,$_POST['contact_number']);
$vendor_email= strtolower(mysqli_real_escape_string($conn,$_POST['vendor_email']));
$vendor_address= mysqli_real_escape_string($conn,$_POST['vendor_address']);
$location=mysqli_real_escape_string($conn,$_POST['location']);
$user_id= mysqli_real_escape_string($conn,$_POST['user_id']);

$sql = "INSERT INTO $tbl_name(vendor_name,vendor_city,vendor_contact_person,vendor_contact_number,vendor_email,vendor_address,data_entered_by,location,delete_status) VALUES ('$vendor_name','$vendor_city','$contact_person','$contact_number','$vendor_email','$vendor_address','$user_id','$location',0)";
mysqli_query($conn, $sql);
$last_id = mysqli_insert_id($conn); 
fn_add_activity_log("Vendor",$last_id,"Vendor Added",$user_id,$conn);
echo $last_id;
mysqli_close($conn);
?>