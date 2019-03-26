<!DOCTYPE html>
<html>
	<!-- Including Login Session -->
	<?php include "../extra/session.php";?>
	<!-- Including Login Session -->
	<head>
		<!-- Including Bootstrap CSS Links -->
		<?php include "../extra/header.html";?>
		<!-- Including Bootstrap CSS Links -->
	</head>
	<body class="hold-transition skin-blue fixed sidebar-mini">
		<div class="wrapper">
			<!-- Including Top Bar -->
			<?php include "../extra/topbar.php";?>
			<!-- Including Top Bar -->

			<!-- Including Left Nav Bar -->
			<?php include "../extra/left_nav_bar.php";?>
			<!-- Including Left Nav Bar -->

			<!-- Start Of Content Wrapper, Contains Page Content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>Add Daily Log 
						<div class="btn-toolbar pull-right">
						<a href="../html/add_daily_log_html.php" class="btn btn-xs btn-primary">New Log</a>  
						<a href="../reports/daily_log_report_html.php" class="btn btn-xs btn-success">Daily Log Report</a>
						</div> 
					</h1>					
				</section>
				<!-- Content Header (Page header) -->
				
				<!-- Main Content -->
				<section class="content">
					<!-- Start of Row -->
					<div class="row">
						<!-- Start of Define Width of Div -->
						<div class="col-md-12">
							<!-- General Form Elements -->
							<div class="box box-primary">
								<!-- Box Body -->
								<div class="box-body pad">									
										<!-- Daily Log Textarea -->
										<div class="box-body pad">
											<textarea id="daily_log" name="daily_log"  rows="15" cols="80"></textarea>
										</div>
										<!-- Daily Log Textarea -->
										
										<!-- Location -->
										<input id="location" name="location" type="hidden" value="<?php echo $user_result['location'];?>"/>
										<!-- Location -->
										
										<!-- User ID -->
										<input id="user_id" name="user_id" type="hidden" value="<?php echo $user_result['id'];?>"/>
										<!-- User ID -->
										
										<div class="col-lg-offset-5 col-lg-2">		
											<div id="autoSave" style="padding-left:15px; color:orange;"></div>
										</div>
										
										<!-- Save -->
										<div class="col-lg-offset-3 col-lg-2">										
											<input type="hidden" name="post_id" id="post_id" /> 
											<button data-loading-text="Please Wait..." id="save_btn" class="btn btn-success form-control">Save</button>
										</div>
										<!-- Save -->										
								</div>
								<!-- Box Body -->
							</div>
							<!-- General Form Elements -->
						</div>
						<!-- End of Define Width of Div -->
					</div>
					<!-- End of Row -->
				</section>
				<!-- Main Content -->
			</div>
			<!-- End of Content Wrapper, Contains Page Content -->

			<!-- Main Footer -->
			<footer class="main-footer">
				<div class="pull-right hidden-xs">
				</div>				
			</footer>
			<!-- Main Footer -->

			<!--Including right slide panel-->
			<?php include "../extra/aside.php";?>
			<!--Including right slide panel-->
			
			<!-- Add the sidebar's background this div must be placed immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
			<!-- Add the sidebar's background this div must be placed immediately after the control sidebar -->
		</div>
		<!-- End Of Content Wrapper, Contains Page Content -->

		<!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";?>
		<!--Including Bootstrap and other scripts-->
		
		<script>
		$(function () 
		{
			//Get CK Editor Add On
			CKEDITOR.replace('daily_log');		
		});
		</script>
	
		<script>
		$(document).ready(function()
		{
			//Handler for .ready() called.
			$("#li_daily_operations").addClass("active");
			$("#li_add_daily_log").addClass("active");
			$('#save_btn').click(function() 
			{
				autoSavedata()  ;
			});

			function autoSavedata()  
			{   
				var daily_log = CKEDITOR.instances['daily_log'].getData();// $('textarea.daily_log').val();
				var location = $('#location').val(); 
				var user_id = $('#user_id').val();  
				var post_id = $('#post_id').val();  
				if(daily_log!= '')  
				{  
					$.ajax({  
					url:"../php/add/add_daily_log.php",  
					method:"POST",  
					data:{ daily_log:daily_log, location:location, user_id:user_id, post_id:post_id},                      
					success:function(data)  
					{  							 
						if(data!='')  
						{ 
							$('#post_id').val(data);  
						}  
						$('#autoSave').text("Data Saved");  
						setInterval(function()
						{  
						$('#autoSave').text('');  
						}, 3000);  
					}  
					});  
				}            
			}  
			setInterval(function(){   
			autoSavedata();   
			}, 20000);  
		});
		</script>	
	</body>
</html>