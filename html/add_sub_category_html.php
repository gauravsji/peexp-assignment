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
					<h1>
					Add Sub Category 
					<a href="../reports/sub_category_report_html.php" class="btn pull-right btn-xs btn-primary">Sub Category Report</a>
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
									<form action="../php/add/add_sub_category_php.php" method="post" onsubmit="return fn_sub_category_exists();">
									   
										<!--Category Name-->
										<div class="form-group col-md-3">
										 <label>Category Name</label>
										  <div class="input-group">
										 <span class="input-group-addon"><i class="fa fa-server"></i></span>
										<select name="ui_category" id="ui_category" class='form-control select2' style='width: 100%;'>
											<option selected disabled hidden>Select Category</option>
												<?php
													 {
													 $sql = "SELECT * FROM category where delete_status<>1";
													 $query = mysqli_query($conn, $sql);
														 while($row = mysqli_fetch_array($query))
													{
														echo "<option value='" . $row['category_id'] . "'>" . $row['category_name']. "</option>";
													}
													} 
													?>
										</select>
										</div>
										</div>
										<!--Category Name-->										
										
										<!--Sub Category Name-->
										<div class="form-group  col-md-9" id="div_sub_category_name">
										 <label>Sub Category Name</label>
										  <div class="input-group">
										 <span class="input-group-addon"><i class="fa fa-clone"></i></span>
										  <input type="text" class="form-control" placeholder="Sub Category Name" id="ui_sub_category_name" name="ui_sub_category_name" style="text-transform:capitalize" maxlength="50" />
										</div>
										</div>
										<!--Sub Category Name-->

										<span id="name_status"></span>
										
										<!--Description-->
										<div class="form-group  col-md-12">
											<label>Description</label>
											<textarea class="form-control" rows="3" placeholder="Ex: CenturyPly IS:710 Marine Grade ply" id="ui_sub_category_description" name="ui_sub_category_description"></textarea>
										</div>									
										<!--Description-->
										
										<!-- User ID -->
											<input id="user_id" name="user_id" type="hidden" value="<?php echo $user_result['id'];?>" />
										<!-- User ID -->
												
										<input id="location" name="location" type="hidden" value="<?php echo $user_result['location'];?>" />

										<div class="col-lg-offset-10 col-lg-2">
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
		
		
		<script type="text/javascript">
		$(document).ready(function()
		{
			// Handler for .ready() called.
				$("#li_product").addClass("active");
				$("#li_add_sub_category").addClass("active");
			
			$('#ui_category').on('change',function()
			{
				var catID = $(this).val();
				if(catID)
					{
						$.ajax(
						{
							type:'POST',
							url:'../php/get_data/get_subcategory.php',
							data: { p_Category: catID,p_Subcategory:''},
							success:function(html)
							{
								$('#ui_sub_category').html(html);
							}
						}); 
					}
					else
					{
						$('#ui_sub_category').html('<option value="">Select category first</option>');
					}
			});
		});
		
		
			$('input#ui_sub_category_name').bind("change paste keyup input",function() 
{ 
		// handle events here
		checkname();
		});


		function checkname()
		{
		var ui_sub_category_name = $("#ui_sub_category_name");
		if(ui_sub_category_name.val() == "")
		{
			$("#div_sub_category_name").removeClass("has-error");  
			$("#div_sub_category_name").removeClass("has-success");
		}
		
			var name=document.getElementById("ui_sub_category_name" ).value;
			var key=document.getElementById("ui_category" ).value;

			if(name)
			{
				$.ajax({
					type: 'post',
					url: '../php/check_sub_category_name_data.php',
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
		
		function fn_sub_category_exists()
		{
			if($("#div_sub_category_name").hasClass("has-error"))
			{
				alert("Sub Category for selected category already exists");				
				return false;
			}
		}
		
		</script>
	</body>
</html>