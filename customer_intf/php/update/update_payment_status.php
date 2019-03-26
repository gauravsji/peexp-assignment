<?php
session_start();
include '../../dbconnect/dbconnect.php';
$id = $_POST['order_id'];
$sql = "UPDATE `ss_order` SET payment_status='Processed' WHERE order_id =".$id;

if(mysqli_query($conn, $sql))
{
  echo 'Done';
}
?>
