<?php
include '../../dbconnect/dbconnect.php';

$customer_id = $_POST['customer_id'];
$groupId = $_POST['group_id'];

if($groupId == $customer_id)
{
  $query = $conn->query("SELECT  * FROM project where  customer_id='".$customer_id."' and delete_status<>1 and project_name != 'Ad Hoc'");
}
else
{
  $query = $conn->query("SELECT  * FROM project where  customer_id='".$customer_id."' and delete_status<>1 and project_name != 'Ad Hoc'");
}

$rowCount = $query->num_rows;
$project_value = '';
if($rowCount > 0)
{
  $project_value .='<option value="">Select Project</option>';
  while($row = $query->fetch_assoc())
  {
      $project_value .='<option value="'.$row['project_id'].'" >'.$row['project_name'].'</option>';
  }
}
else {
  $project_value .='<option value="">Project unavailable</option>';
}
echo $project_value;
?>
