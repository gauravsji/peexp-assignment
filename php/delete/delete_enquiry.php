<?php
session_start();
include '../../dbconnect/dbconnect.php';
$id =  $_GET['id'];
$query = "Update enquiry SET delete_status=1 WHERE enquiry_id = '$id'";
if(mysqli_query($conn, $query))
{
header("Location:../../reports/enquiry_report_html.php");
}
?>