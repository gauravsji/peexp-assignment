<?php
session_start();
include '../../dbconnect/dbconnect.php';
$id =  $_GET['id'];
$query = "Update product_set SET delete_status=1 WHERE product_set_id = '$id'";
if(mysqli_query($conn, $query))
{
header("Location:../../reports/product_set_report_html.php");
}
?>