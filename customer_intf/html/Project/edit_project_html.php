<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php
	include "../../extra/session.php";
	include '../../constants.php';
	$url = $GLOBALS['url'];
	if (!isset($_GET['id']))
	{
		//Do Nothing
	}
	else
	{
	$project_id = $_GET['id'];
	$sql = "SELECT * FROM project where project_id = " . $project_id;
	$result = mysqli_query($conn, $sql);
	$project_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
	}
	?>
	<!--Including Login Session-->

	<head>
	<!--Including Bootstrap CSS links-->
	<?php include "../../extra/header.html";?>
	<!--Including Bootstrap CSS links-->

	<script>
	$(document).ready(function()
	{
	// Handler for .ready() called.
	$("#li_customer").addClass("active");
	$("#li_add_project").addClass("active");
	});
	</script>
	</head>
	<body class="hold-transition skin-blue fixed sidebar-mini">
		<div class="wrapper">

			<!--Including Topbar-->
			<?php include "../../extra/topbar.php";?>
			<!--Including Topbar-->

				<!-- Left Side Panel Which Contains Navigation Menu -->
	<?php include "../../extra/left_nav_bar.php";?>
	<!-- Left Side Panel Which Contains Navigation Menu -->

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
					Edit Project <a href=<?php echo $GLOBALS['report_project']?> class="btn pull-right btn-sm btn-primary">Project Report</a>
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
									<form action="../../php/update/update_project_php.php" method="post">

								<div class="form-group col-md-4">
										<label>Project Name</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
											<input type="text" class="form-control" placeholder="Project Name" id="project_name"  value="<?php echo $project_result['project_name'] ?>" maxlength="30" name="project_name"/>
										</div>
									</div>
									<!--Project Name-->

									<!--Client Name-->
									<div class="form-group col-md-4">
										<label>Site Incharge Name</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-user"></i></span>
											<input type="text" class="form-control" placeholder="Site Incharge Name" style="text-transform:capitalize" id="site_incharge_name" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode==32' maxlength="30" name="site_incharge_name" value="<?php echo $project_result['project_site_incharge_name'] ?>"/>
										</div>
									</div>
									<!--Client Name-->

									<!--Site Incharge Contact Number-->
									<div class="form-group col-md-4">
										<label>Site Incharge Contact Number</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
											<input type="text" class="form-control" placeholder="9873673737" id="project_incharge_contact_number"  name="project_incharge_contact_number" value="<?php echo $project_result['project_site_incharge_contact_number'] ?>"  onkeypress='return event.charCode>= 48 && event.charCode <= 57'/>
										</div>
									</div>
									<!--Site Incharge Contact Number-->
									<!--Customer Address-->
									<div class="form-group col-md-8">
										<label>Site Address</label>
										<textarea class="form-control" rows="3" placeholder="Ex: XYZ Bangalore" id="site_address" maxlength="350" name="site_address"><?php echo $project_result['project_site_address']?></textarea>
									</div>
									<!--Customer Address-->


									<!--billing_details-->
									<div class="form-group col-md-4">
										<label>Billing Details - (Default to customer billing details)</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
											<textarea class="form-control" rows="3" placeholder="Blling Details" id="billing_details" name="billing_details" style="text-transform:capitalize"><?php  echo $project_result['billing_details'] ?></textarea>
										</div>
									</div>
									<!--billing_details-->


										<!--Landmark-->
									<div class="form-group col-md-4">
										<label>Landmark</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
											<input type="text" class="form-control" placeholder="Landmark" id="project_landmark"  name="project_landmark" value="<?php echo $project_result['project_landmark'] ?>"/>
										</div>
									</div>
									<!--Landmark-->


									<input type="hidden" name="project_id" id="project_id" value="<?php echo $project_result['project_id']?>">
									  <div class="col-lg-offset-10 col-lg-2">
												<button type="submit" data-loading-text="Please Wait..." class="btn btn-success form-control">Update  </button>
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
			<?php include "../../extra/aside.php";?>
			<!--Including right slide panel-->
			<!-- Add the sidebar's background. This div must be placed
			immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		</div>
		<!-- ./wrapper -->

		<!--Including Bootstrap and other scripts-->
		<?php include "../../extra/footer.html";?>
		<!--Including Bootstrap and other scripts-->

		<!-- Bootstrap 3.3.6 -->
		<script src="../../bootstrap/js/bootstrap.min.js"></script>
		<!-- Select2 -->
		<script src="../../plugins/select2/select2.full.min.js"></script>
		<!-- InputMask -->
		<script src="../../plugins/input-mask/jquery.inputmask.js"></script>
		<script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
		<script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script>
		<!-- date-range-picker -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>

		<!-- SlimScroll 1.3.0 -->
		<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<!-- iCheck 1.0.1 -->
		<script src="../../plugins/iCheck/icheck.min.js"></script>
		<!-- FastClick -->
		<script src="../../plugins/fastclick/fastclick.js"></script>
		<!-- AdminLTE App -->
		<script src="../../dist/js/app.min.js"></script>

		<!-- Page script -->
		<script>
		$(function () {
		//Initialize Select2 Elements
		$(".select2").select2();

		//Datemask dd/mm/yyyy
		$("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
		//Datemask2 mm/dd/yyyy
		$("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
		//Money Euro
		$("[data-mask]").inputmask();

		//Date range picker
		$('#reservation').daterangepicker();
		//Date range picker with time picker
		$('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
		//Date range as a button
		$('#daterange-btn').daterangepicker(
		{
		ranges: {
		'Today': [moment(), moment()],
		'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
		'Last 7 Days': [moment().subtract(6, 'days'), moment()],
		'Last 30 Days': [moment().subtract(29, 'days'), moment()],
		'This Month': [moment().startOf('month'), moment().endOf('month')],
		'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		},
		startDate: moment().subtract(29, 'days'),
		endDate: moment()
		},
		function (start, end) {
		$('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
		}
		);

		//Date picker
		$('#datepicker').datepicker({
		autoclose: true
		});

		//iCheck for checkbox and radio inputs
		$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
		checkboxClass: 'icheckbox_minimal-blue',
		radioClass: 'iradio_minimal-blue'
		});
		//Red color scheme for iCheck
		$('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
		checkboxClass: 'icheckbox_minimal-red',
		radioClass: 'iradio_minimal-red'
		});
		//Flat red color scheme for iCheck
		$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
		checkboxClass: 'icheckbox_flat-green',
		radioClass: 'iradio_flat-green'
		});

		//Colorpicker
		$(".my-colorpicker1").colorpicker();
		//color picker with addon
		$(".my-colorpicker2").colorpicker();

		//Timepicker
		$(".timepicker").timepicker({
		showInputs: false
		});
		});
		</script>
	</body>
</html>

