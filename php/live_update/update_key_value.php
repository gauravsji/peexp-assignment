<?php
	include '../../dbconnect/dbconnect.php';
	$query = "UPDATE key_value set " . $_POST["column"] . " = '".mysqli_real_escape_string($conn,$_POST["editval"])."' WHERE key_value_id=".$_POST["id"];
	mysqli_query($conn, $query);
?>