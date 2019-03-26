<?php
session_start();
include '../../dbconnect/dbconnect.php';

//Table name 
$tbl_name = "task"; 

//Create a variable
$order_id= mysqli_real_escape_string($conn,$_POST['order_id']);
$task_name= mysqli_real_escape_string($conn,$_POST['task_name']);
$assignee_name= mysqli_real_escape_string($conn,$_POST['assignee_name']);

$date = explode('/', mysqli_real_escape_string($conn,$_POST['due_date']));
$time = mktime(0,0,0,$date[1],$date[0],$date[2]);
$due_date = date( 'Y-m-d', $time );


$task_status= mysqli_real_escape_string($conn,$_POST['task_status']);
$task_description= mysqli_real_escape_string($conn,$_POST['task_description']);
$task_remarks= mysqli_real_escape_string($conn,$_POST['task_remarks']);
$user_id= mysqli_real_escape_string($conn,$_POST['user_id']);
$location= mysqli_real_escape_string($conn,$_POST['location']);

$sql = "INSERT INTO $tbl_name(task_name,task_description,task_assignee,task_start_date,task_due_date,task_priority,task_status,task_remarks,task_module_name,task_module_id,data_entered_by,location,created_date,last_update_date,delete_status) VALUES ('$task_name','$task_description','$assignee_name',NOW(),'$due_date','High','$task_status','$task_remarks','ORDER','$order_id','$user_id','$location',CURDATE(),CURDATE(),0)";

mysqli_query($conn, $sql);
$last_id = mysqli_insert_id($conn); 
echo $last_id;
mysqli_close($conn);
?>