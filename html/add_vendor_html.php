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
			
		function fn_vendor_exists()
		{
			if($("#div_vendor_name").hasClass("has-error"))
			{
				alert("Vendor Name Already Exists");				
				return false;
			}
		}			
			
		$(document).ready(function()
		{
		//Handler for .ready() called.
		$("#li_vendor").addClass("active");
		$("#li_add_vendor").addClass("active");			
		});
		</script>
	</head>
	<body class="hold-transition skin-blue fixed sidebar-mini">
		<div class="wrapper">

			<!--Including Topbar-->
			<?php include "../extra/topbar.php";?>
			<!--Including Topbar-->

			<!-- Including Left Nav Bar -->
				<?php include "../extra/left_nav_bar.php";?>
				<!-- Including Left Nav Bar -->

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>Add Vendor 
						<a href="../reports/vendor_report_html.php" class="btn pull-right btn-xs btn-primary">Vendor Report</a>
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
									<form action="../php/add/add_vendor_php.php" method="post" enctype="multipart/form-data" id="add_vendor"  onsubmit="return fn_vendor_exists();">

										<!--Company Name-->
										<div class="form-group col-md-4" id="div_vendor_name">
										 <label>Company Name</label>
										 <div class="input-group">
										 <span class="input-group-addon"><i class="fa fa-user"></i></span>
										 <input type="text" class="form-control" placeholder="Company Name" id="vendor_name" style="text-transform:capitalize" required maxlength="50" name="vendor_name"/>
										</div>
										</div>
										<!--Company Name-->
										
										<span id="name_status"></span>
										
										<!--Contact Person-->
										<div class="form-group col-md-4">
										  <label>Contact Person</label>
										  <input type="text" class="form-control" placeholder="Ex: Vijay" id="contact_person" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode==32' style="text-transform:capitalize" maxlength="50" name="contact_person" type="text"/>
										</div>
										<!--Contact Person-->

										<!--Contact Number-->
										<div class="form-group col-md-4">
										<label>Contact Number</label>
										<div class="input-group">
										 <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
												<input type="text" class="form-control" placeholder="Ex: 9876543210" id="contact_number" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="50" name="contact_number" type="text"/>
										</div>
										</div>
										<!--Contact Number-->

										<!--Alternate Contact Number-->
										<div class="form-group col-md-4">
										<label>Alternate Contact Number</label>
										<div class="input-group">
										 <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
												<input type="text" class="form-control" placeholder="Ex: 9876543210" id="alternate_contact_number" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="50" name="alternate_contact_number" type="text"/>
										</div>
										</div>
										<!--Contact Number-->
										
										<!--Email-->
										<div class="form-group col-md-4">
										  <label>Email</label>
										  <div class="input-group">
											<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
											<input type="email" class="form-control" placeholder="Ex: abc@gmail.com" id="vendor_email"  style="text-transform:lowercase" maxlength="100" name="vendor_email" type="email"/>
										  </div>
										</div>
										<!--Email-->
										
										<!--Alternate Email-->
										<div class="form-group col-md-4">
										  <label>Alternate Email</label>
										  <div class="input-group">
											<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
											<input type="email" class="form-control" placeholder="Ex: def@gmail.com" id="alternate_vendor_email" style="text-transform:lowercase" maxlength="50" name="alternate_vendor_email" type="email"/>
										  </div>
										</div>
										<!--Alternate Email-->
										
										<!--Tin Number-->
										<div class="form-group col-md-4">
										  <label>Tin Number</label>
										  <div class="input-group">
											<span class="input-group-addon"><i class="fa fa-building"></i></span>
											<input type="text" class="form-control" placeholder="Ex: 34201849434" id="vendor_tin_number"  maxlength="50" name="vendor_tin_number" type="text"/>
										  </div>
										</div>
										<!--Tin Number-->
										
										<!--GSTIN Number-->
										<div class="form-group col-md-4">
										 <label>GSTIN Number</label>
										 <div class="input-group">
										 <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
										 <input type="text" style="text-transform: uppercase;" class="form-control" placeholder="GSTIN Number" id="vendor_gstin_number" name="vendor_gstin_number"/>
										</div>
										</div>
										<!--GSTIN Number-->
										
										<!--Website-->
										<div class="form-group col-md-4">
										  <label>Website</label>
										  <div class="input-group">
											<span class="input-group-addon"><i class="fa fa-globe"></i></span>
											<input type="text" class="form-control" placeholder="Ex: www.hafele.com" id="vendor_website" style="text-transform:lowercase" name="vendor_website" type="text"/>
										  </div>
										</div>
										<!--Website-->
										
										<!--Vendor City-->
										<div class="form-group col-md-3">
										  <label>Vendor City</label>
										  <div class="radio">
											<label>
											  <input type="radio" name="vendor_city" id="vendor_city" value="Bangalore" checked/>
											  Bangalore
											</label>
										  </div>
										  <div class="radio">
											<label>
											  <input type="radio" name="vendor_city" id="vendor_city" value="Delhi"/>
											  Delhi
											</label>
										  </div>
										  <div class="radio">
											<label>
											  <input type="radio" name="vendor_city" id="vendor_city" value="Other"/>
											  Other
											</label>
										  </div>
										</div>
										<!--Vendor City-->

																				
										<!--Bank Name-->
										<div class="form-group col-md-4">
										 <label>Bank Name</label>
										 <div class="input-group">
										 <span class="input-group-addon"><i class="fa fa-money"></i></span>
										 <input type="text" class="form-control" placeholder="Bank Name" id="bank_name" name="bank_name"/>
										</div>
										</div>
										<!--Bank Name-->
										
										
										
										<!--Account Number-->
										<div class="form-group col-md-5">
										 <label>Account Number</label>
										 <div class="input-group">
										 <span class="input-group-addon"><i class="fa fa-cc"></i></span>
										 <input type="text" class="form-control" placeholder="Account Number" id="bank_account_number" name="bank_account_number"/>
										</div>
										</div>
										<!--Account Number-->
										
										<!--IFSC Code-->
										<div class="form-group col-md-3">
										 <label>IFSC Code</label>
										 <div class="input-group">
										 <span class="input-group-addon"><i class="fa fa-cc"></i></span>
										 <input type="text" class="form-control" placeholder="IFSC Code" id="bank_ifsc_code" name="bank_ifsc_code"/>
										</div>
										</div>
										<!--IFSC Code-->
										
										 <!--Bank Address-->
										<div class="form-group col-md-3">
										  <label>Bank Address</label>
										  <textarea class="form-control" rows="3" placeholder="Ex: XYZ Bangalore" id="vendor_bank_address" name="vendor_bank_address"></textarea>
										</div>
									   <!--Bank Address-->
									   
									<!--Authentic-->
									<div class="form-group col-md-3">
										<label>Authentic</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-check"></i></span>
											<select name="ui_authenticated" id="ui_authenticated" class='form-control selectpicker' style='width: 100%;'>
												<option value="">Select</option>
												<option value="Data Authentic">Data Authentic</option>
												<option value="Data Unauthentic">Data Unauthentic</option>
											</select>
										</div>
									</div>
									<!--Authentic-->
										
										 <!--Vendor Address-->
										<div class="form-group col-md-4">
										  <label>Vendor Address</label>
										  <textarea class="form-control" rows="6" placeholder="Ex: XYZ Bangalore" id="vendor_address" name="vendor_address"></textarea>
										</div>
									   <!--Vendor Address-->
									   
									    <!--Deals With-->
										<div class="form-group col-md-4">
										  <label>Deals With</label>
										  <textarea class="form-control" rows="6" placeholder="Ex: Hafele" id="vendor_brands_dealing" name="vendor_brands_dealing"></textarea>
										</div>
									   <!--Deals With-->
									  
									   <!--Vendor Additional Info-->
										<div class="form-group col-md-4">
										  <label>Additional Info</label>
										  <textarea class="form-control" rows="6" placeholder="Ex: Bank Account Details" id="vendor_additional_info" name="vendor_additional_info"></textarea>
										</div>
									   <!--Vendor Additional Info-->

									   <!-- User ID -->
										<input id="user_id" name="user_id" type="hidden" value="<?php echo $user_result['id'];?>" />
										<!-- User ID -->										
										
										<!--User Location-->
										<input id="location" name="location" type="hidden" value="<?php echo $user_result['location'];?>" />
										<!--User Location-->

	

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
										</div>
				
										<div class="form-group col-md-12">
											<input type="button" class="btn btn-primary btn-flat" value="Add Contact" onClick="addRow('contacts')" /> 
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
											<button type="submit" data-loading-text="Please Wait..." class="btn btn-success form-control">Save</button>
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
		
			<script>
			
		$('input#vendor_name').bind("change paste keyup input",function() { 
		// handle events here
		checkname();
		});


		function checkname()
		{
		var ui_vendor_name = $("#vendor_name");
		if(ui_vendor_name.val() == "")
		{
			$("#div_value").removeClass("has-error");  
			$("#div_value").removeClass("has-success");
		}
		
			var name=document.getElementById("vendor_name" ).value;

			if(name)
			{
				$.ajax({
					type: 'post',
					url: '../php/check_vendor_name_data.php',
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
	</script>
	</body>
</html>