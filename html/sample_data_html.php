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

		<!-- Left Side Panel Which Contains Navigation Menu -->
		<?php include "../extra/left_nav_bar.php";?>
		<!-- Left Side Panel Which Contains Navigation Menu -->

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>Add Sample Data 
						<a href="../reports/sample_data_report_html.php" class="btn pull-right btn-xs btn-primary">Sample Data Report</a>
					</h1>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="row">
						<!-- left column -->
						<div class="col-md-12">
							<!-- general form elements -->
							<div class="box box-primary">
								<!-- /.box-header -->
								<div class="box-body pad">
									<form action="../php/add/add_sample_data_php.php" method="post">
									
										<!-- Catalogue/Sample Name -->
										<div class="form-group col-md-4" id="div_category_name">
											<label>Catalogue/Sample Name</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-server"></i></span>
												<input type="text" class="form-control" id="catalogue_sample_name" style="text-transform:capitalize" name="catalogue_sample_name"/>
											</div>
										</div>
										<!-- Catalogue/Sample Name -->
										
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
										
										<!-- Catalogue/Sample No -->
										<div class="form-group col-md-2" id="div_category_name">
											<label>Catalogue/Sample No</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-server"></i></span>
												<input type="text" class="form-control" id="catalogue_sample_number" name="catalogue_sample_number"/>
											</div>
										</div>
										<!-- Catalogue/Sample Name -->
										
										<!-- Type-->
										<div class="form-group col-md-3">
											<label>Type</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-superpowers"></i></span>
												<select name="ui_type" id="ui_type" class='form-control selectpicker' style='width: 100%;'>
												<option hidden selected disabled value="">Select Type</option>
												<option>Catalogue</option>
												<option>Sample</option>
												
												</select>
											</div>
										</div>
										<!-- Type-->
										
										<!-- Section -->
										<div class="form-group col-md-3">
											<label>Section</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-gavel"></i></span>
												<select name="ui_section" id="ui_section" class='form-control selectpicker' style='width: 100%;'>
												<option hidden selected disabled value="">Select Section</option>
												<option>A</option>
												<option>B</option>
												<option>C</option>
												<option>D</option>
												<option>E</option>												
												</select>
											</div>
										</div>
										<!-- Section -->
										
										<!--Description-->
										<div class="form-group col-md-9">
											<label>Description</label>
											<textarea class="form-control" rows="3" placeholder="Ex: XYZ" id="ui_description" name="ui_description"></textarea>
										</div>
										<!--Description-->
										
										<!--Location-->
										<input id="location" name="location" type="hidden" value="<?php echo $user_result['location'];?>" />
										<!--Location-->
										
										<!-- User ID -->
										<input id="user_id" name="user_id" type="hidden" value="<?php echo $user_result['id'];?>" />
										<!-- User ID -->

										<!--Save-->
										<div class="col-lg-offset-10 col-lg-2">
											<button type="submit" data-loading-text="Please Wait..." class="btn btn-success form-control">Save  </button>
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
				<div class="pull-right hidden-xs"></div>				
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
		</div>	
		
		<!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";?>
		<!--Including Bootstrap and other scripts-->
		
		
		<script>
		$(document).ready(function()
		{
			fn_fetch_brands(null);
			// Handler for .ready() called.
			$("#li_sample_management").addClass("active");
			$("#li_add_sample_data").addClass("active");
		});
		</script>
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
			$.ajax(
			{
				url: "../php/add_brand.php",
				type: "POST", // you can use GET
				data: {product_set_id:product_set_id, brand_name:brand_name, brand_description:brand_description, brand_company_connect:brand_company_connect, brand_company_number:brand_company_number}, // post data
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
</html>