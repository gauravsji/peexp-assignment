<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";?>
	<!--Including Login Session-->
	<head>
		<!--Including Bootstrap CSS links-->
		<?php include "../extra/header.html";?>
		<!--Including Bootstrap CSS links-->
		
		<script>
		function showEdit(editableObj) 
		{
			jQuery(editableObj).css("background","#FFFFFF");
		} 
		
		function saveToDatabase(editableObj,column,id) {
			jQuery(editableObj).css("background","#FFFFFF");
			//alert('column='+column+'&editval='+editableObj.innerHTML+'&id='+id);
			jQuery.ajax({
				url: "../php/live_update/update_task.php",
				type: "POST",
				data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
				success: function(data){
					jQuery(editableObj).css("background","#f9f9f9");
				}        
		   });
		}
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
					<h1>Task Report 
					<div class="btn-toolbar pull-right">
					<a href="../html/add_task_html.php" class="btn btn-xs btn-primary">New Task</a>  
					<a href="../reports/completed_task_report_html.php" class="btn btn-xs btn-success">Completed Tasks</a>
					<a href="../reports/ongoing_task_report_html.php" class="btn btn-xs btn-success">Ongoing Tasks</a>
					</div>
					</h1>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="box">
						<div class="box-body">
							 <div class="table-responsive">
							<table id="view_task_html" class="table table-bordered dt-responsive table-condensed table-striped">
								<thead class="thead-inverse">
									<tr>
										<th><center>Task Name</th>
										<th><center>Description</th>
										<th><center>Assignee Name</th>
										<th><center>Start Date</th>
										<th><center>Due Date</th>
										<th><center>Priority</th>
										<th><center>Status</th>
										<th style="width:35%;"><center>Remarks</th>
										<th><center>Created By</th>
										<th><center>View</th>
										<th><center>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if($settings_result['view_all_task']!=1)
									{
										$sql = "SELECT * FROM task t, users u where t.task_assignee=u.id and t.delete_status<>1 and t.location='".$user_result['location']."'";
									}
									else
									{
										$sql = "SELECT * FROM task t, users u where t.task_assignee=u.id and t.delete_status<>1";
									}
									
									$result = mysqli_query($conn,$sql);
									while ($row = mysqli_fetch_array($result))
									{
									// Print out the contents of the entry
									echo '<tr class="table-row">';
									echo '<td align="center" contenteditable="true" onBlur=\'saveToDatabase(this,"task_name",'. $row['task_id'].')\' onClick="showEdit(this)">'.$row['task_name'].'</td>';
									echo '<td align="center" contenteditable="true" onBlur=\'saveToDatabase(this,"task_description",'. $row['task_id'].')\' onClick="showEdit(this)">'.$row['task_description'].'</td>';
									echo '<td align="center">'.$row['name'].'</td>';
									
									echo '<td align="center" style="width:10%" onBlur=\'saveToDatabase(this,"task_start_date",'. $row['task_id'].')\' onClick="showEdit(this)">'. $row['task_start_date'] .'</td>';
									
									echo '<td align="center" style="width:10%"  onBlur=\'saveToDatabase(this,"task_due_date",'. $row['task_id'].')\' onClick="showEdit(this)">'. $row['task_due_date'].'</td>';
														
									echo '<td align="center" onBlur=\'saveToDatabase(this,"task_priority",'. $row['task_id'].')\' onClick="showEdit(this)">'.$row['task_priority'].'</td>';														
									if( $row['task_status']=='Ongoing')
										{
										echo '<td style="width:10%" > <div align="center" class="badge bg-blue">'.$row['task_status'].'</div></td>';
										}
										else if( $row['task_status']=="Completed")
										{
										echo '<td> <div align="center" class="badge bg-green" onBlur=\'saveToDatabase(this,"task_status",'. $row['task_id'].')\' onClick="showEdit(this)">'.$row['task_status'].'</div></td>';
										}
										else if( $row['task_status']=="Cancelled")
										{
										echo '<td> <div align="center" class="badge bg-red" onBlur=\'saveToDatabase(this,"task_status",'. $row['task_id'].')\' onClick="showEdit(this)">'.$row['task_status'].'</div></td>';
										}									
						
									echo '<td align="center" style="width:35%;" contenteditable="true" onBlur=\'saveToDatabase(this,"task_remarks",'. $row['task_id'].')\' onClick="showEdit(this)">'.$row['task_remarks'].'</td>';
									
									
									$sqlu = "SELECT name FROM users where id = " . $row['data_entered_by'];
									$result5 = mysqli_query($conn, $sqlu);
									$u_result = mysqli_fetch_array($result5,MYSQLI_ASSOC);
									{
									echo '<td align="center">'.$u_result['name'].'</td>';
									}
									echo  "<td><center> <a href='../html/view_task_html.php?id=" . $row['task_id'] . "' class='btn btn-primary btn-xs'>View</a></center></td>";	
									
									echo "<td style='min-width: 90px'>
									<div class='btn-group action pull-right'>
										<button type='button' class='btn bg-green'><i class='fa fa-cog' aria-hidden='true'></i> </button>
										<button type='button' class='btn bg-green dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
											<span class='caret'></span>
											<span class='sr-only'> Toggle Dropdown</span>
										</button>
										<ul class='dropdown-menu'>
											<li>
											<a title='Edit' href='../html/edit_task_html.php?id=" . $row['task_id'] . "'>
											<i class='fa fa-pencil-square' aria-hidden='true'></i>Edit</a>
											</li>";
											
										if($user_result['role']=="Admin")
										{
											echo "<li>
											<a title='Delete' onclick=\"return confirm('Delete this record?')\" href='../php/delete/delete_task.php?id=" . $row['task_id'] . "'>
											<i class='fa fa-trash-o' aria-hidden='true'></i>Delete</a>
											</li>";
											}
										echo "
										</ul>
									</div></td></tr>";
						
										
									}
									?>
								</tbody>
							</table>
							</div>
						</div>
					<!-- /.box-body -->
					</div>
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
	</body>	
	
	
	<!--Including Bootstrap and other scripts-->
	<?php include "../extra/footer.html";?>
	<!--Including Bootstrap and other scripts-->

	<script>
		$(document).ready(function()
		{
			  $.fn.dataTable.moment( 'HH:mm MMM D, YY' );
			  $.fn.dataTable.moment( 'dddd, MMMM Do, YYYY' );
			// Handler for .ready() called.
			$("#li_task").addClass("active");
			$("#li_task_report").addClass("active");
		$('#view_task_html').DataTable({
		"aLengthMenu": [[25, 50, 75, 100 , -1], [25, 50, 75, 100, "All"]],
        "iDisplayLength": 25,
		"columnDefs": [ 
		{
		targets: 3,
		render: $.fn.dataTable.render.moment('DD-MM-YYYY')
		},
		{
		targets: 4,
		render: $.fn.dataTable.render.moment('DD-MM-YYYY' )
		}
		],	 
		"order": [3, "ASC"],	
		 responsive: true	 
		});
		 
		});
		
		
		$('a.delete').on('click', function() 
		{
			var choice = confirm('Do you really want to delete this record?');
			if(choice === true) 
			{
				return true;
			}
			return false;
		});
	</script>


</html>
