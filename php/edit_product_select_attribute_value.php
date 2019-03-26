<?php
	include '../dbconnect/dbconnect.php';

	$select_count=0;
	//Create a variable
	$product_set_id= $_POST['product_set_id'];  //Get Product Set ID
	$product_id= $_POST['product_id']; //Get Product ID
	$psa_ID = 0;

	$sql = "Select * from key_value kv,product_set_attribute psa,product_set ps where ps.product_set_id = ".$product_set_id." and ps.product_set_id = psa.product_set_id and psa.product_set_attribute_id_fk_key_value = kv.key_value_id and psa.delete_status<>1 order by kv.value";

	$last_attribute_id="";	 //Initially Last attribute name will be null
	$query = mysqli_query($conn, $sql); //Query will execute
	while($row = mysqli_fetch_array($query)) //Loops through the data array returned from query
	{
		$current_attribute_id = $row['product_set_attribute_id_fk_key_value']; //Current Attribute will be Key id from product set attribute table
		if($current_attribute_id <> $last_attribute_id) //If current attribute is equal to the last attribute id 
		{
			if ($last_attribute_id) //If last attribute is not null. ie it has already passed through the loop and has value then end the select html tag and div 
			{
				echo '</select></div>';  //End select tag
				echo '<input type="hidden" name="product_attribute_id[]" value='.$psa_ID.'>';
				$psa_ID = "";
			} 			
			echo '<div class="form-group col-md-3"><input type="text" readonly class="form-control att_name_order" name="attribute_name_input[]" value='.$row['value'].' > </input>';
			
			echo '<select class="form-control att_id_values" name="attribute_values[]">
			<option hidden value="">Select Value</option>';
		}
		$sql_product = "select * from product p, product_attribute pa where p.product_id=pa.product_id and p.product_id=".$product_id;
		$query_product = mysqli_query($conn, $sql_product);
		while($row_product = mysqli_fetch_array($query_product))
		{
			if ($row_product['product_set_attribute_id'] == $row['product_set_attribute_id'])									
			{
				$psa_ID = $row_product['product_attribute_id'];
				echo '<option value="'.$row_product['product_set_attribute_id'].'" selected>'.$row['product_set_attribute_value'].'</option>';
				$select_count=1;
			}	
		}
		if($select_count!=1)
		{
		echo '<option value="'.$row['product_set_attribute_id'].'">'.$row['product_set_attribute_value'].'</option>';	
		}
		$last_attribute_id= $row['product_set_attribute_id_fk_key_value'];
		$select_count=0;
	}
	
	echo '</select></div>';  //End select tag
	echo '<input type="hidden" name="product_attribute_id[]" value='.$psa_ID.'>';
?>