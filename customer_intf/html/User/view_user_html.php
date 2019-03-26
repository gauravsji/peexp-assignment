<!--
Description: View customer displays customer information.
Date: 04/07/2017
-->
<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php
		include "../../extra/session.php";
		include "../../constants.php";
		$customer_id=$_GET["id"];
		$sql = "SELECT * FROM customer where customer_id=". $customer_id;
		$result = mysqli_query($conn, $sql);
		$customer_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
	?>

	<!--Including Login Session-->
	<head>
		<!--Including Bootstrap CSS links-->
		<?php include "../../extra/header.html";?>
		<!--Including Bootstrap CSS links-->

	</head>
	<body class="hold-transition skin-blue fixed sidebar-mini">
		<div class="wrapper">
			<!--Including Topbar-->
			<?php include "../../extra/topbar.php";?>
			<!--Including Topbar-->

			<!-- Left Side Panel Which Contains Navigation Menu -->
			<?php include "../../extra/left_nav_bar.php";?>
			<!-- Left Side Panel Which Contains Navigation Menu -->

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						User Details
						<a href=".$GLOBALS['report_user']." class="btn pull-right">
							<button type="button" class="btn btn-primary btn-sm">
								<i class="fa fa-arrow-left"></i> Back To Report
							</button>
						</a>
					</h1>
				</section>

					<!-- Main content -->
					<section class="content">
						<div class="box">
								<div class="box-body pad">
						<div class="row">
							<div class="col-xs-12">
								<h2 class="page-header">
									<center>Name: <strong><?php echo $customer_result['customer_name'] ?>  </strong></center>
									<div class="btn-toolbar">
										<?php echo '<a class="pull-right" href = "'.$GLOBALS["edit_user_html"].'?id='.$customer_id.' ">'?>
											<button type="button" class="btn btn-primary ">
												<i class="fa fa-edit"></i> Edit
											</button>
										</a>
									</div>
								</h2>
							</div>
						</div>

						<div class="row invoice-info">
							<div class="col-sm-12 invoice-col">
								<address>
									<div class="table-responsive">
										<table class="table">
											<tr><td>Email:</td><td><strong><?php echo $customer_result['customer_email'] ?></strong> </td></tr>
											<tr><td>Phone Number:</td><td><strong>  <?php echo $customer_result['customer_contact_number'] ?></strong></td></tr>
											<tr><td>Role:</td><td><strong>  <?php echo ($customer_result['role']=="user_admin")?"Admin":"User"; ?></strong></td></tr>
											<tr><td>Category:</td><td><strong>
												<?php
													$categroy_values = explode(",",$customer_result['category']);
													foreach ($categroy_values as $value) {
														$query = "SELECT * FROM category where delete_status<>1 and category_id = ".$value;
														$result = mysqli_query($conn, $query);
														$category_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
														echo $category_result['category_name'],'<br/>';
													}
											 ?></strong></td></tr>

										</table>
									</div>
								</address>
							</div>
</div>
			<!-- Main Footer -->
			<footer class="main-footer">
			</footer>

			<!--Including right slide panel-->
			<?php include "../../extra/aside.php";?>
			<!--Including right slide panel-->

			<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		<!-- </div> -->
		<!-- ./wrapper -->
		<!--Including Bootstrap and other scripts-->
		<?php include "../../extra/footer.html";?>
		<!--Including Bootstrap and other scripts-->
	</body>
	<script>
	$(document).ready(function()
	{
		// Handler for .ready() called.
		$("#li_customer").addClass("active");
		$("#li_customer_report").addClass("active");
	});
	</script>


</html>
