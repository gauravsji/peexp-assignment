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
				$("#li_task").addClass("active");
				$("#li_add_task").addClass("active");
			
			$('#ui_category').on('change',function()
			{
				var catID = $(this).val();
				if(catID)
					{
						$.ajax(
						{
							type:'POST',
							url:'../php/ajaxData.php',
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
	</script>
	</head>
	<body class="hold-transition skin-blue fixed sidebar-mini">
		<div class="wrapper">

			<!--Including Topbar-->
			<?php include "../extra/topbar.php";?>
			<!--Including Topbar-->

			<!-- Left Side Panel Which Contains Navigation Menu -->
			<?php include "../extra/left_nav_bar.php";?>
			<!-- Left Side Panel Which Contains Navigation Menu -->

			<div class="content-wrapper">
				<section class="content-header">
					<h1>
						Add Task <div class="btn-toolbar pull-right">
						<a href="../reports/task_report_html.php" class="btn btn-primary btn-xs">Ongoing Task</a>  
						<a href="../reports/completed_task_report_html.php" class="btn btn-xs btn-success">Completed Tasks</a>
						</div>
					</h1>
				</section>

				<section class="content">
					<div class="row">
						<div class="col-md-12">
							<div class="box box-primary">
								<div class="box-header with-border">
								</div>
								<div class="box-body pad">
									<form action="../php/add/add_task_php.php" method="post" enctype="multipart/form-data" onsubmit="submit.disabled = true; return true;">
									   
										<!--Task Name-->
										<div class="form-group col-md-3">
											<label>Task Name</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-tasks"></i></span>
												<input type="text" class="form-control" placeholder="Task Name" style="text-transform:capitalize" id="ui_task_name" name="ui_task_name" maxlength="150" />
											</div>
										</div>
										<!--Task Name-->										

										<!--Assignee Name-->
										<div class="form-group col-md-3">
										 <label>Assignee Name</label>
										  <div class="input-group">
										 <span class="input-group-addon"><i class="fa fa-user"></i></span>
										<select name="ui_assignee_name" id="ui_assignee_name" class='form-control select2' style='width: 100%;'>
										<option selected disabled hidden>Select Assignee</option>
										<?php
											 {
											 $sql = "SELECT * FROM users where authenticate=1 order by name";
											 $query = mysqli_query($conn, $sql);
												 while($row = mysqli_fetch_array($query))
											{
												echo "<option value='" . $row['id'] . "'>" . $row['name']. "</option>";
											}
											} 
										?>										
										</select>
										</div>
										</div>
										<!--Assignee Name-->
										
										<!--Start Date-->
										<div class="form-group col-md-3">
											<label>Start Date</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" readonly required class="form-control pull-right" name="ui_task_start_date" id="ui_task_start_date" value="<?php echo date("d/m/Y"); ?>">
											</div>
										</div>
										<!--Start Date-->
									
										<!--Task Status-->
										<div class="form-group col-md-3">
										 <label>Status</label>
										  <div class="input-group">
										 <span class="input-group-addon"><i class="fa fa-info"></i></span>
										<select name="ui_task_status" id="ui_task_status" class='form-control select2' style='width: 100%;'>
											<option value="Ongoing"> Ongoing </option>
											<option value="Completed"> Completed </option>
											<option value="Cancelled"> Cancelled </option>
										</select>
										</div>
										</div>
										<!--Task Status-->
												
										<!--Description-->
										<div class="form-group col-md-6">
											<label>Description</label>
											<textarea class="form-control" rows="3" placeholder="Laminates to XYZ" id="ui_task_description" name="ui_task_description"></textarea>
										</div>
										<!--Description-->
										
										<!--Task Priority-->
										<div class="form-group col-md-3">
										 <label>Priority</label>
										  <div class="input-group">
										 <span class="input-group-addon"><i class="fa fa-info"></i></span>
										<select name="ui_task_priority" id="ui_task_priority" class='form-control select2' style='width: 100%;'>
											<option value="High"> High </option>
											<option value="Medium"> Medium </option>
											<option value="Low"> Low </option>
										</select>
										</div>
										</div>
										<!--Task Priority-->
										
										<!--Due Date-->
										<div class="form-group col-md-3">
											<label>Due Date</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar-check-o"></i>
												</div>
												<input type="text" readonly required class="form-control pull-right" name="ui_task_due_date" id="ui_task_due_date" value="<?php echo date("d/m/Y"); ?>">
											</div>
										</div>
										<!--Due Date-->
										
										<!--Remarks-->
										<div class="form-group col-md-12">
											<label>Remarks</label>
											<textarea class="form-control" rows="8" id="ui_task_remarks" name="ui_task_remarks"></textarea>
										</div>
										<!--Remarks-->
										
										<!-- User ID -->
											<input id="user_id" name="user_id" type="hidden" value="<?php echo $user_result['id'];?>" />
										<!-- User ID -->
										
											<!-- File Upload -->
											<div class="form-group col-md-12">
												<div id="maindiv">
												<div id="formdiv">
													<h4>Attachments</h4>
													Files types allowed: JPEG, PNG, JPG, PDF, DOC, DOCX, XLS, XLSX, Max Size: 1.5 MB.
													<hr/>												
													<div id="filediv" align="center" style="display:block"><input name="file[]" type="file" id="file"/></div><br/>
													<input type="button" id="add_more" class="upload" value="Add More Files"/>
												</div>           
											</div>
											</div>																	
											<!-- File Upload -->										
										
										<input id="location" name="location" type="hidden" value="<?php echo $user_result['location'];?>" />
											
										<div class="col-lg-offset-10 col-lg-2">
											<button type="submit" data-loading-text="Please Wait..." class="btn btn-success form-control">Save  </button>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>

			<!-- Main Footer -->
			<footer class="main-footer">
				<div class="pull-right hidden-xs">
				</div>				
			</footer>
			<!-- Main Footer -->

			<!--Including right slide panel-->
			<?php include "../extra/aside.php";?>
			<!--Including right slide panel-->
			
			<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		</div>

		<!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";?>
		<!--Including Bootstrap and other scripts-->
				
		<script>
		$(function () 
		{
		//Date picker
			$('#ui_task_start_date').datepicker({
				format: 'dd/mm/yyyy',
				autoclose: true
			});
		});	  

		$(function () 
		{
			//Date picker
			$('#ui_task_due_date').datepicker({
				format: 'dd/mm/yyyy',
				autoclose: true
			});
		});		  
		</script>				
	</body>
</html>