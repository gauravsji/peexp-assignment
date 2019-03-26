<?php
session_start();
include '../../dbconnect/dbconnect.php';
$id =  $_GET['id'];
$query = "UPDATE transport_team SET delete_status=1 WHERE transport_team_id = '$id'";
if(mysqli_query($conn, $query))
{
	header("Location:../../reports/transport_team_report_html.php");
}
?>