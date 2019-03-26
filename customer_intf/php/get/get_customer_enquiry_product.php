<?php
// This file makes a connection with mysql database.
require_once("../../dbconnect/dbconnect.php");
$draft_id=$_POST['draft_id'];
$sql = "SELECT * FROM customer_rfq_enquiry WHERE delete_status<>1 and product_enquiry_id='$draft_id'";
$rs = mysqli_query($conn,$sql);

$str = '';
$str .= "<table  class='table table-bordered table-condensed table-sm table-responsive' cellspacing='0' width='100%'><thead><tr><td>Sl no.</td><td>Product</td><td>Description</td><td>Quantity</td><td>Remarks</td><td colspan='2'><center>Action</center></td></tr></thead>";
$count = 0;
while ($res = mysqli_fetch_array($rs))
{
	$count = $count + 1;
  $str .= '<tr><td>'.$count.'</td><td>'.$res["product_name"].' </td><td> '. $res["product_description"].'</td><td> '. $res["product_quantity"].'</td><td> '. $res["product_remarks"].'</td><td colspan="2"><center><a href="#edit_enquiry_product_modal" class="label bg-primary" id="custId" data-toggle="modal" data-id="'.$res['id'].'" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;&nbsp; <a onclick="delete_record('.$res['id'].','.$res['product_enquiry_id'].');" class="label bg-red" id="delete_id" data-toggle="modal" data-id="'.$res['id'].'" title="Remove"><i class="fa fa-trash"></i></a></center></td></tr>';
}
$str .= '</table>';
echo $str;
?>
