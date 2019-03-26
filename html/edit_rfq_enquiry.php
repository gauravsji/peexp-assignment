<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";
	$rfq_id=$_GET["id"];
	$sql = "SELECT * FROM rfq where rfq_id = " . $rfq_id;
	$result = mysqli_query($conn, $sql);
	$enquiry_result = mysqli_fetch_array($result,MYSQLI_ASSOC);

	$sql4 = "SELECT * FROM customer_rfq_enquiry where delete_status<>1 and product_enquiry_id = " . $_GET["id"];
	$result = mysqli_query($conn, $sql4);
	?>
	<!--Including Login Session-->

	<head>
		<!--Including Bootstrap CSS links-->
		<?php include "../extra/header.html";?>
		<!--Including Bootstrap CSS links-->

	<script type="text/javascript" src="../dist/js/line_items_script.js"></script>

	<script>
		function delete_record(e)
		{
			var txt;
			var r = confirm("Confirm Delete");
			if (r == true)
			{
				var rowid = e;
				$.ajax({
					type : 'post',
					url : '../php/delete/delete_rfq_line_item.php', //Here you will fetch records
					data :  'rowid='+ rowid, //Pass $id
					success : function(data)
					{
						fetchMysqlDatabase(data);
					}
				});
			}
			else
			{
			}
		}

		$(function ()
		{
			//Date picker
			$('#ui_end_date').datepicker({
			format: 'dd/mm/yyyy',
			autoclose: true
			});
		});
		</script>

	<script>
