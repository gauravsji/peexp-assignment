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

			<!-- Left Side Panel Which Contains Navigation Menu -->
			<?php include "../extra/left_nav_bar.php";?>
			<!-- Left Side Panel Which Contains Navigation Menu -->			

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">			

			<!-- Main content -->
			<section class="content">
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<!-- general form elements -->
						<div class="box box-primary">
							<!-- /.box-header -->
							<div class="box-body pad">
								<form action="../php/add/add_user_php.php" method="post" onsubmit="submit.disabled = true; return true;">
									<!--Name-->
									<div class="form-group col-md-3">
										<label>Name</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
											<input type="text" class="form-control" placeholder="Rahul" id="ui_name" required maxlength="60" name="ui_name"/>
										</div>
									</div>
									<!--Name-->

									<!--Email-->
									<div class="form-group col-md-3">
										<label>Email</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
											<input type="email" class="form-control" required placeholder="Ex: abc@gmail.com" id="ui_user_email"  maxlength="50" name="ui_user_email" type="text">
										</div>
									</div>
									<!--Email-->

									<!--Role-->
									<div class="form-group col-md-3">
										<label>Role</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-user-secret "></i></span>
											<select name="ui_user_role" id="ui_user_role" required class='form-control select2' style='width: 100%;'>
												<option selected disabled hidden value="">Select Role</option>
												<option value="Admin">Admin</option>											
												<option value="Accounts">Accounts</option>
												<option value="Business Development">Business Development</option>
												<option value="Operations">Operations</option>
												<option value="Intern">Intern</option>
												<option value="transport">Transport</option>
											</select>
										</div>
									</div>
									<!--Role-->

									<!--Location-->
									<div class="form-group col-md-3">
										<label>Location</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-map-marker "></i></span>
											<select name="ui_user_location" id="ui_user_location" required class='form-control select2' style='width: 100%;'>
												<option selected disabled hidden value="">Select Location</option>
												<option value="Bangalore">Bangalore</option>
												<option value="Gurgaon">Gurgaon</option>
												<option value="Other">Other</option>
											</select>
										</div>
									</div>
									<!--Location-->
									
									<!--Phone Number-->
									<div class="form-group col-md-3">
										<label>Phone Number</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
											<input type="text" class="form-control" placeholder="Ex: 9376235763" id="ui_user_phone_number" maxlength="60" name="ui_user_phone_number"/>
										</div>
									</div>
									<!--Phone Number-->
									
									<!--Alternate Phone Number-->
									<div class="form-group col-md-3">
										<label>Alternate Phone Number</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
											<input type="text" class="form-control" placeholder="Ex: 9324356763" id="ui_user_alternate_phone_number" maxlength="60" name="ui_user_alternate_phone_number"/>
										</div>
									</div>
									<!--Alternate Phone Number-->
									
									<!--Date of Join-->
									<div class="form-group col-md-3">
										<label>Date of Join</label>
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" readonly class="form-control pull-right" name="ui_user_date_of_join" value="<?php echo date("d/m/Y"); ?>" id="ui_user_date_of_join"/>
										</div>
									</div>
									<!--Date of Join-->
									
									<!--Date Of Birth-->
									<div class="form-group col-md-3">
										<label>Date Of Birth</label>
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" readonly class="form-control pull-right" name="ui_user_date_of_birth" value="<?php echo date("d/m/Y"); ?>" id="ui_user_date_of_birth"/>
										</div>
									</div>
									<!--Date Of Birth-->
									
									<!--User Address-->
									<div class="form-group col-md-6">
										<label>Address</label>
										<textarea class="form-control" rows="3" placeholder="Ex: XYZ Udupi" id="ui_user_address" name="ui_user_address"></textarea>
									</div>
									<!--User Address-->

									<div class="col-lg-offset-10 col-lg-2">
										<button type="submit" data-loading-text="Please Wait..." class="submit btn btn-success form-control">Save  </button>
									</div>
								</form>
								<div id="snackbar">User Data Added Successfully</div>
							</div>
						</div>
					<!-- /.box -->
					</div>
				<!--/.col (left) -->
				</div>
				<!-- /.row -->

				<div class="callout bg-orange" style="margin-bottom: 0!important;">
					<h4>Note:</h4>
					Initial password will be 123456789 by default user can change it after his first login.
				</div>
			</section>
			</div>
			<!-- /.content-wrapper -->

			<!--Including right slide panel-->
			<?php include "../extra/aside.php";?>
			<!--Including right slide panel-->
			
			<!-- Add the sidebar's background. This div must be placed
		   immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		</div>
		<!-- ./wrapper -->

		
		<script type="text/javascript">
		$(function() 
		{
			
			//Date picker
			$('#ui_user_date_of_birth').datepicker
			({
				format: 'dd/mm/yyyy',
				autoclose: true
			});			
			
			//Date picker
			$('#ui_user_date_of_join').datepicker
			({
				format: 'dd/mm/yyyy',
				autoclose: true
			});
			
			$(".submit").click(function() 
			{
				var name = $("#ui_name").val();
				var email = $("#ui_user_email").val();
				var role = $("#ui_user_role").val();
				var location = $("#ui_user_location").val();
				
				var phone_number = $("#ui_user_phone_number").val();				
				var alternate_phone_number = $("#ui_user_alternate_phone_number").val();
				var date_of_join = $("#ui_user_date_of_join").val();
				var date_of_birth = $("#ui_user_date_of_birth").val();
				var address = $("#ui_user_address").val();
				
				var dataString = 'name='+ name + '&email=' + email + '&role=' + role + '&location=' + location + '&phone_number=' + phone_number + '&alternate_phone_number=' + alternate_phone_number + '&date_of_join=' + date_of_join  + '&date_of_birth=' + date_of_birth  + '&address=' + address;

				if(name=='' || email=='' || role=='' || location=='' || phone_number=='')
				{
				alert("Fields Mandatory");
				}
				else
				{
					$.ajax({
					type: "POST",
					url: "../php/register_login/add_user.php",
					data: dataString,
					success: function(data)
					{
						if(data=="User Data Successfully Added")
						{
							Pace.restart();						
							myFunction();
							$("#ui_name").val('');
							$("#ui_user_email").val('');
							$("#ui_user_role").val('');
							$("#ui_user_location").val('');
							$("#ui_user_phone_number").val('');
							$("#ui_user_alternate_phone_number").val('');
							$("#ui_user_date_of_join").val('');
							$("#ui_user_date_of_birth").val('');
							$("#ui_user_address").val('');
						}
						else
						{
							$("#ui_name").val('');
							$("#ui_user_email").val('');
							$("#ui_user_role").val('');
							$("#ui_user_location").val('');
							$("#ui_user_phone_number").val('');
							$("#ui_user_alternate_phone_number").val('');
							$("#ui_user_date_of_join").val('');
							$("#ui_user_date_of_birth").val('');
							$("#ui_user_address").val('');
							alert(data);
						}
					}
					});
				}
				return false;
			});
		});
		</script>

		<!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";?>			
	</body>
</html>