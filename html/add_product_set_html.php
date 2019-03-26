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

		<div class="content-wrapper">
			<section class="content-header">
				<h1>
					Add Product Set
					<a href="../reports/product_set_report_html.php" class="btn pull-right btn-xs btn-primary">Product Set Report</a>
				</h1>
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="row">
					<div class="col-md-12">
						<div class="box box-primary">
						<div class="box-header with-border">
						</div>
							<div class="box-body pad">
								<form id="add_product_set" action="../php/add/add_product_set_php.php" enctype="multipart/form-data" method="post"  onsubmit="submit.disabled = true; return true;">

								<!--Category Name-->
								<div class="form-group col-md-3">
									<label>Category Name</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-server"></i></span>
										<span id="ui_category_span" name="ui_category_span"> </span>
										<span class="input-group-addon" style="cursor: pointer;" data-toggle="modal" data-target="#add_category_modal">
											<i class="fa fa-plus"></i>
										</span>
									</div>
								</div>
								<!--Category Name-->

								<!--Sub Category Name-->
								<div class="form-group col-md-3">
									<label>Sub Category Name</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-clone"></i></span>
										<select name="ui_sub_category" id="ui_sub_category" class='form-control select2' required style='width: 100%;'>
											<option hidden value="">Select Category</option>
										</select>
									</div>
								</div>
								<!--Sub Category Name-->

								<!--Product Set Name-->
								<div class="form-group col-md-3">
									<label>Product Set Name</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
										<input type="text" class="form-control" autocomplete="off" placeholder="Ex: AC" id="ui_product_name" required name="ui_product_name" maxlength="150" style="text-transform:capitalize"/>
									</div>
								</div>
								<!--Product Set Name-->

								<!--Defaut Size-->
								<div class="form-group col-md-3">
									<label>Defaut Size</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-arrows-h"></i></span>
										<input type="text" class="form-control" placeholder="Ex: 8x4 SQFT" id="ui_default_size" name="ui_default_size"/>
									</div>
								</div>
								<!--Defaut Size-->

								<!--Description-->
								<div class="form-group col-md-6">
									<label>Description</label>
									<textarea class="form-control" rows="3" placeholder="Ex: CenturyPly IS:710 Marine Grade ply" id="ui_product_description" name="ui_product_description"></textarea>
								</div>
								<!--Description-->
								
								<!--TAX-->
								<div class="form-group col-md-3">
								<label for="TAX">Tax</label>
								<select id="tax" name="tax" class='form-control' style='width: 100%;'>
								<?php
								{
									$sql_tax = "SELECT * FROM key_value where key_column = 'TAX' and delete_status<>1 ORDER BY value";
									$tax_query = mysqli_query($conn, $sql_tax);
									while($tax_row = mysqli_fetch_array($tax_query))
									{
										echo "<option value='".$tax_row['value']."'>" . $tax_row['value']. "</option>";
									}
								}
								?>
								</select>
								</div>
								<!--TAX-->

								<!--Unit Of Measurement-->
								<div class="form-group col-md-3">
									<label>Unit Of Measurement</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-magic"></i></span>
										<span id="ui_unit_of_measurement_span" name="ui_unit_of_measurement_span"> </span>
										<span class="input-group-addon" style="cursor: pointer;" data-toggle="modal" data-target="#add_unit_of_measurement_modal"><i class="fa fa-plus"></i></span>
									</div>
								</div>
								<!--Unit Of Measurement-->

								<!-- Installation Needed-->
								<div class="form-group col-md-12">
									<div class="input-group">
										<label>
											Installation Needed&nbsp;&nbsp;<input type="checkbox" value="yes" name="installation_needed" id="installation_needed">					
										</label>
									</div>
								</div>
								<!--Installation Needed-->
								
								<!--Certify-->
									<div class="form-group col-md-3">
										<label>Active/Inactive</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-check"></i></span>
											<select name="ui_certify" id="ui_certify" class='form-control selectpicker' style='width: 100%;'>
												<option value="">Select</option>
												<option value="Active">Active</option>
												<option value="Inactive">Inactive</option>
											</select>
										</div>
									</div>
									<!--Certify-->

								<!-- User ID -->
									<input id="user_id" name="user_id" type="hidden" value="<?php echo $user_result['id'];?>" />
								<!-- User ID -->
													
								<div class="form-group col-md-12">								
									<fieldset class="row2">
									<center><label>Attribute</label></center>
									<div class="table-responsive">
										<table id="dataTable" class="table table-fixed table-condensed table-bordered" border="0" style="overflow: scroll;">
											<tbody>
												<tr>
													<p>
													<td>
														<!--Attribute Name-->
														<div class="form-group">
															<center><label>Attribute Name</label></center>
															<div class="">
																<select name="ui_attribute_id[]" id="ui_attribute_id[]" required class='form-control'>
																<option selected disabled hidden value="">Select Attribute Name</option>
																<?php
																{
																	$sqlu = "SELECT * FROM key_value where key_column = 'ATTRIBUTE' and delete_status<>1 ORDER BY value";
																	$queryu = mysqli_query($conn, $sqlu);
																	while($roww = mysqli_fetch_array($queryu))
																	{
																		echo "<option value='" . $roww['key_value_id'] . "'>" . $roww['value']. "</option>";
																	}
																} 
																?>
																</select>
															</div>
														</div>
														<!--Attribute Name-->
													</td>
													<td>
														<center><label for="DESCRIPTION">Attribute Value</label></center>
														<input type="text" class="form-control" required="required" name="ui_attribute_value[]">
													</td>
													<td>
														<center><label for="SELLING_PRICE">Action</label></center>
														<input type='button' class="form-control btn btn-danger btn-flat" value="Remove" onClick="deletethisrow('dataTable',this)">
													</td>
													</p>
												</tr>
											</tbody>
										</table>
									</div>
								</div>

								<div class="form-group col-md-12">
									<input type="button" class="btn btn-primary btn-flat" value="Add Attribute" onClick="addRow('dataTable')" /> 
								</div>
								
								<input id="location" name="location" type="hidden" value="<?php echo $user_result['location'];?>" />

								
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
								<button type="submit" data-loading-text="Please Wait..." class="btn btn-success form-control">Save  </button>
								</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</section>
			</div>

			<!-- Main Footer -->
			<footer class="main-footer">
				<div class="pull-right hidden-xs"></div>				
			</footer>
			<!-- Main Footer -->

			<!--Including right slide panel-->
			<?php include "../extra/aside.php";?>
			<!--Including right slide panel-->
			
			<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		</div>

		<!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";?>
		<!--Including Bootstrap and other scripts-->
	</body>

	<!-- Add Category Modal -->
	<div id="add_category_modal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Category</h4>
				</div>
				<div class="modal-body">
					<form role="form" id="contact" name="contact" method="post">
						<!--Category Name-->
						<div class="form-group">
							<label>Category Name</label>
							<input type="text" class="form-control" id="modal_category_name" required style="text-transform:capitalize" name="modal_category_name" />
						</div>
						<!--Category Name-->
						<!--Category Description-->
						<div class="form-group">
							<label>Category Description</label>
							<textarea class="form-control" id="modal_category_description" name="modal_category_description"></textarea>
						</div>
						<!--Category Description-->
						<div class="form-group">
							<button class="btn btn-success btn-block" type="button" id="category_submit">Save</button>
						</div>
					</form>
				</div>
				<div class="modal-footer">
				<button id="submit" type="submit" id="close_category_modal" name="close_category_modal"class="btn btn-default pull-right" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Add Category Modal -->
	
	<!-- Add Unit Of Measurement Modal -->
	<div id="add_unit_of_measurement_modal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Unit Of Measurement</h4>
				</div>
				<div class="modal-body">
					<form role="form" id="contact" name="contact" method="post">
						<!-- Unit Of Measurement -->
						<div class="form-group">
							<label>Unit Of Measurement</label>
							<input type="text" class="form-control" id="modal_unit_of_measurement"  style="text-transform:lowercase" name="modal_unit_of_measurement" />
						</div>
						<!-- Unit Of Measurement -->

						<div class="form-group">
							<button class="btn btn-success btn-block" type="button"  onclick="fn_add_unit_of_measurement();" id="submit">Save</button>
						</div>
					</form>
				</div>
				<div class="modal-footer">

				<button id="submit" type="submit" id="close_unit_of_measurement_modal" name="close_unit_of_measurement_modal"class="btn btn-default pull-right" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Add Unit Of Measurement Modal -->

	<script>
	

	function fn_add_unit_of_measurement()
	{
		var unit_of_measurement= $("#modal_unit_of_measurement").val(); 
		var location="<?php echo $user_result['location']; ?>";
		$.ajax(
		{
			url: "../php/add_key_value.php",
			type: "POST", // you can use GET
			
			data: {unit_of_measurement: unit_of_measurement, location:location}, // post data
			success: function(data)   // A function to be called if request succeeds
			{			
				$("#add_unit_of_measurement_modal .close").click()
				fn_fetch_unit_of_measurement(data);
				$('#modal_unit_of_measurement').val("");
			}
		});
	}
	</script>
	
	
	<script type="text/javascript">
	$(document).ready(function()
	{  
		// Handler for .ready() called.
		$("#li_product").addClass("active");
		$("#li_add_product_set").addClass("active");
		fn_fetch_category(1);
		fn_fetch_unit_of_measurement(1);		
		
		 $("#category_submit").click(fn_add_category_modal);
		function fn_add_category_modal()
	{
		var category_name= $("#modal_category_name").val(); 
		var category_description= $("#modal_category_description").val();
		var user_id=<?php echo $user_result['id']; ?>;
		var location="<?php echo $user_result['location']; ?>";
		$.ajax(
		{
			url: "../php/add_category_php.php",
			type: "POST", // you can use GET
			data: {text1: category_name, text2: category_description, user_id:user_id, location:location}, // post data
			success: function(data)   // A function to be called if request succeeds
			{
				$("#add_category_modal .close").click()
				$('#modal_category_name').val("");
				$('#modal_category_description').val("");
				fn_fetch_category(data);
			}
		});
	}
	});

	function fn_fetch_category(data)
	{	
		$.ajax(
		{
			type:'POST',
			url: '../php/get_all_category.php',
			data: {category_id:data},
			success:function(data)
			{
				$('#ui_category_span').html(data);
				fn_fetch_sub_category();
				$("#ui_category").select2();
			}
		});		
	};

	function fn_fetch_sub_category()
	{
		var catID = $('#ui_category').val();
		if(catID)
		{
			$.ajax(
			{
				type:'POST',
				url:'../php/ajaxData.php',
				data: { p_Category: catID,p_Subcategory:''},
				success:function(html)
				{
					$('#ui_sub_category').html(html);
				}
			}); 
		}
		else
		{
			$('#ui_sub_category').html('<option value="">Select Category first</option>');
		}
	};

	function fn_fetch_unit_of_measurement(data)
	{	
		$.ajax(
		{
			type:'POST',
			url: '../php/get_key_value.php',
			data: {key_id:data},
			success:function(data)
			{
				$('#ui_unit_of_measurement_span').html(data);
				$("#ui_key_value").select2();
			}
		});		
	};
	</script>
</html>