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
				url: "../php/live_update/update_key_value.php",
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
					<h1>Key Value Report</h1>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="box">
						<div class="box-body">
						    <div class="table-responsive">
							<table id="view_brand_html" class="table table-bordered table-striped table-fixed">
								<thead>
									<tr>
										<th><center>Key</th>
										<th><center>Value</th>
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
								if($settings_result['view_key_value']!=1)
									{
										$sql = "SELECT * FROM key_value where delete_status<>1 and location='".$user_result['location']."'";
									}
									else
									{
									$sql = "SELECT * FROM key_value where delete_status<>1";
									}
									$result = mysqli_query($conn,$sql);
									while ($row = mysqli_fetch_array($result))
									{
										
										echo '<tr>';
											echo '<td align="center">'.$row['key_column'].'</td>';
											
											echo '<td align="center" contenteditable="true" onBlur=\'saveToDatabase(this,"value",'. $row['key_value_id'].')\' onClick="showEdit(this)">'.$row['value'].'</td>';
											if($user_result['role']=="Admin")
									{
											echo  "<td><center> <a onclick=\"return confirm('Delete this record?')\" href='../php/delete/delete_key_value.php?id=" . $row['key_value_id'] . "' class='btn btn-danger btn-xs'>Delete</a></center></td>";
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
		<!--./wrapper -->
	</body>
	<!--Including Bootstrap and other scripts-->
	<?php include "../extra/footer.html";?>
	<!--Including Bootstrap and other scripts-->
	<script>
		$(document).ready(function()
		{
			// Handler for .ready() called.
			$("#li_misc").addClass("active");
			$("#li_key_value_report").addClass("active");
		$('#view_brand_html').DataTable({
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
