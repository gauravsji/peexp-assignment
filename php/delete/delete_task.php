<?php
session_start();
include '../../dbconnect/dbconnect.php';
$id =  $_GET['id'];
$query = "UPDATE task SET delete_status=1 WHERE task_id = '$id'"; 
if(mysqli_query($conn, $query))
{
header("Location:../../reports/task_report_html.php");
}
?>