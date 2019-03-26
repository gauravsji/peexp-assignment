<?php
session_start();
include '../../dbconnect/dbconnect.php';
$id =  $_POST['id'];
$query = "Update customer_rfq_enquiry SET delete_status=1 WHERE id = '$id'";
if(mysqli_query($conn, $query)){
  return 1;
}
?>
