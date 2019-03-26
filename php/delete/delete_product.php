<?php
session_start();
include '../../dbconnect/dbconnect.php';
$id =  $_GET['id'];
$query = "UPDATE product SET delete_status=1 WHERE product_id = '$id'";

if(mysqli_query($conn, $query))
{
header("Location:../../reports/product_report_html.php");
}
?>