<?php
session_start();
include '../../dbconnect/dbconnect.php';
$id =  $_GET['id'];
$toId=$_GET['toId'];
$query = "UPDATE customer SET approved=1 WHERE customer_id = '$id'";
if(mysqli_query($conn, $query))
{
// $sql = "SELECT module_id FROM photo where photo_id = " . $id;
// $result = mysqli_query($conn, $sql);
// $enquiry_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
header("Location:../../html/view_customer_html.php?id=".$toId);
}
?>
