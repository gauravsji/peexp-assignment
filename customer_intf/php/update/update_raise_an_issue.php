<?php
session_start();
include '../../dbconnect/dbconnect.php';
$id = $_POST['order_id'];
$Remark= $_POST['remark'];
$sql="UPDATE `ss_order` SET payment_status='Raised', remark='".$Remark."' WHERE order_id =".$id;
if(mysqli_query($conn, $sql))
{
  echo 'Issue Raised';
}
?>
