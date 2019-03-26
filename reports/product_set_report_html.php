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
					<h1>Product Set Report 
					<div class="btn-toolbar pull-right">
						
						<?php 
						if($user_result['role']=="Admin")
						{
							echo '<button class="btn btn-xs bg-olive pull-right" id="btnExport">Export</button>';
						echo '<a href="../html/add_product_set_html.php" class="btn pull-right btn-xs btn-primary">New Product Set</a>';
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
									<th><center>Product Set</center></th>
									<th><center>View</center></th>
									<th><center>Edit</center></th>
									<th><center>Certified</center></th>		
									<th><center>Category</center></th>
									<th><center>Sub Category</center></th>
									<th><center>Default Size</center></th>
									<th><center>Unit Of Measurement</center></th>
									<th><center>Data Added By</center></th>
									
									<?php
									if($user_result['role']=="Admin")
									{
									echo '<th><center>Delete</center></th>';
									}
									?>
								</tr>
							</thead>
							<!--
							<tfoot>
								<tr>
									<th><center>Product Set Name</center></th>
									<th><center>View</center></th>
									<th><center>Edit</center></th>
									<th><center>Certified</center></th>									
									<th><center>Category</center></th>
									<th><center>Sub Category</center></th>
									<th><center>Default Size</center></th>
									<th><center>Unit Of Measurement</center></th>
									<th><center>Data Added By</center></th>
									
									<?php
									if($user_result['role']=="Admin")
									{
									//echo '<th><center>Delete</center></th>';
									}
									?>
								</tr>
							</tfoot>-->
							<tbody>
								<?php
									if($settings_result['view_all_product_set']!=1)
									{
									$sql = "SELECT * FROM product_set p, category c ,sub_category sc ,users u where u.id=p.data_entered_by and p.category_id=c.category_id and p.sub_category_id=sc.sub_category_id and p.delete_status<>1 and p.location='".$user_result['location']."'";
									}
									else
									{
									$sql = "SELECT * FROM product_set p, category c ,sub_category sc ,users u where u.id=p.data_entered_by and p.category_id=c.category_id and p.sub_category_id=sc.sub_category_id and p.delete_status<>1";
									}
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
									echo '<td width="6%"><center>' . $row['product_set_product_name'] . '</center></td>';
									echo  "<td><center> <a href='../html/view_product_set_html.php?id=" . $row['product_set_id'] . "' class='btn btn-primary btn-xs'>View</a></center></td>";											
									echo  "<td><center> <a href='../html/edit_product_set_html.php?id=" . $row['product_set_id'] . "' class='btn btn-warning btn-xs'>Edit</a></center></td>";									
									echo '<td><center>'; 
									if($row['certify']=="Active")
									{
											echo "<div align='center' class='badge bg-green'>Active</div>";
									}
									else
									{
										echo "<div align='center' class='badge bg-red'>Inactive</div>";
									}
									
									echo '</center></td>';
									echo '<td><center>' . $row['category_name'] . '</center></td>';
									echo '<td><center>' . $row['sub_category_name'] . '</center></td>';
									echo '<td><center>' . $row['product_set_default_size'] . '</center></td>';
									echo '<td><center>' . $row['product_set_unit_of_measurement'] . '</center></td>';
									echo '<td><center>' . $row['name'] . '</center></td>';	
																		
											
											if($user_result['role']=="Admin")
											{
											echo  "<td><center> <a onclick=\"return confirm('Delete this record?')\" href='../php/delete/delete_product_set.php?id=" . $row['product_set_id'] . "' class='btn btn-danger btn-xs'>Delete</a></center></td>";
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
		$("#li_product_set_report").addClass("active");
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
    a.download = 'Product_Set_Report_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
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
