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

			<!--Including Left Nav Bar-->
			<?php include "../extra/left_nav_bar.php";?>
			<!--Including Left Nav Bar-->

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>Daily Log Report    <div class="btn-toolbar pull-right">
					<?php
					if($user_result['role']=="Admin")
					{
					echo '<button class="btn btn-xs bg-olive pull-right" id="btnExport">Export</button>';
					}
					?>
					<a href="../html/add_daily_log_html.php" class="btn pull-right btn-xs btn-primary">New Log</a> 					
					</div>    
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="box">
						<!-- /.box-header -->
						<div class="box-body">
							 <div class="table-responsive" id="table_wrapper">
							<table id="view_daily_log" class="table table-bordered table-striped table-fixed table-condensed">
								<thead>
									<tr>
										<th><center>Daily Logs</th>
										<th><center>Date Created</th>
										<th><center>Data Added By</th>
										<th><center>View</th>
										<th><center>Action</th>
										<?php
										if($user_result['role']=="Admin")
										{
										echo '<th><center>Delete</th>';
										}
										?>
									</tr>
								</thead>
								<tbody>
									<?php
									if($settings_result['view_all_daily_log']==0)
									{
										$sql = "SELECT u.id, u.name,d.daily_log_id,d.daily_log, d.daily_log_date_created FROM daily_log d INNER JOIN users u ON u.id=d.data_entered_by where d.delete_status<>1 and d.location='".$user_result['location']."' ORDER BY STR_TO_DATE(d.daily_log_date_created, '%Y-%m-%d %h:%i:%s') DESC";
									}
									else
									{
										$sql = "SELECT u.id, u.name,d.daily_log_id,d.daily_log,d.daily_log_date_created FROM daily_log d INNER JOIN users u ON u.id=d.data_entered_by where  d.delete_status<>1 ORDER BY STR_TO_DATE(d.daily_log_date_created, '%Y-%m-%d %h:%i:%s') DESC";
									}	
										$result = mysqli_query($conn,$sql);
										while ($row = mysqli_fetch_array($result)) 
										{
											// Print out the contents of the entry 
											echo '<tr>';
											echo '<td><center>' . $row['daily_log'] . '</center></td>';
											echo '<td><center>' . $row['daily_log_date_created']  . '</center></td>';
											echo '<td><center>' . $row['name'] . '</center></td>';	
											echo  "<td><center> <a href='../html/view_daily_log_html.php?id=" . $row['daily_log_id'] . "' class='btn noExl btn-primary btn-xs'>View</a></center></td>";											
											echo  "<td><center> <a href='../html/edit_daily_log_html.php?id=" . $row['daily_log_id'] . "' class='btn noExl btn-warning btn-xs'>Edit</a></center></td>";
											if($user_result['role']=="Admin")
											{
											echo  "<td><center> <a onclick=\"return confirm('Delete this record?')\" href='../php/delete/delete_daily_log.php?id=" . $row['daily_log_id'] . "' class='btn btn-danger btn-xs'>Delete</a></center></td>";
											}
											echo "</tr>";
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
		<!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";?>
		<!--Including Bootstrap and other scripts-->
			<script>
	$(document).ready(function()
	{
		// Handler for .ready() called.
		$("#li_daily_operations").addClass("active");
		$("#li_daily_log_report").addClass("active");
		$('#view_daily_log').DataTable({		
		"aLengthMenu": [[25, 50, 75, 100 , -1], [25, 50, 75, 100, "All"]],
		"iDisplayLength": 25,

		"order": [[1, "desc" ]],
		
		columnDefs: [
       { type: 'date-us', targets: 1 }
    ],
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
		
		
$("#btnExport").click(function(e) {
    e.preventDefault();
    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table_wrapper');
    var table_html = table_div.outerHTML.replace(/ /g, '%20');

    var a = document.createElement('a');
    a.href = data_type + ', ' + table_html;
    a.download = 'Daily_Log_Report_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
    a.click();
  });


	</script>
	
			
	</body>
	

</html>
