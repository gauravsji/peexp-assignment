<?php
session_start();
include '../../dbconnect/dbconnect.php';
$id =  $_GET['id'];
$query = "Update vendor_brand SET delete_status='1' WHERE vendor_brand_id = '$id'";
if(mysqli_query($conn, $query))
{
	
$sql = "SELECT vendor_id FROM vendor_brand where vendor_brand_id = " . $id;
$result = mysqli_query($conn, $sql);
$vendor_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
	
	
header("Location:../../html/view_vendor_html.php?id=".$vendor_result['vendor_id']);
}
?>