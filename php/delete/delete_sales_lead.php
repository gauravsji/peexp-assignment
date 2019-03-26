<?php
session_start();
include '../../dbconnect/dbconnect.php';
$id =  $_GET['id'];
$query = "Update sales_lead SET delete_status=1 WHERE sales_lead_id = '$id'";
if(mysqli_query($conn, $query))
{
header("Location:../../reports/sales_lead_report_html.php");
}
?>