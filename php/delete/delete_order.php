<?php
session_start();
include '../../dbconnect/dbconnect.php';
$id =  $_GET['id'];
$query1 = "Update ss_order SET delete_status=1 WHERE order_id = '$id'";
$query2 = "Update order_product SET delete_status=1 WHERE order_id = '$id'";
$query3 = "Update order_transport SET delete_status=1 WHERE order_id = '$id'";
$query4 = "Update order_account SET delete_status=1 WHERE order_id = '$id'";

if((mysqli_query($conn, $query1)) and (mysqli_query($conn, $query2))and (mysqli_query($conn, $query3))and (mysqli_query($conn, $query4)))
{
header("Location:../../reports/order_report_html.php");
}
?>