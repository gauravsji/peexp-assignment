<?php
session_start();
include '../../dbconnect/dbconnect.php';
$id =  $_GET['id'];
$query = "Update customer SET delete_status=1 WHERE customer_id = '$id'";
if(mysqli_query($conn, $query))
{
header("Location:../../reports/user_report_html.php");
}
?>
