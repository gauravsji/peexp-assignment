<?php
include '../../dbconnect/dbconnect.php';
include "../../extra/session.php";
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
		<input type='text' class='form-control' id='edit_modal_product_name' name='edit_modal_product_name' style='text-transform:capitalize' value='".$enquiry_product_result['product_name']."' />
		</div></div>
		<!--Product Name-->";

		echo "<!--Description--><div class='col-md-12'>
		<div class='form-group'>
		<label>Description</label>
		<textarea class='form-control' id='edit_modal_product_description' name='edit_modal_product_description' value=".$enquiry_product_result['product_description'].">".$enquiry_product_result['product_description']."</textarea>
		</div></div>
		<!--Description-->";

		echo "<!--Quantity--><div class='col-md-6'>
		<div class='form-group'>
		<label>Quantity</label>
		<input type='text' class='form-control' id='edit_modal_product_quantity'  value='".$enquiry_product_result['product_quantity']."' name='edit_modal_product_quantity' maxlength='50' onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode == 46'/>
		</div></div>
		<!--Quantity-->";

			echo "<div class='col-md-6'>
					<div class='form-group'>
					<label>Remarks</label>
					<textarea class='form-control' id='edit_modal_product_remarks' name='edit_modal_product_remarks' rows='3'>".$enquiry_product_result['product_remarks']."</textarea>
					</div>
					</div>";


      echo "<input type='hidden' id='edit_draft_id' name='edit_draft_id' value=".$enquiry_product_result['id']." />";
      echo "<input type='hidden' id='edit_rfq_id' name='edit_rfq_id' value=".$enquiry_product_result['product_enquiry_id']." />";

 }
?>
