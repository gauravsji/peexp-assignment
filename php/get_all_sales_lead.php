<?php
include '../dbconnect/dbconnect.php';
include '../extra/session.php';

$sales_lead_id=$_POST['sales_lead_id'];

	$sql = "SELECT * FROM sales_lead where delete_status<>1  and location='".$user_result['location']."'";
	$query = mysqli_query($conn, $sql);
	$select= "<select name='ui_sales_lead' id='ui_sales_lead' class='form-control' style='width: 100%;'> <option selected disabled hidden value='0'>Select Lead</option>";	
		while($row = mysqli_fetch_array($query))
		{
			if($row["sales_lead_id"]==$sales_lead_id)
			$select.="<option value=".$row["sales_lead_id"]." selected>".$row['sales_lead_name']."</option>";
			else
			$select.="<option value=".$row["sales_lead_id"].">".$row['sales_lead_name']."</option>";
		}
$select.='</select>';
echo $select;
?>