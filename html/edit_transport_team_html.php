<!DOCTYPE html>
<html>
<!--Including Login Session-->
<?php include "../extra/session.php";
$transport_team_id=$_GET["id"];
$sql = "SELECT * FROM transport_team where transport_team_id = " . $transport_team_id;
$result = mysqli_query($conn, $sql);
$transport_team_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
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
			$("#li_transport").addClass("active");
			$("#li_add_transport_team").addClass("active");
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
                <h1>Edit Transport Team  <div class="btn-toolbar pull-right">
					<a href="../html/add_transport_team_html.php" class="btn btn-sm btn-primary">New Transport Team</a>  
					<a href="../reports/transport_team_report_html.php" class="btn btn-sm btn-success">Transport Team Report</a>
					</div> </h1>
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
                                <form action="../php/update/update_transport_team_php.php" method="post">
										
										<!--Transport Person Name-->
										<input type="hidden" name="ui_transport_team_id" id="ui_transport_team_id" value="<?php echo $transport_team_result['transport_team_id'] ?>">
										<!--Transport Person Name-->
										
										<!--Transport Person Name-->
										<div class="form-group col-md-3">
											<label>Transport Person Name</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-user"></i></span>
												<input type="text" required class="form-control" placeholder="Transport Person Name" id="ui_transport_person_name" name="ui_transport_person_name" maxlength="70" value="<?php echo $transport_team_result['transport_team_person_name'] ?>"/>
											</div>
										</div>
										<!--Transport Person Name-->

										<!--Contact Number-->
										<div class="form-group col-md-3">
											<label>Contact Number</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
												<input type="text" required class="form-control" maxlength="14" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Ex: 9838392929" id="ui_transport_contact_number" name="ui_transport_contact_number" value="<?php echo $transport_team_result['transport_team_contact_number'] ?>">
											</div>
										</div>
										<!--Contact Number-->

										<!--Alternate Contact Number-->
										<div class="form-group col-md-3">
											<label>Alternate Contact Number</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
												<input type="text" class="form-control" maxlength="14" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Ex: 9823232929" id="ui_transport_alternate_contact_number" name="ui_transport_alternate_contact_number" value="<?php echo $transport_team_result['transport_team_alternate_contact_number'] ?>">
											</div>
										</div>
										<!--Alternate Contact Number-->

										<!--Company Name-->
										<div class="form-group col-md-3">
											<label>Company Name</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-building"></i></span>
												<input type="text" class="form-control" placeholder="Company Name" id="ui_company_name" name="ui_company_name" maxlength="70" value="<?php echo $transport_team_result['transport_team_company_name'] ?>"/>
											</div>
										</div>
										<!--Company Name-->

										<!--Transport Vehicle Name-->
										<div class="form-group col-md-3">
											<label>Transport Vehicle Name</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-user"></i></span>
												<input type="text" class="form-control" placeholder="Transport Vehicle Name" id="ui_transport_vehicle_name" name="ui_transport_vehicle_name" maxlength="70" value="<?php echo $transport_team_result['transport_team_vehicle_name'] ?>" />
											</div>
										</div>
										<!--Transport Vehicle Name-->

										<!--Vehicle Number-->
										<div class="form-group col-md-3">
											<label>Vehicle Number</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-motorcycle"></i></span>
												<input type="text" class="form-control" placeholder="KA 20 EK 1096" id="ui_vehicle_number" name="ui_vehicle_number"  style="text-transform:uppercase" maxlength="70" value="<?php echo $transport_team_result['transport_team_vehicle_number'] ?>"/>
											</div>
										</div>
										<!--Vehicle Number-->

										<!--Load Capacity-->
										<div class="form-group col-md-3">
											<label>Load Capacity</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
												<input type="text" class="form-control" placeholder="2 Ton" id="ui_load_capacity" name="ui_load_capacity" maxlength="70" value="<?php echo $transport_team_result['transport_team_load_capacity'] ?>" />
											</div>
										</div>
										<!--Load Capacity-->

										<!--Vehicle Type-->
										<div class="form-group col-md-3">
											<label>Vehicle Type</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-truck"></i></span>
												<select name="ui_vehicle_type" id="ui_vehicle_type" class='form-control selectpicker' style='width: 100%;'>
												
												<?php
										{
											$sql = "SELECT * from transport_team where delete_status<>1";
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query))
											{
												if ($row['transport_team_id'] == $transport_team_result['transport_team_id']):
												{
													if ($transport_team_result['transport_team_vehicle_type']=='Carrier Auto'):
													{
														echo '<option value="Carrier Auto" selected>Carrier Auto</option>';
														echo '<option value="Bike">Bike</option>';
														echo '<option value="Passenger Auto">Passenger Auto</option>';
														echo '<option value="Heavy Carrier">Heavy Carrier</option>';	
													}
													endif;
													if ($transport_team_result['transport_team_vehicle_type']=='Bike'):
													{
														echo '<option value="Carrier Auto" >Carrier Auto</option>';
														echo '<option value="Bike" selected>Bike</option>';
														echo '<option value="Passenger Auto">Passenger Auto</option>';
														echo '<option value="Heavy Carrier">Heavy Carrier</option>';
													}	
													endif;
													if ($transport_team_result['transport_team_vehicle_type']=='Passenger Auto'):
													{
														echo '<option value="Carrier Auto" >Carrier Auto</option>';
														echo '<option value="Bike">Bike</option>';
														echo '<option value="Passenger Auto" selected>Passenger Auto</option>';
														echo '<option value="Heavy Carrier">Heavy Carrier</option>';
													}
													endif;
													if ($transport_team_result['transport_team_vehicle_type']=='Heavy Carrier'):
													{
														echo '<option value="Carrier Auto" >Carrier Auto</option>';
														echo '<option value="Bike">Bike</option>';
														echo '<option value="Passenger Auto">Passenger Auto</option>';
														echo '<option value="Heavy Carrier" selected>Heavy Carrier</option>';
													}													
													else:
													{
														echo "Error";
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
										<!--Vehicle Type-->
										
										<!--Email-->
											<div class="form-group col-md-6">
												<label>Email</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
													<input type="email" class="form-control" placeholder="Ex: abc@gmail.com" id="transport_team_email"  maxlength="30" name="transport_team_email" type="text" value="<?php echo $transport_team_result['transport_team_email'] ?>" >
												</div>
											</div>
											<!--Email-->
										
										
										<!--Additional Info-->
											<div class="form-group col-md-6">
												<label>Additional Info</label>
												<textarea class="form-control" rows="4" id="transport_team_additional_info" name="transport_team_additional_info" ><?php echo $transport_team_result['transport_team_additional_info'] ?></textarea>
											</div>
											<!--Additional Info-->
										
																	
								<div class="col-lg-offset-10 col-lg-2">
								<button type="submit" data-loading-text="Please Wait..." class="btn btn-success form-control">Update  </button>
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
</body>
</html>