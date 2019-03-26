<?php
include '../dbconnect/dbconnect.php';

if(isset($_POST['user_name']))
{
 $name=$_POST['user_name']; 
 $key=$_POST['key'];
 $checkdata=" SELECT sub_category_name FROM sub_category WHERE delete_status<>1 and sub_category_name='$name' and category_id='$key'";
$query = mysqli_query($conn, $checkdata);

 if(mysqli_num_rows($query)>0)
 {
  echo '<script> $("#div_sub_category_name").addClass("has-error");</script>';
  echo '<script> $("#div_sub_category_name").removeClass("has-success"); </script>';
 }
 else
 {
   echo '<script> $("#div_sub_category_name").addClass("has-success");</script>';
   echo '<script> $("#div_sub_category_name").removeClass("has-error");</script>';
 }
 exit();
}