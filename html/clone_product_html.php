<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";
	$product_id=$_GET["id"];
	$sql = "SELECT * FROM product where delete_status<>1 and product_id = " . $product_id;
	$result = mysqli_query($conn, $sql);
	$product_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
	?>
	<!--Including Login Session-->

	<head>
		<!--Including Bootstrap CSS links-->
		<?php include "../extra/header.html";?>
		<!--Including Bootstrap CSS links-->
		
		<script type="text/javascript">
			$(document).ready(function()
			{							 

			if($('#ui_unbranded').is(":checked")) 
			{
				$("#ui_unbranded").val('Unbranded');
				$("#brand_div").hide();
				//$("#ui_brand_id option[value='']").attr('selected', true)
				$("#ui_brand_id").val(""); 
			}
			else
			{
				$("#brand_div").show();
				$("#ui_unbranded").val('');
			}
			
			// Handler for .ready() called.
			$("#li_product").addClass("active");
			$("#li_add_product").addClass("active");
				//$('#ui_product_set_id').on('propertychange change click keyup input paste',function()
				//{ 
				
					var product_set_id =  $('#ui_product_set_id option:selected').eq(0).val();
					var product_id = $("#product_id").val();				
					if(product_set_id)
					{
						$.ajax(
						{
							type:'POST',
							url:'../php/edit_product_select_attribute_value.php',
							data: { product_set_id: product_set_id,product_id:product_id},
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
				//});
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
				<h1>
				Clone Product  
						<a href="../reports/product_report_html.php" class="btn btn-sm btn-success pull-right">Product Report</a>					
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
									<form action="../php/add/add_clone_product_php.php" enctype="multipart/form-data" method="POST">									   
										<input type="hidden" name="product_id" id="product_id" value="<?php echo $product_result['product_id'] ?>">
										
										<!--Product Name-->
										<div class="form-group col-md-6">
										 <label>Product Set Name</label>
										  <div class="input-group">
										 <span class="input-group-addon"><i class="fa fa-user"></i></span>
										<select name="ui_product_set_id" id="ui_product_set_id" class='form-control select2' required style='width: 100%;'>
											<option selected disabled hidden value="">Select Product Set</option>
												<?php
													{
												$sql = "SELECT * from product_set where delete_status<>1";
												$query = mysqli_query($conn, $sql);
												while($row = mysqli_fetch_array($query))
												{
													if ($row['product_set_id'] == $product_result['product_set_id']):
													{													
													echo "<option value='" . $row['product_set_id'] . "' selected >" . $row['product_set_product_name']. "</option>";
													}
													else:
													{
														echo "<option value='" . $row['product_set_id'] . "' >" . $row['product_set_product_name']. "</option>";
													}
													endif;
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
													Unbranded&nbsp;&nbsp; <div class="input-group"><input type="checkbox"  <?php if($product_result['product_unbranded']=="Unbranded") { echo "checked";}	?> name="ui_unbranded" id="ui_unbranded" onchange="valueChanged()">
													</div>
												</label>										
										</div>
										<!--Unbranded-->
																				
										<!--Brand Name-->
										<div id="brand_div" class="form-group col-md-3">
										 <label>Brand Name</label>
										  <div class="input-group">
										 <span class="input-group-addon"><i class="fa fa-user"></i></span>
										<select name="ui_brand_id" id="ui_brand_id" class='form-control select2' style='width: 100%;'>
											<option selected disabled hidden value="">Select Brand</option>
												<?php
												
												{
												$sql = "SELECT * from brand where delete_status<>1";
												$query = mysqli_query($conn, $sql);
												while($row = mysqli_fetch_array($query))
												{
													if ($row['brand_id'] == $product_result['brand_id']):
													{
													echo "<option value='" . $row['brand_id'] . "' selected>" . $row['brand_name']. "</option>";
													}
													else:
													{
														echo "<option value='" . $row['brand_id'] . "'>" . $row['brand_name']. "</option>";
													}
													endif;
												}
											} 										
													?>
										</select>
										</div>
										</div>
										<!--Brand Name-->

										
										<!--Product Name-->
										<div class="form-group col-md-3">
											<label>Product Name</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-cube"></i></span>
												<input type="text" class="form-control" placeholder="Product Name" id="ui_product_name" maxlength="100" style="text-transform:capitalize" name="ui_product_name" value="<?php echo $product_result['product_name']; ?>"/>
											</div>
										</div>
										<!--Product Name-->									
										
										<!--Description-->
										<div class="form-group col-md-6">
											<label>Description</label>
											<textarea class="form-control" rows="3" placeholder="Ex: CenturyPly IS:710 Marine Grade ply" id="ui_product_description" name="ui_product_description" ><?php echo $product_result['product_description'];  ?></textarea>
										</div>				
										<!--Description-->
										
										<!--Mrp-->
										<div class="form-group col-md-3">
											<label>MRP</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-money"></i></span>
												<input type="text" class="form-control" placeholder="Ex: 1267" id="ui_mrp" maxlength="60" value="<?php echo $product_result['product_mrp'];  ?>" name="ui_mrp"/>
											</div>
										</div>
										<!--Mrp-->		
										
										<!--HSN Code-->
										<div class="form-group col-md-3">
											<label>HSN Code</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-header"></i></span>
												<input type="text" class="form-control" placeholder="Ex: 1267" id="ui_hsn_code" value="<?php echo $product_result['product_hsn_code'];  ?>" maxlength="60" name="ui_hsn_code"/>
											</div>
										</div>
										<!--HSN Code-->
										
										
										<span id="ui_span" class="form-group col-md-12"></span>
										
										<!-- User ID -->
											<input id="user_id" name="user_id" type="hidden" value="<?php echo $user_result['id'];?>" />
										<!-- User ID -->
										
										<input id="location" name="location" type="hidden" value="<?php echo $user_result['location'];?>" />
										
											<div class="form-group col-md-12">
								<!-- File Upload -->
										<div id="maindiv">
											<div id="formdiv">
												<h4>Attachments</h4>
												Files types allowed: JPEG, PNG, JPG, PDF, DOC, DOCX, XLS, XLSX, Max Size: 1.5 MB.
												<hr/>												
												<div id="filediv" align="center" style="display:block"><input name="file[]" type="file" id="file"/></div><br/>
												<input type="button" id="add_more" class="upload" value="Add More Files"/>
											</div>           
										</div>																	
										<!-- File Upload -->
									</div>	
										
										
										<div class="col-lg-offset-10 col-lg-2">
											<button type="submit" data-loading-text="Please Wait..." class="btn btn-success form-control">Save  </button>
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
		<script type="text/javascript">
		function valueChanged()
		{
			if($('#ui_unbranded').is(":checked"))   
			{
				$("#ui_unbranded").val('Unbranded');
				$("#brand_div").hide();
			}
			else
			{
				$("#ui_unbranded").val('');
				$("#brand_div").show();
			}
		}
		</script>
	</body>
</html>