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
			
			<script>
			$(document).ready(function()
			{
			// Handler for .ready() called.
			 $("#li_daily_operations").addClass("active");
			 $("#li_add_daily_log").addClass("active");
			});
			</script>
	</head>
	<body class="hold-transition skin-blue fixed sidebar-mini">
		<div class="wrapper">

			<!--Including Topbar-->
			<?php include "../extra/topbar.php";?>
			<!--Including Topbar-->

					<!--Including Left Nav Bar-->
			<?php include "../extra/left_nav_bar.php";?>
			<!--Including Left Nav Bar-->

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>Edit Daily Log 
						<div class="btn-toolbar pull-right">
							<a href="../html/add_daily_log_html.php" class="btn btn-sm btn-primary">New Log</a>  
							<a href="../reports/daily_log_report_html.php" class="btn btn-sm btn-success">Daily Log Report</a>
						</div>
						</h1>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="row">
						<!-- left column -->
						<div class="col-md-12">
							<!-- general form elements -->
							<div class="box box-primary">
								<div class="box-header with-border">
								</div>
								<!-- /.box-header -->
								<div class="box-body pad">
									<form action="../php/update/update_daily_log_php.php" method="post">
											<input type="hidden" name="daily_log_id" id="daily_log_id" value="<?php echo $daily_log_result['daily_log_id'] ?>">
											<div class="box-body pad">
												<textarea id="daily_log" name="daily_log" rows="15" cols="80">
												<?php echo $daily_log_result['daily_log'] ?>
												</textarea>
											</div>		

										<!-- User ID -->
										<input id="user_id" name="user_id" type="hidden" value="<?php echo $user_result['id'];?>" />
										<!-- User ID -->
										
										<div class="col-lg-offset-10 col-lg-2">
											<button type="submit" data-loading-text="Please Wait..." class="btn btn-success form-control">Update </button>
										</div>										
	 
								   </form>
								</div>
							</div>
							<!-- /.box -->
						</div>
						<!--/.col (left) -->
					</div>
					<!-- /.row -->
				</section>
				<!-- /.content -->
			</div>
			<!-- /.content-wrapper -->

			<!-- Main Footer -->
			<footer class="main-footer">
				<div class="pull-right hidden-xs">
				</div>				
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
	  $(function () 
	  {
		CKEDITOR.replace('daily_log');
	  });
	</script>
</html>