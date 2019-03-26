<?php
// This file makes a connection with mysql database.
include '../../dbconnect/dbconnect.php';
$draft_id=$_POST['rfq_id'];
$tbl_name = 'rfq';
$query = "UPDATE $tbl_name
SET
po_status = 'approved',
updated_at =  CURDATE()
WHERE rfq_id = $draft_id";
if(mysqli_query($conn, $query))
{
  echo "Done";
}
else {
  echo "Error";
}



?>
