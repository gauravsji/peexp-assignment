<?php
session_start();
include '../dbconnect/dbconnect.php';

$category_id=$_POST['category_id'];

	$sql = "SELECT * FROM category where delete_status<>1";
	$query = mysqli_query($conn, $sql);
	$select= "<select name='ui_category' id='ui_category' onChange='fn_fetch_sub_category();' class='form-control select2' style='width: 100%;'>";	
		while($row = mysqli_fetch_array($query))
		{
			if($row["category_id"]==$category_id)
			$select.="<option value=".$row["category_id"]." selected>".$row['category_name']."</option>";
			else
			$select.="<option value=".$row["category_id"].">".$row['category_name']."</option>";
		}
$select.='</select>';
echo $select;
?>