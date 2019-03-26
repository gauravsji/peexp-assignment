<?php
	include '../../dbconnect/dbconnect.php';
	$id =  $_GET['id'];
	$query = "Update service_installer SET delete_status=1 WHERE service_installer_id = '$id'";
	if(mysqli_query($conn, $query))
	{
	header("Location:../../reports/servicers_installers_report_html.php");
	}
?>