<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";
		$email_address=$_SESSION['email_address'];
		$sql = "SELECT * FROM users where email='".$email_address."'";
		$result = mysqli_query($conn, $sql);
		$users_result = mysqli_fetch_array($result,MYSQLI_ASSOC);

		if($users_result['role']<>'Admin')
		{
		header("Location:../html/user_profile_html.php?id=".$_GET["id"]."");
		}

		$sql2 = "SELECT * FROM email_settings where email_settings_id = " . $_GET["id"];
		$result2 = mysqli_query($conn, $sql2);
		$edit_email_settings_result = mysqli_fetch_array($result2,MYSQLI_ASSOC);
	?>
	<!--Including Login Session-->

	<head>
		<!--Including Bootstrap CSS links-->
		<?php include "../extra/header.html";?>
		<!--Including Bootstrap CSS links-->
		<script>

		function mouseoverPass(obj) 
		{
			var obj = document.getElementById('ui_email_password');
			obj.type = "text";
		}
		function mouseoutPass(obj) 
		{
			var obj = document.getElementById('ui_email_password');
			obj.type = "password";
		}
	
		</script>


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
								<div class="box box-primary">
									<div class="box-header with-border">
									</div>
									<div class="box-body">
										<center><strong ><i class="fa fa-map-marker margin-r-5"></i> Location</strong></center>
										<p align="center" class="text-muted"><?php echo $users_result['location'];?>, India</p>
										<hr>
										<center><a href="../html/help_html.php"class="btn btn-primary">Help</a></center>
									</div>
								</div>

								<?php if($users_result['role']=="Admin")
								{  
									echo '<div class="box box-primary">
									<div class="box-body">
									<form method="post" action="../php/backup.php">
									<center><button class="btn btn-primary" id="backup_database">Back Up Database</button></center>
									</form>
									<br>
									<center><a href="../html/email_settings.php" class="btn btn-primary">Email Settings</a></center>
									</div>
									</div>';
								}
								?>
							</div>
							<div class="col-md-9">
								<div class="nav-tabs-custom">
									<section class="content">
										<div class="row">
											<div class="col-md-12">
												<div class="box box-primary">
													<div class="box-header with-border">
													</div>
													<div class="box-body pad">	
													<form method="POST" action="../php/update/update_email_settings.php">
													
														<!--Email Settings Id-->
														<input type="hidden" id="ui_email_settings_id" value="<?php echo $edit_email_settings_result['email_settings_id'] ?>"  name="ui_email_settings_id" />
														<!--Email Settings Id-->
														
														<!--Module Name-->
														<div class="form-group col-md-6">
															<label>Name</label>
															<div class="input-group">
																<span class="input-group-addon"><i class="fa fa-user"></i></span>
																<input type="text" class="form-control" autocomplete="off" readonly id="ui_module_name" value="<?php echo $edit_email_settings_result['email_module'] ?>" required name="ui_module_name" />
															</div>
														</div>
														<!--Module Name-->

														<!--Email-->
														<div class="form-group col-md-6">
															<label>Email</label>
															<div class="input-group">
																<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
																<input type="text" class="form-control" autocomplete="off" id="ui_email_address" value="<?php echo $edit_email_settings_result['email_address'] ?>" name="ui_email_address" />
															</div>
														</div>
														<!--Email-->

														<!--Host-->
														<div class="form-group col-md-6">
															<label>Host</label>
															<div class="input-group">
																<span class="input-group-addon"><i class="fa fa-houzz "></i></span>
																<input type="text" class="form-control" autocomplete="off" id="ui_email_host" value="<?php echo $edit_email_settings_result['email_host'] ?>" name="ui_email_host" />
															</div>
														</div>
														<!--Host-->

														<!--Password-->
														<div class="form-group col-md-6">
															<label>Password</label>
															<div class="input-group">
																<span class="input-group-addon"><i class="fa fa-key"></i></span>
																<input type="password" class="form-control" autocomplete="off" id="ui_email_password" onmouseover="mouseoverPass();"  onchange="mouseoverPass();" onmouseout="mouseoutPass();" value="<?php echo $edit_email_settings_result['email_password'] ?>" name="ui_email_password" />
															</div>
														</div>
														<!--Password-->	

														<!--Subject-->
														<div class="form-group col-md-12">
															<label>Email Subject</label>
															<div class="input-group">
																<span class="input-group-addon"><i class="fa fa-hashtag"></i></span>
																<input type="text" class="form-control" autocomplete="off" id="ui_email_subject" value="<?php echo $edit_email_settings_result['email_subject'] ?>" name="ui_email_subject" />
															</div>
														</div>
														<!--Subject-->														

														<!--Email Body-->
														<div class="form-group col-md-9">
															<label>Email Body</label>
															<div class="input-group">
																<span class="input-group-addon"><i class="fa fa-envelope-open-o"></i></span>
																<textarea class="form-control" rows="5" autocomplete="off" id="ui_email_body" name="ui_email_body"><?php echo $edit_email_settings_result['email_body'] ?></textarea> 																
															</div>
														</div>
														<!--Port-->
														
														<!--Port-->
														<div class="form-group col-md-3">
															<label>Port</label>
															<div class="input-group">
																<span class="input-group-addon"><i class="fa fa-terminal"></i></span>
																<input type="text" class="form-control" autocomplete="off" id="ui_email_port" value="<?php echo $edit_email_settings_result['email_port'] ?>" name="ui_email_port" />
															</div>
														</div>
														<!--Port-->

														<div class="col-lg-offset-10 col-lg-2">
															<button type="submit" data-loading-text="Please Wait..." class="submit btn btn-success form-control">Update</button>
														</div>
														</form>
													</div>       
												</div>                            
											</div>                            
										</div> 
										<div class="callout bg-orange" style="margin-bottom: 0!important;">
												<h4>Note:</h4>
												Do not play around here, it may mess up sending purchase order or estimate. 
												</div>
									</section>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>

		<!--Including right slide panel-->
		<?php include "../extra/aside.php";?>
		<!--Including right slide panel-->
		
		<!-- Add the sidebar's background. This div must be placed
		immediately after the control sidebar -->
		<div class="control-sidebar-bg"></div>
		</div>

		<!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";?>		
	</body>
</html>