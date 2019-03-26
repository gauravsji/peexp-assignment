<!DOCTYPE html>
<html>
	<!-- Including Login Session -->
	<?php include "../extra/session.php";
	$meeting_id=$_GET["id"];
	$sql = "SELECT * FROM meeting where meeting_id = " . $meeting_id;
	$result = mysqli_query($conn, $sql);
	$meeting_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
	?>
	<!-- Including Login Session -->
	<head>
		<!-- Including Bootstrap CSS Links -->
		<?php include "../extra/header.html";?>
		<!-- Including Bootstrap CSS Links -->
		
		<!-- Including Snackbar Styling -->
		<link rel="stylesheet" type="text/css" href="../css/snackbar.css">
		<!-- Including Snackbar Styling -->
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
					<h1>Edit Meeting</h1>
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
									<form action="../php/update/update_meeting_php.php" method="post" onsubmit="submit.disabled = true; return true;">
									
										<input id="ui_meeting_id" name="ui_meeting_id" type="hidden" value="<?php echo $meeting_result['meeting_id'];  ?>">
										<!--Date-->
										<div class="form-group col-md-3">
											<label>Meeting Date</label>
												<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" readonly class="form-control pull-right" name="ui_meeting_date" value="<?php echo date('d/m/Y', strtotime($meeting_result['meeting_date']));  ?>" id="ui_meeting_date">
											</div>
										</div>
										<!--Date-->
										
										<!-- Meeting Time -->
										<div class="form-group col-md-3">
											<div class="bootstrap-timepicker">
													<label>Meeting Time</label>
													<div class="input-group">
														<input type="text" name="ui_meeting_time" id="ui_meeting_time" value="<?php echo date('h:i A', strtotime($meeting_result['meeting_time']));  ?>" class="form-control timepicker">
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
												<input type="text" class="form-control" placeholder="Meeting Venue" style="text-transform:capitalize" id="ui_meeting_venue" maxlength="60" name="ui_meeting_venue" value="<?php echo $meeting_result['meeting_venue'];  ?>"/>
											</div>
										</div>
										<!--Meeting Venue-->
										
										<!--Connect Name-->
										<div class="form-group col-md-3">
											<label>Connect Name</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
												<input type="text" class="form-control" placeholder="Connect Name" style="text-transform:capitalize" id="ui_connect_name" maxlength="60" name="ui_connect_name" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode==32' value="<?php echo $meeting_result['meeting_connect_name'];  ?>"/>
											</div>
										</div>
										<!--Connect Name-->
										
										<!--Contact Number-->
										<div class="form-group col-md-3">
											<label>Contact Number</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
												<input type="text" class="form-control" placeholder="Ex: 9876543210" id="ui_contact_number" maxlength="50" name="ui_contact_number" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?php echo $meeting_result['meeting_contact_number'];  ?>"/>
											</div>
										</div>
										<!--Contact Number-->									
										
										<!--Meeting Title-->
										<div class="form-group col-md-3">
											<label>Meeting Title</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-briefcase " aria-hidden="true"></i></span>
												<input type="text" class="form-control" placeholder="Meeting Title" style="text-transform:capitalize" id="ui_meeting_title" maxlength="60" name="ui_meeting_title"  value="<?php echo $meeting_result['meeting_title'];  ?>"/>
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
													<?php
													{
														$sql = "SELECT * from meeting where delete_status<>1";
														$query = mysqli_query($conn, $sql);
														while($row = mysqli_fetch_array($query))
														{
															if ($row['meeting_id'] == $meeting_result['meeting_id']):
															{
																if ($meeting_result['meeting_with']=='Customer'):
																{
																	echo '<option value="Customer" selected>Customer</option>';
																	echo '<option value="Vendor">Vendor</option>';
																}
																endif;
															
																if ($meeting_result['enquiry_status']=='Enquiry Close'):
																{
																	echo '<option value="Customer">Customer</option>';
																	echo '<option value="Vendor" selected>Vendor</option>';
																}	
																endif;
															}
															else:
															{
																echo "Error";
															}
															endif;
														}
													}
													?>
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
												if ($row['id'] == $meeting_result['meeting_assignee']):
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
												<textarea id="ui_meeting_agenda" name="ui_meeting_agenda" rows="5" style="text-transform:capitalize" class="form-control" ><?php echo $meeting_result['meeting_agenda'];  ?></textarea>
										
										</div>
										<!-- Meeting Details -->
										
										<!-- Meeting Details -->
										<div class="form-group col-md-6">
										<label>Meeting Notes</label>
												<textarea id="ui_meeting_notes" name="ui_meeting_notes" rows="5" style="text-transform:capitalize" class="form-control" ><?php echo $meeting_result['meeting_notes'];  ?></textarea>									
										</div>
										<!-- Meeting Details -->
								
										<!--Meeting Status-->
										<div class="form-group col-md-3">
											<label>Meeting Status</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-star"></i></span>
												<select name="ui_meeting_status" id="ui_meeting_status" class='form-control select2' style='width: 100%;'>
													<option selected disabled hidden>Select Status</option>
													<?php
													{
														$sql = "SELECT * from meeting where delete_status<>1";
														$query = mysqli_query($conn, $sql);
														while($row = mysqli_fetch_array($query))
														{
															if ($row['meeting_id'] == $meeting_result['meeting_id']):
															{
																if ($meeting_result['meeting_status']=='Scheduled'):
																{
																	echo '<option value="Scheduled" selected>Scheduled</option>';
																	echo '<option value="Postponed">Postponed</option>';
																	echo '<option value="Cancelled">Cancelled</option>';
																	echo '<option value="Completed">Completed</option>';
																}
																endif;
															
																if ($meeting_result['meeting_status']=='Postponed'):
																{
																	echo '<option value="Scheduled">Scheduled</option>';
																	echo '<option value="Postponed" selected>Postponed</option>';
																	echo '<option value="Cancelled">Cancelled</option>';
																	echo '<option value="Completed">Completed</option>';
																}	
																endif;
																
																if ($meeting_result['meeting_status']=='Cancelled'):
																{
																	echo '<option value="Scheduled">Scheduled</option>';
																	echo '<option value="Postponed">Postponed</option>';
																	echo '<option value="Cancelled" selected>Cancelled</option>';
																	echo '<option value="Completed">Completed</option>';
																}	
																endif;
																if ($meeting_result['meeting_status']=='Completed'):
																{
																	echo '<option value="Scheduled">Scheduled</option>';
																	echo '<option value="Postponed">Postponed</option>';
																	echo '<option value="Cancelled">Cancelled</option>';
																	echo '<option value="Completed" selected>Completed</option>';
																}	
																endif;
															}
															else:
															{
																echo "Error";
															}
															endif;
														}
													}
													?>													
												</select>
											</div>
										</div>								
										<!--Meeting Status-->
																					
										<!-- Save Button -->
										<div class="col-lg-offset-10 col-lg-2">
											<button type="submit" data-loading-text="Please Wait..."  class="btn btn-success form-control">Update</button>
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
		$('#ui_meeting_date').datepicker({
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