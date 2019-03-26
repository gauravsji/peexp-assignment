<?php
session_start();
include '../dbconnect/dbconnect.php';

$brand_id=$_POST['brand_id'];
	$sql = "SELECT * FROM brand b, product_set ps , category c where ps.category_id=c.category_id and ps.product_set_id=b.product_set_id and b.delete_status<>1";
	$query = mysqli_query($conn, $sql);
	$select= "<select name='ui_brand_name' id='ui_brand_name' class='form-control' style='width: 100%;'> <option selected disabled hidden value=''>Select Brand</option>";	
		while($row = mysqli_fetch_array($query))
		{
			if($row["brand_id"]==$brand_id)
			$select.="<option value=".$row["brand_id"]." selected>".$row['brand_name']."-".$row['category_name']."-".$row['product_set_product_name']."</option>";
			else
			$select.="<option value=".$row["brand_id"].">".$row['brand_name']."-".$row['category_name']."-".$row['product_set_product_name']."</option>";
		}
$select.='</select>';
echo $select;
?>