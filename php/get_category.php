<?php
session_start();
include '../dbconnect/dbconnect.php';

	$category_id=$_POST['cat_id'];

	$sql = "SELECT * FROM category where category_id=".$category_id;
	$query = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($query))
		{
			echo $row['category_name'];
		}
?>