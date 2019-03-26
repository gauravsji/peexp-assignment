<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";?>
	<!--Including Login Session-->

	<head>
		<!--Including Bootstrap and CSS links-->
		<?php include "../extra/header.html";?>
		<!--Including Bootstrap and CSS links-->
		
	
			<script type="text/javascript">
			$(document).ready(function()
			{
				// Handler for .ready() called.
				$("#li_misc").addClass("active");
				$("#li_add_servicers_installers").addClass("active");
			});
			</script>

			
	</head>

	<body class="hold-transition skin-blue fixed sidebar-mini">
		<div class="wrapper">
			<!--Including Topbar-->
			<?php include "../extra/topbar.php";?>
			<!--Including Topbar-->

			<!-- Left Side Panel Which Contains Navigation Menu -->
			<?php include "../extra/left_nav_bar.php";?>
			<!-- Left Side Panel Which Contains Navigation Menu -->

			<!-- Content Wrapper and contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						Add Servicer's/Installer's  
						<a href="../reports/servicers_installers_report_html.php" class="btn pull-right btn-xs btn-primary">Servicers & Installers Report</a>
					</h1>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="row">
						<div class="col-md-12">
							<div class="box box-primary">
								<div class="box-body pad">
									<form action="../php/add/add_servicers_installers_php.php" enctype="multipart/form-data" method="post" onsubmit="submit.disabled = true; return true;">
									   

										<!--Name-->
										<div class="form-group col-md-3">
											<label>Name</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-user"></i></span>
												<input type="text" class="form-control" placeholder="Name" style="text-transform:capitalize" id="ui_servicers_installers_name" name="ui_servicers_installers_name" maxlength="100"/>
											</div>
										</div>
										<!--Name-->
														
										<!--Contact Number-->
										<div class="form-group col-md-3">
											<label>Contact Number</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
												<input type="text" class="form-control" placeholder="Ex: 9876543210" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="ui_servicers_installers_contact_number" maxlength="30" name="ui_servicers_installers_contact_number" type="text"/>
											</div>
										</div>
										<!--Contact Number-->

										<!--Contact Number-->
										<div class="form-group col-md-3">
											<label>Contact Number</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
												<input type="text" class="form-control" placeholder="Ex: 9876543210" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="ui_servicers_installers_alternate_contact_number" maxlength="30" name="ui_servicers_installers_alternate_contact_number" type="text"/>
											</div>
										</div>
										<!--Contact Number-->
										
										<!--Email-->
										<div class="form-group col-md-3">
											<label>Email</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
												<input type="email" class="form-control" placeholder="Ex: abc@gmail.com" style="text-transform:lowercase" id="ui_servicers_installers_email"  maxlength="50" name="ui_servicers_installers_email" type="text"/>
											</div>
										</div>
										<!--Email-->
										
										<!--About-->
										<div class="form-group col-md-3">
											<label>About</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-fire"></i></span>
												<input type="text" class="form-control" placeholder="Wallpaper Installation" style="text-transform:capitalize" id="ui_servicers_installers_about" name="ui_servicers_installers_about" maxlength="100"/>
											</div>
										</div>
										<!--About-->
										
										<!--Type-->
										<div class="form-group col-md-3">
										 <label>Type</label>
										  <div class="input-group">
										 <span class="input-group-addon"><i class="fa fa-info"></i></span>
										<select name="ui_servicers_installers_type" id="ui_servicers_installers_type" class='form-control select2' style='width: 100%;'>
											<option> Service </option>
											<option> Installer </option>
											<option> Other </option>
										</select>
										</div>
										</div>
										<!--Type-->
										
										<!--Info-->
										<div class="form-group col-md-6">
											<label>Info</label>
											<textarea class="form-control" rows="4" placeholder="Ex: Wallpaper installation at World Emporium" id="ui_servicers_installers_info" name="ui_servicers_installers_info"></textarea>
										</div>									
										<!--Info-->
										
										<!--Location-->
										<input id="location" name="location" type="hidden" value="<?php echo $user_result['location'];?>"/>
										<!--Location-->
										
										<!-- User ID -->
											<input id="user_id" name="user_id" type="hidden" value="<?php echo $user_result['id'];?>"/>
										<!-- User ID -->											

										
										<!--Save-->
										<div class="col-lg-offset-10 col-lg-2">
											<button type="submit" data-loading-text="Please Wait..." class="btn btn-success form-control" name="submit">Save</button>
										</div>
										<!--Save-->
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
			<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		</div>
		<!-- ./wrapper -->

		<!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";?>
		<!--Including Bootstrap and other scripts-->
	</body>
</html>