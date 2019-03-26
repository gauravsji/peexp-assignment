<!--
Description: View customer displays customer information.
Date: 04/07/2017
-->
<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php
		include "../extra/session.php";
		$customer_id=$_GET["id"];
		$sql = "SELECT * FROM customer where customer_id=". $customer_id;
		$result = mysqli_query($conn, $sql);
		$customer_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
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

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						Customer Details
						<a href="../reports/customer_report_html.php" class="btn pull-right">
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
									<?php if( $customer_result['approved']=="0")
									{
										echo '<a  href="../php/update/update_approval.php?id='.$customer_id.'&toId='.$customer_id.'">
											<button type="button" class="btn btn-danger ">
											 Not Approved</button>
										</a>';
									}
									else
									{
										echo '<button type="button" class="btn btn-success ">
											 Approved</button>
										</a>';
									}?>
										<?php
										echo '<a class="btn btn-primary btn-flat pull-right btn-sm" href="../html/edit_customer_html.php?id='.$customer_id.'"';'>'?>
											<button type="button" class="btn btn-primary ">
												<i class="fa fa-edit"></i> Edit
											</button>
										</a>
										<?php echo '<a class="btn btn-primary btn-flat pull-right btn-sm" href="../html/add_project_html.php?id='.$customer_id.'"';'>'?>
											<button type="button" class="btn btn-primary ">
												<i class="fa fa-plus"></i> Add Project
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
										<table class="table">
											<tr><td>Type Of Firm:</td><td><strong><?php echo $customer_result['customer_type_of_firm'] ?></strong></td></tr>
											<tr><td>Contact Person:</td><td><strong><?php echo $customer_result['customer_contact_person'] ?></strong></td></tr>
											<tr><td>Email:</td><td><strong><?php echo $customer_result['customer_email'] ?></strong> </td></tr>
											<tr><td>City:</td><td><strong><?php echo $customer_result['customer_city'] ?></strong></td></tr>
										</table>
									</div>
								</address>
							</div>

							<div class="col-sm-4 invoice-col">
								<address>
									<div class="table-responsive">
										<table class="table">
											<tr><td>Address:</td></tr>
											<tr><td rowspan="1"> <strong><?php echo $customer_result['customer_address'] ?></strong>								</td></tr>
											<tr><td>Billing Address:</td></tr>
											<tr><td rowspan="1"> <strong><?php echo $customer_result['billing_address'] ?></strong>								</td></tr>
										</table>
									</div>
								</address>
							</div>

							<div class="col-sm-4 invoice-col">
								<address>
									<div class="table-responsive">
									<table class="table">
									<tr><td>Phone Number:</td><td><strong>  <?php echo $customer_result['customer_contact_number'] ?></strong></td></tr>
									<tr><td>Alternate Number:</td><td><strong>  <?php echo $customer_result['customer_alternate_contact_number'] ?></strong></td></tr>
									<tr><td rowspan="1">GST Number:<br> <strong> <?php echo $customer_result['gst_number'] ?></strong>
									</td></tr>
									<tr><td rowspan="1">Additional Info:<br> <strong> <?php echo $customer_result['customer_additional_info'] ?></strong>
									</td></tr>
									</table>
									</div>
								</address>
							</div>
						</div>

						<!--CONTACTS-->
						<div class="row invoice invoice-info">
							<div class="page-header">
								<center><strong>CONTACTS</strong></center>
							</div>
							<?php
							$contact_sql = "SELECT * FROM contacts where delete_status<>1 and contact_module_id= " . $customer_id." and contact_module_name='Customer'";
							$contact_result = mysqli_query($conn,$contact_sql);
							while ($contact_row = mysqli_fetch_array($contact_result))
							{
								echo'<div class="row"><div class="col-sm-4 invoice-col">
								<address>
									<strong>Person Name:</strong>'. $contact_row["contact_person_name"].'<br>
									<strong>Contact Number:</strong>'. $contact_row["contact_person_contact_number"].'<br>
									<strong>Alternate Number:</strong>'. $contact_row["contact_person_alternate_contact_number"].'<br>
								</address>
							</div>
							<div class="col-sm-4 invoice-col">
								<strong>Email:</strong>  '. $contact_row["contact_person_email"] .'<br>
								<strong>Alternate Email:</strong>  '. $contact_row["contact_person_alternate_email"] .'<br>
							</div></div><div class="page-header">
							</div>';
							}
							?>
						</div>
						<!--CONTACTS-->

						<!--PROJECTS-->
						<div class="row invoice invoice-info">
							<div class="col-sm-12 invoice-col">
								<div class="page-header">
									<center><strong>PROJECTS</strong></center>
								</div>
							</div>
							<?php
							$sql = "SELECT * FROM project where delete_status<>1 and customer_id= " . $customer_id;
							$result = mysqli_query($conn,$sql);
							while ($row = mysqli_fetch_array($result))
							{
							echo '<div class="row">
							<div class="col-sm-4 invoice-col">
								<address>
								<strong>Project Name:</strong> '. $row["project_name"] .'<br>
								<strong>Client Name:</strong>  '. $row["project_client_name"] .'<br>
								<strong>Incharge Name:</strong>  '. $row["project_site_incharge_name"] .'<br>
								</address>
							</div>
							<div class="col-sm-4 invoice-col">
								<address>
								<strong>Address:</strong><br>
								'. $row["project_site_address"] .'
								</address>
							</div>
							<div class="col-sm-4 invoice-col">
								<strong>Type Of Firm:</strong>  '. $row["project_type_of_project"] .'<br>
								<strong>Incharge Contact Number:</strong>  '. $row["project_site_incharge_contact_number"] .'<br>
								<strong>Landmark:</strong>  '. $row["project_landmark"] .'<br>
							</div></div><div class="page-header">
							</div>';
							}
							?>
						</div>
						<!--PROJECTS-->

						<!--CONTACTS-->
						<div class="row invoice invoice-info">
							<div class="page-header">
								<center><strong>SUBUSER</strong></center>
							</div>
							<table id="view_order_html" class="sieve table table-bordered table-striped table-fixed table-condensed" style="border-collapse:collapse;">

		<thead>
			<!--<th><center>Products</center></th>-->
			<th><center>Subuser Name</center></th>
			<th><center>Contact Number</center></th>
			<th><center>Email</center></th>
			<th><center>Role</center></th>
			<th><center>Status</center></th>
			<th><center>Approve</center></th>
		</thead>
		<tbody>
		<?php
				$subuser_sql = "SELECT * FROM customer where delete_status<>1 and subset= ".$customer_id;
				$subuser_result = mysqli_query($conn,$subuser_sql);
				while ($subuser_row = mysqli_fetch_array($subuser_result))
				{

				// Print out the contents of the entry
				echo '<tr data-toggle="collapse" class="accordion-toggle" data-target="#prod';echo $customer_id; echo'">';
				echo '<td><center>' . $subuser_row['customer_name'] . '</center></td>';
				echo '<td><center>' . $subuser_row['customer_contact_number'] . '</center></td>';
				echo '<td><center>' . $subuser_row['customer_email'] . '</center></td>';
				if( $subuser_row['role']=="user_admin")
				{
				echo '<td style="width:12%"><center>Admin</center></td>';
				}
				else
				{
				echo '<td style="width:12%"><center>User</center></td>';
				}
				if( $subuser_row['subuser_status']=="active")
				{
				echo '<td style="width:12%"><center>Active</center></td>';
				}
				else
				{
				echo '<td style="width:12%"><center>Inactive</center></td>';
				}
				if($subuser_row['approved'])
				{
					echo '<td><button class="btn btn-sm btn-success" disabled> Approved</button></td>';

				}
				else {
					echo '<td><a  href="../php/update/update_approval.php?id='.$subuser_row['customer_id'].'&toId='.$customer_id.'"><button class="btn btn-sm btn-warning">Not Approved</button></a></td>';
				}
				echo "</tr>";

		}
		?>
	</tbody>
