<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";?>
	<!--Including Login Session-->
	<head>
		<!--Including Bootstrap CSS links-->
		<?php
		include "../extra/header.html";
		include "../constants.php";
		?>
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
					<h1>Request Report<a href="../html/RFQ/add_rfq_html.php" class="btn pull-right btn-xs btn-primary">New Request Quote</a></h1>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="box">

				<div class="box-body">
				<div class="table-responsive">
							<table id="view_enquiry_html" class="table table-bordered table-striped table-condensed stripe row-border order-column" width="100%">
								<thead>
									<tr>
									<th width="5%"><center>Request ID</center></th>

									<th width="5%"><center>Date</center></th>
									<th><center>Name</center></th>
									<!-- <th><center>Sales Lead</center></th> -->
									<th><center>Assignee</center></th>
									<th><center>Project</center></th>
									<th><center>Status</center></th>
									<th><center>Priority</center></th>
									<th><center>PI Status</center></th>
									<th><center>PO Status</center></th>
									<th><center>Delivery Status</center></th>
									<th><center>View</center></th>
									<th><center>Edit</center></th>
									<th><center>Delete</center></th>
								</thead>

								<tbody>
									<?php
										if($_SESSION['id'] == $_SESSION['groupId'])
										{
										$sql_enquiry = "SELECT * FROM rfq where delete_status<>1";
										$result_enquiry = mysqli_query($conn, $sql_enquiry);
										$enquiry_result = mysqli_fetch_array($result_enquiry,MYSQLI_ASSOC);

										$sql = "SELECT * FROM rfq e
												LEFT OUTER JOIN customer c ON e.customer_id=c.customer_id
												LEFT OUTER JOIN project p ON e.project_id = p.project_id
												WHERE e.delete_status <> 1 and e.enquiry_date > curdate()-800 and c.subset = ".$_SESSION['id'];
										}
										else
										{
											$sql = "SELECT * FROM rfq e
												LEFT OUTER JOIN customer c ON e.customer_id=c.customer_id
												LEFT OUTER JOIN project p ON e.project_id = p.project_id
												WHERE e.delete_status <> 1 and e.enquiry_date > curdate()-800 and e.customer_id =".$_SESSION['id'];
										}

										$result = mysqli_query($conn,$sql);
										while ($row = mysqli_fetch_array($result))
										{
											// Print out the contents of the entry
											echo '<tr>';
											////$originalDate =  $row['enquiry_date'];
											//echo '<td  width="5%"><center>' . date("d-m-Y", strtotime($originalDate)). '</center></td>';
											echo '<td  width="5%"><center>' . $row['rfq_id'] . '</center></td>';
											echo '<td  width="5%"><center>' . $row['enquiry_date'] . '</center></td>';
											echo '<td><center>' . $row['enquiry_name'] . '</center></td>';


											if($row['customer_name']!="")
											{
											echo '<td><center>' . $row['customer_name'] . '</center></td>';
											}
											else
											{
												echo "<td><center>NONE</center></td>";
											}
											if($row['project_name']!="")
											{
											echo '<td><center>' . $row['project_name'] . '</center></td>';
											}
											else
											{
												echo "<td><center>NONE</center></td>";
											}
										/* 	if($row['sales_lead_name']!="")
											{
											echo '<td><center>' . $row['sales_lead_name'] . '</center></td>';
											}
											else
											{
												echo "<td><center>NONE</center></td>";
											} */

											if($row['enquiry_status'] === 'Awaiting Quote')
											{
												echo '<td style="width:12%"><div class="badge bg-blue">' . "Awaiting Quote" . '</div></td>';
											}
											else if($row['enquiry_status'] === 'Quote Sent')
											{
												echo '<td style="width:12%"><div class="badge bg-lime"><center>' . "Quote Received" . '</div></td>';
											}
											else if( $row['enquiry_status']=="Rework Requested")
											{
												echo '<td style="width:12%"><div class="badge bg-orange"><center>' . "Rework Requested" . '</div></td>';
											}
											else if($row['enquiry_status'] == 'Order Received')
											{
												echo '<td style="width:12%"><div class="badge bg-green"><center>Quote Accepted</div></td>';
											}
											else
											{
												echo '<td style="width:12%"><div class="badge bg-blue">' . "Awaiting Quote" . '</div></td>';
											}

											if( $row['enquiry_priority']=="LOW" || $row['enquiry_priority']=="")
											{
												echo '<td style="width:12%"><div class="badge bg-teal">' . "LOW" . '</div></td>';
											}
											else if( $row['enquiry_priority']=="MEDIUM" || $row['enquiry_priority']=="medium" )
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
												echo '<td></td>';
											}

											if($row['pi_status'] == null)
											{
												echo '<td><center><button class="btn btn-info btn-xs">Awaitnig</button></center></td>';
											}
											else if($row['pi_status'] == 'Awaitnig')
											{
												echo '<td><center><button class="btn btn-info btn-xs">Awaitnig</button></center></td>';
											}
											else if($row['pi_status'] == 'approved')
											{
												echo '<td><center><button class="btn btn-success btn-xs">Approved</button></center></td>';
											}
											else {
												echo '<td><center><button class="btn btn-info btn-xs">Awaitnig</button></center></td>';
											}

											if($row['po_status'] == null || $row['po_status'] == "" || $row['po_status'] == "Awaitnig")
											{
													echo '<td><center><button class="btn btn-info btn-xs">Awaitnig</button></center></td>';
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
												echo '<td><center><button class="btn btn-info btn-xs">Awaitnig</button></center></td>';
											}
											echo"<td></td>";
											echo  "<td><center> <a target='_blank' href='../html/RFQ/view_rfq_html.php?id=" . $row['rfq_id'] . "' class='btn btn-primary btn-xs' title='view'><i class='fa fa-eye'></i></a></center></td>";
											if($row['po_status'] != "approved")
												echo  "<td><center> <a target='_blank' href='../html/RFQ/edit_rfq_html.php?id=" . $row['rfq_id'] . "' class='btn btn-warning btn-xs' title='Edit'><i class='fa fa-edit'></i></a></center></td>";
											else
												echo  "<td><center> <a  class='btn btn-warning btn-xs' disabled title='Edit'><i class='fa fa-edit'></i></a></center></td>";

											// if($user_result['role']=="Admin")
											// {
											// 	echo  "<td><center> <a onclick=\"return confirm('Delete this record?')\" href='../php/delete/delete_enquiry.php?id=" . $row['enquiry_id'] . "' class='btn btn-danger btn-xs'>Delete</a></center></td>";
											// }
											if($row['po_status'] != "approved")
												echo  "<td><center> <a onclick=\"return confirm('Delete this record?')\" href='../php/delete/delete_rfq_request.php?id=" . $row['rfq_id'] . "' class='btn btn-danger btn-xs' title='Delete'><i class='fa fa-trash'></i></a></center></td>";
											else
												echo  "<td><center> <a  href='#' class='btn btn-danger btn-xs'  title='Delete' disabled><i class='fa fa-trash'></i></a></center></td>";

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
	$("#li_rfq").addClass("active");
	$("#li_rfq_report").addClass("active");


		/* Setup - add a text input to each footer cell
    $('#view_enquiry_html tfoot th').each( function (i)
	{
        var title = $('#view_enquiry_html thead th').eq( $(this).index() ).text();
		 if($(this).index() !=9 && $(this).index() !=10 && $(this).index() !=11) // check if this is not first column header
		 {
        $(this).html( '<input type="text" placeholder="Search '+title+'" data-index="'+i+'" />' );
		 }
    } );*/

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
