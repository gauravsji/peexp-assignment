<?php
	require_once("../../dbconnect/dbconnect.php");
	$order_id=$_POST['order_id'];
	$sql_query = "SELECT * FROM ss_order where order_id=".$order_id;

	$get_product_line_items = mysqli_query($conn,$sql_query);
	$get_product_line_result = mysqli_fetch_array($get_product_line_items,MYSQLI_ASSOC);
	echo '<textarea rows="12" cols="146" readonly>'.$get_product_line_result['remark'].'</textarea>';

?>
