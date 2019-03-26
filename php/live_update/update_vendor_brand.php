<?php
	include '../../dbconnect/dbconnect.php';
	$query = "UPDATE vendor_brand set " . $_POST["column"] . " = '".mysqli_real_escape_string($conn,$_POST["editval"])."' WHERE  vendor_brand_id=".$_POST["id"];
	mysqli_query($conn, $query);
?>