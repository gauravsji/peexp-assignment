<!DOCTYPE html>
<html>
<!--Including Login Session-->
<?php include "../extra/session.php";
$email_address=$_SESSION['email_address'];
$sql = "SELECT * FROM users where email='".$email_address."'";
$result = mysqli_query($conn, $sql);
$users_result = mysqli_fetch_array($result,MYSQLI_ASSOC);

$sql2 = "SELECT location,name,id,email,role,phone_number,alternate_phone_number,address,date_of_join,date_of_resign,date_of_birth,authenticate FROM users where id = " . $_GET["id"];
$result2 = mysqli_query($conn, $sql2);
$edit_user_result = mysqli_fetch_array($result2,MYSQLI_ASSOC);
?>
<!--Including Login Session-->

<head>
    <!--Including Bootstrap CSS links-->
    <?php include "../extra/header.html";?>
    <!--Including Bootstrap CSS links-->
	<script>
	
	
	$(document).ready(function()
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
#snackbar {
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

#snackbar.show {
    visibility: visible;
    -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
    animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
    from {bottom: 0; opacity: 0;} 
    to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
    from {bottom: 0; opacity: 0;}
    to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
    from {bottom: 30px; opacity: 1;} 
    to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
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

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <!--<img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">-->

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
              <!--<a href="#" class="btn success btn-primary btn-block" ><b>SDJKB</b></a>-->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		<div id="snackbar">Password Updated Successfully</div>
          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
				
              <center><strong ><i class="fa fa-map-marker margin-r-5"></i> Location</strong></center>

              <p align="center" class="text-muted"><?php echo $users_result['location'];   ?>, India</p>

              <hr>
			  <center><a href="../html/help_html.php"class="btn btn-primary">Help</a></center>
            </div>
            <!-- /.box-body -->
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
          <!-- /.box -->
        </div>
        <!-- /.col -->
		 <a href="../html/user_profile_html.php" class="btn btn-primary btn-block pull-right" style="width: 155px;margin-right: 30px;margin-bottom: 10px;"><b>Back to Manage Users</b></a>
        <div class="col-md-9">
          <div class="nav-tabs-custom">


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
 
								<input type="hidden" class="form-control" id="ui_user_id" value="<?php echo $edit_user_result['id'] ?>" name="ui_user_id" />
								
								<!--User Name-->
								<div class="form-group col-md-6">
								<label>Name</label>
								<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user"></i></span>
								<input type="text" class="form-control" autocomplete="off" id="ui_user_name" value="<?php echo $edit_user_result['name'] ?>" required name="ui_user_name" />
								</div>
								</div>
								<!--User Name-->

								<!--Email-->
								<div class="form-group col-md-6">
								<label>Email</label>
								<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
								<input type="text" class="form-control" autocomplete="off" id="ui_user_email" value="<?php echo $edit_user_result['email'] ?>" required name="ui_user_email" />
								</div>
								</div>
								<!--Email-->
								
								<!--Role-->
									<div class="form-group col-md-6">
										<label>Role</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
											<select name="ui_user_role" id="ui_user_role" required class='form-control select2' style='width: 100%;'>												
											<?php										
											{
											$sql = "SELECT id,role from users";
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query))
											{
												if ($row['id'] == $edit_user_result['id']):
												{
													if($edit_user_result['role']=='Admin'):
													{
														echo '<option value="Admin" selected>Admin</option>';
														echo '<option value="Accounts">Accounts</option>';
														echo '<option value="Business Development">Business Development</option>';
														echo '<option value="Operations">Operations</option>';
														echo '<option value="Intern">Intern</option>';
														
													}
													elseif ($edit_user_result['role']=='Accounts'):
													{
														echo '<option value="Admin">Admin</option>';
														echo '<option value="Accounts" selected>Accounts</option>';
														echo '<option value="Business Development">Business Development</option>';
														echo '<option value="Operations">Operations</option>';
														echo '<option value="Intern">Intern</option>';
													}
													elseif ($edit_user_result['role']=='Business Development'):
													{
														echo '<option value="Admin">Admin</option>';
														echo '<option value="Accounts">Accounts</option>';
														echo '<option value="Business Development" selected>Business Development</option>';
														echo '<option value="Operations">Operations</option>';
														echo '<option value="Intern">Intern</option>';
													}
													elseif ($edit_user_result['role']=='Operations'):
													{
														echo '<option value="Admin">Admin</option>';
														echo '<option value="Accounts">Accounts</option>';
														echo '<option value="Business Development">Business Development</option>';
														echo '<option value="Operations" selected>Operations</option>';
														echo '<option value="Intern">Intern</option>';
													}	
													elseif ($edit_user_result['role']=='Intern'):
													{
														echo '<option value="Admin">Admin</option>';
														echo '<option value="Accounts">Accounts</option>';
														echo '<option value="Business Development">Business Development</option>';
														echo '<option value="Operations">Operations</option>';
														echo '<option value="Intern" selected>Intern</option>';
													}															
													else:
													{
														echo '<option selected disabled hidden value="">Select Role</option>';
														echo '<option value="Admin">Admin</option>';
														echo '<option value="Accounts">Accounts</option>';
														echo '<option value="Business Development">Business Development</option>';
														echo '<option value="Operations">Operations</option>';
														echo '<option value="Intern">Intern</option>';
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
									<!--Role-->
									
									
								<!--Location-->
									<div class="form-group col-md-6">
										<label>Location</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-map-marker "></i></span>
											<select name="ui_user_location" id="ui_user_location" required class='form-control select2' style='width: 100%;'>												
											<?php										
											{
											$sql = "SELECT id,location from users";
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query))
											{
												if ($row['id'] == $edit_user_result['id']):
												{
													if ($edit_user_result['location']=='Bangalore'):
													{
														echo '<option value="Bangalore" selected>Bangalore</option>';
														echo '<option value="Gurgaon">Gurgaon</option>';
														echo '<option value="Other">Other</option>';
													}
													elseif ($edit_user_result['location']=='Gurgaon'):
													{
														echo '<option value="Bangalore" >Bangalore</option>';
														echo '<option value="Gurgaon" selected>Gurgaon</option>';
														echo '<option value="Other">Other</option>';
													}		
													elseif ($edit_user_result['location']=='Other'):
													{
														echo '<option value="Bangalore" >Bangalore</option>';
														echo '<option value="Gurgaon">Gurgaon</option>';
														echo '<option value="Other" selected>Other</option>';
													}
													else:
													{
														echo '<option selected disabled hidden value="">Select Location</option>';
														echo '<option value="Bangalore">Bangalore</option>';
														echo '<option value="Gurgaon">Gurgaon</option>';
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
									<!--Location-->
									
									<!--Phone Number-->
									<div class="form-group col-md-6">
									<label>Phone Number</label>
									<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
									<input type="text" class="form-control" autocomplete="off" id="ui_user_phone_number" value="<?php echo $edit_user_result['phone_number'] ?>"  name="ui_user_phone_number" />
									</div>
									</div>
									<!--Phone Number-->
									
									<!--Alternate Phone Number-->
									<div class="form-group col-md-6">
									<label>Alternate Phone Number</label>
									<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
									<input type="text" class="form-control" autocomplete="off" id="ui_user_alternate_phone_number" value="<?php echo $edit_user_result['alternate_phone_number'] ?>"  name="ui_user_alternate_phone_number" />
									</div>
									</div>
									<!--Alternate Phone Number-->
								
								
									<!--Date of Join-->
									<div class="form-group col-md-4">
										<label>Date of Join</label>
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" readonly class="form-control pull-right" name="ui_user_date_of_join" id="ui_user_date_of_join" value="<?php echo date('d/m/Y', strtotime($edit_user_result['date_of_join']));  ?>">
										</div>
									</div>
									<!--Date of Join-->	
									
									<!--Date of Birth-->
									<div class="form-group col-md-4">
										<label>Date of Birth</label>
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" readonly class="form-control pull-right" name="ui_user_date_of_birth" id="ui_user_date_of_birth" value="<?php echo date('d/m/Y', strtotime($edit_user_result['date_of_birth']));  ?>">
										</div>
									</div>
									<!--Date of Birth-->	
									
									<!--Authenticate-->
									<div class="form-group col-md-4">
										<label>Authenticate</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-lock "></i></span>
											<select name="ui_authenticate" id="ui_authenticate" class='form-control select2' style='width: 100%;'>												
											<?php										
											{
											$sql = "SELECT id,authenticate from users";
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query))
											{
												if ($row['id'] == $edit_user_result['id']):
												{
													if ($edit_user_result['authenticate']=='1'):
													{
														echo '<option value="1" selected>Activated</option>';
														echo '<option value="0">Disable</option>';
														
													}
													elseif ($edit_user_result['authenticate']=='0'):
													{
														echo '<option value="1" >Activate</option>';
														echo '<option value="0" selected>Disabled</option>';
													}															
													else:
													{
														echo '<option selected disabled hidden value="">Authentication</option>';
														echo '<option value="1">Active</option>';
														echo '<option value="0">Disable</option>';
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
									<!--Authenticate-->
									
									<!--Address-->
									<div class="form-group col-md-12">
									<label>Address</label>
									<textarea id="ui_user_address" name="ui_user_address" required class="form-control" rows="5"><?php echo $edit_user_result['address'];?></textarea>
									</div>
									<!--Address-->
								
								
									<div class="col-lg-offset-10 col-lg-2">
                                    <button type="submit" data-loading-text="Please Wait..." class="submit btn btn-success form-control">Update</button>
									</div>
									
									
							</div>       



							
							</div>                            
							</div>                            
							</div> 
							</section>
							
		  
		  
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

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

   <!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";?>
		
		
		

<script type="text/javascript">
$(function() {
$(".submit").click(function() {
var ui_user_id = $("#ui_user_id").val();
var name = $("#ui_user_name").val();
var email = $("#ui_user_email").val();
var role = $("#ui_user_role").val();
var location = $("#ui_user_location").val();
var authenticate = $("#ui_authenticate").val();
var phone_number = $("#ui_user_phone_number").val();				
var alternate_phone_number = $("#ui_user_alternate_phone_number").val();
var date_of_join = $("#ui_user_date_of_join").val();
var date_of_birth = $("#ui_user_date_of_birth").val();
var address = $("#ui_user_address").val();
				

var dataString = 'ui_user_id='+ ui_user_id + '&name=' + name + '&email=' + email + '&role=' + role + '&location=' + location + '&phone_number=' + phone_number + '&alternate_phone_number=' + alternate_phone_number + '&date_of_join=' + date_of_join  + '&date_of_birth=' + date_of_birth  + '&authenticate=' + authenticate +'&address=' + address;

if(name=='' || email=='' || role=='' || location=='' || phone_number=='')
{
//$('.success').fadeOut(200).hide();
//$('.error').fadeOut(200).show();
alert("Fields Mandatory");
}
else
{
$.ajax({
type: "POST",  
url: "../php/register_login/update_user.php",
data: dataString,
success: function(data)
{
	if(data=="Data Added")
	{
	Pace.restart();
	}
	else
	{
	$("#new_password").val('');
	$("#old_password").val('');
	$("#confirm_password").val('');
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