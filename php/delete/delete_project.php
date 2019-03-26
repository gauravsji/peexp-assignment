<?php
session_start();
include '../../dbconnect/dbconnect.php';
$id =  $_GET['id'];
$query = "Update project SET delete_status=1 WHERE project_id = '$id'";
if(mysqli_query($conn, $query))
{
header("Location:../../reports/project_report_html.php");
}
?>