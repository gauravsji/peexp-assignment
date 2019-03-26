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
					<h1>Sample Data Report  <a href="../html/sample_data_html.php" class="btn pull-right btn-xs btn-primary">New Sample Data</a></h1>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="box">
						<div class="box-body">
							<div class="table-responsive">
							<table id="view_sample_log_html" class="table table-bordered table-striped table-fixed">
								<thead>
									<tr>
										<th><center>Name</th>
										<th><center>Brand Name</th>
										<th><center>Sample Type</th>
										<th><center>Sample Section</th>
										<th><center>Sample Number</th>
										<th><center>Description</th>
										<th><center>Edit</th>
										<th><center>Delete</th>
									</tr>
								</thead>
								<tbody>
								
								
								<?php
									if($settings_result['view_all_sample']!=1)
									{
									$sql = "SELECT * FROM sample_data s, brand b where s.brand_id=b.brand_id and s.delete_status<>1 and s.location='".$user_result['location']."'";
									}
									else
									{
										$sql = "SELECT * FROM sample_data s, brand b where s.brand_id=b.brand_id and s.delete_status<>1";
									}
									$result = mysqli_query($conn,$sql);
									while ($row = mysqli_fetch_array($result))
									{
									// Print out the contents of the entry
									echo '<tr>';
									echo '<td><center>' . $row['sample_catalogue_name'] . '</center></td>';
									echo '<td><center>' . $row['brand_name'] . '</center></td>';
									echo '<td><center>' . $row['sample_catalogue_type'] . '</center></td>';
									echo '<td><center>' . $row['sample_catalogue_section'] . '</center></td>';
									echo '<td><center>' . $row['sample_catalogue_number'] . '</center></td>';
									echo '<td><center>' . $row['sample_catalogue_description'] . '</center></td>';
									echo  "<td><center> <a href='../html/edit_sample_data_html.php?id=" . $row['sample_data_id'] . "' class='btn btn-warning btn-sm'>Edit</a></center></td>";
									echo  "<td><center> <a onclick=\"return confirm('Delete this record?')\" href='../php/delete/delete_sample_data.php?id=" . $row['sample_data_id'] . "' class='btn btn-danger btn-sm'>Delete</a></center></td></tr>";
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
			$("#li_sample_management").addClass("active");
			$("#li_sample_data_report").addClass("active");
		$('#view_sample_log_html').DataTable({
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
