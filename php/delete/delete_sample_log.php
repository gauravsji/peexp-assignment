<?php
session_start();
include '../../dbconnect/dbconnect.php';
$id =  $_GET['id'];
$query = "Update sample_log SET delete_status=1 WHERE sample_log_id = '$id'";
if(mysqli_query($conn, $query))
{
header("Location:../../reports/sample_report_html.php");
}
?>