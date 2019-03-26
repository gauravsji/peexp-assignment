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
	window.onload = function()
	{
	document.getElementById('ui_project_name').disabled = true;
	};
		
	$(document).ready(function()
	{
		// Handler for .ready() called.
		$("#li_transport").addClass("active");
		$("#li_add_transport").addClass("active");
		$('#ui_transport_type').on('change', function() 
		{
			if ( this.value == 'Make transport')
			//.....................^.......
			{
				maketransport();
			}
			else  if ( this.value == 'Recieve transport')
			{
				recievetransport();
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
						Trip sheet
						<a href="../reports/Trip_sheet_report_html.php" class="btn pull-right btn-xs btn-primary">Trip sheet Report</a>
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
									<form action="../php/add/add_trip_sheet_php.php" method="post"  onsubmit="submit.disabled = true; return true;">
											
										<!--transport Type-->
										<div class="form-group col-md-3">
											<label>Transport Type</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-rupee"></i></span>
												<select name="ui_transport_type" id="ui_transport_type" class='form-control selectpicker' style='width: 100%;'>
												<option hidden selected disabled value="">Select transport Type</option>
												<option value="Recieve transport">Bike</option>
												<option value="Make transport">Passenger Auto</option>
												<option value="Make transport">Carrier Auto</option>
												<option value="Make transport">ACE Auto</option>
												<option value="Make transport">T407</option>
												<option value="Make transport">Canter</option>
												</select>
											</div>
										</div>
										<!--transport Type-->
										
										<!--transport Date-->
										<div id="ui_div_date" class="form-group col-md-3">
											<label>Date</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" readonly class="form-control pull-right"  name="ui_date" id="ui_date" value="<?php echo date("d/m/Y"); ?>">
											</div>
										</div>
										<!--transport Date-->
																				
										<!--Transporter Name-->
										<div id="ui_div_customer_name" class="form-group col-md-3">
											<label>Transporter Name</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-user"></i></span>
												<select name="ui_customer_name" id="ui_customer_name" class='form-control select2' style='width: 100%;'>
												<option selected disabled hidden value="">Select Transporter</option>
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
										<!--Transporter Name-->
										
										<!--transport Number-->
										<div id="ui_div_transport_remarks" class="form-group col-md-12">
											<label>Transporter Number</label>
											<input type="text" id="ui_transport_number" maxlength="10" name="ui_transport_number" required class="form-control" rows="5"></input>
										</div>
										<!--transport Number-->

										
										<!--transport Remarks-->
										<div id="ui_div_transport_remarks" class="form-group col-md-12">
											<label>transport Remarks</label>
											<textarea id="ui_transport_remarks" maxlength="350" name="ui_transport_remarks" required class="form-control" rows="5"></textarea>
										</div>
										<!--transport Details-->

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