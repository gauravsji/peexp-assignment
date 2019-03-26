<?php
session_start();
include '../dbconnect/dbconnect.php';
$id = $_GET['id'];
$sql = "UPDATE `ss_order` SET send_pdf_status= 1 , send_image_status =0 , payment_status='Unpaid' WHERE order_id =".$id;

if(mysqli_query($conn, $sql))
{
// $sql = "SELECT module_id FROM photo where photo_id = " . $id;
// $result = mysqli_query($conn, $sql);
// $enquiry_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
header("Location:../html/view_order_html.php?id=".$id);
}
?>
