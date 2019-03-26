<!DOCTYPE html>
<html>
	<!-- Including Login Session -->
	<?php include "../extra/session.php";
	$global_total=0;
	?>
	<!-- Including Login Session -->

	<head>
		<!-- Including Bootstrap CSS links -->
		<?php include "../extra/header.html";?>
		<!-- Including Bootstrap CSS links -->
		
		<!-- Push Notification-->
		<script charset="UTF-8" src="//cdn.sendpulse.com/28edd3380a1c17cf65b137fe96516659/js/push/7625e8166a7ca5a1726090cbafc0f211_0.js" async></script>
		<!-- Push Notification-->
	</head>

	<body class="hold-transition skin-blue fixed sidebar-mini" >
		<div class="wrapper">
			<!--Including Topbar-->
			<?php include "../extra/topbar.php";?>
			<!--Including Topbar-->

			<!--Including Left Nav Bar-->
			<?php include "../extra/left_nav_bar.php";?>
			<!--Including Left Nav Bar-->

			<!-- Content Wrapper, Contains Page Content -->
			<div class="content-wrapper">

					<!-- Main Content -->
					<section class="content ">
						<?php
						$query_count = "SELECT login_count FROM users where email='".$user_result['email']."' and password='25f9e794323b453885f5181f1b624d0b'";
						$result_count = mysqli_query($conn, $query_count);
						$user_count_result = mysqli_fetch_array($result_count,MYSQLI_ASSOC);
						if($user_count_result['login_count']==1)
						{
							echo '<div class="pad">
								<div class="callout callout-info">
									Hurray Successfull Login, Please change your initial password in Profile Section-Change Password.
								</div>
							</div>';
						}
						?>				
						
						
						<div class="row">
							
							<div class="col-lg-3 col-xs-6">							
								<div class="small-box bg-purple">																
									<div class="inner">
										<h3>
										<?php
											$sql = "SELECT * FROM enquiry where (enquiry_status=('OPEN - QUOTE TO BE SENT') || ('OPEN - AWAITING PRODUCT INFO FROM CLIENT') || ('OPEN - AWAITING PRODUCT INFO FROM VENDOR') || ('OPEN - PRODUCT RESEARCH PENDING') || ('OPEN - QUOTE SENT, AWAITING APPROVAL')) and delete_status<>1 and location='".$user_result['location']."'"  ;
											$result = mysqli_query($conn,$sql);
											$count=0;
											while ($row = mysqli_fetch_array($result)) 
											{
												$count=$count+1; //Count the number of enquiries
											}
											echo $count;
										?>
										</h3>
										<p>Open Enquiries</p>
									</div>
									<div class="icon">
										<i class="ion ion-clipboard"></i>
									</div>
									<a href="../reports/open_enquiry_report_html.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
									
									</div>
									
							</div>
							
							<!-- ./col -->
							
							<div class="col-lg-3 col-xs-6">
								<!-- small box -->
								<div class="small-box bg-blue">
									<div class="inner">
										<h3>
										<?php
											$sql = "SELECT * FROM ss_order WHERE order_status ='Order Created' and delete_status<>1 and location='".$user_result['location']."'";
											$result = mysqli_query($conn,$sql);
											$count=0;
											while ($row = mysqli_fetch_array($result)) 
											{
											$count=$count+1; //Count the number of orders
											}
											echo $count;
										?>
										</h3>
										<p>Order Created</p>
									</div>
									<div class="icon">
										<i class="ion ion-bag"></i>
									</div>
									<a href="../reports/order_created_report_html.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
							<!-- ./col -->
							
							<div class="col-lg-3 col-xs-6">
								<!-- small box -->
								<div class="small-box bg-orange">
									<div class="inner">
										<h3>
										<?php
											$sql = "SELECT * FROM ss_order WHERE order_status ='Order Placed' and delete_status<>1 and location='".$user_result['location']."'";
											$result = mysqli_query($conn,$sql);
											$count=0;
											while ($row = mysqli_fetch_array($result)) 
											{
											$count=$count+1; //Count the number of orders
											}
											echo $count;
										?>
										</h3>
										<p>Placed Orders</p>
									</div>
									<div class="icon">
										<i class="ion ion-ios-stopwatch"></i>
									</div>
									<a href=" ../reports/placed_order_report_html.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
							<!-- ./col -->
							
							<div class="col-lg-3 col-xs-6">
								<!-- small box -->
								<div class="small-box bg-green">
									<div class="inner">
										<h3>									
										<?php
											$sql = "SELECT * FROM ss_order WHERE order_status ='Order Fulfilled' and delete_status<>1 and location='".$user_result['location']."'";
											$result = mysqli_query($conn,$sql);
											$count=0;
											while ($row = mysqli_fetch_array($result)) 
											{
												$count=$count+1; //Count the number of orders
											}
											echo $count;
										?>
										</h3>
										<p>Completed Orders</p>
									</div>
									<div class="icon">
										<i class="ion ion-ios-checkmark"></i>
									</div>
									<a href="../reports/completed_order_report_html.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
						<!-- ./col -->
						</div>
	  
	  
						<!-- Div Row -->
						<div class="row">
							<!-- 1 col -->
							<a href="../reports/enquiry_report_html.php">
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="info-box" href="new_enquires_html.php">
										<span class="info-box-icon bg-purple"><i class="ion ion-clipboard"></i></span>
										<div class="info-box-content">
											<span class="info-box-text">All Enquiries</span>
											<span class="info-box-number">
												<?php
													$sql = "SELECT * FROM enquiry where delete_status<>1 and location='".$user_result['location']."'";
													$result = mysqli_query($conn,$sql);
													$count=0;
													while ($row = mysqli_fetch_array($result)) 
													{
														$count=$count+1; //Count the number of enquiries
													}
													echo $count;
												?>
											</span>
										</div>
									</div>
								</div>
							</a>
							<!-- 1 col -->

							<!-- 3 col -->
							<a href="../reports/all_order_report_html.php">
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="info-box">
										<span class="info-box-icon bg-blue"><i class="ion-ios-cart"></i></span>
										<div class="info-box-content">
											<span class="info-box-text">All Orders</span>
											<span class="info-box-number">
											<?php
												$sql = "SELECT * FROM ss_order where delete_status<>1 and location='".$user_result['location']."'";
												$result = mysqli_query($conn,$sql);
												$count=0;
												while ($row = mysqli_fetch_array($result)) 
												{
													$count=$count+1; //Count the number of orders
												}
												echo $count;
											?>
											</span>
										</div>
									</div>
								</div>
							</a>
							<!-- 3 col -->

							<!-- 4 col -->
							<a href="../reports/customer_report_html.php" >
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="info-box">
										<span class="info-box-icon bg-orange"><i class="ion-android-contacts"></i></span>
										<div class="info-box-content">
											<span class="info-box-text">Customers</span>
											<span class="info-box-number">
											<?php
												$sql = "SELECT * FROM customer where delete_status<>1 and location='".$user_result['location']."'";
												$result = mysqli_query($conn,$sql);
												$count=0;
												while ($row = mysqli_fetch_array($result)) 
												{
													$count=$count+1; //Count the number of farmers
												}
												echo $count;
											?>
											</span>
										</div>
									</div>
								</div>
							</a>
							<!-- 4 col -->
						
						<!-- Div Row -->

						
						<!-- 4 col -->
							<a href="../reports/vendor_report_html.php">
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="info-box">
										<span class="info-box-icon bg-green"><i class="ion ion-person-stalker"></i></span>
										<div class="info-box-content">
											<span class="info-box-text">Vendors</span>
											<span class="info-box-number">
												<?php
													$sql = "SELECT * FROM vendor where delete_status<>1 and location='".$user_result['location']."'";
													$result = mysqli_query($conn,$sql);
													$count=0;
													while ($row = mysqli_fetch_array($result)) 
													{
														$count=$count+1; //Count the number of farmers
													}
													echo $count;
												?>
											</span>
										</div>
									</div>
								</div>
							</a>
							<!-- 4 col -->

						</div>
						<!-- Table: Latest Orders -->
						<div class="box">
							<div class="box-body">
								<!-- Table Responsive -->
								<div class="table-responsive">
									<table id="view_order_html" class="table table-bordered table-striped table-fixed" style="border-collapse:collapse;">
										<tbody>
											<tr>
												<th><center>Products</center></th>
												<th><center>Order ID</center></th>
												<th><center>Order Date</center></th>
												<th><center>Vendor Name</center></th>
												<th><center>Customer Name</center></th>
												<th><center>Project Name</center></th>
												<th><center>Order Status</center></th>
												<th><center>View</center></th>												
												<th><center>Edit</center></th>												
											</tr>
											<?php
											if($settings_result['view_all_sales_order']!=1)
											{
												$sql = "SELECT * FROM ss_order o,vendor v,customer c,project p where o.order_status<>'Order Fulfilled' and o.vendor_id=v.vendor_id and o.customer_id=c.customer_id and o.project_id=p.project_id and o.delete_status=0 and ((o.created_date > CURDATE() - 10) or (o.last_update_date > CURDATE() - 10)) and o.location='".$user_result['location']."' order by o.order_id desc";
											}
											else
											{
												$sql = "SELECT * FROM ss_order o,vendor v,customer c,project p where o.vendor_id=v.vendor_id and o.customer_id=c.customer_id and o.project_id=p.project_id and ((o.created_date > CURDATE() - 10) or (o.last_update_date > CURDATE() - 10)) and o.delete_status=0 order by o.order_id desc";
											}
											$result = mysqli_query($conn,$sql);
											while ($row = mysqli_fetch_array($result))
											{
												$global_order_id=$row['order_id'];
												// Print out the contents of the entry
												echo '<tr data-toggle="collapse" class="accordion-toggle" data-target="#prod';echo $global_order_id; echo'">';
												echo '<td><center><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></center></td>';
												echo '<td><center>' . $row['order_id'] . '</center></td><td><center>' . date("d-m-Y", strtotime($row['order_date'])) . '</center></td><td><center>' . $row['vendor_name'] . '</center></td><td><center>' . $row['customer_name'] . '</center></td><td><center>' . $row['project_name'] . '</center></td>';
												if( $row['order_status']=="Order Created")
												{
													echo '<td style="width:12%"><div class="badge bg-blue">' . $row['order_status'] . '</div></td>';
												}
												else if($row['order_status']=="Order Placed")
												{
													echo '<td style="width:12%"><div class="badge bg-orange"><center>' . $row['order_status'] . '</div></td>';
												}
												else if($row['order_status']=="Material Ready To Dispatch")
												{
													echo '<td style="width:12%"><div class="badge bg-olive">' . $row['order_status'] . '</div></td>';
												}
												else if($row['order_status']=="Material Delivered")
												{
													echo '<td style="width:12%"><div class="badge bg-lime">' . $row['order_status'] . '</div></td>';
												}
												else if($row['order_status']=="Order Partially Delivered")
												{
													echo '<td style="width:12%"><div class="badge bg-teal">' . $row['order_status'] . '</div></td>';
												}
												else if($row['order_status']=="Order Fulfilled")
												{
													echo '<td style="width:12%"><div class="badge bg-green">' . $row['order_status'] . '</div></td>';
												}
												else if($row['order_status']=="Order Cancelled")
												{
													echo '<td style="width:12%"><div class="badge bg-red">' . $row['order_status'] . '</div></td>';
												}
												echo  "<td><center> <a href='../html/view_order_html.php?id=" . $row['order_id'] . "' class='btn btn-primary btn-xs'>View</a></center></td>";
												echo  "<td><center> <a href='../html/edit_order_html.php?id=" . $row['order_id'] . "' class='btn btn-warning btn-xs'>Edit</a></center></td></tr></tr>";

												
												echo '<tr>
												<td colspan="12" class="hiddenRow">
													<div class="accordian-body collapse" id="prod'; echo $global_order_id; echo '">   
														<table id="view_order_product_html" class="table table-bordered table-striped table-fixed">
															<tbody>
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
																		<th><center>Tax I/E</th>
																		<th><center>Selling Total</th>
																	</tr>
																</thead>
															<tr>';
															$sql1 = "SELECT * FROM ss_order o,order_product op where o.order_id=op.order_id and o.order_id='".$global_order_id."'ORDER BY order_date DESC";
															$result1 = mysqli_query($conn,$sql1);
															while ($row2 = mysqli_fetch_array($result1))
															{
																// Print out the contents of the entry
																echo '<tr><td><center>' . $row2['order_product_name'] . '</center></td>';
																echo '<td><center>' . $row2['order_product_description'] . '</center></td>';
																echo '<td><center>' . $row2['order_product_quantity'] . '</center></td>';
																echo '<td><center>' . $row2['order_buying_price'] . '</center></td>';
																echo '<td><center>' . $row2['order_discount_percent'] . '</center></td>';
																echo '<td><center>' . $row2['order_discounted_price'] . '</center></td>';
																echo '<td><center>' . $row2['order_total_of_buying'] . '</center></td>';
																echo '<td><center>' . $row2['order_selling_percentage'] . '</center></td>';
																echo '<td><center>' . $row2['order_selling_price'] . '</center></td>';
																echo '<td><center>' . $row2['order_tax'] . '</center></td>';
																echo '<td><center>'; 
																if($row2['tax_inclusive']==1)
																{
																	echo "Inclusive";
																}
																else
																{
																	echo "Exclusive";
																}
																
																echo '</center></td>';
																echo '<td><center>' . $row2['order_total'] . '</center></td></tr>';
																$global_total=$global_total+$row2['order_total'];
															}		
															echo '<tr><td colspan="11" align="right" ><strong>TOTAL</strong></td><td><strong><center>' . $global_total . '</center></strong></td></tr>';
															$global_total=0;																
															echo '</tbody>
														</table>
													</div>
												</td>
												</tr>';
											}
											?>
										</tbody>
									</table>
								</div>
								<!-- Table Responsive -->
							</div>
						</div>
						<!-- Table: Latest Orders -->

						<!-- Table: Latest Tasks -->
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Tasks</h3>
								<div class="box-tools pull-right"></div>
							</div>
							<div class="box-body">
								<!-- Table Responsive -->
								<div class="table-responsive">
									<table class="table no-margin">
										<thead>
											<tr>
												<th><center>Task</center></th>
												<th><center>Task Description</center></th>
												<th><center>Task Assignee</center></th>
												<th><center>Task Start Date</center></th>
												<th><center>Task Due Date</center></th>
												<th><center>Task Priority</center></th>
												<th><center>Task Status</center></th>
												<th><center>Task Remarks</center></th>
												<th><center>Action</center></th>
											</tr>
										</thead>
										<tbody>
											<?php
											if($settings_result['view_all_task']!=1)
											{
												$sql = "SELECT * FROM task t, users u where t.task_assignee=u.id and t.delete_status<>1 and t.task_status<>'Completed' and t.location='".$user_result['location']."' and t.task_assignee='".$user_result['id']."' ORDER BY task_start_date DESC";
											}
											else
											{
												$sql = "SELECT * FROM task t, users u where t.task_assignee=u.id and t.delete_status<>1 and t.task_assignee='".$user_result['id']."' and t.task_status<>'Completed' ORDER BY task_start_date DESC";
											}
											$result = mysqli_query($conn,$sql);
											while ($row = mysqli_fetch_array($result))
											{
												// Print out the contents of the entry
												echo '<tr>';
												echo '<td style="width:12%"><center>' . $row['task_name'] . '</center></td>';
												echo '<td style="width:12%"><center>' . $row['task_description'] . '</center></td>';
												echo '<td style="width:8%"><center>' . $row['name'] . '</center></td>';
												echo '<td style="width:8%"><center>' . date("m-d-Y", strtotime($row['task_start_date'])) . '</center></td>';
												echo '<td style="width:8%"><center>' . date("m-d-Y", strtotime($row['task_due_date'])) . '</center></td>';
												echo '<td><center>' . $row['task_priority'] . '</center></td>';
												if( $row['task_status']=="Ongoing")
												{
													echo '<td style="width:8%"> <div class="badge bg-blue">' . $row['task_status'] . '</div></td>';
												}
												else if( $row['task_status']=="Completed")
												{
													echo '<td style="width:8%"><div class="badge bg-green"><center>' . $row['task_status'] . '</div></td>';
												}
												else if( $row['task_status']=="Cancelled")
												{
													echo '<td style="width:8%"><div class="badge bg-red"><center>' . $row['task_status'] . '</div></td>';
												}
												echo '<td><center>' . $row['task_remarks'] . '</center></td>';
												echo '<td><center><a href="../html/edit_task_html.php?id=' . $row['task_id'] . '" class="btn btn-primary btn-sm">Edit</a></center></td></tr>';
											}
											?>
										</tbody>
									</table>
								</div>
								<!-- Table Responsive -->
							</div>
							<div class="box-footer clearfix">
								<a href="../html/add_task_html.php" class="btn btn-primary btn-xs btn-flat pull-left">Add New Task</a>
								<a href="../reports/task_report_html.php" class="btn  btn-xs btn-warning btn-flat pull-right">View All Tasks</a>
							</div>
						</div>
						<!-- Table: Latest Tasks -->

				</section>
			</div>
			<!-- Content Wrapper, Contains Page Content -->

			<!-- Main Footer -->
			<footer class="main-footer">
				<div class="pull-right hidden-xs"></div>				
			</footer>
			<!-- Main Footer -->

			<!--Including right slide panel-->
			<?php include "../extra/aside.php";?>
			
			<!-- Add the sidebar's background this div must be placed immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
			<!-- Add the sidebar's background this div must be placed immediately after the control sidebar -->
		</div>
		<!-- End Of Content Wrapper, Contains Page Content -->

		<!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";?>
	</body>
	<script>
		$(document).ready(function()
		{
			// Handler for .ready() called.
			$("#li_dashboard").addClass("active");
		});
	</script>
</html>