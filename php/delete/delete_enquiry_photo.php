<?php
session_start();
include '../../dbconnect/dbconnect.php';
$id =  $_GET['id'];
$query = "UPDATE photo SET delete_status=1 WHERE photo_id = '$id'";
if(mysqli_query($conn, $query))
{
$sql = "SELECT module_id FROM photo where photo_id = " . $id;
$result = mysqli_query($conn, $sql);
$enquiry_result = mysqli_fetch_array($result,MYSQLI_ASSOC);	
	
header("Location:../../html/view_enquiry_html.php?id=".$enquiry_result['module_id']);
}
?>