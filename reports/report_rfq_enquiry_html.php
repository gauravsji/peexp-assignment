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
					<h1> Customer Request Report<a href="../html/add_rfq_html.php" class="btn pull-right btn-sm btn-primary">New Request Quote</a></h1></h1>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="box">

				<div class="box-body">
				<div class="table-responsive">
							<table id="view_enquiry_html" class="table table-bordered table-striped table-condensed stripe row-border order-column" width="100%">
								<thead>
									<th><center>Request ID</center></th>
									<th><center>Request Date</center></th>
									<th><center>Request Name</center></th>
									<th><center>Customer</center></th>
									<th><center>Project</center></th>
									<th><center>Assignee</center></th>
									<th><center>Request Status</center></th>
									<th><center>Request Priority</center></th>
									<th><center>PI Status</center></th>
									<th><center>PO Status</center></th>
									<th><center>View</center></th>
									<th><center>Edit</center></th>
									<?php
										if($user_result['role']=="Admin")
										{
										echo '<th><center>Delete</center></th>';
										}
										?>
								</thead>

								<tbody>
									<?php
										$sql = "SELECT * FROM rfq where delete_status<>1 ORDER BY end_date DESC";

										$result = mysqli_query($conn,$sql);
										while ($row = mysqli_fetch_array($result))
										{
											echo '<tr>';
											echo '<td ><center>' . $row['rfq_id'] . '</center></td>';
											echo '<td><center>' . $row['enquiry_date'] . '</center></td>';
											echo '<td><center>' . $row['enquiry_name'] . '</center></td>';

											//get user name based on id
											$id = $row['customer_id'];
											$query_name = "SELECT customer_name FROM customer WHERE customer_id='$id'";
											$result1 = mysqli_query($conn, $query_name);
											$cust_name = mysqli_fetch_array($result1,MYSQLI_ASSOC);
											$name =$cust_name['customer_name'];
											echo '<td><center>' . $name . '</center></td>';

											//get project name based on id
											$id = $row['project_id'];
											$query_name2 = "SELECT project_name FROM project WHERE project_id='$id'";
											$result2 = mysqli_query($conn, $query_name2);
											$pro_name = mysqli_fetch_array($result2,MYSQLI_ASSOC);
											$proj_name =$pro_name['project_name'];
											echo '<td><center>' . $proj_name . '</center></td>';

											//get assginee name based on id
											$id = $row['sales_lead_id'];
											$query_name3 = "SELECT sales_lead_name FROM sales_lead WHERE sales_lead_id='$id'";
											$result3 = mysqli_query($conn, $query_name3);
											$lead_names = mysqli_fetch_array($result3,MYSQLI_ASSOC);
											$sales_lead_name =$lead_names['sales_lead_name'];
											echo '<td><center>' . $sales_lead_name . '</center></td>';


											if($row['enquiry_status'] === 'Awaiting Quote')
											{
												echo '<td style="width:12%"><div class="badge bg-blue">' . "Quote Awaited" . '</div></td>';
											}
											else if($row['enquiry_status'] === 'Quote Sent')
											{
												echo '<td style="width:12%"><div class="badge bg-lime"><center>' . "Quote Sent" . '</div></td>';
											}
											else if( $row['enquiry_status']=="Rework Requested")
											{
												echo '<td style="width:12%"><div class="badge bg-orange"><center>' . "Rework Requested" . '</div></td>';
											}
											else if($row['enquiry_status'] == 'Order Received')
											{
												echo '<td style="width:12%"><div class="badge bg-green"><center>Order Received</div></td>';
											}
											else
											{
												echo '<td style="width:12%"><div class="badge bg-blue">' . "Awaiting Quote" . '</div></td>';
											}

											if( $row['enquiry_priority']=="LOW" || $row['enquiry_priority']=="")
											{
												echo '<td style="width:12%"><center><div class="badge bg-teal">' . "LOW" . '</div></center></td>';
											}
											else if( $row['enquiry_priority']=="MEDIUM" )
											{
												echo '<td style="width:12%"><div class="badge bg-yellow">' . "MEDIUM" . '</div></td>';
											}
											else if( $row['enquiry_priority']=="HIGH" )
											{
												echo '<td style="width:12%"><div class="badge bg-orange">' . "HIGH" . '</div></td>';
											}
											else if( $row['enquiry_priority']=="CRITICAL" )
											{
												echo '<td style="width:12%"><div class="badge bg-red">' . "CRITICAL" . '</div></td>';
											}
											else {
												echo '<td style="width:12%"><div class="badge bg-red">' . $row['enquiry_priority'] . '</div></td>';
											}

											if( $row['pi_status']=="not created")
											{
												echo '<td style="width:12%"><center><div class="badge bg-teal">' . "NOT Created" . '</div></center></td>';
											}

											else if( $row['pi_status']=="confirm" )
											{
												echo '<td style="width:12%"><center><div class="badge bg-yellow">' . "Confirm" . '</div></center></td>';
											}

											else if( $row['pi_status']=="approved" )
											{
												echo '<td style="width:12%"><center><div class="badge bg-orange">' . "Approved" . '</div></center></td>';
											}
											elseif ($row['pi_status'] == "" || $row['pi_status'] == null) {
												echo '<td style="width:12%"><center><div class="badge bg-orange">Pending</div></center></td>';
											}
											else {
												echo '<td style="width:12%"><center><div class="badge bg-orange">' .$row['pi_status'] . '</div></center></td>';
											}

											if($row['po_status'] == null || $row['po_status'] == "" || $row['po_status'] == "pending" || $row['po_status'] == "rejected")
											{
													echo '<td><center><button class="btn btn-info btn-xs">Pending</button></center></td>';
											}
											else if($row['po_status'] == 'customer_approved')
											{
												echo '<td><center><button class="btn btn-warning btn-xs">Customer Approved</button></center></td>';
											}
											else if($row['po_status'] == 'uploaded'){
												echo '<td><center><button class="btn btn-warning btn-xs">Uploaded</button></center></td>';
											}
											else if($row['po_status'] == "approved")
											{
												echo '<td><center><button class="btn btn-success btn-xs">Approved</button></center></td>';
											}
											else {
												echo '<td><center></center></td>';
											}

											echo  "<td><center> <a target='_blank' href='../html/view_rfq_enquiry.php?id=" . $row['rfq_id'] . "' class='btn btn-primary btn-xs'>View</a></center></td>";
											if($row['pi_status'] != "approved")
												echo  "<td><center> <a target='_blank' href='../html/edit_rfq_enquiry.php?id=" . $row['rfq_id'] . "' class='btn btn-warning btn-xs'>Edit</a></center></td>";
											else
												echo  "<td><center> <a target='_blank' href='../html/edit_rfq_enquiry.php?id=" . $row['rfq_id'] . "' class='btn btn-warning btn-xs' disabled>Edit</a></center></td>";

											if($user_result['role']=="Admin")
											{
												echo  "<td><center> <a onclick=\"return confirm('Delete this record?')\" href='../php/delete/delete_rfq.php?id=" . $row['rfq_id'] . "' class='btn btn-danger btn-xs'>Delete</a></center></td>";
											}
											echo "</tr>";
									}
									?>
								</tbody>
							</table>
						</div>
						</div></div>
						<!-- /.box-body -->
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
	</body>

		<script>
	$(document).ready(function()
	{
	// Handler for .ready() called.
	$("#li_enquiry_manage").addClass("active");
	$("#li_user_enquiry_report").addClass("active");


		// Setup - add a text input to each footer cell
  //   $('#view_enquiry_html tfoot th').each( function (i)
	// {
  //       var title = $('#view_enquiry_html thead th').eq( $(this).index() ).text();
	// 	 if($(this).index() !=9 && $(this).index() !=10 && $(this).index() !=11) // check if this is not first column header
	// 	 {
  //       $(this).html( '<input type="text" placeholder="Search '+title+'" data-index="'+i+'" />' );
	// 	 }
  //   } );

    // DataTable
		var table = $('#view_enquiry_html').DataTable({
				scrollY:        "400px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         true,
				order: [[ 0, "desc" ]],
        fixedColumns: true
    });

    /* Filter event handler
    $( table.table().container() ).on( 'keyup', 'tfoot input', function () {
        table
            .column( $(this).data('index') )
            .search( this.value )
            .draw();
    } );*/

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
