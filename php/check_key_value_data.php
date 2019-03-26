<?php
include '../dbconnect/dbconnect.php';

if(isset($_POST['user_name']))
{
 $name=$_POST['user_name']; 
 $key=$_POST['key'];
 $checkdata=" SELECT value FROM key_value WHERE delete_status<>1 and value='$name' and key_column='$key'";
$query = mysqli_query($conn, $checkdata);

 if(mysqli_num_rows($query)>0)
 {
  echo '<script> $("#div_value").addClass("has-error");</script>';
  echo '<script> $("#div_value").removeClass("has-success"); </script>';
 }
 else
 {
   echo '<script> $("#div_value").addClass("has-success");</script>';
   echo '<script> $("#div_value").removeClass("has-error");</script>';
 }
 exit();
}