<?php
include "../extra/session.php";
//Include database connection
if($_POST['rowid']) 
{
    $id = $_POST['rowid']; //escape string
	$sql = "Update order_product SET delete_status=1 WHERE order_product_id = '$id'";
	if(mysqli_query($conn,$sql))
	{		
		$sql_select_products= "SELECT * FROM order_product where order_product_id='$id'";
		$result = mysqli_query($conn, $sql_select_products);
		$products_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
		echo $products_result['order_id'];
	}
 }
?>