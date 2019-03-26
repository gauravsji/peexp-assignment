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
	function makepayment()
	{
		$("div#ui_div_customer_name").addClass("hidden");
		$("div#ui_div_project_name").addClass("hidden");
		$("div#ui_div_date").removeClass("hidden");
		$("div#ui_div_vendor_name").removeClass("hidden");
		$("div#ui_div_payment_method").removeClass("hidden");
		$("div#ui_div_amount").removeClass("hidden");
		$("div#ui_div_trans_ref_no").removeClass("hidden");
		$("div#ui_div_payment_remarks").removeClass("hidden");
		$("div#ui_save").removeClass("hidden");
		$("div#ui_div_quickbook_entry").removeClass("hidden");
	}

	function recievepayment()
	{
		$("div#ui_div_vendor_name").addClass("hidden");
		$("div#ui_div_date").removeClass("hidden");
		$("div#ui_div_customer_name").removeClass("hidden");
		$("div#ui_div_project_name").removeClass("hidden");
		$("div#ui_div_payment_method").removeClass("hidden");
		$("div#ui_div_amount").removeClass("hidden");
		$("div#ui_div_trans_ref_no").removeClass("hidden");
		$("div#ui_div_payment_remarks").removeClass("hidden");
		$("div#ui_save").removeClass("hidden");
		$("div#ui_div_quickbook_entry").removeClass("hidden");
	}
	window.onload = function()
	{
	document.getElementById('ui_project_name').disabled = true;
	};
		
	$(document).ready(function()
	{
		// Handler for .ready() called.
		$("#li_payment").addClass("active");
		$("#li_add_payment").addClass("active");
		$('#ui_payment_type').on('change', function() 
		{
			if ( this.value == 'Make Payment')
			//.....................^.......
			{
				makepayment();
			}
			else  if ( this.value == 'Recieve Payment')
			{
				recievepayment();
			}
		});

		$('#ui_customer_name').on('change',function()
		{
			document.getElementById("ui_project_name").disabled=false;
			var catID = $(this).val();
			if(catID)
			{
				$.ajax(
				{
				type:'POST',
				url:'../php/ajax_customer_data.php',
				data: { customer_id: catID,project_id:''},
				success:function(html)
				{
					$('#ui_project_name').html(html);
				}
				}); 
			}
			else
			{
				$('#ui_project_name').html('<option value="">Select Project</option>');
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
					<h1>
						Payment
						<a href="../reports/payment_report_html.php" class="btn pull-right btn-xs btn-primary">Payment Report</a>
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
									<form action="../php/add/add_payment_php.php" method="post"  onsubmit="submit.disabled = true; return true;">
											
										<!--Payment Type-->
										<div class="form-group col-md-3">
											<label>Payment Type</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-rupee"></i></span>
												<select name="ui_payment_type" id="ui_payment_type" class='form-control selectpicker' style='width: 100%;'>
												<option hidden selected disabled value="">Select Payment Type</option>
												<option value="Recieve Payment">Recieve Payment</option>
												<option value="Make Payment">Make Payment</option>
												
												</select>
											</div>
										</div>
										<!--Payment Type-->
										
										<!--Payment Date-->
										<div id="ui_div_date" class="hidden form-group col-md-3">
											<label>Date</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" readonly class="form-control pull-right"  name="ui_date" id="ui_date" value="<?php echo date("d/m/Y"); ?>">
											</div>
										</div>
										<!--Payment Date-->
																				
										<!--Customer Name-->
										<div id="ui_div_customer_name" class="hidden form-group col-md-3">
											<label>Customer Name</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-user"></i></span>
												<select name="ui_customer_name" id="ui_customer_name" class='form-control select2' style='width: 100%;'>
												<option selected disabled hidden value="">Select Customer</option>
												<?php
												{
													$sql = "SELECT * from customer where delete_status<>1 and location='".$user_result['location']."'";
													$query = mysqli_query($conn, $sql);
													while($row = mysqli_fetch_array($query))
													{
													echo "<option value='" . $row['customer_id'] . "'>" . $row['customer_name']. "</option>";
													}
												} 
												?>
												</select>
											</div>
										</div>
										<!--Customer Name-->

										<!--Project Name-->
										<div id="ui_div_project_name" class="hidden form-group col-md-3">
											<label>Project Name</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
												<select name="ui_project_name" id="ui_project_name" class='form-control select2' style='width: 100%;'>
												<option selected disabled hidden value="">Select Customer</option>												
												</select>
											</div>
										</div>
										<!--Project Name-->
																	
										<!--Vendor Name-->
										<div id="ui_div_vendor_name" class="hidden form-group col-md-3">
											<label>Vendor Name</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-user"></i></span>
												<select name="ui_vendor_name" id="ui_vendor_name" class='form-control select2' style='width: 100%;'>
												<option selected disabled hidden value="">Select Vendor</option>
												<?php
												{
													$sql = "SELECT * from vendor where delete_status<>1  and location='".$user_result['location']."'";
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
									
										<!--Amount-->
										<div id="ui_div_amount"  class="hidden form-group col-md-3">
											<label>Amount</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-rupee"></i></span>
												<input type="text" class="form-control" maxlength="9" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="ui_amount" name="ui_amount" required/>
											</div>
										</div>
										<!--Amount-->
									
										<!--Payment Method-->
										<div  id="ui_div_payment_method" class="hidden form-group col-md-3">
											<label>Payment Method</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-rupee"></i></span>
												<select name="ui_payment_method" id="ui_payment_method" class='form-control selectpicker' style='width: 100%;'>
												<option selected disabled hidden value="">Select Payment Method</option>
												<option value="Cheque">Cheque</option>
												<option value="Cash">Cash</option>
												<option value="IMPS">IMPS</option>
												<option value="RTGS">RTGS</option>
												<option value="NEFT">NEFT</option>
												</select>
											</div>
										</div>
										<!--Payment Method-->
								
										<!--Transaction Reference Number-->
										<div id="ui_div_trans_ref_no" class="hidden form-group col-md-3">
											<label>Transaction Reference Number</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-info"></i></span>
												<input type="text" class="form-control" maxlength="50" class="form-control"  id="ui_transaction_reference_number" name="ui_transaction_reference_number">
											</div>
										</div>
										<!--Transaction Reference Number-->
													
										<!-- Quickbook Updated -->
										<div id="ui_div_quickbook_entry" class=" hidden form-group col-md-3">											
											<label>
												Quickbook Updated <div class="input-group"><input type="checkbox" value="1" name="ui_quickbook_entry" id="ui_quickbook_entry">
												</div>
											</label>											
										</div>
										<!--Quickbook Updated-->
										
										<!--Payment Remarks-->
										<div id="ui_div_payment_remarks" class="form-group hidden col-md-12">
											<label>Payment Remarks</label>
											<textarea id="ui_payment_remarks" maxlength="350" name="ui_payment_remarks" required class="form-control" rows="5"></textarea>
										</div>
										<!--Payment Details-->

										<!-- User ID -->
										<input id="user_id" name="user_id" type="hidden" value="<?php echo $user_result['id'];?>" />
										<!-- User ID -->

										<input id="location" name="location" type="hidden" value="<?php echo $user_result['location'];?>" />
									
										<div id="ui_save" class=" hidden col-lg-offset-10 col-lg-2">
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

		<!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";?>
		<!--Including Bootstrap and other scripts-->
		
		<script>
		$(function () 
		{
			//Date picker
			$('#ui_date').datepicker
			({
			format: 'dd/mm/yyyy',
			autoclose: true
			});
		});	

		function showStuff() 
		{
			document.getElementById("dd").style.display = 'none';
		}
		</script>
	</body>
</html>