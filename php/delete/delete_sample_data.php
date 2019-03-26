<?php
session_start();
include '../../dbconnect/dbconnect.php';
$id =  $_GET['id'];
$query = "Update sample_data SET delete_status=1 WHERE sample_data_id = '$id'";
if(mysqli_query($conn, $query))
{
header("Location:../../reports/sample_data_report_html.php");
}
?>