</table>

						</div>
						<!--CONTACTS-->

						<!--PAYMENTS-->
						<div class="row invoice invoice-info">
							<div class="col-sm-12 invoice-col">
								<div class="page-header">
									<center><strong>PAYMENTS</strong></center>
								</div>
							</div>

							<?php
							$sql = "SELECT * FROM payment p, project pr where p.delete_status<>1 and pr.project_id=p.project_id and p.customer_id= " . $customer_id;
							$result = mysqli_query($conn,$sql);
							while ($row = mysqli_fetch_array($result))
							{
							echo '<div class="row"><div class="col-sm-4 invoice-col">
								<address>
									<strong>Payment Date:</strong>  '. date("d-m-Y", strtotime( $row["payment_date"] )).'<br>
									<strong>Payment Method:</strong>  '. $row["payment_method"] .'<br>
									<strong>Amount:</strong>  '. $row["payment_amount"] .'<br>
								</address>
							</div>
							<div class="col-sm-4 invoice-col">
								<strong>Transaction Reference Number:</strong>  '. $row["payment_transaction_ref_no"] .'<br>
								<strong>Project Name:</strong>  '. $row["project_name"] .'<br>
								<strong>Payment Type:</strong> '. $row["payment_type"] .'<br>
							</div>
							<div class="col-sm-4 invoice-col">
								<address>
								<strong>Remarks:</strong><br>
								'. $row["payment_remarks"] .'
								</address>
							</div></div><div class="page-header">
							</div>';
							}
							?>
						</div>
						<!--PAYMENTS-->


						<div class="page-header">
							<center><strong>FILES</strong></center>
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
								$sql = "SELECT * FROM photo p, customer c where p.delete_status<>1 and p.module_name='customer' and p.module_id=c.customer_id and c.customer_id= " . $customer_id;
								$result = mysqli_query($conn,$sql);
								while ($row = mysqli_fetch_array($result))
								{
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
									echo '<td><center><a title="Delete" onclick="return confirm(\"Delete this record?\")" class="btn btn-danger" href="../php/delete/delete_customer_photo.php?id=' . $row['photo_id'] . '">Delete</a></center></td></tr>';
								}
								?>
							</tbody>
						</table>

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

			<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
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
		$("#li_customer").addClass("active");
		$("#li_customer_report").addClass("active");
	});
	</script>
</html>
