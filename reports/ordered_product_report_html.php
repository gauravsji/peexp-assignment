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
					<h1>Ordered Products Report 
					<div class="btn-toolbar pull-right">
						
						<?php 
						if($user_result['role']=="Admin")
						{
							echo '<button class="btn btn-xs bg-olive pull-right" id="btnExport">Export</button>';
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
						<table id="view_product_html" cellspacing="0"  cellpadding="0" class="table table-bordered table-striped fixed table-condensed">
							<thead>
								<tr>
									<th><center>Order ID</center></th>
									<th><center>Vendor Name</center></th>
									<th><center>Customer Name</center></th>								
									<th><center>Ordered Product Name</center></th>		
									<th><center>Product Description</center></th>
									<th><center>Buying Price</center></th>							
								</tr>
							</thead>				
							<tbody>
								<?php
									
									$sql = "SELECT * FROM `ORDER_PRODUCTS_VIEW`";
																
									$result = mysqli_query($conn,$sql);
									if (!$result) 
									{
										//Statement To Check For ERROR's
										printf("Error: %s\n", mysqli_error($conn));
										exit();
									}
									while ($row = mysqli_fetch_array($result))
									{
									// Print out the contents of the entry
									echo '<tr>';
									echo '<td width="6%"><center><a href="../html/view_order_html.php?id=' . $row['order_id'] . '">' . $row['order_id'] . '</a></center></td>';						
									echo '<td><center>' . $row['vendor_name'] . '</center></td>';
									echo '<td><center>' . $row['customer_name'] . '</center></td>';
									echo '<td><center>' . $row['order_product_name'] . '</center></td>';
									echo '<td><center>' . $row['order_product_description'] . '</center></td>';
									echo '<td><center>' . $row['order_discounted_price'] . '</center></td>';								
										
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
		$("#li_order").addClass("active");
		$("#li_ordered_product_report").addClass("active");
	/* 	$('#view_product_html').DataTable(
		{
		"aLengthMenu": [[25, 50, 75, 100 , -1], [25, 50, 75, 100, "All"]],
        "iDisplayLength": 25
		}); */
		
		
						
		/* Setup - add a text input to each footer cell
    $('#view_product_html tfoot th').each( function (i) 
	{
        var title = $('#view_product_html thead th').eq( $(this).index() ).text();
		 if($(this).index() !=6 && $(this).index() !=7 && $(this).index() !=8) // check if this is not first column header
		 {
        $(this).html( '<input type="text" placeholder="Search '+title+'" data-index="'+i+'" />' );
		 }
    } );*/
  
    // DataTable
    var table = $('#view_product_html').DataTable( {
		 
        scrollY:        "600px",
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
		
		
		
		$("#btnExport").click(function(e) 
	{
    e.preventDefault();
    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table_wrapper');
    var table_html = table_div.outerHTML.replace(/ /g, '%20');

    var a = document.createElement('a');
    a.href = data_type + ', ' + table_html;
    a.download = 'Order_Product_Report_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
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
