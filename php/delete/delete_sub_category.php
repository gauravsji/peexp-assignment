<?php
session_start();
include '../../dbconnect/dbconnect.php';
$id =  $_GET['id'];
$query = "UPDATE sub_category SET delete_status = 1 WHERE sub_category_id= '$id'";
if(mysqli_query($conn, $query))
{
header("Location:../../reports/sub_category_report_html.php");
}
?>