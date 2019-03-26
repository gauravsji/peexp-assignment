<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php
	include "../../extra/session.php";
	include '../../constants.php';
	$url = $GLOBALS['url'];
	$ss_enquiry_id=$_GET["id"];
	$sql = "SELECT * FROM rfq where rfq_id = " . $ss_enquiry_id;
	$result = mysqli_query($conn, $sql);
	$enquiry_result = mysqli_fetch_array($result,MYSQLI_ASSOC);

	$sql4 = "SELECT * FROM customer_rfq_enquiry where delete_status<>1 and  product_enquiry_id = " . $_GET["id"];
	$result = mysqli_query($conn, $sql4);
	?>
	<!--Including Login Session-->

	<head>
		<!--Including Bootstrap CSS links-->
		<?php include "../../extra/header.html";?>
		<!--Including Bootstrap CSS links-->

	<script type="text/javascript" src="../../dist/js/line_items_script.js"></script>
	<script>
	function autocomplet()
	{
		var min_length = 0; // min caracters to display the autocomplete
		var keyword = $("input[name='modal_product_name']").val();
		keyword=keyword.replace(/ /g,"%");
		if (keyword.length >= 4)
		{
			$.ajax({
				url: '../../php/get_product_line_item.php',
				type: 'POST',
				data: {keyword:keyword},
				success:function(data)
				{
					$("ul[name='products_list']").show();
					$("ul[name='products_list']").html(data);
				}
			});
		}
		else
		{
			$("ul[name='products_list']").hide();
		}
	}
