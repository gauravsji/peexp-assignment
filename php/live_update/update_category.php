<?php
	include '../../dbconnect/dbconnect.php';
	$query = "UPDATE category set " . $_POST["column"] . " = '".mysqli_real_escape_string($conn,$_POST["editval"])."' WHERE category_id=".$_POST["id"];
	mysqli_query($conn, $query);
?>