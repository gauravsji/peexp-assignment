<?php
// This file makes a connection with mysql database.
require_once("../../dbconnect/dbconnect.php");
$draft_id=$_POST['rfq_id'];
$sql = "SELECT * FROM po WHERE delete_status<>1 and rfq_id='$draft_id'";
$query = "SELECT * from rfq WHERE rfq_id='$draft_id'";
$result = mysqli_query($conn, $query);
$enquiry_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
$rs = mysqli_query($conn,$sql);
$str = '';
$count = 0;

if($enquiry_result['po_status'] =='approve')
{
	$str .= "<table  class='table table-bordered table-condensed table-sm table-responsive' cellspacing='0' width='100%'><thead><tr><th>Sl no.</th><th>PO Number</th><th>PO Path</th></tr></thead>";
}
else {
	$str .= "<table  class='table table-bordered table-condensed table-sm table-responsive' cellspacing='0' width='100%'><thead><tr><th>Sl no.</th><th>PO Number</th><th>PO Path</th><th>Action</th></tr></thead>";
}

while ($res = mysqli_fetch_array($rs))
{
	$count = $count + 1;
  $fileurl = $res['po_path'];
  $po_name = explode('/',$res["po_path"])[count(explode('/',$res["po_path"]))-1];

  
	if($enquiry_result['po_status'] =='approve')
	{
		$str .= '<tr><td>'.$count.'</td><td>'.$res["po_number"].' </td><td> <a href='.$fileurl.' target="_blank" download><button class="btn btn-md btn-success">'.$po_name.'</button></a></td></tr>';

	}
	else {
		$str .= '<tr><td>'.$count.'</td><td>'.$res["po_number"].' </td><td> <a href='.$fileurl.' target="_blank" download><button class="btn btn-md btn-success">'.$po_name.'</button></a></td><td><a onclick="delete_record('.$res['id'].','.$draft_id.');" class="btn btn-danger btn-xs" id="delete_id" data-toggle="modal" data-id="'.$res['id'].'">Remove</a></td></tr>';
	}
}

if($count != 0)
{
	if($enquiry_result['po_status'] == 'customer_approved' || $enquiry_result['po_status'] == 'approved')
	{
		$str .= '<tr><td colspan="4"><button class="btn btn-success pull-right">Approved</button></td></tr>';
	}
	elseif ($enquiry_result['po_status'] == 'rejected') {
		$str .= '<tr><td colspan="4"><button class="btn btn-primary pull-right" onClick="apprve_po()">Approve PO</button></td><td colspan="4"><button class="btn btn-danger pull-right" disabled>Rejected</button></td></tr>';
	}
	else {
		$str .= '<tr><td colspan="4"><button class="btn btn-primary pull-right" onClick="apprve_po()">Approve PO</button></td></tr>';
	}
}
$str .= '</table>';
echo $str;
?>