function product_price_function(called_from)
			{
				var quantity=document.getElementById('modal_product_quantity').value;
				var buying_price=document.getElementById('modal_product_buying_price').value;
				var discount_percent=document.getElementById('modal_product_discount_percent').value;
				var selling_percent=document.getElementById('modal_product_selling_percent').value;
				var tax_string=document.getElementById('modal_product_tax').value;
				var selling_price = document.getElementById('modal_product_selling_price').value;
				var tax_i_e=0;
				var tax;
				if ($('#modal_tax_inclusive').is(":checked"))
				{
					tax_i_e=1;
				}
				tax_string = tax_string.substring(0, tax_string.length - 1);
				tax=parseFloat(tax_string);
				if(buying_price == '')
				{
					if(discount_percent == '')
						discount_percent =0;
					var a = 0 * (1-(discount_percent/100));
					a=a.toFixed(2);
					document.getElementById('modal_product_discounted_price').value=a;
				}
				else {
					var a = buying_price * (1-(discount_percent/100));
					a=a.toFixed(2);
					document.getElementById('modal_product_discounted_price').value=a;
				}


				var b = a*quantity;
				b=b.toFixed(2);
				document.getElementById('modal_product_total_of_buying').value=b;

				if (called_from == 'P')
				{
				var g =  ((selling_price/a)-1)*100;
				g=g.toFixed(2);
				document.getElementById('modal_product_selling_percent').value=g;
				}
				else
				{
				var c = a* (1+(selling_percent/100));
				c=c.toFixed(2);
				document.getElementById('modal_product_selling_price').value=c;
				}

				var d = c*quantity;
				d=d.toFixed(2);
				document.getElementById('modal_product_total').value=d;

				if (tax_i_e == 0)
				{
					e = b*(1+(tax/100));
					f = d*(1+(tax/100));
					e=e.toFixed(2);
					f=f.toFixed(2);
					document.getElementById('modal_product_total_of_buying').value=e;
					document.getElementById('modal_product_total').value=f;

				}
			}

			function edit_product_price_function(called_from)
			{
				var quantity=document.getElementById('edit_modal_product_quantity').value;
				var buying_price=document.getElementById('edit_modal_product_buying_price').value;
				var discount_percent=document.getElementById('edit_modal_product_discount_percent').value;
				var selling_percent=document.getElementById('edit_modal_product_selling_percent').value;
				var tax_string=document.getElementById('edit_modal_product_tax').value;
				var selling_price = document.getElementById('edit_modal_product_selling_price').value;

				var tax_i_e=0;
				var tax;
				if ($('#edit_modal_tax_inclusive').is(":checked"))
				{
					tax_i_e=1;
				}

				tax_string = tax_string.substring(0, tax_string.length - 1);
				tax=parseFloat(tax_string);

				var a = buying_price * (1-(discount_percent/100));
				a=a.toFixed(2);
				document.getElementById('edit_modal_product_discounted_price').value=a;

				var b = a*quantity;
				b=b.toFixed(2);
				document.getElementById('edit_modal_product_total_of_buying').value=b;

				if (called_from == 'P')
				{
				var g =  ((selling_price/a)-1)*100;
				g=g.toFixed(2);
				document.getElementById('edit_modal_product_selling_percent').value=g;
				}
				else
				{
				var c = a* (1+(selling_percent/100));
				c=c.toFixed(2);
				document.getElementById('edit_modal_product_selling_price').value=c;
				}

				var d = c*quantity;
				d=d.toFixed(2);
				document.getElementById('edit_modal_product_total').value=d;

				if (tax_i_e == 0)
				{
					e = b*(1+(tax/100));
					f = d*(1+(tax/100));

					e=e.toFixed(2);
					f=f.toFixed(2);
					document.getElementById('edit_modal_product_total_of_buying').value=Math.round(e);
					document.getElementById('edit_modal_product_total').value=Math.round(f);
				}
			}


		</script>






		<script type="text/javascript">
		window.onload = function() {
   //document.getElementById('ui_project_name').disabled = true;
				};
	$(document).ready(function()
	{


		  $('#edit_enquiry_product_modal').on('show.bs.modal', function (e)
				{
					var rowid = $(e.relatedTarget).data('id');
					$.ajax({
						type : 'post',
						url : 'fetch_rfq_enquiry_product.php', //Here you will fetch records
						data :  'rowid='+ rowid, //Pass $id
						success : function(data)
						{
							$('.fetched-data').html(data);//Show fetched data from database
						}
					});
				});


		fetchMysqlDatabase(<?php echo $rfq_id ?>)

			// Handler for .ready() called.
			$("#li_enquiry_manage").addClass("active");
			$("#li_user_enquiry_report").addClass("active");

$(document).on('change', '#excel_file', function(){
					$('#export_excel').submit();
						  });
						  $('#export_excel').on('submit', function(event){
				   event.preventDefault();
				   var modal_id=<?php echo $rfq_id; ?>;
					var formData = new FormData(this);
					formData.append('modal_id', modal_id);
				   $.ajax({
						url:"../php/test/export.php",
						method:"POST",
						data:formData,
						contentType:false,
						processData:false,
						success:function(data){
							 $('#result').html(data);
							 $('#excel_file').val('');
						}

				   });
			  });

		/*$('#ui_customer_name').on('change',function()
		{
			document.getElementById("ui_project_name").disabled=false;
			var catID = $(this).val();
			if(catID)
				{
					$.ajax(
					{
						type:'POST',
						url:'../php/ajax_customer_data.php',
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
		});*/
	});
	</script>


	</head>
	<body class="hold-transition skin-blue fixed sidebar-mini">
		<div class="wrapper">

			<!--Including Topbar-->
			<?php include "../extra/topbar.php";?>
			<!--Including Topbar-->

			<!--Including Left Nav Bar-->
			<?php include "../extra/left_nav_bar.php";?>
			<!--Including Left Nav Bar-->

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>Edit Request
						<div class="btn-toolbar pull-right">
							<a href="../html/view_rfq_enquiry.php?id=<?php echo $rfq_id;?>" class="btn btn-sm btn-info">View Request</a>
							<!--<a href="../html/add_enquiry_html.php" class="btn btn-sm btn-primary">New Enquiry</a>-->
							<a href="../reports/report_rfq_enquiry_html.php" class="btn btn-sm btn-success">Customer Request Report</a>

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
								<form action="../php/update/update_rfq_enquiry_php.php" method="POST" onsubmit="submit.disabled = false; return true;" enctype="multipart/form-data">

								<input type="hidden" name="ui_rfq_id" id="ui_rfq_id" value="<?php echo $rfq_id;?>">


								<!--Date-->
								<div class="form-group col-md-3">
									<label>Request Date</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input type="text" readonly class="form-control pull-right" name="ui_enquiry_date" id="ui_enquiry_date" value="<?php echo date('d/m/Y', strtotime($enquiry_result['enquiry_date']));  ?>">
									</div>
								</div>
								<!--Date-->

								<!--Customer Name-->
								<div class="form-group col-md-3">
									<label>Customer Name</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user"></i></span>
										<select name="ui_customer_name" id="ui_customer_name" class='form-control select2' style='width: 100%;' disabled>
										<option value="0">Select Customer</option>
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

								<!--Project Name-->
								<div class="form-group col-md-3">
									<label>Project Name</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-archive"></i></span>
										<select name="ui_project_name" id="ui_project_name" class='form-control select2' style='width: 100%;' disabled>
										<option selected disabled hidden>Select Project</option>
										<?php
										{
											$sql = "SELECT * from project where delete_status<>1 and project_id=".$enquiry_result['project_id'];
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


								<!--Enquiry Name-->
								<div class="form-group col-md-4">
									<label>Request Name</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="ion-android-list"></i></span>
										<input type="text" class="form-control" placeholder="Request Name" style="text-transform:capitalize" id="enquiry_name" maxlength="60" name="enquiry_name" value="<?php echo $enquiry_result['enquiry_name'];  ?>" readonly/>
									</div>
								</div>
								<!--Enquiry Name-->

								<!--Assignee Name-->
								<div class="form-group col-md-2">
									<label>Assignee</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
										<select name="ui_assignee_name" id="ui_assignee_name" class='form-control select2' style='width: 100%;' required>
											<option selected disabled hidden>Select Assignee</option>
											<?php
										{
											$sql = "SELECT id, name from users where authenticate<>0  order by name";
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query))
											{
												if ($row['id'] == $enquiry_result['enquiry_assignee']):
												{
												echo "<option value='" . $row['id'] . "' selected>" . $row['name']. "</option>";
												}
												else:
												{
													echo "<option value='" . $row['id'] . "'>" . $row['name']. "</option>";
												}
												endif;
											}
										}
										?>
										</select>
									</div>
								</div>
								<!--Assignee Name-->

								<!--Enquiry Status-->
								<div class="form-group col-md-3">
									<label>Request Status</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-star"></i></span>
										<select name="ui_enquiry_status" id="ui_enquiry_status" class='form-control select2' style='width: 100%;'>
										<option selected disabled hidden>Select</option>
										<?php
										{
											$sql = "SELECT * from rfq where delete_status<>1";
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query))
											{
												if ($row['rfq_id'] == $enquiry_result['rfq_id']):
												{
													if ($enquiry_result['enquiry_status']=='Awaiting Quote')
													{
														echo '<option value="Awaiting Quote" selected>Quote Awaited</option>';
													}
													else if($enquiry_result['enquiry_status']=='Quote Sent')
													{
														echo '<option value="Rework Requested" selected>Quote Sent</option>';
													}
													else if ($enquiry_result['enquiry_status']=='Rework Requested')
													{
														echo '<option value ="Rework Requested" selected>Rework Requested</option>';
													}
													else if ($enquiry_result['enquiry_status']=='Order Received')
													{
														echo '<option  value ="Order Received" selected>Order Received</option>';
													}
												}
													else:
													{
														echo "Error";
													}
												endif;
											}
										}
										?>
										</select>
									</div>
								</div>
								<!--Assignee Name-->

								<!--Enquiry Priority-->
										<div class="form-group col-md-3">
											<label>Request Priority</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-star"></i></span>
												<select name="ui_enquiry_priority" id="ui_enquiry_priority" class='form-control select2' style='width: 100%;'>
												<option selected disabled hidden>Select</option>
												<?php

															if ($enquiry_result['enquiry_priority']=='LOW')
															{
																echo '<option selected>LOW</option>';
																echo '<option>MEDIUM</option>';
																echo '<option>HIGH</option>';
																echo '<option>CRITICAL</option>';
															}
															else if ($enquiry_result['enquiry_priority']=='MEDIUM')
															{
																echo '<option >LOW</option>';
																echo '<option selected>MEDIUM</option>';
																echo '<option>HIGH</option>';
																echo '<option>CRITICAL</option>';
															}
															else if ($enquiry_result['enquiry_priority']=='HIGH')
															{
																echo '<option >LOW</option>';
																echo '<option>MEDIUM</option>';
																echo '<option selected>HIGH</option>';
																echo '<option>CRITICAL</option>';
															}
															else if($enquiry_result['enquiry_priority']=='CRITICAL')
															{
																echo '<option >LOW</option>';
																echo '<option>MEDIUM</option>';
																echo '<option>HIGH</option>';
																echo '<option selected>CRITICAL</option>';
															}
															else
															{
																echo '<option >LOW</option>';
																echo '<option>MEDIUM</option>';
																echo '<option>HIGH</option>';
																echo '<option>CRITICAL</option>';
															}


													?>
												</select>
											</div>
										</div>
										<!--Enquiry Priority-->
										<!--Delivery Date-->
									<div class="form-group col-md-3">
										<label>Expected Delivery Date</label>
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar-check-o"></i>
											</div>
											<input type="text" class="form-control pull-right" name="ui_end_date" value="<?php echo date('d/m/Y', strtotime($enquiry_result['end_date']));  ?>" id="ui_end_date">
										</div>
									</div>
									<!--Delivery Date-->



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

							<div class="form-group col-md-12">
								<div class="col-sm-2 col-md-offset-10 invoice-col">
									<div class="invoice-col">
										<div class="form-group">
											<label class="control-label" for="inputSuccess">TRANSPORT</label>
											<input type="text" class="form-control" id="transport_charge" name="transport_charge" value="<?php echo $enquiry_result['enquiry_transport_charge']; ?>">
										</div>
									</div>
								</div>
							</div>

								<!--Enquiry Details-->
								<div class="form-group col-md-12">
									<label>Remark</label>
									<textarea id="enquiry_details" name="enquiry_details" class="form-control" rows="7"><?php echo $enquiry_result['enquiry_details'];?></textarea>
								</div>
								<!--Enquiry Details-->


								<!-- File Upload -->
								<div class="form-group col-md-12">
									<div id="maindiv">
									<div id="formdiv">
										<h4>Attachments</h4>
										Files types allowed: JPEG, PNG, JPG, PDF, DOC, DOCX, XLS, XLSX, Max Size: 1.5 MB.
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
									<button type="submit" data-loading-text="Please Wait..." class="btn btn-success form-control">Update  </button>
								</div>
							<!--
									<div class="form-group col-md-12">
										<form method="POST" action="../php/upload_excel.php" onsubmit="submit.disabled = true; return true;"enctype="multipart/form-data">
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


			</form>

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

		<script>
		$(function ()
		{
		//Date picker
		$('#ui_enquiry_date').datepicker
		({
			format: 'dd/mm/yyyy',
		autoclose: true
		});
		});

		var change_location;

		/*$('#ui_customer_name').on('change',function()
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

		});*/

		/*$('#ui_sales_lead').on('change',function()
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
		});*/

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
								<input type="text" class="form-control" id="modal_product_name" name="modal_product_name" style="text-transform:capitalize"/>
							</div>
							<!--Product Name-->
						</div>

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
						<input type="text" class="form-control" id="modal_product_quantity" oninput="product_price_function();" name="modal_product_quantity" maxlength="50" onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46'/>
					</div>
					</div>
					<!--Quantity-->

					<!--Buying Price-->
					<div class="col-md-3">
						<div class="form-group">
						 <label>Buying Price</label>
							<input type="text" class="form-control" id="modal_product_buying_price" name="modal_product_buying_price" oninput="product_price_function();"  maxlength="50" onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46'/>
						</div>
					</div>
					<!--Buying Price-->

					<!--Discount Percent-->
					<div class="col-md-2">
					<div class="form-group">
					 <label>Discount Percent</label>
						<input type="text" class="form-control" id="modal_product_discount_percent" onchange="handleChange(this);" oninput="product_price_function();" name="modal_product_discount_percent" maxlength="7" onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46'/>
					</div>
					</div>
					<!--Discount Percent-->

					<!--Discounted Price-->
					<div class="col-md-2">
						<div class="form-group">
						 <label>Discounted Price</label>
							<input type="text" class="form-control" readonly id="modal_product_discounted_price" name="modal_product_discounted_price" maxlength="50" onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46'/>
						</div>
					</div>
					<!--Discounted Price-->


					<!--Total Buying Price-->
					<div class="col-md-2">
						<div class="form-group">
						 <label>Total Buying Price</label>
							<input type="text" class="form-control" readonly id="modal_product_total_of_buying" name="modal_product_total_of_buying" maxlength="50" onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46'/>
						</div>
					</div>
					<!--Total Buying Price-->

					<!--Selling Percent-->
					<div class="col-md-2">
					<div class="form-group">
					 <label>Selling Percent</label>
						<input type="text" class="form-control" id="modal_product_selling_percent"  oninput="product_price_function('D');" onchange="handleChange(this);"  name="modal_product_selling_percent" maxlength="7" onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46'/>
					</div>
					</div>
					<!--Selling Percent-->

					<!--Selling Price-->
					<div class="col-md-3">
					<div class="form-group">
					 <label>Selling Price</label>
						<input type="text" class="form-control" id="modal_product_selling_price" oninput="product_price_function('P');" onchange="handleChange(this);" name="modal_product_selling_price" maxlength="10" onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46'/>
					</div>
					</div>
					<!--Selling Price-->

					<div class="col-md-3">
					<div class="form-group">
					<label>TAX</label>
					<select id="modal_product_tax" name="modal_product_tax" onchange="product_price_function();" class='form-control' >
					<?php
					{
						$sql_tax = "SELECT * FROM key_value where key_column = 'TAX' and delete_status<>1 ORDER BY value";
						$tax_query = mysqli_query($conn, $sql_tax);
						while($tax_row = mysqli_fetch_array($tax_query))
						{
							echo "<option value='".$tax_row['value']."'>" . $tax_row['value']. "</option>";
						}
					}
					?>
					</select>
					</div>
					</div>

					<!--Tax Inclusive-->
					<div class="col-md-2">
					<div class="form-group">
					<label>Tax Inclusive </label>
						<input type="checkbox" class="checkbox" name="modal_tax_inclusive" onclick="product_price_function();" id="modal_tax_inclusive"/>
					</div>
					</div>
					<!--Tax Inclusive-->

					<!--Total-->
					<div class="col-md-2">
						<div class="form-group">
						 <label>Total</label>
							<input type="text" class="form-control" readonly id="modal_product_total" name="modal_product_total" maxlength="50" onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46'/>
						</div>
					</div>
					<!--Total-->


					<div class="col-md-6">
					<div class="form-group">
					<label>Remarks</label>
					<textarea class="form-control" id="modal_product_remarks" name="modal_product_remarks" rows="3"></textarea>
					</div>
					</div>


					<div class="col-md-6">
					<div class="form-group">
					<label>Status</label>
					<select id="modal_product_status" name="modal_product_status" onchange="product_price_function();" class='form-control' >
					<option value="Accept">Accept</option>
					<option value="Reject">Reject</option>
					<option value="Rework">Rework</option>
					</select>
					</div>
					</div>
				</form>
				</div>
			  </div>
			  <div class="modal-footer">
							<!--Save-->
						<button class="btn btn-success" type="button" id="save_line_item_submit" name="save_line_item_submit">Save</button>
					<!--Save-->
				<button id="submit" type="submit" id="close_line_items_modal" name="close_line_items_modal"class="btn btn-default pull-right" data-dismiss="modal">Close</button>
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
                     <label>Select Excel (xls,xlsx)</label>
					 <a href="../php/test/rfq_upload.csv" download>Download Format </a>
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
					<!--Save
					<button class="btn btn-success" type="button" id="upload_product_submit" name="upload_product_submit">Upload</button> -->
					<!--Save-->
					<button id="submit" type="submit" id="close_upload_product_submit" name="close_upload_product_submit"class="btn btn-default pull-right" data-dismiss="modal" onclick="fetch_enquiry_products_after_add('<?php echo $rfq_id; ?>')">Close</button>
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

			var draft_id=<?php echo $rfq_id; ?>;
			var product_name= $("#modal_product_name").val();
			var product_description= $("#modal_product_description").val();
			var product_quantity= $("#modal_product_quantity").val();
			var product_buying_price= $("#modal_product_buying_price").val();
			var product_discount_price= $("#modal_product_discount_percent").val();
			var product_selling_percent= $("#modal_product_selling_percent").val();
			var product_selling_price= $("#modal_product_selling_price").val();
			var product_tax= $("#modal_product_tax").val();
			var discounted_price=$('#modal_product_discounted_price').val();
			var total_of_buying=$('#modal_product_total_of_buying').val();
			var remarks=$('#modal_product_remarks').val();
			var status=$('#modal_product_status').val();
			var product_tax_inclusive = 0;


			if($("#modal_tax_inclusive").is(':checked'))
			{
				product_tax_inclusive=1;
			}
			else
			{
				product_tax_inclusive=0;
			}

			var product_total= $("#modal_product_total").val();
			var user_id= $("#user_id").val();
			var location= $("#location").val();
			$.ajax(
			{
				url: "../php/add_modal/add_enquiry_php.php",
				type: "POST", // you can use GET
				data: {draft_id: draft_id, product_name: product_name, product_description: product_description, product_quantity:product_quantity,product_buying_price:product_buying_price,product_discount_price:product_discount_price,discounted_price:discounted_price,total_of_buying:total_of_buying,product_selling_percent:product_selling_percent,product_selling_price:product_selling_price,product_tax:product_tax,product_tax_inclusive:product_tax_inclusive,product_total:product_total,remarks:remarks, status:status}, // post data
				success: function(data)   // A function to be called if request succeeds
				{
					$("#add_line_item_modal .close").click()
					$('#modal_product_name').val("");
					$('#modal_product_description').val("");
					$('#modal_product_quantity').val("");
					$('#modal_product_buying_price').val("");
					$('#modal_product_discount_percent').val("");

					$('#modal_product_discounted_price').val("");
					$('#modal_product_total_of_buying').val("");

					$('#modal_product_selling_percent').val("");
					$('#modal_product_selling_price').val("");
					$('#modal_tax_inclusive').val("");
					$('#modal_product_total').val("");
					$('#modal_product_remarks').val("");
					fetch_enquiry_products_after_add(draft_id);
				}
			});
		});








