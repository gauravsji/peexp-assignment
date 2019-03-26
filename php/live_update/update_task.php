<?php
	include '../../dbconnect/dbconnect.php';
	$query = "UPDATE task set " . $_POST["column"] . " = '".mysqli_real_escape_string($conn,$_POST["editval"])."' WHERE task_id=".$_POST["id"];
	mysqli_query($conn, $query);
?>