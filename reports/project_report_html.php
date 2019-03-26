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
					<h1>Project Report <a href="../html/add_project_html.php" class="btn pull-right btn-xs btn-primary">New Project</a></h1>
					</section>

					<!-- Main content -->
					<section class="content">
					<div class="box">
						<div class="box-body">
							<div class="table-responsive">
							<table id="view_project_html" class="table table-bordered table-striped table-fixed">
								<thead>
									<tr>
									<th><center>Customer Name</th>
									<th><center>Project Name</th>
									<th><center>Client Name</th>
									<th><center>Site Address</th>
									<th><center>Site Incharge Name</th>
									<th><center>Type Of Project</th>
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
									if($settings_result['view_all_customer']!=1)
									{
									$sql = "SELECT * FROM customer c,project p where p.customer_id=c.customer_id and p.delete_status<>1 and c.delete_status<>1 and c.location='".$user_result['location']."'";
									}
									else
									{
										$sql = "SELECT * FROM customer c,project p where p.customer_id=c.customer_id and p.delete_status<>1 and c.delete_status<>1";
									}
									$result = mysqli_query($conn,$sql);
									while ($row = mysqli_fetch_array($result))
									{
									// Print out the contents of the entry
									echo '<tr>';								
									echo  '<td><center>' . $row['customer_name'] . '</center></td>';
									echo '<td><center>' . $row['project_name'] . '</center></td>';
									echo '<td><center>' . $row['project_client_name'] . '</center></td>';
									echo '<td><center>' . $row['project_site_address'] . '</center></td>';
									echo '<td><center>' . $row['project_site_incharge_name'] . '</center></td>';
									echo '<td><center>' . $row['project_type_of_project'] . '</center></td>';
									echo  "<td><center> <a href='../html/edit_project_html.php?id=" . $row['project_id'] . "' class='btn btn-warning btn-xs'>Edit</a></center></td>";
									if($user_result['role']=="Admin")
									{
									echo  "<td><center> <a onclick=\"return confirm('Delete this record?')\" href='../php/delete/delete_project.php?id=" . $row['project_id'] . "' class='btn btn-danger btn-xs'>Delete</a></center></td></tr>";
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
	$("#li_customer").addClass("active");
	$("#li_project_report").addClass("active");
	$('#view_project_html').DataTable({
		"aLengthMenu": [[25, 50, 75, 100 , -1], [25, 50, 75, 100, "All"]],
        "iDisplayLength": 25
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

</html>
