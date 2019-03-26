<?php
// This file makes a connection with mysql database. 
require_once("../../dbconnect/dbconnect.php");
$pre_enquiry_id=$_POST['pre_enquiry_id'];
$pre_enquiry_status=$_POST['pre_enquiry_status'];

$sql = "UPDATE pre_enquiry_details SET 
pre_enquiry_status='".$pre_enquiry_status."'
WHERE pre_enquiry_id=".$pre_enquiry_id;
mysqli_query($conn, $sql);
mysqli_close($conn);
?>