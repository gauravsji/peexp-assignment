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
							<table id="view_enquiry_html" class="table table-bordered table-striped table-condensed stripe row-border order-column" width="100%">
								<thead>
									<tr>
									<th width="5%"><center>Enquiry ID</center></th>
									
									<th width="5%"><center>Enquiry Date</center></th>
									<th><center>Enquiry Name</center></th>
									
									
									<th><center>Customer</center></th>
									<th><center>Project</center></th>
									<!-- <th><center>Sales Lead</center></th> -->
									<th><center>Assignee</center></th>
									<th><center>Enquiry Status</center></th>
									<th><center>Enquiry Priority</center></th>
									
									<th><center>View</center></th>
									<th><center>Edit</center></th>
									
									<?php
										if($user_result['role']=="Admin")
										{
										echo '<th><center>Delete</center></th>';
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
												WHERE e.delete_status <> 1 and e.enquiry_date > DATE_SUB( CURDATE( ) , INTERVAL 1 YEAR ) and e.location='".$user_result['location']."'";
										}
										else
										{
											$sql = "SELECT * FROM enquiry e
												LEFT OUTER JOIN sales_lead sl ON e.sales_lead_id=sl.sales_lead_id
												LEFT OUTER JOIN customer c ON e.customer_id=c.customer_id
												LEFT OUTER JOIN project p ON e.project_id = p.project_id
												LEFT OUTER JOIN users u ON u.id = e.enquiry_assignee
												WHERE e.delete_status <> 1 and e.enquiry_date > curdate()-800";
										}
										
										$result = mysqli_query($conn,$sql);
										while ($row = mysqli_fetch_array($result))
										{
											// Print out the contents of the entry
											echo '<tr>';
											////$originalDate =  $row['enquiry_date'];
											//echo '<td  width="5%"><center>' . date("d-m-Y", strtotime($originalDate)). '</center></td>';
											echo '<td  width="5%"><center>' . $row['enquiry_id'] . '</center></td>';
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
											
											if( $row['enquiry_priority']=="LOW" || $row['enquiry_priority']=="")
											{
												echo '<td style="width:12%"><div class="badge bg-teal">' . "LOW" . '</div></td>';
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
										
											echo  "<td><center> <a target='_blank' href='../html/view_enquiry_html.php?id=" . $row['enquiry_id'] . "' class='btn btn-primary btn-xs'>View</a></center></td>";
											echo  "<td><center> <a target='_blank' href='../html/edit_enquiry_html.php?id=" . $row['enquiry_id'] . "' class='btn btn-warning btn-xs'>Edit</a></center></td>";
											
											
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
