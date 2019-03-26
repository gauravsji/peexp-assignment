<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";?>
	<!--Including Login Session-->
	<head>
		<!--Including Bootstrap CSS links-->
		<?php include "../extra/header.html";?>
		<!--Including Bootstrap CSS links-->
		
		<script>
		function showEdit(editableObj) {
			jQuery(editableObj).css("background","#FFFFFF");
		} 
		
		function saveToDatabase(editableObj,column,id) {
			jQuery(editableObj).css("background","#FFFFFF");
			//alert('column='+column+'&editval='+editableObj.innerHTML+'&id='+id);
			jQuery.ajax({
				url: "../php/update/update_vendor.php",
				type: "POST",
				data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
				success: function(data){
					jQuery(editableObj).css("background","#f9f9f9");
				}        
		   });
		}
		</script>
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
					<h1>Payment Report  <a href="../html/add_payment_html.php" class="btn btn-xs pull-right btn-primary">New Payment</a></h1>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="box">
						<div class="box-body">
							<div class="table-responsive">
							<table id="view_vendor_html" class="table table-bordered table-striped table-fixed">
								<thead>
										<tr>
										<th><center>Payment Date</th>
										<th><center>Customer Name</th>
										<th><center>Project Name</th>
										<th><center>Vendor Name</th>
										<th><center>Payment Amount</th>
										<th><center>Payment Type</th>
										<th><center>Transaction Ref No</th>
										<th><center>Payment Method</th>
										<th><center>Remarks</th>
										<th><center>Quickbook Entry</th>
										<th><center>Data Added By</th>
										<th><center>View</th>
										<th><center>Edit</th>
										<th><center>Delete</th>
									</tr>
								</thead>
								
							
								
								<tbody>
								
								<?php
									if($settings_result['view_all_payment']!=1)
									{
										$sql="SELECT * FROM payment p
												LEFT OUTER JOIN vendor v ON p.vendor_id=v.vendor_id
												LEFT OUTER JOIN customer c ON p.customer_id=c.customer_id
												LEFT OUTER JOIN project pr ON p.project_id = pr.project_id
												LEFT OUTER JOIN users u ON p.data_entered_by = u.id
												WHERE p.delete_status <> 1 and p.location='".$user_result['location']."'";
												
												
									//$sql = "SELECT * FROM payment p, customer c where c.customer_id=p.customer_id and p.delete_status<>1 and p.location='".$user_result['location']."'";
									}
									else
									{
											$sql="SELECT * FROM payment p
												LEFT OUTER JOIN vendor v ON p.vendor_id=v.vendor_id
												LEFT OUTER JOIN customer c ON p.customer_id=c.customer_id
												LEFT OUTER JOIN project pr ON p.project_id = pr.project_id
												LEFT OUTER JOIN users u ON p.data_entered_by = u.id
												WHERE p.delete_status <> 1";
												
										//$sql = "SELECT * FROM payment where delete_status<>1";
									}
									$result = mysqli_query($conn,$sql);
									echo mysqli_error($conn);
									while ($row = mysqli_fetch_array($result))
									{
										// Print out the contents of the entry
										echo '<tr>';
										echo '<td><center>' .$row['payment_date']. '</center></td>';
										//echo '<td><center>' . $row['payment_date'] . '</center></td>';
										echo '<td><center>' . $row['customer_name'] . '</center></td>';
										echo '<td><center>' . $row['project_name'] . '</center></td>';
										echo '<td><center>' . $row['vendor_name'] . '</center></td>';
										echo '<td><center>' . $row['payment_amount'] . '</center></td>';
										echo '<td><center>' . $row['payment_type'] . '</center></td>';
										echo '<td><center>' . $row['payment_transaction_ref_no'] . '</center></td>';
										echo '<td><center>' . $row['payment_method'] . '</center></td>';
										echo '<td><center>' . $row['payment_remarks'] . '</center></td>';
										echo '<td><center>';
										if($row['quickbook_entry']==1) 
										{ 
											echo '<div class="badge bg-green" > Quickbook Updated</div>';
										} 
										else 
										{
											echo '<div class="badge bg-red" > Not Entered to Quickbook </div>';
										} 
										echo '</center></td>';	
										echo '<td><center>' . $row['name'] . '</center></td>';											
										echo  "<td><center> <a href='../html/view_payment_html.php?id=" . $row['payment_id'] . "' class='btn btn-primary btn-xs'>View</a></center></td>";
										echo  "<td><center> <a href='../html/edit_payment_html.php?id=" . $row['payment_id'] . "' class='btn btn-warning btn-xs'>Edit</a></center></td>";
										echo  "<td><center> <a href='../php/delete/delete_payment.php?id=" . $row['payment_id'] . "' class='btn btn-danger btn-xs'>Delete</a></center></td>";
									}
								?>
								
									
									
									
							<!--<tr class="table-row">
							<td contenteditable="true" onBlur="saveToDatabase(this,'vendor_name','3')" onClick="showEdit(this);">existing</td>
							</tr>-->
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

	  <!-- Modal -->
  <div class="modal fade" id="edit_vendor_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Vendor Details</h4>
        </div>
        <div class="modal-body">
		
		
		                       	   <div id="modal-loader" style="display: none; text-align: center;">
                       	              	   </div>
						   
						   
		 <div id="dynamic-content"></div>
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
 
	<!--Including Bootstrap and other scripts-->
	<?php include "../extra/footer.html";?>
	<!--Including Bootstrap and other scripts-->
	
	<script>
		$(document).ready(function()
		{
			// Handler for .ready() called.
			$("#li_payment").addClass("active");
			$("#li_payment_report").addClass("active");
	/* 	$('#view_vendor_html').DataTable({
		"aLengthMenu": [[25, 50, 75, 100 , -1], [25, 50, 75, 100, "All"]],
        "iDisplayLength": 25,		
		"order": [[0, "desc" ]],
		columnDefs: [
       { type: 'de_date', targets: 0 }
    ],
		});
		 */
		
		
		
		
				
		/* Setup - add a text input to each footer cell
    $('#view_vendor_html tfoot th').each( function (i) 
	{
        var title = $('#view_vendor_html thead th').eq( $(this).index() ).text();
		 if($(this).index() !=9 && $(this).index() !=11 && $(this).index() !=12 && $(this).index() !=13) // check if this is not first column header
		 {
        $(this).html( '<input type="text" placeholder="Search '+title+'" data-index="'+i+'" />' );
		 }
    } );*/
  
    // DataTable
    var table = $('#view_vendor_html').DataTable( {
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
		
		});
	</script>
	<script src="https://cdn.datatables.net/plug-ins/1.10.15/sorting/date-uk.js" />
	<script src="https://cdn.datatables.net/plug-ins/1.10.15/sorting/date-de.js" />
</html>
