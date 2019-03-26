<?php
// This file makes a connection with mysql database. 
require_once("../dbconnect/dbconnect.php");
$draft_id=$_POST['draft_id'];
?>
<table id="products" class="table table-fixed table-condensed table-bordered" border="0" style="overflow: scroll;">
	<tbody>
	<?php
	
	$sql4 = "SELECT * FROM pre_enquiry_product where pre_enquiry_id=".$draft_id;
	$result4 = mysqli_query($conn,$sql4);
	while ($rows2 = mysqli_fetch_array($result4))
	{
	?>
	<tr>
		<p>
		<td><input type="hidden" name="pre_enquiry_id" class="form-control" value="<?php echo $rows2['pre_enquiry_id'];?>">
		</td>
		<td><input type="hidden" name="pre_enquiry_product_id" class="form-control" value="<?php echo $rows2['pre_enquiry_product_id'];?>">
		</td>
		<td>
			<center><label for="pro_name_modal">Product Name</label></center>
			<input type="text" class="form-control" style="text-transform:capitalize" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode==32' name="pro_name_modal" id="pro_name_modal" value="<?php echo $rows2['pro_name']; ?>"/>
		</td>
		<td>
			<center><label for="pro_description_modal">Descriptions</label></center>
			<input type="text" class="form-control" name="pro_description_modal" value="<?php echo $rows2['pro_description']; ?>"/>
		</td>
		<!--Quantity-->
		<td>
			<center><label for="pro_quantity_modal">Quantity</label></center>
				<input type="text" class="form-control" id="pro_quantity_modal" name="pro_quantity_modal" maxlength="50" onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46' value="<?php echo $rows2['pro_quantity']; ?>"/>
		</td>
		<td>
			<center><label for="pro_price">Price</label></center>
			<input type="text" class="form-control" name="pro_price"/>
		</td>
		<td>
		<center><label for="tax_type">Tax</label></center>
		<select type="text" class="form-control tax_type" id="tax_type" name="tax_type" >
				<option value="inclusive">Inclusive</option>
				<option value="exclusive">Exclusive</option>
			</select>
		</td>
		<td class="tax_rate">
		<center><label for="tax_rate">Tax Rate</label></center>
			<select type="text" class="form-control" id="tax_rate" name="tax_rate">
				<option value="0">0%</option>
				<option value="5">5%</option>
				<option value="12">12%</option>
				<option value="18">18%</option>
				<option value="28">28%</option>
			</select>
		</td>
		</p>
	</tr>
	<?php
	}
	?>
</tbody>
</table>
