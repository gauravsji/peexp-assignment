<?php
include "../extra/session.php";
//Include database connection
if($_POST['rowid']) {
    $id = $_POST['rowid']; //escape string

	$sql = "SELECT * FROM customer_rfq_enquiry WHERE delete_status<>1 and id=$id ";
	$result = mysqli_query($conn,$sql);
	$enquiry_product_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
    // Run the Query
    // Fetch Records
    // Echo the data you want to show in modal
		echo "<form role='form' id='edit_enquiry' name='edit_enquiry' method='post'> <div class='row'>";
		echo "<!--Product Name--><div class='col-md-12'>
		<div class='form-group'>
		<label>Product Name</label>
		<input type='text' class='form-control' id='edit_modal_product_name' name='edit_modal_product_name' style='text-transform:capitalize' value='".$enquiry_product_result['product_name']."' readonly/>
		</div></div>
		<!--Product Name-->";

		echo "<!--Description--><div class='col-md-12'>
		<div class='form-group'>
		<label>Description</label>
		<textarea class='form-control' id='edit_modal_product_description' name='edit_modal_product_description' readonly>".$enquiry_product_result['product_description']."</textarea>
		</div></div>
		<!--Description-->";

		echo "<!--Quantity--><div class='col-md-3'>
		<div class='form-group'>
		<label>Quantity</label>
		<input type='text' class='form-control' id='edit_modal_product_quantity' oninput='edit_product_price_function();' value='".$enquiry_product_result['product_quantity']."' name='edit_modal_product_quantity' maxlength='50' onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode == 46'/>
		</div></div>
		<!--Quantity-->";

		echo "<!--Buying Price--><div class='col-md-3'>
		<div class='form-group'>
		<label>Buying Price</label>
		<input type='text' class='form-control' id='edit_modal_product_buying_price' name='edit_modal_product_buying_price' oninput='edit_product_price_function();'  maxlength='50' onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46' value='".$enquiry_product_result['enquiry_buying_price']."'/>
		</div></div>
		<!--Buying Price-->";

		echo "<!--Discount Percent--><div class='col-md-2'>
		<div class='form-group'>
		<label>Discount Percent</label>
		<input type='text' class='form-control' id='edit_modal_product_discount_percent' onchange='handleChange(this);' oninput='edit_product_price_function();' name='edit_modal_product_discount_percent' onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46'  value='".$enquiry_product_result['enquiry_discount_percent']."' min='0' max='100'/>
		</div></div>
		<!--Discount Percent-->";

		echo "<!--Discounted Price-->
<div class='col-md-2'>
<div class='form-group'>
<label>Discounted Price</label>
<input type='text' class='form-control' readonly id='edit_modal_product_discounted_price' name='edit_modal_product_discounted_price' maxlength='50' onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46' value='".$enquiry_product_result['enquiry_discounted_price']."'/>
</div>
</div>
<!--Discounted Price-->	";

		echo "<!--Total Buying Price-->
					<div class='col-md-2'>
						<div class='form-group'>
						 <label>Total Buying Price</label>
							<input type='text' class='form-control' readonly id='edit_modal_product_total_of_buying' name='edit_modal_product_total_of_buying' maxlength='50' onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46' value='".$enquiry_product_result['enquiry_total_of_buying']."'/>
						</div>
					</div>
					<!--Total Buying Price-->";
		echo "
		<!--Selling Percent--><div class='col-md-2'>
		<div class='form-group'>
		<label>Selling Percent</label>
		<input type='text' class='form-control' id='edit_modal_product_selling_percent' onchange='handleChange(this);' oninput=\"edit_product_price_function('D');\" name='edit_modal_product_selling_percent' maxlength='30' onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46' value='".$enquiry_product_result['enquiry_selling_percentage']."' min='0' max='100'/>
		</div></div>
		<!--Selling Percent-->	";

		echo "
		<!--Selling Price--><div class='col-md-3'>
		<div class='form-group'>
		<label>Selling Price</label>
		<input type='text' class='form-control' id='edit_modal_product_selling_price' name='edit_modal_product_selling_price' onchange='handleChange(this);' oninput=\"edit_product_price_function('P');\" maxlength='10' onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46' value='".$enquiry_product_result['enquiry_selling_price']."'/>
		</div></div>
		<!--Selling Price-->	";


		echo "<div class='col-md-3'><div class='form-group'><label>Tax</label>

		<select id='edit_modal_product_tax' name='edit_modal_product_tax' oninput='edit_product_price_function();' class='form-control' >
		<option value='' selected>Select</option>";
		$sql_tax = 'SELECT * FROM key_value where key_column = "TAX" and delete_status<>1 ORDER BY value';
		$tax_query = mysqli_query($conn, $sql_tax);
		while($tax_row = mysqli_fetch_array($tax_query))
		{

		if ($tax_row['value'] == $enquiry_product_result['enquiry_tax']):
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


		echo "<!--Tax Inclusive--><div class='col-md-2'>

		<div class='form-group'>
		<label>Tax Inclusive</label>
		<input type='checkbox' class='checkbox' id='edit_modal_tax_inclusive' onclick='edit_product_price_function();' name='edit_modal_tax_inclusive'";
		if($enquiry_product_result['tax_inclusive']==1)
		{echo "checked value='1'"; }
		else { echo "value='0'";}
		echo " />

		</div></div>
		<!--Tax Inclusive-->";




		echo "	<!--Total--><div class='col-md-2'>
		<div class='form-group'>
		<label>Total</label>
		<input type='text' class='form-control' readonly id='edit_modal_product_total' name='edit_modal_product_total' maxlength='50' onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46'   value='".$enquiry_product_result['enquiry_total']."'/>
		</div></div>
		<!--Total-->	";


			echo "<div class='col-md-6'>
					<div class='form-group'>
					<label>Remarks</label>
					<textarea class='form-control' id='edit_modal_product_remarks' name='edit_modal_product_remarks' rows='3'>".$enquiry_product_result['product_remarks']."</textarea>
					</div>
					</div>";




/*echo "<div class='col-md-6'>
					<div class='form-group'>
					<label>Status</label>
					<select id='edit_modal_product_status' name='edit_modal_product_status' class='form-control'>";
                if($enquiry_product_result['product_status'] == '' || $enquiry_product_result['product_status'] == 'Request Created')
                {
                  echo "<option value='Accept'>Accept</option>";
                  echo "<option value='Reject'>Reject</option>";
                  echo "<option value='Rework'>Rework</option>";
                }
                elseif ($enquiry_product_result['product_status'] == 'Accept') {
                  echo "<option value='Accept' selected>Accept</option>";
                  echo "<option value='Reject'>Reject</option>";
                  echo "<option value='Rework'>Rework</option>";
                }
                elseif ($enquiry_product_result['product_status'] == 'Reject') {
                  echo "<option value='Accept' >Accept</option>";
                  echo "<option value='Reject' selected>Reject</option>";
                  echo "<option value='Rework'>Rework</option>";
                }
                elseif ($enquiry_product_result['product_status'] == 'Rework') {
                  echo "<option value='Accept'>Accept</option>";
                  echo "<option value='Reject'>Reject</option>";
                  echo "<option value='Rework' selected>Rework</option>";
                }
					echo "</select>
					</div>
					</div>";*/
		echo "<input type='hidden' id='edit_draft_id' name='edit_draft_id' value='".$enquiry_product_result['id']."'/>";
    echo "<input type='hidden' id='edit_id' name='edit_id' value='".$id."'/>";
		echo "</form>";
 }
?>
