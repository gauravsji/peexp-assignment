<!--
Description: User Profile displays user information and some options.
Date: 04/07/2017
-->
<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";
	$email_address=$_SESSION['email_address'];
	$sql = "SELECT * FROM users where email='".$email_address."'";
	$result = mysqli_query($conn, $sql);
	$users_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
	?>
	<!--Including Login Session-->

	<head>
		<!--Including Bootstrap CSS links-->
		<?php include "../extra/header.html";?>
		<!--Including Bootstrap CSS links-->
		<script>
		$(document).ready(function()
		{
			$('#view_all_daily_log_records').change(function()
			{
				if($(this).is(":checked"))
				{
					$('#view_all_daily_log_records').val(1);
				}
				else
				{
					$('#view_all_daily_log_records').val(0);
				}
			});

			$('#view_all_meeting_records').change(function()
			{
				if($(this).is(":checked"))
				{
					$('#view_all_meeting_records').val(1);
				}
				else
				{
					$('#view_all_meeting_records').val(0);
				}
			});

			$('#view_all_sales_lead_records').change(function()
			{
				if($(this).is(":checked"))
				{
					$('#view_all_sales_lead_records').val(1);
				}
				else
				{
					$('#view_all_sales_lead_records').val(0);
				}
			});

			$('#view_all_enquiry_records').change(function()
			{
				if($(this).is(":checked"))
				{
					$('#view_all_enquiry_records').val(1);
				}
				else
				{
					$('#view_all_enquiry_records').val(0);
				}
			});


			$('#view_all_order_records').change(function()
			{
				if($(this).is(":checked"))
				{
					$('#view_all_order_records').val(1);
				}
				else
				{
					$('#view_all_order_records').val(0);
				}
			});

			$('#view_all_customer_records').change(function()
			{
				if($(this).is(":checked"))
				{
					$('#view_all_customer_records').val(1);
				}
				else
				{
					$('#view_all_customer_records').val(0);
				}
			});

			$('#view_all_product_set_records').change(function()
			{
				if($(this).is(":checked"))
				{
					$('#view_all_product_set_records').val(1);
				}
				else
				{
					$('#view_all_product_set_records').val(0);
				}
			});

			$('#view_all_product_records').change(function()
			{
				if($(this).is(":checked"))
				{
					$('#view_all_product_records').val(1);
				}
				else
				{
					$('#view_all_product_records').val(0);
				}
			});

			$('#view_all_category_records').change(function()
			{
				if($(this).is(":checked"))
				{
					$('#view_all_category_records').val(1);
				}
				else
				{
					$('#view_all_category_records').val(0);
				}
			});

			$('#view_all_sub_category_records').change(function()
			{
				if($(this).is(":checked"))
				{
					$('#view_all_sub_category_records').val(1);
				}
				else
				{
					$('#view_all_sub_category_records').val(0);
				}
			});

			$('#view_all_brand_records').change(function()
			{
				if($(this).is(":checked"))
				{
					$('#view_all_brand_records').val(1);
				}
				else
				{
					$('#view_all_brand_records').val(0);
				}
			});

			$('#view_all_vendor_records').change(function()
			{
				if($(this).is(":checked"))
				{
					$('#view_all_vendor_records').val(1);
				}
				else
				{
					$('#view_all_vendor_records').val(0);
				}
			});

			$('#view_all_task_records').change(function()
			{
				if($(this).is(":checked"))
				{
					$('#view_all_task_records').val(1);
				}
				else
				{
					$('#view_all_task_records').val(0);
				}
			});

			$('#view_all_payment_records').change(function()
			{
				if($(this).is(":checked"))
				{
					$('#view_all_payment_records').val(1);
				}
				else
				{
					$('#view_all_payment_records').val(0);
				}
			});

			$('#view_all_transport_team_records').change(function()
			{
				if($(this).is(":checked"))
				{
					$('#view_all_transport_team_records').val(1);
				}
				else
				{
					$('#view_all_transport_team_records').val(0);
				}
			});


			$('#view_all_sample_records').change(function()
			{
				if($(this).is(":checked"))
				{
					$('#view_all_sample_records').val(1);
				}
				else
				{
					$('#view_all_sample_records').val(0);
				}
			});

			$('#view_all_key_value_records').change(function()
			{
				if($(this).is(":checked"))
				{
					$('#view_all_key_value_records').val(1);
				}
				else
				{
					$('#view_all_key_value_records').val(0);
				}
			});
		});

		function myFunction()
		{
			var x = document.getElementById("snackbar")
			x.className = "show";
			setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
		}
		</script>

		<style>
		#snackbar
		{
			visibility: hidden;
			min-width: 250px;
			margin-left: -125px;
			background-color: #333;
			color: #fff;
			text-align: center;
			border-radius: 2px;
			padding: 16px;
			position: fixed;
			z-index: 1;
			left: 50%;
			bottom: 30px;
			font-size: 17px;
		}

		#snackbar.show
		{
			visibility: visible;
			-webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
			animation: fadein 0.5s, fadeout 0.5s 2.5s;
		}

		@-webkit-keyframes fadein
		{
			from {bottom: 0; opacity: 0;}
			to {bottom: 30px; opacity: 1;}
		}

		@keyframes fadein
		{
			from {bottom: 0; opacity: 0;}
			to {bottom: 30px; opacity: 1;}
		}

		@-webkit-keyframes fadeout
		{
			from {bottom: 30px; opacity: 1;}
			to {bottom: 0; opacity: 0;}
		}

		@keyframes fadeout
		{
			from {bottom: 30px; opacity: 1;}
			to {bottom: 0; opacity: 0;}
		}
		</style>
	</head>
	<body class="hold-transition skin-blue fixed sidebar-mini">
		<div class="wrapper">

			<!--Including Topbar-->
			<?php include "../extra/topbar.php";?>
			<!--Including Topbar-->

			<!--Including Left Nav Bar-->
			<?php include "../extra/left_nav_bar.php";?>
			<!--Including Left Nav Bar-->

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Main content -->
				<section class="content">
					<div class="row">
						<div class="col-md-3">
							<div class="box box-primary">
								<div class="box-body box-profile">
									<h3 class="profile-username text-center"><?php echo $users_result['name'];   ?> </h3>
									<p class="text-muted text-center"><?php echo $users_result['email'];   ?> </p>
									<ul class="list-group list-group-unbordered">
										<li class="list-group-item">
											<b>Role: </b> <a class="pull-right"><?php echo $users_result['role'];   ?></a>
										</li>
									</ul>
									<?php if($users_result['role']=="Admin")
									{
										echo ' <a href="../html/add_user_html.php" class="btn btn-primary btn-block"><b>Add New User</b></a>';
									}
									?>
								</div>
							</div>
							<div id="snackbar">Password Updated Successfully</div>
							<div class="box box-primary">
								<div class="box-header with-border">
								</div>
								<div class="box-body">
									<center><strong ><i class="fa fa-map-marker margin-r-5"></i>Location</strong></center>
									<p align="center" class="text-muted"><?php echo $users_result['location'];?>, India</p>
									<hr>
									<center><a href="../html/help_html.php"class="btn btn-primary">Help</a></center>
								</div>
							</div>
							<?php
							if($users_result['role']=="Admin")
							{
								echo '<div class="box box-primary">
								<div class="box-body">
								<form method="post" action="../php/backup.php">
								<center><button class="btn btn-primary" id="backup_database">Back Up Database</button></center>
								</form>
								<br>
								<center><a href="../html/email_settings.php?id='.$users_result['id'].'" class="btn btn-primary">Email Settings</a></center>
								</div>
								</div>';
							}
							?>
						</div>

						<div class="col-md-9">
							<div class="nav-tabs-custom">
								<ul class="nav nav-tabs">

								<?php if($users_result['role']=="Admin")
								{
								echo '<li class="active"><a href="#view_all_records_settings" data-toggle="tab">Settings</a></li>';
								echo '<li><a href="#users" data-toggle="tab">Manage Users</a></li>';
								echo ' <li><a href="#change_password" data-toggle="tab">Change Password</a></li>';
								}
								else
								{
								echo '<li class="active"><a href="#view_all_records_settings" data-toggle="tab">Settings</a></li>';
								echo ' <li><a href="#change_password" data-toggle="tab">Change Password</a></li>';
								}
								?>

								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="view_all_records_settings">
										<section class="invoice">
											<form action="../php/update/update_settings_php.php" method="post">
												<div class="row">
													<div class="col-xs-12">
														<input id="settings_id" name="settings_id"  type="hidden" value="<?php echo $settings_result['settings_id'];?>" />

														<div class="form-group col-md-9">
															View all Daily Log Details from all locations
														</div>
														<div class="form-group col-md-3">
															<input type="checkbox" name="view_all_daily_log_records" id="view_all_daily_log_records" <?php if($settings_result['view_all_daily_log']==1){echo "checked "; echo 'value="1"';} else {echo 'value="0"';}  ?> data-toggle="toggle" data-size="mini">
														</div>

														<div class="form-group col-md-9">
															View all Meeting Details from all locations
														</div>
														<div class="form-group col-md-3">
															<input type="checkbox" name="view_all_meeting_records" id="view_all_meeting_records" <?php if($settings_result['view_all_meeting']==1){echo "checked "; echo 'value="1"';} else {echo 'value="0"';}  ?> data-toggle="toggle" data-size="mini">
														</div>

														<div class="form-group col-md-9">
															View all Sales Lead from all locations
														</div>
														<div class="form-group col-md-3">
															<input type="checkbox" name="view_all_sales_lead_records" id="view_all_sales_lead_records" <?php if($settings_result['view_all_sales_lead']==1){echo "checked "; echo 'value="1"';} else { echo 'value="0"';} ?>data-toggle="toggle" data-size="mini">
														</div>

														<div class="form-group col-md-9">
															View all Enquiry Details from all locations
														</div>
														<div class="form-group col-md-3">
															<input type="checkbox" name="view_all_enquiry_records" id="view_all_enquiry_records" <?php if($settings_result['view_all_enquiry']==1){echo "checked "; echo 'value="1"'; } else {echo 'value="0"';} ?>data-toggle="toggle" data-size="mini">
														</div>

														<div class="form-group col-md-9">
															View all Order Details from all locations
														</div>
														<div class="form-group col-md-3">
															<input type="checkbox" name="view_all_order_records" id="view_all_order_records" <?php if($settings_result['view_all_sales_order']==1){echo "checked ";  echo 'value="1"'; } else {echo 'value="0"';} ?>data-toggle="toggle" data-size="mini">
														</div>

														<div class="form-group col-md-9">
															View all Customer Details from all locations
														</div>
														<div class="form-group col-md-3">
															<input type="checkbox" name="view_all_customer_records" id="view_all_customer_records" <?php if($settings_result['view_all_customer']==1){echo "checked ";  echo 'value="1"'; } else {echo 'value="0"';}  ?>data-toggle="toggle" data-size="mini">
														</div>

														<div class="form-group col-md-9">
															View all Product Set Data from all locations
														</div>
														<div class="form-group col-md-3">
															<input type="checkbox" name="view_all_product_set_records" id="view_all_product_set_records" <?php if($settings_result['view_all_product_set']==1){echo "checked "; echo 'value="1"'; } else {echo 'value="0"';}  ?>data-toggle="toggle" data-size="mini">
														</div>

														<div class="form-group col-md-9">
															View all Product Data from all locations
														</div>
														<div class="form-group col-md-3">
															<input type="checkbox" name="view_all_product_records" id="view_all_product_records" <?php if($settings_result['view_all_product']==1){echo "checked ";  echo 'value="1"';} else {echo 'value="0"';}  ?>data-toggle="toggle" data-size="mini">
														</div>

														<div class="form-group col-md-9">
															View all Category Data from all locations
														</div>
														<div class="form-group col-md-3">
															<input type="checkbox" name="view_all_category_records" id="view_all_category_records" <?php if($settings_result['view_all_category']==1){echo "checked "; echo 'value="1"'; } else {echo 'value="0"';} ?>data-toggle="toggle" data-size="mini">
														</div>

														<div class="form-group col-md-9">
															View all Sub Category Data from all locations
														</div>
														<div class="form-group col-md-3">
															<input type="checkbox" name="view_all_sub_category_records" id="view_all_sub_category_records" <?php if($settings_result['view_all_sub_category']==1){echo "checked "; echo 'value="1"'; } else {echo 'value="0"';}  ?>data-toggle="toggle" data-size="mini">
														</div>

														<div class="form-group col-md-9">
															View all Brand Data from all locations
														</div>
														<div class="form-group col-md-3">
															<input type="checkbox" name="view_all_brand_records" id="view_all_brand_records" <?php if($settings_result['view_all_brand']==1){echo "checked "; echo 'value="1"'; } else {echo 'value="0"';}  ?>data-toggle="toggle" data-size="mini">
														</div>

														<div class="form-group col-md-9">
															View all Vendor Data from all locations
														</div>
														<div class="form-group col-md-3">
															<input type="checkbox" name="view_all_vendor_records" id="view_all_vendor_records" <?php if($settings_result['view_all_vendor']==1){echo "checked "; echo 'value="1"'; } else {echo 'value="0"';}  ?>data-toggle="toggle" data-size="mini">
														</div>

														<div class="form-group col-md-9">
															View all Task Data from all locations
														</div>
														<div class="form-group col-md-3">
															<input type="checkbox" name="view_all_task_records" id="view_all_task_records" <?php if($settings_result['view_all_task']==1){echo "checked "; echo 'value="1"'; } else {echo 'value="0"';} ?>data-toggle="toggle" data-size="mini">
														</div>

														<div class="form-group col-md-9">
															View all Payment Data from all locations
														</div>
														<div class="form-group col-md-3">
															<input type="checkbox" name="view_all_payment_records" id="view_all_payment_records" <?php if($settings_result['view_all_payment']==1){echo "checked "; echo 'value="1"'; } else {echo 'value="0"';} ?>data-toggle="toggle" data-size="mini">
														</div>

														<div class="form-group col-md-9">
															View all Transport Team Data from all locations
														</div>
														<div class="form-group col-md-3">
															<input type="checkbox" name="view_all_transport_team_records" id="view_all_transport_team_records" <?php if($settings_result['view_all_transport_team']==1){echo "checked "; echo 'value="1"'; }  else {echo 'value="0"';} ?>data-toggle="toggle" data-size="mini">
														</div>

														<div class="form-group col-md-9">
															View all Sample Data from all locations
														</div>
														<div class="form-group col-md-3">
															<input type="checkbox" name="view_all_sample_records" id="view_all_sample_records" <?php if($settings_result['view_all_sample']==1){echo "checked "; echo 'value="1"'; } else {echo 'value="0"';} ?>data-toggle="toggle" data-size="mini">
														</div>

														<div class="form-group col-md-9">
															View all Key Value Data from all locations
														</div>
														<div class="form-group col-md-3">
															<input type="checkbox" name="view_all_key_value_records" id="view_all_key_value_records" <?php if($settings_result['view_key_value']==1){echo "checked "; echo 'value="1"'; } else {echo 'value="0"';} ?>data-toggle="toggle" data-size="mini">
														</div>

														<div class="form-group">
															<div class="col-sm-offset-5 col-sm-12">
																<button type="submit" value="Submit" class="btn btn-success">Update Settings</button>
															</div>
														</div>
													</div>
												</div>
											</form>
										</section>
									</div>

									<div class="tab-pane" id="users">
										<section class='invoice'>
											<div class="row">
												<div class="col-xs-12">
													<div class="row invoice-info">
														<div class="table-responsive">
															<table id="view_brand_html" class="table table-bordered">
																<thead>
																	<tr>
																	<th><center>Name</th>
																	<th><center>Email</th>
																	<th><center>Role</th>
																	<th><center>Authentication</th>
																	<th><center>Location</th>
																	<th><center>Edit</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																	$sql = "SELECT id,name,email,role,location,authenticate FROM users";
																	$result = mysqli_query($conn,$sql);
																	while ($row = mysqli_fetch_array($result))
																	{
																		// Print out the contents of the entry
																		echo '<tr>';
																		echo '<td><center>' . $row['name'] . '</center></td>';
																		echo '<td><center>' . $row['email'] . '</center></td>';
																		echo '<td><center>' . strtoupper($row['role']) . '</center></td>';
																		echo '<td><center>'; if($row['authenticate']==1) { echo "<div class='badge bg-green'>Active</div>";} else { echo "<div class='badge bg-red'>Disabled</div>";} echo '</center></td>';
																		echo '<td><center>' . $row['location'] . '</center></td>';
																		echo  "<td><center> <a href='../html/edit_user_html.php?id=" . $row['id'] . "' class='btn btn-sm btn-primary'>Edit</a></center></td>";
																	}
																	?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</section>
									</div>

									<div class="tab-pane" id="change_password">
										<form class="form-horizontal" method="post" name="form" autocomplete="off">
											<div class="form-group">
												<label for="inputName" class="col-sm-2 control-label">Old Password</label>
												<div class="col-sm-10">
													<input type="password" class="form-control" id="old_password"  autocomplete="off">
												</div>
											</div>

											<div class="form-group">
												<label for="inputName" class="col-sm-2 control-label">New Password</label>
												<div class="col-sm-10">
													<input type="password" class="form-control" id="new_password"  autocomplete="off">
												</div>
											</div>

											<div class="form-group">
												<label for="inputName" class="col-sm-2 control-label">Confirm Password</label>
												<div class="col-sm-10">
													<input type="password" class="form-control" autocomplete="off" id="confirm_password">
												</div>
											</div>

											<input type="hidden" id="user_email" name="user_email" value="<?php echo $user_result ['email']?>">

											<div class="form-group">
												<div class="col-sm-offset-2 col-sm-10">
													<input type="submit" value="Change Password" class="submit btn btn-success"/>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>

			<!--Including right slide panel-->
			<?php include "../extra/aside.php";?>
			<!--Including right slide panel-->

			<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		</div>

		<!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";?>

		<script type="text/javascript">
			$(function()
			{
				$(".submit").click(function()
				{
					var old_password = $("#old_password").val();
					var new_password = $("#new_password").val();
					var confirm_password = $("#confirm_password").val();
					var user_email = $("#user_email").val();
					var dataString = 'old_password='+ old_password + '&new_password=' + new_password + '&confirm_password=' + confirm_password+ '&user_email=' + user_email;

					if(old_password=='' || new_password=='' || confirm_password=='' || user_email=='')
					{
					}
					else
					{
						$.ajax({
							type: "POST",
							url: "../php/register_login/update_password_after_login.php",
							data: dataString,
							success: function(data)
							{
								if(data=="Password Updated")
								{
									Pace.restart();
									$("#settings").addClass("active");
									myFunction();
									$("#new_password").val('');
									$("#old_password").val('');
									$("#confirm_password").val('');
								}
								else
								{
									$("#new_password").val('');
									$("#old_password").val('');
									$("#confirm_password").val('');
									//alert(data);
									alert(data);
								}
							}
						});
					}
					return false;
				});
			});
		</script>
	</body>
</html>
