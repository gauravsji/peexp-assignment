<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";?>
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

		<!--Including Left Nav Bar-->
		<?php include "../extra/left_nav_bar.php";?>
		<!--Including Left Nav Bar-->
			
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>Add Sales Lead 
					<a href="../reports/sales_lead_report_html.php" class="btn pull-right btn-xs btn-primary">Sales Lead Report</a>
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
							<!-- general form elements disabled -->
								
									<div class="box-body">
										<form role="form" action="../php/add/add_sales_lead_php.php" method="post"  onsubmit="return fn_sales_lead_exists();">
											<!--Lead Name-->
											<div class="form-group col-md-4" id="div_sales_lead_name">
												<label>Lead Name</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-user"></i></span>
													<input type="text" class="form-control" placeholder="Lead Name" id="sales_lead_name" style="text-transform:capitalize" name="sales_lead_name" required onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode==32'/>
												</div>
											</div>
											<!--Lead Name-->
											
											<span id="name_status"></span>
											
											<!--Contact Number-->
											<div class="form-group col-md-4">
												<label>Contact Number</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
													<input type="text" class="form-control" placeholder="Ex: 9876543210" id="sales_lead_contact_number" maxlength="50" name="sales_lead_contact_number" onkeypress='return event.charCode >= 48 && event.charCode <= 57' type="text"/>
												</div>
											</div>
											<!--Contact Number-->
											
											<!--Email-->
											<div class="form-group col-md-4">
												<label>Email</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
													<input type="email" class="form-control" placeholder="Ex: abc@gmail.com" id="sales_lead_email" style="text-transform:lowercase" maxlength="100" name="sales_lead_email" type="text">
												</div>
											</div>
											<!--Email-->
											
											<!--Sales Lead City-->
											<div class="form-group col-md-4">
												<label>City</label>
												<div class="radio">
													<label>
													<input type="radio" name="sales_lead_city" id="sales_lead_city" value="Bangalore" checked/>
													Bangalore
													</label>
												</div>
												<div class="radio">
													<label>
													<input type="radio" name="sales_lead_city" id="sales_lead_city" value="Delhi"/>
													Delhi
													</label>
												</div>
												<div class="radio">
													<label>
													<input type="radio" name="sales_lead_city" id="sales_lead_city" value="Other"/>
													Other
													</label>
												</div>
											</div>
											<!--Sales Lead City-->										
											
											<!--Firm Name-->
											<div class="form-group col-md-4">
												<label>Firm Name</label>
												<input type="text" class="form-control" placeholder="Ex: ABC" id="sales_lead_firm_name" style="text-transform:capitalize" maxlength="50" name="sales_lead_firm_name" type="text"/>
											</div>
											<!--Firm Name-->
											
											<!--Sales Lead Reference-->
											<div class="form-group col-md-4">
												<label>Sales Lead Reference</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-user"></i></span>
													<input class="form-control" placeholder="Ex: Referenced by Ravi" id="sales_lead_reference" style="text-transform:capitalize" name="sales_lead_reference" type="text" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode==32'/>
												</div>
											</div>
											<!--Sales Lead Reference-->
											
											<!--Sales Lead Address -->
											<div class="form-group col-md-4">
												<label>Address</label>
												<textarea class="form-control" rows="3" placeholder="" id="sales_lead_address"  name="sales_lead_address"></textarea>
											</div>
											<!--Sales Lead Address-->
											
											<!--Additional Info-->
											<div class="form-group col-md-4">
												<label>Additional Info</label>
												<textarea class="form-control" rows="3" id="sales_lead_additional_info" name="sales_lead_additional_info" ></textarea>
											</div>
											<!--Additional Info-->
											
											<!--Status-->
											<div class="form-group col-md-3">
												<label>Status</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-star"></i></span>
													<select name="ui_sales_lead_status" id="ui_sales_lead_status" class='form-control select2' style='width: 100%;'>
														<option selected>Telephonic Conversation</option>
														<option>Email Conversation</option>
														<option>Meeting Scheduled</option>
														<option>Converted To Customer</option>
														<option>Follow Up</option>
														<option>Rejected</option>
													</select>
												</div>
											</div>								
											<!--Status-->
									
											<!-- User ID -->
											<input id="user_id" name="user_id" type="hidden" value="<?php echo $user_result['id'];?>" />
											<!-- User ID -->
											
											<input id="location" name="location" type="hidden" value="<?php echo $user_result['location'];?>" />

											<div class="col-lg-offset-10 col-lg-2">
												<button type="submit" data-loading-text="Please Wait..." class="btn btn-success form-control">Save  </button>
											</div>
										</form>
									</div>
								<!-- /.box-body -->
							
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

			<!-- Add the sidebar's background. This div must be placed
			immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		</div>
		<!-- Wrapper -->

		<!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";?>
		<!--Including Bootstrap and other scripts-->
		
		<script>
		$(document).ready(function()
		{
			// Handler for .ready() called.
			$("#li_enquiry").addClass("active");
			$("#li_add_sales_lead").addClass("active");
		});
		
		$('input#sales_lead_name').bind("change paste keyup input",function() 
		{ 
		// handle events here
		checkname();
		});


		function checkname()
		{
		var ui_vendor_name = $("#sales_lead_name");
		if(ui_vendor_name.val() == "")
		{
			$("#div_sales_lead_name").removeClass("has-error");  
			$("#div_sales_lead_name").removeClass("has-success");
		}
		
			var name=document.getElementById("sales_lead_name" ).value;

			if(name)
			{
				$.ajax({
					type: 'post',
					url: '../php/check_sales_lead_name_data.php',
					data: 
					{
					user_name:name,
					},
					success: function (response) 
					{
						$( '#name_status' ).html(response);
						if(response=="OK")	
						{
							return true;	
						}
						else
						{
							return false;	
						}
					}
				});
			}
			else
			{
				$( '#name_status' ).html("");
				return false;
			}
		}
		
		function fn_sales_lead_exists()
		{
			if($("#div_sales_lead_name").hasClass("has-error"))
			{
				alert("Sales Lead Name Already Exists");				
				return false;
			}
		}
		
		</script>		
	</body>
</html>