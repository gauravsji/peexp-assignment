<?php
include '../dbconnect/dbconnect.php';

if(isset($_POST['user_name']))
{
 $name=$_POST['user_name'];

 $checkdata=" SELECT customer_name FROM customer WHERE delete_status<>1 and customer_name='$name' ";
$query = mysqli_query($conn, $checkdata);

 if(mysqli_num_rows($query)>0)
 {
  echo '<script> $("#div_customer_name").addClass("has-error");</script>';
  echo '<script> $("#div_customer_name").removeClass("has-success"); </script>';
 }
 else
 {
   echo '<script> $("#div_customer_name").addClass("has-success");</script>';
   echo '<script> $("#div_customer_name").removeClass("has-error");</script>';
 }
 exit();
}