</script>
	<script>
		function delete_record(e,draft_id)
		{
			var txt;
			var r = confirm("Confirm Delete");
			if (r == true)
			{
				var rowid = e;
				$.ajax({
					type : 'post',
					url : '../../php/delete/delete_rfq_customer_enquiry.php', //Here you will fetch records
					data :  {id:rowid}, //Pass $id
					success : function(data)
					{
						fetchMysqlDatabase(draft_id);
					}
				});
			}
			else
			{
			}
		}
		</script>

		<script type="text/javascript">
		window.onload = function() {
   //document.getElementById('ui_project_name').disabled = true;
				};
	$(document).ready(function()
	{
			fetchMysqlDatabase(<?php echo $ss_enquiry_id ?>);

		  $('#edit_enquiry_product_modal').on('show.bs.modal', function (e)
				{
					var rowid = $(e.relatedTarget).data('id');
					$.ajax({
						type : 'post',
						url : '../../php/get/get_rfq_enquiry_item.php', //Here you will fetch records
						data :  'rowid='+ rowid, //Pass $id
						success : function(data)
						{
							$('.fetched-data').html(data);//Show fetched data from database
						}
					});
				});



			// Handler for .ready() called.
			$("#li_enquiry").addClass("active");
			$("#li_new_enquiry").addClass("active");
			$(document).on('click', '#upload_product_submit', function(){
				$('#export_excel').submit();
					  });
				 $('#export_excel').on('submit', function(event){
					 console.log("Entered Upload Block");
				   		event.preventDefault();
				   		var modal_id=<?php echo $ss_enquiry_id; ?>;
							console.log(modal_id);
					var formData = new FormData(this);
					formData.append('modal_id', modal_id);
				   $.ajax({
						url:"../../test/export.php",
						method:"POST",
						data:formData,
						contentType:false,
						processData:false,
						success:function(data){
							console.log("Data Successfully Uploaded");
							 $('#upload_product_submit').hide();
							 $('#result').html(data);
							 $('#excel_file').val('');
						}
				   });
			  });

		$('#ui_customer_name').on('change',function()
		{
			document.getElementById("ui_project_name").disabled=false;
			var catID = $(this).val();
			if(catID)
				{
					$.ajax(
					{
						type:'POST',
						url:'../../php/ajax_customer_data.php',
						data: { customer_id: catID,project_id:''},
						success:function(html)
						{
							$('#ui_project_name').html(html);
						}
					});
				}
				else
				{
					$('#ui_project_name').html('<option value="">Select Project</option>');
				}
		});
	});
	</script>


	</head>
	<body class="hold-transition skin-blue fixed sidebar-mini">
		<div class="wrapper">

			<!--Including Topbar-->
			<?php include "../../extra/topbar.php";?>
			<!--Including Topbar-->

			<!--Including Left Nav Bar-->
			<?php include "../../extra/left_nav_bar.php";?>
			<!--Including Left Nav Bar-->

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>Edit Request
						<div class="btn-toolbar pull-right">
							<a href=<?php echo $url."/html/RFQ/view_rfq_html.php?id=".$ss_enquiry_id; ?> class="btn btn-sm btn-info">View Request</a>
							<a href=<?php echo $GLOBALS['add_rfq_html'];?> class="btn btn-sm btn-primary">New Request</a>
							<a href=<?php echo $GLOBALS['report_rfq'];?> class="btn btn-sm btn-success">Request Report</a>

						</div>
					</h1>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="row">
						<!-- left column -->
						<div class="col-md-12">
							<!-- general form elements -->
							<div class="box box-primary">
								<div class="box-header with-border"></div>
								<!-- /.box-header -->
								<div class="box-body pad">
								<form action=<?php echo $GLOBALS['update_rfq_php'];?> method="POST" onsubmit="submit.disabled = false; return true;"
								enctype="multipart/form-data">

								<input type="hidden" name="ui_enquiry_id" id="ui_enquiry_id" value="<?php echo $ss_enquiry_id;?>">

								<!--Date-->
								<div class="form-group col-md-3">
									<label>Date</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input type="text" readonly class="form-control pull-right" name="ui_enquiry_date" id="ui_enquiry_date" value="<?php echo date('d/m/Y', strtotime($enquiry_result['enquiry_date']));  ?>">
									</div>
								</div>
								<!--Date-->



								<!--Enquiry Name-->
								<div class="form-group col-md-3">
									<label>RFQ  Name</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="ion-android-list"></i></span>
										<input type="text" class="form-control" placeholder="Enquiry Name" style="text-transform:capitalize" id="enquiry_name" maxlength="60" name="enquiry_name" value="<?php echo $enquiry_result['enquiry_name'];  ?>"/>
									</div>
								</div>
								<!--Enquiry Name-->

								<!--Project Name-->
								<div class="form-group col-md-3">
									<label>Project Name</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-archive"></i></span>
										<select name="ui_project_name" id="ui_project_name" class='form-control select2' style='width: 100%;'>
										<option selected disabled hidden>Select Project</option>
										<?php
										{
											$sql = "SELECT * from project where delete_status<>1 and customer_id=".$enquiry_result['data_entered_by'];
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query))
											{
												if ($row['project_id'] == $enquiry_result['project_id']):
												{
												echo "<option value='" . $row['project_id'] . "' selected>" . $row['project_name']. "</option>";
												}
												else:
												{
													echo "<option value='" . $row['project_id'] . "'>" . $row['project_name']. "</option>";
												}
												endif;
											}
										}
										?>
										</select>
									</div>
								</div>
								<!--Project Name-->

								<!--Customer Name-->
								<div class="form-group col-md-3">
									<label>Assignee</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user"></i></span>
										<select name="ui_customer_name" id="ui_customer_name" class='form-control select2' style='width: 100%;'>
										<option selected disabled hidden value="0">Select Customer</option>
										<?php
										{
											$sql = "SELECT * from customer where delete_status<>1";
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query))
											{
												if ($row['customer_id'] == $enquiry_result['customer_id']):
												{
												echo "<option value='" . $row['customer_id'] . "' selected>" . $row['customer_name']. "</option>";
												}
												else:
												{
													echo "<option value='" . $row['customer_id'] . "'>" . $row['customer_name']. "</option>";
												}
												endif;
											}
										}
										?>
										</select>
									</div>
								</div>
								<!--Customer Name-->

								<!--Enquiry Status-->
								<div class="form-group col-md-3">
									<label>RFQ Status</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-star"></i></span>
										<?php
										if($enquiry_result['enquiry_status'] == "Awaiting Quote")
										{
											echo "<input name='ui_enquiry_status' id='ui_enquiry_status' class='form-control' style='width: 100%;' value='Awaiting Quote' readonly>";
										}
										else if($enquiry_result['enquiry_status'] == "Quote Sent") {
											echo "<input name='ui_enquiry_status' id='ui_enquiry_status' class='form-control' style='width: 100%;' value='Quote Received' readonly>";
										}
										else if($enquiry_result['enquiry_status'] == "Rework Requested") {
											echo "<input name='ui_enquiry_status' id='ui_enquiry_status' class='form-control' style='width: 100%;' value='Rework Requested' readonly>";
										}
										else if($enquiry_result['enquiry_status'] == "Order Received") {
											echo "<input name='ui_enquiry_status' id='ui_enquiry_status' class='form-control' style='width: 100%;' value='Quote Accepted' readonly>";
										}
										else {
											echo "<input name='ui_enquiry_status' id='ui_enquiry_status' class='form-control' style='width: 100%;' value='".$enquiry_result['enquiry_status']."' readonly>";
										}


										?>


									</div>
								</div>
								<!--Assignee Name-->

								<!--Enquiry Priority-->
										<div class="form-group col-md-3">
											<label>RFQ Priority</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-star"></i></span>
												<select name="ui_enquiry_priority" id="ui_enquiry_priority" class='form-control select2' style='width: 100%;'>
												<option selected disabled hidden>Select</option>
												<?php

															$arraValue = ['LOW','MEDIUM','HIGH','CRITICAL'];
															echo '<option selected>'.$enquiry_result['enquiry_priority'].'</option>';
															foreach ($arraValue as $value) {
																if($enquiry_result != $value)
																	echo '<option>'.$value.'</option>';
															}
													?>
												</select>
											</div>
										</div>
										<!--Enquiry Priority-->


										<div class="form-group col-md-3">
											<label>Expected Delivery Date</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" readonly class="form-control pull-right" name="ui_rfq_edd" id="ui_rfq_edd" value="<?php echo date('d/m/Y', strtotime($enquiry_result['end_date']));  ?>">
											</div>
										</div>



									<div class="form-group col-md-12">
									<div class="table-responsive">
										<div id="enquiry_line_item_div"></div>
									</div>
									</div>


								<div class="form-group btn-toolbar col-sm-2">
										<input type="button" class="btn btn-primary btn-flat" value="New Line Item" style="cursor: pointer;" data-toggle="modal" data-target="#add_line_item_modal"></input>
									</div>

								<div class="form-group btn-toolbar col-sm-2">
											<input type="button" class="btn btn-primary btn-flat" value="Upload Products" style="cursor: pointer;" data-toggle="modal" data-target="#div_upload_product"></input>
										</div>


								<!--Enquiry Details-->
								<div class="form-group col-md-12">
									<label>Remark</label>
									<textarea id="enquiry_details" name="enquiry_details" class="form-control" rows="7"><?php echo $enquiry_result['enquiry_details'];?></textarea>
								</div>

								<!-- File Upload -->
                    <div class="form-group col-md-12">
                    <div id="maindiv">
                      <div id="formdiv">
                        <h4 class="h4">Attachments</h4>
                        First Field is Compulsory. Only JPEG, PNG, JPG, PDF, DOC, DOCX, XLS, XLSX Type files allowed. File Size Should Be Less Than 1.5 MB.
                        <hr/>
                        <div id="filediv" align="center" style="display:block"><input name="file[]" type="file" id="file"/></div><br/>
                        <input type="button" id="add_more" class="upload" value="Add More Files"/>
                      </div>
                    </div>
                    </div>
                    <!-- File Upload -->
								

								<!-- User ID -->
								<input id="user_id" name="user_id" type="hidden" value="<?php echo $user_result['id'];?>"/>
								<!-- User ID -->

								<div class="col-lg-offset-10 col-lg-2">
									<button type="submit" data-loading-text="Please Wait..." class="btn btn-success form-control" id="update_rfq_data">	Update </button>
								</div>

							<!--	</form>
									<div class="form-group col-md-12">
										<form method="POST" action="../../php/upload_excel.php" onsubmit="submit.disabled = true; return true;"enctype="multipart/form-data">
											<div class="form-group">
												<label>Upload excel file</label>
												<input type="file" name="file" class="form-control">
											</div>
											<div class="form-group">
												<button type="submit" name="Submit" class="btn btn-success">Upload</button>
											</div>
										</form> -->
					</div>
								</div>
							</div>
							<!-- /.box -->
						</div>
						<!--/.col (left) -->
					</div>
					<!-- /.row -->
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
				<?php include "../../extra/aside.php";?>
				<!--Including right slide panel-->
				<!-- Add the sidebar's background. This div must be placed
				immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		</div>
		<!-- ./wrapper -->

		<!--Including Bootstrap and other scripts-->
		<?php include "../../extra/footer.html";?>
		<!--Including Bootstrap and other scripts-->

		<script>

		$('#update_rfq_data').on('click',function(){
			console.log('Update Data');
			console.log(<?php echo $ss_enquiry_id;?>);
			console.log($('#enquiry_name').val());
			draft_id = <?php echo $ss_enquiry_id;?>;
			enquiry_date = $('#ui_enquiry_date').val();
			customer_name = $('#ui_customer_name').val();
			project_name = $('#ui_project_name').val();
			enquiry_name = $('#enquiry_name').val();
			data_entered_by = $('#ui_assignee_name').val();
			enquiry_priority = $('#ui_enquiry_priority').val();
			enquiry_edd = $('#ui_rfq_edd').val();
			enquiry_details = $('#enquiry_details').val();
			$.ajax(
			{
				url: "../../php/update/update_rfq_enquiry.php",
				type: "POST",
				data: {draft_id: draft_id,
					ui_rfq_date:enquiry_date ,
					ui_customer_name: customer_name,
					ui_project_name:project_name,
					rfq_name:enquiry_name,
					enquired_by:data_entered_by,
					ui_rfq_edd:enquiry_edd,
					ui_project_priority:enquiry_priority,
					rfq_details:enquiry_details
				}, // post data
				success: function(data)   // A function to be called if request succeeds
				{
					$("#add_line_item_modal .close").click()
					$('#modal_product_name').val("");
					$("#modal_product_id").val("");
					$('#modal_product_remarks').val("");
					$('#modal_product_description').val("");
					$('#modal_product_quantity').val("");

					fetch_enquiry_products_after_add(draft_id);
				}
			});

		});


		$(function ()
		{
		//Date picker
		$('#ui_enquiry_date').datepicker
		({
			format: 'dd/mm/yyyy',
		autoclose: true
		});

		//Date picker
		$('#ui_rfq_edd').datepicker
		({
			format: 'dd/mm/yyyy',
		autoclose: true
		});


		});

		var change_location;
		$('#ui_customer_name').on('change',function()
		{
			$("#ui_project_name").prop("enabled", true);
			if(change_location!="sales")
			{
			var value = $('#ui_sales_lead').val();
			//alert(value);
			if(value>0)
				{

				 $("#ui_project_name").attr("disabled");
				//document.getElementById("ui_project_name").disabled=true;
				change_location="customer";
				$('#ui_sales_lead').val('0').trigger('change');
				}
			}
			else
				{
				change_location="";
			}

		});

		$('#ui_sales_lead').on('change',function()
		{
			if(change_location!="customer")
			{
				var value = $('#ui_customer_name').val();
				//alert(value);
				if(value>0)
				{

				//$("#ui_project_name").prop("disabled", "disabled");
				change_location="sales";
				$('#ui_customer_name').val('0').trigger('change');
				$("#ui_project_name").prop("disabled", true);
				}
			}
			else
			{
				change_location="";
			}
		});

		</script>










		<!-- Add Line Item Modal -->
		<div id="add_line_item_modal" class="modal fade" role="dialog">
			<div class="modal-dialog  modal-lg">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add New Item</h4>
					</div>
					<div class="modal-body">
						<form role="form" id="contact" name="contact" method="post">
							<div class="row">
								<div class="col-md-12">
									<!--Product Name-->
									<div class="form-group">
										<label>Product Name</label>
										<input type="text" class="form-control" id="modal_product_name" name="modal_product_name" autocomplete="off" style="text-transform:capitalize" onkeyup="autocomplet()" />
									</div>
									<!--Product Name-->
								</div>
								<ul name="products_list" id="products_list"></ul>

								<!-- Modal Prduct Id -->

								<input type="hidden" id="modal_product_id" name="modal_product_id"/>

								<!--Description-->
								<div class="col-md-12">
									<div class="form-group">
										<label>Description</label>
										<textarea class="form-control" id="modal_product_description" name="modal_product_description"></textarea>
									</div>
								</div>
								<!--Description-->

								<!--Quantity-->
								<div class="col-md-3">
									<div class="form-group">
										<label>Quantity</label>
										<input type="text" class="form-control" id="modal_product_quantity"  name="modal_product_quantity" maxlength="50" onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46' />
									</div>
								</div>
								<!--Quantity-->


								<!--Remarks-->
								<div class="col-md-6">
									<div class="form-group">
									<label>Remarks</label>
										<textarea class="form-control" id="modal_product_remarks" name="modal_product_remarks" rows="3"></textarea>
									</div>
								</div>
								<!--Remarks-->


							</div>
						</form>
					</div>
					<div class="modal-footer">
						<!--Save-->
						<button class="btn btn-success" type="button" id="save_line_item_submit" name="save_line_item_submit">Save</button>
						<!--Save-->
						<button id="submit" type="submit" id="close_line_items_modal" name="close_line_items_modal" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Add Line Item Modal -->

	<!-- upload Products -->
	<div id="div_upload_product" class="modal fade" role="dialog">
		<div class="modal-dialog  modal-lg">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Upload Products</h4>
				</div>
				<div class="modal-body">
					<form method="post" id="export_excel">
          <label>Select Excel (xls,xlsx,csv)</label>
					 <a href="../../test/rfq_upload.csv" download>Download Format</a>
					 <br/>
          <input type="file" name="excel_file" id="excel_file" />
					 <!-- <input type="hidden" name="modal_id" id="modal_id" value=""/> -->
					 </form>
                <br />
                <br />
                <div id="result" name="result">
                </div>
				</div>
				<div class="modal-footer">
					<!-- Save -->
					<button class="btn btn-success" type="button" id="upload_product_submit" name="upload_product_submit">Upload</button>
					<!--Save-->
					<button id="submit" type="submit" id="close_upload_product_submit" name="close_upload_product_submit"class="btn btn-default pull-right" data-dismiss="modal" onclick="fetch_enquiry_products_after_add('<?php echo $ss_enquiry_id; ?>')">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- upload Products -->


