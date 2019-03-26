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
				url: "../php/live_update/update_sub_category.php",
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
					<h1>Sub Category Report 
						<div class="btn-toolbar pull-right">
							
							<?php 
						if($user_result['role']=="Admin")
						{
							echo '<button class="btn btn-xs bg-olive pull-right" id="btnExport">Export</button>';
							echo '<a href="../html/add_sub_category_html.php" class="btn pull-right btn-xs btn-primary">New Sub Category</a>';
								}
						?>
						</div>
					</h1>
					
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="box">
						<div class="box-body">
							 <div class="table-responsive" id="table_wrapper">
							<table id="view_category_html" class="table table-bordered table-striped fixed table-condensed">
								<thead>
									<tr>
										<th><center>Sub Category Name</th>
										<th><center>Category Name</th>
										<th><center>Description</th>
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
									if($settings_result['view_all_category']!=1)
									{
										$sql = "SELECT * FROM category c, sub_category sc where sc.category_id=c.category_id and sc.delete_status<>1 and sc.location='".$user_result['location']."'";
									}
									else
									{
										$sql = "SELECT * FROM category c, sub_category sc where sc.category_id=c.category_id and sc.delete_status<>1";
									}
										$result = mysqli_query($conn,$sql);
										while ($row = mysqli_fetch_array($result))
										{
											// Print out the contents of the entry
											echo '<tr>';
											echo '<td align="center" contenteditable="true" onBlur=\'saveToDatabase(this,"sub_category_name",'. $row['sub_category_id'].')\' onClick="showEdit(this)">'.$row['sub_category_name'].'</td>';
											
											echo '<td align="center">'.$row['category_name'].'</td>';
											
											echo '<td align="center" contenteditable="true" onBlur=\'saveToDatabase(this,"sub_category_description",'. $row['sub_category_id'].')\' onClick="showEdit(this)">'.$row['sub_category_description'].'</td>';
											
											if($user_result['role']=="Admin")
											{
											echo  "<td><center> <a onclick=\"return confirm('Delete this record?')\" href='../php/delete/delete_sub_category.php?id=" . $row['sub_category_id'] . "' class='btn btn-danger btn-sm'>Delete</a></center></td>";
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
		<!-- ./wrapper -->
		<!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";?>
		<!--Including Bootstrap and other scripts-->
	</body>

	<script>
	$(document).ready(function()
	{
		// Handler for .ready() called.
			$("#li_product").addClass("active");
			$("#li_sub_category_report").addClass("active");
	$('#view_category_html').DataTable({
		"aLengthMenu": [[25, 50, 75, 100 , -1], [25, 50, 75, 100, "All"]],
        "iDisplayLength": 25
		});
		
			$("#btnExport").click(function(e) 
	{
    e.preventDefault();
    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table_wrapper');
    var table_html = table_div.outerHTML.replace(/ /g, '%20');

    var a = document.createElement('a');
    a.href = data_type + ', ' + table_html;
    a.download = 'Sub_Category_Report_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
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
