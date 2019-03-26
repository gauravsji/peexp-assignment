<?php
session_start();
include '../../dbconnect/dbconnect.php';

//Table name 
$tbl_name = "sample_log"; 

//Create a variable

$date = explode('/', $_POST['ui_date']);
	$time = mktime(0,0,0,$date[1],$date[0],$date[2]);
	$v_date = date( 'Y-m-d', $time );
	
	
	$v_sample_log_id= mysqli_real_escape_string($conn,$_POST['sample_log_id']);
	$v_vendor_name= mysqli_real_escape_string($conn,$_POST['ui_vendor_name']);
	$v_brand_name= mysqli_real_escape_string($conn,$_POST['ui_brand_name']);
	$v_sample_type= mysqli_real_escape_string($conn,$_POST['ui_sample_type']);
	$v_sample_status= mysqli_real_escape_string($conn,$_POST['ui_sample_status']);
	$v_sample_description= mysqli_real_escape_string($conn,$_POST['ui_sample_description']);


$sql = "UPDATE $tbl_name 
SET 
vendor_id='$v_vendor_name',
brand_id='$v_brand_name',
sample_date='$v_date',
sample_type='$v_sample_type',
sample_status='$v_sample_status',
sample_description='$v_sample_description'
WHERE sample_log_id='$v_sample_log_id'";
		
if (mysqli_query($conn, $sql)) 
{
  header("Location:../../reports/sample_report_html.php");
}
else
{
	//On Error 
	$_SESSION['error']=mysqli_error($conn);
    header("Location:../../extra/error.php");
}
mysqli_close($conn);
?>