<?php
session_start();
include '../../dbconnect/dbconnect.php';
$id =  $_GET['id'];
$query = "Update category SET delete_status=1 WHERE category_id = '$id'";
if(mysqli_query($conn, $query))
{
header("Location:../../reports/category_report_html.php");
}
?>