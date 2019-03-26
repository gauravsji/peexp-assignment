<?php
//Include database configuration file
include "../extra/session.php";

if(isset($_POST["attribute_id"]) && !empty($_POST["attribute_id"]))
{
    //Get all state data
    $query = $conn->query("SELECT * FROM attribute");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //Display states list
    if($rowCount > 0)
	{
        while($row = $query->fetch_assoc())
		{ 
		if($row['attribute_id']==$_POST["attribute_id"])
            echo '<option value="'.$row['attribute_id'].'" selected>'.$row['attribute_name'].'</option>';
		else
		 echo '<option value="'.$row['attribute_id'].'" >'.$row['attribute_name'].'</option>';
        }
    }
	else
	{
        echo '<option value="">Attribute not available</option>';
    }
}
?>


