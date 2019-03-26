<!--
Description: This page is used to send purchase order.
Date: 04/07/2017
-->
<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";
		$ss_order_id=$_GET["id"];
		$sql1 = "SELECT * FROM ss_order o, vendor v, project p where p.project_id=o.project_id and o.vendor_id=v.vendor_id and o.delete_status<>1 and o.order_id = " . $ss_order_id;
		$result1 = mysqli_query($conn, $sql1);
		$order_result = mysqli_fetch_array($result1,MYSQLI_ASSOC);

		$sql2 = "SELECT * FROM customer where delete_status<>1 and customer_id = " . $order_result['customer_id'];
		$result2 = mysqli_query($conn, $sql2);
		$cust_result = mysqli_fetch_array($result2,MYSQLI_ASSOC);
		
		$sql4 = "SELECT * FROM order_product where delete_status<>1 and order_id = " . $ss_order_id;
		$result4 = mysqli_query($conn, $sql4);
		
		$sql5 = "SELECT * FROM project where delete_status<>1 and project_id = " . $order_result['project_id'];
		$result5 = mysqli_query($conn, $sql5);
		$project_result = mysqli_fetch_array($result5,MYSQLI_ASSOC);
		
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

			<div class="content-wrapper">
				<section class="content-header">
					<h1>
						Transport Delivery Challan
					</h1>
				</section>

				<section class="invoice">
					<div class="row">
						<div class="col-xs-12">
							<h2 class="page-header">
								<img src="../images/favicon.png" height="3%" width="6%"> Smartstorey
							</h2>
						</div>
					</div>
					
					<div class="row invoice-info">
						<div class="col-sm-4 invoice-col">         
							<address>
								<div class="table-responsive">
									<table class="table table-condensed table-bordered">
										<tr><td><center><strong>FROM</strong></center></td></tr>
										<tr><td width="30%"><center><strong>Smartstorey</strong></center></td></tr>
										<tr><td width="30%"><center> 3rd Floor, Sampurna Chambers, <br>
										Opposite Vijaya Bank, Vasavi Temple Street<br>
										Basavanagudi Bangalore<br></center>
										<table class="table table-condensed table-bordered">
											<tr><td>
											Phone: </td><td>+918884732111, +919901650420</td></tr>
											<tr><td>Email: </td><td>vendors@smartstorey.com</td></tr>
										</table>
										</td></tr>
									</table>
								</div>
							</address>
						</div>
						
						<div class="col-sm-4 invoice-col">
							<address>
								<div class="table-responsive">
									<table class="table table-condensed table-bordered">
										<tr><td><center><strong>TO</strong></center></td></tr>
										<tr><td width="30%"><center><strong><?php echo $cust_result['customer_name']."--".$project_result['project_name']; ?></strong></center></td></tr>								
										
										<tr><td width="30%"><center><?php echo $project_result['project_site_address']; ?>
										<table class="table table-condensed table-bordered">
								<tr><td>Site Incharge: </td><td><?php echo $project_result['project_site_incharge_name']; ?></td></tr>
								<tr><td>Phone: </td><td><?php echo $project_result['project_site_incharge_contact_number']; ?></td></tr>
								</table>
								</td></tr>
											
									</table>
								</div>
							</address>
						</div>
						
						<div class="col-sm-4 invoice-col">
							<address>
								<div class="table-responsive">
									<table class="table table-condensed table-bordered">
										<tr><td width="30%"><center><strong>Order ID:</strong></center></td><td><?php echo $order_result['order_id'];?></td></tr>
										<tr><td width="30%"><center><strong>Order Date:</strong></center></td><td>  <?php echo date("d-m-Y", strtotime($order_result['order_date']));?></td></tr>
									</table>
								</div>
							</address>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12 table-responsive">
							<table class="table table-striped">
								<thead>
									<tr>
										<th><center>Sl No.</center></th>
										<th><center>Product Name</center></th>
										<th><center>Description</center></th>
										<th><center>Quantity</center></th>
										<th><center>Acknowledgement</center></th>										
									</tr>
								</thead>
								<tbody>
									<?php $count=1; while ($order_product_result = mysqli_fetch_array($result4,MYSQLI_ASSOC)) {?>
									<tr>
										<td><center><?php echo $count;  ?></center></td>
										<td><center><?php echo $order_product_result['order_product_name'];  ?></center></td>
										<td><center><?php echo $order_product_result['order_product_description'];  ?></center></td>			
										<td><center><?php echo $order_product_result['order_product_quantity'];  ?></center></td>
										<td><center></center></td>
									</tr>
									<?php $count=$count+1;} ?>
								</tbody>
							</table>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<!--Order Remarks-->
							<div class="form-group">
								<textarea class="form-control" rows="3" id="ui_shipping_address" name="ui_shipping_address" maxlength="100" >This is to Certify that all the above-mentioned materials have been received. Thank you for doing business with us. If there is any issue or you require clarification please contact us.</textarea>
							</div>
							<!--Order Remarks-->
						</div>					
						
					</div>
					
					<!-- this row will not appear when printing -->
					<div class="row no-print">
						<div class="form-group col-md-1">
							<button type="button" class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
						</div>

						<div class="form-group col-md-2 col-md-offset-9">
							<a href="view_order_html.php?id=<?php echo $order_result['order_id'];?>" class="btn btn-primary">Back to Order</a>
						</div>

					</div>
				</section>
			</div>

			<!-- Main Footer -->
			<footer class="main-footer">
			</footer>

			<!--Including right slide panel-->
			<?php include "../extra/aside.php";?>
			<!--Including right slide panel-->
			
			<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		</div>
		<!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";?>
		<!--Including Bootstrap and other scripts-->
	</body>
</html>
