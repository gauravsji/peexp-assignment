<!--
Description: View payment module displays information about the payments made or recieved from vendors and customers respectively.
Date: 04/07/2017
-->
<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";
		$payment_id=$_GET["id"];	
		$sql = "SELECT * FROM payment p
				LEFT OUTER JOIN vendor v ON p.vendor_id=v.vendor_id
				LEFT OUTER JOIN customer c ON p.customer_id=c.customer_id
				LEFT OUTER JOIN project pr ON p.project_id = pr.project_id
				WHERE p.delete_status <> 1 and p.payment_id = " . $payment_id;
				$result = mysqli_query($conn, $sql);
				$task_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
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
						Payment Details
						<a href="../reports/payment_report_html.php" class="btn pull-right btn-sm">
							<button type="button" class="btn btn-primary btn-sm">
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
									<i></i><center>   Date: <?php echo date("d-m-Y", strtotime($task_result['payment_date']))  ?> </center>
									<div class="btn-toolbar">
										<?php echo '<a class="btn btn-primary btn-flat pull-right btn-sm" href="../html/edit_payment_html.php?id='.$payment_id.'"';'>'?>
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
												<tr><td width="35%"><center>CUSTOMER NAME:</center> </td><td> <center><strong>  <?php echo $task_result['customer_name'];?></strong></center></td></tr>
												<tr><td width="35%"><center>PROJECT NAME:</center> </td><td> <center><strong>  <?php echo $task_result['project_name'];?></strong></center></td></tr>
												<tr><td width="35%"><center>PAYMENT AMOUNT:</center> </td><td> <center><strong>  <?php echo $task_result['payment_amount'];  ?></strong></center></td></tr>
												<tr><td width="35%"><center>PAYMENT TYPE:</center> </td><td> <center><strong>  <?php echo $task_result['payment_type'] ?></strong></center></td></tr>
											</table>
										</div>	
									</address>
								</div>
								
								<div class="col-sm-4 invoice-col">
									<address>
										<div class="table-responsive">
											<table class="table table-condensed">
												<tr><td width="35%"><center>VENDOR NAME:</center> </td><td> <center><strong>  <?php echo $task_result['vendor_name'] ?></strong></center></td></tr>
												<tr><td width="35%"><center>TRANSACTION REFERENCE NUMBER:</center> </td><td> <center><strong>  <?php echo $task_result['payment_transaction_ref_no'] ?></strong></center></td></tr>
												<tr><td width="35%"><center>PAYMENT METHOD:</center> </td><td> <center><strong>  <?php echo $task_result['payment_method'] ?></strong></center></td></tr>           
											</table>
										</div>	
									</address>
								</div>

								<div class="col-md-4 invoice-col">
									<address>
										<div class="table-responsive">
											<table class="table table-condensed">
												<center>REMARKS:</center>
												<tr><td width="25%"><center><strong><?php echo $task_result['payment_remarks'] ?></strong></center></td></tr>
											</table>
										</div>	         
									</address>
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

	<script>
		$(document).ready(function()
		{
			// Handler for .ready() called.
			$("#li_payment").addClass("active");
			$("#li_payment_report").addClass("active");
		});
	</script>
</html>