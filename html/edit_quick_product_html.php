<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";
		$quick_product_id=$_GET["id"];
		$sql = "SELECT * FROM quick_product where quick_product_id = " . $quick_product_id;
		$result = mysqli_query($conn, $sql);
		$quick_product_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
	?>
	<!--Including Login Session-->
	<head>
		<!--Including Bootstrap CSS links-->
		<?php include "../extra/header.html";?>
		<!--Including Bootstrap CSS links-->

	<!--	<script type="text/javascript">
		$(document).ready(function()
		{
			// Handler for .ready() called.
				$("#li_quick_product").addClass("active");
				$("#li_add_quick_product").addClass("active");
			
			$('#ui_category').on('change',function()
			{
				var catID = $(this).val();
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
						$('#ui_sub_category').html('<option value="">Select category first</option>');
					}
			});
		});
	</script> -->
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
						Edit Quick Product <div class="btn-toolbar pull-right">
						</div>
					</h1>
				</section>

				<section class="content">
					<div class="row">
						<div class="col-md-12">
							<div class="box box-primary">
								<div class="box-header with-border">
								</div>
								<div class="box-body pad">
									<form action="../php/update/update_quick_product_php.php" method="post" enctype="multipart/form-data" onsubmit="submit.disabled = true; return true;">
									<input type="hidden" name="ui_quick_product_id" id="ui_quick_product_id" value="<?php echo $quick_product_id; ?>"/>
									   
										<!--quick_product Name-->
										<div class="form-group col-md-3">
											<label>Product Name</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-quick_products"></i></span>
												<input type="text" class="form-control" placeholder="product Name" style="text-transform:capitalize" id="ui_quick_product_name" name="ui_quick_product_name" maxlength="150" required value="<?php echo $quick_product_result['quick_product_name'];  ?>" />
											</div>
										</div>
										<!--quick_product Name-->										

										<!--Description-->
										<div class="form-group col-md-6">
											<label>Description</label>
											
											<textarea class="form-control" rows="3" placeholder="black color, Dia 2.5ft" id="ui_quick_product_description" name="ui_quick_product_description" required><?php echo $quick_product_result['quick_product_description'];  ?></textarea>
										</div>
										<!--Description-->
										
										<!--Buying Price-->
										<div class="form-group col-md-4">
											<label>Buying Price</label>
											<div class="input-group">
											<input type="text" class="form-control" placeholder="Buying Price" style="text-transform:capitalize" id="ui_quick_product_bp" name="ui_quick_product_bp" maxlength="150" required value="<?php echo $quick_product_result['quick_product_bp']; ?>"/>
											</div>
										</div>
										<!--Buying Price-->
										
										<!--Selling Price-->
										<div class="form-group col-md-4">
											<label>Selling Price</label>
											<div class="input-group">
											<input type="text" class="form-control" placeholder="Selling Price" style="text-transform:capitalize" id="ui_quick_product_sp" name="ui_quick_product_sp" maxlength="150" required value="<?php echo $quick_product_result['quick_product_sp']; ?>"/>
											</div>
										</div>
										<!--Selling Price-->
										
										<!--quick_product tax-->
										<div class="form-group col-md-3">
										 <label>Tax</label>
										  <div class="input-group">
										 <span class="input-group-addon"><i class="fa fa-info"></i></span>
										<select name="ui_quick_product_tax" id="ui_quick_product_tax" class='form-control select2' style='width: 100%;'>
										<?php
										{
											if ($quick_product_result['quick_product_tax'] == "0")
											{
									  echo '<option value = 0 selected> 0% </option>
											<option value = 5 > 5% </option>
											<option value = 12> 12% </option>
											<option value = 18> 18% </option>
											<option value = 28> 28% </option>';
											}
											else if ($quick_product_result['quick_product_tax'] == "5")
											{
									  echo '<option value = 0 > 0% </option>
											<option value = 5 selected> 5% </option>
											<option value = 12> 12% </option>
											<option value = 18> 18% </option>
											<option value = 28> 28% </option>';
											}
											else if ($quick_product_result['quick_product_tax'] == "12")
											{
									  echo '<option value = 0 > 0% </option>
											<option value = 5 > 5% </option>
											<option value = 12 selected> 12% </option>
											<option value = 18> 18% </option>
											<option value = 28> 28% </option>';
											}
											else if ($quick_product_result['quick_product_tax'] == "18")
											{
									  echo '<option value = 0 > 0% </option>
											<option value = 5 > 5% </option>
											<option value = 12> 12% </option>
											<option value = 18 selected> 18% </option>
											<option value = 28> 28% </option>';
											}
											else 
											{
									  echo '<option value = 0 > 0% </option>
											<option value = 5 > 5% </option>
											<option value = 12> 12% </option>
											<option value = 18> 18% </option>
											<option value = 28 selected> 28% </option>';
											}
										}
											?>
										</select>
										</div>
										</div>
										<!--quick_product tax-->
										
									
										
										<!-- User ID
											<input id="user_id" name="user_id" type="hidden" value="" />
										<!-- User ID -->
										
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

		<!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";?>
		<!--Including Bootstrap and other scripts-->
				
		<!-- <script>
		$(function () 
		{
		//Date picker
			$('#ui_quick_product_start_date').datepicker({
				format: 'dd/mm/yyyy',
				autoclose: true
			});
		});	  

		$(function () 
		{
			//Date picker
			$('#ui_quick_product_due_date').datepicker({
				format: 'dd/mm/yyyy',
				autoclose: true
			});
		});		  
		</script>				-->
	</body>
</html>	