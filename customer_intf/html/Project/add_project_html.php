<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php

	include "../../extra/session.php";
	include '../../dbconnect/dbconnect.php';
	include '../../constants.php';
	$url = $GLOBALS['url'];
	if ($_SESSION['id'])
	{
		$customer_id = $_SESSION['id'];
	}
	else
	{
		$url_value =$url."/html/login_html.php";
		header("Location:".$url_value);
	}

	?>
	<!--Including Login Session-->
	<head>
	<!--Including Bootstrap CSS links-->
	<?php include "../../extra/header.html";?>
	<!--Including Bootstrap CSS links-->
	</head>

	<body class="hold-transition skin-blue fixed sidebar-mini">
		<div class="wrapper">

			<!--Including Topbar-->
			<?php include "../../extra/topbar.php";?>
			<!--Including Topbar-->

			<!-- Left Side Panel Which Contains Navigation Menu -->
			<?php include "../../extra/left_nav_bar.php";?>
			<!-- Left Side Panel Which Contains Navigation Menu -->

			<div class="content-wrapper">
				<section class="content-header">
					<h1>
					Add Project
					<a href=<?php echo $GLOBALS['report_project'] ; ?> class="btn pull-right btn-xs btn-primary">Project Report</a>
					</h1>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="row">
						<div class="col-md-12">
							<div class="box box-primary">
								<div class="box-header with-border">
								</div>
								<div class="box-body pad">
									<form action="../../php/add/add_project_php.php" method="post"  onsubmit="submit.disabled = true; return true;">

									<!--Customer Name-->
									<input type ="hidden" name="customer_id" value="<?php echo $customer_id; ?>" >
									<!--Customer Name-->

									<!--Project Name-->
									<div class="form-group col-md-4">
										<label>Project Name</label>
										<div class="input-group">
											<span class="input-group-addon"><span class="fa fa-bank"></span></span>
											<input type="text" class="form-control" placeholder="Project Name" id="project_name" style="text-transform:capitalize" maxlength="100" name="project_name" required/>
										</div>
									</div>
									<!--Project Name-->

									<!--Site Incharge Name-->
									<div class="form-group col-md-4">
										<label>Site Incharge Name</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-user"></i></span>
											<input type="text" class="form-control" placeholder="Site Incharge Name" id="site_incharge_name"  style="text-transform:capitalize" maxlength="50" name="site_incharge_name" required/>
										</div>
									</div>
									<!--Site Incharge Name-->

									<!--Site Incharge Contact Number-->
									<div class="form-group col-md-4">
										<label>Site Incharge Contact Number</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
											<input type="text" class="form-control" placeholder="9873673737" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="project_incharge_contact_number"  name="project_incharge_contact_number" required/>
										</div>
									</div>
									<!--Site Incharge Contact Number-->


									<!--Customer Address-->
									<div class="form-group col-md-8">
										<label>Site Address</label>
										<textarea class="form-control" rows="3" placeholder="Ex: XYZ Bangalore" id="site_address" name="site_address" required></textarea>
									</div>
									<!--Customer Address-->




									<!--billing_details-->
									<div class="form-group col-md-4">
										<label>Billing Details - (Default to customer billing details)</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
											<textarea class="form-control" rows="3" placeholder="Blling Details" id="billing_details" name="billing_details" style="text-transform:capitalize"></textarea>
										</div>
									</div>
									<!--billing_details-->

									<!--Landmark-->
									<div class="form-group col-md-4">
										<label>Landmark</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
											<input type="text" class="form-control" placeholder="Landmark" id="project_landmark" name="project_landmark" style="text-transform:capitalize" required/>
										</div>
									</div>
									<!--Landmark-->


									<div class="col-lg-offset-10 col-lg-2">
										<button type="submit" data-loading-text="Please Wait..." class="btn btn-success form-control">Save  </button>
									</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</section>
				</div>

			<!-- Main Footer -->
			<footer class="main-footer">
				<div class="pull-right hidden-xs">
				</div>
			</footer>
			<!-- Main Footer -->

			<!--Including right slide panel-->
			<?php include "../../extra/aside.php";?>
			<!--Including right slide panel-->

			<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		</div>

		<!--Including Bootstrap and other scripts-->
		<?php include "../../extra/footer.html";?>
		<!--Including Bootstrap and other scripts-->
		<script>
		$(document).ready(function()
		{
			// Handler for .ready() called.
			$("#li_project").addClass("active");
			$("#li_add_project").addClass("active");
		});
		</script>
	</body>
</html>
