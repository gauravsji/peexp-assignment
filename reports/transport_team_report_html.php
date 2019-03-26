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
					<h1>Transport Team Report   <a href="../html/add_transport_team_html.php" class="btn pull-right btn-xs btn-primary">New Transport Team</a></h1>
					
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="box">
						<div class="box-body">
							 <div class="table-responsive">
							<table id="view_vendor_html" class="table table-bordered table-striped table-fixed">
								<thead>
									<tr>
										<th><center>Person Name</th>
										<th><center>Contact Number</th>
										<th><center>Alternate Contact Number</th>
										<th><center>Company Name</th>
										<th><center>Vehicle Name</th>
										<th><center>Vehicle Number</th>
										<th><center>Load Capacity</th>
										<th><center>Vehicle Type</th>
										<th><center>Action</th>
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
									if($settings_result['view_all_transport_team']!=1)
									{
									$query = "SELECT * FROM transport_team where delete_status<>1 and location='".$user_result['location']."'";
									}
									else
									{
										$query = "SELECT * FROM transport_team where delete_status<>1";
									}
									$transport_result = mysqli_query($conn,$query);
									while ($row = mysqli_fetch_array($transport_result))
									{
									// Print out the contents of the entry 
									echo '<tr>';
									echo '<td><center>' . $row['transport_team_person_name'] . '</center></td>';
									echo '<td><center>' . $row['transport_team_contact_number'] . '</center></td>';
									echo '<td><center>' . $row['transport_team_alternate_contact_number'] . '</center></td>';
									echo '<td><center>' . $row['transport_team_company_name'] . '</center></td>';
									echo '<td><center>' . $row['transport_team_vehicle_name'] . '</center></td>';
									echo '<td><center>' . $row['transport_team_vehicle_number'] . '</center></td>';
									echo '<td><center>' . $row['transport_team_load_capacity'] . '</center></td>';
									echo '<td><center>' . $row['transport_team_vehicle_type'] . '</center></td>';
									echo  "<td><center> <a href='../html/edit_transport_team_html.php?id=" . $row['transport_team_id'] . "' class='btn btn-warning btn-xs'>Edit</a></center></td>";
									if($user_result['role']=="Admin")
									{
									echo  "<td><center> <a onclick=\"return confirm('Delete this record?')\" href='../php/delete/delete_transport_team.php?id=" . $row['transport_team_id'] . "' class='btn btn-danger btn-xs'>Delete</a></center></td>";
									}
									echo "</tr>";
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
			$("#li_transport").addClass("active");
			$("#li_transport_team_report").addClass("active");
		$('#view_vendor_html').DataTable({
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
