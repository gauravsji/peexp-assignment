<?php
// This file makes a connection with mysql database. 
require_once("../dbconnect/dbconnect.php");
$draft_id=$_POST['draft_id'];
$sql = "SELECT * FROM customer_rfq_enquiry WHERE delete_status<>1 and product_enquiry_id='$draft_id'";
$rs = mysqli_query($conn,$sql);
$str = ''; 
$str .= "<table  class='table table-bordered table-condensed table-sm table-responsive' cellspacing='0' width='100%'><thead><tr><td>Sl no.</td><td>Product</td><td>Description</td><td>Quantity</td><td>Buying Price</td><td>Discount</td><td>Selling Percent</td><td>Selling Price</td><td>Tax</td><td>Tax Inclusive</td><td>Total</td><td>Remarks</td><td>Status</td><td colspan='2'>Action</td></tr></thead>";
$count = 0;
while ($res = mysqli_fetch_array($rs)) 
{
	$count = $count + 1;
	$tax_i_e="";
	if($res['tax_inclusive']==1) { $tax_i_e= "Yes";} else {$tax_i_e= "No";}
  $str .= '<tr><td>'.$count.'</td><td>'.$res['product_name'].' </td><td> '. $res['product_description'].'</td><td> '. $res['product_quantity'].'</td><td> '. $res['enquiry_buying_price'].'</td><td> '. $res['enquiry_discount_percent'].'</td><td> '. $res['enquiry_selling_percentage'].'</td><td> '. $res['enquiry_selling_price'].'</td><td> '. $res['enquiry_tax'].'</td><td> '.$tax_i_e.'</td><td> '. $res['enquiry_total'].'</td><td> '. $res['product_remarks'].'</td><td> '. $res['product_status'].'</td><td><a href="#edit_enquiry_product_modal" class="btn btn-primary btn-xs" id="custId" data-toggle="modal" data-id="'.$res['id'].'">EDIT</a></td><td><a onclick="delete_record('.$res['id'].');" class="btn btn-danger btn-xs" id="delete_id" data-toggle="modal" data-id="'.$res['id'].'">DELETE</a></td></tr>';
}
$str .= '</table>';
echo $str;
?>