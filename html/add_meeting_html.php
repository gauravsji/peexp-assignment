<!DOCTYPE html>
<html>
	<!-- Including Login Session -->
	<?php include "../extra/session.php";?>
	<!-- Including Login Session -->
	<head>
		<!-- Including Bootstrap CSS Links -->
		<?php include "../extra/header.html";?>
		<!-- Including Bootstrap CSS Links -->		
	</head>
	<body class="hold-transition skin-blue fixed sidebar-mini">
		<div class="wrapper">

			<!-- Including Top Bar -->
			<?php include "../extra/topbar.php";?>
			<!-- Including Top Bar -->

			<!-- Including Left Nav Bar -->
			<?php include "../extra/left_nav_bar.php";?>
			<!-- Including Left Nav Bar -->

			<!-- Start Of Content Wrapper, Contains Page Content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>New Meeting 
						<a href="../reports/meeting_report_html.php" class="btn pull-right btn-xs btn-primary">Meeting Report</a>
					</h1>
				</section>
				<!-- Content Header (Page header) -->
				
				<!-- Main Content -->
				<section class="content">
					<!-- Start of Row -->
					<div class="row">
						<!-- Start of Define Width of Div -->
						<div class="col-md-12">
							<!-- General Form Elements -->
							<div class="box box-primary">
								<!-- Box Body -->
								<div class="box-body pad">
									<form action="../php/add/add_meeting_php.php" method="post" onsubmit="submit.disabled = true; return true;">
									
										<!--Meeting Date-->
										<div class="form-group col-md-3">
											<label>Meeting Date</label>
												<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" readonly class="form-control pull-right" name="ui_meeting_date" value="<?php echo date("d/m/Y"); ?>" id="ui_meeting_date"/>
											</div>
										</div>
										<!--Meeting Date-->
										
										<!-- Meeting Time -->
										<div class="form-group col-md-3">
											<div class="bootstrap-timepicker">
													<label>Meeting Time</label>
													<div class="input-group">
														<input type="text" name="ui_meeting_time" id="ui_meeting_time" class="form-control timepicker"/>
														<div class="input-group-addon">
															<i class="fa fa-clock-o"></i>
														</div>
												</div>
											</div>
										</div>
										<!-- Meeting Time -->
			  
										<!--Meeting Venue-->
										<div class="form-group col-md-3">
											<label>Meeting Venue</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
												<input type="text" class="form-control" placeholder="Meeting Venue" id="ui_meeting_venue" style="text-transform:capitalize" maxlength="120" name="ui_meeting_venue"/>
											</div>
										</div>
										<!--Meeting Venue-->
										
										<!--Connect Name-->
										<div class="form-group col-md-3">
											<label>Connect Name</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
												<input type="text" class="form-control" placeholder="Connect Name" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode==32' style="text-transform:capitalize" id="ui_connect_name" maxlength="100" name="ui_connect_name"/>
											</div>
										</div>
										<!--Connect Name-->
										
										<!--Contact Number-->
										<div class="form-group col-md-3">
											<label>Contact Number</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
												<input type="text" class="form-control" placeholder="Ex: 9876543210" id="ui_contact_number" maxlength="50" name="ui_contact_number" onkeypress='return event.charCode >= 48 && event.charCode <= 57' type="text"/>
											</div>
										</div>
										<!--Contact Number-->									
										
										<!--Meeting Title-->
										<div class="form-group col-md-3">
											<label>Meeting Title</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-briefcase " aria-hidden="true"></i></span>
												<input type="text" class="form-control" style="text-transform:capitalize" placeholder="Meeting Title" id="ui_meeting_title" maxlength="150" name="ui_meeting_title"/>
											</div>
										</div>
										<!--Meeting Title-->
										
										<!--Meeting With-->
										<div class="form-group col-md-3">
											<label>Meeting With</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-handshake-o"></i></span>
												<select name="ui_meeting_with" id="ui_meeting_with" class='form-control select2' style='width: 100%;'>
													<option selected disabled hidden>Select</option>
													<option>Customer</option>
													<option>Vendor</option>
												</select>
											</div>
										</div>								
										<!--Meeting With-->
										
										<!--Assignee Name-->
										<div class="form-group col-md-3">
											<label>Assignee Name</label>
											<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-user"></i></span>
												<select name="ui_assignee_name" id="ui_assignee_name" class='form-control select2' style='width: 100%;'>
												<option selected disabled hidden>Select Assignee</option>
													<?php
													{
														$sql = "SELECT id, name from users where authenticate<>0  order by name";
														$query = mysqli_query($conn, $sql);
														while($row = mysqli_fetch_array($query))
														{
															if ($row['id'] == $user_result['id']):
															{
															echo "<option value='" . $row['id'] . "' selected>" . $row['name']. "</option>";
															}
															else:
															{
																echo "<option value='" . $row['id'] . "'>" . $row['name']. "</option>";
															}
															endif;
														}
													} 
													?>										
												</select>
											</div>
										</div>
										<!--Assignee Name-->										
								
										<!-- Meeting Details -->
										<div class="form-group col-md-6">
										<label>Agenda</label>
											<textarea id="ui_meeting_agenda" name="ui_meeting_agenda"  rows="5" class="form-control"></textarea>								
										</div>
										<!-- Meeting Details -->
										
										<!-- Meeting Details -->
										<div class="form-group col-md-6">
										<label>Meeting Notes</label>
											<textarea id="ui_meeting_notes" name="ui_meeting_notes" rows="5" class="form-control"></textarea>									
										</div>
										<!-- Meeting Details -->
								
										<!--Meeting Status-->
										<div class="form-group col-md-3">
											<label>Meeting Status</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-star"></i></span>
												<select name="ui_meeting_status" id="ui_meeting_status" class='form-control select2' style='width: 100%;'>
													<option selected>Scheduled</option>
													<option>Postponed</option>
													<option>Cancelled</option>
													<option>Completed</option>
												</select>
											</div>
										</div>								
										<!--Meeting Status-->
											
										<!-- User ID -->
										<input id="user_id" name="user_id" type="hidden" value="<?php echo $user_result['id'];?>" />
										<!-- User ID -->
									
										<!-- Location -->
										<input id="location" name="location" type="hidden" value="<?php echo $user_result['location'];?>" />
										<!-- Location -->
										
										<!-- Save Button -->
										<div class="col-lg-offset-10 col-lg-2">
											<button type="submit" data-loading-text="Please Wait..."  class="btn btn-success form-control">Save</button>
										</div>
										<!-- Save Button -->
									</form>								
								</div>
								<!-- Box Body -->
							</div>
							<!-- General Form Elements -->
						</div>
						<!-- End of Define Width of Div -->
					</div>
					<!-- End of Row -->
				</section>
				<!-- Main Content -->
			</div>
			<!-- End of Content Wrapper, Contains Page Content -->

			<!-- Main Footer -->
			<footer class="main-footer">
				<div class="pull-right hidden-xs">
				</div>				
			</footer>
			<!-- Main Footer -->

			<!--Including right slide panel-->
			<?php include "../extra/aside.php";?>
			<!--Including right slide panel-->
			
			<!-- Add the sidebar's background this div must be placed immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
			<!-- Add the sidebar's background this div must be placed immediately after the control sidebar -->
		</div>
		<!-- End Of Content Wrapper, Contains Page Content -->

		<!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";?>
		<!--Including Bootstrap and other scripts-->
		
		<script>
		$(document).ready(function()
		{
			//Handler for .ready() called.
			$("#li_daily_operations").addClass("active");
			$("#li_add_meeting").addClass("active");
		});

		$(function () 
		{
			//Date picker
			$('#ui_meeting_date').datepicker
			({
				format: 'dd/mm/yyyy',
				autoclose: true
			});
		});

		//Timepicker
		$(".timepicker").timepicker({
		showInputs: false
		});
		</script>
	</body>
</html>