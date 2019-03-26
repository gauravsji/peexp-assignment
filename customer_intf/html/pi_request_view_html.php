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

	$(document).ready(function()
	{
		// Handler for .ready() called.
		$("#li_enquiry").addClass("active");
		$("#li_enquiry_report").addClass("active");

$("#btn_cnvrt_to_ord").prop('disabled', true);
		$("#modal_add_task").click(function()
		{
			var enquiry_id= <?php echo $enquiry_id;?>;
			var task_name= $("#ui_modal_task_name").val();
			var assignee_name= $("#ui_assignee_name").val();
			var due_date= $("#ui_task_due_date").val();
			var task_status= $("#ui_task_status").val();
			var task_description= $("#ui_task_description").val();
			var task_remarks= $("#ui_task_remarks").val();
			var user_id= <?php echo $user_result['customer_id'];?>;
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

			<div class="content-wrapper">
				<section class="content-header">
					<h1>
						Enquiry Details
						<a href="../reports/pi_report_html.php" class="btn pull-right">
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
										<i></i>  <center><h3>Enquiry For:  <strong><?php echo $enquiry_result['enquiry_name'] ?></strong></h3></center>
										<div class="pull-left">Date:  <strong><?php  echo date("d-m-Y", strtotime($enquiry_result['enquiry_date'])) ?></strong> </div>
										<div class="pull-right">Enquiry No:  <strong><?php  echo $enquiry_result['rfq_id']; ?></strong> </div>
                    <br><br>
                    <div class="btn-toolbar">
                      <a href=<?php echo "../php/estimate_pdf.php?rfq_id=".$enquiry_result['rfq_id'];?> target="_blank" download><button class="btn btn-md btn-success">Download PDF </button></a>
										</div>
                    <div class="btn-toolbar">
  										<button type="button" class="btn btn-warning btn-flat pull-right" data-toggle="modal"  data-target="#upload_po">
  											<i class="fa fa-edit"></i> Upload PO
  										</button>
								</div>
							</div>
							<input type="hidden" id="draft_id" value=<?php echo $enquiry_id;?>>
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
													$sq="SELECT data_entered_by FROM enquiry where enquiry_id=". $enquiry_result['enquiry_id'];
													$resul67 = mysqli_query($conn, $sq);
													$u_res = mysqli_fetch_array($resul67,MYSQLI_ASSOC);
													{
														$sqlu = "SELECT name,id FROM users where id = " . $u_res['data_entered_by'];
														$result5 = mysqli_query($conn, $sqlu);
														$u_result = mysqli_fetch_array($result5,MYSQLI_ASSOC);
														{
															echo $u_result['name'];
														}
													}
												?>
												</strong></td></tr>
											</table>
										</div>
									</address>
								</div>

								<div class="col-md-4 invoice-col">
									<address>
									<div class="table-responsive">
										<table class="table">
											<tr><td> Sales Lead Name:</td><td><strong>  <?php echo $enquiry_result['sales_lead_name'] ?></strong></td></tr>
											<tr><td> Sales Lead Contact Number:</td><td><strong>  <?php echo $enquiry_result['sales_lead_contact_number'] ?></strong></td></tr>
											<tr><td> Sales Lead Email:</td><td><strong>  <?php echo $enquiry_result['sales_lead_email'] ?></strong></td></tr>
										</table>
									</div>
									</address>
								</div>

								<div class="col-sm-4 invoice-col">
									<address>
									<div class="table-responsive">
									<table class="table">
									<tr><td> Enquiry Details:<br></td></tr>
									<tr><td rowspan="4"> <strong><?php echo $enquiry_result['enquiry_details'] ?></strong></td></tr>
									</table>
									</div>
									</address>
								</div>

								<div class="col-sm-4 invoice-col">
									<address>
										<div class="table-responsive">
											<table class="table">
												<tr><td> Status:  <strong><?php echo $enquiry_result['enquiry_status'] ?><br></strong></td></tr>
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
										<th><center>Remarks</th>
                      <th><center>Status</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql = 'SELECT * FROM rfq e,customer_rfq_enquiry ep where e.rfq_id='.$enquiry_id.' and e.rfq_id=ep.product_enquiry_id  and ep.delete_status<>1';
										$result = mysqli_query($conn,$sql);
										while ($row = mysqli_fetch_array($result))
										{
											// Print out the contents of the entry
											echo '<tr><td><center>' . $row['product_name'] . '</center></td>';
											echo '<td><center>' . $row['product_description'] . '</center></td>';
											echo '<td><center>' . $row['product_quantity'] . '</center></td>';
											echo '<td><center>' . $row['product_remarks'] . '</center></td>';
											echo '<td><center>' . $row['product_status'] . '</center></td></tr>';
										}
										?>
									</tbody>
								</table>
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
											$sql = "SELECT * FROM photo p, enquiry e where p.delete_status<>1 and p.module_name='enquiry' and p.module_id=e.enquiry_id and e.enquiry_id= " . $enquiry_id;
											$result = mysqli_query($conn,$sql);
											while ($row = mysqli_fetch_array($result))
											{
												// Print out the contents of the entry
												if((substr($row['photo_name'], -3))=="pdf")
												{
													echo '<tr><td><center><a href="../uploads/'.$row['photo_name'].'"/>Open PDF Attachment</a></td></tr>';
												}
												else if((substr($row['photo_name'], -4))=="docx")
												{
													echo '<tr><td><center><a href="../uploads/'.$row['photo_name'].'"/>Open Word Attachment</a></td></tr>';
												}
												else if((substr($row['photo_name'], -3))=="doc")
												{
													echo '<tr><td><center><a href="../uploads/'.$row['photo_name'].'"/>Open Word Attachment</a></td></tr>';
												}
												else if((substr($row['photo_name'], -4))=="xlsx")
												{
													echo '<tr><td><center><a href="../uploads/'.$row['photo_name'].'"/>Open Excel Attachment</a></td></tr>';
												}
												else if((substr($row['photo_name'], -3))=="xls")
												{
													echo '<tr><td><center><a href="../uploads/'.$row['photo_name'].'"/>Open Excel Attachment</a></td></tr>';
												}
												else
												{
													echo '<tr><td><center><img width="35%" class="fancybox" height="35%" src="../uploads/'.$row['photo_name'].'"/></center></td></tr>';
												}
												echo '<tr><td><center><a title="Delete" onclick="return confirm(\"Delete this record?\")" class="btn btn-danger" href="../php/delete/delete_enquiry_photo.php?id=' . $row['photo_id'] . '">Delete</a></center></td></tr>';
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
						</div>
					</div>
				</section>
			</div>

			<!-- Main Footer -->
			<footer class="main-footer">
			</footer>
			<!-- Main Footer -->

      <!-- Upload Po -->

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
                  <label>Select FILE(PDF) , Possible to upload multiple file.</label>
                  <input type="file" name="excel_file[]" id="excel_file" multiple/>
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
      <!-- Upload Po -->






			<!--Including right slide panel-->
			<?php include "../extra/aside.php";?>
			<!--Including right slide panel-->

			<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		</div>


		<!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";?>
		<!--Including Bootstrap and other scripts-->

		<script>

		$(document).on('change', '#excel_file', function(){
			$('#export_excel').submit();

				});
		 $('#export_excel').on('submit', function(event){
					event.preventDefault();
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
							 $('#result').html(data);
							 $('#excel_file').val('');
						}

					 });
		});
		</script>

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
