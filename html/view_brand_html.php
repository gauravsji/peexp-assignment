<!--
Description: View brand displays brand information.
Date: 04/07/2017
-->
<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";
		$brand_id=$_GET["id"];
		$sql = "SELECT * FROM brand where brand_id = " . $brand_id;
		$result = mysqli_query($conn, $sql);
		$brand_result = mysqli_fetch_array($result,MYSQLI_ASSOC);	
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
						Brand Details
						<a href="../reports/brand_report_html.php" class="btn pull-right btn-sm">
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
										<i></i>   <center>Brand Name: <strong><?php echo $brand_result['brand_name'] ?></strong> </center>
										<div class="btn-toolbar">
											<?php echo '<a class="btn btn-primary btn-flat pull-right btn-sm" href="../html/edit_brand_html.php?id='.$brand_id.'"';'>'?>
												<button type="button" class="btn btn-primary ">
													<i class="fa fa-edit"></i> Edit
												</button>
											</a>
										</div>
									</h2>
								</div>
							</div>
							
							<div class="row invoice-info">
								<div class="col-sm-4 invoice-col">
									<address>
										<div class="table-responsive">
											<table class="table table-condensed">           
												<tr><td width="30%"><center> COMPANY CONNECT:</center> </td><td> <center><strong>  <strong>  <?php echo $brand_result['brand_company_connect'] ?></strong></center></td></tr>
												<tr><td width="30%"><center>CONTACT NUMBER:</center> </td><td> <center><strong>  <strong> <?php echo $brand_result['brand_company_connect_contact_number'] ?></strong></center></td></tr>
												<tr><td width="30%"><center>EMAIL:</center> </td><td> <center><strong>  <strong>   <?php echo $brand_result['brand_company_connect_email'] ?></strong></center></td></tr>
											</table>
										</div>	
									</address>
								</div>
								
								<div class="col-sm-4 invoice-col">
									<address>
										<div class="table-responsive">
											<table class="table table-condensed">  
												<tr><td width="25%"><center>ADDRESS:</center> </td></tr>
												<tr><td width="25%"><center><strong> <?php echo $brand_result['brand_company_connect_address'] ?></strong> </center> </td></tr>
											</table>
										</div>	
									</address>
								</div>
								<div class="col-md-4 invoice-col">
									<address>
										<div class="table-responsive">
											<table class="table table-condensed">  
												<tr><td width="25%"><center>ADDITIONAL INFO:</center> </td></tr>
												<tr><td width="25%"><center><strong> <?php echo $brand_result['brand_company_connect_additional_info'] ?></strong> </center> </td></tr>
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
												<tr><td width="25%"><center>BRAND DESCRIPTION:</center> </td></tr>
												<tr><td> <center><strong>  <?php echo $brand_result['brand_description'] ?></strong></center></td></tr>
											</table>
										</div>	
									</address>
								</div>
							</div>
							
							<div class="page-header">
							</div>

							<!-- this row will not appear when printing -->
							<div class="row no-print">
								<div class="col-xs-12">       
								</div>
							</div>


							<div class="page-header">
								Files				
							</div>
							<div class="table-responsive">
								<table class="table table-bordered table-condensed table-sm " id="view_vendor_product_html"cellspacing="0" width="100%">
									<thead>
										<tr>
											<th><center>File</center></th>
											<th><center>Delete</center></th>					
										</tr>
									</thead>
									<tbody>
										<?php
										$sql = "SELECT * FROM photo p, brand b where p.delete_status<>1 and p.module_name='brand' and p.module_id=b.brand_id and b.brand_id= " . $brand_id;
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
											echo '<td><center><a title="Delete" onclick="return confirm(\"Delete this record?\")" class="btn btn-danger" href="../php/delete/delete_brand_photo.php?id=' . $row['photo_id'] . '">Delete</a></center></td></tr>';					
										}
										?>
									</tbody>
								</table>
							</div>
						</div>  
					</div>
				</section>
			</div>

			<!-- Main Footer -->
			<footer class="main-footer">
			</footer>
			<!-- Main Footer -->

			<!--Including right slide panel-->
			<?php include "../extra/aside.php";?>
			<!--Including right slide panel-->
			<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
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
			$("#li_brand_report").addClass("active");
		});
	</script>
</html>
