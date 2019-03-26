<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";?>
	<!--Including Login Session-->

	<head>
		<!--Including Bootstrap CSS links-->
		<?php include "../extra/header.html";
		include '../dbconnect/dbconnect.php';?>
	<!--<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/2.0.0-beta1/css/bootstrap-select.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/2.0.0-beta1/js/bootstrap-select.js"></script>-->
	<link rel="stylesheet "type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
		<!--Including Bootstrap CSS links-->
		<style>
			.setrow{
				padding-left: 15px;
				padding-right: 15px;
			}
			.hidinput{
				width: 100%;
			}
			.display_none{
				display: none;
			}
			.bootstrap-select .dropdown-toggle .filter-option {
				overflow: hidden;
			}
			select.selectpicker {
			    display: none!important;
			}
		</style>
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
				<h1>
					Add Customer
					<a href="../reports/customer_report_html.php" class="btn pull-right btn-primary btn-xs">Customer Report</a>
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
										<form role="form" action="../php/add/add_customer_php.php" method="post" enctype="multipart/form-data" onsubmit="return fn_customer_exists();">

					                    <div class="custcontainer">
					                    	<div class="form-group col-md-4" id="div_customer_name">
												<label>Firm Name</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-user"></i></span>
													<input type="text" class="form-control" style="text-transform:capitalize" placeholder="Firm Name" id="firm_name" name="firm_name" required maxlength="100"/>
												</div>
											</div>
											<div class="form-group col-md-4" id="div_customer_name">
												<label>Customer Name</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-user"></i></span>
													<input type="text" class="form-control" style="text-transform:capitalize" placeholder="Customer Name" id="customer_name" name="customer_name" required maxlength="100"/>
												</div>
											</div>
											<!--Customer Name-->
											<span id="name_status"></span>
											<!--Customer City-->
											<!--Contact Person-->
											<div class="form-group col-md-4">
												<label>Contact Person</label>
												<input type="text" class="form-control" placeholder="Ex: ABC" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode==32' id="contact_person" style="text-transform:capitalize" maxlength="100" name="contact_person" type="text"/>
											</div>
											<!--Contact Person-->

											<!--Contact Number-->
											<div class="form-group col-md-4">
												<label>Contact Number</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
													<input type="text" class="form-control" placeholder="Ex: 9876543210" onkeypress='return event.charCode>= 48 && event.charCode <= 57' id="contact_number" maxlength="50" name="contact_number" type="text"/>
												</div>
											</div>
											<!--Contact Number-->

											<!--Alternate Contact Number-->
											<div class="form-group col-md-4">
												<label>Alternate Contact Number</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
													<input class="form-control" placeholder="Ex: 9348124643" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="customer_alternate_contact" name="customer_alternate_contact" type="text" maxlength="50"/>
												</div>
											</div>
											<!--Alternate Contact Number-->

											<!--Email-->
											<div class="form-group col-md-4">
												<label>Email</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
													<input type="email" class="form-control" placeholder="Ex: abc@gmail.com" style="text-transform:lowercase" id="customer_email"  maxlength="100" name="customer_email" type="text"/>
												</div>
											</div>
											<!--Email-->

											<!--Alternate Email-->
											<div class="form-group col-md-4">
												<label>Alternate Email</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
													<input type="email" class="form-control" placeholder="Ex: abc@gmail.com" style="text-transform:lowercase" id="customer_alternate_email"  maxlength="200" name="customer_alternate_email" type="text"/>
												</div>
											</div>
											<!-- Alternate Email-->

											<!--GST Number -->
											<div class="form-group col-md-4">
												<label>GST Number</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
													<input type="text" class="form-control" placeholder="29AZXE034SADAA1" style="text-transform:uppercase" id="ui_gst_number"  maxlength="15" name="ui_gst_number" type="text"/>
												</div>
											</div>
											<!--GST Number -->


											<!--Customer Address -->
											<div class="form-group col-md-4">
												<label>Customer Address</label>
												<textarea class="form-control" s="row5" placeholder="Ex: XYZ Bangalore" id="customer_address" name="customer_address"></textarea>
											</div>
											<!--Customer Address-->

											<!--Billing Address-->
											<div class="form-group col-md-4">
												<label>Billing Details</label>
												<textarea class="form-control" rows="5" id="billing_address" name="billing_address" ></textarea>
											</div>
											<!--Billing Address-->

											<!--Additional Info-->
											<div class="form-group col-md-4">
												<label>Additional Info</label>
												<textarea class="form-control" rows="5" id="additional_info" name="additional_info" ></textarea>
											</div>
											<!--Additional Info-->
											<div class="form-group col-md-2">
												<label>Customer City</label>
												<div class="radio">
													<label>
													<input type="radio" name="customer_city" id="customer_city" value="Bangalore" checked/>
													Bangalore
													</label>
												</div>
												<div class="radio">
													<label>
													<input type="radio" name="customer_city" id="customer_city" value="Delhi"/>
													Delhi
													</label>
												</div>
												<div class="radio">
													<label>
													<input type="radio" name="customer_city" id="customer_city" value="Other"/>
													Other
													</label>
												</div>
											</div>
											<!--Customer City-->

											<!--Type Of Firm-->
											<div class="form-group col-md-2">
												<label>Type Of Firm</label>
												<div class="radio">
													<label>
													<input type="radio" name="type_of_firm" required id="type_of_firm" value="Architect"/>
													Architect
													</label>
												</div>
												<div class="radio">
													<label>
													<input type="radio" name="type_of_firm" required id="type_of_firm" value="Contractor"/>
													Contractor
													</label>
												</div>
												<div class="radio">
													<label>
													<input type="radio" name="type_of_firm" required id="type_of_firm" value="Individual"/>
													Individual
													</label>
												</div>
												<div class="radio">
													<label>
													<input type="radio" name="type_of_firm" required id="type_of_firm" value="Firm/Company"/>
													Firm/Company
													</label>
												</div>
												<div class="radio">
													<label>
													<input type="radio" name="type_of_firm" required id="type_of_firm" value="Others"/>
													Others
													</label>
												</div>
											</div>
											<!--Type Of Firm-->



											<div class="form-group col-md-12">
											<fieldset class="row2">
											<center><label>Contacts</label></center>
											<div class="table-responsive">
												<table id="contacts" class="table table-fixed table-condensed table-bordered" border="0" style="overflow: scroll;">
													<tbody>
														<tr>
															<p>
															<td>
																<center><label for="ui_contact_person_name">Person Name</label></center>
																<input type="text" class="form-control" style="text-transform:capitalize" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode==32' name="ui_contact_person_name[]"/>
															</td>
															<td>
																<center><label for="ui_contact_number">Contact Number</label></center>
																<input type="text" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="ui_contact_number[]"/>
															</td>
															<td>
																<center><label for="ui_alternate_contact_number">Alternate Contact Number</label></center>
																<input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control"  name="ui_alternate_contact_number[]"/>
															</td>
															<td>
																<center><label for="ui_contact_person_email">Email</label></center>
																<input type="email" class="form-control" style="text-transform:lowercase" name="ui_contact_person_email[]"/>
															</td>
															<td>
																<center><label for="ui_contact_person_alternate_email">Alternate Email</label></center>
																<input type="email" class="form-control" style="text-transform:lowercase" name="ui_contact_person_alternate_email[]"/>
															</td>
															<td>
																<center><label for="contact_delete">Action</label></center>
																<input type='button' name="contact_delete" class="form-control btn btn-danger btn-flat" value="Remove" onClick="deletethisrow('contacts',this)">
															</td>
															</p>
														</tr>
													</tbody>
												</table>
											</div>
											</fieldset>
										</div>

										<div class="form-group col-md-12">
											<input type="button" class="btn btn-primary btn-flat" value="Add Contact" onClick="addRow('contacts')" />
										</div>

										<div class="col-md-12 form-group">
											<fieldset class="row2">
											<center><label>Category</label></center>
											<div class="table-responsive">
												<table id="category" class="table table-fixed table-condensed table-bordered" border="0" style="overflow: scroll;">
													<tbody>
														<tr>
															<p>
															<td>
																<center><label for="cate_name">Name</label></center>
																<input type="text" class="form-control" style="text-transform:capitalize" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode==32' name="cate_name[]"/>
															</td>
															<td>
																<center><label for="cate_description">Descriptions</label></center>
																<input type="text" class="form-control" name="cate_description[]"/>
															</td>
															<td>
																<center><label for="contact_delete">Action</label></center>
																<input type='button' name="contact_delete" class="form-control btn btn-danger btn-flat" value="Remove" onClick="deletethisrow('category',this)">
															</td>
															</p>
														</tr>
													</tbody>
												</table>
											</div>
											</fieldset>
										</div>
								<div class="form-group col-md-12">
									<input type="button" class="btn btn-primary btn-flat" value="Add Category" onClick="addRow('category')" />
								</div>

								<div class="form-group col-md-12">
											<fieldset class="row2">
											<center><label>Sub User</label></center>
											<div class="table-responsive">
												<table id="subuser" class="table table-fixed table-condensed table-bordered" border="0" style="overflow: scroll;">
													<tbody>
														<tr>
															<p>
															<td>
																<center><label for="ui_contact_person_name">User Name</label></center>
																<input type="text" class="form-control" style="text-transform:capitalize" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode==32' name="subuser_name[]"/>
															</td>
															<td>
																<center><label for="subuser_contact_number">Contact Number</label></center>
																<input type="text" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="subuser_contact_number[]"/>
															</td>
															<td>
																<center><label for="subuser_email">Email</label></center>
																<input type="email" class="form-control" style="text-transform:lowercase" name="subuser_email[]"/>
															</td>
															<td>
																<center><label for="subuser_role">Role</label></center>
																<Select id="subuser_role[]" name="subuser_role[]" class="form-control">
																<option value="user_admin">Admin</option><option value="user_user">User</option>
																</Select>
															</td>
															<td>
																<center><label for="subuser_status">Status</label></center>
																<Select id="subuser_status[]" name="subuser_status[]" class="form-control">
																<option value="active">Active</option><option value="inactive">Inactive</option>
																</Select>
															</td>
															<td>
																<center><label for="subuser_delete">Action</label></center>
																<input type='button' name="subuser_delete" class="form-control btn btn-danger btn-flat" value="Remove" onClick="deletethisrow('subuser',this)">
															</td>
															</p>
														</tr>
													</tbody>
												</table>
											</div>
											</fieldset>
										</div>

										<div class="form-group col-md-12">
											<input type="button" class="btn btn-primary btn-flat" value="Add Sub User" onClick="addRow('subuser')" />
										</div>
								<!-- File Upload -->
								<div class="form-group col-md-12">
									<div id="maindiv">
									<div id="formdiv">
										<h4>Attachments</h4>
										Files types allowed: JPEG, PNG, JPG, PDF, DOC, DOCX, XLS, XLSX, Max Size: 1.5 MB.
										<hr/>
										<div id="filediv" align="center" style="display:block"><input name="file[]" type="file" id="file"/></div><br/>
										<input type="button" id="add_more" class="upload" value="Add More Files"/>
									</div>
								</div>
								</div>
								<!-- User ID -->
										<input id="user_id" name="user_id" type="hidden" value="<?php echo $user_result['id'];?>" />
										<!-- User ID -->

										<!--Location-->
										<input id="location" name="location" type="hidden" value="<?php echo $user_result['location'];?>" />
										<!--Location-->
								<!--Save-->
										<div class="col-lg-offset-10 col-lg-2">
											<button type="submit" data-loading-text="Please Wait..." class="btn btn-success form-control">Save  </button>
										</div>
										<!--Save-->
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
				<div class="pull-right hidden-xs"></div>
			</footer>
			<!-- Main Footer -->

			<!--Including right slide panel-->
			<?php include "../extra/aside.php";?>
			<!--Including right slide panel-->

			<!-- Add the sidebar's background. This div must be placed	immediately after the control sidebar -->
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
			$("#li_customer").addClass("active");
			$("#li_add_customers").addClass("active");

		});

		$('input#customer_name').bind("change paste keyup input",function()
{
		// handle events here
		checkname();
		});


		function checkname()
		{
		var ui_vendor_name = $("#customer_name");
		if(ui_vendor_name.val() == "")
		{
			$("#div_customer_name").removeClass("has-error");
			$("#div_customer_name").removeClass("has-success");
		}

			var name=document.getElementById("customer_name" ).value;

			if(name)
			{
				$.ajax({
					type: 'post',
					url: '../php/check_customer_name_data.php',
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

		function fn_customer_exists()
		{
			if($("#div_customer_name").hasClass("has-error"))
			{
				alert("Customer Name Already Exists");
				return false;
			}
		}
	</script>
	</body>
</html>

