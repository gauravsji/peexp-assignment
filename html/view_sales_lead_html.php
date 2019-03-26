<!--
Description: View sales lead module shows sales lead information.
Date: 04/07/2017
-->
<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";
		$sales_lead_id=$_GET["id"];
		$sql = "SELECT * FROM sales_lead where sales_lead_id = " . $sales_lead_id;
		$result = mysqli_query($conn, $sql);
		$sales_lead_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
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
				<section class="content-header">
				<h1>
					Sales Lead Details
					<a href="../reports/sales_lead_report_html.php" class="btn pull-right btn-sm">
						<button type="button" class="btn btn-primary btn-sm">
							<i class="fa fa-arrow-left"></i> Back To Report
						</button>
					</a>
				</h1>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="box">
						<div class="box-body pad">
							<div class="row">
								<div class="col-xs-12">
									<h2 class="page-header">
										<i></i>   Name: <?php echo $sales_lead_result['sales_lead_name'] ?> 
										<div class="btn-toolbar">
											<?php echo '<a class="btn btn-primary btn-flat pull-right btn-sm" href="../html/edit_sales_lead_html.php?id='.$sales_lead_id.'"';'>'?>
												<button type="button" class="btn btn-primary ">
												<i class="fa fa-edit"></i> Edit
												</button>
											</a>
										</div>
									</h2>
								</div>
							</div>
							
							<div class="row invoice-info">
								<div class="col-sm-4 invoice-col">
									<address>
										<div class="table-responsive">
											<table class="table table-condensed">
												<tr><td width="25%"><center>Firm:</center> </td><td> <center><strong>   <?php echo $sales_lead_result['sales_lead_firm'] ?></strong></center></td></tr>
												<tr><td width="25%"><center>Contact Number:</center> </td><td> <center><strong>     <?php echo $sales_lead_result['sales_lead_contact_number'] ?></strong></center></td></tr>
												<tr><td width="25%"><center>Email:</center> </td><td> <center><strong>    <?php echo $sales_lead_result['sales_lead_email'] ?></strong></center></td></tr>
												<tr><td width="25%"><center>City:</center> </td><td> <center><strong>     <?php echo $sales_lead_result['sales_lead_city'] ?></strong></center></td></tr>
											</table>
										</div>	
									</address>
								</div>
								
								<div class="col-sm-4 invoice-col">
									<address>
										<div class="table-responsive">
											<table class="table table-condensed">
												<tr><td> <strong><center>Address</center></strong></td></tr>
												<tr><td> <?php echo $sales_lead_result['sales_lead_address'] ?></td></tr>
											</table>
										</div>	
									</address>
								</div>

								<div class="col-md-4 invoice-col">
									<strong>Additional Info:</strong>  <?php echo $sales_lead_result['sales_lead_additional_info'] ?><br>
								</div>
							</div>
							<div class="page-header">
							</div>
						
							<!-- this row will not appear when printing -->
							<div class="row no-print">
								<div class="col-xs-12">
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>

			<!-- Main Footer -->
			<footer class="main-footer">
			</footer>
			<!-- Main Footer -->

			<!--Including right slide panel-->
			<?php include "../extra/aside.php";?>
			<!--Including right slide panel-->
			
			<!-- Add the sidebar's background. This div must be placed
			immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		</div>
		<!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";?>
		<!--Including Bootstrap and other scripts-->
	</body>

	<script>
		$(document).ready(function()
		{
			// Handler for .ready() called.
			$("#li_enquiry").addClass("active");
			$("#li_sales_lead_report").addClass("active");
		});
	</script>
</html>
