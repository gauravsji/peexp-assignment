
<!DOCTYPE html>
<html>
	<!-- Including Login Session -->
  <?php
    include "../extra/session.php";
    include "../constants.php";
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

					<div class="row">

							<div class="col-lg-3 col-xs-6">
								<div class="small-box bg-purple">
									<div class="inner">
										<h3>
										<?php
											$sql = "SELECT * FROM rfq where (pi_status='Awaiting') and delete_status<>1";
											$result = mysqli_query($conn,$sql);
											$count=0;
											while ($row = mysqli_fetch_array($result))
											{
												$count=$count+1; //Count the number of enquiries
											}
											echo $count;
										?>
										</h3>
										<p>Requests Pending</p>
									</div>
									<div class="icon">
										<i class="ion ion-clipboard"></i>
									</div>
									<a href="../reports/rfq_report_html.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

									</div>

							</div>

							<!-- ./col -->

							<div class="col-lg-3 col-xs-6">
								<!-- small box -->
								<div class="small-box bg-blue">
									<div class="inner">
										<h3>
										<?php
											$sql = "SELECT * FROM rfq where (po_status!='approved') and delete_status<>1";
											$result = mysqli_query($conn,$sql);
											$count=0;
											while ($row = mysqli_fetch_array($result))
											{
											$count=$count+1; //Count the number of orders
											}
											echo $count;
										?>
										</h3>
										<p>Requests Approved</p>
									</div>
									<div class="icon">
										<i class="ion ion-bag"></i>
									</div>
									<a href="../reports/rfq_report_html.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
							<!-- ./col -->

							<div class="col-lg-3 col-xs-6">
								<!-- small box -->
								<div class="small-box bg-orange">
									<div class="inner">
										<h3>
										<?php
											$sql = "SELECT * FROM rfq where (po_status!='Null') and delete_status<>1";
											$result = mysqli_query($conn,$sql);
											$count=0;
											while ($row = mysqli_fetch_array($result))
											{
											$count=$count+1; //Count the number of orders
											}
											echo $count;
										?>
										</h3>
										<p>Orders Pending</p>
									</div>
									<div class="icon">
										<i class="ion ion-ios-stopwatch"></i>
									</div>
									<a href=" ../reports/rfq_report_html.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
							<!-- ./col -->

							<div class="col-lg-3 col-xs-6">
								<!-- small box -->
								<div class="small-box bg-green">
									<div class="inner">
										<h3>
										<?php
											$sql = "SELECT * FROM rfq where (po_status='approved') and delete_status<>1";
											$result = mysqli_query($conn,$sql);
											$count=0;
											while ($row = mysqli_fetch_array($result))
											{
												$count=$count+1; //Count the number of orders
											}
											echo $count;
										?>
										</h3>
										<p>Orders Completed</p>
									</div>
									<div class="icon">
										<i class="ion ion-ios-checkmark"></i>
									</div>
									<a href="../reports/rfq_report_html.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
						<!-- ./col -->
						</div>


						<!-- Div Row -->
						<div class="row">
							<!-- 1 col -->
							<a href="../reports/rfq_report_html.php">
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="info-box" href="new_enquires_html.php">
										<span class="info-box-icon bg-purple"><i class="ion ion-clipboard"></i></span>
										<div class="info-box-content">
											<span class="info-box-text">All Requests</span>
											<span class="info-box-number">
												<?php
												$sql = "SELECT * FROM rfq e
												                                LEFT OUTER JOIN customer c ON e.customer_id=c.customer_id
													                                where delete_status<>1 and c.customer_id=".$_SESSION['id'];
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
							<a href="../reports/rfq_report_html.php">
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="info-box">
										<span class="info-box-icon bg-blue"><i class="ion-ios-cart"></i></span>
										<div class="info-box-content">
											<span class="info-box-text">All Orders</span>
											<span class="info-box-number">
													<?php
												$sql = "SELECT * FROM rfq e 
												                        LEFT OUTER JOIN customer c ON e.customer_id=c.customer_id
												                        where e.delete_status<>1 and (e.pi_status='Awaiting'||e.pi_status='approved'||e.pi_status='') and e.subset=".$_SESSION['id'];												$result = mysqli_query($conn,$sql);
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
							<a href="../reports/user_report_html.php" >
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="info-box">
										<span class="info-box-icon bg-orange"><i class="ion-android-contacts"></i></span>
										<div class="info-box-content">
											<span class="info-box-text">ALL USERS</span>
											<span class="info-box-number">
											<?php
												if($_SESSION['id'] == $_SESSION['groupId'])
												{
												$sql = "SELECT * FROM customer where delete_status<>1 and subset='".$_SESSION['groupId']."'";
												}
												else
												{
													$sql = "SELECT * FROM customer where delete_status<>1 and customer_id = '".$_SESSION['id']."'";
												}
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
							<a href="../reports/project_report_html.php">
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="info-box">
										<span class="info-box-icon bg-green"><i class="ion ion-person-stalker"></i></span>
										<div class="info-box-content">
											<span class="info-box-text">ALL PROJECTS</span>
											<span class="info-box-number">
												<?php
													$sql = "SELECT * FROM Project where delete_status<>1 and customer_id='".$_SESSION['id']."'";
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
						<div class="box box-primary">
						<div class="box-header with-border">
								<h3 class="box-title">Order Report</h3>
								<div class="box-tools pull-right"></div>
							</div>
						<div class="box-body">
				<div class="table-responsive">
							<table id="view_enquiry_html" class="table table-bordered table-striped table-condensed stripe row-border order-column" width="100%">
								<thead>
									<tr>
									<th width="5%"><center>Request ID</center></th>

									<th width="5%"><center>Date</center></th>
									<th><center>Name</center></th>
									<!-- <th><center>Sales Lead</center></th> -->
									<th><center>Assignee</center></th>
									<th><center>Project</center></th>
									<th><center>Status</center></th>
									<th><center>Priority</center></th>
									<th><center>PI Status</center></th>
									<th><center>PO Status</center></th>
									<th><center>View</center></th>
								</thead>

								<tbody>
									<?php
										if($_SESSION['id'] == $_SESSION['groupId'])
										{
										$sql_enquiry = "SELECT * FROM rfq where  delete_status<>1";
										$result_enquiry = mysqli_query($conn, $sql_enquiry);
										$enquiry_result = mysqli_fetch_array($result_enquiry,MYSQLI_ASSOC);

										$sql = "SELECT * FROM rfq e
												LEFT OUTER JOIN customer c ON e.customer_id=c.customer_id
												LEFT OUTER JOIN project p ON e.project_id = p.project_id
												WHERE e.delete_status <> 1 and e.enquiry_date > curdate()-800 and c.subset=".$_SESSION['id'];
										}
										else
										{
											$sql = "SELECT * FROM rfq e
												LEFT OUTER JOIN customer c ON e.customer_id=c.customer_id
												LEFT OUTER JOIN project p ON e.project_id = p.project_id
												WHERE e.delete_status <> 1 and e.enquiry_date > curdate()-800 and e.customer_id=".$_SESSION['id'];
										}

										$result = mysqli_query($conn,$sql);
										while ($row = mysqli_fetch_array($result))
										{
											// Print out the contents of the entry
											echo '<tr>';
											////$originalDate =  $row['enquiry_date'];
											//echo '<td  width="5%"><center>' . date("d-m-Y", strtotime($originalDate)). '</center></td>';
											echo '<td  width="5%"><center>' . $row['rfq_id'] . '</center></td>';
											echo '<td  width="5%"><center>' . $row['enquiry_date'] . '</center></td>';
											echo '<td><center>' . $row['enquiry_name'] . '</center></td>';


											if($row['customer_name']!="")
											{
											echo '<td><center>' . $row['customer_name'] . '</center></td>';
											}
											else
											{
												echo "<td><center>NONE</center></td>";
											}
											if($row['project_name']!="")
											{
											echo '<td><center>' . $row['project_name'] . '</center></td>';
											}
											else
											{
												echo "<td><center>NONE</center></td>";
											}
											if(($row['pi_status'] == 'approved')&& ($row['po_status']=="approved"))
											{
												echo '<td style="width:12%"><center><div class="badge bg-green"><center>' . "ORDERED" . '</div></center></td>';
											}

										/* 	if($row['sales_lead_name']!="")
											{
											echo '<td><center>' . $row['sales_lead_name'] . '</center></td>';
											}
											else
											{
												echo "<td><center>NONE</center></td>";
											} */


											/*if(( $row['enquiry_status']=="OPEN - QUOTE TO BE SENT" )||( $row['enquiry_status']=="OPEN - AWAITING PRODUCT INFO FROM CLIENT" )||( $row['enquiry_status']=="OPEN - AWAITING PRODUCT INFO FROM VENDOR")||( $row['enquiry_status']=="OPEN - PRODUCT RESEARCH PENDING")||( $row['enquiry_status']=="OPEN - QUOTE SENT, AWAITING APPROVAL"))
											{
												echo '<td style="width:12%"><center><div class="badge bg-blue">' . "OPEN" . '</div></center></td>';
											}*/
											else if(($row['enquiry_status']=="CLOSED - REJECTED, PRICE TOO HIGH")||( $row['enquiry_status']=="CLOSED - REJECTED, NOT THE RIGHT PRODUCT")||( $row['enquiry_status']=="CLOSED - REJECTED, DELAYED REPONSE")||( $row['enquiry_status']=="CLOSED - CLIENT CHANGED REQUIREMENT")||( $row['enquiry_status']=="CLOSED - VENDOR NOT FOUND"))
											{
											echo '<td style="width:12%"><div class="badge bg-red"><center>' . "CLOSED" . '</div></td>';
											}
											else if( $row['enquiry_status']=="CLOSED - CONVERTED TO ORDER")
											{
											echo '<td style="width:12%"><div class="badge bg-green"><center>' . "ORDERED" . '</div></td>';
											}
											else if($row['pi_status'] == 'approved')
											{
												echo '<td style="width:12%"><center><div class="badge bg-red"><center>Quote Received</div></center></td>';
											}

											else if($row['enquiry_status']=="")
											{
											echo '<td style="width:12%"><center><div class="badge bg-red"><center>Request Quote</div></center></td>';
											}
											else {
												echo '<td style="width:12%"><center><div class="badge bg-red">Request Quote</div></center></td>';
											}

											if( $row['enquiry_priority']=="LOW" || $row['enquiry_priority']=="")
											{
												echo '<td style="width:12%"><div class="badge bg-teal">' . "LOW" . '</div></td>';
											}
											else if( $row['enquiry_priority']=="MEDIUM" || $row['enquiry_priority']=="medium" )
											{
												echo '<td style="width:12%"><div class="badge bg-yellow">' . "MEDIUM" . '</div></td>';
											}
											else if( $row['enquiry_priority']=="HIGH" )
											{
												echo '<td style="width:12%"><div class="badge bg-orange">' . "HIGH" . '</div></td>';
											}
											else if( $row['enquiry_priority']=="CRITICAL" )
											{
												echo '<td style="width:12%"><div class="badge bg-red">' . "CRITICAL" . '</div></td>';
											}
											else {
												echo '<td></td>';
											}

											if($row['pi_status'] == null)
											{
												echo '<td><center><button class="btn btn-info btn-xs">Awaitnig</button></center></td>';
											}
											else if($row['pi_status'] == 'Awaitnig')
											{
												echo '<td><center><button class="btn btn-info btn-xs">Awaitnig</button></center></td>';
											}
											else if($row['pi_status'] == 'approved')
											{
												echo '<td><center><button class="btn btn-success btn-xs">Approved</button></center></td>';
											}
											else {
												echo '<td><center><button class="btn btn-info btn-xs">Awaitnig</button></center></td>';
											}

											if($row['po_status'] == null || $row['po_status'] == "" || $row['po_status'] == "Awaitnig")
											{
													echo '<td><center><button class="btn btn-info btn-xs">Awaitnig</button></center></td>';
											}
											else if($row['po_status'] == 'customer_approved')
											{
												echo '<td><center><button class="btn btn-warning btn-xs">Approved</button></center></td>';
											}
											else if($row['po_status'] == 'uploaded'){
												echo '<td><center><button class="btn btn-warning btn-xs">Uploaded</button></center></td>';
											}
											else if($row['po_status'] == "approved")
											{
												echo '<td><center><button class="btn btn-success btn-xs">Approved</button></center></td>';
											}
											else {
												echo '<td><center><button class="btn btn-info btn-xs">Awaitnig</button></center></td>';
											}
											echo  "<td><center> <a target='_blank' href='../html/view_rfq_html.php?id=" . $row['rfq_id'] . "' class='btn btn-primary btn-xs' title='view'><i class='fa fa-eye'></i></a></center></td>";
											echo "</tr>";
										}
									?>
								</tbody>
							</table>
						</div>
						</div>
						</div>
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
