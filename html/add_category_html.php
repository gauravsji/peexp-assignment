<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";?>
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

		<!-- Left Side Panel Which Contains Navigation Menu -->
		<?php include "../extra/left_nav_bar.php";?>
		<!-- Left Side Panel Which Contains Navigation Menu -->

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>Add Category 
						<a href="../reports/category_report_html.php" class="btn pull-right btn-xs btn-primary">Category Report</a>
					</h1>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="row">
						<!-- left column -->
						<div class="col-md-12">
							<!-- general form elements -->
							<div class="box box-primary">
								<!-- /.box-header -->
								<div class="box-body pad">
									<form action="../php/add/add_category_php.php" method="post"  onsubmit="return fn_category_exists();">
									
										<!--Category Name-->
										<div class="form-group col-md-12" id="div_category_name">
											<label>Category Name</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-server"></i></span>
												<input type="text" class="form-control" placeholder="Category Name" id="category_name" style="text-transform:capitalize" name="category_name"/>
											</div>
										</div>
										<!--Category Name-->
										
										<span id="name_status"></span>

										<!--Category Description-->
										<div class="form-group col-md-12">
											<label>Description</label>
											<textarea class="form-control" rows="3" placeholder="Ex: XYZ" id="category_description" name="category_description"></textarea>
										</div>
										<!--Category Description-->
										
										<!--Location-->
										<input id="location" name="location" type="hidden" value="<?php echo $user_result['location'];?>" />
										<!--Location-->
										
										<!-- User ID -->
										<input id="user_id" name="user_id" type="hidden" value="<?php echo $user_result['id'];?>" />
										<!-- User ID -->

										<!--Save-->
										<div class="col-lg-offset-10 col-lg-2">
											<button type="submit" data-loading-text="Please Wait..." class="btn btn-success form-control">Save  </button>
										</div>
										<!--Save-->
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
		</div>	
		
		<!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";?>
		<!--Including Bootstrap and other scripts-->
		
		
		<script>
		$(document).ready(function()
		{
			// Handler for .ready() called.
			$("#li_product").addClass("active");
			$("#li_add_category").addClass("active");
		});
		
		$('input#category_name').bind("change paste keyup input",function() 
		{ 
		// handle events here
		checkname();
		});


		function checkname()
		{
		var ui_category_name = $("#category_name");
		if(ui_category_name.val() == "")
		{
			$("#div_category_name").removeClass("has-error");  
			$("#div_category_name").removeClass("has-success");
		}
		
			var name=document.getElementById("category_name" ).value;

			if(name)
			{
				$.ajax({
					type: 'post',
					url: '../php/check_category_name_data.php',
					data: 
					{
					user_name:name,
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
		
		function fn_category_exists()
		{
			if($("#div_category_name").hasClass("has-error"))
			{
				alert("Category Name Already Exists");				
				return false;
			}
		}
		</script>
		</body>
</html>