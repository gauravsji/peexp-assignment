<!--
Description: View meeting module displays details about the meetings scheduled.
Date: 04/07/2017
-->
<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";
		$meeting_id=$_GET["id"];
		$sql = "SELECT * FROM meeting where meeting_id = " . $meeting_id;
		$result = mysqli_query($conn, $sql);
		$meeting_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
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
						Meeting Details
						<a href="../reports/meeting_report_html.php" class="btn pull-right btn-sm">
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
										<i></i>   Meeting Title: <strong><?php echo $meeting_result['meeting_title'] ?> </strong>
										<div class="pull-right">Meeting Date:  <strong><?php  echo date("d-m-Y", strtotime($meeting_result['meeting_date'])) ?></strong> </div>	<br><br>	
										<div class="btn-toolbar">
											<?php echo '<a class="btn btn-primary btn-flat pull-right btn-sm" href="../html/edit_meeting_html.php?id='.$meeting_id.'"';'>'?>
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
										<strong>Meeting Time:</strong>  <?php echo date('h:i:s A', strtotime($meeting_result['meeting_time']));   ?><br>
										<strong>Venue:</strong>  <?php echo $meeting_result['meeting_venue'] ?><br>
										<strong>Connect Name:</strong>  <?php echo $meeting_result['meeting_connect_name'] ?><br>
										<strong>Contact Number:</strong>  <?php echo $meeting_result['meeting_contact_number'] ?><br>
									</address>
								</div>
								<div class="col-sm-4 invoice-col">
									<address>
										<strong>Meeting With:</strong>
										<?php echo $meeting_result['meeting_with'] ?><br>
										<strong>Meeting Assignee:</strong>
										<?php 
											$sql2="SELECT data_entered_by FROM meeting where meeting_id=". $meeting_result['meeting_id'];
											$result2 = mysqli_query($conn, $sql2);
											$u_res = mysqli_fetch_array($result2,MYSQLI_ASSOC);
											{
												$sqlu = "SELECT name,id FROM users where id = " . $u_res['data_entered_by'];
												$result5 = mysqli_query($conn, $sqlu);
												$u_result = mysqli_fetch_array($result5,MYSQLI_ASSOC);
												{
													echo $u_result['name'];
												} 
											}
										?><br>
										<strong>Meeting Status:</strong>
										<?php echo $meeting_result['meeting_status'] ?><br>
									</address>
								</div>

								<div class="col-md-4 invoice-col">
									<address>
										<strong>Agenda:</strong> <br> <?php echo $meeting_result['meeting_agenda'] ?> <br>
										<strong>Notes:</strong> <br> <?php echo $meeting_result['meeting_notes'] ?>
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
			$("#li_daily_operations").addClass("active");
			$("#li_meeting_report").addClass("active");
		});
	</script>
</html>
