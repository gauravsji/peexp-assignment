<?php
session_start();
include '../../dbconnect/dbconnect.php';
$id =  $_GET['id'];
$query = "Update payment SET delete_status=1 WHERE payment_id = '$id'";
if(mysqli_query($conn, $query))
{
header("Location:../../reports/payment_report_html.php");
}
?>