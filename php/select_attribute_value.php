<?php
include '../dbconnect/dbconnect.php';

//Create a variable
$product_set_id= $_POST['product_set_id'];

$sql = "SELECT * FROM key_value kv,product_set_attribute psa where psa.product_set_id=".$product_set_id." and psa.product_set_attribute_id_fk_key_value=kv.key_value_id and psa.delete_status<>1 order by psa.product_set_attribute_id_fk_key_value";

$last_attribute_name="";
$query = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($query))
{

	$current_attribute_name = $row['product_set_attribute_id_fk_key_value'];
	if($current_attribute_name <> $last_attribute_name)
	{
		if ($last_attribute_name)
		{
	echo '</select></div>';
		}
	echo '<div class="col-md-3"><input type="text" readonly class="form-control att_name_order att_id_order" name="attribute_name_input[]" value='.$row['value'].' > </input>	
	'; 
	echo '
	<select class="form-control att_id_values" name="product_set_attribute_id[]">
	<option hidden value="">Select Value</option>';
	
	}
		echo '<option value="'.$row['product_set_attribute_id'].'">'.$row['product_set_attribute_value'].'</option>';
		$last_attribute_name = $row['product_set_attribute_id_fk_key_value'];
 }
?>