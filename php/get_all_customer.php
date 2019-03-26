<?php
include '../dbconnect/dbconnect.php';
include '../extra/session.php';

$customer_id=$_POST['customer_id'];

	$sql = "SELECT * FROM customer where delete_status<>1 and location='".$user_result['location']."'";
	$query = mysqli_query($conn, $sql);
	$select= "<select name='ui_customer_name' id='ui_customer_name' onChange='fn_fetch_project();' class='form-control' style='width: 100%;'> <option selected disabled hidden value='0'>Select Customer</option>";	
		while($row = mysqli_fetch_array($query))
		{
			if($row["customer_id"]==$customer_id)
			$select.="<option value=".$row["customer_id"]." selected>".$row['customer_name']."</option>";
			else
			$select.="<option value=".$row["customer_id"].">".$row['customer_name']."</option>";
		}
//$select.='</select>';
echo $select;
?>