<div class="modal fade" id="edit_enquiry_product_modal" role="dialog">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Edit Line Items</h4>
						</div>
						<div class="modal-body">
							<div class="fetched-data"></div> <!--Data will be displayed here after fetching-->
						</div>
						<div class="modal-footer">
						<!--Save-->
						<button class="btn btn-success" type="button" id="save_edit_line_item_submit" name="save_edit_line_item_submit">Save</button>							<!--Save-->
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>

		<script type="text/javascript">
		$("#save_line_item_submit").click(function() {
			console.log("In the Enquiry Save Line item Function 461");
			var draft_id= $("#ui_enquiry_id").val();
			var product_id=$("#modal_product_id").val();
			var product_name= $("#modal_product_name").val();
			var product_description= $("#modal_product_description").val();
			var product_quantity= $("#modal_product_quantity").val();
			var product_remarks = $("#modal_product_remarks").val();

			var product_image=$('#image_file').val();
			console.log("invocatiom");
			var formData = new FormData();
			console.log("invocatiom1");
			$.ajax(
			{
				url: "../../php/add_model/add_customer_rfq_product.php",
				type: "POST", // you can use GET
				data: {draft_id:draft_id,product_id:product_id,product_name:product_name,product_description:product_description,product_quantity:product_quantity,product_remarks:product_remarks}, // post data
				success: function(data)   // A function to be called if request succeeds
				{
					$("#add_line_item_modal .close").click()
					$('#modal_product_name').val("");
					$("#modal_product_id").val("");
					$('#modal_product_remarks').val("");
					$('#modal_product_description').val("");
					$('#modal_product_quantity').val("");
					// $('#image_file').val("");

					fetch_enquiry_products_after_add(draft_id);
				}
			});
		});








