<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";
	$email_address=$_SESSION['email_address'];
	$sql = "SELECT * FROM users where email='".$email_address."'";
	$result = mysqli_query($conn, $sql);
	$users_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
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
				
						<!-- Div Row -->
						<div class="row">
						
							<!-- 1 col -->
							<a href="../reports/open_enquiry_report_html.php">
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="info-box" href="open_enquiry_report_html.php">
										<span class="info-box-icon bg-orange"><i class="ion-android-list"></i></span>
										<div class="info-box-content">
											<span class="info-box-text">Open Enquiries</span>
											<span class="info-box-number">
												<?php
													$sql = "SELECT * FROM enquiry where delete_status<>1  and location='".$user_result['location']."' and enquiry_status='OPEN - QUOTE TO BE SENT' or enquiry_status='OPEN - AWAITING PRODUCT INFO FROM CLIENT' or enquiry_status='OPEN - AWAITING PRODUCT INFO FROM VENDOR' or enquiry_status='OPEN - PRODUCT RESEARCH PENDING' or enquiry_status='OPEN - QUOTE SENT, AWAITING APPROVAL'";
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
							
							<!-- 2 col -->
							<a href="../reports/closed_enquiry_report_html.php">
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="info-box" href="completed_enquiry_report_html.php">
										<span class="info-box-icon bg-red"><i class="ion-android-list"></i></span>
										<div class="info-box-content">
											<span class="info-box-text">Closed Enquiries</span>
											<span class="info-box-number">
												<?php
													$sql = "SELECT * FROM enquiry e
												LEFT OUTER JOIN sales_lead sl ON e.sales_lead_id=sl.sales_lead_id
												LEFT OUTER JOIN customer c ON e.customer_id=c.customer_id
												LEFT OUTER JOIN project p ON e.project_id = p.project_id
												LEFT OUTER JOIN users u ON u.id = e.enquiry_assignee
												WHERE e.delete_status <> 1 and e.location='".$user_result['location']."' and (e.enquiry_status='CLOSED - REJECTED, PRICE TOO HIGH' or e.enquiry_status='CLOSED - REJECTED, NOT THE RIGHT PRODUCT' or e.enquiry_status='CLOSED - REJECTED, DELAYED REPONSE' or e.enquiry_status='CLOSED - CLIENT CHANGED REQUIREMENT' or e.enquiry_status='CLOSED - VENDOR NOT FOUND')";
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
							<!-- 2 col -->
							
							<!-- 3 col -->
							<a href="../reports/completed_enquiry_report_html.php">
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="info-box" href="completed_enquiry_report_html.php">
										<span class="info-box-icon bg-green"><i class="ion-android-list"></i></span>
										<div class="info-box-content">
											<span class="info-box-text">Completed Enquiries</span>
											<span class="info-box-number">
												<?php
													$sql = "SELECT * FROM enquiry where delete_status<>1 and location='".$user_result['location']."' and enquiry_status='CLOSED - CONVERTED TO ORDER'";
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
							<!-- 3 col -->

							<!-- 4 col -->
							<a href="../reports/enquiry_report_html.php">
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="info-box">
										<span class="info-box-icon bg-blue"><i class="ion-android-list"></i></span>
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
							<!-- 4 col -->

						</div>


						<!-- Div Row -->
						<div class="row">
						
						<!-- 1 col -->
							<a href="../reports/order_created_report_html.php" >
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="info-box">
										<span class="info-box-icon bg-orange"><i class="ion-ios-cart"></i></span>
										<div class="info-box-content">
											<span class="info-box-text">Order Created</span>
											<span class="info-box-number">
											<?php
												$sql = "SELECT * FROM ss_order o,vendor v,customer c,project p where o.vendor_id=v.vendor_id and o.customer_id=c.customer_id and o.project_id=p.project_id and o.delete_status=0 and o.order_status='Order Created' and o.location='".$user_result['location']."'";
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
							<!-- 1 col -->							
							
							<!-- 2 col -->
							<a href="../reports/placed_order_report_html.php">
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="info-box" href="placed_order_report_html.php">
										<span class="info-box-icon bg-orange-active"><i class="ion-ios-cart"></i></span>
										<div class="info-box-content">
											<span class="info-box-text">Orders Placed</span>
											<span class="info-box-number">
												<?php
													$sql = "SELECT * FROM ss_order o,vendor v,customer c,project p where o.vendor_id=v.vendor_id and o.customer_id=c.customer_id and o.project_id=p.project_id and o.delete_status=0 and o.order_status='Order Placed' and o.location='".$user_result['location']."'";
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
							<!-- 2 col -->

							<!-- 3 col -->
							<a href="../reports/order_ready_to_dispatch_report_html.php">
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="info-box" href="order_ready_to_dispatch_report_html.php">
										<span class="info-box-icon bg-yellow"><i class="ion-ios-cart"></i></span>
										<div class="info-box-content">
											<span class="info-box-text">Dispatch Ready</span>
											<span class="info-box-number">
												<?php
													$sql = "SELECT * FROM ss_order o,vendor v,customer c,project p where o.vendor_id=v.vendor_id and o.customer_id=c.customer_id and o.project_id=p.project_id and o.delete_status=0 and o.order_status='Material Ready To Dispatch' and o.location='".$user_result['location']."'";
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
							<a href="../reports/completed_order_report_html.php">
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="info-box">
										<span class="info-box-icon bg-blue"><i class="ion-bag"></i></span>
										<div class="info-box-content">
											<span class="info-box-text">Orders Fulfilled</span>
											<span class="info-box-number">
											<?php
												$sql = "SELECT * FROM ss_order where delete_status<>1 and order_status='Order Fulfilled' and location='".$user_result['location']."'";
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
							<!-- 4 col -->
						</div>
						<!-- Div Row -->
						
						
						
						<!-- Div Row -->
						<div class="row">
								<a href="../reports/all_order_report_html.php">
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="info-box">
										<span class="info-box-icon bg-blue"><i class="ion-bag"></i></span>
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
						</div>
							
							
						<!-- Div Row -->
						<div class="row">
							<!-- 1 col -->
							<a href="../reports/ongoing_task_report_html.php">
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="info-box" href="ongoing_task_report_html.php">
										<span class="info-box-icon bg-blue"><i class="ion-android-options"></i></span>
										<div class="info-box-content">
											<span class="info-box-text">Ongoing Tasks</span>
											<span class="info-box-number">
												<?php
													if($settings_result['view_all_task']!=1)
													{
														$sql = "SELECT * FROM task t, users u where t.task_assignee=u.id and t.delete_status<>1 and t.task_status='Ongoing' and t.location='".$user_result['location']."'";
													}
													else
													{
														$sql = "SELECT * FROM task t, users u where t.task_assignee=u.id and t.task_status='Ongoing' and t.delete_status<>1";
													}									
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

							<!-- 2 col -->
							<a href="../reports/own_task_report_html.php">
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="info-box">
										<span class="info-box-icon bg-purple"><i class="ion-android-options"></i></span>
										<div class="info-box-content">
											<span class="info-box-text">Own Tasks</span>
											<span class="info-box-number">
											<?php
												if($settings_result['view_all_task']!=1)
													{
														$sql = "SELECT * FROM task t, users u where t.task_assignee=u.id and t.delete_status<>1 and t.location='".$user_result['location']."' and t.task_assignee='".$user_result['id']."'";
													}
													else
													{
														$sql = "SELECT * FROM task t, users u where t.task_assignee=u.id and t.delete_status<>1 and t.task_assignee='".$user_result['id']."'";
													}
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
							<!-- 2 col -->

							<!-- 3 col -->
							<a href="../reports/completed_task_report_html.php">
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="info-box">
										<span class="info-box-icon bg-green"><i class="ion-android-options"></i></span>
										<div class="info-box-content">
											<span class="info-box-text">Completed Tasks</span>
											<span class="info-box-number">
											<?php
												if($settings_result['view_all_task']!=1)
													{
														$sql = "SELECT * FROM task t, users u where t.task_assignee=u.id and t.delete_status<>1 and t.task_status='Completed' and t.location='".$user_result['location']."'";
													}
													else
													{
														$sql = "SELECT * FROM task t, users u where t.task_assignee=u.id and t.task_status='Completed' and t.delete_status<>1";
													}
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
						<a href="../reports/cancelled_task_report_html.php">
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="info-box">
										<span class="info-box-icon bg-blue"><i class="fa fa-tasks"></i></span>
										<div class="info-box-content">
											<span class="info-box-text">Cancelled Tasks</span>
											<span class="info-box-number">
											<?php
												if($settings_result['view_all_task']!=1)
													{
														$sql = "SELECT * FROM task t, users u where t.task_assignee=u.id and t.delete_status<>1 and t.task_status='Cancelled' and t.location='".$user_result['location']."'";
													}
													else
													{
														$sql = "SELECT * FROM task t, users u where t.task_assignee=u.id and t.task_status='Cancelled' and t.delete_status<>1";
													}
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
						
							<!-- 4 col -->
</div>	
						
						
						
						<div class="row">
					
						<a href="../reports/task_report_html.php">
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="info-box">
										<span class="info-box-icon bg-blue"><i class="fa fa-tasks"></i></span>
										<div class="info-box-content">
											<span class="info-box-text">All Tasks</span>
											<span class="info-box-number">
												<?php
												if($settings_result['view_all_task']!=1)
												{
													$sql = "SELECT * FROM task t, users u where t.task_assignee=u.id and t.delete_status<>1 and t.location='".$user_result['location']."'";
												}
												else
												{
													$sql = "SELECT * FROM task t, users u where t.task_assignee=u.id and t.delete_status<>1";
												}
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
							
							
						
						</div>	
							
							

				
				
			</section>
			</div>
			<!-- /.content-wrapper -->

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
	</body>
</html>