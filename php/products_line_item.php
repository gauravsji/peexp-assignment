<?php 	
require_once("../dbconnect/dbconnect.php");
$order_id=$_POST['order_id'];
				
				$result= "";
					$global_total=0;
	$sql1 = "SELECT * FROM ss_order o,order_product op where o.order_id=op.order_id and op.delete_status =0  and o.order_id=".$order_id;
	$result1 = mysqli_query($conn,$sql1);
	
	
	
	
	
	
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
	while ($row1 = mysqli_fetch_array($result1))
	{
		// Print out the contents of the entry
		$result.= '<tr><td><center>' . $row1['order_product_name'] . '</center></td>';
		$result.= '<td><center>' . $row1['order_product_description'] . '</center></td>';
		$result.= '<td><center>' . $row1['order_product_quantity'] . '</center></td>';
		$result.= '<td><center>' . $row1['order_buying_price'] . '</center></td>';
		$result.= '<td><center>' . $row1['order_discount_percent'] . '</center></td>';
		$result.= '<td><center>' . $row1['order_discounted_price'] . '</center></td>';
		$result.= '<td><center>' . $row1['order_total_of_buying'] . '</center></td>';
		$result.= '<td><center>' . $row1['order_selling_percentage'] . '</center></td>';
		$result.= '<td><center>' . $row1['order_selling_price'] . '</center></td>';
		$result.= '<td><center>' . $row1['order_tax'] . '</center></td>';
		$result.= '<td><center>'; 
		if($row1['tax_inclusive']==1)
		{
			$result.= "Inclusive";
		}
		else
		{
			$result.= "Exclusive";
		}
		
		$result.= '</center></td>';
		$result.= '<td><center>' . $row1['order_total'] . '</center></td></tr>';									
		$global_total=$global_total+$row1['order_total'];
	}		
		$result.= '<tr><td colspan="11" align="right" ><strong>TOTAL</strong></td><td><strong><center>' . $global_total . '</center></strong></td></tr>';		
		$global_total=0;	

		
		$result.='</tbody>
					</table>';
echo $result; 		
?>									