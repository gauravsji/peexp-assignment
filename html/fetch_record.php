<?php
include "../extra/session.php";
//Include database connection
if($_POST['rowid']) {
    $id = $_POST['rowid']; //escape string
	$sql = "SELECT * FROM order_product WHERE delete_status<>1 and order_product_id='$id'";
	$result = mysqli_query($conn,$sql);
	$order_product_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
    // Run the Query
    // Fetch Records
    // Echo the data you want to show in modal
		echo "<form role='form' id='contact' name='edit_order' method='post'> <div class='row'>";
		echo "<!--Product Name--><div class='col-md-12'>
		<div class='form-group'>
		<label>Product Name</label>
		<input type='text' class='form-control' id='edit_modal_product_name' name='edit_modal_product_name' autocomplete='off' style='text-transform:capitalize' value='".$order_product_result['order_product_name']."' onkeyup='edit_autocomplete()'/>
		</div></div>
		<!--Product Name-->";
		echo "<ul name='edit_products_list' id='edit_products_list'></ul>";

		echo "<!--Description--><div class='col-md-12'>
		<div class='form-group'>
		<label>Description</label>
		<textarea class='form-control' id='edit_modal_product_description' name='edit_modal_product_description'>".$order_product_result['order_product_description']."</textarea>
		</div></div>
		<!--Description-->";
		
		echo '		
			<!--Product ID-->
						<input type="hidden" id="edit_modal_product_id" name="edit_modal_product_id" value="'.$order_product_result['o_product_id'].'" />
					<!--Product ID-->';
					
					
					
					 $product_id = $order_product_result['o_product_id']; //escape string
					$sql1 = "SELECT * FROM vendor_product WHERE delete_status<>1 and product_id='$product_id'";
					$result1 = mysqli_query($conn,$sql1);
					$vendor_p_result = mysqli_fetch_array($result1,MYSQLI_ASSOC);
	
				echo '	<!--Previous Buy-->
					<div class="col-md-6">
					<div class="form-group">
					 <label>Previous Buy</label>
						<input type="text" class="form-control" id="edit_modal_previous_buy" name="edit_modal_previous_buy"  readonly value="'.$vendor_p_result['product_vendor_price'] .'"/>
					</div>
					</div>
					<!--Previous Buy-->';
					
					
					 $product_id = $order_product_result['o_product_id']; //escape string
					$sql2 = "SELECT * FROM customer_product WHERE delete_status<>1 and product_id='$product_id'";
					$result2 = mysqli_query($conn,$sql2);
					$customer_p_result = mysqli_fetch_array($result2,MYSQLI_ASSOC);
					
					echo '<!--Previous Sell-->
					<div class="col-md-6">
					<div class="form-group">
					 <label>Previous Sell</label>
						<input type="text" class="form-control" id="edit_modal_previous_sell" name="edit_modal_previous_sell" readonly value="'.$customer_p_result['product_customer_price'].'"/>
					</div>
					</div>
					<!--Previous Sell-->';
					
					
					

		echo "<!--Quantity--><div class='col-md-3'>
		<div class='form-group'>
		<label>Quantity</label>
		<input type='text' class='form-control' id='edit_modal_product_quantity' oninput='edit_product_price_function();' value='".$order_product_result['order_product_quantity']."' name='edit_modal_product_quantity' maxlength='50' onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46' />
		</div></div>
		<!--Quantity-->";

		echo "<!--Buying Price--><div class='col-md-3'>
		<div class='form-group'>
		<label>Buying Price</label>
		<input type='text' class='form-control' id='edit_modal_product_buying_price' name='edit_modal_product_buying_price' oninput='edit_product_price_function();'  maxlength='50' onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46' value='".$order_product_result['order_buying_price']."'/>
		</div></div>
		<!--Buying Price-->";

		echo "<!--Discount Percent--><div class='col-md-2'>
		<div class='form-group'>
		<label>Discount Percent</label>
		<input type='text' class='form-control' id='edit_modal_product_discount_percent' onchange='handleChange(this);' oninput='edit_product_price_function();' name='edit_modal_product_discount_percent' maxlength='7' onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46'  value='".$order_product_result['order_discount_percent']."'/>
		</div></div>
		<!--Discount Percent-->";
		
		echo "<!--Discounted Price-->
<div class='col-md-2'>
<div class='form-group'>
<label>Discounted Price</label>
<input type='text' class='form-control' readonly id='edit_modal_product_discounted_price' name='edit_modal_product_discounted_price' maxlength='50' onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46' value='".$order_product_result['order_discounted_price']."'/>
</div>
</div>
<!--Discounted Price-->	";

		echo "<!--Total Buying Price-->
					<div class='col-md-2'>
						<div class='form-group'>
						 <label>Total Buying Price</label>
							<input type='text' class='form-control' readonly id='edit_modal_product_total_of_buying' name='edit_modal_product_total_of_buying' maxlength='50' onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46' value='".$order_product_result['order_total_of_buying']."'/>
						</div>
					</div>
					<!--Total Buying Price-->";
		echo "
		<!--Selling Percent--><div class='col-md-6'>
		<div class='form-group'>
		<label>Selling Percent</label>
		<input type='text' class='form-control' id='edit_modal_product_selling_percent' onchange='handleChange(this);' oninput='edit_product_price_function();' name='edit_modal_product_selling_percent' maxlength='7' onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46' value='".$order_product_result['order_selling_percentage']."'/>
		</div></div>
		<!--Selling Percent-->	";
		
		echo "
		<!--Selling Price--><div class='col-md-6'>
		<div class='form-group'>
		<label>Selling Price</label>
		<input type='text' class='form-control' id='edit_modal_product_selling_price' name='edit_modal_product_selling_price' maxlength='10' oninput='edit_product_price_function();' onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46' value='".$order_product_result['order_selling_price']."'/>
		</div></div>
		<!--Selling Price-->	";


		echo "<div class='col-md-4'><div class='form-group'><label>Tax</label> 	
		
		<select id='edit_modal_product_tax' name='edit_modal_product_tax' oninput='edit_product_price_function();' class='form-control' >
		<option value='' selected>Select</option>";					
		$sql_tax = 'SELECT * FROM key_value where key_column = "TAX" and delete_status<>1 ORDER BY value';
		$tax_query = mysqli_query($conn, $sql_tax);
		while($tax_row = mysqli_fetch_array($tax_query))
		{

		if ($tax_row['value'] == $order_product_result['order_tax']):
		{
		echo "<option value='" . $tax_row['value'] . "' selected>" . $tax_row['value']. "</option>";
		}
		else:
		{
		echo "<option value='" . $tax_row['value'] . "'>" . $tax_row['value']. "</option>";
		}
		endif;

		}					

		echo "</select></div>
					</div>";


		echo "<!--Tax Inclusive--><div class='col-md-4'>
					
		<div class='form-group'>
		<label>Tax Inclusive</label> 	
		<input type='checkbox' class='checkbox' id='edit_modal_tax_inclusive' onclick='edit_product_price_function();' name='edit_modal_tax_inclusive'";
		if($order_product_result['tax_inclusive']==1)
		{echo "checked value='1'"; } 
		else { echo "value='0'";} 
		echo " />
			
		</div></div>	
		<!--Tax Inclusive-->";


		echo "	<!--Total--><div class='col-md-4'>
		<div class='form-group'>
		<label>Total</label>
		<input type='text' class='form-control' readonly id='edit_modal_product_total' name='edit_modal_product_total' maxlength='50' onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode==46'   value='".$order_product_result['order_total']."'/>
		</div></div>
		<!--Total-->	";

		echo "<input type='hidden' id='edit_draft_id' name='edit_draft_id' value='".$order_product_result['order_product_id']."'/>";
		echo "</form>";
 }
?>