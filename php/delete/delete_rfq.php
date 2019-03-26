<?php
session_start();
include '../../dbconnect/dbconnect.php';
$id =  $_GET['id'];
$query = "Update rfq SET delete_status=1 WHERE rfq_id = '$id'";
if(mysqli_query($conn, $query))
{
header("Location:../../reports/report_rfq_enquiry_html.php");
}
?>
