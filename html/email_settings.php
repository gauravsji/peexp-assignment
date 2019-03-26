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
										<center><strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong></center>
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
									<center><a href="../html/email_settings.php?id='.$users_result['id'].'" class="btn btn-primary">Email Settings</a></center>
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
														<div class="table-responsive">
															<table class="table table-bordered">
															<thead>
															<th><center>FOR</center></th>
															<th><center>From Email</center></th>
															<th><center>Host</center></th>
															<th><center>Password</center></th>
															<th><center>Port</center></th>
															<th><center>Edit</center></th>
															</thead>
															<tbody>
																<?php
																$sql = "SELECT * from email_settings";
																$result = mysqli_query($conn,$sql);
																while ($row = mysqli_fetch_array($result))
																{
																	// Print out the contents of the entry
																	echo '<tr>';
																	echo '<td><center>' . $row['email_module'] . '</center></td>';
																	echo '<td><center>' . $row['email_address'] . '</center></td>';
																	echo '<td><center>' . $row['email_host'] . '</center></td>';
																	echo '<td><center>**************</center></td>';
																	echo '<td><center>' . $row['email_port'] . '</center></td>';																	
																	echo  "<td><center> <a href='../html/edit_email_settings_html.php?id=" . $row['email_settings_id'] . "' class='btn btn-sm btn-primary'>Edit</a></center></td>";
																}
																?>
															</tbody>
															</table>
														</div>
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