function fetch_enquiry_products_after_add(draft_id)
{
$.ajax({
	type: "POST",
	dataType: "html",
	url: "../php/get_rfq_enquiry_product.php",
	data: {draft_id:draft_id},
	cache: false,
	beforeSend: function()
	{
	$('#enquiry_line_item_div').html('loading please wait...');
	},
	success: function(htmldata)
	{
	console.log(htmldata);
	$('#enquiry_line_item_div').html(htmldata);
	}
});
}




function fetchMysqlDatabase(draft_id)
{
$.ajax({
	type: "POST",
	dataType: "html",
	url: "../php/get_rfq_enquiry_product.php",
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
			var id= $("#edit_draft_id").val();
			var product_name= $("#edit_modal_product_name").val();
			var product_description= $("#edit_modal_product_description").val();
			var product_quantity= $("#edit_modal_product_quantity").val();
			var product_buying_price= $("#edit_modal_product_buying_price").val();
			var product_discount_price= $("#edit_modal_product_discount_percent").val();
			var discounted_price=$('#edit_modal_product_discounted_price').val();
			var total_of_buying=$('#edit_modal_product_total_of_buying').val();

			var product_selling_percent= $("#edit_modal_product_selling_percent").val();
			var product_selling_price= $("#edit_modal_product_selling_price").val();
			var product_tax= $("#edit_modal_product_tax").val();
			console.log(product_tax);

			var remarks=$('#edit_modal_product_remarks').val();
			var status=$('#edit_modal_product_status').val();


			var product_tax_inclusive;

			if($("#edit_modal_tax_inclusive").is(':checked'))
			{
				product_tax_inclusive=1;
			}
			else
			{
				product_tax_inclusive=0;
			}

			var product_total= $("#edit_modal_product_total").val();
			var user_id= $("#user_id").val();
			var location= $("#location").val();
			$.ajax(
			{
				url: "../php/add_modal/update_rfq_enquiry_product.php",
				type: "POST", // you can use GET
				data: {id: id, product_name: product_name, product_description: product_description, product_quantity:product_quantity,product_buying_price:product_buying_price,product_discount_price:product_discount_price,discounted_price:discounted_price,total_of_buying:total_of_buying,product_selling_percent:product_selling_percent,product_selling_price:product_selling_price,product_tax:product_tax,product_tax_inclusive:product_tax_inclusive,product_total:product_total,remarks:remarks, status:status}, // post data
				success: function(data)   // A function to be called if request succeeds
				{
					$("#edit_enquiry_product_modal .close").click()
					$('#edit_modal_product_name').val("");
					$('#edit_modal_product_description').val("");
					$('#edit_modal_product_quantity').val("");
					$('#edit_modal_product_buying_price').val("");
					$('#edit_modal_product_discount_percent').val("");

					$('#edit_modal_product_discounted_price').val("");
					$('#edit_modal_product_total_of_buying').val("");

					$('#edit_modal_product_selling_percent').val("");
					$('#edit_modal_product_selling_price').val("");
					$('#edit_modal_product_tax').val("");
					$('#edit_modal_tax_inclusive').val("");
					$('#edit_modal_product_total').val("");
					$('#edit_modal_product_remarks').val("");
					fetchMysqlDatabase(data);
					window.location.reload();
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
