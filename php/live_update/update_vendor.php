<?php
	include '../../dbconnect/dbconnect.php';
	$query = "UPDATE vendor set " . $_POST["column"] . " = '".mysqli_real_escape_string($conn,$_POST["editval"])."' WHERE  vendor_id=".$_POST["id"];
	mysqli_query($conn, $query);
?>