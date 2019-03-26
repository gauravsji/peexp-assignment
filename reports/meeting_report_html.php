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
					<h1>Meeting Report 
					<div class="btn-toolbar pull-right">
					<?php
					if($user_result['role']=="Admin")
					{
					echo '<button class="btn btn-xs bg-olive pull-right" id="btnExport">Export</button>';
					}
					?>
					<a href="../html/add_meeting_html.php" class="btn pull-right btn-xs btn-primary">New Meeting</a>
					</div></h1>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="box">
						<div class="box-body">
							 <div class="table-responsive" id="table_wrapper">
							<table id="view_meeting_html" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th><center>Meeting Date</center></th>
										<th><center>Meeting Time</center></th>
										<th><center>Venue</center></th>
										<th><center>Connect Name</center></th>
										<th><center>Contact Number</center></th>
										<th><center>Title</center></th>
										<th><center>Meeting With</center></th>
										<th><center>Assignee</center></th>
										<th><center>Agenda</center></th>
										<th><center>Notes</center></th>
										<th style="width:100%"><center>Status</center></th>
										<th><center>View</center></th>
										<th><center>Edit</center></th>
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
									if($settings_result['view_all_meeting']!=1)
									{
									$query = "SELECT m.meeting_id, m.meeting_date, m.meeting_time, m.meeting_venue, m.meeting_connect_name, m.meeting_contact_number,  m.meeting_title, m.meeting_with, m.meeting_assignee, m.meeting_agenda, m.meeting_notes, m.meeting_status, m.location, m.delete_status, u.id, u.name FROM meeting m, users u where m.meeting_assignee=u.id and m.delete_status<>1 and m.location='".$user_result['location']."'";
									}
									else
									{
										$query = "SELECT m.meeting_id, m.meeting_date, m.meeting_time, m.meeting_venue, m.meeting_connect_name, m.meeting_contact_number,  m.meeting_title, m.meeting_with, m.meeting_assignee, m.meeting_agenda, m.meeting_notes, m.meeting_status, m.location, m.delete_status, u.id, u.name FROM meeting m, users u where m.meeting_assignee=u.id and m.delete_status<>1";
									}
									$transport_result = mysqli_query($conn,$query);
									while ($row = mysqli_fetch_array($transport_result))
									{
									// Print out the contents of the entry 
									echo '<tr>';
									echo '<td><center>' . date("d-m-Y", strtotime($row['meeting_date'])). '</center></td>';
									echo '<td><center>' . $row['meeting_time'] . '</center></td>';
									echo '<td><center>' . $row['meeting_venue'] . '</center></td>';
									echo '<td><center>' . $row['meeting_connect_name'] . '</center></td>';
									echo '<td><center>' . $row['meeting_contact_number'] . '</center></td>';
									echo '<td><center>' . $row['meeting_title'] . '</center></td>';
									echo '<td><center>' . $row['meeting_with'] . '</center></td>';
									echo '<td><center>' . $row['name'] . '</center></td>';
									echo '<td><center>' . $row['meeting_agenda'] . '</center></td>';
									echo '<td><center>' . $row['meeting_notes'] . '</center></td>';
																		
									if( $row['meeting_status']=='Scheduled')
									{
										echo '<td style="width:"100%"> <div style="width:100%" class="badge bg-blue" >'.$row['meeting_status'].'</div></td>';
									}
									else if( $row['meeting_status']=="Completed")
									{
										echo '<td style="width:100%"> <div style="width:100%" class="badge bg-green">'.$row['meeting_status'].'</div></td>';
									}
									else if( $row['meeting_status']=="Postponed")
									{
										echo '<td style="width:100%"> <div style="width:100%" class="badge bg-green">'.$row['meeting_status'].'</div></td>';
									}
									else if( $row['meeting_status']=="Cancelled")
									{
										echo '<td style="width:100%"> <div style="width:100%" class="badge bg-red">'.$row['meeting_status'].'</div></td>';
									}												
									echo  "<td><center> <a href='../html/view_meeting_html.php?id=" . $row['meeting_id'] . "' class='btn btn-primary btn-xs'>View</a></center></td>";
									echo  "<td><center> <a href='../html/edit_meeting_html.php?id=" . $row['meeting_id'] . "' class='btn btn-warning btn-xs'>Edit</a></center></td>";
									if($user_result['role']=="Admin")
									{
									echo  "<td><center> <a onclick=\"return confirm('Delete this record?')\" href='../php/delete/delete_meeting.php?id=" . $row['meeting_id'] . "' class='btn btn-danger btn-xs'>Delete</a></center></td>";
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
	</body>
 
	<!--Including Bootstrap and other scripts-->
	<?php include "../extra/footer.html";?>
	<!--Including Bootstrap and other scripts-->
	
	<script>
		$(document).ready(function()
		{
				// Handler for .ready() called.
			$("#li_daily_operations").addClass("active");
			$("#li_meeting_report").addClass("active");
		$('#view_meeting_html').DataTable({
			"columnDefs": [
    { "width": "30%", "targets": 10 }
  ],
		"aLengthMenu": [[25, 50, 75, 100 , -1], [25, 50, 75, 100, "All"]],
        "iDisplayLength": 25
		});
		
		
				
$("#btnExport").click(function(e) 
{
    e.preventDefault();
    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table_wrapper');
    var table_html = table_div.outerHTML.replace(/ /g, '%20');

    var a = document.createElement('a');
    a.href = data_type + ', ' + table_html;
    a.download = 'Meeting_Report_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
    a.click();
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
