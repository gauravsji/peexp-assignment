 <!DOCTYPE html>
<html>
<!--Including Login Session-->
<?php include "../extra/session.php";
$ss_task_id=$_GET["id"];
$sql = "SELECT * FROM task where task_id = " . $ss_task_id;
$result = mysqli_query($conn, $sql);
$task_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
?>
<!--Including Login Session-->

<head>
    <!--Including Bootstrap CSS links-->
    <?php include "../extra/header.html";?>
    <!--Including Bootstrap CSS links-->

	<!--This jquery needed for getting subcategory -->
	<script src="../dist/js/jquery.min.js"></script>
	<!--This jquery needed for getting subcategory -->

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

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>Edit Task  <div class="btn-toolbar pull-right">
					<a href="../html/add_task_html.php" class="btn btn-sm btn-primary">New Task</a>  
					<a href="../reports/task_report_html.php" class="btn btn-sm btn-success">Task Report</a>
					</div>  </h1>
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
                                <form action="../php/update/update_task_php.php" enctype="multipart/form-data" method="post">
                                   
								   <!--task ID-->
									<input name="task_id" id="task_id" type="hidden" value="<?php echo $ss_task_id;?>">
									<!--task ID-->
								
									<!--Task Name-->
									<div class="form-group col-md-3">
									 <label>Task Name</label>
									  <div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-tasks"></i></span>
									  <input type="text" class="form-control" placeholder="Task Name" style="text-transform:capitalize" id="ui_task_name" name="ui_task_name" maxlength="70" value="<?php echo $task_result['task_name'];  ?>"/>
									</div>
									</div>
									<!--Task Name-->									
										
									<!--Assignee Name-->
									<div class="form-group col-md-3">
									 <label>Assignee Name</label>
									  <div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-user"></i></span>
									<select name="ui_assignee_name" id="ui_assignee_name" class='form-control select2' style='width: 100%;'>
									
									<?php
										{
											$sql = "SELECT id, name from users where authenticate=1 order by name";
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query))
											{
												if ($row['id'] == $task_result['task_assignee']):
												{
												echo "<option value='" . $row['id'] . "' selected>" . $row['name']. "</option>";
												}
												else:
												{
													echo "<option value='" . $row['id'] . "'>" . $row['name']. "</option>";
												}
												endif;
											}
										} 
										?>
								
										</select>
									</div>
									</div>
									<!--Assignee Name-->
														
									<!--Date-->
									<div class="form-group col-md-3">
										<label>Date</label>
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" readonly class="form-control pull-right" name="ui_task_start_date" id="ui_task_start_date" value="<?php echo date('d/m/Y', strtotime($task_result['task_start_date']));  ?>">
										</div>
									</div>
									<!--Date-->
								
									<!--Task Status-->
									<div class="form-group col-md-3">
									 <label>Status</label>
									  <div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-info"></i></span>
									<select name="ui_task_status" id="ui_task_status" class='form-control select2' style='width: 100%;'>	
									<?php
										{
											$sql1 = "SELECT * from task";
											$query1 = mysqli_query($conn, $sql1);
											while($row = mysqli_fetch_array($query1))
											{
												if ($row['task_id'] == $task_result['task_id']):
												{
													if ($task_result['task_status']=='Ongoing'):
													{
														echo '<option value="Ongoing" selected>Ongoing</option>';
														echo '<option value="Completed">Completed</option>';
														echo '<option value="Cancelled">Cancelled</option>';
													}	
													endif;
													if ($task_result['task_status']=='Completed'):
													{
														echo '<option value="Ongoing" >Ongoing</option>';
														echo '<option value="Completed" selected>Completed</option>';
														echo '<option value="Cancelled">Cancelled</option>';
													}	
													endif;
													if ($task_result['task_status']=='Cancelled'):
													{
														echo '<option value="Ongoing" >Ongoing</option>';
														echo '<option value="Completed" >Completed</option>';
														echo '<option value="Cancelled" selected>Cancelled</option>';
													}	
													endif;													
													if ($task_result['task_status']==''):
													{
														echo '<option value="Ongoing" >Ongoing</option>';
														echo '<option value="Completed" >Completed</option>';
														echo '<option value="Cancelled">Cancelled</option>';
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
									<!--Task Status-->
											
									<!--Description-->
									<div class="form-group col-md-6">
										<label>Description</label>
										<textarea class="form-control" rows="3" placeholder="Laminates to XYZ" id="ui_task_description" name="ui_task_description" required><?php echo $task_result['task_description'];?></textarea>
									</div>
									<!--Description-->
									
									<!--Task Priority-->
									<div class="form-group col-md-3">
									 <label>Priority</label>
									  <div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-info"></i></span>
									<select name="ui_task_priority" id="ui_task_priority" class='form-control select2' style='width: 100%;'>	
									<?php
										{
											$sql1 = "SELECT * from task where delete_status<>1";
											$query1 = mysqli_query($conn, $sql1);
											while($row = mysqli_fetch_array($query1))
											{
												if ($row['task_id'] == $task_result['task_id']):
												{
													if ($task_result['task_priority']=='High'):
													{
														echo '<option value="High" selected>High</option>';
														echo '<option value="Medium">Medium</option>';
														echo '<option value="Low">Low</option>';
													}	
													endif;
													if ($task_result['task_priority']=='Medium'):
													{
														echo '<option value="High" >High</option>';
														echo '<option value="Medium" selected>Medium</option>';
														echo '<option value="Low">Low</option>';
													}	
													endif;
													if ($task_result['task_priority']=='Low'):
													{
														echo '<option value="High" >High</option>';
														echo '<option value="Medium" >Medium</option>';
														echo '<option value="Low" selected>Low</option>';												
													}	
													endif;													
													if ($task_result['task_priority']==''):
													{
														echo '<option value="High" >High</option>';
														echo '<option value="Medium" >Medium</option>';
														echo '<option value="Low">Low</option>';
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
									<!--Task Status-->
									
									
									<!--Due Date-->
									<div class="form-group col-md-3">
										<label>Due Date</label>
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar-check-o"></i>
											</div>
											<input type="text" readonly class="form-control pull-right" name="ui_task_due_date" id="ui_task_due_date" value="<?php echo date('d/m/Y', strtotime($task_result['task_due_date']));  ?>">
										</div>
									</div>
									<!--Due Date-->
									
									<!--Remarks-->
									<div class="form-group col-md-12">
										<label>Remarks</label>
										<textarea class="form-control" rows="8" id="ui_task_remarks" name="ui_task_remarks"><?php echo $task_result['task_remarks'];?></textarea>
									</div>
									<!--Remarks-->									
									
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
										
								   <div class="col-lg-offset-10 col-lg-2">
										<button type="submit" data-loading-text="Please Wait..." class="btn btn-success form-control">Update  </button>
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