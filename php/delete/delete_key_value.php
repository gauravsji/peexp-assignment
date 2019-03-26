<?php
	include '../../dbconnect/dbconnect.php';
	$id =  $_GET['id'];
	$query = "Update key_value SET delete_status=1 WHERE key_value_id = '$id'";
	if(mysqli_query($conn, $query))
	{
	header("Location:../../reports/key_value_report_html.php");
	}
?>