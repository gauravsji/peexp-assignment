<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";?>
	<!--Including Login Session-->

	<head>
		<!--Including Bootstrap CSS links-->
		<?php include "../extra/header.html";?>
		<!--Including Bootstrap CSS links-->
			
			<script type="text/javascript">
			$(document).ready(function()
			{
				// Handler for .ready() called.
				$("#li_product").addClass("active");
				$("#li_add_product").addClass("active");

				fn_fetch_brands(null);

				$('#ui_product_set_id').on('change',function()
				{
					var product_set_id = $(this).val();
					if(product_set_id)
					{
						$.ajax(
						{
							type:'POST',
							url:'../php/select_attribute_value.php',
							data: { product_set_id: product_set_id},
							success:function(html)
							{
								$('#ui_span').html(html);
							}
						}); 
					}
					else
					{
						$('#ui_span').html('<option value="">Select Product Set</option>');
					}
				});
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
				<h1>Add Product 
					<a href="../reports/product_report_html.php" class="btn pull-right btn-xs btn-primary">Product Report</a>
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
									<form action="../php/add/add_product_php.php" method="POST" enctype="multipart/form-data"  onsubmit="submit.disabled = true; return true;">
									   
										<!--Product Name-->
										<div class="form-group col-md-5">
											<label>Product Set Name</label>
											<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
												<select name="ui_product_set_id" id="ui_product_set_id" class='form-control select2' required style='width: 100%;'>
												<option selected disabled hidden value="">Select Product Set</option>
												<?php
												{
													$sql = "SELECT * FROM product_set ps, category c,sub_category sc where ps.category_id=c.category_id and ps.sub_category_id=sc.sub_category_id and ps.delete_status<>1";
													$query = mysqli_query($conn, $sql);
													while($row = mysqli_fetch_array($query))
													{
														echo "<option value='" . $row['product_set_id'] . "'>" . $row['category_name'].">". $row['sub_category_name'].">". $row['product_set_product_name']. "</option>";
													}
												} 
												?>
												</select>
											</div>
										</div>
										<!--Product Name-->
										
										<!-- Unbranded -->
										<div class="form-group col-md-3">											
											<label>
												Unbranded&nbsp;&nbsp; <div class="input-group"><input type="checkbox" value="Unbranded" name="ui_unbranded" id="ui_unbranded" onchange="valueChanged()">
												</div>
											</label>											
										</div>
										<!--Unbranded-->
										
										<!--Brand Name-->
										<div id="brand_div" class="form-group col-md-3">
											<label>Brand Name</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-tag"></i></span>
												<span id="ui_brand_span" name="ui_brand_span"></span>
												</select>
												<span class="input-group-addon" style="cursor: pointer;" data-toggle="modal" data-target="#add_brand_modal">
													<i class="fa fa-plus"></i>
												</span>
											</div>
										</div>
										<!--Brand Name-->
										
										<!--Product Name-->
										<div class="form-group col-md-3">
											<label>Product Name</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-cube"></i></span>
												<input type="text" class="form-control" style="text-transform:capitalize" placeholder="Product Name" style="text-transform:capitalize" id="ui_product_name" maxlength="100" name="ui_product_name"/>
											</div>
										</div>
										<!--Product Name-->									
									
										<!--Description-->
										<div class="form-group col-md-5">
											<label>Description</label>
											<textarea class="form-control" rows="3" placeholder="Ex: CenturyPly IS:710 Marine Grade ply" id="ui_product_description" name="ui_product_description"></textarea>
										</div>				
										<!--Description-->
										
										<!--Mrp-->
										<div class="form-group col-md-3">
											<label>MRP</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-money"></i></span>
												<input type="text" class="form-control" placeholder="Ex: 1267" id="ui_mrp" maxlength="60" name="ui_mrp"/>
											</div>
										</div>
										<!--Mrp-->
					
										<!--HSN Code-->
										<div class="form-group col-md-3">
											<label>HSN Code</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-header"></i></span>
												<input type="text" class="form-control" placeholder="Ex: 1267" id="ui_hsn_code" maxlength="60" name="ui_hsn_code"/>
											</div>
										</div>
										<!--HSN Code-->
										
										
										<span id="ui_span" class="col-md-12"></span>
										
										<!-- User ID -->
											<input id="user_id" name="user_id" type="hidden" value="<?php echo $user_result['id'];?>" />
										<!-- User ID -->
										
										<input id="location" name="location" type="hidden" value="<?php echo $user_result['location'];?>" />
																

								<!-- File Upload -->
								<div class="form-group col-md-12">
								<div id="maindiv">
											<div id="formdiv">
												<h2 class="h2">Attachments</h2>
												First Field is Compulsory. Only JPEG, PNG, JPG, PDF, DOC, DOCX, XLS, XLSX Type files allowed. File Size Should Be Less Than 1.5 MB.
												<hr/>
												
												<div id="filediv" align="center" style="display:block"><input name="file[]" type="file" id="file"/></div><br/>

												<input type="button" id="add_more" class="upload" value="Add More Files"/>
												<!--  <input type="submit" value="Upload File" name="submit" id="upload" class="upload"/>-->
												
												<!-------Including PHP Script here------>
												<?php //include "../php/multiple_image_upload.php"; ?>
											</div>           
										</div>		</div>																	
								<!-- File Upload -->																
									    <div class="col-lg-offset-10 col-lg-2">
											<button type="submit" data-loading-text="Please Wait..." class="btn btn-success form-control">Save </button>
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

	<!-- Add Brand -->
		<div id="add_brand_modal" class="modal fade" role="dialog">
			<div class="modal-dialog ">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add New Brand</h4>
					</div>
					<div class="modal-body">
						<form role="form" id="form_brand" name="form_brand" method="post">
						
							<!--Product Set Name-->
							<div class="form-group">
							<label>Product Set Name</label>
							<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-server"></i></span>
							<select name="modal_product_set_id" id="modal_product_set_id" class='form-control select2' style='width: 100%;'>
								<option selected disabled hidden>Select Product Set Name</option>
									<?php
										 {
											$sql = "SELECT * FROM product_set ps, category c,sub_category sc where ps.category_id=c.category_id and ps.sub_category_id=sc.sub_category_id and ps.delete_status<>1";
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query))
											{
												echo "<option value='" . $row['product_set_id'] . "'>" . $row['category_name'].">". $row['sub_category_name'].">". $row['product_set_product_name']. "</option>";
											}
										} 
										?>
							</select>
							</div>
							</div>
							<!--Product Set Name-->										
										
							<!-- Brand Name -->
							<div class="form-group">
								<label>Brand Name</label>
								<input type="text" class="form-control" id="modal_brand_name" required name="modal_brand_name" style="text-transform:capitalize" maxlength="120"/>
							</div>
							<!-- Brand Name -->

							<!--Description-->
							<div class="form-group">
								<label>Description</label>
								<textarea class="form-control" rows="3" placeholder="Ex: CenturyPly IS:710 Marine Grade ply" id="modal_brand_description" name="modal_brand_description"></textarea>
							</div>									
							<!--Description-->
										
							<!--Company Connect Details-->
							<div class="form-group">
								<label>Company Connect Name</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<input type="text" class="form-control"  id="modal_company_connect" name="modal_company_connect" maxlength="70" style="text-transform:capitalize" maxlength="120"/>
								</div>
							</div>
							<!--Company Connect Details-->
							
							<!--Contact Number-->
							<div class="form-group">
								<label>Contact Number</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
									<input type="text" class="form-control" placeholder="Ex: 9876543210" id="modal_contact_number" onkeypress='return event.charCode>= 48 && event.charCode <= 57' maxlength="50" name="modal_contact_number" type="text"/>
								</div>
							</div>
							<!--Contact Number-->			
							<div class="form-group">
								<button class="btn btn-success btn-block" type="button"  onclick="fn_add_brand();" id="submit">Save</button>
							</div>
						</form>
					</div>
					<div class="modal-footer">

					<button id="submit" type="submit" id="close_add_brand" name="close_add_brand"class="btn btn-default pull-right" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Add Brand -->
		
		<script>
		function fn_add_brand()
		{
			var product_set_id= $("#modal_product_set_id").val(); 
			var brand_name= $("#modal_brand_name").val(); 
			var brand_description= $("#modal_brand_description").val();
			var brand_company_connect= $("#modal_company_connect").val(); 
			var brand_company_number= $("#modal_contact_number").val(); 
			var user_id= $("#user_id").val(); 
			var location= $("#location").val(); 
			$.ajax(
			{
				url: "../php/add_brand.php",
				type: "POST", // you can use GET
				data: {product_set_id:product_set_id, brand_name:brand_name, brand_description:brand_description, brand_company_connect:brand_company_connect, brand_company_number:brand_company_number,user_id:user_id,location:location}, // post data
				success: function(data)   // A function to be called if request succeeds
				{			
					$("#add_brand_modal .close").click()				
					$('#modal_product_set_id').val("");
					$('#modal_brand_name').val("");
					$('#modal_brand_description').val("");
					$('#modal_company_connect').val("");
					$('#modal_contact_number').val("");	
					fn_fetch_brands(data);				
				}
			});
		}
		
		function fn_fetch_brands(brand_id)
		{	
			$.ajax(
			{
				type:'POST',
				url: '../php/get_all_brands.php',
				data: {brand_id:brand_id},
				success:function(data)
				{
					$('#ui_brand_span').html(data);
					 $('#ui_brand_name').select2(); //Initialise Select2 Class on brand name dropdown 
				}
			});		
		};
		</script>
		
		<script type="text/javascript">
		function valueChanged()
		{
			if($('#ui_unbranded').is(":checked"))   
				$("#brand_div").hide();
			else
				$("#brand_div").show();
		}
		</script>
</html>