<!--
Description: View enquiry module displays details about the enquiries.
Date: 04/07/2017
-->
<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php
	  include "../extra/session.php";
		$enquiry_id=$_GET["id"];
		$sql = "SELECT * FROM rfq e
		LEFT OUTER JOIN sales_lead sl ON e.sales_lead_id=sl.sales_lead_id
		LEFT OUTER JOIN customer c ON e.customer_id=c.customer_id
		LEFT OUTER JOIN project p ON e.project_id = p.project_id
		WHERE e.delete_status <> 1 and e.rfq_id =" . $enquiry_id ;
		$result = mysqli_query($conn, $sql);
		$enquiry_result = mysqli_fetch_array($result,MYSQLI_ASSOC);

		$grand_total=0; //Initialise grand total variable
		$sql4 = "SELECT * FROM customer_rfq_enquiry where delete_status<>1 and product_status = 'Accept' and  product_enquiry_id = " . $enquiry_id;
		$result4 = mysqli_query($conn, $sql4);

		$sql9 = "SELECT * FROM customer_rfq_enquiry where delete_status<>1 and product_status = 'Accept' and product_enquiry_id = " . $enquiry_id;
		$result9 = mysqli_query($conn, $sql9);

		$sql6 = "SELECT * FROM customer_rfq_enquiry where delete_status<>1 and product_status = 'Accept' and  product_enquiry_id = " . $enquiry_id;
		$result6 = mysqli_query($conn, $sql6);

		$sql_email_settings = "SELECT * FROM email_settings where email_module='ESTIMATE'";
		$result_email_settings = mysqli_query($conn, $sql_email_settings);
		$email_settings_result = mysqli_fetch_array($result_email_settings,MYSQLI_ASSOC);


		$sql_email_rfq = "SELECT * FROM email_settings where email_module='RFQ'";
		$result_email_rfq = mysqli_query($conn, $sql_email_rfq);
		$email_rfq_result = mysqli_fetch_array($result_email_rfq,MYSQLI_ASSOC);

		$total_eq=0;
		$selling_total_eq=0;
	?>
	<!--Including Login Session-->
	<head>
		<!--Including Bootstrap CSS links-->
		<?php include "../extra/header.html";?>
		<!--Including Bootstrap CSS links-->


		<style>
			#vendor_email_list
			{
				cursor:pointer;
				list-style: none;
				background-color: #FFFFFF;
				padding:0;
				margin:0;
			}
			#vendor_email_list li
			{
				padding-left:20px;
				padding-top: 5px;
				padding-bottom: 5px;
				transition: all 0.8s ease-in;
			}
			#vendor_email_list li:hover
			{
				background-color:#ffc966;
			}
			.marrig{
				margin-right: 30px;
			}
		</style>


			<script type="text/javascript">
			function approve_po()
			{
				console.log("entered approve loop");
				modal_id = $('#draft_id').val();
				$.ajax({
				 url:"../php/update/update_po_status.php",
				 method:"POST",
				 data:{rfq_id:modal_id},
				 success:function(data){
					 console.log("Data Successfully Uploaded");
					 window.location.reload();
				 }

				});
			}

			function approve_po_order()
			{
				console.log("entered the block to convert the rfq into order");
				url = "clone_order_html_rfq.php?id=<?php echo $enquiry_id;?>&type=Rfq2"
				console.log("entered approve loop");
				modal_id = $('#draft_id').val();
				$.ajax({
				 url:"../php/update/update_po_status.php",
				 method:"POST",
				 data:{rfq_id:modal_id},
				 success:function(data){
					 // window.location = url;
					 window.location.href=url;

					 $.ajax({
	 				 url:url,
	 				 method:"POST",
	 				 data:{rfq_id:modal_id},
	 				 success:function(data){
	 					 window.location.href=url;
	 					 console.log("Data Successfully Uploaded");
	 					 // window.location.reload();
	 				 }

	 				});
				 }

				});

			}
			function reject_po()
			{
				rfq_id = <?php echo $enquiry_id;?>;
				$.ajax(
				{
					url: "../php/update/reject_po.php",
					type: "POST", // you can use GET
					data: {rfq_id:rfq_id}, // post data
					success: function(data)   // A function to be called if request succeeds
					{
						window.location.reload();
					}
				});


			}
			function get_po_rfq_details()
			{
				console.log("entered the po upload loop 1");
				rfq_id = <?php echo $enquiry_id;?>;
				$.ajax(
				{
					url: "../php/get/get_po_details.php",
					type: "POST", // you can use GET
					data: {rfq_id:rfq_id}, // post data
					success: function(data)   // A function to be called if request succeeds
					{
						console.log("entered the po upload loop");
						$('#po_rfq_details').html(data);
					}
				});

			}
	$(function ()
	{
		//Date picker
		$('#ui_task_due_date').datepicker
		({
			format: 'dd/mm/yyyy',
			autoclose: true
		});
	});

	$(document).ready(function()
	{
		// Handler for .ready() called.
		get_po_rfq_details();
		$("#li_enquiry_manage").addClass("active");
		$("#li_user_enquiry_report").addClass("active");

		$("#btn_cnvrt_to_ord").prop('disabled', true);
		$("#modal_add_task").click(function()
		{
			var enquiry_id= <?php echo $enquiry_result['rfq_id'];?>;
			var task_name= $("#ui_modal_task_name").val();
			var assignee_name= $("#ui_assignee_name").val();
			var due_date= $("#ui_task_due_date").val();
			var task_status= $("#ui_task_status").val();
			var task_description= $("#ui_task_description").val();
			var task_remarks= $("#ui_task_remarks").val();
			var user_id= <?php echo $user_result['id'];?>;
			var location= "<?php echo $user_result['location'];?>";

			$.ajax(
			{
				url: "../php/add_modal/add_enquiry_task_php.php",
				type: "POST", // you can use GET
				data: {enquiry_id:enquiry_id,task_name: task_name, assignee_name: assignee_name,due_date:due_date, task_status:task_status,task_description:task_description,task_remarks:task_remarks,user_id:user_id,location:location}, // post data
				success: function(data)   // A function to be called if request succeeds
				{
					$("#add_task .close").click();
					window.location.reload();
					$('#ui_modal_task_name').val("");
					$('#ui_task_status').val("Ongoing");
					$('#ui_task_description').val("");
					$('#ui_task_remarks').val("");
				}
			});
		});

	});
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
			<input type="hidden" id="draft_id" name="draft_id" value="<?php echo $enquiry_id;?>"/>
			<div class="content-wrapper">
				<section class="content-header">
					<h1>
						Request Details
						<a href="../reports/report_rfq_enquiry_html.php" class="btn pull-right">
							<button type="button" class="btn btn-sm btn-primary ">
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
										<i></i>  <center><h3>Request For:  <strong><?php echo $enquiry_result['enquiry_name'] ?></strong></h3></center>
										<div class="pull-left">Date:  <strong><?php  echo date("d-m-Y", strtotime($enquiry_result['enquiry_date'])) ?></strong> </div>
										<div class="pull-right">Request No:  <strong><?php  echo $enquiry_result['rfq_id']; ?></strong> </div>

										<br><br>

										<div class="btn-toolbar">
											<?php echo '<a class="btn btn-primary btn-flat btn-sm pull-right" href="../html/edit_rfq_enquiry.php?id='.$enquiry_id.'"';'>'?>
											<button type="button" class="btn btn-primary ">
												<i class="fa fa-edit"></i> Edit
											</button>
											</a>

											<button type="button" class="btn btn-primary btn-flat btn-sm pull-left" data-toggle="modal"  data-target="#send_estimate">
												<i class="fa fa-plus"></i> Send Estimate
											</button>

												<!--<button type="button" class="btn btn-primary btn-flat btn-sm pull-left" data-toggle="modal"  data-target="#rfq">
												<i class="fa fa-plus"></i> Request For Quote
											</button>

											<button type="button" class="btn btn-primary btn-flat btn-sm pull-right" data-toggle="modal" data-target="#add_task">
												<i class="fa fa-plus"></i> Add Task
											</button>-->

											<button type="button" class="btn btn-primary btn-flat btn-sm pull-right" data-toggle="modal" data-target="#convert_to_order">
												<i class="fa fa-share-square-o"></i> Convert To Order
											</button>

											<?php echo '<a class="btn btn-primary btn-flat btn-sm pull-right" href="../php/add/clone_enquiry_php.php?id='.$enquiry_id.'"';'>'?>
											<button type="button" class="btn btn-primary ">
												<i class="fa fa-edit"></i> Clone
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
												<tr><td> Created by: </td><td> <strong>  <?php echo $enquiry_result['customer_name'] ?> </strong></td></tr>
												<tr><td> Project Name:</td><td><strong>  <?php echo $enquiry_result['project_name'] ?></strong></td></tr>
												<tr><td> Email:</td><td><strong>  <?php echo $enquiry_result['customer_email'] ?></strong></td></tr>
												<tr><td> Assignee:</td><td><strong>
												<?php

														$sqlu = "SELECT name,id FROM users where id = " . $enquiry_result['enquiry_assignee'];
														$result5 = mysqli_query($conn, $sqlu);
														$u_result = mysqli_fetch_array($result5,MYSQLI_ASSOC);
														echo $u_result['name'];
												?>
												</strong></td></tr>
												<tr><td>End Date: </td><td><strong>    <?php echo date("d-m-Y", strtotime($enquiry_result['end_date'])) ?></strong></td></tr>
											</table>
										</div>
									</address>
								</div>


								<div class="col-sm-4 invoice-col">
									<address>
									<div class="table-responsive">
									<table class="table">
									<tr><td> Remark:<br></td></tr>
									<tr><td rowspan="4"> <strong><?php echo $enquiry_result['enquiry_details'] ?></strong></td></tr>
									</table>
									</div>
									</address>
								</div>

								<div class="col-sm-4 invoice-col">
									<address>
										<div class="table-responsive">
											<table class="table">
												<tr><td> Status:  <strong><?php
												if($enquiry_result['enquiry_status'] == "Awaiting Quote")
												{
														echo "Quote Awaited";
												}
												else
												{
														echo $enquiry_result['enquiry_status'] ;
												}

												 ?><br></strong></td></tr>
											</table>
										</div>
									</address>
								</div>
							</div>

							<div class="page-header">
							</div>

							<div class="table-responsive">
								<table class='table table-bordered table-striped table-fixed'>
									<thead>
										<tr>
										<th><center>Product Name</th>
										<th><center>Description</th>
										<th><center>Quantity </th>
										<th><center>MRP</th>
										<th><center>Discount Percent</th>
										<th><center>Buying Price</th>
										<th><center>Buying Total</th>
										<th><center>Selling Percentage</th>
										<th><center>Selling Price</th>
										<th><center>Tax</th>
										<th><center>Tax I/E</th>
										<th><center>Selling Price</th>
										<th><center>Remarks</th>
										<th><center>Status</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql = 'SELECT * FROM rfq e,customer_rfq_enquiry ep where e.rfq_id='.$enquiry_id.' and e.rfq_id=ep.product_enquiry_id and ep.delete_status<>1';
										$result = mysqli_query($conn,$sql);
										while ($row = mysqli_fetch_array($result))
										{
											// Print out the contents of the entry
											echo '<tr><td><center>' . $row['product_name'] . '</center></td>';
											echo '<td><center>' . $row['product_description'] . '</center></td>';
											echo '<td><center>' . $row['product_quantity'] . '</center></td>';
											echo '<td><center>' . $row['enquiry_buying_price'] . '</center></td>';
											echo '<td><center>' . $row['enquiry_discount_percent'] . '</center></td>';
											echo '<td><center>' . $row['enquiry_discounted_price'] . '</center></td>';
											echo '<td><center>' . $row['enquiry_total_of_buying'] . '</center></td>';
											echo '<td><center>' . $row['enquiry_selling_percentage'] . '</center></td>';
											echo '<td><center>' . $row['enquiry_selling_price'] . '</center></td>';
											echo '<td><center>' . $row['enquiry_tax'] . '</center></td>';
											echo '<td><center>';

											if($row['tax_inclusive']==1)
											{
												echo "Inclusive";
											}
											else
											{
												echo "Exclusive";
											}

											echo '</center></td>';
											echo '<td><center>' . $row['enquiry_total'] . '</center></td>';
											echo '<td><center>' . $row['product_remarks'] . '</center></td>';
											echo '<td><center>' . $row['product_status'] . '</center></td></tr>';
											$total_eq=$total_eq+$row['enquiry_total'];
											$selling_total_eq=$selling_total_eq+$row['enquiry_total_of_buying'];
										}
										?>
									</tbody>
								</table>
							</div>

							<div class="col-sm-12">
								<div class="col-sm-2 col-md-offset-8 invoice-col">
									<div class="invoice-col">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">BUYING TOTAL</label>
											<input type="text" class="form-control" readonly id="buy_total" value="<?php echo $selling_total_eq;?>">
										</div>
									</div>

									<div class="invoice-col">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">PROFIT</label>
											<input type="text" class="form-control" readonly id="profit" value="<?php echo $total_eq-$selling_total_eq;?>">
										</div>
									</div>

								</div>


								<div class="col-sm-2 invoice-col">
									<div class="invoice-col">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">SELLING TOTAL</label>
											<input type="text" class="form-control" readonly id="selling_total" value="<?php echo $total_eq;?>">
										</div>
									</div>

									<div class="invoice-col">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">TRANSPORT</label>
											<input type="text" class="form-control" readonly id="transport" value="<?php echo $enquiry_result['enquiry_transport_charge'];?>">
										</div>
									</div>

									<?php $grand_total=$total_eq+$enquiry_result['enquiry_transport_charge']?>
									<div class="form-group has-success">
										<label class="control-label" style="text-align:center" for="inputSuccess">GRAND TOTAL</label>
										<input type="text" class="form-control" readonly id="grand_total" value="<?php echo $grand_total;?>">
									</div>
								</div>
							</div>

							<div class="page-header">
								<center><strong>FILES</strong></center>
							</div>

							<div class="table-responsive">
								<table class="table table-bordered table-condensed table-sm table-responsive" id="view_vendor_product_html"cellspacing="0" width="100%">
									<thead>
										<tr>
										<th><center>File</center></th>
										<th><center>Delete</center></th>
										</tr>
									</thead>
									<tbody>
										<?php
											$sql = "SELECT * FROM photo p, rfq e where p.delete_status<>1 and p.module_name='rfq' and p.module_id=e.rfq_id and e.rfq_id= " . $enquiry_id;
											$result = mysqli_query($conn,$sql);
											while ($row = mysqli_fetch_array($result))
											{
												// Print out the contents of the entry
												if((substr($row['photo_name'], -3))=="pdf")
												{
													echo '<tr><td><center><a href="'.$row['photo_name'].'"/>Open PDF Attachment</a></td>';
												}
												else if((substr($row['photo_name'], -4))=="docx")
												{
													echo '<tr><td><center><a href="'.$row['photo_name'].'"/>Open Word Attachment</a></td>';
												}
												else if((substr($row['photo_name'], -4))=="txt")
												{
													echo '<tr><td><center><a href="'.$row['photo_name'].'"/>Open Text Attachment</a></td>';
												}
												else if((substr($row['photo_name'], -3))=="doc")
												{
													echo '<tr><td><center><a href="'.$row['photo_name'].'"/>Open Word Attachment</a></td>';
												}
												else if((substr($row['photo_name'], -4))=="xlsx")
												{
													echo '<tr><td><center><a href="'.$row['photo_name'].'"/>Open Excel Attachment</a></td>';
												}
												else if((substr($row['photo_name'], -3))=="xls")
												{
													echo '<tr><td><center><a href="'.$row['photo_name'].'"/>Open Excel Attachment</a></td>';
												}
												else
												{
													echo '<tr><td><center><img width="35%" class="fancybox" height="35%" src="'.$row['photo_name'].'"/></center></td>';
												}
												echo '<td><center><a title="Delete" onclick="return confirm(\"Delete this record?\")" class="btn btn-danger" href="../php/delete/delete_rfq_photo.php?id=' . $row['photo_id'] . '">Delete</a></center></td></tr>';
											}
										?>
									</tbody>
								</table>
							</div>

							<!-- this row will not appear when printing -->
							<div class="form-group col-md-12">
								<div class="table-responsive">
									<div id="po_rfq_details"></div>
								</div>
							</div>
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


		<!--Add Task -->
		<div id="add_task" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Task</h4>
					</div>

					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<!--Task Name-->
								<div class="form-group">
									<label>Task Name</label>
									<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-tasks"></i></span>
									<input type="text" class="form-control" placeholder="Task Name" style="text-transform:capitalize" id="ui_modal_task_name" name="ui_modal_task_name" maxlength="150" />
									</div>
								</div>
								<!--Task Name-->
							</div>
						</div>

						<div class="row">
							<div class="col-md-4">
								<!--Assignee Name-->
								<div class="form-group">
									<label>Assignee Name</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user"></i></span>
										<select name="ui_assignee_name" id="ui_assignee_name" class='form-control select2' style='width: 100%;'>
										<option selected disabled hidden>Select Assignee</option>
										<?php
										{
											$sql = "SELECT * FROM users where authenticate=1 order by name";
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query))
											{
												echo "<option value='" . $row['id'] . "'>" . $row['name']. "</option>";
											}
										}
										?>
										</select>
									</div>
								</div>
								<!--Assignee Name-->
							</div>

							<div class="col-md-4">
								<!--Due Date-->
								<div class="form-group">
									<label>Due Date</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input type="text" readonly class="form-control pull-right" name="ui_task_due_date" id="ui_task_due_date" value="<?php echo date("d/m/Y"); ?>">
									</div>
								</div>
								<!--Due Date-->
							</div>

							<div class="col-md-4">
								<!--Task Status-->
								<div class="form-group">
									<label>Status</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-info"></i></span>
										<select name="ui_task_status" id="ui_task_status" class='form-control select2' style='width: 100%;'>
											<option value="Ongoing" selected> Ongoing </option>
											<option value="Completed"> Completed </option>
											<option value="Cancelled"> Cancelled </option>
										</select>
									</div>
								</div>
								<!--Task Status-->
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<!--Description-->
								<div class="form-group">
									<label>Description</label>
									<textarea class="form-control" rows="3" placeholder="Laminates to XYZ" id="ui_task_description" name="ui_task_description"></textarea>
								</div>
								<!--Description-->
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<!--Remarks-->
								<div class="form-group">
									<label>Remarks</label>
									<textarea class="form-control" rows="3" id="ui_task_remarks" name="ui_task_remarks"></textarea>
								</div>
								<!--Remarks-->
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<!--Save-->
						<div class="form-group">
							<button class="btn btn-success" type="button" id="modal_add_task">Save</button>
						</div>
						<!--Save-->
						<!--Close-->
						<div class="form-group">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
						<!--Close-->
					</div>
				</div>
			</div>
		</div>
		<!--Add Task -->



	<!-- Estimate -->
	<div class="modal fade" id="send_estimate" role="dialog">
		<div class="modal-dialog modal-lg" style="width: 85%; height:70%;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Estimate from Smartstorey</h4>
				</div>
				<div class="modal-body">
					<div class="row invoice-info">
						<div class="col-sm-4 invoice-col">
							<address>
								<div class="table-responsive">
									<table class="table table-condensed table-bordered">
										<tr><td><center><strong>FROM</strong></center></td></tr>
										<tr><td width="30%"><center><strong>Smartstorey</strong></center></td></tr>
										<tr><td width="30%"><center> 3rd Floor, Sampurna Chambers, <br>
										Opposite Vijaya Bank, Vasavi Temple Street<br>
										Basavanagudi Bangalore<br></center>
										<table class="table table-condensed table-bordered">
											<tr><td>
											Phone: </td><td>+918884732111, +919901650420</td></tr>
											<tr><td>Email: </td><td>sales@smartstorey.com</td></tr>
										</table>
										</td></tr>
									</table>
								</div>
							</address>
						</div>

						<div class="col-sm-4 invoice-col">
							<address>
								<div class="table-responsive">
									<table class="table table-condensed table-bordered">
										<tr><td><center><strong>TO</strong></center></td></tr>
										<tr><td width="30%"><center><strong><?php echo $enquiry_result['customer_name'];?></strong></center></td></tr>
										<tr><td width="30%"><center><?php echo $enquiry_result['customer_address'];?></center><br></td></tr>
										<tr><td width="30%"><center><strong>Email:</strong><center> </td></tr> <tr><td width="30%"><center><?php echo $enquiry_result['customer_email'];?></center></td></tr>
									</table>
								</div>
							</address>
						</div>

						<div class="col-sm-4 invoice-col">
							<address>
								<div class="table-responsive">
									<table class="table table-condensed table-bordered">
										<tr><td width="30%"><center><strong>Enquiry ID:</strong></center></td><td><?php echo $enquiry_result['rfq_id'];?></td></tr>
										<tr><td width="30%"><center><strong>Enquiry Date:</strong></center></td><td>  <?php echo date("d-m-Y", strtotime($enquiry_result['enquiry_date']));?></td></tr>
									</table>
								</div>
							</address>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12 table-responsive">
							<table class="table table-striped">
								<thead>
									<tr>
										<th><center>Sl No.</center></th>
										<th><center>Product Name</center></th>
										<th><center>Description</center></th>
										<th><center>Quantity</center></th>
										<th><center>Price</center></th>
										<th><center>Tax</center></th>
										<th><center>Tax I/E</center></th>
										<th><center>Total</center></th>
									</tr>
								</thead>
								<tbody>
									<?php $count=1; while ($enquiry_product_result = mysqli_fetch_array($result4,MYSQLI_ASSOC)) {?>
									<tr>
									<td><center><?php echo $count;  ?></center></td>
									<td><center><?php echo $enquiry_product_result['product_name'];  ?></center></td>
									<td><center><?php echo $enquiry_product_result['product_description'];  ?></center></td>
									<td><center><?php echo $enquiry_product_result['product_quantity'];  ?></center></td>
									<td><center><?php echo $enquiry_product_result['enquiry_selling_price']; ?></center></td>
									<td><center><?php echo $enquiry_product_result['enquiry_tax'];  ?></center></td>
									<td><center><?php if($enquiry_product_result['tax_inclusive']==1)
									{
										echo "Inclusive";
									}
									else
									{
										echo "Exclusive";
									}
									?></center></td>
									<td><center><?php echo $enquiry_product_result['enquiry_total'];  ?></center></td>
									</tr>
									<?php $count=$count+1;} ?>
								</tbody>
							</table>
						</div>
					</div>

					<div class="col-md-12 invoice-info">
						<div class="col-sm-2 col-md-offset-10 invoice-col">
							<div class="form-group has-success">
								<label class="control-label" for="inputSuccess">TOTAL</label>
								<input type="text" class="form-control" readonly id="gt" value="<?php echo $total_eq;?>">
							</div>
						</div>
						<div class="col-sm-2 col-md-offset-10 invoice-col">
							<div class="form-group has-success">
								<label class="control-label" for="inputSuccess">TRANSPORT</label>
								<input type="text" class="form-control" readonly id="tr" value="<?php echo $enquiry_result['enquiry_transport_charge'];?>">
							</div>
						</div>
						<div class="col-sm-2 col-md-offset-10 invoice-col">
							<div class="form-group has-success">
								<label class="control-label" for="inputSuccess">GRAND TOTAL</label>
								<input type="text" class="form-control" readonly id="GTT" value="<?php echo $grand_total;?>">
							</div>
						</div>
					</div>

					<div class="row col-md-offset-4">

						<div class="col-md-6">
							<div class="form-group">
								<label>Subject</label>
								<input class="form-control" id="ui_estimate_subject" name="ui_estimate_subject" value="<?php echo $email_settings_result['email_subject']." ".   $enquiry_result['rfq_id'].":".   $enquiry_result['enquiry_name']   ?>"/>
							</div>
						</div>
						</div>
						<div class="row col-md-offset-2">
						<div class="col-md-5">
							<div class="form-group">
								<label>TO (Comma Seperated)</label>
								<input class="form-control" id="ui_email_to" name="ui_email_to" value="<?php
								if( ($enquiry_result['customer_email']!=""))
								{
							echo $enquiry_result['customer_email'];
							}
							else
								{
							echo $enquiry_result['sales_lead_email'];
							}
							?>"/>
							</div>
						</div>

						<div class="col-md-5">
							<div class="form-group">
								<label>CC (Comma Seperated)</label>
								<input class="form-control" id="ui_email_cc" name="ui_email_cc" value="<?php if( ($enquiry_result['customer_id']!=0)||($enquiry_result['customer_id']!="NULL") ) { echo $enquiry_result['customer_alternate_email'];}?>"/>
							</div>
						</div>

					</div>

					<div class="row col-md-4">

						<div class="">
							<div class=" form-group">
								<label>Message</label>
								<textarea class="form-control" rows="5" id="ui_message_to_vendor" name="ui_message_to_vendor"><?php
								if($enquiry_result['enquiry_estimate_message']=="")
								{
									echo $email_settings_result['email_body'];
								}
								else
								{
									echo $enquiry_result['enquiry_estimate_message'];
								}
								?></textarea>
							</div>
						</div>
					</div>

					<div class="row ">
						<div class="col-md-4">
							<div class=" form-group">
								<label>Billing Address</label>
								<textarea class="form-control" rows="5" id="ui_billing_address" name="ui_billing_address"><?php if($enquiry_result['sales_lead_name']=="")
								{
									echo $enquiry_result['customer_address'];
								}
								else
								{
									echo $enquiry_result['sales_lead_address'];
								}
								?></textarea>
							</div>
						</div>

						<div class="col-md-4">
							<div class=" form-group">
								<label>Shipping Address</label>
								<textarea class="form-control" rows="5" id="ui_shipping_address" name="ui_shipping_address"><?php if($enquiry_result['sales_lead_name']=="")
								{
									echo $enquiry_result['project_site_address'];
								}
								else
								{
									echo $enquiry_result['sales_lead_address'];
								}

								?></textarea>
							</div>
						</div>
					</div>

					<!-- Manage Approve and Confirm PI_status -->
					<div class="modal-footer">
							<?php
							$fetch_pi_status = "SELECT pi_status FROM rfq WHERE rfq_id='$enquiry_id'";
							$result3 = mysqli_query($conn, $fetch_pi_status);
							$PI_status = mysqli_fetch_array($result3,MYSQLI_ASSOC);
							if($user_result['role']=="Admin" && $PI_status['pi_status']!='approved' && $PI_status['pi_status']!='not created')
							{?>
								<button type="submit" id="btn_send_enquiry" class="btn btn-success marrig"><i class="fa fa-envelope"></i>  &nbsp; Approve
								</button>
							<?php
							}
							elseif($user_result['role']=="Admin" && $PI_status['pi_status']=='approved'){
							?>
								<button type="submit" id="btn_send_enquiry" class="btn btn-success marrig" style="display: none;" onclick="window.location.reload()"><i class="fa fa-envelope"></i>  &nbsp; Approve
								</button>
							<?php
							}
							elseif($PI_status['pi_status']!='approved' && $PI_status['pi_status']!='confirm'){
							?>
								<button type="submit" id="btn_send_enquiry" class="btn btn-success"><i class="fa fa-envelope"></i>  &nbsp; Confirm
								</button>
							<?php
							}
							else
							{
							?>
								<button type="submit" id="btn_send_enquiry" class="btn btn-success"  style="display: none;"><i class="fa fa-envelope"></i>  &nbsp; Confirm
								</button>
							<?php
							}
							?>


						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>



	<script>
			$("#btn_send_enquiry").click(function()
			{
				var enquiry_id=  <?php echo $enquiry_result['rfq_id'];?>;
				var email_subject= $("#ui_estimate_subject").val();
				var ui_email_to= $("#ui_email_to").val();
				var email_cc= $("#ui_email_cc").val();
				var user_id= <?php echo $user_result['id'];?>;
				var email_body= $("#ui_message_to_vendor").val();
				var billing_address= $("#ui_billing_address").val();
				var shipping_address= $("#ui_shipping_address").val();
				var PI_status='';

		  		$.ajax(
				{
					url: "../php/send_rfq_estimate.php",
					type: "POST", // you can use GET
					data: {enquiry_id: enquiry_id, user_id:user_id, ui_email_to:ui_email_to,email_cc:email_cc,email_subject: email_subject,email_body: email_body, billing_address: billing_address, shipping_address: shipping_address}, // post data
					success: function(data)   // A function to be called if request succeeds
					{
						alert(data);
						$("#send_estimate .close").click();
						window.location.reload();
					}
				});
			});
		</script>




	<!-- RFQ -->
	<div class="modal fade" id="rfq" role="dialog">
		<div class="modal-dialog modal-lg" style="width: 85%; height:70%;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Request For Quotation</h4>
				</div>
				<div class="modal-body">
					<div class="row invoice-info">
						<div class="col-sm-12 invoice-col">
							<address>

							</address>
						</div>
					</div>
					<div class="row invoice-info">
						<div class="col-sm-6 invoice-col">
							<address>
								<div class="table-responsive">
									<table class="table table-condensed table-bordered">
										<tr><td><center><strong>FROM</strong></center></td></tr>
										<tr><td width="30%"><center><strong>Smartstorey</strong></center></td></tr>
										<tr><td width="30%"><center> 3rd Floor, Sampurna Chambers, <br>
										Opposite Vijaya Bank, Vasavi Temple Street<br>
										Basavanagudi Bangalore<br></center>
										<table class="table table-condensed table-bordered">
											<tr><td>
											Phone: </td><td>+918884732111, +919901650420</td></tr>
											<tr><td>Email: </td><td>sales@smartstorey.com</td></tr>
										</table>
										</td></tr>
									</table>
								</div>
							</address>
						</div>

						<div class="col-sm-6 invoice-col">
							<address>
								<div class="table-responsive">
									<table class="table table-condensed table-bordered">
										<tr><td width="30%"><center><strong>Enquiry ID:</strong></center></td><td><?php echo $enquiry_result['rfq_id'];?></td></tr>
										<tr><td width="30%"><center><strong>Enquiry Date:</strong></center></td><td>  <?php echo date("d-m-Y", strtotime($enquiry_result['enquiry_date']));?></td></tr>
									</table>
								</div>
							</address>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12 table-responsive">
							<table class="table table-striped">
								<thead>
									<tr>
										<th><center>Sl No.</center></th>
										<th><center>Product Name</center></th>
										<th><center>Description</center></th>
										<th><center>Quantity</center></th>
									</tr>
								</thead>
								<tbody>
									<?php $count=1; while ($enquiry_product_result_rfq = mysqli_fetch_array($result6,MYSQLI_ASSOC)) {?>
									<tr>
									<td><center><?php echo $count;  ?></center></td>
									<td><center><?php echo $enquiry_product_result_rfq['product_name'];  ?></center></td>
									<td><center><?php echo $enquiry_product_result_rfq['product_description'];  ?></center></td>
									<td><center><?php echo $enquiry_product_result_rfq['product_quantity'];  ?></center></td>
									</tr>
									<?php $count=$count+1;} ?>
								</tbody>
							</table>
						</div>
					</div>

					<div class="row">
					<div class="col-md-6 col-md-offset-3">
					<div class="form-group">
					<label>To</label>
					<input class="form-control" name="ui_estimate_rfq_to" id="ui_estimate_rfq_to"/>
					</div>
					</div>
					</div>

							<div class="form-group col-md-12">
											<fieldset class="row2">
											<center><label>Vendors</label></center>
											<div class="table-responsive">
												<table id="vendor_rfq_email" class="table table-fixed table-condensed table-bordered" border="0" style="overflow: scroll;">
													<tbody>
														<tr>
															<p>
															<td>
																<center><label for="ui_contact_person_name">Email</label></center>
																<input type="text" class="form-control" style="text-transform:lowercase" name="ui_vendor_email" onkeyup="auto_rfq();"/>
															</td>
															<ul name="vendor_email_list" id="vendor_email_list"></ul>
															</tr>
													</tbody>
												</table>
											</div>
										</div>

										<div class="form-group col-md-12">
											<input type="button" class="btn btn-primary btn-flat" value="Add" onClick="addRow('vendor_rfq_email')" />
										</div>

						<div class="row">

						<div class="col-md-6 col-md-offset-3">
							<div class="form-group">
								<label>Subject</label>
								<input class="form-control" id="ui_estimate_subject_rfq" name="ui_estimate_subject_rfq" value="<?php echo $email_rfq_result['email_subject']." ".   $enquiry_result['rfq_id'].":"   ?>"/>
							</div>
						</div>


					</div>

					<div class="row col-md-6 col-md-offset-3">

						<div class="">
							<div class=" form-group">
								<label>Message</label>
								<textarea class="form-control" rows="5" id="ui_message_to_rfq" name="ui_message_to_rfq"><?php

									echo $email_rfq_result['email_body'];

								?></textarea>
							</div>
						</div>
					</div>

					<!-- this row will not appear when printing -->
					<div class="row no-print">
						<div class="form-group col-md-2 col-md-offset-10">

								<button type="submit" id="btn_rfq" class="btn btn-success"><i class="fa fa-envelope"></i>  &nbsp; Request For Quote
								</button>

						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>

		<script>
			$("#btn_rfq").click(function()
			{
				var enquiry_id=  <?php echo $enquiry_result['rfq_id'];?>;
				var email_subject= $("#ui_estimate_subject_rfq").val();
				var ui_email_to= $("#ui_estimate_rfq_to").val();
				var user_id= <?php echo $user_result['id'];?>;
				var email_body= $("#ui_message_to_rfq").val();
				$.ajax(
				{
					url: "../php/send_rfq.php",
					type: "POST", // you can use GET
					data: {enquiry_id: enquiry_id, user_id:user_id, ui_email_to:ui_email_to,email_subject: email_subject,email_body: email_body}, // post data
					success: function(data)   // A function to be called if request succeeds
					{
						alert(data);
						$("#rfq .close").click();
					}
				});
			});







