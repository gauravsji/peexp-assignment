<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php
	include "../../extra/session.php";
	include "../../constants.php";
		$customer_id=$_GET["id"];
		$sql = "SELECT * FROM customer where delete_status<>1 and customer_id = " . $customer_id;
		$result = mysqli_query($conn, $sql);
		$customer_result = mysqli_fetch_array($result,MYSQLI_ASSOC);

		$sql4 = "SELECT * FROM contacts where delete_status<>1 and contact_module_id = " . $customer_id." and contact_module_name='Customer'";
		$contacts_result = mysqli_query($conn, $sql4);
	?>
	<!--Including Login Session-->

	<head>
	<!--Including Bootstrap CSS links-->
	<?php include "../../extra/header.html";?>
	<!--Including Bootstrap CSS links-->

	<script>
	function get_category_details()
	{
	  selectedValue = '<?php echo $customer_result['category'];?>';
	  $.ajax(
	  {
	    type:'POST',
	    url:'../../php/get/get_category_php.php',
	    data: { category_values: selectedValue},
	    success:function(result)
	    {
	      $('#ui_category_name').html(result);
	    },
	    error:function(error)
	    {
	      console.log(error);
	    }
	  });
	}

	$(document).ready(function()
	{
		  get_category_details();
	// Handler for .ready() called.
		$("#li_users").addClass("active");
	});
	$('input#category_name').bind("change paste keyup input",function()
	{
	// handle events here
	checkname_category();
	});


	function checkname_category()
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
	      url: '../../php/check_category_name_data.php',
	      data:
	      {
	      user_name:name,
	      },
	      success: function (response)
	      {
	        $( '#name_status_category' ).html(response);
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
	    $( '#name_status_category' ).html("");
	    return false;
	  }
	}
	</script>
	</head>

	<body class="hold-transition skin-blue fixed sidebar-mini">
		<div class="wrapper">

		<!--Including Topbar-->
		<?php include "../../extra/topbar.php";?>
		<!--Including Topbar-->

		<!-- Left Side Panel Which Contains Navigation Menu -->
		<?php include "../../extra/left_nav_bar.php";?>
		<!-- Left Side Panel Which Contains Navigation Menu -->

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
				Edit User
			<div class="btn-toolbar pull-right">
				<a href=".$GLOBALS['add_user_html']." class="btn btn-sm btn-primary">New User</a>
					<a href=".$GLOBALS['report_user']." class="btn btn-sm btn-success">User Report</a>
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
										<form role="form" action="../../php/update/update_user_php.php" enctype="multipart/form-data" method="post" onsubmit="submit.disabled = true; return true;">

											<input type="hidden" name="customer_id" id="customer_id" value="<?php echo $customer_result['customer_id'];  ?>"/>
											<!--Customer Name-->
											<div class="form-group col-md-6">
												<label>User Name</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-user"></i></span>
													<input type="text" class="form-control" placeholder="User Name" style="text-transform:capitalize" id="customer_name" name="customer_name" value="<?php echo $customer_result['customer_name'];?>" required/>
												</div>
											</div>
											<!--Customer Name-->

											<!--Contact Number-->
											<div class="form-group col-md-3">
												<label>Contact Number</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
													<input type="text" class="form-control" placeholder="Ex: 9876543210" id="contact_number" maxlength="50" name="contact_number" type="text" value="<?php echo $customer_result['customer_contact_number'];?>" onkeypress='return event.charCode>= 48 && event.charCode <= 57'/>
												</div>
											</div>
											<!--Contact Number-->
											<div class="form-group col-md-3">
												<label>Category Name</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-archive"></i></span>
													<select name="ui_category_name[]" id="ui_category_name" required class='form-control select2' style='width: 100%;' multiple>
	                        </select>
	                        <span id="span_add_project" class="input-group-addon" style="cursor: pointer;" data-toggle="modal" data-target="#add_category_modal"><i class="fa fa-plus"></i></span>
												</div>
											</div>

											<!--Email-->
											<div class="form-group col-md-6">
												<label>Email</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
													<input type="email" class="form-control" placeholder="Ex: abc@gmail.com" style="text-transform:lowercase" id="customer_email"  maxlength="100" name="customer_email" type="email" value="<?php echo $customer_result['customer_email'];  ?>">
												</div>
											</div>
											<!--Email-->

											<div class="form-group col-md-6">
												<label>Select Role</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-user"></i></span>
													<select name="ui_customer_role" id="ui_customer_role" class='form-control select2' style='width: 100%;'>
														<option selected disabled hidden value="0">Select Role</option>
														<?php
															if($customer_result['role'] == "user_user")
															{
																echo '<option value="user" id="idUser" selected>User</option>';
																echo '<option value="admin" id="idRole">Admin</option>';
															}
															elseif($customer_result['role'] == "user_admin") {
																echo '<option value="admin" id="idRole" selected>Admin</option>';
																echo '<option value="user" id="idUser" >User</option>';
															}
															else {
																echo '<option value="admin" id="idRole">Admin</option>';
																echo '<option value="user" id="idUser" >User</option>';
															}

														?>


													</select>
												</div>
											</div>





											<!-- User ID -->
								<input id="user_id" name="user_id" type="hidden" value="<?php echo $user_result['id'];?>"/>
								<!-- User ID -->



											<div class="col-lg-offset-10 col-lg-2">
												<button type="submit" data-loading-text="Please Wait..." class="btn btn-success form-control">Update  </button>
											</div>

										</form>
									</div>
								<!-- /.box-body -->
								<!-- /.box-body -->
								<div id="add_category_modal" class="modal fade" role="dialog">
					  		  <div class="modal-dialog">
					  			<!-- Modal content-->
					  			<div class="modal-content">
					  			  <div class="modal-header">
					  				<button type="button" class="close" data-dismiss="modal">&times;</button>
					  				<h4 class="modal-title">Add New Category</h4>
					  			  </div>
					  			  <div class="modal-body">
					  				 <form role="form" id="project" name="project" method="post">
										 <div class="form-group col-md-12" id="div_category_name">
 											<label>Category Name</label>
 											<div class="input-group">
 												<span class="input-group-addon"><i class="fa fa-server"></i></span>
 												<input type="text" class="form-control" placeholder="Category Name" id="category_name" style="text-transform:capitalize" name="category_name"/>
 											</div>
 										</div>
 										<!--Category Name-->

 										<span id="name_status_category"></span>

 										<!--Category Description-->
 										<div class="form-group col-md-12">
 											<label>Description</label>
 											<textarea class="form-control" rows="3" placeholder="Ex: XYZ" id="category_description" name="category_description"></textarea>
 										</div>
 										<!--Category Description-->
					  					<!--Save-->
					  					<div class="form-group">
					  						<button class="btn btn-success" type="button"  onclick="add_category_modal();" id="submit">Save</button>
					  					</div>

					  				</form>
					  			  </div>
					  			  <div class="modal-footer">

					  				<button id="submit" type="submit" id="close_project_modal" name="close_project_modal"class="btn btn-default pull-right" data-dismiss="modal">Close</button>
					  			  </div>
					  			</div>

					  		  </div>
					  		</div>
							</div>
						</div>
						<script>
						function add_category_modal()
						{
							console.log("entered into category block");
							var category_name= $("#category_name").val();
							var category_description= $("#category_description").val();
							var location= $("#location").val();
							var user_id = $('#user_id').val();
							$.ajax({
								type: 'post',
								url: '../../php/add/add_category_php.php',
								data:
								{
								user_id:user_id,
								location:location,
								category_name:category_name,
								category_description:category_description
								},
								success: function (response)
								{
									$("#add_category_modal .close").click();
									$('#category_name').val('');
									$('#category_description').val('');
									get_category_details();
								}
							});
						}
						</script>

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
			<?php include "../../extra/aside.php";?>
			<!--Including right slide panel-->

			<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		</div>
		<!-- Wrapper -->

		<!--Including Bootstrap and other scripts-->
		<?php include "../../extra/footer.html";?>
		<!--Including Bootstrap and other scripts-->
	</body>
</html>
