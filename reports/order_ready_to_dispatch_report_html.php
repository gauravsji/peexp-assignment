<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";
	$global_total=0;
	?>
	<!--Including Login Session-->
	<head>
		<!--Including Bootstrap CSS links-->
		<?php include "../extra/header.html";?>
		<!--Including Bootstrap CSS links-->
	</head>

	<body class="hold-transition skin-blue fixed sidebar-mini">
		<div class="wrapper">

		<!--Including Topbar-->
		<?php include "../extra/topbar.php";?>
		<!--Including Topbar-->

		<!-- Left Side Panel Which Contains Navigation Menu -->
		<?php include "../extra/left_nav_bar.php";?>
		<!-- Left Side Panel Which Contains Navigation Menu -->

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">

				<!-- Main content -->
				<section class="content">
					<div class="box">
						<div class="box-body">
							
							

<div class="table-responsive">
<table id="view_order_html" class="sieve table table-bordered table-striped table-fixed" style="border-collapse:collapse;">

		<thead>
			<!--<th><center>Products</center></th>-->
			<th><center>Order ID</center></th>
			<th><center>Order Date</center></th>
			<th><center>Order About</center></th>
			<th><center>Vendor Name</center></th>
			<th><center>Customer Name</center></th>
			<th><center>Project Name</center></th>
			<th><center>Order Status</center></th>
			<th><center>Products</center></th>
			<th><center>View</center></th>
			<th><center>Edit</center></th>
			<?php
			if($user_result['role']=="Admin")
			{
			echo '<th><center>Delete</th>';
			}
			?>
		</thead>
		<tbody>
		<?php

		if($settings_result['view_all_sales_order']!=1)
		{
			$sql = "SELECT * FROM ss_order o,vendor v,customer c,project p where o.vendor_id=v.vendor_id and o.customer_id=c.customer_id and o.project_id=p.project_id and o.delete_status=0 and order_status='Material Ready To Dispatch' and o.location='".$user_result['location']."'";
		}
		else
		{
			$sql = "SELECT * FROM ss_order o,vendor v,customer c,project p where o.vendor_id=v.vendor_id and o.customer_id=c.customer_id and o.project_id=p.project_id and order_status='Material Ready To Dispatch' and o.delete_status=0";
		}
			$result = mysqli_query($conn,$sql);
			while ($row = mysqli_fetch_array($result))
			{
				$global_order_id=$row['order_id'];
				// Print out the contents of the entry
				echo '<tr data-toggle="collapse" class="accordion-toggle" data-target="#prod';echo $global_order_id; echo'">';
				//echo '<td><center><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></center></td>';
				echo '<td><center>' . $row['order_id'] . '</center></td>';
				echo '<td><center>' . date("d-m-Y", strtotime($row['order_date'])) . '</center></td>';
				echo '<td><center>' . $row['order_brief_details'] . '</center></td>';
				echo '<td><center>' . $row['vendor_name'] . '</center></td>';
				echo '<td><center>' . $row['customer_name'] . '</center></td>';
				echo '<td><center>' . $row['project_name'] . '</center></td>';
				if( $row['order_status']=="Order Created")
					{
					echo '<td style="width:12%"><div class="badge bg-blue">' . $row['order_status'] . '</div></td>';
					}
					else if( $row['order_status']=="Order Placed")
					{
					echo '<td style="width:12%"><div class="badge bg-orange"><center>' . $row['order_status'] . '</div></td>';
					}
					else if( $row['order_status']=="Material Ready To Dispatch")
					{
					echo '<td style="width:12%"><div class="badge bg-olive">' . $row['order_status'] . '</div></td>';
					}
					else if( $row['order_status']=="Order Partially Delivered")
					{
					echo '<td style="width:12%"><div class="badge bg-teal">' . $row['order_status'] . '</div></td>';
					}
					else if( $row['order_status']=="Order Fulfilled")
					{
					echo '<td style="width:12%"><div class="badge bg-green">' . $row['order_status'] . '</div></td>';
					}				
					echo  '<td><a href="#modal_products" class="btn btn-primary btn-xs" id="view_products" data-toggle="modal" data-id="'.$row['order_id'].'">Products</a></td>';
				echo  "<td><center> <a target='_blank' href='../html/view_order_html.php?id=" . $row['order_id'] . "' class='btn btn-primary btn-xs'>View</a></center></td>";
				echo  "<td><center> <a target='_blank' href='../html/edit_order_html.php?id=" . $row['order_id'] . "' class='btn btn-warning btn-xs'>Edit</a></center></td>";
				if($user_result['role']=="Admin")
				{
				echo  "<td><center> <a onclick=\"return confirm('Delete this record?')\" href='../php/delete/delete_order.php?id=" . $row['order_id'] . "' class='btn btn-danger btn-xs'>Delete</a></center></td>";
				}
				echo "</tr>";


	/*echo '	<tr>
			<td colspan="12" class="hiddenRow">
				<div class="accordian-body collapse" id="prod'; echo $global_order_id; echo '">   
					<table id="view_order_product_html" class="table table-bordered table-striped table-fixed">				
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
							<tbody>
							';					
								$sql1 = "SELECT * FROM ss_order o,order_product op where o.order_id=op.order_id and o.order_id=".$global_order_id;
								$result1 = mysqli_query($conn,$sql1);
								while ($row1 = mysqli_fetch_array($result1))
								{
									// Print out the contents of the entry
									echo '<tr><td><center>' . $row1['order_product_name'] . '</center></td>';
									echo '<td><center>' . $row1['order_product_description'] . '</center></td>';
									echo '<td><center>' . $row1['order_product_quantity'] . '</center></td>';
									echo '<td><center>' . $row1['order_buying_price'] . '</center></td>';
									echo '<td><center>' . $row1['order_discount_percent'] . '</center></td>';
									echo '<td><center>' . $row1['order_discounted_price'] . '</center></td>';
									echo '<td><center>' . $row1['order_total_of_buying'] . '</center></td>';
									echo '<td><center>' . $row1['order_selling_percentage'] . '</center></td>';
									echo '<td><center>' . $row1['order_selling_price'] . '</center></td>';
									echo '<td><center>' . $row1['order_tax'] . '</center></td>';
									echo '<td><center>'; 
									if($row1['tax_inclusive']==1)
									{
										echo "Inclusive";
									}
									else
									{
										echo "Exclusive";
									}
									
									echo '</center></td>';
									echo '<td><center>' . $row1['order_total'] . '</center></td></tr>';
									$global_total=$global_total+$row1['order_total'];
								}		
echo '<tr><td colspan="11" align="right" ><strong>TOTAL</strong></td><td><strong><center>' . $global_total . '</center></strong></td></tr>';		
									$global_total=0;								
						echo '</tbody>
					</table>
				</div> 
			</td>
		</tr>';*/
		}
		?>
	</tbody>