</script>
		<!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";?>
		<!--Including Bootstrap and other scripts-->


		<script type="text/javascript">
// autocomplete : this function will be executed every time we change the text
		//jQuery(function($)
		//{
			//$('input[name="ui_vendor_email"]').on('keyup', function()
			function auto_rfq()
			{
				var min_length = 0; // min caracters to display the autocomplete
				var keyword1 = $("input[name=ui_vendor_email]").val();
				keyword1 = keyword1.replace(/ /g,"%");
				if (keyword1.length >= 1)
				{
					$.ajax({
						url: '../php/api_search.php',
						type: 'POST',
						data: {term:keyword1},
						success:function(data)
						{
							$("ul[name='vendor_email_list']").show();
							$("ul[name='vendor_email_list']").html(data);
						}
					});
				}
				else
				{
					$("ul[name='vendor_email_list']").hide();
				}
			}
			//});
		//});


	// set_item : this function will be executed when we select an item
	function set_item(item)
	{
		// change input value
		$("input[name='ui_vendor_email']").val(item);

		// hide proposition list
		$("ul[name='vendor_email_list']").hide();
	}

		</script>


		<!-- Modal -->
<div id="convert_to_order" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Convert To Order</h4>
      </div>
      <div class="modal-body">
	  <form method="POST" action="clone_order_html_rfq.php?id=<?php echo $enquiry_id;?>&type=Rfq1">
       					<div class="row">
						<div class="col-xs-12 table-responsive">
							<table class="table table-striped">
								<thead>
									<tr>
									<th><center><input type="checkbox" name="all_item[]" onclick="fn_checked('a');" value=""/></center></th>
									<th><center>Sl No.</center></th>
									<th><center>Product Name</center></th>
									<th><center>Description</center></th>
									<th><center>Quantity</center></th>
									<th><center>Price</center></th>
									<th><center>Tax</center></th>
									<th><center>Tax I/E</center></th>
									<th><center>Total</center></th>
									</tr>
								</thead>
								<tbody>
									<?php $count=1; while ($enquiry_product_result_n = mysqli_fetch_array($result9,MYSQLI_ASSOC)) {?>
									<tr>
									<td><center><input type="checkbox" name="prod_item[]" onclick="fn_checked();" value="<?php echo $enquiry_product_result_n['id'];  ?>"/></center></td>
									<td><center><?php echo $count;  ?></center></td>
									<td><center><?php echo $enquiry_product_result_n['product_name'];  ?></center></td>
									<td><center><?php echo $enquiry_product_result_n['product_description'];  ?></center></td>
									<td><center><?php echo $enquiry_product_result_n['product_quantity'];  ?></center></td>
									<td><center><?php echo $enquiry_product_result_n['enquiry_selling_price']; ?></center></td>
									<td><center><?php echo $enquiry_product_result_n['enquiry_tax'];  ?></center></td>
									<td><center><?php if($enquiry_product_result_n['tax_inclusive']==1)
									{
										echo "Inclusive";
									}
									else
									{
										echo "Exclusive";
									}
									?></center></td>
									<td><center><?php echo $enquiry_product_result_n['enquiry_total'];  ?></center></td>
									</tr>
									<?php $count=$count+1;} ?>
								</tbody>
							</table>
						</div>
					</div>

										<!-- this row will not appear when printing -->
					<div class="row no-print">
						<div class="form-group col-md-2 col-md-offset-9">

								<button type="submit" id="btn_cnvrt_to_ord" class="btn btn-success"><i class="fa fa-envelope"></i>  &nbsp; Convert To Order
								</button>

						</div>
					</div>
					</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
function fn_checked(allcheck)
{
//if($('#prod_item').is(':checked') )
	if (allcheck == 'a')
	{
			$('input[name="prod_item[]"]').each(function () {
				   if (this.checked) {
					   this.checked = false;
				   }
				   else
					   this.checked = true;
			});
	}

if($('input[name="prod_item[]"]:checked').length > 0)
{

$("#btn_cnvrt_to_ord").prop('disabled', false);
}
else
{

$("#btn_cnvrt_to_ord").prop('disabled', true);
}
}
</script>


</body>

</html>
