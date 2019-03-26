<!DOCTYPE html>
<html>
<!--Including Login Session-->
<?php include "../extra/session.php";
	$vendor_id=$_GET["id"];
	$sql = "SELECT * FROM vendor where vendor_id = " . $vendor_id;
	$result = mysqli_query($conn, $sql);
	$vendor_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
	
	$sql4 = "SELECT * FROM vendor_brand where delete_status<>1 and vendor_id = " . $vendor_id;
	$vendor_brand_result = mysqli_query($conn, $sql4);
	
	$sql5 = "SELECT * FROM vendor_product where delete_status<>1 and vendor_id = " . $vendor_id;
	$vendor_product_result = mysqli_query($conn, $sql5);
	
	$sql6 = "SELECT * FROM contacts where delete_status<>1 and contact_module_id = " . $vendor_id." and contact_module_name='Vendor'";
	$contacts_result = mysqli_query($conn, $sql6);
	
	?>
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

       	<!-- Left Side Panel Which Contains Navigation Menu -->
		<?php include "../extra/left_nav_bar.php";?>
		<!-- Left Side Panel Which Contains Navigation Menu -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>Edit Vendor  <div class="btn-toolbar pull-right">
					<a href="../html/add_vendor_html.php" class="btn btn-sm btn-primary">New Vendor</a>  
					<a href="../reports/vendor_report_html.php" class="btn btn-sm btn-success">Vendor Report</a>
					</div>   </h1>
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
                                <form action="../php/update/update_vendor_php.php" enctype="multipart/form-data" method="post" onsubmit="submit.disabled = true; return true;">

								 <input type="hidden" id="vendor_id"  name="vendor_id" value="<?php echo $vendor_result['vendor_id'];  ?>"/>
								 
									<!--Vendor Name-->
									<div class="form-group col-md-4">
									 <label>Vendor Name</label>
									  <div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-user"></i></span>
									  <input type="text" class="form-control" placeholder="Vendor Name" id="vendor_name" style="text-transform:capitalize" required maxlength="50" name="vendor_name" value="<?php echo $vendor_result['vendor_name'];  ?>"/>
									</div>
									</div>
									<!--Vendor Name-->

									
									<!--Contact Person-->
									<div class="form-group col-md-4">
									  <label>Contact Person</label>
									  <input type="text" class="form-control" placeholder="Ex: Vijay" id="contact_person" maxlength="50" style="text-transform:capitalize" name="contact_person" type="text" value="<?php echo $vendor_result['vendor_contact_person'];  ?>" />
									</div>
									<!--Contact Person-->

									<!--Contact Number-->
									<div class="form-group col-md-4">
									<label>Contact Number</label>
									<div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
											<input type="text" class="form-control" placeholder="Ex: 9876543210" id="contact_number"  maxlength="50" name="contact_number" type="text"value="<?php echo $vendor_result['vendor_contact_number'];  ?>" />
									</div>
									</div>
									<!--Contact Number-->

									<!--Alternate Contact Number-->
									<div class="form-group col-md-4">
									<label>Alternate Contact Number</label>
									<div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
											<input type="text" class="form-control" placeholder="Ex: 9876543210" id="alternate_contact_number"  maxlength="50" name="alternate_contact_number" type="text" value="<?php echo $vendor_result['vendor_alternate_contact_number'];  ?>"  />
									</div>
									</div>
									<!--Contact Number-->
									
									<!--Email-->
									<div class="form-group col-md-4">
									  <label>Email</label>
									  <div class="input-group">
										<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
										<input type="email" class="form-control" placeholder="Ex: abc@gmail.com" id="vendor_email"  style="text-transform:lowercase" maxlength="50" name="vendor_email" type="text" value="<?php echo $vendor_result['vendor_email'];  ?>" >
									  </div>
									</div>
									<!--Email-->
									
									<!--Alternate Email-->
									<div class="form-group col-md-4">
									  <label>Alternate Email</label>
									  <div class="input-group">
										<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
										<input type="email" class="form-control" placeholder="Ex: def@gmail.com" id="alternate_vendor_email" style="text-transform:lowercase" maxlength="50" name="alternate_vendor_email" type="text" value="<?php echo $vendor_result['vendor_alternate_email'];  ?>" >
									  </div>
									</div>
									<!--Alternate Email-->
									
									<!--Tin Number-->
									<div class="form-group col-md-4">
									  <label>Tin Number</label>
									  <div class="input-group">
										<span class="input-group-addon"><i class="fa fa-building"></i></span>
										<input type="text" class="form-control" placeholder="Ex: 34201849434" id="vendor_tin_number"  maxlength="30" name="vendor_tin_number" type="text"  value="<?php echo $vendor_result['vendor_tin_number'];  ?>" >
									  </div>
									</div>
									<!--Tin Number-->
									
									<!--GSTIN Number-->
									<div class="form-group col-md-4">
									<label>GSTIN Number</label>
									<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
									<input type="text" class="form-control" placeholder="GSTIN Number" id="vendor_gstin_number" style="text-transform: uppercase;" value="<?php echo $vendor_result['vendor_gstin_number'];  ?>" name="vendor_gstin_number"/>
									</div>
									</div>
									<!--GSTIN Number-->									
										
									<!--Website-->
									<div class="form-group col-md-4">
									  <label>Website</label>
									  <div class="input-group">
										<span class="input-group-addon"><i class="fa fa-globe"></i></span>
										<input type="text" class="form-control" placeholder="Ex: www.hafele.com" id="vendor_website" style="text-transform:lowercase" name="vendor_website" type="text" value="<?php echo $vendor_result['vendor_website'];  ?>"  >
									  </div>
									</div>
									<!--Website-->
									
									<!--Vendor City-->
									<div class="form-group col-md-3">
									  <label>Vendor City</label>
									  <div class="radio">
										<label>
										  <input type="radio" name="vendor_city" id="vendor_city" value="Bangalore" <?php if($vendor_result['vendor_city']=="Bangalore"){echo "checked ";}?> />
										  Bangalore
										</label>
									  </div>
									  <div class="radio">
										<label>
										  <input type="radio" name="vendor_city" id="vendor_city" value="Delhi"  <?php if($vendor_result['vendor_city']=="Delhi"){echo "checked ";}?>/>
										  Delhi
										</label>
									  </div>
									  <div class="radio">
										<label>
										  <input type="radio" name="vendor_city" id="vendor_city" value="Other" <?php if($vendor_result['vendor_city']=="Other"){echo "checked ";}?>/>
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
										 <input type="text" class="form-control" placeholder="Bank Name" id="bank_name" name="bank_name" value="<?php echo $vendor_result['vendor_bank_name'];  ?>" />
										</div>
										</div>
										<!--Bank Name-->
										
										<!--Account Number-->
										<div class="form-group col-md-5">
										 <label>Account Number</label>
										 <div class="input-group">
										 <span class="input-group-addon"><i class="fa fa-cc"></i></span>
										 <input type="text" class="form-control" placeholder="Account Number" id="bank_account_number" name="bank_account_number" value="<?php echo $vendor_result['vendor_bank_account_number'];  ?>"/>
										</div>
										</div>
										<!--Account Number-->
										
										<!--IFSC Code-->
										<div class="form-group col-md-3">
										 <label>IFSC Code</label>
										 <div class="input-group">
										 <span class="input-group-addon"><i class="fa fa-cc"></i></span>
										 <input type="text" class="form-control" placeholder="IFSC Code" id="bank_ifsc_code" name="bank_ifsc_code" value="<?php echo $vendor_result['vendor_ifsc_code'];  ?>"/>
										</div>
										</div>
										<!--IFSC Code-->
										
										 <!--Bank Address-->
										<div class="form-group col-md-3">
										  <label>Bank Address</label>
										  <textarea class="form-control" rows="3" placeholder="Ex: XYZ Bangalore" id="vendor_bank_address" name="vendor_bank_address"><?php echo $vendor_result['vendor_bank_address'];?></textarea>
										</div>
									   <!--Bank Address-->
									   
									   <!--Authentic-->
										<div class="form-group col-md-3">
											<label>Authentic</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-check"></i></span>
												<select name="ui_authenticated" id="ui_authenticated" class='form-control selectpicker' style='width: 100%;'>
													<?php
													{
														$sql = "SELECT * from vendor where delete_status<>1";
														$query = mysqli_query($conn, $sql);
														while($row = mysqli_fetch_array($query))
														{
															if ($row['vendor_id'] == $vendor_result['vendor_id'])
															{
																if ($vendor_result['authenticate']=='Data Authentic')
																{												
																	echo '<option value="Data Authentic" selected>Data Authentic</option>';
																	echo '<option value="Data Unauthentic">Data Unauthentic</option>';
																}
																elseif ($vendor_result['authenticate']=='Data Unauthentic')
																{
																	echo '<option value="Data Authentic">Data Authentic</option>';
																	echo '<option value="Data Unauthentic" selected>Data Unauthentic</option>';
																}	
																else
																{
																	echo '<option value="" disabled selected>Select</option>';
																	echo '<option value="Data Authentic">Data Authentic</option>';
																	echo '<option value="Data Unauthentic">Data Unauthentic</option>';
																}														
															}
																else
																{
																	echo "Error";
																}
															
														}
													} 
													?>
													
												</select>
											</div>
										</div>
										<!--Authentic-->

									 <!--Vendor Address-->
									<div class="form-group col-md-4">
									  <label>Vendor Address</label>
									  <textarea class="form-control" rows="6" placeholder="Ex: XYZ Bangalore" id="vendor_address" name="vendor_address"><?php echo $vendor_result['vendor_address'];?></textarea>
									</div>
								   <!--Vendor Address-->
								   
								   <!--Deals With-->
									<div class="form-group col-md-4">
									  <label>Deals With</label>
									  <textarea class="form-control" rows="6" placeholder="Ex: Ebco" id="vendor_brands_dealing" name="vendor_brands_dealing"><?php echo $vendor_result['vendor_brands_dealing'];?></textarea>
									</div>
								   <!--Deals With-->
								  
								   <!--Vendor Additional Info-->
									<div class="form-group col-md-4">
									  <label>Additional Info</label>
									  <textarea class="form-control" rows="6" placeholder="Ex: Bank Account Details" id="vendor_additional_info" name="vendor_additional_info" ><?php echo $vendor_result['vendor_additional_info'];?></textarea>
									</div>
								   <!--Vendor Additional Info-->
								   
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
										<input type="hidden" name="ui_customer_contact_id[]" value="<?php echo $contacts_row['contact_id'];  ?>"/>
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
							   
								   <input id="location" name="location" type="hidden" value="<?php echo $user_result['location'];?>" />

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
		$(document).ready(function()
		{
			// Handler for .ready() called.
			$("#li_vendor").addClass("active");
			$("#li_add_vendor").addClass("active");		
			
		});
	</script>
	
	
</body>

</html>