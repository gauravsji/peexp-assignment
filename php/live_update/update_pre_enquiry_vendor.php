<?php
	include '../../dbconnect/dbconnect.php';
		
	$query_vendor = "UPDATE pre_enquiry_vendor_details set " . $_POST["column"] . " = '".mysqli_real_escape_string($conn,$_POST["editval"])."' WHERE  pre_enquiry_vendor_id=".$_POST["id"];
	mysqli_query($conn, $query_vendor);
	$query_product = "UPDATE pre_enquiry_vendor_product set " . $_POST["column"] . " = '".mysqli_real_escape_string($conn,$_POST["editval"])."' WHERE  pre_vendor_pro_id=".$_POST["id"];
	mysqli_query($conn, $query_product);
?>