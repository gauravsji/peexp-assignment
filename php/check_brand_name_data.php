<?php
include '../dbconnect/dbconnect.php';

if(isset($_POST['user_name']))
{
 $name=$_POST['user_name']; 
 $key=$_POST['key'];
 $checkdata=" SELECT brand_name FROM brand WHERE delete_status<>1 and brand_name='$name' and product_set_id='$key'";
$query = mysqli_query($conn, $checkdata);

 if(mysqli_num_rows($query)>0)
 {
  echo '<script> $("#div_brand_name").addClass("has-error");</script>';
  echo '<script> $("#div_brand_name").removeClass("has-success"); </script>';
 }
 else
 {
   echo '<script> $("#div_brand_name").addClass("has-success");</script>';
   echo '<script> $("#div_brand_name").removeClass("has-error");</script>';
 }
 exit();
}