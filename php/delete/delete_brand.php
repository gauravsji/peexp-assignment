<?php
	include '../../dbconnect/dbconnect.php';
	$id =  $_GET['id'];
	$query = "Update brand SET delete_status=1 WHERE brand_id = '$id'";
	if(mysqli_query($conn, $query))
	{
	header("Location:../../reports/brand_report_html.php");
	}
?>