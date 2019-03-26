<?php
include '../dbconnect/dbconnect.php';
include '../extra/session.php';

$vendor_id=$_POST['vendor_id'];

	$sql = "SELECT * FROM vendor where delete_status<>1  and location='".$user_result['location']."'";
	$query = mysqli_query($conn, $sql);
	$select= "<select name='ui_vendor_name' id='ui_vendor_name' class='form-control' style='width: 100%;'> <option selected disabled hidden value=''>Select Vendor</option>";	
		while($row = mysqli_fetch_array($query))
		{
			if($row["vendor_id"]==$vendor_id)
			$select.="<option value=".$row["vendor_id"]." selected>".$row['vendor_name']."</option>";
			else
			$select.="<option value=".$row["vendor_id"].">".$row['vendor_name']."</option>";
		}
//$select.='</select>';
echo $select;
?>