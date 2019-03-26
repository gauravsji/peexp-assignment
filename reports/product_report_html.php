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
					<h1>Product Report  
					<div class="btn-toolbar pull-right">
					<?php 
						if($user_result['role']=="Admin")
						{
						echo '<button class="btn btn-xs bg-olive pull-right" id="btnExport">Export</button>';
						}
						?>
					<a href="../html/add_product_html.php" class="btn pull-right btn-xs btn-primary">New Product
					
					</a>
					</div>
					</h1>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="box">
						<div class="box-body">
							<div class="table-responsive" id="table_wrapper">
						<table id="view_product_html" class="table table-bordered table-striped fixed table-condensed">
							<thead>
								<tr>
									<th>Product ID</th>
									<th>Product</th>
									<th>Product Description</th>
									<th>MRP</th>
									<th>Product Set</th>
									<th>Brand</th>
									<th>Data Added By</th>
									<th>View</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr>
							</thead>
													
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
			$("#li_product_report").addClass("active");
  
	var table = $('#view_product_html').DataTable( {
					"processing": true,
					"serverSide": true,
					"ajax":{
						url :"../php/server_side_products_access.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="10">No data found in the server</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
							
					}},
					"columnDefs": [ 
					 {
                "targets": [ 0 ],
                "visible": false
            },
			
					{
					"targets": 9,
					"data": null,
					"defaultContent": "<button class='btn btn-danger btn-xs' id='delete'>Delete</button>"
					},
					
					{
					"targets": 8,
					"data": null,
					"defaultContent": "<button class='btn btn-warning btn-xs' id='edit'>Edit</button> "},
					
					{
					"targets": 7,
					"data": null,
					"defaultContent": "<button class='btn btn-primary btn-xs' id='view'>View</button> "
									} ]	
						
					
				} );
 
  
  
    $('#view_product_html tbody ').on( 'click', '#edit', function () 
	{
        var data = table.row( $(this).parents('tr') ).data();
        window.location.href = "../html/edit_product_html.php?id="+ data[0];
    } );
 	
	
	    $('#view_product_html tbody ').on( 'click', '#delete', function () 
	{
		var choice = confirm('Do you really want to delete this record?');
			if(choice === true) 
			{
				var data = table.row( $(this).parents('tr') ).data();
        window.location.href = "../php/delete/delete_product.php?id="+ data[0];//return true;
			}
			return false;
			
			
        
    } );
	
		    $('#view_product_html tbody ').on( 'click', '#view', function () 
	{
        var data = table.row( $(this).parents('tr') ).data();
        window.location.href = "../html/view_product_html.php?id="+ data[0];
    } );
	
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
