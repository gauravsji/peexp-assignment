<!--
Description: Sample Log is usd to maintain samples available and samples given to clients.
Date: 04/07/2017
-->
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
			$("#li_sample_management").addClass("active");
			$("#li_sample_log").addClass("active");

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

			<div class="content-wrapper">
				<section class="content-header">
					<h1>
						Sample Log  <a href="../reports/sample_report_html.php" class="btn btn-xs pull-right btn-primary">Sample Report</a>
					</h1>
				</section>

				<section class="content">
					<div class="row">
						<div class="col-md-12">
							<div class="box box-primary">
								<div class="box-header with-border">
								</div>
								<div class="box-body pad">
									<form action="../php/add/add_sample_log_php.php" method="post">
										<!--Date-->
										<div class="form-group col-md-3">
											<label>Date</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" readonly class="form-control pull-right" name="ui_date" id="ui_date" value="<?php echo date("d/m/Y"); ?>">
											</div>
										</div>
										<!--Date-->
										
										<!--Vendor Name-->
										<div class="form-group col-md-3">
											<label>Vendor Name</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-users"></i></span>
												<select name="ui_vendor_name" id="ui_vendor_name" class='form-control select2' style='width: 100%;'>
												<option selected disabled hidden>Select Vendor</option>
												<?php
												{
													$sql = "SELECT * from vendor where delete_status<>1";
													$query = mysqli_query($conn, $sql);
													while($row = mysqli_fetch_array($query))
													{
														echo "<option value='" . $row['vendor_id'] . "'>" . $row['vendor_name']. "</option>";
													}
												} 
												?>
												</select>
											</div>
										</div>
										<!--Vendor Name-->

										<!--Brand Name-->
										<div class="form-group col-md-3">
											<label>Brand Name</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-tag"></i></span>
												<select name="ui_brand_name" id="ui_brand_name" class='form-control select2' style='width: 100%;'>
												<option selected disabled hidden>Select Brand</option>
												<?php
												{
													$sql = "SELECT * from brand where delete_status<>1";
													$query = mysqli_query($conn, $sql);
													while($row = mysqli_fetch_array($query))
													{
													echo "<option value='" . $row['brand_id'] . "'>" . $row['brand_name']. "</option>";
													}
												} 
												?>
												</select>
											</div>
										</div>
										<!--Brand Name-->

										<!--Type-->
										<div class="form-group col-md-3">
											<label>Type</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-book"></i></span>
												<select name="ui_sample_type" id="ui_sample_type" class='form-control selectpicker' style='width: 100%;'>
													<option value="Book">Book</option>
													<option value="Sample">Sample</option>
												</select>
											</div>
										</div>
										<!--Type-->

										<!-- Status-->
										<div class="form-group col-md-3">
											<label>Status</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-info"></i></span>
												<select name="ui_sample_status" id="ui_sample_status" class='form-control select2' style='width: 100%;'>
													<option value="Recieved"> Recieved </option>
													<option value="Sent"> Sent </option>
													<option value="Lost"> Lost </option>
												</select>
											</div>
										</div>
										<!--Status-->

										<!--Description-->
										<div class="form-group col-md-9">
											<label>Description</label>
											<textarea class="form-control" rows="3" placeholder="Laminates to XYZ" id="ui_sample_description" maxlength="150" name="ui_sample_description" required></textarea>
										</div>
										<!--Description-->

										<!-- User ID -->
										<input id="user_id" name="user_id" type="hidden" value="<?php echo $user_result['id'];?>" />
										<!-- User ID -->

										<input id="location" name="location" type="hidden" value="<?php echo $user_result['location'];?>" />

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
		<script>

		$(function () 
		{
		//Date picker
		$('#ui_date').datepicker({
		format: 'dd/mm/yyyy',
		autoclose: true
		});

		});
		</script>
	</body>
</html>