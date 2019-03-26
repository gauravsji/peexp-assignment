<!--
Description: View order module displays information about the order such as the status, customer & vendor information etc.
Date: 04/07/2017
-->
<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";
		$order_id=$_GET["id"];
		$sql = "SELECT * FROM ss_order ss, order_account oa, order_transport ot, vendor v, customer c, project p where  p.project_id=ss.project_id and ss.customer_id=c.customer_id and ss.order_id=oa.order_id and ss.order_id=ot.order_id and ss.vendor_id=v.vendor_id and ss.order_id = " . $order_id;
		$result = mysqli_query($conn, $sql);
		$order_result = mysqli_fetch_array($result,MYSQLI_ASSOC);

		$sql4 = "SELECT * FROM order_product where delete_status<>1 and order_id = " . $order_id;
		$result4 = mysqli_query($conn, $sql4);
		$result7 = mysqli_query($conn, $sql4);

		$sql_email_settings = "SELECT * FROM email_settings where email_module='PURCHASE ORDER'";
		$result_email_settings = mysqli_query($conn, $sql_email_settings);
		$email_settings_result = mysqli_fetch_array($result_email_settings,MYSQLI_ASSOC);


		$sql_email_settings_invoice = "SELECT * FROM email_settings where email_module='INVOICE'";
		$result_email_settings_invoice = mysqli_query($conn, $sql_email_settings_invoice);
		$email_settings_result_invoice = mysqli_fetch_array($result_email_settings_invoice,MYSQLI_ASSOC);
		$grand_total_por=0;
	?>

	<script>

				function toggle_color(table_row) {
			  if ((table_row.style.backgroundColor != "lightgreen"))
				{table_row.style.backgroundColor = "lightgreen";}
			  else
				{table_row.style.backgroundColor = "";}
			}
	</script>
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
						Order Details
						<a href="../reports/all_order_report_html.php" class="btn pull-right">
							<button type="button" class="btn btn-sm btn-primary ">
								<i class="fa fa-arrow-left"></i> Back To Report
							</button>
						</a>
					</h1>
				</section>
				<section class="content">
					<div class="box">
						<div class="box-body pad">
							<div class="row">
								<div class="col-xs-12">
									<h2 class="page-header">
									<i></i>  <center><h3>Order For:  <strong><?php echo $order_result['order_brief_details']; ?></strong></h3></center>
										<div class="pull-left">Date:  <strong><?php  echo date("d-m-Y", strtotime($order_result['order_date'])) ?></strong> </div>
										<div class="pull-right">Order No:  <strong><?php  echo $order_result['order_id']; ?></strong> </div>

										<br><br>

										<div class="btn-toolbar">
											<?php echo '<a class="btn btn-sm btn-primary btn-flat pull-right" href="../html/edit_order_html.php?id='.$order_id.'"';'>'?>
												<button type="button" class="btn btn-sm btn-primary ">
													<i class="fa fa-edit"></i> Edit
												</button>
											</a>

											<?php echo '<a class="btn btn-sm btn-primary btn-flat pull-left" href="../html/transport_delivery_challan_order_html.php?id='.$order_id.'"';'>'?>
												<button type="button" class="btn btn-sm btn-primary ">
													<i class="fa fa-truck "></i>&nbsp; Transport DC
												</button>
											</a>


											<?php echo '<a class="btn btn-sm btn-primary btn-flat pull-right" href="../html/clone_order_html.php?id='.$order_id.'"';'>'?>
												<button type="button" class="btn btn-sm btn-primary ">
													<i class="fa fa-clone"></i>&nbsp; Clone
												</button>
											</a>

											<button type="button" class="btn btn-primary btn-flat btn-sm pull-right" data-toggle="modal" data-target="#add_task">
												<i class="fa fa-plus"></i> &nbsp;Add Task
											</button>


											<button type="button" class="btn btn-primary btn-flat btn-sm pull-left" data-toggle="modal"  data-target="#send_purchase_order">
												<i class="fa fa-plus"></i>&nbsp; Send Purchase Order
											</button>

											<button type="button" class="btn btn-primary btn-flat btn-sm pull-left" data-toggle="modal"  data-target="#send_invoice">
												<i class="fa fa-plus"></i>&nbsp; Send Invoice
											</button>
										</div>
										<center><small>Status:<strong><?php echo $order_result['order_status'] ?></strong></small></center>
									</h2>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-6 invoice-col">
									<address>
										<div class="table-responsive">
											<table class="table table-condensed">
												<tr><td colspan="2"><center><strong>VENDOR</strong></center></td></tr>
												<tr><td width="25%"><center>Name:</center> </td><td> <center><strong>  <?php echo $order_result['vendor_name'] ?></strong></center></td></tr>
												<tr><td><center>Contact Person:</center> </td><td> <center><strong>  <?php echo $order_result['vendor_contact_person'] ?></strong></center></td></tr>
												<tr><td><center>Contact Number:</center> </td><td> <center><strong>  <?php echo $order_result['vendor_contact_number'] ?></strong></center></td></tr>
												<tr><td><center>Email:</center> </td><td><center><strong><?php echo $order_result['vendor_email'] ?></strong></center></td></tr>
												<tr><td><center>Alternate Email:</center> </td><td> <center><strong>  <?php echo $order_result['vendor_alternate_email'] ?></strong></center></td></tr>
											</table>
										</div>
									</address>
								</div>

								<div class="col-sm-6 invoice-col">
									<address>
										<div class="table-responsive">
											<table class="table table-condensed">
												<tr><td colspan="2"><center><strong>CUSTOMER</strong></center></td></tr>
												<tr><td width="25%"><center>Name:</center> </td><td> <center><strong><?php echo $order_result['customer_name'] ?></strong></center></td></tr>
												<tr><td><center>Contact Person:</center></td><td><center><strong>  <?php echo $order_result['customer_contact_person'] ?></strong></center></td></tr>
												<tr><td><center>Contact Number:</center></td><td><center><strong>  <?php echo $order_result['customer_contact_number'] ?></strong></center></td></tr>
												<tr><td><center>Email:</center> </td><td> <center><strong>  <?php echo $order_result['customer_email'] ?></strong></center></td></tr>
												<tr><td><center>Alternate Email:</center> </td><td> <center><strong>  <?php echo $order_result['customer_alternate_email'] ?></strong></center></td></tr>
												<tr><td><center>Order Placed By:</center></td><td><center><strong>  <?php echo $order_result['order_placed_by'] ?></strong></center></td></tr>
												<tr><td><center>Project Name:</center></td><td><center><strong>  <?php echo $order_result['project_name'] ?></strong></center></td></tr>
											</table>
										</div>
									</address>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-6 invoice-col">
									<address>
										<div class="table-responsive">
											<table class="table table-condensed">
												<tr><td class="bg-orange"><center><strong>FROM</strong></center></td></tr>
												<tr><td><center><strong><?php echo $order_result['vendor_address'] ?></strong></center></td></tr>

											</table>
										</div>
									</address>
								</div>

								<div class="col-sm-6 invoice-col">
									<address>
										<div class="table-responsive">
											<table class="table table-condensed">
												<tr  class="bg-orange"><td colspan="2"><center><strong>TO</strong></center></td></tr>
												<tr><td colspan="2"><center>
												<strong>
												<?php
													if($order_result['project_name']=='Ad Hoc')
													{
														echo $order_result['customer_address'];
													}
													else
													{
														echo $order_result['project_site_address'];
													}
												?>
												</strong></center></td></tr>
												<tr><td><center>Site Incharge Name:</center></td><td><center><strong>  <?php echo $order_result['project_site_incharge_name'] ?></strong></center></td></tr>
												<tr><td><center>Contact Number:</center></td><td><center><strong>  <?php echo $order_result['project_site_incharge_contact_number'] ?></strong></center></td></tr>
											</table>
										</div>
									</address>
								</div>
							</div>

							<div class="table-responsive">
								<table class='table table-bordered table-striped table-fixed'>
									<thead>
										<tr>
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
											<th><center>Tax I/E</center></th>
											<th><center>Selling Total</th>
										</tr>
									</thead>
									<tbody>
										<tr onclick="toggle_color(this)">
										<?php
										$grand_total=0;
										$buying_total=0;
										$sql = 'SELECT * FROM ss_order o,order_product op where o.order_id='.$order_id.' and o.order_id=op.order_id and op.delete_status<>1';
										$result = mysqli_query($conn,$sql);
										while ($row = mysqli_fetch_array($result))
										{
											echo '<tr onclick="toggle_color(this)">';
											// Print out the contents of the entry
											echo '<td><center>' . $row['order_product_name'] . '</center></td>';
											echo '<td><center>' . $row['order_product_description'] . '</center></td>';
											echo '<td><center>' . $row['order_product_quantity'] . '</center></td>';
											echo '<td><center>' . $row['order_buying_price'] . '</center></td>';
											echo '<td><center>' . $row['order_discount_percent'] . '</center></td>';
											echo '<td><center>' . $row['order_discounted_price'] . '</center></td>';
											$buying_total=$buying_total+$row['order_total_of_buying'];
											echo '<td><center>' . $row['order_total_of_buying'] . '</center></td>';
											echo '<td><center>' . $row['order_selling_percentage'] . '</center></td>';
											echo '<td><center>' . $row['order_selling_price'] . '</center></td>';
											echo '<td><center>' . $row['order_tax'] . '</center></td>';
											echo '<td><center>'; if($row['tax_inclusive']==1)
											{
												echo "Inclusive";
											}
											else
											{
												echo "Exclusive";
											}
											echo '</center></td>';
											$grand_total_por=$grand_total_por+ $row['order_total'];
											echo '<td><center>'; echo $row['order_total']; echo '</center></td></tr>';
										}
										?>
									</tbody>
								</table>
							</div>

							<div class="col-md-12">
								<div class="col-sm-2 col-md-offset-8 invoice-col">
									<div class="invoice-col">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">BUYING TOTAL</label>
											<input type="text" class="form-control" readonly id="buy_tota" value="<?php echo $buying_total;?>">
										</div>
									</div>

									<div class="invoice-col">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">PROFIT</label>
											<input type="text" class="form-control" readonly id="prof" value="<?php echo $grand_total_por-$buying_total;?>">
										</div>
									</div>
								</div>

								<div class="col-sm-2 invoice-col">
									<div class="invoice-col">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">TOTAL</label>
											<input type="text" class="form-control" readonly id="transport" value="<?php echo $grand_total_por;?>">
										</div>
									</div>

									<div class="invoice-col">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">TRANSPORT</label>
											<input type="text" class="form-control" readonly id="transport" value="<?php echo $order_result['order_transportation_charge'];?>">
										</div>
									</div>

									<div class="invoice-col">
										<div class="form-group has-success">
											<label class="control-label" style="text-align:center" for="inputSuccess">GRAND TOTAL</label>
											<input type="text" class="form-control" readonly id="grand_total" value="<?php echo $grand_total_por+$order_result['order_transportation_charge'];?>">
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-6 invoice-col">
									<address>
										<div class="table-responsive">
											<table class="table table-condensed table-bordered">
												<tr><center><strong>BILLING</strong></center></tr>
												<tr><td width="40%"><center>Estimate Number:</td><td> <center><strong>  <?php echo $order_result['order_estimate_number'] ?></strong></center></td></tr>
												<tr><td><center>E Sugam Number: </td><td> <center><strong>   <?php echo $order_result['order_e_sugam_number'] ?></strong></center></td></tr>
												<tr><td><center>Purchase Bill Number: </td><td> <center><strong>  <?php echo $order_result['order_purchase_bill_number'] ?></strong></center></td></tr>
												<tr><td><center>Smartstorey Invoice Number: </td><td> <center><strong>   <?php echo $order_result['order_ss_invoice_number'] ?></strong></center></td></tr>
												<tr><td><center>Billing Details </td><td> <center><strong>   <?php echo 				$order_result['billing_details'] ?></strong></center></td></tr>
											</table>
										</div>
									</address>
								</div>

								<div class="col-sm-6 invoice-col">
									<address>
										<div class="table-responsive">
											<table class="table table-condensed table-bordered">
												<tr><center><strong>TRANSPORT</strong></center></tr>
												<tr><td width="40%"><center>Transportation Type:</td><td> <center><strong>    <?php echo $order_result['order_transportation_type'] ?></strong></center></td></tr>
												<tr><td><center>Transportation Charge: </td><td> <center><strong>    <?php echo $order_result['order_transportation_charge'] ?></strong></center></td></tr>
												<tr><td><center>Delivery Date: </td><td> <center><strong>    <?php echo date("d-m-Y", strtotime($order_result['order_delivery_date'])) ?></strong></center></td></tr>
												<tr><td><center>Delivery Remarks:</td><td> <center><strong>    <?php echo $order_result['order_delivery_remarks'] ?></strong></center></td></tr>
											</table>
										</div>
									</address>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-12 invoice-col">
									<div class="table-responsive">
										<table class="table table-condensed table-bordered">
											<tr><td width="20%"><center>Confirmation Type: <strong>  <?php echo $order_result['order_confirmation_type'] ?></strong></td><td width="25%">
											Order Created By:   <strong>
											<?php
												$sq="SELECT data_entered_by FROM ss_order where order_id=". $order_result['order_id'];
												$resul67 = mysqli_query($conn, $sq);
												$u_res = mysqli_fetch_array($resul67,MYSQLI_ASSOC);
												{
													$sqlu = "SELECT name,id FROM users where id = " . $u_res['data_entered_by'];
													$result5 = mysqli_query($conn, $sqlu);
													$u_result = mysqli_fetch_array($result5,MYSQLI_ASSOC);
													{
														echo $u_result['name'];
													}
												}
											?>	</strong></td><td width="20%">
											Delivery Location: <strong> <?php echo $order_result['order_delivery_location'] ?></strong>
											</td><td width="20%">
											Bill: <strong>  <?php echo $order_result['order_with_bill']; ?></strong>
											</td>
											<td width="20%">
											Order Remarks: <strong>  <?php echo $order_result['order_remarks'] ?></strong>
											</td></tr>

											<tr><td width="20%"><center>Vendor Assignee: <strong>  <?php
											$sqlu = "SELECT name,id FROM users where id = " . $order_result['vendor_assignee'];
													$result5 = mysqli_query($conn, $sqlu);
													$u_result = mysqli_fetch_array($result5,MYSQLI_ASSOC);
													{
														echo $u_result['name'];
													}
											 ?></strong></td><td width="25%">
											Transport Assignee:   <strong>
											<?php
											$sqlu = "SELECT name,id FROM users where id = " . $order_result['operations_assignee'];
													$result5 = mysqli_query($conn, $sqlu);
													$u_result = mysqli_fetch_array($result5,MYSQLI_ASSOC);
													{
														echo $u_result['name'];
													}
											 ?>
											 </strong></td><td width="20%">
											Related Orders: <strong> <?php echo $order_result['related_orders'] ?></strong>
											</td></tr>
										</table>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-12">
									<h2 class="page-header" style="border-bottom: unset;">
										<div class="btn-toolbar">

											<a class="btn btn-primary btn-flat btn-sm pull-left" target='_blank' href='../html/dispatch_packet_html.php?id=<?php echo $order_id;?>'><i class="fa fa-plus"></i> Send Dispatch packet</a>
											<button type="button" class="btn btn-primary btn-flat btn-sm pull-right" data-toggle="modal"  data-target="#view_dispatch_packet"><i class="fa fa-plus"></i> Dispatch packet List</button>
										</div>
									</h2>
								</div>
							</div>
								<?php
								if($order_result['order_status'] == "Material Delivered")
								{
								?>
								<div class="page-header">
								<center><strong>Proof of Delivery Details</strong></center>	</div>

								<div class="table-responsive">
								<table class="table table-bordered table-condensed table-sm table-responsive" id="view_vendor_product_html"cellspacing="0" width="100%">
									<thead>
										<tr>
											<th><center>Image</center></th>
											<th><center>Delete</center></th>

										</tr>
									</thead>
									<tbody>
									<?php
									$sql = "SELECT * FROM proof_of_delivery_photo  where delete_status<>1 and module_name='order' and module_id=".$order_id;
										$result = mysqli_query($conn,$sql);

										while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
										{
										echo '<tr><td><center><img width="35%" class="fancybox" height="35%" src="'.$row['photo_name'].'"/></center></td>';
										echo '<td><center><a title="Delete" onclick="return confirm(\"Delete this record?\")" class="btn btn-danger" href="../php/delete/delete_proof_of_delivery_photo.php?id=' . $row['proof_of_delivery_photo_id'] . '">Delete</a></center></td></tr>';
										}
									?>
									</tbody>
								</table>
								<button type="button" class="btn btn-primary btn-flat btn-sm pull-center" data-toggle="modal"  data-target="#view_upload_image"><i class="fa fa-plus"></i> Upload Image</button>

								<?php
								}
								?>

							<div class="page-header">
								<center><strong>TASKS</strong></center>
							</div>

							<div class="table-responsive">
								<table class="table table-bordered table-condensed table-sm table-responsive" id="view_vendor_product_html"cellspacing="0" width="100%">
									<thead>
										<tr>
											<th><center>Task </center></th>
											<th><center>Description</center></th>
											<th><center>Assignee To</center></th>
											<th><center>Status</center></th>
											<th><center>Remarks</center></th>
											<th><center>Due Date</center></th>
											<th><center>Created By</center></th>
											<th><center>View</center></th>
										</tr>
									</thead>
									<tbody>
									<?php
										$sql = "SELECT * FROM task t, users u, ss_order o where t.task_assignee=u.id and t.delete_status<>1 and t.task_module_name='ORDER' and t.task_module_id=o.order_id and o.order_id= " . $order_id;
										$result = mysqli_query($conn,$sql);
										while ($row = mysqli_fetch_array($result))
										{
											//Print out the contents of the entry
											echo '<tr><td><center>'.$row['task_name'].'</td>';
											echo '<td><center>'.$row['task_description'].'</td>';
											echo '<td><center>'.$row['name'].'</td>';
											echo '<td><center>'.$row['task_status'].'</td>';
											echo '<td><center>'.$row['task_remarks'].'</td>';
											echo '<td><center>'. date("d-m-Y", strtotime($row['task_due_date'])).'</td>';
											$sql_user = "SELECT * FROM users u, task t where t.data_entered_by=u.id and t.task_id = " . $row['task_id'];
											$result_task_user = mysqli_query($conn, $sql_user);
											$user_result = mysqli_fetch_array($result_task_user,MYSQLI_ASSOC);
											{
												echo '<td align="center">'.$user_result['name'].'</td>';
											}
											echo  "<td><center> <a href='../html/view_task_html.php?id=" . $row['task_id'] . "' class='btn btn-primary btn-xs'>View</a></center></td></tr>";
										}
									?>
									</tbody>
								</table>



									<div class="page-header">
								Files
							</div>
							<table class="table table-bordered table-condensed table-sm table-responsive" id="view_order_photo_html"cellspacing="0" width="100%">
								<thead>
									<tr>
										<th><center>File</center></th>
										<th><center>Delete</center></th>
									</tr>
								</thead>
								<tbody>
								<?php
									$sql = "SELECT * FROM photo p, ss_order o where p.delete_status<>1 and p.module_name='order' and p.module_id=o.order_id and o.order_id= " . $order_id;
									$result = mysqli_query($conn,$sql);
									while ($row = mysqli_fetch_array($result))
									{
									// Print out the contents of the entry
									if((substr($row['photo_name'], -3))=="pdf")
									{
										echo '<tr><td><center><a href="../uploads/'.$row['photo_name'].'"/>Open PDF Attachment</a></td>';
									}
									else if((substr($row['photo_name'], -4))=="docx")
									{
										echo '<tr><td><center><a href="../uploads/'.$row['photo_name'].'"/>Open Word Attachment</a></td>';
									}
									else if((substr($row['photo_name'], -3))=="doc")
									{
										echo '<tr><td><center><a href="../uploads/'.$row['photo_name'].'"/>Open Word Attachment</a></td>';
									}
									else if((substr($row['photo_name'], -4))=="xlsx")
									{
										echo '<tr><td><center><a href="../uploads/'.$row['photo_name'].'"/>Open Excel Attachment</a></td>';
									}
									else if((substr($row['photo_name'], -3))=="xls")
									{
										echo '<tr><td><center><a href="../uploads/'.$row['photo_name'].'"/>Open Excel Attachment</a></td>';
									}
									else
									{
										echo '<tr><td><center><img width="35%" class="fancybox" height="35%" src="../uploads/'.$row['photo_name'].'"/></center></td>';
									}
									echo '<td><center><a title="Delete" onclick="return confirm(\"Delete this record?\")" class="btn btn-danger" href="../php/delete/delete_order_photo.php?id=' . $row['photo_id'] . '">Delete</a></center></td></tr>';
									}
								?>
								</tbody>
							</table>



							</div>

							<div class="row">
								<div class="col-xs-12">
									<h2 class="page-header">
										<div class="btn-toolbar">

											<button type="button" class="btn btn-primary btn-flat btn-sm pull-left" data-toggle="modal"  data-target="#show_log">
												<i class="fa fa-archive"></i>&nbsp; &nbsp; Show Log
											</button>


										</div>

									</h2>
								</div>
							</div>

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

			<!-- Add the sidebar's background. This div must be placed
			immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		</div>
		<!-- ./wrapper -->
		<!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";?>
		<!--Including Bootstrap and other scripts-->

		<!--Add Task-->
		<div id="add_task" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Task</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<!--Task Name-->
								<div class="form-group">
									<label>Task Name</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-tasks"></i></span>
										<input type="text" class="form-control" placeholder="Task Name" style="text-transform:capitalize" id="ui_modal_task_name" name="ui_modal_task_name" maxlength="150" />
									</div>
								</div>
								<!--Task Name-->
							</div>
						</div>

						<div class="row">
							<div class="col-md-4">
								<!--Assignee Name-->
								<div class="form-group">
									<label>Assignee Name</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user"></i></span>
										<select name="ui_assignee_name" id="ui_assignee_name" class='form-control select2' style='width: 100%;'>
										<option selected disabled hidden>Select Assignee</option>
										<?php
										{
											$sql = "SELECT * FROM users where authenticate=1 order by name";
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query))
											{
												echo "<option value='" . $row['id'] . "'>" . $row['name']. "</option>";
											}
										}
										?>
										</select>
									</div>
								</div>
								<!--Assignee Name-->
							</div>

							<div class="col-md-4">
								<!--Due Date-->
								<div class="form-group">
									<label>Due Date</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input type="text" readonly class="form-control pull-right" name="ui_task_due_date" id="ui_task_due_date" value="<?php echo date("d/m/Y"); ?>">
									</div>
								</div>
								<!--Due Date-->
							</div>

							<div class="col-md-4">
								<!--Task Status-->
								<div class="form-group">
									<label>Status</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-info"></i></span>
										<select name="ui_task_status" id="ui_task_status" class='form-control select2' style='width: 100%;'>
											<option value="Ongoing" selected> Ongoing </option>
											<option value="Completed"> Completed </option>
											<option value="Cancelled"> Cancelled </option>
										</select>
									</div>
								</div>
								<!--Task Status-->
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<!--Description-->
								<div class="form-group">
									<label>Description</label>
									<textarea class="form-control" rows="3" placeholder="Laminates to XYZ" id="ui_task_description" name="ui_task_description"></textarea>
								</div>
								<!--Description-->
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<!--Remarks-->
								<div class="form-group">
									<label>Remarks</label>
									<textarea class="form-control" rows="3" id="ui_task_remarks" name="ui_task_remarks"></textarea>
								</div>
								<!--Remarks-->
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<!--Save-->
						<div class="form-group">
							<button class="btn btn-success" type="button" id="modal_add_task">Save</button>
						</div>
						<!--Save-->
						<!--Close-->
						<div class="form-group">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
						<!--Close-->
					</div>
				</div>
			</div>
		</div>
		<!--Add Task -->
	</body>

		<script>
		$(function ()
		{
			//Date picker
			$('#ui_task_due_date').datepicker
			({
				format: 'dd/mm/yyyy',
				autoclose: true
			});
		});

		$(document).ready(function()
		{
			// Handler for .ready() called.
			$("#li_order").addClass("active");
			$("#li_order_report").addClass("active");

			$("#modal_add_task").click(function()
			{
				var order_id= <?php echo $order_result['order_id'];?>;
				var task_name= $("#ui_modal_task_name").val();
				var assignee_name= $("#ui_assignee_name").val();
				var due_date= $("#ui_task_due_date").val();
				var task_status= $("#ui_task_status").val();
				var task_description= $("#ui_task_description").val();
				var task_remarks= $("#ui_task_remarks").val();
				var user_id= <?php echo $user_result['id'];?>;
				var location= "<?php echo $user_result['location'];?>";

				$.ajax(
				{
					url: "../php/add_modal/add_order_task_php.php",
					type: "POST", // you can use GET
					data: {order_id:order_id,task_name: task_name, assignee_name: assignee_name,due_date:due_date, task_status:task_status,task_description:task_description,task_remarks:task_remarks,user_id:user_id,location:location}, // post data
					success: function(data)   // A function to be called if request succeeds
					{
						$("#add_task .close").click();
						window.location.reload();
						$('#ui_modal_task_name').val("");
						$('#ui_task_status').val("Ongoing");
						$('#ui_task_description').val("");
						$('#ui_task_remarks').val("");
					}
				});
			});
		});


		</script>

		<!-- Purchase Order -->
		<div class="modal fade" id="send_purchase_order" role="dialog">
			<div class="modal-dialog modal-lg" style="width: 85%; height:70%;">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Purchase Order from Smartstorey</h4>
					</div>
					<div class="modal-body">

						<!-- Main content -->
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
												<tr><td>Phone: </td><td>+918884732111, +919901650420</td></tr>
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
										<tr><td width="30%"><center><strong><?php echo $order_result['vendor_name'];?></strong></center></td></tr>
										<tr><td width="30%"><center><?php echo $order_result['vendor_address'];?></center><br></td></tr>

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
											<th><center>Buying Price</center></th>
											<th><center>Tax</center></th>
											<th><center>Tax I/E</center></th>
											<th><center>Total</center></th>
										</tr>
									</thead>
									<tbody>
										<?php $grand_total_po=0;$count=1; while ($order_product_result = mysqli_fetch_array($result4,MYSQLI_ASSOC)) {?>
										<tr>
											<td><center><?php echo $count;  ?></center></td>
											<td><center><?php echo $order_product_result['order_product_name'];  ?></center></td>
											<td><center><?php echo $order_product_result['order_product_description'];  ?></center></td>
											<td><center><?php echo $order_product_result['order_product_quantity'];  ?></center></td>
											<td><center><?php echo $order_product_result['order_discounted_price']; ?></center></td>
											<td><center><?php echo $order_product_result['order_tax'];  ?></center></td>
											<td><center><?php if($order_product_result['tax_inclusive']==1)
											{
												echo "Inclusive";
											}
											else
											{
												echo "Exclusive";
											}
											?></center></td>

											<?php
												$grand_total_po=$grand_total_po+ $order_product_result['order_total_of_buying'];?>
											<td><center><?php echo $order_product_result['order_total_of_buying']; ?></center></td>
										</tr>
										<?php $count=$count+1;} ?>
									</tbody>
								</table>
							</div>
						</div>

						<div class="row invoice-info">
							<div class="col-sm-2 col-md-offset-10 invoice-col">
								<div class="form-group has-success">
									<label class="control-label" for="inputSuccess">TOTAL</label>
									<input type="text" class="form-control" readonly id="transport" value="<?php echo $grand_total_po;?>">
								</div>
							</div>

							<div class="col-sm-2 col-md-offset-10 invoice-col">
								<div class="form-group has-success">
									<label class="control-label" for="inputSuccess">TRANSPORT</label>
									<input type="text" class="form-control" readonly id="transport" value="<?php echo $order_result['order_transportation_charge'];?>">
								</div>
							</div>

							<div class="col-sm-2 col-md-offset-10 invoice-col">
								<div class="form-group has-success">
									<label class="control-label" for="inputSuccess">GRAND TOTAL</label>
									<input type="text" class="form-control" readonly id="grand_total" value="<?php echo $grand_total_po+$order_result['order_transportation_charge'];?>">
								</div>
							</div>
						</div>

						<div class="row no-print">
							<hr>
							<div class="form-group col-md-offset-3 col-md-5">
								<label>Subject</label>
								<input type="text" class="form-control" name="email_subject" id="email_subject" maxlength="350" value="<?php echo $email_settings_result['email_subject'];  echo " [PO NO - ".$order_result['order_id'];  echo "]: "; echo $order_result['order_brief_details']; ?>">
							</div>
						</div>

						<div class="row no-print">
							<div class="form-group col-md-offset-1  col-md-5">
								<label>To (Comma Separated)</label>
								<input type="text" class="form-control" name="po_email_to" id="po_email_to" value="<?php echo $order_result['vendor_email'];?>">
							</div>

							<div class="form-group  col-md-5">
								<label>CC (Comma Seperated)</label>
								<input type="text" class="form-control" name="email_cc" id="email_cc" value="<?php echo $order_result['vendor_alternate_email'];?>">
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<!--Shipping Address-->
								<div class="form-group">
									<label>Shipping Address [Project Site Address]</label>
									<textarea class="form-control" rows="6" id="ui_shipping_address" name="ui_shipping_address" maxlength="200" ><?php echo $order_result['project_site_address'];?></textarea>
								</div>
								<!--Shipping Address-->
							</div>

							<div class="col-md-3">
								<!--Site Incharge Name-->
								<div class="form-group">
									<label>Site Incharge Name</label>
									<input type="text" class="form-control" id="ui_site_incharge_name" name="ui_site_incharge_name" maxlength="200" value="<?php echo $order_result['project_site_incharge_name'];?>"/>
								</div>
								<!--Site Incharge Name-->

								<!--Site Incharge Number-->
								<div class="form-group">
									<label>Site Incharge Number</label>
									<input type="text" class="form-control" id="ui_site_incharge_number" name="ui_site_incharge_number" maxlength="200" value="<?php echo $order_result['project_site_incharge_contact_number'];?>"/>
								</div>
								<!--Site Incharge Number-->

							</div>

							<!-- Add Shipping Address -->
							<div class="form-group col-md-2">
							<label>
							Send Shipping Address with PO &nbsp;&nbsp; <div class="input-group"><input type="checkbox" value="Send Shipping Address" name="ui_send_shipping_address_with_po" id="ui_send_shipping_address_with_po" onchange="valueChanged()">
							</div>
							</label>
							<br>
							<br>
							<br>
							<label>
							Send Site Incharge Details with PO&nbsp;&nbsp; <div class="input-group"><input type="checkbox" value="Send Site Incharge Details" name="ui_send_site_incharge_details_with_po" id="ui_send_site_incharge_details_with_po" onchange="valueChanged()">
							</div>
							</label>
							<br>
							<br>
							<label>
							Send transport Charge with PO &nbsp;&nbsp; <div class="input-group"><input type="checkbox" value="Send Shipping Charge" name="ui_send_shipping_charge_with_po" id="ui_send_shipping_charge_with_po">
							</div>
							</label>
							<br>
							</div>
							<!--Add Shipping Address -->



							<div class="col-md-4">
								<!--Order Remarks-->
								<div class=" form-group">
									<label>Message To Vendor</label>
									<textarea class="form-control" rows="6" id="ui_message_to_vendor" name="ui_message_to_vendor" ><?php
									if($order_result['order_po_mail_body']=="")
									{
										echo $email_settings_result['email_body'];
									}
									else
									{
										echo $order_result['order_po_mail_body'];
									}

									?></textarea>
								</div>
								<!--Order Remarks-->
							</div>
						</div>


						<div class="row no-print">
							<div class="form-group col-md-2  col-md-offset-8">
								<form target="_blank" action="../php/purchase_order_pdf.php" action="POST">
									<input type="hidden" name="sorder_id" id="sorder_id" value="<?php echo $order_result['order_id'];?>">
									<button type="submit" id="generate_pdf" name="generate_pdf" class="btn btn-primary pull-right" style="margin-right: 5px;">
										<i class="fa fa-file-pdf-o"></i> Generate PDF
									</button>
								</form>
							</div>

							<div class="form-group col-md-2 col-md-offset-0">
								<!--<form action="../php/send_purchase_order.php" action="POST">
									<input type="hidden" name="id" id="id" value="<?php echo $order_id;?>">
									<button type="submit" class="btn btn-success pull-right"><i class="fa fa-envelope"></i> Send Purchase Order
									</button>
								</form>-->

								<input type="hidden" name="user_id" id="user_id" value="<?php echo $user_result['id'];?>"/>

								<button type="submit" id="btn_send_purchase_order" class="btn btn-success pull-right"><i class="fa fa-envelope"></i> Send Purchase Order
									</button>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Purchase Order -->


		<!-- Purchase Order -->
		<script>
			$("#btn_send_purchase_order").click(function()
			{

				var order_id= $("#order_id").val();
				var email_subject= $("#email_subject").val();
				var po_email_to= $("#po_email_to").val();
				var email_cc= $("#email_cc").val();
				var ui_shipping_address= $("#ui_shipping_address").val();
				var user_id= $("#user_id").val();
				var ui_message_to_vendor= $("#ui_message_to_vendor").val();
				var send_PO, site_incharge_name,site_incharge_number,send_site_incharge_details,send_transport_charge;

					if ($('#ui_send_shipping_address_with_po').is(':checked'))
					{
						send_PO="Send Shipping Address";
					}
					else
					{
						send_PO="Do Not Send Shipping Address";
					}

					if ($('#ui_send_site_incharge_details_with_po').is(':checked'))
					{
						send_site_incharge_details=1;
						site_incharge_name=$("#ui_site_incharge_name").val();
						site_incharge_number=$("#ui_site_incharge_number").val();
					}
					else
					{
						send_site_incharge_details=0;
						site_incharge_name="No";
						site_incharge_number="No";
					}

					if ($('#ui_send_shipping_charge_with_po').is(':checked'))
					{
						send_transport_charge_details=1;
					}
					else
					{
						send_transport_charge_details=0;
					}
				$.ajax(
				{
					url: "../php/send_purchase_order.php",
					type: "POST", // you can use GET
					data: {order_id: order_id,po_email_to:po_email_to,email_subject: email_subject, email_cc:email_cc, ui_shipping_address: ui_shipping_address,ui_message_to_vendor:ui_message_to_vendor,send_PO:send_PO,site_incharge_name:site_incharge_name,site_incharge_number:site_incharge_number,send_site_incharge_details:send_site_incharge_details,user_id:user_id,send_transport_charge_details:send_transport_charge_details,send_transport_charge:send_transport_charge}, // post data
					success: function(data)   // A function to be called if request succeeds
					{
						alert(data);
						$("#send_purchase_order .close").click();
					}
				});
			});
		</script>
		<!-- Purchase Order -->




		<!-- Invoice -->
		<div class="modal fade" id="send_invoice" role="dialog">
			<div class="modal-dialog modal-lg" style="width: 85%; height:70%;">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Invoice from Smartstorey</h4>
					</div>
					<div class="modal-body">

						<!-- Main content -->
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
												<tr><td>Phone: </td><td>+918884732111, +919901650420</td></tr>
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
										<tr><td width="30%"><center><strong><?php echo $order_result['customer_name'];?></strong></center></td></tr>
										<tr><td width="30%"><center><?php echo $order_result['customer_address'];?></center><br></td></tr>

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
											<th><center>Selling Price</center></th>
											<th><center>Tax</center></th>
											<th><center>Tax I/E</center></th>
											<th><center>Total</center></th>
										</tr>
									</thead>
									<tbody>
										<?php $grand_total_in=0;
										$count=1;
										while ($order_product_result = mysqli_fetch_array($result7,MYSQLI_ASSOC))
										{?>
										<tr>
											<td><center><?php echo $count;  ?></center></td>
											<td><center><?php echo $order_product_result['order_product_name'];  ?></center></td>
											<td><center><?php echo $order_product_result['order_product_description'];  ?></center></td>
											<td><center><?php echo $order_product_result['order_product_quantity'];  ?></center></td>
											<td><center><?php echo $order_product_result['order_selling_price']; ?></center></td>
											<td><center><?php echo $order_product_result['order_tax'];  ?></center></td>
											<td><center><?php if($order_product_result['tax_inclusive']==1)
											{
												echo "Inclusive";
											}
											else
											{
												echo "Exclusive";
											}
											?></center></td>

											<?php
												$grand_total_in=$grand_total_in+$order_product_result['order_total'];?>
											<td><center><?php echo $order_product_result['order_total']; ?></center></td>
										</tr>
										<?php $count=$count+1;} ?>
									</tbody>
								</table>
							</div>
						</div>

						<div class="row invoice-info">
							<div class="col-sm-2 col-md-offset-10 invoice-col">
								<div class="form-group has-success">
									<label class="control-label" for="inputSuccess">TOTAL</label>
									<input type="text" class="form-control" readonly id="transport" value="<?php echo $grand_total_in;?>">
								</div>
							</div>

							<div class="col-sm-2 col-md-offset-10 invoice-col">
								<div class="form-group has-success">
									<label class="control-label" for="inputSuccess">TRANSPORT</label>
									<input type="text" class="form-control" readonly id="transport" value="<?php echo $order_result['order_transportation_charge'];?>">
								</div>
							</div>

							<div class="col-sm-2 col-md-offset-10 invoice-col">
								<div class="form-group has-success">
									<label class="control-label" for="inputSuccess">GRAND TOTAL</label>
									<input type="text" class="form-control" readonly id="grand_total" value="<?php echo $grand_total_in+$order_result['order_transportation_charge'];?>">
								</div>
							</div>
						</div>

						<div class="row no-print">
							<hr>
							<div class="form-group col-md-offset-3 col-md-5">
								<label>Subject</label>
								<input type="text" class="form-control" name="invoice_email_subject" id="invoice_email_subject" maxlength="350" value="<?php echo $email_settings_result_invoice['email_subject'];  echo " - ".$order_result['order_id'];  echo ": "; echo $order_result['order_brief_details']; ?>">
							</div>
						</div>


						<div class="row no-print">
							<div class="form-group col-md-offset-1 col-md-5">
								<label>TO (Comma Seperated)</label>
								<input type="text" class="form-control" name="invoice_email_to" id="invoice_email_to" value="<?php echo $order_result['customer_email'];?>">
							</div>


							<div class="form-group col-md-5">
								<label>CC (Comma Seperated)</label>
								<input type="text" class="form-control" name="invoice_email_cc" id="invoice_email_cc" value="<?php echo $order_result['customer_alternate_email'];?>">
							</div>

						</div>

						<div class="row">

							<div class="col-md-4">
								<!--Shipping Address-->
								<div class="form-group">
									<label>Billing Address [Customer Address]</label>
									<textarea class="form-control" rows="6" id="ui_invoice_billing_address" name="ui_invoice_billing_address" maxlength="300" ><?php echo $order_result['billing_details'];?></textarea>
								</div>
								<!--Shipping Address-->
							</div>


							<div class="col-md-4">
								<!--Shipping Address-->
								<div class="form-group">
									<label>Shipping Address [Project Site Address]</label>
									<textarea class="form-control" rows="6" id="ui_invoice_shipping_address" name="ui_invoice_shipping_address" maxlength="300" ><?php echo $order_result['project_site_address'];?></textarea>
								</div>
								<!--Shipping Address-->
							</div>


							<div class="col-md-4">
								<!--Order Remarks-->
								<div class=" form-group">
									<label>Message To Customer</label>
									<textarea class="form-control" rows="6" id="ui_invoice_message_to_customer" name="ui_invoice_message_to_customer" ><?php if($order_result['order_invoice_mail_body']=="")
									{
										echo $email_settings_result_invoice['email_body'];
									}
									else
									{
										echo $order_result['order_invoice_mail_body'];
									}?></textarea>
								</div>
								<!--Order Remarks-->
							</div>
						</div>
						<form action=<?php echo "../php/send_image.php?id=".$order_id; ?> method="POST" enctype="multipart/form-data">
							<div class="btn-toolbar">
									<h4>Attachments</h4>
											Files types allowed: JPEG, PNG and JPG Max Size: 1.5 MB.
											<hr/>
											<div id="filediv" align="left" style="display:block"><input name="file[]" type="file" id="file"/>
											</div>
											<br/>

											<button type="submit" id="btn_send_invoice" class="btn btn-success pull-left"><i class="fa fa-envelope"></i>&nbsp; Save
											</button>
						</form>

							<?php echo '<a class="btn btn-sm btn-primary btn-flat pull-right" href="#"';'>'?>
													<button type="submit" id="btn_send_invoice" class="btn btn-primary pull-right"><i class="fa fa-envelope"></i>&nbsp; Send  Invoide
													</button>
											</a>

								<?php echo '<a class="btn btn-sm btn-primary btn-flat pull-right" href="../php/send_pdf.php?id='.$order_id.'"';'>'?>
													<button type="submit" id="btn_send_invoice" class="btn btn-primary pull-right"><i class="fa fa-envelope"></i>&nbsp; Send PDF
													</button>
											</a>


									<!-- <form target="_blank" action="../php/order_pdf.php" action="POST">
									<input type="hidden" name="sorder_id" id="sorder_id" value="<?php echo $order_result['order_id'];?>">
									<button type="submit" id="generate_pdf" name="generate_pdf" class="btn btn-primary pull-right" style="margin-right: 5px;">
										<i class="fa fa-file-pdf-o"></i> Send PDF
									</button>

								</form> -->

						</div>

						<div class="row no-print">
							<div class="form-group col-md-2  col-md-offset-8">


								<!--<form action="../php/send_purchase_order.php" action="POST">
									<input type="hidden" name="id" id="id" value="<?php echo $order_id;?>">
									<button type="submit" class="btn btn-success pull-right"><i class="fa fa-envelope"></i> Send Purchase Order
									</button>
								</form>-->


							</div>

							<input type="hidden" name="order_id" id="order_id" value="<?php echo $_GET["id"]; ?>"/>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Invoice -->


		<!-- Invoice -->
		<script>
			$("#btn_send_invoice").click(function()
			{

				var order_id= $("#order_id").val();
				var invoice_email_subject= $("#invoice_email_subject").val();
				var invoice_email_to= $("#invoice_email_to").val();
				var user_id= $("#user_id").val();
				var invoice_billing_address= $("#ui_invoice_billing_address").val();
				var invoice_shipping_address= $("#ui_invoice_shipping_address").val();
				var invoice_message_to_customer= $("#ui_invoice_message_to_customer").val();
				var invoice_email_cc= $("#invoice_email_cc").val();
				$.ajax(
				{
					url: "../php/send_invoice.php",
					type: "POST", // you can use GET
					data: {order_id: order_id,user_id:user_id,invoice_email_to:invoice_email_to,invoice_email_subject: invoice_email_subject, invoice_email_cc:invoice_email_cc, invoice_billing_address: invoice_billing_address,invoice_shipping_address:invoice_shipping_address,invoice_message_to_customer:invoice_message_to_customer}, // post data
					success: function(data)   // A function to be called if request succeeds
					{
						alert(data);
						$("#send_invoice .close").click();
					}
				});
			});
		</script>
		<!-- Invoice -->

		<!-- Modal -->
