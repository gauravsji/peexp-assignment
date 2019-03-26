<?php
  include '../../dbconnect/dbconnect.php';
  include '../extra/session.php';

  $firm_name = $_POST['firm_name'];
  $sql = "SELECT * FROM customer WHERE delete_status<>1 and firm_name='$firm_name'";
  $result = mysqli_query($conn,$sql);
  $select= "<select name='ui_customer_name' id='ui_customer_name' onChange='fn_fetch_project();' class='form-control' style='width: 100%;'> <option selected disabled hidden value='0'>Select Customer</option>";
  while ($row = mysqli_fetch_array($result))
  {
    $select .= "<option value='".$row['customer_id']."'>".$row['customer_name']."</option>";
  }
	echo $select;
    // return $select;
 ?>
