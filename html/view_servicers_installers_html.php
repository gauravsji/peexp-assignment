<!--
Description: View service installers module shows the service and installers details.
Date: 04/07/2017
-->
<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";
		$service_installer_id=$_GET["id"];
		$sql = "SELECT * FROM service_installer where service_installer_id = " . $service_installer_id;
		$result = mysqli_query($conn, $sql);
		$service_installer_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
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
						Servicers And Installers
						<a href="../reports/servicers_installers_report_html.php" class="btn pull-right btn-sm">
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
										<i></i>   Name: <?php echo $service_installer_result['service_installer_name'] ?> 
										<div class="btn-toolbar">
											<?php echo '<a class="btn btn-primary btn-flat pull-right btn-sm" href="../html/edit_servicers_installers_html.php?id='.$service_installer_id.'"';'>'?>
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
										<strong>Contact Number:</strong>  <?php echo $service_installer_result['service_installer_contact_number'] ?><br>
										<strong>Alternate Contact Number:</strong>  <?php echo $service_installer_result['service_installer_alternate_contact_number'] ?><br>
										<strong>Email:</strong>  <?php echo $service_installer_result['service_installer_email'] ?><br>
										<strong>Type:</strong>  <?php echo $service_installer_result['service_installer_type'] ?><br>
									</address>
								</div>
								
								<div class="col-sm-4 invoice-col">
									<address>
										<strong>About:</strong><br>
										<?php echo $service_installer_result['service_installer_about'] ?>
									</address>
								</div>

								<div class="col-md-4 invoice-col">
									<strong>Info:</strong>  <?php echo $service_installer_result['service_installer_info'] ?><br>
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
							<!-- this row will not appear when printing -->
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
			
			<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
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
			$("#li_misc").addClass("active");
			$("#li_servicers_installers_report").addClass("active");
		});
	</script>
</html>