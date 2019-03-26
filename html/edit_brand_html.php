<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";
	$brand_id=$_GET["id"];
	$sql = "SELECT * FROM brand where delete_status<>1 and brand_id = " . $brand_id;
	$result = mysqli_query($conn, $sql);
	$brand_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
	?>
	<!--Including Login Session-->

	<head>

		<script src="../dist/js/multiple_image_upload_script.js"></script>
		<!-------Including CSS File------>
		<link rel="stylesheet" type="text/css" href="../css/multiple_image_upload_style.css">
				
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
					<h1>Edit Brand 	<a href="../reports/brand_report_html.php"  class="btn btn-sm btn-success pull-right">Brand Report</a> </h1>
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
									<form action="../php/update/update_brand_php.php" method="post" enctype="multipart/form-data" onsubmit="submit.disabled = true; return true;">
									   
										<input type="hidden" id="ui_brand_id" name="ui_brand_id" value="<?php echo $brand_result['brand_id'];?>"/>
										
										<!--Product Set Name-->
										<div class="form-group col-md-4">
											<label>Product Set Name</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-server"></i></span>
												<select name="ui_product_set_id" id="ui_product_set_id" class='form-control select2' style='width: 100%;'>
												<option selected disabled hidden>Select Product Set Name</option>
												<?php
												{
													$sql = "SELECT * FROM product_set ps, category c,sub_category sc where ps.category_id=c.category_id and ps.sub_category_id=sc.sub_category_id and ps.delete_status<>1";
													$query = mysqli_query($conn, $sql);
													while($row = mysqli_fetch_array($query))
													{
														if ($row['product_set_id'] == $brand_result['product_set_id']):
														{
															echo "<option selected value='" . $row['product_set_id'] . "'>" . $row['category_name'].">". $row['sub_category_name'].">". $row['product_set_product_name']. " </option>";
														}
														else:
														{
															echo "<option value='" . $row['product_set_id'] . "'>" . $row['category_name'].">". $row['sub_category_name'].">". $row['product_set_product_name']. "</option>";
														}
														endif;
													}	
												} 
												?>
												</select>
											</div>
										</div>
										<!--Product Set Name-->

										<!--Brand Name-->
										<div class="form-group col-md-4">
										 <label>Brand Name</label>
										  <div class="input-group">
										 <span class="input-group-addon"><i class="fa fa-tag"></i></span>
										  <input type="text" class="form-control" placeholder="Brand Name" style="text-transform:capitalize" id="ui_brand_name" name="ui_brand_name" value="<?php echo $brand_result['brand_name'];  ?>" />
										</div>
										</div>
										<!--Brand Name-->
										
										<!--Average Customer Discount-->
										<div class="form-group col-md-4" id="div_cust_disc">
											<label>Customer Discount</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-tag"></i></span>
												<input type="text" class="form-control" placeholder="Average Discount" style="text-transform:capitalize" id="ui_cust_disc" name="ui_cust_disc" value="<?php echo $brand_result['customer_average_disc'];  ?>" maxlength="100"/>
											</div>
										</div>
										<!--Average Customer Discount-->
																			
										<!--Description-->
										<div class="form-group col-md-12">
											<label>Description</label>
											<textarea class="form-control" rows="8" placeholder="Ex: CenturyPly IS:710 Marine Grade ply" id="ui_brand_description" name="ui_brand_description"><?php echo $brand_result['brand_description'];  ?></textarea>
										</div>									
										<!--Description-->
										
										<!--Company Connect Details-->
										<div class="form-group col-md-4">
										 <label>Company Connect Name</label>
										  <div class="input-group">
										 <span class="input-group-addon"><i class="fa fa-user"></i></span>
										  <input type="text" class="form-control"  id="ui_company_connect" name="ui_company_connect" style="text-transform:capitalize" maxlength="70" value="<?php echo $brand_result['brand_company_connect'];  ?>"  onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode==32'/>
										</div>
										</div>
										<!--Company Connect Details-->
										
										<!--Contact Number-->
										<div class="form-group col-md-4">
											<label>Contact Number</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
												<input type="text" class="form-control" placeholder="Ex: 9876543210" id="ui_contact_number" maxlength="50" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="ui_contact_number" type="text" value="<?php echo $brand_result['brand_company_connect_contact_number'];  ?>"/>
											</div>
										</div>
										<!--Contact Number-->
												
										<!--Email-->
										<div class="form-group col-md-4">
											<label>Email</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
												<input type="email" class="form-control" placeholder="Ex: abc@gmail.com" id="ui_connect_email"  style="text-transform:lowercase"  maxlength="30" name="ui_connect_email" type="text" value="<?php echo $brand_result['brand_company_connect_email'];  ?>">
											</div>
										</div>
										<!--Email-->
												
										<!--Address-->
										<div class="form-group col-md-6">
											<label>Address</label>
											<textarea class="form-control" rows="3" placeholder="Ex: CenturyPly IS:710 Marine Grade ply" id="ui_address" name="ui_address"><?php echo $brand_result['brand_company_connect_address'];  ?></textarea>
										</div>									
										<!--Address-->
										
										<!--Additional Info-->
										<div class="form-group col-md-6">
											<label>Additional Info</label>
											<textarea class="form-control" rows="3" placeholder="Ex: CenturyPly IS:710 Marine Grade ply" id="ui_additional_info" maxlength="150" name="ui_additional_info"><?php echo $brand_result['brand_company_connect_additional_info'];  ?></textarea>
										</div>									
										<!--Additional Info-->									
										
										<!-- User ID -->
											<input id="user_id" name="user_id" type="hidden" value="<?php echo $user_result['id'];?>" />
										<!-- User ID -->
											
										<!--User Location-->
										<input id="location" name="location" type="hidden" value="<?php echo $user_result['location'];?>" />
										<!--User Location-->											
											
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
			$("#li_product").addClass("active");
			$("#li_add_brand").addClass("active");
		});
		</script>
	</body>
</html>