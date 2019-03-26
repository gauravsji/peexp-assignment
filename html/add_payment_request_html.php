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
/*	function makepayment()
	{
		$("div#ui_div_customer_name").addClass("hidden");
		$("div#ui_div_project_name").addClass("hidden");
		$("div#ui_div_date").removeClass("hidden");
		$("div#ui_div_vendor_name").removeClass("hidden");
		$("div#ui_div_payment_request_method").removeClass("hidden");
		$("div#ui_div_amount").removeClass("hidden");
		$("div#ui_div_trans_ref_no").removeClass("hidden");
		$("div#ui_div_payment_request_remarks").removeClass("hidden");
		$("div#ui_save").removeClass("hidden");
		$("div#ui_div_quickbook_entry").removeClass("hidden");
	}

	function recievepayment()
	{
		$("div#ui_div_vendor_name").addClass("hidden");
		$("div#ui_div_date").removeClass("hidden");
		$("div#ui_div_customer_name").removeClass("hidden");
		$("div#ui_div_project_name").removeClass("hidden");
		$("div#ui_div_payment_request_method").removeClass("hidden");
		$("div#ui_div_amount").removeClass("hidden");
		$("div#ui_div_trans_ref_no").removeClass("hidden");
		$("div#ui_div_payment_request_remarks").removeClass("hidden");
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
		$('#ui_payment_request_type').on('change', function() 
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
	}); */
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
						Payment request
						<a href="../reports/payment_request_report_html.php" class="btn pull-right btn-xs btn-primary">Payment Request Report</a>
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
									<form action="../php/add/add_payment_request_php.php" method="post"  onsubmit="submit.disabled = true; return true;">
											
										<!--Payment Type-->
										<div class="form-group col-md-3">
											<label>Payment Type</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-rupee"></i></span>
												<select name="ui_payment_request_type" id="ui_payment_request_type" class='form-control selectpicker' style='width: 100%;'>
												<option selected disabled value="">Select Payment Type</option>
												<option value="goods">Goods</option>
												<option value="handling">Handling</option>
												<option value="transport">Transport</option>
												
												
												</select>
											</div>
										</div>
										<!--Payment Type-->
										
										<!--Payment Date-->
										<div id="ui_div_date" class="form-group col-md-3">
											<label>Date</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" readonly class="form-control pull-right"  name="ui_date" id="ui_date" value="<?php echo date("d/m/Y"); ?>">
											</div>
										</div>
										<!--Payment Date-->
																				
											
										<!--Vendor Name-->
										<div id="ui_div_vendor_name" class="form-group col-md-3">
											<label>Vendor Name</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-user"></i></span>
												<select name="ui_vendor_name" id="ui_vendor_name" class='form-control select2' style='width: 100%;'>
												<option selected disabled value="">Select Vendor</option>
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
										<div id="ui_div_amount"  class="form-group col-md-3">
											<label>Amount</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-rupee"></i></span>
												<input type="text" class="form-control" maxlength="9" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="ui_amount" name="ui_amount" required/>
											</div>
										</div>
										<!--Amount-->
										
										<!--Payment Urgency-->
										<div  id="ui_div_payment_request_method" class="form-group col-md-3">
											<label>Criticality</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-rupee"></i></span>
												<select name="ui_payment_request_method" id="ui_payment_request_method" class='form-control selectpicker' style='width: 100%;'>
												<option selected disabled value="">Select Level</option>
												<option value="Lava">Lava</option>
												<option value="Hot">Hot</option>
												<option value="Warm">Warm</option>
												<option value="Cold">Cold</option>
												</select>
											</div>
										</div>
										<!--Payment Urgency-->
									
										<!--Payment Method-->
										<div  id="ui_div_payment_request_method" class="form-group col-md-3">
											<label>Payment Method</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-rupee"></i></span>
												<select name="ui_payment_request_method" id="ui_payment_request_method" class='form-control selectpicker' style='width: 100%;'>
												<option selected disabled value="">Select Payment Method</option>
												<option value="Cheque">Cheque</option>
												<option value="Cash">Cash</option>
												<option value="IMPS">IMPS-Immediate</option>
												<option value="NEFT">NEFT-3 hours</option>
												</select>
											</div>
										</div>
										<!--Payment Method-->
										
										<!--Order ID-->
										<div id="ui_div_payment_request_order" class="form-group col-md-12">
										<label>Orders</label>
										<select name="ui_payment_request_order" id="ui_payment_request_order" class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" tabindex="-1" aria-hidden="true">
										<option selected disabled value="">Select Order</option>
										  <?php
												{
													$sql = "SELECT * from ss_order where delete_status<>1";
													$query = mysqli_query($conn, $sql);
													while($row = mysqli_fetch_array($query))
													{
													echo "<option value='" . $row['order_id'] . "'>" . $row['order_brief_details'].$row['order_id']."</option>";
													}
												} 
												?>
										</select><span class="select2 select2-container select2-container--default select2-container--below select2-container--focus" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1"><ul class="select2-selection__rendered"><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="textbox" aria-autocomplete="list" placeholder="Select a State" style="width: 517.5px;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
									  </div>
										<!--Order ID-->

										<!--Payment Remarks-->
										<div id="ui_div_payment_request_remarks" class="form-group col-md-12">
											<label>Payment Remarks</label>
											<textarea id="ui_payment_request_remarks" maxlength="350" name="ui_payment_request_remarks" required class="form-control" rows="5"></textarea>
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

		</script>
	</body>
</html>