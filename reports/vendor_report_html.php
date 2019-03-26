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
			jQuery.ajax({
				url: "../php/live_update/update_vendor.php",
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
					<h1>Vendor Report 
					<div class="btn-toolbar pull-right">
					
										<?php
										if($user_result['role']=="Admin")
										{
							echo '<button class="btn btn-xs bg-olive pull-right" id="btnExport">Export</button>';
										}
										?>
							<a href="../html/add_vendor_html.php" class="btn pull-right btn-xs btn-primary">New Vendor</a>
							</div></h1>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="box">
						<div class="box-body">
						 <div class="table-responsive" id="table_wrapper">
							<table id="view_vendor_html" class="table table-bordered table-condensed table-sm table-responsive" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th><center>Vendor Name</th>
										<th><center>View</th>
										<th><center>Edit</th>
										<th><center>City</th>
										<th><center>Contact Person</th>
										<th><center>Contact Number</th>										
										<th><center>Email</th>		
										<th><center>Address</th>
										<th><center>Authenticate</th>
										<th><center>Deals With</th>
										<th><center>Additional Info</th>
										
										<th><center>Data Added By</th>										
										
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
									if($settings_result['view_all_vendor']!=1)
									{
									$sql = "SELECT * FROM users u,vendor v where v.delete_status<>1 and v.data_entered_by=u.id and v.location='".$user_result['location']."'";
									}
									else
									{
										$sql = "SELECT * FROM users u,vendor v where v.delete_status<>1 and v.data_entered_by=u.id";
									}
									
									$result = mysqli_query($conn,$sql);
									while ($row = mysqli_fetch_array($result))
									{
									// Print out the contents of the entry
									echo '<tr class="table-row">';
									echo '<td align="center" contenteditable="true" onBlur=\'saveToDatabase(this,"vendor_name",'. $row['vendor_id'].')\' onClick="showEdit(this)">'.$row['vendor_name'].'</td>';
										echo  "<td><center> <a href='../html/view_vendor_html.php?id=" . $row['vendor_id'] . "' class='btn btn-primary btn-xs'>View</a></center></td>";
									echo  "<td><center> <a href='../html/edit_vendor_html.php?id=" . $row['vendor_id'] . "' class='btn btn-warning btn-xs'>Edit</a></center></td>";
									echo '<td>'.$row['vendor_city'].'</td>';
									echo '<td contenteditable="true" onBlur=\'saveToDatabase(this,"vendor_contact_person",'. $row['vendor_id'].')\' onClick="showEdit(this)">'.$row['vendor_contact_person'].'</td>';
									echo '<td contenteditable="true" onBlur=\'saveToDatabase(this,"vendor_contact_number",'. $row['vendor_id'].')\' onClick="showEdit(this)">'.$row['vendor_contact_number'].'</td>';
									echo '<td contenteditable="true" onBlur=\'saveToDatabase(this,"vendor_email",'. $row['vendor_id'].')\' onClick="showEdit(this)">'.$row['vendor_email'].'</td>';																
									
									echo '<td contenteditable="true" onBlur=\'saveToDatabase(this,"vendor_address",'. $row['vendor_id'].')\' onClick="showEdit(this)">'.$row['vendor_address'].'</td>';
									echo '<td>'; if($row['authenticate']=="Data Authentic") { echo '<div align="center" class="badge bg-green">Authenticated</div>'; } else {echo '<div align="center" class="badge bg-blue">Unauthenticated</div>';}echo '</td>';
									echo '<td contenteditable="true" onBlur=\'saveToDatabase(this,"vendor_brands_dealing",'. $row['vendor_id'].')\' onClick="showEdit(this)">'.$row['vendor_brands_dealing'].'</td>';
									echo '<td contenteditable="true" onBlur=\'saveToDatabase(this,"vendor_additional_info",'. $row['vendor_id'].')\' onClick="showEdit(this)">'.$row['vendor_additional_info'].'</td>';
									
									echo '<td><center>' . $row['name'] . '</center></td>';	
								
									if($user_result['role']=="Admin")
									{
									echo  "<td><center> <a onclick=\"return confirm('Delete this record?')\" href='../php/delete/delete_vendor.php?id=" . $row['vendor_id'] . "' class='btn btn-danger btn-xs'>Delete</a></center></td>";
									}
									echo "</tr>";
									}
									?>			
									</tbody>
							</table>
						</div>
						</div>
						 <!--/.box-body -->
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
                       	   	<img src="ajax-loader.gif">
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
			$("#li_vendor").addClass("active");
			$("#li_vendor_report").addClass("active");
		/*$('#view_vendor_html').DataTable({
		"aLengthMenu": [[25, 50, 75, 100 , -1], [25, 50, 75, 100, "All"]],
        "iDisplayLength": 25
		});*/
		
		
		
		/* Setup - add a text input to each footer cell
    $('#view_vendor_html tfoot th').each( function (i) 
	{
        var title = $('#view_vendor_html thead th').eq( $(this).index() ).text();
		 if($(this).index() !=1 && $(this).index() !=2 && $(this).index() !=12) // check if this is not first column header
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
        iDisplayLength: 25,
		"columnDefs": [           
            {
                "targets": [ 9,10 ],
                "visible": false
            }
        ]
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
    a.download = 'Vendor_Report_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
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
