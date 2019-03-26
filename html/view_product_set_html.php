<!--
Description: View product set module shows product set information.
Date: 04/07/2017
-->
<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";
		$product_set_id=$_GET["id"];
		$sql = "SELECT * FROM category c, sub_category sc, product_set ps where ps.category_id=c.category_id and ps.sub_category_id=sc.sub_category_id and ps.product_set_id = " . $product_set_id;
		$result = mysqli_query($conn, $sql);
		$product_set_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
	?>
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

			<div class="content-wrapper">
				<section class="content-header">
					<h1>
						Product Set Details
						<a href="../reports/product_set_report_html.php" class="btn pull-right">
							<button type="button" class="btn btn-primary btn-sm">
								<i class="fa fa-arrow-left"></i> Back To Report
							</button>
						</a>
					</h1>
				</section>

				<section class="content">
					<div class="box">
						<div class="box-body pad">
							<div class="row">
								<div class="col-xs-12">
									<h2 class="page-header">
										<i></i> <center> Product Set Name:  <strong><?php echo $product_set_result['product_set_product_name'] ?>  </strong></center>
										<div class="btn-toolbar">
											<?php echo '<a class="btn btn-primary btn-flat pull-right" href="../html/edit_product_set_html.php?id='.$product_set_id.'"';'>'?>
												<button type="button" class="btn btn-primary btn-sm">
													<i class="fa fa-edit"></i> Edit
												</button>
											</a>
										</div>
									</h2>
								</div>
							</div>
							
							<div class="row invoice-info">
								<div class="col-sm-6 invoice-col">
									<address>      
										<div class="table-responsive">
											<table class="table table-condensed">
												<tr><td width="25%"><center>CATEGORY NAME:</center> </td><td> <center><strong>  <?php echo $product_set_result['category_name'] ?></strong></center></td></tr>	
												<tr><td width="25%"><center>SUB CATEGORY NAME:</center> </td><td> <center><strong>  <strong>  <?php echo $product_set_result['sub_category_name'] ?></strong></center></td></tr>
											</table>
										</div>	
									</address>
								</div>
								
								<div class="col-sm-6 invoice-col">
									<address>   
										<div class="table-responsive">
											<table class="table table-condensed">
												<tr><td width="25%"><center> DEFAULT SIZE:</center> </td><td> <center><strong>  <?php echo $product_set_result['product_set_default_size'] ?></strong></center></td></tr>			
												<tr><td width="25%"><center>TAX:</center> </td><td> <center><strong>   <?php echo $product_set_result['product_set_tax'] ?></strong></center></td></tr>
												<tr><td width="25%"><center>UNIT OF MEASUREMENT:</center> </td><td> <center><strong>   <?php echo $product_set_result['product_set_unit_of_measurement'] ?></strong></center></td></tr>
											</table>
										</div>	
									</address>
								</div>
							</div>

							<div class="row invoice-info">
								<div class="col-sm-12 invoice-col">
									<address>
										<div class="table-responsive">
											<table class="table table-condensed">   
												<tr><td width="25%"><center>DESCRIPTION:</center> </td></tr>
												<tr><td> <center><strong>  <?php echo $product_set_result['product_set_description'] ?></strong></center></td></tr>
											</table>
										</div>	
									</address>
								</div>			
							</div>

							<div class="page-header">
							</div>

							<center><strong> <H3>ATTRIBUTES</H3> </strong></center>
							<div class="table-responsive">
								<table id="product_set_attribute" class='table table-bordered table-striped table-fixed table-condensed'>
									<thead>
										<tr>
											<th><center>Attribute Name</th>
											<th><center>Attribute Value</th>
										</tr>
									</thead>
									<tbody>
										<tr>
										<?php
										$sql = 'SELECT * FROM product_set ps, product_set_attribute psa, key_value kv where psa.product_set_attribute_id_fk_key_value=kv.key_value_id and ps.product_set_id='.$product_set_id.' and ps.product_set_id=psa.product_set_id and psa.delete_status<>1';
										$result = mysqli_query($conn,$sql);
										while ($row = mysqli_fetch_array($result))
										{
											// Print out the contents of the entry
											echo '<td><center>' . $row['value'] . '</center></td>';
											echo '<td><center>' . $row['product_set_attribute_value'] . '</center></td></tr>';
										}
										?>
									</tbody>
								</table>
							</div>		

							<div class="page-header">
							</div>

							<center><strong> <H3>BRANDS</H3> </strong></center>

							<div class="table-responsive">
								<table id="brands_table" class='table table-bordered table-striped table-fixed table-condensed'>
									<thead>
										<tr>
											<th><center>Brand Name</th>
											<th><center>Brand Description</th>
										</tr>
									</thead>
									<tbody>
										<tr>
										<?php
										$sql = "SELECT * FROM brand b where b.product_set_id=".$product_set_id." and b.delete_status<>1 order by b.brand_name";								
										$result = mysqli_query($conn,$sql);
										while ($row = mysqli_fetch_array($result))
										{
											// Print out the contents of the entry
											echo '<td><center>' . $row['brand_name'] . '</center></td>';
											echo '<td><center>' . $row['brand_description'] . '</center></td></tr>';
										}
										?>
									</tbody>
								</table>
							</div>

							<div class="page-header">
							</div>

							<div class="page-header">
								Files				
							</div>
							
							<table class="table table-bordered table-condensed table-sm table-responsive" id="view_vendor_product_html"cellspacing="0" width="100%">
								<thead>
									<tr>
										<th><center>File</center></th>
										<th><center>Delete</center></th>					
									</tr>
								</thead>
								<tbody>
									<?php
										$sql = "SELECT * FROM photo p, product_set ps where p.delete_status<>1 and p.module_name='product_set' and p.module_id=ps.product_set_id and ps.product_set_id= " . $product_set_id;
										$result = mysqli_query($conn,$sql);
										while ($row = mysqli_fetch_array($result))
										{
											// Print out the contents of the entry
											if((substr($row['photo_name'], -3))=="pdf")
											{
												echo '<tr><td><center><a href="../uploads/'.$row['photo_name'].'"/>Open PDF Attachment</a></td>';
											}
											else if((substr($row['photo_name'], -4))=="docx")
											{
												echo '<tr><td><center><a href="../uploads/'.$row['photo_name'].'"/>Open Word Attachment</a></td>';
											}
											else if((substr($row['photo_name'], -3))=="doc")
											{
												echo '<tr><td><center><a href="../uploads/'.$row['photo_name'].'"/>Open Word Attachment</a></td>';
											}
											else if((substr($row['photo_name'], -4))=="xlsx")
											{
												echo '<tr><td><center><a href="../uploads/'.$row['photo_name'].'"/>Open Excel Attachment</a></td>';
											}
											else if((substr($row['photo_name'], -3))=="xls")
											{
												echo '<tr><td><center><a href="../uploads/'.$row['photo_name'].'"/>Open Excel Attachment</a></td>';
											}
											else
											{
												echo '<tr><td><center><img width="35%" class="fancybox" height="35%" src="../uploads/'.$row['photo_name'].'"/></center></td>';
											}					
											echo '<td><center><a title="Delete" onclick="return confirm(\"Delete this record?\")" class="btn btn-danger" href="../php/delete/delete_product_set_photo.php?id=' . $row['photo_id'] . '">Delete</a></center></td></tr>';					
										}
									?>
								</tbody>
							</table>

							<!-- this row will not appear when printing -->
							<div class="row no-print">
								<div class="col-xs-12">
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>

			<!-- Main Footer -->
			<footer class="main-footer">
			</footer>

			<!--Including right slide panel-->
			<?php include "../extra/aside.php";?>
			<!--Including right slide panel-->
			
			<!-- Add the sidebar's background. This div must be placed
			immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		</div>
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

			$('#brands_table').DataTable({
			"aLengthMenu": [[25, 50, 75, 100 , -1], [25, 50, 75, 100, "All"]],
			"iDisplayLength": 0
			});

			$('#product_set_attribute').DataTable({
			"aLengthMenu": [[25, 50, 75, 100 , -1], [25, 50, 75, 100, "All"]],
			"iDisplayLength": 0
			});
		});
	</script>
</html>