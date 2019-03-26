<!--
Description: View daily log module displays daily information.
Date: 04/07/2017
-->
<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";
		$daily_log_id=$_GET["id"];
		$sql = "SELECT * FROM daily_log where daily_log_id = " . $daily_log_id;
		$result = mysqli_query($conn, $sql);
		$daily_log_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
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
						Daily Log Data
						<a href="../reports/daily_log_report_html.php" class="btn pull-right">
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
										<div class="btn-toolbar">
											<?php echo '<a class="btn btn-primary btn-flat pull-right btn-sm" href="../html/edit_daily_log_html.php?id='.$daily_log_id.'"';'>'?>
												<button type="button" class="btn btn-primary btn-sm">
													<i class="fa fa-edit"></i> Edit
												</button>
											</a>
										</div>           
									</h2>
								</div>
							</div>
							
							<div class="row invoice-info">
								<div class="col-sm-12 invoice-col">
									<address>
										<div class="table-responsive">
											<table class="table table-condensed">
												<tr><td><strong><center>DAILY LOG</center></strong></td></tr>
												<tr><td><center><?php echo $daily_log_result['daily_log'] ?></center></td></tr>  
											</table>
										</div>				
									</address>
								</div>        
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
			$("#li_daily_operations").addClass("active");
			$("#li_daily_log_report").addClass("active");
		});
	</script>
</html>
