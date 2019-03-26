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
					<h1>Enquiry Report <a href="../html/add_enquiry_html.php" class="btn pull-right btn-xs btn-primary">New Enquiry</a></h1>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="box">
									
				<div class="box-body">
				<div class="table-responsive">
							<table id="view_enquiry_html" class="table table-bordered table-striped table-condensed">
								<thead>
									<tr>
									<th><center>Enquiry Date</th>
									<th><center>Customer</th>
									<th><center>Project</th>
									<th><center>Sales Lead</th>
									<th><center>Enquiry Name</th>
									<th><center>Products</th>
									<th><center>Enquiry Details</th>
									<th><center>Assignee</th>
									<th><center>Enquiry Status</th>
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
										if($settings_result['view_all_enquiry']!=1)
										{
										$sql_enquiry = "SELECT * FROM enquiry where delete_status<>1";
										$result_enquiry = mysqli_query($conn, $sql_enquiry);
										$enquiry_result = mysqli_fetch_array($result_enquiry,MYSQLI_ASSOC);
	
				
										$sql = "SELECT * FROM enquiry e
												LEFT OUTER JOIN sales_lead sl ON e.sales_lead_id=sl.sales_lead_id
												LEFT OUTER JOIN customer c ON e.customer_id=c.customer_id
												LEFT OUTER JOIN project p ON e.project_id = p.project_id
												LEFT OUTER JOIN users u ON u.id = e.enquiry_assignee
												WHERE e.delete_status <> 1 and e.location='".$user_result['location']."' and (e.enquiry_status='CLOSED - REJECTED, PRICE TOO HIGH' or e.enquiry_status='CLOSED - REJECTED, NOT THE RIGHT PRODUCT' or e.enquiry_status='CLOSED - REJECTED, DELAYED REPONSE' or e.enquiry_status='CLOSED - CLIENT CHANGED REQUIREMENT' or e.enquiry_status='CLOSED - VENDOR NOT FOUND')";
										}
										else
										{
											$sql = "SELECT * FROM enquiry e
												LEFT OUTER JOIN sales_lead sl ON e.sales_lead_id=sl.sales_lead_id
												LEFT OUTER JOIN customer c ON e.customer_id=c.customer_id
												LEFT OUTER JOIN project p ON e.project_id = p.project_id
												LEFT OUTER JOIN users u ON u.id = e.enquiry_assignee
												WHERE e.delete_status <> 1 and e.enquiry_status='CLOSED - REJECTED, PRICE TOO HIGH' or e.enquiry_status='CLOSED - REJECTED, NOT THE RIGHT PRODUCT' or e.enquiry_status='CLOSED - REJECTED, DELAYED REPONSE' or e.enquiry_status='CLOSED - CLIENT CHANGED REQUIREMENT' or e.enquiry_status='CLOSED - VENDOR NOT FOUND'";
										}
										
										$result = mysqli_query($conn,$sql);
										while ($row = mysqli_fetch_array($result))
										{
											// Print out the contents of the entry
											echo '<tr>';
											$originalDate =  $row['enquiry_date'];
											echo '<td><center>' . date("d-m-Y", strtotime($originalDate)). '</center></td>';
											echo '<td><center>' . $row['customer_name'] . '</center></td>';
											echo '<td><center>' . $row['project_name'] . '</center></td>';
											echo '<td><center>' . $row['sales_lead_name'] . '</center></td>';
											echo '<td><center>' . $row['enquiry_name'] . '</center></td><td><table>';
											$sql1 = "SELECT * FROM enquiry_product ep, enquiry e where e.enquiry_id=ep.enquiry_id and e.delete_status<>1 and e.enquiry_id=".$row['enquiry_id'];
											$result1 = mysqli_query($conn,$sql1);
											echo '<tr><th>Product</th><th>Quantity</th><th>Quoted Price</th></tr>';
											while ($row1 = mysqli_fetch_array($result1))
											{
											echo '<tr><td>';
											echo $row1['enquiry_product_name']; 
											echo '</td><td>';
											echo $row1['enquiry_product_quantity'];
											echo '</td><td>';
											echo $row1['enquiry_buying_price'];
											echo '</td></tr>';
											}
											echo '</table>';
											echo '</td><td>	<center>' . $row['enquiry_details'] . '</center></td>';
											echo '<td><center>' . $row['name'] . '</center></td>';
											
											
										if(( $row['enquiry_status']=="OPEN - QUOTE TO BE SENT" )||( $row['enquiry_status']=="OPEN - AWAITING PRODUCT INFO FROM CLIENT" )||( $row['enquiry_status']=="OPEN - AWAITING PRODUCT INFO FROM VENDOR")||( $row['enquiry_status']=="OPEN - PRODUCT RESEARCH PENDING")||( $row['enquiry_status']=="OPEN - QUOTE SENT, AWAITING APPROVAL"))
											{
												echo '<td style="width:12%"><div class="badge bg-blue">' . "OPEN" . '</div></td>';
											}
											else if(($row['enquiry_status']=="CLOSED - REJECTED, PRICE TOO HIGH")||( $row['enquiry_status']=="CLOSED - REJECTED, NOT THE RIGHT PRODUCT")||( $row['enquiry_status']=="CLOSED - REJECTED, DELAYED REPONSE")||( $row['enquiry_status']=="CLOSED - CLIENT CHANGED REQUIREMENT")||( $row['enquiry_status']=="CLOSED - VENDOR NOT FOUND"))
											{
											echo '<td style="width:12%"><div class="badge bg-red"><center>' . "CLOSED" . '</div></td>';
											}
											else if( $row['enquiry_status']=="CLOSED - CONVERTED TO ORDER")
											{
											echo '<td style="width:12%"><div class="badge bg-green"><center>' . "ORDERED" . '</div></td>';
											}															
											else if( $row['enquiry_status']=="")
											{
											echo '<td style="width:12%"><div class="badge bg-red"><center>Nulled</div></td>';
											}

											
											echo  "<td><center> <a href='../html/view_enquiry_html.php?id=" . $row['enquiry_id'] . "' class='btn btn-primary btn-xs'>View</a></center></td>";
											echo  "<td><center> <a href='../html/edit_enquiry_html.php?id=" . $row['enquiry_id'] . "' class='btn btn-warning btn-xs'>Edit</a></center></td>";
											if($user_result['role']=="Admin")
											{
											echo  "<td><center> <a onclick=\"return confirm('Delete this record?')\" href='../php/delete/delete_enquiry.php?id=" . $row['enquiry_id'] . "' class='btn btn-danger btn-xs'>Delete</a></center></td>";
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
	$("#li_enquiry").addClass("active");
	$("#li_enquiry_report").addClass("active");
	$('#view_enquiry_html').DataTable({
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
</html>
