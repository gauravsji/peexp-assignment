<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";?>
	<!--Including Login Session-->

	<head>
		<!--Including Bootstrap CSS links-->
		<?php include "../extra/header.html";?>
		<!--Including Bootstrap CSS links-->

		<script>
			$(document).ready(function()
			{
				// Handler for .ready() called.
				$("#li_transport").addClass("active");
				$("#li_add_transport_team").addClass("active");
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
			
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>Transport Team  <a href="../reports/transport_team_report_html.php" class="btn btn-xs pull-right btn-primary">Transport Team Report</a></h1>
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
									<form action="../php/add/add_transport_team_php.php" method="post"  onsubmit="submit.disabled = true; return true;">
									   
											<!--Transport Person Name-->
											<div class="form-group col-md-3">
												<label>Transport Person Name</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-user"></i></span>
													<input type="text" required class="form-control" placeholder="Ex: Krishna" id="ui_transport_person_name" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode==32' name="ui_transport_person_name" maxlength="70"/>
												</div>
											</div>
											<!--Transport Person Name-->

											<!--Contact Number-->
											<div class="form-group col-md-3">
												<label>Contact Number</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
													<input type="text" required class="form-control" maxlength="14" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Ex: 9838392929" id="ui_transport_contact_number" name="ui_transport_contact_number"/>
												</div>
											</div>
											<!--Contact Number-->

											<!--Alternate Contact Number-->
											<div class="form-group col-md-3">
												<label>Alternate Contact Number</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
													<input type="text" class="form-control" maxlength="14" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Ex: 9823232929" id="ui_transport_alternate_contact_number" name="ui_transport_alternate_contact_number"/>
												</div>
											</div>
											<!--Alternate Contact Number-->

											<!--Company Name-->
											<div class="form-group col-md-3">
												<label>Company Name</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-building"></i></span>
													<input type="text" class="form-control" placeholder="Company Name" id="ui_company_name" name="ui_company_name" maxlength="70"/>
												</div>
											</div>
											<!--Company Name-->

											<!--Transport Vehicle Name-->
											<div class="form-group col-md-3">
												<label>Transport Vehicle Name</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-user"></i></span>
													<input type="text" class="form-control" placeholder="Ex: Tata Ace" id="ui_transport_vehicle_name" name="ui_transport_vehicle_name" maxlength="70"/>
												</div>
											</div>
											<!--Transport Vehicle Name-->

											<!--Vehicle Number-->
											<div class="form-group col-md-3">
												<label>Vehicle Number</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-motorcycle"></i></span>
													<input type="text" class="form-control" placeholder="Ex: KA 20 EK 1096" id="ui_vehicle_number" name="ui_vehicle_number"  style="text-transform:uppercase" maxlength="70"/>
												</div>
											</div>
											<!--Vehicle Number-->

											<!--Load Capacity-->
											<div class="form-group col-md-3">
												<label>Load Capacity</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
													<input type="text" class="form-control" placeholder="2 Ton" id="ui_load_capacity" name="ui_load_capacity" maxlength="70"/>
												</div>
											</div>
											<!--Load Capacity-->

											<!--Vehicle Type-->
											<div class="form-group col-md-3">
												<label>Vehicle Type</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-truck"></i></span>
													<select name="ui_vehicle_type" id="ui_vehicle_type" class='form-control selectpicker' style='width: 100%;'>
														<option value="Carrier Auto">Carrier Auto</option>
														<option value="Bike">Bike</option>
														<option value="Passenger Auto">Passenger Auto</option>
														<option value="Heavy Carrier">Heavy Carrier</option>
													</select>
												</div>
											</div>
											<!--Vehicle Type-->
											
											<!--Email-->
											<div class="form-group col-md-6">
												<label>Email</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
													<input type="email" class="form-control" placeholder="Ex: abc@gmail.com" id="transport_team_email"  maxlength="100" name="transport_team_email" type="text"  style="text-transform:lowercase">
												</div>
											</div>
											<!--Email-->

											<!--Additional Info-->
											<div class="form-group col-md-6">
												<label>Additional Info</label>
												<textarea class="form-control" rows="4" id="transport_team_additional_info" name="transport_team_additional_info"></textarea>
											</div>
											<!--Additional Info-->
												
											<!--User Location-->
											<input id="location" name="location" type="hidden" value="<?php echo $user_result['location'];?>"/>
											<!--User Location-->
																		
											<div class="col-lg-offset-10 col-lg-2">
												<button type="submit" data-loading-text="Please Wait..." class="btn btn-success form-control">Save  </button>
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
</html>