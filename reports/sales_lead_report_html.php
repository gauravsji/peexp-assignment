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
			<h1>Sales Lead Report 
			<div class="btn-toolbar pull-right">
			<?php 
			if($user_result['role']=="Admin")
			{
			echo '<button class="btn btn-xs bg-olive pull-right" id="btnExport">Export</button>';
			}
			?>
			<a href="../html/add_sales_lead_html.php" class="btn pull-right btn-xs btn-primary">New Sales Lead</a>
			</div>
			</h1>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="box">
				<div class="box-body">
				 <div class="table-responsive" id="table_wrapper">
				<table id="view_sales_lead_data" class="table table-bordered table-striped table-fixed table-condensed">
					<thead>
						<tr>
							<th><center>Sales Lead Name</th>
							<th><center>City</th>
							<th><center>Address</th>
							<th><center>Firm</th>
							<th><center>Contact Number</th>
							<th><center>Email</th>
							<th><center>Data Entered By</th>
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
						if($settings_result['view_all_sales_lead']!=1)
						{
							$sql = "SELECT * FROM sales_lead sl, users u where u.id=sl.data_entered_by and sl.delete_status<>1 and sl.location='".$user_result['location']."'";
						}
						else
						{
							$sql = "SELECT * FROM sales_lead sl, users u where u.id=sl.data_entered_by and sl.delete_status<>1";
						}
						$result = mysqli_query($conn,$sql);
						while ($row = mysqli_fetch_array($result))
						{
							// Print out the contents of the entry
							echo '<tr>';
							echo '<td><center>' . $row['sales_lead_name'] . '</center></td>';
							echo '<td><center>' . $row['sales_lead_city'] . '</center></td>';
							echo '<td><center>' . $row['sales_lead_address'] . '</center></td>';
							echo '<td><center>' . $row['sales_lead_firm'] . '</center></td>';
							echo '<td><center>' . $row['sales_lead_contact_number'] . '</center></td>';
							echo '<td><center>' . $row['sales_lead_email'] . '</center></td>';
							echo '<td><center>' . $row['name'] . '</center></td>';	
							echo  "<td><center> <a href='../html/view_sales_lead_html.php?id=" . $row['sales_lead_id'] . "' class='btn btn-primary btn-xs'>View</a></center></td>";
							echo  "<td><center> <a href='../html/edit_sales_lead_html.php?id=" . $row['sales_lead_id'] . "' class='btn btn-warning btn-xs'>Edit</a></center></td>";
							if($user_result['role']=="Admin")
							{
							echo  "<td><center> <a onclick=\"return confirm('Delete this record?')\" href='../php/delete/delete_sales_lead.php?id=" . $row['sales_lead_id'] . "' class='btn btn-danger btn-xs'>Delete</a></center></td>";
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

		</body>
		<script>
		$(document).ready(function()
		{
		$('#view_sales_lead_data').DataTable({
		"aLengthMenu": [[25, 50, 75, 100 , -1], [25, 50, 75, 100, "All"]],
        "iDisplayLength": 25
		});
		// Handler for .ready() called.
		$("#li_enquiry").addClass("active");
		$("#li_sales_lead_report").addClass("active");
		
		$("#btnExport").click(function(e) {
    e.preventDefault();
    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table_wrapper');
    var table_html = table_div.outerHTML.replace(/ /g, '%20');

    var a = document.createElement('a');
    a.href = data_type + ', ' + table_html;
    a.download = 'Sales_Lead_Report_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
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