</table>
			
						<!-- /.box-body -->
					</div>
				</section>
				<!-- /.content -->
			</div>
			<!-- /.content-wrapper -->

			<!-- Main Footer -->
			<footer class="main-footer">
				<div class="pull-right hidden-xs">				
				</div>		
				<strong>Order Report</strong> 				
			</footer>
			<!-- Main Footer -->

			<!--Including right slide panel-->
			<?php include "../extra/aside.php";?>
			<!--Including right slide panel-->
			<!-- Add the sidebar's background. This div must be placed
			immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		</div>
		<!-- ./wrapper -->
		<!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";?>
		<!--Including Bootstrap and other scripts-->
	</body>
	
	<script>
	$(document).ready(function()
	{
		// Handler for .ready() called.
		$("#li_order").addClass("active");
		$("#li_order_report").addClass("active");
		$('#view_order_html').DataTable({
		"aLengthMenu": [[25, 50, 75, 100 , -1], [25, 50, 75, 100, "All"]],
		"filter": true,
		"order": [[ 0, "desc" ]],
		"iDisplayLength": 25
		});		
		$('#view_orr_product_html').DataTable();
		// $("table.sieve").sieve();
	});

	
	$('#modal_products').on('show.bs.modal', function (e) 
	{
		var rowid = $(e.relatedTarget).data('id');
		$.ajax({
			type : 'post',
			url : '../php/products_line_item.php', //Here you will fetch records 
			data :  'order_id='+ rowid, //Pass $id
			success : function(data)
			{
				$('.fetched-data').html(data);//Show fetched data from database
			}
		});
	});
				
				
	$('a.delete').on('click', function() 
		{
			var choice = confirm('Do you really want to delete this record?');
			if(choice === true) 
			{
				return true;
			}
			return false;
		});
	</script>
</html>