function fetch_enquiry_products_after_add(draft_id)
{
		$.ajax({
			type: "POST",
			dataType: "html",
			url: "../../php/get/get_customer_enquiry_product.php",
			data: {draft_id:draft_id},
			cache: false,
			beforeSend: function()
			{
				$('#enquiry_line_item_div').html('loading please wait...');
			},
			success: function(htmldata)
			{
				$('#enquiry_line_item_div').html(htmldata);
			}
		});
}




function fetchMysqlDatabase(draft_id)
{

		$.ajax({
			type: "POST",
			dataType: "html",
			url: "../../php/get/get_customer_enquiry_product.php",
			data: {draft_id:draft_id},
			cache: false,
			beforeSend: function()
			{
				$('#enquiry_line_item_div').html('loading please wait...');
			},
			success: function(htmldata)
			{
				$('#enquiry_line_item_div').html(htmldata);
			}
		});
}



	$("#save_edit_line_item_submit").click(function()
	{
			var product_id= $("#edit_draft_id").val();
			var product_enquiry_id = $('#edit_rfq_id').val();
			var product_name= $("#edit_modal_product_name").val();
			var product_description= $("#edit_modal_product_description").val();
			var product_quantity= $("#edit_modal_product_quantity").val();
			var product_status = $('#edit_modal_product_status').val();
			var remarks=$('#edit_modal_product_remarks').val();
			$.ajax(
			{
				url: "../../php/update/update_rfq_enquiry_item.php",
				type: "POST", // you can use GET
				data: {product_enquiry_id:product_enquiry_id,product_id:product_id,product_name: product_name, product_description: product_description,product_quantity:product_quantity,remarks:remarks,product_status:product_status}, // post data
				success: function(data)   // A function to be called if request succeeds
				{
					$("#edit_enquiry_product_modal .close").click();
					$("#edit_draft_id").val("");
					$('#edit_modal_product_name').val("");
					$('#edit_modal_product_description').val("");
					$('#edit_modal_product_quantity').val("");
					$('#edit_modal_product_remarks').val("");
					fetchMysqlDatabase(product_enquiry_id);
				}
			});
		});




		function handleChange(input)
		{
			if (input.value < 0) input.value = 0;
			//if (input.value > 100) input.value = 100;
		}

				</script>
	</body>
</html>
