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
			
					<h1>Servicers and Installers Report 	
					<div class="btn-toolbar pull-right">
					<?php
									if($user_result['role']=="Admin")
									{
							echo '<button class="btn btn-xs bg-olive pull-right" id="btnExport">Export</button>';
									}
?>									
							<a href="../html/add_servicers_installers.php" class="btn pull-right btn-xs btn-primary">New Servicer/Installer </a>
					</div>
					</h1>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="box">
						<div class="box-body">
						    <div class="table-responsive" id="table_wrapper">
							<table id="view_servicers_installers_html"  class="table table-bordered table-condensed table-sm table-responsive display" cellspacing="0" width="100%">
								<thead>	
									<tr>								
									<th><center>Name</th>
									<th><center>Contact Number</th>
									<th><center>Alternate Contact Number</th>
									<th><center>Email</th>
									<th><center>About</th>
									<th><center>View</th>
									<th><center>Edit</th>
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
									if($settings_result['view_all_brand']!=1)
									{
									$sql = "SELECT * FROM service_installer where delete_status<>1 and location='".$user_result['location']."'";
									}
									else
									{
										$sql = "SELECT * FROM service_installer where delete_status<>1";
									}
									
									$brand_result = mysqli_query($conn,$sql);
									while ($row = mysqli_fetch_array($brand_result))
									{
										// Print out the contents of the entry
										echo '<tr>';
										echo '<td><center>' . $row['service_installer_name'] . '</center></td>';
										echo '<td><center>' . $row['service_installer_contact_number'] . '</center></td>';
										echo '<td><center>' . $row['service_installer_alternate_contact_number'] . '</center></td>';
										echo '<td><center>' . $row['service_installer_email'] . '</center></td>';
										echo '<td><center>' . $row['service_installer_about'] . '</center></td>';
										echo  "<td><center> <a href='../html/view_servicers_installers_html.php?id=" . $row['service_installer_id'] . "' class='btn btn-primary btn-xs'>View</a></center></td>";
										echo  "<td><center> <a href='../html/edit_servicers_installers_html.php?id=" . $row['service_installer_id'] . "' class='btn btn-warning btn-xs'>Edit</a></center></td>";
										if($user_result['role']=="Admin")
										{
										echo  "<td><center> <a onclick=\"return confirm('Delete this record?')\" href='../php/delete/delete_servicers_installers.php?id=" . $row['service_installer_id'] . "' class='btn btn-danger btn-xs'>Delete</a></center></td>";
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
		<!--./wrapper -->
		
	<script>
	$(document).ready(function()
	{
		// Handler for .ready() called.
		$("#li_misc").addClass("active");
		$("#li_servicers_installers_report").addClass("active");
		
				
		
	$('#view_servicers_installers_html').DataTable({
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
		a.download = 'Service_Installers_Report_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
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
	</body>
	<!--Including Bootstrap and other scripts-->
	<?php include "../extra/footer.html";?>
	<!--Including Bootstrap and other scripts-->



</html>
