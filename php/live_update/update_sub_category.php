<?php
	include '../../dbconnect/dbconnect.php';
	$query = "UPDATE sub_category set " . $_POST["column"] . " = '".mysqli_real_escape_string($conn,$_POST["editval"])."' WHERE sub_category_id=".$_POST["id"];
	mysqli_query($conn, $query);
?>