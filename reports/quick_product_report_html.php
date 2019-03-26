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
		function showEdit(editableObj) 
		{
			jQuery(editableObj).css("background","#FFFFFF");
		} 
		
		function saveToDatabase(editableObj,column,id) {
			jQuery(editableObj).css("background","#FFFFFF");
			//alert('column='+column+'&editval='+editableObj.innerHTML+'&id='+id);
			jQuery.ajax({
				url: "../php/live_update/update_quick_product_php.php",
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
					<h1>Quick Product Report 
					<div class="btn-toolbar pull-right">
					<a href="../html/add_quick_product_html.php" class="btn btn-xs btn-primary">New Quick Product</a>  
					</div>
					</h1>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="box">
						<div class="box-body">
							 <div class="table-responsive">
							<table id="view_quick_product_html" class="table table-bordered dt-responsive table-condensed table-striped">
								<thead class="thead-inverse">
									<tr>
										<th><center>Quick Product Name</th>
										<th><center>Description</th>
										<th><center>Selling Price</th>
										<th><center>Buying Price</th>
										<th><center>Tax</th>
										<th><center>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sql = "SELECT * FROM quick_product";
									$result = mysqli_query($conn,$sql);
									while ($row = mysqli_fetch_array($result))
									{
									// Print out the contents of the entry
									echo '<tr class="table-row">';
									echo '<td align="center">'.$row['quick_product_name'].'</td>';
									//echo '<td align="center">Quantity</td>';
									echo '<td align="center">'.$row['quick_product_description'].'</td>';
									echo '<td align="center">'.$row['quick_product_bp'].'</td>';
									echo '<td align="center">'.$row['quick_product_sp'].'</td>';
									echo '<td align="center">'.$row['quick_product_tax'].'</td>';
									echo "<td style='min-width: 90px'>
									<div class='btn-group action pull-right'>
										<button type='button' class='btn bg-green'><i class='fa fa-cog' aria-hidden='true'></i> </button>
										<button type='button' class='btn bg-green dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
											<span class='caret'></span>
											<span class='sr-only'> Toggle Dropdown</span>
										</button>
										<ul class='dropdown-menu'>
											<li>
											<a title='Edit' href='../html/edit_quick_product_html.php?id=" . $row['quick_product_id'] . "'>
											<i class='fa fa-pencil-square' aria-hidden='true'></i>Edit</a>
											</li>";
											
										if($user_result['role']=="Admin")
										{
											echo "<li>
											<a title='Delete' onclick=\"return confirm('Delete this record?')\" href='../php/delete/delete_quick_product.php?id=" . $row['quick_product_id'] . "'>
											<i class='fa fa-trash-o' aria-hidden='true'></i>Delete</a>
											</li>";
											}
										echo "
										</ul>
									</div></td></tr>";
						
										
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
	
	
	<!--Including Bootstrap and other scripts-->
	<?php include "../extra/footer.html";?>
	<!--Including Bootstrap and other scripts-->

	<script>
		$(document).ready(function()
		{
			  $.fn.dataTable.moment( 'HH:mm MMM D, YY' );
			  $.fn.dataTable.moment( 'dddd, MMMM Do, YYYY' );
			// Handler for .ready() called.
			//$("#li_quick_product").addClass("active");
			//$("#li_quick_product_report").addClass("active");
		$('#view_quick_product_html').DataTable({
		"aLengthMenu": [[25, 50, 75, 100 , -1], [25, 50, 75, 100, "All"]],
        "iDisplayLength": 25,
		"columnDefs":[ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],	 
		"order": [3, "ASC"],	
		 responsive: true	 
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
