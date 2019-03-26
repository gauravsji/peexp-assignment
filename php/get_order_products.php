<?php
// This file makes a connection with mysql database. 
require_once("../dbconnect/dbconnect.php");
$draft_id=$_POST['draft_id'];
$sql = "SELECT * FROM order_product WHERE delete_status<>1 and order_id='$draft_id'";
$rs = mysqli_query($conn,$sql);
$str = ''; 
$count = 0;
$str .= "<table  class='table table-bordered table-condensed table-sm table-responsive' cellspacing='0' width='100%'><thead><tr><td>Sl No.</td><td>Product</td><td>Description</td><td>Quantity</td><td>Buying Price</td><td>Discount</td><td>Selling Percent</td><td>Selling Price</td><td>Tax</td><td>Tax Inclusive</td><td>Total</td><td>Action</td><td>Delete</td></tr></thead>";
while ($res = mysqli_fetch_array($rs)) 
{
	$tax_i_e="";
	$count = $count+1;
	if($res['tax_inclusive']==1) { $tax_i_e= "Yes";} else {$tax_i_e= "No";}
  $str .= '<tr><td>'.$count	.'</td><td>'.$res['order_product_name'].' </td><td> '. $res['order_product_description'].'</td><td> '. $res['order_product_quantity'].'</td><td> '. $res['order_buying_price'].'</td><td> '. $res['order_discount_percent'].'</td><td> '. $res['order_selling_percentage'].'</td><td> '. $res['order_selling_price'].'</td><td> '. $res['order_tax'].'</td><td> '.$tax_i_e.'</td><td> '. $res['order_total'].'</td><td><a href="#myModal" class="btn btn-primary btn-xs" id="custId" data-toggle="modal" data-id="'.$res['order_product_id'].'">EDIT</a></td><td><a onclick="delete_record('.$res['order_product_id'].');" class="btn btn-danger btn-xs" id="delete_id" data-toggle="modal" data-id="'.$res['order_product_id'].'">DELETE</a></td></tr>';
}
$str .= '</table>';
echo $str;
?>