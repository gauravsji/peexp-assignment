<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";
		$customer_id=$_GET["id"];
		$sql = "SELECT * FROM customer where delete_status<>1 and customer_id = " . $customer_id;
		$result = mysqli_query($conn, $sql);
		$customer_result = mysqli_fetch_array($result,MYSQLI_ASSOC);

		$sql4 = "SELECT * FROM contacts where delete_status<>1 and contact_module_id = " . $customer_id." and contact_module_name='Customer'";
		$contacts_result = mysqli_query($conn, $sql4);

		$subuser_sql = "SELECT * FROM customer where delete_status<>1 and subset =". $customer_id;
		$subuser_result = mysqli_query($conn, $subuser_sql);
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
	$("#li_customer").addClass("active");
	$("#li_add_customer").addClass("active");
	});
	</script>
	<style>

	#subuser_id{
		display: none
	}

	#ui_customer_contact_id{
		dispaly:none
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
				Edit Customer
			<div class="btn-toolbar pull-right">
				<a href="../html/add_customer_html.php" class="btn btn-sm btn-primary">New Customer</a>
					<a href="../reports/customer_report_html.php" class="btn btn-sm btn-success">Customer Report</a>
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
							<!-- general form elements disabled -->

									<div class="box-body">
										<form role="form" action="../php/update/update_customer_php.php" enctype="multipart/form-data" method="post" onsubmit="submit.disabled = true; return true;">

											<input type="hidden" name="customer_id" id="customer_id" value="<?php echo $customer_result['customer_id'];  ?>"/>
											<!--Customer Name-->
											<div class="form-group col-md-6">
												<label>Firm Name</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-user"></i></span>
													<input type="text" class="form-control" placeholder="Customer Name" style="text-transform:capitalize" id="firm_name" name="firm_name" value="<?php echo $customer_result['firm_name'];?>" required/>
												</div>
											</div>

											<div class="form-group col-md-6">
												<label>Customer Name</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-user"></i></span>
													<input type="text" class="form-control" placeholder="Customer Name" style="text-transform:capitalize" id="customer_name" name="customer_name" value="<?php echo $customer_result['customer_name'];?>" required/>
												</div>
											</div>


											<!--Customer Name-->
											<!--Contact Person-->
											<div class="form-group col-md-4">
												<label>Contact Person</label>
												<input type="text" class="form-control" placeholder="Ex: ABC" style="text-transform:capitalize" id="contact_person" maxlength="50" name="contact_person" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode==32' type="text" value="<?php echo $customer_result['customer_contact_person'];  ?>"/>
											</div>
											<!--Contact Person-->

											<!--Contact Number-->
											<div class="form-group col-md-4">
												<label>Contact Number</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
													<input type="text" class="form-control" placeholder="Ex: 9876543210" id="contact_number" maxlength="50" name="contact_number" type="text" value="<?php echo $customer_result['customer_contact_number'];?>" onkeypress='return event.charCode>= 48 && event.charCode <= 57'/>
												</div>
											</div>
											<!--Contact Number-->

											<!--Alternate Contact Number-->
											<div class="form-group col-md-4">
												<label>Alternate Contact Number</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
													<input class="form-control" placeholder="Ex: 27846232342" id="customer_alternate_contact" name="customer_alternate_contact" value="<?php echo $customer_result['customer_alternate_contact_number'];  ?>" type="text" onkeypress='return event.charCode>= 48 && event.charCode <= 57'/>
												</div>
											</div>
											<!--Alternate Contact Number-->

											<!--Email-->
											<div class="form-group col-md-4">
												<label>Email</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
													<input type="email" class="form-control" placeholder="Ex: abc@gmail.com" style="text-transform:lowercase" id="customer_email"  maxlength="100" name="customer_email" type="email" value="<?php echo $customer_result['customer_email'];  ?>">
												</div>
											</div>
											<!--Email-->

											<!--Alternate Email-->
											<div class="form-group col-md-4">
												<label>Alternate Email</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
													<input type="email" class="form-control" placeholder="Ex: abc@gmail.com" style="text-transform:lowercase" id="customer_alternate_email"  maxlength="200" name="customer_alternate_email" type="email" value="<?php echo $customer_result['customer_alternate_email'];  ?>">
												</div>
											</div>
											<!--Alternate Email-->

											<!--GST Number -->
											<div class="form-group col-md-4">
												<label>GST Number</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
													<input type="text" class="form-control" placeholder="29AZXE034SADAA1" style="text-transform:uppercase" id="ui_gst_number"  maxlength="15" name="ui_gst_number" type="text" value="<?php echo $customer_result['gst_number'];  ?>"/>
												</div>
											</div>
											<!--GST Number -->

											<!--Customer City-->
											<div class="form-group col-md-6">
												<label>Customer City</label>
												<div class="radio">
													<label>
													<input type="radio" name="customer_city" id="customer_city" <?php if($customer_result['customer_city']=='Bangalore') {echo "checked";}?> value="Bangalore"/>
													Bangalore
													</label>
												</div>
												<div class="radio">
													<label>
													<input type="radio" name="customer_city" id="customer_city" <?php if($customer_result['customer_city']=='Delhi') {echo "checked";}?> value="Delhi"/>
													Delhi
													</label>
												</div>
												<div class="radio">
													<label>
													<input type="radio" name="customer_city" id="customer_city" <?php if($customer_result['customer_city']=='Other') {echo "checked";}?> value="Other"/>
													Other
													</label>
												</div>
											</div>
											<!--Customer City-->

											<!--Type Of Firm-->
											<div class="form-group col-md-6">
												<label>Type Of Firm</label>
												<div class="radio">
													<label>
													<input type="radio" name="type_of_firm" id="type_of_firm" <?php if($customer_result['customer_type_of_firm']=='Architect') {echo "checked";}?> value="Architect"/>
													Architect
													</label>
												</div>
												<div class="radio">
													<label>
													<input type="radio" name="type_of_firm" id="type_of_firm" <?php if($customer_result['customer_type_of_firm']=='Contractor') {echo "checked";}?> value="Contractor"/>
													Contractor
													</label>
												</div>

												<div class="radio">
													<label>
													<input type="radio" name="type_of_firm" id="type_of_firm" <?php if($customer_result['customer_type_of_firm']=='Individual') {echo "checked";}?> value="Individual"/>
													Individual
													</label>
												</div>
												<div class="radio">
													<label>
													<input type="radio" name="type_of_firm" id="type_of_firm" <?php if($customer_result['customer_type_of_firm']=='Firm/Company') {echo "checked";}?> value="Firm/Company"/>
													Firm/Company
													</label>
												</div>

													<div class="radio">
													<label>
													<input type="radio" name="type_of_firm" id="type_of_firm" <?php if($customer_result['customer_type_of_firm']=='Others') {echo "checked";}?> value="Others"/>
													Others
													</label>
												</div>
											</div>
											<!--Type Of Firm-->


											<!--Customer Address -->
											<div class="form-group col-md-4">
												<label>Customer Address</label>
												<textarea class="form-control" rows="5" placeholder="Ex: XYZ Bangalore" id="customer_address" name="customer_address"><?php echo $customer_result['customer_address'];?></textarea>
											</div>
											<!--Customer Address-->

											<!--Billing Details -->
											<div class="form-group col-md-4">
												<label>Billing Details</label>
												<textarea class="form-control" rows="5" placeholder="Ex: XYZ Bangalore" id="billing_address" name="billing_address"><?php echo $customer_result['billing_address'];?></textarea>
											</div>
											<!--Billing Details-->

											<!--Additional Info-->
											<div class="form-group col-md-4">
												<label>Additional Info</label>
												<textarea class="form-control" rows="5" id="additional_info" name="additional_info" ><?php echo $customer_result['customer_additional_info'];  ?></textarea>
											</div>
											<!--Additional Info-->

											<!-- User ID -->
								<input id="user_id" name="user_id" type="hidden" value="<?php echo $user_result['id'];?>"/>
								<!-- User ID -->


					<div class="form-group col-md-12">
					<fieldset class="row2">
					<center><label>Contacts</label></center>
					<div class="table-responsive">
						<table id="contacts" class="table table-fixed table-condensed table-bordered" border="0" style="overflow: scroll;">
							<tbody>
							<?php while ($contacts_row = mysqli_fetch_array($contacts_result,MYSQLI_ASSOC)) {?>
								<tr>
									<p>
									<td>
										<input type="hidden" name="ui_customer_contact_id[]" value="<?php echo $contacts_row['contact_id'];  ?>" id="ui_customer_contact_id"/>
									</td>
									<td>
										<center><label for="ui_contact_person_name">Person Name</label></center>
										<input type="text" class="form-control" style="text-transform:capitalize" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode==32'  name="ui_contact_person_name[]" value="<?php echo $contacts_row['contact_person_name'];  ?>">
									</td>
									<td>
										<center><label for="ui_contact_number">Contact Number</label></center>
										<input type="text" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="ui_contact_number[]" onkeypress='return event.charCode>= 48 && event.charCode <= 57' value="<?php echo $contacts_row['contact_person_contact_number'];?>">
									</td>
									<td>
										<center><label for="ui_alternate_contact_number">Alternate Contact Number</label></center>
										<input type="text" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="ui_alternate_contact_number[]" onkeypress='return event.charCode>= 48 && event.charCode <= 57' value="<?php echo $contacts_row['contact_person_alternate_contact_number'];  ?>">
									</td>
									<td>
										<center><label for="ui_contact_person_email">Email</label></center>
										<input type="email" class="form-control" style="text-transform:lowercase" name="ui_contact_person_email[]" value="<?php echo $contacts_row['contact_person_email'];  ?>">
									</td>
									<td>
										<center><label for="ui_contact_person_alternate_email">Alternate Email</label></center>
										<input type="email" class="form-control" style="text-transform:lowercase" name="ui_contact_person_alternate_email[]" value="<?php echo $contacts_row['contact_person_alternate_email'];  ?>">
									</td>
									<td>
										<center><label for="contact_delete">Action</label></center>
										<input type='button' name="contact_delete" class="form-control btn btn-danger btn-flat" value="Remove" onClick="deletethisrow('contacts',this)">
									</td>
									</p>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>


				<div class="form-group col-md-12">
					<input type="button" class="btn btn-primary btn-flat" value="Add Contact" onClick="EditaddRow('contacts')" />
				</div>

				<div class="form-group col-md-12">
					<fieldset class="row2">
					<center><label>SUBUSER</label></center>
					<div class="table-responsive">
						<table id="subuser" class="table table-fixed table-condensed table-bordered" border="0" style="overflow: scroll;">
							<tbody>
							<?php while ($subuser_row = mysqli_fetch_array($subuser_result,MYSQLI_ASSOC)) {?>
								<tr>
									<p>
									<td>
										<input type="hidden" name="subuser_id[]" id="subuser_id" value="<?php echo $subuser_row['customer_id'];  ?>" style="display:none"/>
									</td>
									<td>
										<center><label for="ui_contact_person_name">User Name</label></center>
										<input type="text" class="form-control" style="text-transform:capitalize" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode==32' name="subuser_name[]" value="<?php echo $subuser_row['customer_name'];  ?>" />
									</td>
									<td>
										<center><label for="subuser_contact_number">Contact Number</label></center>
										<input type="text" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="subuser_contact_number[]" value="<?php echo $subuser_row['customer_contact_number'];?>"/>
									</td>
									<td>
										<center><label for="subuser_email">Email</label></center>
										<input type="email" class="form-control" style="text-transform:lowercase" name="subuser_email[]" value="<?php echo $subuser_row['customer_email'];?>"/>
									</td>
									<td>
									<center><label for="subuser_role">Role</label></center>
									<Select id="subuser_role[]" name="subuser_role[]" class="form-control">
										<option value="subuser_admin" <?php if($subuser_row['role'] == 'user_admin'){echo 'Selected';}?> >Admin</option>
										<option value="subuser_user" <?php if($subuser_row['role'] == 'user_user'){echo 'Selected';}?> >User</option>
									</Select>
									</td>
									<td>
										<center><label for="subuser_status">Status</label></center>
										<Select id="subuser_status[]" name="subuser_status[]" class="form-control">
											<option value="subuser_active" <?php if($subuser_row['subuser_status'] == 'active'){echo 'Selected';}?> >Active</option><option value="subuser_inactive" <?php if($subuser_row['subuser_status'] == 'inactive'){echo 'Selected';}?>>Inactive</option>
										</Select>
									</td>
									<td>
										<center><label for="subuser_delete">Action</label></center>
										<input type='button' name="subuser_delete" class="form-control btn btn-danger btn-flat" value="Remove" onClick="deletethisrow('subuser',this)">
									</td>
									</p>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="form-group col-md-12">
					<input type="button" class="btn btn-primary btn-flat" value="Add Sub User" onClick="EditaddRow('subuser')" />
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
								<!-- File Upload -->

											<div class="col-lg-offset-10 col-lg-2">
												<button type="submit" data-loading-text="Please Wait..." class="btn btn-success form-control">Update  </button>
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

			<!--Including right slide panel-->
			<?php include "../extra/aside.php";?>
			<!--Including right slide panel-->

			<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		</div>
		<!-- Wrapper -->

		<!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";?>
		<!--Including Bootstrap and other scripts-->
	</body>
</html>
