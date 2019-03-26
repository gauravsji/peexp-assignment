<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";
	$enquiry_draft_id= mt_rand(); //Create an unique draft ID every time page loads
	?>
	<!--Including Login Session-->
	<head>
		<!--Including Bootstrap CSS links-->
		<?php include "../extra/header.html";?>
		<!--Including Bootstrap CSS links-->
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
					url : 'delete_enquiry_line_items.php', //Here you will fetch records 
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

				var a = buying_price * (1-(discount_percent/100));
				a=a.toFixed(2);
				document.getElementById('modal_product_discounted_price').value=a;

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
			
			function selling_price_function()
			{
				edit_product_price_function('P'); 
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
			<div class="content-wrapper ">
				<!-- Content Header (Page header) -->
				<section class="content-header">
				<h1>New Enquiry
					<a href="../reports/enquiry_report_html.php" class="btn pull-right btn-xs btn-primary">Enquiry Report</a> 
				</h1>
				</section>

				<!-- Main content -->
				<section class="content ">
					<div class="row">
						<!-- left column -->
						<div class="col-md-12">
						<!-- general form elements -->
							<div class="box box-primary">
								<div class="box-header with-border"></div>
								<!-- /.box-header -->
								<div class="box-body pad">
									<form action="../php/add/add_enquiry_php.php" method="post" enctype = "multipart/form-data"  onsubmit="submit.disabled = true; return true;">
										
										<!--Enquiry Draft ID-->
										<input type="hidden" name="draft_id" id="draft_id" value="<?php echo $enquiry_draft_id; ?>"/>
										<!--Enquiry Draft ID-->

										<!--Enquiry Date-->
										<div class="form-group col-md-3">
											<label>Enquiry Date</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" readonly class="form-control" name="ui_enquiry_date" value="<?php echo date("d/m/Y"); ?>" id="ui_enquiry_date"/>
											</div>
										</div>
										<!--Enquiry Date-->

										<!--Customer Name-->
										<div class="form-group col-md-3">
											<label>Customer Name</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-user"></i></span>
												<span id="ui_customer_span" name="ui_customer_span"></span>										
												<span class="input-group-addon" style="cursor: pointer;" data-toggle="modal" data-target="#add_customer_modal">
													<i class="fa fa-plus"></i>
												</span>
											</div>
										</div>
										<!--Customer Name-->

										<!--Project Name-->
										<div class="form-group col-md-3">
											<label>Project Name</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-archive"></i></span>
												<select name="ui_project_name" id="ui_project_name" required class='form-control select2' style='width: 100%;'>
													<option selected disabled hidden value="">Select Customer</option>
												</select>						
											</div>
										</div>
										<!--Project Name-->

										<!--Sales Lead-->
										<div class="form-group col-md-3">
											<label>Sales Lead</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-user"></i></span>
												<span id="ui_sales_lead_span" name="ui_sales_lead_span"> </span>		
												<span class="input-group-addon" style="cursor: pointer;" data-toggle="modal" data-target="#add_sales_lead_modal">
													<i class="fa fa-plus"></i>
												</span>
											</div>
										</div>
										<!--Sales Lead-->

										<!--Enquiry Name-->
										<div class="form-group col-md-4">
											<label>Enquiry Name</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="ion-android-list"></i></span>
												<input type="text" class="form-control" placeholder="Enquiry Name" style="text-transform:capitalize" id="enquiry_name" name="enquiry_name"/>
											</div>
										</div>
										<!--Enquiry Name-->

										<!--Assignee Name-->
										<div class="form-group col-md-2">
											<label>Assignee</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
												<select name="ui_assignee_name" id="ui_assignee_name" class='form-control select2' style='width: 100%;'>
												<option selected disabled hidden>Select Assignee</option>
												<?php
												{
													$sql = "SELECT id, name from users where authenticate<>0 order by name";
													$query = mysqli_query($conn, $sql);
													while($row = mysqli_fetch_array($query))
													{
														if ($row['id'] == $user_result['id']):
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
											<label>Enquiry Status</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-star"></i></span>
												<select name="ui_enquiry_status" id="ui_enquiry_status" class='form-control select2' style='width: 100%;'>
													<option disabled hidden>Select</option>
													<option>OPEN - QUOTE TO BE SENT</option>
													<option>OPEN - AWAITING PRODUCT INFO FROM CLIENT</option>
													<option>OPEN - AWAITING PRODUCT INFO FROM VENDOR</option>
													<option>OPEN - PRODUCT RESEARCH PENDING</option>
													<option>OPEN - QUOTE SENT, AWAITING APPROVAL</option>
													<option>CLOSED - REJECTED, PRICE TOO HIGH</option>
													<option>CLOSED - REJECTED, NOT THE RIGHT PRODUCT</option>
													<option>CLOSED - REJECTED, DELAYED REPONSE</option>
													<option>CLOSED - CLIENT CHANGED REQUIREMENT</option>
													<option>CLOSED - VENDOR NOT FOUND</option>
													<option>CLOSED - CONVERTED TO ORDER</option>
												</select>
											</div>
										</div>								
										<!--Enquiry Status-->
										
											<!--Enquiry Priority-->
										<div class="form-group col-md-3">
											<label>Enquiry Priority</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-star"></i></span>
												<select name="ui_enquiry_priority" id="ui_enquiry_priority" class='form-control select2' style='width: 100%;'>
													<option disabled hidden>Select</option>
													<option selected>LOW</option>
													<option>MEDIUM</option>
													<option>HIGH</option>
													<option>CRITICAL</option>
												</select>
											</div>
										</div>								
										<!--Enquiry Priority-->

										<!--Enquiry Line Items-->
										<div class="form-group col-md-12">
											<div class="table-responsive">
												<div id="enquiry_line_item_div"></div>
											</div>
										</div>
										<!--Enquiry Line Items-->

										<div class="form-group btn-toolbar col-md-2">										
											<input type="button" class="btn btn-primary btn-flat" value="New Line Item" style="cursor: pointer;" data-toggle="modal" data-target="#add_line_item_modal"></input>
										</div>
										<div class="form-group btn-toolbar col-md-2">										
											<input type="button" class="btn btn-primary btn-flat" value="Select Products" style="cursor: pointer;" data-toggle="modal" data-target="#select_product_modal"></input>
										</div>
										
										<!-- <div class="form-group btn-toolbar col-md-12">										
											<input type="button" class="btn btn-primary btn-flat" value="Upload Products" style="cursor: pointer;" data-toggle="modal" data-target="#div_upload_product"></input>
										</div> -->
										
										<!-- <div class="form-group col-md-12">
										<form method="POST" action="../php/upload_excel.php" enctype="multipart/form-data">
											<div class="form-group">
												<label>Upload excel file</label>
												<input type="file" name="file" class="form-control">
											</div>
											<div class="form-group">
												<button type="submit" name="Submit" class="btn btn-success">Upload</button>
											</div>
										</form>
									</div> -->

										
							<div class="form-group col-md-12">
								<div class="col-sm-2 col-md-offset-10 invoice-col">								
									<div class="invoice-col">
										<div class="form-group">
											<label class="control-label" for="inputSuccess">Transport Charge</label>
											<input type="text" class="form-control" onkeypress="return event.charCode > 47 && event.charCode < 58;" id="transport_charge" name="transport_charge">
										</div>
									</div>
								</div>
							</div>	
							
										<!--Enquiry Details-->
										<div class="form-group col-md-12">
											<label>Enquiry Details</label>
											<textarea id="enquiry_details" name="enquiry_details" class="form-control" rows="7"></textarea>
										</div>
										<!--Enquiry Details-->

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

										<!--Location-->
										<input id="location" name="location" type="hidden" value="<?php echo $user_result['location'];?>"/>
										<!--Location-->

										<!-- User ID -->
										<input id="user_id" name="user_id" type="hidden" value="<?php echo $user_result['id'];?>"/>
										<!-- User ID -->

										<!-- Save -->
										<div class="col-lg-offset-10 col-lg-2">
										<button type="submit" data-loading-text="Please Wait..." class="btn btn-success form-control">Save  </button>
										</div>
										<!-- Save -->
									</form>
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
			<div class="pull-right hidden-xs"></div>				
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
			
			$(document).ready(function()
			{			
				$('#edit_enquiry_product_modal').on('show.bs.modal', function (e) 
				{
					var rowid = $(e.relatedTarget).data('id');
					$.ajax({
						type : 'post',
						url : 'fetch_enquiry_line_items.php', //Here you will fetch records 
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
				fn_fetch_customer(0);
				fn_fetch_sales_lead(0);

				$( "#ui_project_name" ).prop( "disabled", true );

				var change_location="";
				
	$('#view_quick_product_html').DataTable({
		"aLengthMenu": [[25, 50, 75, 100 , -1], [25, 50, 75, 100, "All"]],
        "iDisplayLength": 25,
		"columnDefs":[  ],	 
		"order": [1, "ASC"],	
		 responsive: true	 
		});

/*$(document).on('change', '#excel_file', function(){		
					$('#export_excel').submit();
						  }); 
						  $('#export_excel').on('submit', function(event){  
				   event.preventDefault();  
				   $.ajax({  
						url:"../php/test/export.php",  
						method:"POST",  
						data:new FormData(this),  
						contentType:false,  
						processData:false,  
						success:function(data){  
							 $('#result').html(data);  
							 $('#excel_file').val('');  
						}
						
				   });  
			  });  */ //upload Products

$(document).on('change', '#ui_customer_name', function(){
	
				//$('#ui_customer_name').on('change',function()
				//{
				//	alert("Customer Change");
					$("#ui_project_name").prop("enabled", true);
					if(change_location!="sales")
					{
						var value = $('#ui_sales_lead').val();
						//alert("Here");
						if(value>0)
						{
							$("#ui_project_name").attr("disabled"); 						
							change_location="customer";
							$('#ui_sales_lead').val('0').trigger('change');
						}
					}
					else
					{
						change_location="";
					}

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
				});

$(document).on('change', '#ui_sales_lead', function(){
				//$('#ui_sales_lead').on('change',function()
				//{
					//alert("Sales Lead Change");
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
			
});

			function fn_fetch_project()
			{
				var catID = $('#ui_customer_name').val();
				if(catID)
				{
					$.ajax(
					{
						type:'POST',
						url:'../php/ajax_customer_data.php',
						data: { customer_id: catID,project_id:''},
						success:function(html)
						{
							document.getElementById('ui_project_name').disabled = false;
							$('#ui_project_name').html(html);
						}
					}); 
				}
				else
				{
					$('#ui_project_name').html('<option value="">Select Customer</option>');
				}
			};

			function add_customer_modal()
			{
				var customer_name= $("#modal_customer_name").val(); 
				var customer_contact_person= $("#modal_customer_contact_person").val();
				var customer_cnt_no= $("#modal_customer_contact_number").val();
				var customer_email= $("#modal_customer_email").val();
				var customer_address= $("#modal_customer_address").val();
				var user_id= $("#user_id").val();
				var location= $("#modal_sales_lead_location").val();
				$.ajax(
				{
					url: "../php/add_modal/add_customer_php.php",
					type: "POST", // you can use GET
					data: {customer_name: customer_name, customer_contact_person: customer_contact_person, customer_cnt_no:customer_cnt_no,customer_email:customer_email,customer_address:customer_address,user_id:user_id,location:location}, // post data
					success: function(data)   // A function to be called if request succeeds
					{
						$("#close_sales_lead_modal").click()
						$('#modal_customer_name').val("");
						$('#modal_customer_contact_person').val("");
						$('#modal_customer_contact_number').val("");
						$('#modal_customer_email').val("");
						$('#modal_customer_address').val("");
						$('#add_customer_modal').modal('hide');
						$('body').removeClass('modal-open');
						$('.modal-backdrop').remove();
						fn_fetch_customer(data);
					}
				});
			}

			function add_sales_lead_modal()
			{
				var lead_name= $("#modal_sales_lead_name").val(); 
				var sales_lead_contact_person= $("#modal_sales_lead_contact_person").val();
				var sales_lead_cnt_no= $("#modal_sales_lead_contact_number").val();
				var sales_lead_email= $("#modal_sales_lead_email").val();
				var sales_lead_address= $("#modal_sales_lead_address").val();
				var modal_sales_lead_location=$("#modal_sales_lead_location").val();
				var user_id= $("#user_id").val();			
				$.ajax(
				{
					url: "../php/add_modal/add_sales_lead_php.php",
					type: "POST", // you can use GET
					data: {sales_lead_name: lead_name, sales_lead_contact_person: sales_lead_contact_person, sales_lead_cnt_no:sales_lead_cnt_no,sales_lead_email:sales_lead_email,sales_lead_address:sales_lead_address,user_id:user_id,modal_sales_lead_location:modal_sales_lead_location}, // post data
					success: function(data)   // A function to be called if request succeeds
					{
						$("#add_sales_lead_modal .close").click()
						$('#modal_sales_lead_name').val("");
						$('#modal_sales_lead_contact_person').val("");
						$('#modal_sales_lead_contact_number').val("");
						$('#modal_sales_lead_email').val("");
						$('#modal_sales_lead_address').val("");
						$('#add_sales_lead_modal').modal('hide');
						$('body').removeClass('modal-open');
						$('.modal-backdrop').remove();
						fn_fetch_sales_lead(data);
					}
				});
			}

			function fn_fetch_customer(data)
			{	
				$.ajax(
				{
					type:'POST',
					url: '../php/get_all_customer.php',
					data: {customer_id:data},
					success:function(data)
					{
						$('#ui_customer_span').html(data);
						$("#ui_customer_name").select2();
						fn_fetch_project();
					}
				});		
			};

			function fn_fetch_sales_lead(data)
			{	
				$.ajax(
				{
					type:'POST',
					url: '../php/get_all_sales_lead.php',
					data: {sales_lead_id:data},
					success:function(data)
					{
						$('#ui_sales_lead_span').html(data);		
						$("#ui_sales_lead").select2();					
					}
				});		
			};
		</script>
	</body>

	<!-- Add Customer Modal -->
	<div id="add_customer_modal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add New Customer</h4>
				</div>
				<div class="modal-body">
					<form role="form" id="contact" name="contact" method="post">
						<!--Customer Name-->
						<div class="form-group">
							<label>Customer Name</label>
							<input type="text" class="form-control" style="text-transform:capitalize" id="modal_customer_name" name="modal_customer_name"/>
						</div>
						<!--Customer Name-->

						<!--Contact Person-->
						<div class="form-group">
							<label>Contact Person</label>
							<input type="text" class="form-control" style="text-transform:capitalize" id="modal_customer_contact_person" name="modal_customer_contact_person"/>
						</div>
						<!--Contact Person-->

						<!--Contact Number-->
						<div class="form-group">
							<label>Contact Number</label>
							<input type="text" class="form-control" id="modal_customer_contact_number" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="modal_customer_contact_number" maxlength="50"/>
						</div>
						<!--Contact Number-->

						<!--Email-->
						<div class="form-group">
							<label>Email</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
								<input type="email" class="form-control" placeholder="Ex: abc@gmail.com" id="modal_customer_email" maxlength="100" name="modal_customer_email" type="text">
							</div>
						</div>
						<!--Email-->

						<!--Customer Address-->
						<div class="form-group">
							<label>Customer Address</label>
							<textarea class="form-control" id="modal_customer_address" name="modal_customer_address"></textarea>
						</div>
						<!--Customer Address-->

						<!--Save-->
						<div class="form-group">
							<button class="btn btn-success" type="button"  onclick="add_customer_modal();" id="submit">Save</button>
						</div>
						<!--Save-->
					</form>
				</div>
				<div class="modal-footer">
					<button id="submit" type="submit" id="close_customer_modal" name="close_customer_modal"class="btn btn-default pull-right" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Add Customer Modal -->

	<!-- Add Sales Lead Modal -->
	<div id="add_sales_lead_modal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add New Sales Lead</h4>
				</div>
				<div class="modal-body">
					<form role="form" method="post">
						<!--Sales Lead Name-->
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" style="text-transform:capitalize" id="modal_sales_lead_name" name="modal_sales_lead_name" />
						</div>
						<!--Sales Lead Name-->

						<!--Contact Person-->
						<div class="form-group">
							<label>Contact Person</label>
							<input type="text" class="form-control" id="modal_sales_lead_contact_person" style="text-transform:capitalize" name="modal_sales_lead_contact_person" />
						</div>
						<!--Contact Person-->

						<!--Contact Number-->
						<div class="form-group">
							<label>Contact Number</label>
							<input type="text" class="form-control" id="modal_sales_lead_contact_number" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="modal_sales_lead_contact_number" maxlength="50"/>
						</div>
						<!--Contact Number-->

						<!--Email-->
						<div class="form-group">
							<label>Email</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
								<input type="email" class="form-control" placeholder="Ex: abc@gmail.com" id="modal_sales_lead_email" style="text-transform:lowercase" maxlength="100" name="modal_sales_lead_email" type="text" required/>
							</div>
						</div>
						<!--Email-->

						<!--Address-->
						<div class="form-group">
							<label>Address</label>
							<textarea class="form-control" id="modal_sales_lead_address" name="modal_sales_lead_address"></textarea>
						</div>
						<!-- Address-->
						
						<input id="modal_sales_lead_location" name="modal_sales_lead_location" type="hidden" value="<?php echo $user_result['location'];?>" />
						
						<!--Save-->
						<div class="form-group">
							<button class="btn btn-success" type="button"  onclick="add_sales_lead_modal();" id="submit">Save</button>
						</div>
						<!--Save-->
					</form>
				</div>
				<div class="modal-footer">
					<button id="submit" type="submit" id="close_sales_lead_modal" name="close_sales_lead_modal"class="btn btn-default pull-right" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Add Sales Lead Modal -->

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
									<input type="text" class="form-control" id="modal_product_buying_price" name="modal_product_buying_price" oninput="product_price_function();"  maxlength="50" onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode == 46'/>
								</div>
							</div>
							<!--Buying Price-->

							<!--Discount Percent-->
							<div class="col-md-2">
								<div class="form-group">
									<label>Discount Percent</label>
									<input type="text" class="form-control" id="modal_product_discount_percent" onchange="handleChange(this);" oninput="product_price_function();" name="modal_product_discount_percent" maxlength="5" onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46'/>
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
									<input type="text" class="form-control" id="modal_product_selling_percent"  oninput="product_price_function('D');" onchange="handleChange(this);"  name="modal_product_selling_percent" maxlength="5" onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46'/>
								</div>
							</div>
							<!--Selling Percent-->	

							<!--Selling Price-->
							<div class="col-md-3">
								<div class="form-group">
									<label>Selling Price</label>
									<input type="text" class="form-control" id="modal_product_selling_price" oninput="product_price_function('P');" name="modal_product_selling_price" maxlength="10" onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46'/>
								</div>
							</div>
							<!--Selling Price-->	

							<!--Tax-->
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
							<!--Tax-->

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

							<!--Remarks-->
							<div class="col-md-6">
								<div class="form-group">
								<label>Remarks</label>
									<textarea class="form-control" id="modal_product_remarks" name="modal_product_remarks" rows="3"></textarea>
								</div>
							</div>
							<!--Remarks-->

							<!--Enquiry Status-->
							<div class="col-md-6">
								<div class="form-group">
									<label>Status</label>
									<select id="modal_product_status" name="modal_product_status" onchange="product_price_function();" class='form-control' >
										<option value="Available">Available</option>
										<option value="Product Research">Product Research</option>
										<option value="Vendor Research">Vendor Research</option>
										<option value="Customer Declined">Customer Declined</option>
										<option value="Not Available">Not Available</option>
										<option value="Cancelled">Cancelled</option>						
									</select>
								</div>
							</div>								
							<!--Enquiry Status-->
						</div>				
					</form>				
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
	
	
	<!-- Select Product Modal -->
	<div id="select_product_modal" class="modal fade" role="dialog">
		<div class="modal-dialog  modal-lg">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Select Products</h4>
				</div>
				<div class="modal-body">			  
					<form role="form" id="select_product" name="select_product" method="post">
						<div class="row">
							<div class="box">
						<div class="box-body">
							 <div class="table-responsive">
							 <input type="hidden" name="qp_draft_id" id="qp_draft_id" value="<?php echo $enquiry_draft_id; ?>"/>
							<table id="view_quick_product_html" class="table table-bordered dt-responsive table-condensed table-striped">
								<thead class="thead-inverse">
									<tr>
										<th><center>Product Name</th>
										<th><center>Quantity</th>
										<th><center>Description</th>
										<th><center>Buying Price</th>
										<th><center>Selling Price</th>
										<th><center>Tax</th>
										<th><center>Add</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sql_qp = "SELECT * FROM quick_product";
									$result_qp = mysqli_query($conn,$sql_qp);
									$count = 0;
									while ($row = mysqli_fetch_array($result_qp))
									{
									// Print out the contents of the entry
									echo '<tr class="table-row">';
									echo '<td align="center">'.$row['quick_product_name'].'</td>';
									echo '<td align="center"><input type="text" id="qp_quantity'.$count.'"  name="qp_quantity'.$count.'" maxlength="5"/>
									<input type="hidden" id="qp_id'.$count.'"  name="qp_id'.$count.'" value="'.$row['quick_product_id'].'"/></td>';
									echo '<td align="center">'.$row['quick_product_description'].'</td>';
									echo '<td align="center">'.$row['quick_product_bp'].'</td>';
									echo '<td align="center">'.$row['quick_product_sp'].'</td>';
									echo '<td align="center">'.$row['quick_product_tax'].'</td>';
									echo '<td><center><a href="javascript:add_qp('.$count.');" class="btn btn-success btn-xs">Add</a></center></td>';
									$count = $count + 1;
									}
									?>
								</tbody>
							</table>
							</div>
						</div>
					<!-- /.box-body -->
					</div>
						</div>				
					</form>				
				</div>
				<div class="modal-footer">
					<!--Save-->
					<!-- <button class="btn btn-success" type="button" id="select_products_submit" name="select_products_submit">Add New Quick Product</button> -->
					<!--Save-->
					<button id="submit" type="submit" id="close_select_products_modal" name="close_select_products_modal"class="btn btn-default pull-right" data-dismiss="modal">Close</button>
				</div>			
			</div>
		</div>
	</div>
	<!-- Select Product Modal -->
	
	<!-- upload Products -->
	<!-- <div id="div_upload_product" class="modal fade" role="dialog">
		<div class="modal-dialog  modal-lg">
			
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Upload Products</h4>
				</div>
				<div class="modal-body">
					<form method="post" id="export_excel">  
                     <label>Select Excel</label>  
                     <input type="file" name="excel_file" id="excel_file" />  
					 <input type="hidden" name="modal_id" id="modal_id" value=""/>
					 </form>
                <br />  
                <br />  
                <div id="result" name="result">  
                </div>
				</div>
				<div class="modal-footer">
					
					<button class="btn btn-success" type="button" id="upload_product_submit" name="upload_product_submit">Upload</button>
					
					<button id="submit" type="submit" id="close_upload_product_submit" name="close_upload_product_submit"class="btn btn-default pull-right" data-dismiss="modal">Close</button>
				</div>			
			</div>
		</div>
	</div> -->
	<!-- upload Products -->

	<!--Edit Line Items-->
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
					<button class="btn btn-success" type="button" id="save_edit_line_item_submit" name="save_edit_line_item_submit">Save</button>							
					<!--Save-->
					<!--Close-->
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<!--Close-->
				</div>
			</div>
		</div>
	</div>		
	<!--Edit Line Items-->
	
	<script type="text/javascript">
	//Submit for select prodcuts
	function add_qp(qp_count) 
	{
	var draft_id= $("#draft_id").val();

	var qp_id = $("#qp_id"+qp_count).val();
	var qp_quantity = $("#qp_quantity"+qp_count).val();

	
    $.ajax({
        type: "POST",
             url: "../php/add_modal/add_select_products_php.php",
        data:{draft_id:draft_id,qp_id:qp_id,qp_quantity:qp_quantity},
        success: function(response) {
            //alert(response);
			fetch_enquiry_products_after_add(draft_id);
    
        },
        error: function(response) {
            alert(response);
        }
    });
    return false;
};
	
	
	$("#save_line_item_submit").click(function() 
	{
		
		var draft_id= $("#draft_id").val();				
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
		var product_tax_inclusive;


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
			url: "../php/get_enquiry_products.php",
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
			url: "../php/get_enquiry_products.php",
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
		var enquiry_product_id= $("#edit_draft_id").val();				
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
			url: "../php/add_modal/update_enquiry_php.php",
			type: "POST", // you can use GET
			data: {enquiry_product_id: enquiry_product_id, product_name: product_name, product_description: product_description, product_quantity:product_quantity,product_buying_price:product_buying_price,product_discount_price:product_discount_price,discounted_price:discounted_price,total_of_buying:total_of_buying,product_selling_percent:product_selling_percent,product_selling_price:product_selling_price,product_tax:product_tax,product_tax_inclusive:product_tax_inclusive,product_total:product_total,remarks:remarks, status:status}, // post data
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
			}
		});
	});

	function handleChange(input) 
	{
		if (input.value < 0) input.value = 0;
//		if (input.value > 500) input.value = 600;
	}  
	</script>	
</html>