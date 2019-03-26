<!--
Description: View enquiry module displays details about the enquiries.
Date: 04/07/2017
-->
<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";
		$enquiry_id=$_GET["id"];
		$sql = "SELECT * FROM rfq e
    LEFT OUTER JOIN sales_lead sl ON e.sales_lead_id=sl.sales_lead_id
    LEFT OUTER JOIN customer c ON e.customer_id=c.customer_id
    LEFT OUTER JOIN project p ON e.project_id = p.project_id
    LEFT OUTER JOIN users u ON u.id = e.enquiry_assignee WHERE e.delete_status <> 1 and e.rfq_id =" . $enquiry_id ;
		$result = mysqli_query($conn, $sql);
		$enquiry_result = mysqli_fetch_array($result,MYSQLI_ASSOC);

		$grand_total=0; //Initialise grand total variable
		$sql4 = "SELECT * FROM customer_rfq_enquiry where delete_status<>1 and product_enquiry_id = " . $enquiry_id;
		$result4 = mysqli_query($conn, $sql4);

		$sql9 = "SELECT * FROM customer_rfq_enquiry where delete_status<>1 and product_enquiry_id = " . $enquiry_id;
		$result9 = mysqli_query($conn, $sql9);

		$sql6 = "SELECT * FROM customer_rfq_enquiry where delete_status<>1 and product_enquiry_id = " . $enquiry_id;
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
		</style>


			<script type="text/javascript">
	$(function ()
	{
		//Date picker
		$('#ui_task_due_date').datepicker
		({
			format: 'dd/mm/yyyy',
			autoclose: true
		});
	});

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

	$(document).ready(function()
	{
		get_po_rfq_details();

		// Handler for .ready() called.
		$("#li_enquiry").addClass("active");
		$("#li_enquiry_report").addClass("active");

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
			var user_id= '';
			var location= "";

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
						<a href="../reports/rfq_report_html.php" class="btn pull-right">
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
										<?php
											if($enquiry_result['pi_status'] == "pending" || $enquiry_result['pi_status'] == "" || $enquiry_result['pi_status'] == null)
											{
												?>
												<div class="btn-toolbar">
														<?php echo '<a class="btn btn-primary btn-flat btn-sm pull-right" href="../html/edit_rfq_html.php?id='.$enquiry_id.'"';'>'?>
														<button type="button" class="btn btn-primary ">
															<i class="fa fa-edit"></i> Edit
														</button>
														</a>
													</div>
												<?php
											}
										?>
								</div>
							</div>

							<div class="row invoice-info">
								<div class="col-sm-4 invoice-col">
									<address>
										<div class="table-responsive">
											<table class="table">
												<tr><td> Customer Name: </td><td> <strong>  <?php echo $enquiry_result['customer_name'] ?> </strong></td></tr>
												<tr><td> Project Name:</td><td><strong>  <?php echo $enquiry_result['project_name'] ?></strong></td></tr>
												<tr><td> Email:</td><td><strong>  <?php echo $enquiry_result['customer_email'] ?></strong></td></tr>
												<tr><td> Assignee:</td><td><strong>
												<?php
														$get_assignee_name = "SELECT customer_name,customer_id FROM customer where customer_id = " . $enquiry_result['enquiry_assignee'];
														$assignee_name1 = mysqli_query($conn, $get_assignee_name);
														$assigne_name = mysqli_fetch_array($assignee_name1,MYSQLI_ASSOC);
														{
															echo $assigne_name['customer_name'];
														}
												?>
												</strong></td></tr>
											</table>
										</div>
									</address>
								</div>


								<!--<div class="col-sm-4 invoice-col">
									<address>
									<div class="table-responsive">
									<table class="table">
									<tr><td> Remark:<br></td></tr>
									<tr><td rowspan="4"> <strong><?php echo $enquiry_result['enquiry_details'] ?></strong></td></tr>
									</table>
									</div>
									</address>
								</div>-->
								<div class="col-sm-4 invoice-col">
									<address>
										<div class="table-responsive">
											<table class="table">
												<tr><td> Status: </td><td> <strong><?php echo $enquiry_result['enquiry_status'] ?><br></strong></td></tr>
												<tr><td>Expected Delivery Date: </td><td><strong><?php  echo date("d-m-Y", strtotime($enquiry_result['end_date'])) ?><br></strong></td></tr>
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
										<th><center>Price</th>
										<th><center>Discount Percent</th>
										<th><center>Discount Price</th>
										<th><center>Tax</th>
										<th><center>Tax I/E</th>
										<th><center>Total</th>
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
											echo '<td><center>' . $row['enquiry_selling_price'] . '</center></td>';
											echo '<td><center>' . $row['enquiry_discount_percent'] . '</center></td>';
											echo '<td><center>' . $row['enquiry_discounted_price'] . '</center></td>';
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
											<?php $grand_total=$total_eq+$enquiry_result['enquiry_transport_charge']?>
											<div class="form-group has-success col-md-3 pull-right">
												<label class="control-label" style="text-align:center" for="inputSuccess">GRAND TOTAL</label>
												<input type="text" class="form-control" readonly id="grand_total" value="<?php echo $grand_total;?>">
											</div>
											<div class="invoice-col col-md-3 pull-right">
												<div class="form-group has-success">
													<label class="control-label" for="inputSuccess">TRANSPORT</label>
													<input type="text" class="form-control" readonly id="transport" value="<?php echo $enquiry_result['enquiry_transport_charge']; ?>" >
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
											$sql = "SELECT * FROM photo p, enquiry e where p.delete_status<>1 and p.module_name='rfq' and p.module_id=e.enquiry_id and e.enquiry_id= " . $enquiry_id;
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
							<div class="row no-print">
								<div class="col-xs-12">
								</div>
							</div>

							<?php
								if($enquiry_result['pi_status'] == "approved")
								{
									?>
										<div class="btn-toolbar">
											<a href=<?php echo "../php/estimate_pdf.php?rfq_id=".$enquiry_result['rfq_id'];?> target="_blank" download><button class="btn btn-md btn-success">Download PI </button></a>
											<?php
												if($enquiry_result['po_status'] != "customer_approved")
												{
												?>
														<button type="button" class="btn btn-warning btn-flat pull-left" data-toggle="modal"  data-target="#upload_po">
															<i class="fa fa-edit"></i> Upload PO
														</button>
														<?php
												}
											 ?>
										</div>
									<?php
								}

							?>
							<div class="form-group col-md-12" style="margin-top: 20px;">
								<div class="table-responsive">
									<div id="po_rfq_details"></div>
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

			<!-- Estimate -->
			<div class="modal fade" id="upload_po" role="dialog">
				<div class="modal-dialog modal-lg" style="width: 85%; height:70%;">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Upload PO</h4>
						</div>

						<div class="modal-body">
							<form method="post" id="export_excel">
								<div class="col-md-12">
									<div class="form-group">
										<label>Select FILE(PDF) , Possible to upload multiple file.</label>
										<input type="file" name="excel_file" id="excel_file" class="form-control" />
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Enter PO Number.</label>
										<input type="text" name="po_number" id="po_number" class="form-control"/>
									</div>
								</div>
							</form>

						</div>
						<div class="modal-footer">
							<!-- Save -->
							<button class="btn btn-success" type="button" id="upload_product_submit" name="upload_product_submit">Upload</button>
							<!--Save-->
							<button id="submit" type="submit" id="close_upload_product_submit" name="close_upload_product_submit"class="btn btn-default pull-right" data-dismiss="modal" onclick="fetch_enquiry_products_after_add('<?php echo $ss_enquiry_id; ?>')">Close</button>
						</div>
				</div>
			</div>

			<!--Including right slide panel-->
			<?php include "../extra/aside.php";?>
			<!--Including right slide panel-->

			<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		</div>


		<!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";
			ob_end_flush();
		?>

		<!-- Upload Po -->
		<script>
		function delete_record(draftId)
		{
			console.log("Entered Po Delete Function");
			$.ajax({
			 url:"../php/delete/delete_po_file.php",
			 method:"POST",
			 data:{id:draftId},
			 success:function(data){
				 console.log("Data Successfully Uploaded");
				 get_po_rfq_details();
			 }
			});
		}
		function apprve_po() {
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

		$(document).on('click', '#upload_product_submit', function(){

			$('#export_excel').submit();

				});
		 $('#export_excel').on('submit', function(event){
			 		event.preventDefault();

				 	file_value = $('#excel_file').val();
				 	file_text = $('#po_number').val();
				 	console.log(file_value);
				 	if(file_value == '')
				 	 	return alert('Please select an file');
				 	if(file_text == '')
					 	return alert('Please fill the textbox');
					//CHeck the file type
					var parts = file_value.split('.');
     			ext = parts[parts.length - 1].toLowerCase();
					extensionArray = ['pdf'];
					extension = extensionArray.includes(ext);
					if(!extension)
						return alert('Please select PDF file');

					console.log("Entered Upload Block");
					modal_id = $('#draft_id').val();

					var formData = new FormData(this);
					formData.append('modal_id', modal_id);

					 $.ajax({
						url:"../php/uploadFiles/upload_po.php",
						method:"POST",
						data:formData,
						contentType:false,
						processData:false,
						success:function(data){
							console.log("Data Successfully Uploaded");
							$('#po_number').val('');
							 $('#excel_file').val('');
							 get_po_rfq_details();
							 $("#upload_po .close").click()
						}

					 });
		});
		</script>

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
