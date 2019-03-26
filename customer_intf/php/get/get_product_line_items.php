<?php
	require_once("../../dbconnect/dbconnect.php");
	$order_id=$_POST['order_id'];

	$result= "";
	$global_total=0;
	$sql_query = "SELECT * FROM ss_order o,order_product op where o.order_id=op.order_id and op.delete_status =0  and o.order_id=".$order_id;

	$get_product_line_items = mysqli_query($conn,$sql_query);
	$result.='<table id="view_order_product_html" class="table table-bordered table-striped table-fixed table-condensed">
							<thead>
									<th><center>Product Name</th>
									<th><center>Description</th>
									<th><center>Quantity </th>
									<th><center>Buying Price</th>
									<th><center>Discount Percent</th>
									<th><center>Discount Price</th>
									<th><center>Buying Total</th>
									<th><center>Selling Percent</th>
									<th><center>Selling Price</th>
									<th><center>Tax</th>
									<th><center>Tax I/E</th>
									<th><center>Selling Total</th>
							</thead>
							<tbody>';
	while ($get_product_line_item = mysqli_fetch_array($get_product_line_items))
	{
		// Print out the contents of the entry
		$result.= '<tr><td><center>' . $get_product_line_item['order_product_name'] . '</center></td>';
		$result.= '<td><center>' . $get_product_line_item['order_product_description'] . '</center></td>';
		$result.= '<td><center>' . $get_product_line_item['order_product_quantity'] . '</center></td>';
		$result.= '<td><center>' . $get_product_line_item['order_buying_price'] . '</center></td>';
		$result.= '<td><center>' . $get_product_line_item['order_discount_percent'] . '</center></td>';
		$result.= '<td><center>' . $get_product_line_item['order_discounted_price'] . '</center></td>';
		$result.= '<td><center>' . $get_product_line_item['order_total_of_buying'] . '</center></td>';
		$result.= '<td><center>' . $get_product_line_item['order_selling_percentage'] . '</center></td>';
		$result.= '<td><center>' . $get_product_line_item['order_selling_price'] . '</center></td>';
		$result.= '<td><center>' . $get_product_line_item['order_tax'] . '</center></td>';
		$result.= '<td><center>';
		if($get_product_line_item['tax_inclusive']==1)
		{
			$result.= "Inclusive";
		}
		else
		{
			$result.= "Exclusive";
		}

		$result.= '</center></td>';
		$result.= '<td><center>' . $get_product_line_item['order_total'] . '</center></td></tr>';
		$global_total=$global_total+$get_product_line_item['order_total'];
	}
		$result.= '<tr><td colspan="11" align="right" ><strong>TOTAL</strong></td><td><strong><center>' . $global_total . '</center></strong></td></tr>';
		$global_total=0;


		$result.='</tbody>
					</table>';
echo $result;
?>
