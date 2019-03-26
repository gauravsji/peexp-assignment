<?php
// This file makes a connection with mysql database.
include '../../dbconnect/dbconnect.php';
$id=$_POST['id'];
$rfq_id = $_POST['rfq_id'];
$tbl_name = 'po';
$tbl_rfq = 'rfq';

$query = "UPDATE $tbl_name
SET
delete_status = 1,
updated_at =  CURDATE()
WHERE id = $id";

if(mysqli_query($conn, $query))
{
  echo "Done";
}
else {

  echo "Error";
}

$update_rfq_query = "UPDATE $tbl_rfq
                    SET
                    po_status='pending'
                    where rfq_id ='$rfq_id'";

if(mysqli_query($conn, $update_rfq_query))
{
  echo "Done";
}
else {

  echo "Error";
}



?>
