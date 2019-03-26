<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";
	$sales_lead_id=$_GET["id"];
	$sql = "SELECT * FROM sales_lead where delete_status<>1 and sales_lead_id = " . $sales_lead_id;
	$result = mysqli_query($conn, $sql);
	$sales_lead_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
	?>
	<!--Including Login Session-->

	<head>
	<!--Including Bootstrap CSS links-->
	<?php include "../extra/header.html";?>
	<!--Including Bootstrap CSS links-->
	
	<script>
		$(document).ready(function()
		{
		// Handler for .ready() called.
		$("#li_enquiry").addClass("active");
		$("#li_add_sales_lead").addClass("active");
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
				Edit Sales Lead <div class="btn-toolbar pull-right">
					<a href="../html/add_sales_lead_html.php" class="btn btn-sm btn-primary">New Sales Lead</a>  
					<a href="../reports/sales_lead_report_html.php" class="btn btn-sm btn-success">Sales Lead Report</a>
					</div>
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
							<!-- general form elements disabled -->
								
									<div class="box-body">
										<form role="form" action="../php/update/update_sales_lead_php.php" method="post">
										
										<input type="hidden" id="sales_lead_id" name="sales_lead_id"  value="<?php echo $sales_lead_result['sales_lead_id'];?>"/>
										
										
											<!--Lead Name-->
											<div class="form-group col-md-4">
												<label>Lead Name</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-user"></i></span>
													<input type="text" class="form-control" placeholder="Lead Name" id="sales_lead_name" name="sales_lead_name" style="text-transform:capitalize" required value="<?php echo $sales_lead_result['sales_lead_name'];?>"/>
												</div>
											</div>
											<!--Lead Name-->
											
											<!--Contact Number-->
											<div class="form-group col-md-4">
												<label>Contact Number</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
													<input type="text" class="form-control" placeholder="Ex: 9876543210" id="sales_lead_contact_number" maxlength="50" name="sales_lead_contact_number" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?php echo $sales_lead_result['sales_lead_contact_number'];?>"/>
												</div>
											</div>
											<!--Contact Number-->
											
											<!--Email-->
											<div class="form-group col-md-4">
												<label>Email</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
													<input type="email" class="form-control" placeholder="Ex: abc@gmail.com" id="sales_lead_email" style="text-transform:lowercase"  maxlength="30" name="sales_lead_email" type="text" value="<?php echo $sales_lead_result['sales_lead_email'];?>">
												</div>
											</div>
											<!--Email-->
											
											<!--Sales Lead City-->
											<div class="form-group col-md-4">
												<label>City</label>
												<div class="radio">
													<label>
													<input type="radio" name="sales_lead_city" id="sales_lead_city" value="Bangalore" <?php if($sales_lead_result['sales_lead_city']=='Bangalore') {echo "checked";}?>/>
													Bangalore
													</label>
												</div>
												<div class="radio">
													<label>
													<input type="radio" name="sales_lead_city" id="sales_lead_city" value="Delhi" <?php if($sales_lead_result['sales_lead_city']=='Delhi') {echo "checked";}?>/>
													Delhi
													</label>
												</div>
												<div class="radio">
													<label>
													<input type="radio" name="sales_lead_city" id="sales_lead_city" <?php if($sales_lead_result['sales_lead_city']=='Other') {echo "checked";}?> value="Other"/>
													Other
													</label>
												</div>
											</div>
											<!--Sales Lead City-->
											
											
											
											<!--Firm Name-->
											<div class="form-group col-md-4">
												<label>Firm Name</label>
												<input type="text" class="form-control" placeholder="Ex: ABC" id="sales_lead_firm_name" maxlength="50" name="sales_lead_firm_name" type="text" style="text-transform:capitalize" value="<?php echo $sales_lead_result['sales_lead_firm'];?>"/>
											</div>
											<!--Firm Name-->

											
											<!--Sales Lead Reference-->
											<div class="form-group col-md-4">
												<label>Sales Lead Reference</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
													<input class="form-control" placeholder="Ex: Referenced by Ravi" id="sales_lead_reference" name="sales_lead_reference" style="text-transform:capitalize" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode==32' type="text" value="<?php echo $sales_lead_result['sales_lead_reference'];?>" />
												</div>
											</div>
											<!--Sales Lead Reference-->
											
											<!--Sales Lead Address -->
											<div class="form-group col-md-4">
												<label>Address</label>
												<textarea class="form-control" rows="3" placeholder="" id="sales_lead_address" style="text-transform:capitalize" name="sales_lead_address"><?php echo $sales_lead_result['sales_lead_address'];?></textarea>
											</div>
											<!--Sales Lead Address-->
											
											<!--Additional Info-->
											<div class="form-group col-md-4">
												<label>Additional Info</label>
												<textarea class="form-control" rows="3" id="sales_lead_additional_info" style="text-transform:capitalize" name="sales_lead_additional_info" ><?php echo $sales_lead_result['sales_lead_additional_info'];?></textarea>
											</div>
											<!--Additional Info-->
											
											<!--Status-->
											<div class="form-group col-md-3">
												<label>Status</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-star"></i></span>
													<select name="ui_sales_lead_status" id="ui_sales_lead_status" class='form-control select2' style='width: 100%;'>
													
													<?php
										{
											$sql = "SELECT * from sales_lead where delete_status<>1";
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query))
											{
												if ($row['sales_lead_id'] == $sales_lead_result['sales_lead_id']):
												{
													if ($sales_lead_result['sales_lead_status']=='Telephonic Conversation'):
													{
														echo '<option selected>Telephonic Conversation</option>';
														echo '<option>Email Conversation</option>';
														echo '<option>Meeting Scheduled</option>';	
														echo '<option>Converted To Customer</option>';
														echo '<option>Follow Up</option>';
														echo '<option>Rejected</option>';
													}
													endif;
													if ($sales_lead_result['sales_lead_status']=='Email Conversation'):
													{
														echo '<option>Telephonic Conversation</option>';
														echo '<option selected>Email Conversation</option>';
														echo '<option>Meeting Scheduled</option>';	
														echo '<option>Converted To Customer</option>';
														echo '<option>Follow Up</option>';
														echo '<option>Rejected</option>';
													}	
													endif;
													if ($sales_lead_result['sales_lead_status']=='Meeting Scheduled'):
													{
														echo '<option >Telephonic Conversation</option>';
														echo '<option>Email Conversation</option>';
														echo '<option selected>Meeting Scheduled</option>';	
														echo '<option>Converted To Customer</option>';
														echo '<option>Follow Up</option>';
														echo '<option>Rejected</option>';
													}												
													endif;
													if ($sales_lead_result['sales_lead_status']=='Converted To Customer'):
													{
														echo '<option >Telephonic Conversation</option>';
														echo '<option>Email Conversation</option>';
														echo '<option>Meeting Scheduled</option>';	
														echo '<option selected>Converted To Customer</option>';
														echo '<option>Follow Up</option>';
														echo '<option>Rejected</option>';
													}												
													endif;
													if ($sales_lead_result['sales_lead_status']=='Follow Up'):
													{
														echo '<option >Telephonic Conversation</option>';
														echo '<option>Email Conversation</option>';
														echo '<option>Meeting Scheduled</option>';	
														echo '<option>Converted To Customer</option>';
														echo '<option selected>Follow Up</option>';
														echo '<option>Rejected</option>';
													}												
													endif;	
													if ($sales_lead_result['sales_lead_status']=='Rejected'):
													{
														echo '<option >Telephonic Conversation</option>';
														echo '<option>Email Conversation</option>';
														echo '<option>Meeting Scheduled</option>';	
														echo '<option>Converted To Customer</option>';
														echo '<option>Follow Up</option>';
														echo '<option selected>Rejected</option>';
													}												
													endif;
													
													if ($sales_lead_result['sales_lead_status']==''):
													{
														echo '<option selected>Telephonic Conversation</option>';
														echo '<option>Email Conversation</option>';
														echo '<option>Meeting Scheduled</option>';	
														echo '<option>Converted To Customer</option>';
														echo '<option>Follow Up</option>';
														echo '<option>Rejected</option>';
													}												
													endif;
												}
													else:
													{
														echo "Error";
													}
												endif;
											}
										} 
										?>
													</select>
												</div>
											</div>								
											<!--Status-->
											
											<!-- User ID -->
										<input id="user_id" name="user_id" type="hidden" value="<?php echo $user_result['id'];?>"/>
										<!-- User ID -->
											
											<div class="col-lg-offset-10 col-lg-2">
												<button type="submit" data-loading-text="Please Wait..." class="btn btn-success form-control">Update  </button>
											</div>

										</form>
									</div>
								<!-- /.box-body -->
							
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

			<!-- Add the sidebar's background. This div must be placed
			immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		</div>
		<!-- Wrapper -->

		<!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";?>
		<!--Including Bootstrap and other scripts-->
	</body>
</html>