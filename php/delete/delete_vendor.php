<?php
session_start();
include '../../dbconnect/dbconnect.php';
$id =  $_GET['id'];
$query = "UPDATE vendor SET delete_status=1 WHERE vendor_id = '$id'";
if(mysqli_query($conn, $query))
{
header("Location:../../reports/vendor_report_html.php");
}
?>