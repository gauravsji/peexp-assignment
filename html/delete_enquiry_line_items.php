<?php
include "../extra/session.php";
//Include database connection
if($_POST['rowid']) 
{
    $id = $_POST['rowid']; //escape string
	$sql = "Update enquiry_product SET delete_status=1 WHERE enquiry_product_id = '$id'";
	if(mysqli_query($conn,$sql))
	{		
		$sql_select_products= "SELECT * FROM enquiry_product where enquiry_product_id='$id'";
		$result = mysqli_query($conn, $sql_select_products);
		$products_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
		echo $products_result['enquiry_id'];
	}
 }
?>