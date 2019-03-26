<?php
// This file makes a connection with mysql database. 
require_once("../dbconnect/dbconnect.php");
$draft_id=$_POST['draft_id'];
$enquiry_id=$_POST['enquiry_id'];
?>

<table id="view_order_product_html" class="table table-bordered table-striped table-fixed">
	<tbody>
		<thead>
		<tr>
		<th><center>Vendor Name</center></th>
		<th><center>vendor Contact</center></th>
		<th><center>Product Name</center></th>
		<th><center>product Quantity</center></th>
		<th><center>product price</center></th>
		<th><center>tax type</center></th>
		<th><center>Exclusive tax</center></th>
		<tr>
		</thead>
	<?php
	$sql1 = "SELECT * FROM pre_enquiry_vendor_product vp, pre_enquiry_vendor_details vd where vp.product_id=".$draft_id." and vp.pre_enquiry_vendor_id = vd.pre_enquiry_vendor_id and vp.pro_price!=''";
	$result1 = mysqli_query($conn,$sql1);
	while ($row2 = mysqli_fetch_array($result1))
	{
		echo '<tr><td contenteditable="true" align="center" onBlur=\'saveToDatabase(this,"vendor_name",'. $row2['pre_enquiry_vendor_id'].')\' onClick="showEdit(this)">' . $row2['vendor_name'] . '</td>';
		echo '<td contenteditable="true" align="center" onBlur=\'saveToDatabase(this,"vendor_number",'. $row2['pre_enquiry_vendor_id'].')\' onClick="showEdit(this)">' . $row2['vendor_number'] . '</td>';
		echo '<td contenteditable="true" align="center" onBlur=\'saveToDatabase(this,"pro_name",'. $row2['pre_vendor_pro_id'].')\' onClick="showEdit(this)">' . $row2['pro_name'] . '</td>';
		echo '<td contenteditable="true" align="center" onBlur=\'saveToDatabase(this,"pro_quantity",'. $row2['pre_vendor_pro_id'].')\' onClick="showEdit(this)">' . $row2['pro_quantity'] . '</td>';
		echo '<td contenteditable="true" onBlur=\'saveToDatabase(this,"pro_price",'. $row2['pre_vendor_pro_id'].')\' onClick="showEdit(this)">' . $row2['pro_price'] . '</td>';
		echo '<td><center>' . $row2['tax_type'] . '</center></td>';
		echo '<td><center>' . $row2['exclusive_tax'] . '</center></td></tr>';
	}
	?>	
	</tbody>
</table>
<script>
function saveToDatabase(editableObj,column,id) {
		jQuery(editableObj).css("background","#FFFFFF");
		jQuery.ajax({
			url: "../php/live_update/update_pre_enquiry_vendor.php",
			type: "POST",
			data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
			success: function(data){
				jQuery(editableObj).css("background","#f9f9f9");
			}        
	   });
	}
</script>