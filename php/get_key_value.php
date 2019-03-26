<?php
session_start();
include '../dbconnect/dbconnect.php';

$key_id=$_POST['key_id'];

	$sql = "SELECT * FROM key_value where key_column = 'UNIT_OF_MEASUREMENT' and delete_status<>1";
	$query = mysqli_query($conn, $sql);
	$select= "<select name='ui_key_value' id='ui_key_value' class='form-control select2' style='width: 100%;'>";	
		while($row = mysqli_fetch_array($query))
		{
			if($row["key_value_id"]==$key_id)
			$select.="<option value='".$row['value']."' selected>".$row['value']."</option>";
			else
			$select.="<option value='".$row['value']."'>".$row['value']."</option>";
		}
$select.='</select>';
echo $select;
?>