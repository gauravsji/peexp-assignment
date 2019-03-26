<?php
session_start();
include '../../dbconnect/dbconnect.php';

// $category_id=$_POST['category_id'];

	$sql = "SELECT * FROM category where delete_status<>1";
  $query = mysqli_query($conn, $sql);

	$category_selected_value = $_POST['category_values'];
	$category_array_values = explode(',',$_POST['category_values']);
	$select= "";
  $rowCount = $query->num_rows;
  $category_value = '';
	if($rowCount > 0)
  {
    $category_value .='<option value="">Select Category</option>';
    while($row = $query->fetch_assoc())
    {
			if($category_selected_value != '')
			{
				if(in_array($row['category_id'],$category_array_values))
				{
					$category_value .="<option value=".$row["category_id"]." selected>".$row['category_name']."</option>";
				}
				else {
						$category_value .="<option value=".$row["category_id"].">".$row['category_name']."</option>";
				}
			}
			else {
				$category_value .="<option value=".$row["category_id"].">".$row['category_name']."</option>";
			}

    }
  }
  else {
    $category_value .='<option value="">Category unavailable</option>';
  }
echo $category_value;
?>