<div id="show_log" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Log</h4>
      </div>
      <div class="modal-body">
       <div class="table-responsive">
								<table class='table table-bordered table-striped table-fixed'>
									<thead>
										<tr>
										<th><center>Column Name</th>
										<th><center>Old Value</th>
										<th><center>New Value</th>
										<th><center>Modified By</th>
										<th><center>Modified Date</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql = 'SELECT * FROM transaction_audit t, users u where (u.id=t.changed_by and t.module_transaction_id='.$order_id.') and (t.module_name="ORDER" or t.module_name="ORDER_PRODUCT")';
										$result = mysqli_query($conn,$sql);
										while ($row = mysqli_fetch_array($result))
										{
											// Print out the contents of the entry
											echo '<tr>';
											if($row['column_name']=="vendor_id")
											{
												echo '<td><center>Vendor Name</center></td>';
												$sql1 = 'SELECT vendor_name, vendor_id FROM vendor where vendor_id='.$row['old_value'];
												$result1 = mysqli_query($conn,$sql1);
												$row1 = mysqli_fetch_array($result1);
													echo '<td><center>' . $row1['vendor_name'] . '</center></td>';

												$sql2 = 'SELECT vendor_name, vendor_id FROM vendor where vendor_id='.$row['new_value'];
												$result2 = mysqli_query($conn,$sql2);
													$row2 = mysqli_fetch_array($result2);
													echo '<td><center>' . $row2['vendor_name'] . '</center></td>';
											}
											else if($row['column_name']=="customer_id")
											{
												echo '<td><center>Customer Name</center></td>';
												$sql1 = 'SELECT customer_name, customer_id FROM customer where customer_id='.$row['old_value'];
												$result1 = mysqli_query($conn,$sql1);
												$row1 = mysqli_fetch_array($result1);
													echo '<td><center>' . $row1['customer_name'] . '</center></td>';

												$sql2 = 'SELECT customer_name, customer_id FROM customer where customer_id='.$row['new_value'];
												$result2 = mysqli_query($conn,$sql2);
													$row2 = mysqli_fetch_array($result2);
													echo '<td><center>' . $row2['customer_name'] . '</center></td>';
											}
											else if($row['column_name']=="project_id")
											{
												echo '<td><center>Project Name</center></td>';
												$sql1 = 'SELECT project_name, project_id FROM project where project_id='.$row['old_value'];
												$result1 = mysqli_query($conn,$sql1);
												$row1 = mysqli_fetch_array($result1);
													echo '<td><center>' . $row1['project_name'] . '</center></td>';

												$sql2 = 'SELECT project_name, project_id FROM project where project_id='.$row['new_value'];
												$result2 = mysqli_query($conn,$sql2);
													$row2 = mysqli_fetch_array($result2);
													echo '<td><center>' . $row2['project_name'] . '</center></td>';
											}

											else if($row['column_name']=="order_assignee")
											{
												echo '<td><center>Assignee Name</center></td>';
												$sql1 = 'SELECT * FROM ss_order o, users u where o.order_assignee=u.id and o.order_assignee='.$row['old_value'];
												$result1 = mysqli_query($conn,$sql1);
												$row1 = mysqli_fetch_array($result1);
													echo '<td><center>' . $row1['name'] . '</center></td>';

												$sql2 = 'SELECT * FROM ss_order o, users u where o.order_assignee=u.id and o.order_assignee='.$row['new_value'];
												$result2 = mysqli_query($conn,$sql2);
													$row2 = mysqli_fetch_array($result2);
													echo '<td><center>' . $row2['name'] . '</center></td>';
											}

											else if($row['column_name']=="order_status")
											{
												echo '<td><center>Order Status</center></td>';
												$sql1 = 'SELECT * FROM ss_order o, transaction_audit t where o.order_id=t.module_transaction_id and o.order_id='.$row['module_transaction_id'];
												$result1 = mysqli_query($conn,$sql1);
												$row1 = mysqli_fetch_array($result1);
												echo '<td><center>' . $row['old_value'] . '</center></td>';
												echo '<td><center>' . $row['new_value'] . '</center></td>';
											}

											else if($row['column_name']=="order_product_description")
											{
												echo '<td><center>Product Description</center></td>';
												echo '<td><center>' . $row['old_value'] . '</center></td>';
												echo '<td><center>' . $row['new_value'] . '</center></td>';
											}
											else if($row['column_name']=="order_product_quantity")
											{
												echo '<td><center>Product Quantity</center></td>';

												echo '<td><center>' . $row['old_value'] . '</center></td>';
												echo '<td><center>' . $row['new_value'] . '</center></td>';
											}

											else if($row['column_name']=="order_buying_price")
											{
												echo '<td><center>Product Buying Price</center></td>';

												echo '<td><center>' . $row['old_value'] . '</center></td>';
												echo '<td><center>' . $row['new_value'] . '</center></td>';
											}

											else if($row['column_name']=="order_discount_percent")
											{
												echo '<td><center>Product Discount Percent</center></td>';

												echo '<td><center>' . $row['old_value'] . '</center></td>';
												echo '<td><center>' . $row['new_value'] . '</center></td>';
											}
											else if($row['column_name']=="order_discounted_price")
											{
												echo '<td><center>Product Discounted Price</center></td>';

												echo '<td><center>' . $row['old_value'] . '</center></td>';
												echo '<td><center>' . $row['new_value'] . '</center></td>';
											}

											else if($row['column_name']=="order_total_of_buying")
											{
												echo '<td><center>Total of Buying</center></td>';

												echo '<td><center>' . $row['old_value'] . '</center></td>';
												echo '<td><center>' . $row['new_value'] . '</center></td>';
											}

											else if($row['column_name']=="order_tax")
											{
												echo '<td><center>Tax</center></td>';

												echo '<td><center>' . $row['old_value'] . '</center></td>';
												echo '<td><center>' . $row['new_value'] . '</center></td>';
											}

											else
											{
												echo '<td><center>' . $row['column_name'] . '</center></td>';

												echo '<td><center>' . $row['old_value'] . '</center></td>';
												echo '<td><center>' . $row['new_value'] . '</center></td>';
											}

											echo '<td><center>' . $row['name'] . '</center></td>';
											echo '<td><center>' . $row['change_time'] . '</center></tr>';

										}
										?>
									</tbody>
								</table>
							</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Dispatch Packet view -->
	<div id="view_dispatch_packet" class="modal fade" role="dialog">
		<div class="modal-dialog  modal-lg">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Dispatched packet details</h4>
				</div>
				<div class="modal-body">
					<div class="table-responsive">
								<table class='table table-bordered table-striped table-fixed'>
									<thead>
										<tr>
											<th><center>Product Name</th>
											<th><center>Description</th>
											<th><center>Quantity </th>
											<th><center>Discount Price</th>
											<th><center>Buying Total</th>
											<th><center>Selling Price</th>
											<th><center>Tax</th>
											<th><center>Selling Total</th>
											<th><center>Status</th>
											<th><center>Dispatch Date</th>
										</tr>
									</thead>
									<tbody>
										<tr onclick="toggle_color(this)">
										<?php
										$grand_total=0;
										$buying_total=0;
										$sqll1 = "SELECT * FROM dispatch_packet_details where dispatch_status='dispatched' and order_id=".$order_id;
										$resultt1 = mysqli_query($conn,$sqll1);
										while($row = mysqli_fetch_array($resultt1))
										{
											$newDate = date("d-m-Y", strtotime($row['created_date']));
											echo '<tr onclick="toggle_color(this)">';
											// Print out the contents of the entry
											echo '<td><center>' . $row['order_product_name'] . '</center></td>';
											echo '<td><center>' . $row['order_product_description'] . '</center></td>';
											echo '<td><center>' . $row['order_product_quantity'] . '</center></td>';
											echo '<td><center>' . $row['order_discounted_price'] . '</center></td>';
											$buying_total=$buying_total+$row['order_total_of_buying'];
											echo '<td><center>' . $row['order_total_of_buying'] . '</center></td>';
											echo '<td><center>' . $row['order_selling_price'] . '</center></td>';
											echo '<td><center>' . $row['order_tax'] . '</center></td>';
											$grand_total_por=$grand_total_por+ $row['order_total'];
											echo '<td><center>'; echo $row['order_total']; echo '</center></td>';
											echo '<td><center>' . $row['dispatch_status'] . '</center></td>';
											echo '<td><center>' . $newDate. '</center></td></tr>';
										}
										?>
									</tbody>
								</table>
							</div>
			  	</div>
			</div>
		</div>
	</div>

	<div id="view_upload_image" class="modal fade" role="dialog">
		<div class="modal-dialog  modal-lg">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button"  class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" align="center">Upload material delivered detail</h4>
				</div>
				<div class="modal-body">
					<div class="table-responsive">
							<!-- File Upload -->

							<form action=<?php echo "../php/update/update_photo_delivery.php?id=".$order_id;?> method="POST" onsubmit="submit return true;" enctype="multipart/form-data">
								<div class="form-group col-md-12">
									<div id="maindiv">
									<div id="formdiv">
										Files types allowed: JPEG , JPG Max Size: 1.5 MB.
										<hr/>
										<div id="filediv" align="center" style="display:block"><input name="file[]" type="file" id="file"/></div><br/>
										<input type="button" id="add_more" class="upload" value="Add More Files"/>
									</div>
								</div>
								</div>

								<div class="col-lg-offset-10 col-lg-2">
									<button type="submit"  align="center"  data-loading-text="Please Wait..." class="btn btn-success form-control">Upload</button>
								</div>
							</form>
								<!-- File Upload -->
							</div>
			  	</div>
			</div>
		</div>
	</div>
</html>
