<?php
session_start();
include '../../dbconnect/dbconnect.php';
$id =  $_GET['id'];
$query = "Update daily_log SET delete_status=1 WHERE daily_log_id = '$id'";
if(mysqli_query($conn, $query))
{
header("Location:../../reports/daily_log_report_html.php");
}
?>