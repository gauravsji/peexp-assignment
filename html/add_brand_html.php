<!--
Description: Add brand module adds the brand information according to a product set.
Date: 04/07/2017
-->
<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";?>
	<!--Including Login Session-->

	<head>
		<!--Including Bootstrap and CSS links-->
		<?php include "../extra/header.html";?>
		<!--Including Bootstrap and CSS links-->			
	</head>

	<body class="hold-transition skin-blue fixed sidebar-mini">
		<div class="wrapper">
			<!--Including Topbar-->
			<?php include "../extra/topbar.php";?>
			<!--Including Topbar-->

			<!-- Left Side Panel Which Contains Navigation Menu -->
			<?php include "../extra/left_nav_bar.php";?>
			<!-- Left Side Panel Which Contains Navigation Menu -->

			<!-- Content Wrapper and contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						Add Brand  
						<a href="../reports/brand_report_html.php" class="btn pull-right btn-xs btn-primary">Brand Report</a>
					</h1>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="row">
						<div class="col-md-12">
							<div class="box box-primary">
								<div class="box-body pad">
									<form action="../php/add/add_brand_php.php" enctype="multipart/form-data" method="post" onsubmit="return fn_brand_exists();">
									   
										<!--Product Set Name-->
										<div class="form-group col-md-4">
											<label>Product Set Name</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-server"></i></span>
												<select name="ui_product_set_id" id="ui_product_set_id" class='form-control select2' style='width:100%;'>
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

										<!--Brand Name-->
										<div class="form-group col-md-4" id="div_brand_name">
											<label>Brand Name</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-tag"></i></span>
												<input type="text" class="form-control" placeholder="Brand Name" style="text-transform:capitalize" id="ui_brand_name" name="ui_brand_name" maxlength="100"/>
											</div>
										</div>
										<!--Brand Name-->
										
										
										<!--Average Customer Discount-->
										<div class="form-group col-md-4" id="div_cust_disc">
											<label>Customer Discount</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-tag"></i></span>
												<input type="text" class="form-control" placeholder="Average Discount" style="text-transform:capitalize" id="ui_cust_disc" name="ui_cust_disc" maxlength="100"/>
											</div>
										</div>
										<!--Average Customer Discount-->
										
										<span id="name_status"></span>
																			
										<!--Description-->
										<div class="form-group col-md-12">
											<label>Description</label>
											<textarea class="form-control" rows="8" placeholder="Ex: CenturyPly IS:710 Marine Grade ply" id="ui_brand_description" name="ui_brand_description"></textarea>
										</div>									
										<!--Description-->
										
										<!--Company Connect Name-->
										<div class="form-group col-md-4">
											<label>Company Connect Name</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-user"></i></span>
												<input type="text" class="form-control" id="ui_company_connect" name="ui_company_connect" style="text-transform:capitalize" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode==32' maxlength="100"/>
											</div>
										</div>
										<!--Company Connect Name-->
										
										<!--Contact Number-->
										<div class="form-group col-md-4">
											<label>Contact Number</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
												<input type="text" class="form-control" placeholder="Ex: 9876543210" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="ui_contact_number" maxlength="30" name="ui_contact_number" type="text"/>
											</div>
										</div>
										<!--Contact Number-->
												
										<!--Email-->
										<div class="form-group col-md-4">
											<label>Email</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
												<input type="email" class="form-control" placeholder="Ex: abc@gmail.com" style="text-transform:lowercase" id="ui_connect_email"  maxlength="100" name="ui_connect_email" type="text"/>
											</div>
										</div>
										<!--Email-->
												
										<!--Address-->
										<div class="form-group col-md-6">
											<label>Address</label>
											<textarea class="form-control" rows="3" placeholder="Ex: CenturyPly IS:710 Marine Grade ply" id="ui_address" name="ui_address"></textarea>
										</div>									
										<!--Address-->
										
										<!--Additional Info-->
										<div class="form-group col-md-6">
											<label>Additional Info</label>
											<textarea class="form-control" rows="3" id="ui_additional_info" name="ui_additional_info"></textarea>
										</div>									
										<!--Additional Info-->
										
										<!--Display Available Brands-->
										<span id="ui_span" class="col-md-12"></span>
										<!--Display Available Brands-->
										
										<!--Location-->
										<input id="location" name="location" type="hidden" value="<?php echo $user_result['location'];?>"/>
										<!--Location-->
										
										<!-- User ID -->
											<input id="user_id" name="user_id" type="hidden" value="<?php echo $user_result['id'];?>"/>
										<!-- User ID -->											

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
			<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		</div>
		<!-- ./wrapper -->

		<!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";?>
		<!--Including Bootstrap and other scripts-->
		
		<script type="text/javascript">
		$(document).ready(function()
		{
			// Handler for .ready() called.
			$("#li_product").addClass("active");
			$("#li_add_brand").addClass("active");

			$("#ui_brand_name").prop('disabled', true);
			$("#ui_brand_description").prop('disabled', true);
			$("#ui_company_connect").prop('disabled', true);
			$("#ui_contact_number").prop('disabled', true);
			$("#ui_connect_email").prop('disabled', true);
			$("#ui_address").prop('disabled', true);
			$("#ui_additional_info").prop('disabled', true);

				$('#ui_product_set_id').on('change',function()
				{
					$("#ui_brand_name").prop('disabled', false);	
					$("#ui_brand_description").prop('disabled', false);	
					$("#ui_company_connect").prop('disabled', false);	
					$("#ui_contact_number").prop('disabled', false);	
					$("#ui_connect_email").prop('disabled', false);	
					$("#ui_address").prop('disabled', false);	
					$("#ui_additional_info").prop('disabled', false);	

					var product_set_id = $(this).val();
						if(product_set_id)
						{
							$.ajax(
							{
								type:'POST',
								url:'../php/select_brand.php',
								data: { product_set_id: product_set_id},
								success:function(html)
								{
									$('#ui_span').html(html);
								}
							}); 
						}
						else
						{
							$('#ui_span').html('');
						}
				});
		});

		$('input#ui_brand_name').bind("change paste keyup input",function() 
		{ 
			// handle events here
			checkname();
		});

		function checkname()
		{
			var ui_brand_name = $("#ui_brand_name");
			if(ui_brand_name.val() == "")
			{
				$("#div_brand_name").removeClass("has-error");  
				$("#div_brand_name").removeClass("has-success");
			}

			var name=document.getElementById("ui_brand_name" ).value;
			var key=document.getElementById("ui_product_set_id" ).value;

			if(name)
			{
				$.ajax({
				type: 'post',
				url: '../php/check_brand_name_data.php',
				data: 
				{
					user_name:name,
					key:key,
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

		function fn_brand_exists()
		{
			if($("#div_brand_name").hasClass("has-error"))
			{
				alert("Brand for selected product set already exists");				
				return false;
			}
		}
		</script>			
	</body>	
</html>