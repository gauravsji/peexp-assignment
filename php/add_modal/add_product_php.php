<?php
session_start();
include '../../dbconnect/dbconnect.php';

//Table name 
$tbl_name = "product"; 

//Create a variable
$vendor_name= mysqli_real_escape_string($conn,$_POST['vendor_name']);
$vendor_city= mysqli_real_escape_string($conn,$_POST['vendor_city']);
$contact_person= mysqli_real_escape_string($conn,$_POST['contact_person']);
$contact_number= mysqli_real_escape_string($conn,$_POST['contact_number']);
$vendor_email= mysqli_real_escape_string($conn,$_POST['vendor_email']);
$vendor_address= mysqli_real_escape_string($conn,$_POST['vendor_address']);

$sql = "INSERT INTO $tbl_name(vendor_name,vendor_city,vendor_contact_person,vendor_contact_number,vendor_email,vendor_address,delete_status) VALUES ('$vendor_name','$vendor_city','$contact_person','$contact_number','$vendor_email','$vendor_address',0)";
mysqli_query($conn, $sql);
$last_id = mysqli_insert_id($conn); 
echo $last_id;
mysqli_close($conn);
?>