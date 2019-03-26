<?php
//Include database configuration file
include "../extra/session.php";

$customer_id=$_POST['customer_id'];
$project_id= $_POST['project_id']; 

if(isset($_POST["customer_id"]) && !empty($_POST["customer_id"]))
{
    //Get all state data
    $query = $conn->query("SELECT * FROM project WHERE delete_status<>1 and customer_id = ".$customer_id." ");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //Display states list
    if($rowCount > 0)
	{
        echo '<option value="">Select Project</option>';
        while($row = $query->fetch_assoc())
		{ 
			if ($row['project_id'] == $project_id)
				echo '<option value="'.$row['project_id'].'" selected>'.$row['project_name'].'</option>';
			else
				echo '<option value="'.$row['project_id'].'" >'.$row['project_name'].'</option>';
        }
    }
	else
	{
        echo '<option value="">Project unavailable</option>';
    }
}
?>