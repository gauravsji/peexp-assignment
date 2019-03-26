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
			<h1>Customer Report
			<div class="btn-toolbar pull-right">
			<?php
			if($user_result['role']=="Admin")
			{
			echo '<button class="btn btn-xs bg-olive pull-right" id="btnExport">Export</button>';
			}
			?>
			<a href="../html/add_customer_html.php" class="btn pull-right btn-xs btn-primary">New Customer</a>
			</div>
			</h1>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="box">
				<div class="box-body">
				 <div class="table-responsive" id="table_wrapper">
				<table id="view_customer_data" class="table table-bordered table-striped table-fixed table-condensed">
					<thead>
						<tr>
							<th><center>Name</th>
							<th><center>City</th>
							<th><center>Address</th>
							<th><center>Contact Person</th>
							<th><center>Contact Number</th>
							<th><center>Email</th>
							<th><center>Assignee by</th>
							<th><center>Approval</th>
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
						if($settings_result['view_all_customer']!=1)
						{
						$sql = "SELECT * FROM customer where delete_status<>1 ";
						}
						else
						{
							$sql = "SELECT * FROM customer where delete_status<>1";
						}
						$result = mysqli_query($conn,$sql);
						while ($row = mysqli_fetch_array($result))
						{
							// Print out the contents of the entry
							echo '<tr>';
							echo '<td><center>' . $row['customer_name'] . '</center></td>';
							echo '<td><center>' . $row['customer_city'] . '</center></td>';
							echo '<td><center>' . $row['customer_address'] . '</center></td>';
							echo '<td><center>' . $row['customer_contact_person'] . '</center></td>';
							echo '<td><center>' . $row['customer_contact_number'] . '</center></td>';
							echo '<td><center>' . $row['customer_email'] . '</center></td>';
							echo '<td><center>' . $row['subset'] . '</center></td>';
							if( $row['approved']== 0)
							{
							echo '<td style="width:12%"><center><div class="badge bg-teal">' . "Not Approved" . '</div></center></td>';
							}
							else if( $row['approved'] == 1)
							{
							echo '<td style="width:12%"><center><div class="badge bg-yellow">'."Approved".'</div><center></td>';
							}
							else if($row['approved'] == null)
							{
	              echo '<td style="width:12%"><center><div class="badge bg-teal">' . "Not Approved" . '</div></center></td>';

							}

							echo  "<td><center> <a href='../html/view_customer_html.php?id=" . $row['customer_id'] . "' class='btn btn-primary btn-xs'>View</a></center></td>";
							echo  "<td><center> <a href='../html/edit_customer_html.php?id=" . $row['customer_id'] . "' class='btn btn-warning btn-xs'>Edit</a></center></td>";
							if($user_result['role']=="Admin")
							{
							echo  "<td><center> <a onclick=\"return confirm('Delete this record?')\" href='../php/delete/delete_customer.php?id=" . $row['customer_id'] . "' class='btn btn-danger btn-xs'>Delete</a></center></td>";
							}
							echo "</tr>";
						}
					?>
					</tbody>
				</table>
				</div>
				</div>
			</div>
		</section>
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
	$("#li_customer_report").addClass("active");
/* 	$('#view_customer_data').DataTable({
		"aLengthMenu": [[25, 50, 75, 100 , -1], [25, 50, 75, 100, "All"]],
        "iDisplayLength": 25
		});
		 */





		/* Setup - add a text input to each footer cell
    $('#view_customer_data tfoot th').each( function (i)
	{
        var title = $('#view_customer_data thead th').eq( $(this).index() ).text();
		 if($(this).index() !=6 && $(this).index() !=7 && $(this).index() !=8) // check if this is not first column header
		 {
        $(this).html( '<input type="text" placeholder="Search '+title+'" data-index="'+i+'" />' );
		 }
    } );*/

    // DataTable
    var table = $('#view_customer_data').DataTable( {
        scrollY:        "400px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         true,
        fixedColumns:   true,
		aLengthMenu: [[25, 50, 75, 100 , -1], [25, 50, 75, 100, "All"]],
        iDisplayLength: 25
    } );

    /* Filter event handler
    $( table.table().container() ).on( 'keyup', 'tfoot input', function () {
        table
            .column( $(this).data('index') )
            .search( this.value )
            .draw();
    } );*/



	$("#btnExport").click(function(e)
	{
    e.preventDefault();
    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table_wrapper');
    var table_html = table_div.outerHTML.replace(/ /g, '%20');

    var a = document.createElement('a');
    a.href = data_type + ', ' + table_html;
    a.download = 'Customer_Report_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
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
</html>
