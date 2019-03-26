<?php
	session_start();
	include '../../dbconnect/dbconnect.php';
	include '../../php/add/add_activity_log.php';
	//Include Connection PAGE

	//Table names
	$tbl_order_product ="order_product";

  $order_product_id = mysqli_real_escape_string($conn,$_POST['order_product_id']);
  $product_name = mysqli_real_escape_string($conn,$_POST['product_name']);
  $product_description = mysqli_real_escape_string($conn,$_POST['product_description']);
  $product_quantity = mysqli_real_escape_string($conn,$_POST['product_quantity']);
  $product_buying_price = mysqli_real_escape_string($conn,$_POST['product_buying_price']);
  $product_discount_percent = mysqli_real_escape_string($conn,(float)$_POST['product_discount_percent']);
  $discounted_price= mysqli_real_escape_string($conn,$_POST['discounted_price']);
	$total_of_buying=mysqli_real_escape_string($conn,$_POST['total_of_buying']);
  $product_selling_percent = mysqli_real_escape_string($conn,(float)$_POST['product_selling_percent']);
  $product_selling_price = mysqli_real_escape_string($conn,$_POST['product_selling_price']);
  $product_tax = mysqli_real_escape_string($conn,$_POST['product_tax']);
  $product_tax_inclusive = mysqli_real_escape_string($conn,$_POST['product_tax_inclusive']);
  $product_total = mysqli_real_escape_string($conn,$_POST['product_total']);
  $location = mysqli_real_escape_string($conn,$_POST['location']);
  $id = mysqli_real_escape_string($conn,$_POST['order_id']);
	$update_query = "UPDATE $tbl_order_product
									SET
									order_product_name = '$product_name',
									order_product_description = '$product_description',
									order_product_quantity = '$product_quantity',
									order_buying_price = '$product_buying_price',
									order_discounted_price = $discounted_price,
									order_discount_percent = '$product_discount_percent',
									order_total_of_buying = $total_of_buying,
									order_selling_percentage = '$product_selling_percent',
									order_selling_price = $product_selling_price,
									order_tax = '$product_tax',
									tax_inclusive = '$product_tax_inclusive',
									order_total = $product_total
									WHERE order_product_id = $order_product_id";
var_dump($update_query);		
	if(mysqli_query( $conn, $update_query))
	{
		echo $order_product_id;
	$error=1; //If error=1 query executed successfully
	fn_add_activity_log("Order",$ss_order_id,"Order Updated",$user_id,$conn);
	}
	echo $order_product_id;

	//Close Mysql connection
?>
