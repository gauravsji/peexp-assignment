<?php
//Include database configuration file
include "../extra/session.php";
$category_id=$_POST['p_Category']; // $_POST['sub_form_category_id'];
$sub_category_id= $_POST['p_Subcategory'];  //$_POST['sub_category_name'];


if(isset($_POST["p_Category"]) && !empty($_POST["p_Category"]))
{
    //Get all state data
    $query = $conn->query("SELECT * FROM sub_category WHERE category_id = ".$category_id." ");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //Display states list
    if($rowCount > 0)
	{
        echo '<option value="" disabled>Select Subcategory</option>';
        while($row = $query->fetch_assoc())
		{ 
			if ($row['sub_category_id'] == $sub_category_id)
				echo '<option value='.$row['sub_category_id'].' selected>'.$row['sub_category_name'].'</option>';
			else
				echo '<option value='.$row['sub_category_id'].' >'.$row['sub_category_name'].'</option>';
        }
    }
	else
	{
        echo '<option value="">Sub Category not Available</option>';
    }
}
?>