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
			$("#li_misc").addClass("active");
			$("#li_add_key_value").addClass("active");
			$("#ui_key_values").prop('disabled', true);
			
			$("#ui_key_column_name").change(function()
			{
			// your code here
			$("#ui_key_values").prop('disabled', false);
			});
		});
	</script>
	</head>

	<body data-spy="scroll" class="hold-transition fixed skin-blue sidebar-mini">
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
						Add Key Values
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
									<form action="../php/add/add_key_value_php.php" method="post"  onsubmit="submit.disabled = true; return true;">						   
									
										<!--Key Column Name-->
										<div class="form-group col-md-3">
											<label>Key Column Name</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-columns"></i></span>
												<select name="ui_key_column_name" id="ui_key_column_name" class='form-control select2' style='width: 100%;'>
												<option selected disabled hidden>Select Key </option>
												<?php
												{
													$sql = "SELECT DISTINCT key_column FROM key_value;";
													$query = mysqli_query($conn, $sql);
													while($row = mysqli_fetch_array($query))
													{
														echo "<option value='" . $row['key_column'] . "'>" . $row['key_column']. "</option>";
													}
												} 
												?>
												</select>
											</div>
										</div>
										<!--Key Column Name-->										
										
										<!--Key Values-->
										<div class="form-group col-md-3" id="div_value">
										 <label>Key Values</label>
										  <div class="input-group">
										 <span class="input-group-addon"><i class="fa fa-columns"></i></span>
										  <input type="text" class="form-control" style="text-transform:capitalize" id="ui_key_values" name="ui_key_values" maxlength="100"/>
										</div>
										</div>
										<!--Key Values-->
																			
										<span id="name_status"></span>
																	
										
										<input id="location" name="location" type="hidden" value="<?php echo $user_result['location'];?>"/>
																			
										<div class="col-lg-offset-10 col-lg-2">
											<button type="submit" data-loading-text="Please Wait..." class="btn btn-success form-control">Save</button>
										</div>

									</form>
								</div>
							</div>
							<!-- /.box -->
						</div>
						<!--/.col (left) -->
					</div>
					<!-- /.row -->
					
					<div class="callout bg-orange" style="margin-bottom: 0!important;">
						<h4>Note:</h4>
						Red color while entering value indicates that the value already exists, green indicates you are good to go. Please do not enter value if the input box is red in color. Entering wrong data is subjected to great errors. System will have an eye on you. 
					</div>
				
				
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
	</body>
	
	<script>
	
		$('input#ui_key_values').bind("change paste keyup input",function() 
		{ 
		// handle events here
		checkname();
		});
		
		
		function checkname()
		{
		var ui_key_values = $("#ui_key_values");		
		if(ui_key_values.val() == "")
		{
			$("#div_value").removeClass("has-error");  
			$("#div_value").removeClass("has-success");
		}
		
			var name=document.getElementById("ui_key_values" ).value;
			var key=document.getElementById("ui_key_column_name" ).value;

			if(name)
			{
				$.ajax({
					type: 'post',
					url: '../php/check_key_value_data.php',
					data: 
					{
					user_name:name,
					key:key,
					},
					success: function (response) 
					{
						$( '#name_status' ).html(response);
						if(response=="OK")	
						{
							return true;	
						}
						else
						{
							return false;	
						}
					}
				});
			}
			else
			{
				$( '#name_status' ).html("");
				return false;
			}
		}
	</script>
	
</html>