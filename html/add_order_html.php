<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";
	$order_draft_id= uniqid();
	?> 
	<!--Including Login Session-->	

	<head>
		<!--Including Bootstrap CSS links-->
		<?php include "../extra/header.html";?>
		<!--Including Bootstrap CSS links-->
<style>
	#products_list 
	{
	cursor:pointer; 	
	list-style: none;
	background-color: #FFFFFF;
	padding:0;
	margin:0;
	}
	#products_list li 
	{ 
	padding-left:20px;
	padding-top: 5px;
	padding-bottom: 5px;
	transition: all 0.8s ease-in;
	}
	#products_list li:hover
	{
	background-color:#ffc966;
	}

	#edit_products_list 
	{
	cursor:pointer; 	
	list-style: none;
	background-color: #FFFFFF;
	padding:0;
	margin:0;
	}
	
	
	#edit_products_list li 
	{ 
	padding-left:20px;
	padding-top: 5px;
	padding-bottom: 5px;
	transition: all 0.8s ease-in;
	}
	
	#edit_products_list li:hover
	{
	background-color:#ffc966;
	}
	</style>

		<script type="text/javascript">
		
	// autocomplet : this function will be executed every time we change the text
	function edit_autocomplete() 
	{
		var min_length = 0; // min caracters to display the autocomplete
		var keyword = $("input[name='edit_modal_product_name']").val();
		keyword=keyword.replace(/ /g,"%");
		if (keyword.length >= 4) 
		{
			$.ajax({
				url: '../php/get_edit_order_product_line_item.php',
				type: 'POST',
				data: {keyword:keyword},
				success:function(data)
				{
					$("ul[name='edit_products_list']").show();
					$("ul[name='edit_products_list']").html(data);
				}
			});
		} 
		else 
		{
			$("ul[name='edit_products_list']").hide();
		}
	}

	// set_item : this function will be executed when we select an item
	function edit_set_item(item, id) 
	{
		// change input value
		$("input[name='edit_modal_product_name']").val(item);
		
		$("input[name='modal_product_id']").val(id);
		// hide proposition list
		$("ul[name='edit_products_list']").hide();
		
		var customer_id = document.getElementById('ui_customer_name').value;
		var vendor_id = document.getElementById('ui_vendor_name').value;
		//alert(vendor_id);
		edit_get_vendor_price(vendor_id,id);
		edit_get_customer_price(customer_id,id);
	}
	
	
	
			// autocomplet : this function will be executed every time we change the text
	function autocomplet() 
	{
		var min_length = 0; // min caracters to display the autocomplete
		var keyword = $("input[name='modal_product_name']").val();
		keyword=keyword.replace(/ /g,"%");
		if (keyword.length >= 4) 
		{
			$.ajax({
				url: '../php/get_order_product_line_item.php',
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

	// set_item : this function will be executed when we select an item
	function set_item(item, id) 
	{
		// change input value
		$("input[name='modal_product_name']").val(item);
		//alert(id);
		$("input[name='modal_product_id']").val(id);
		// hide proposition list
		$("ul[name='products_list']").hide();
		var vendor_id = document.getElementById('ui_vendor_name').value;
		var customer_id = document.getElementById('ui_customer_name').value;
		//alert(vendor_id);
		get_vendor_price(vendor_id,id);
		get_customer_price(customer_id,id);
		
	}
	// set_item : this function will be executed when we select an item
	function get_vendor_price(vendor_id,id) 
	{
		// ajax call to fetch vendor price
		$.ajax({
				url: '../php/get_vendor_price.php',
				type: 'POST',
				data: {vendor_id:vendor_id,product_id:id},
				success:function(data)
				{	
					document.getElementById('modal_previous_buy').value = data;
				
				}
			});
	}
	
		// set_item : this function will be executed when we select an item
	function get_customer_price(customer_id,id) 
	{
		// ajax call to fetch vendor price
		$.ajax({
				url: '../php/get_customer_price.php',
				type: 'POST',
				data: {customer_id:customer_id,product_id:id},
				success:function(data)
				{	
					document.getElementById('modal_previous_sell').value = data;
				
				}
			});
	}
	
	
		// set_item : this function will be executed when we select an item
	function edit_get_vendor_price(vendor_id,id) 
	{
		// ajax call to fetch vendor price
	$.ajax({
				url: '../php/get_vendor_price.php',
				type: 'POST',
				data: {vendor_id:vendor_id,product_id:id},
				success:function(data)
				{
					document.getElementById('edit_modal_previous_buy').value = data;
				}
			});
	}
	
			// set_item : this function will be executed when we select an item
	function edit_get_customer_price(customer_id,id) 
	{
		// ajax call to fetch vendor price
		$.ajax({
				url: '../php/get_customer_price.php',
				type: 'POST',
				data: {customer_id:customer_id,product_id:id},
				success:function(data)
				{	
					document.getElementById('edit_modal_previous_sell').value = data;
				
				}
			});
	}
	
			$(document).ready(function()
			{
				//$("#span_add_project").hide();
				$("span#span_add_project").addClass("hidden");
				$('#myModal').on('show.bs.modal', function (e) 
				{
					var rowid = $(e.relatedTarget).data('id');
					$.ajax({
						type : 'post',
						url : 'fetch_record.php', //Here you will fetch records 
						data :  'rowid='+ rowid, //Pass $id
						success : function(data)
						{
							$('.fetched-data').html(data);//Show fetched data from database
						}
					});
				});

		
				//fetchfromMysqlDatabase("<?php echo $order_draft_id;?>");
				$("#add_item_div").hide();
				fn_fetch_customers(0);
				fn_fetch_vendor(0);
				document.getElementById('ui_project_name').disabled = true;
				// Handler for .ready() called.
				$("#li_order").addClass("active");
				$("#li_new_order").addClass("active");


				$('#ui_product_set_id').on('change',function()
				{
					var product_attribute_id = $(this).val();
					if(product_attribute_id)
					{
						$.ajax(
						{
							type:'POST',
							url:'../php/select_attribute_value.php',
							data: { product_set_id: product_attribute_id},
							success:function(html)
							{
								$('#ui_span').html(html);
							}
						}); 
					}
					else
					{
						$('#ui_span').html('<option value="">Select category first</option>');
					}
				});
			});


			function fn_fetch_project()
			{			
				var catID = $('#ui_customer_name').val();
				if(catID>1)
				{
					$("#add_item_div").show();
					$("span#span_add_project").removeClass("hidden");
				}
				
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
							$.ajax(
							{
								type:'POST',
								url:'../php/get_customer_contact_person_data.php',
								data: { customer_id: catID},
								success:function(result)
								{
									$('#ui_order_placed_by').val(result);
								}
							}); 
						}
					}); 
				}
				else
				{
				$('#ui_project_name').html('<option value="">Select Customer</option>');
				}
			};


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
			
			
			function edit_product_price_function() 
			{
				
				var quantity=document.getElementById('edit_modal_product_quantity').value;
				var buying_price=document.getElementById('edit_modal_product_buying_price').value;
				var discount_percent=document.getElementById('edit_modal_product_discount_percent').value;
				var selling_percent=document.getElementById('edit_modal_product_selling_percent').value;
				var tax_string=document.getElementById('edit_modal_product_tax').value;
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
			
				var c = a* (1+(selling_percent/100));
				c=c.toFixed(2);	
				document.getElementById('edit_modal_product_selling_price').value=c;
				
				var d = c*quantity;
				d=d.toFixed(2);
				document.getElementById('edit_modal_product_total').value=d;
				
				if (tax_i_e == 0)
				{
					e = b*(1+(tax/100));
					f = d*(1+(tax/100));
					e=e.toFixed(2);
					f=f.toFixed(2);
				document.getElementById('edit_modal_product_total_of_buying').value=e;
				
				document.getElementById('edit_modal_product_total').value=f;
					
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
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						New Order
						<a href="../reports/order_report_html.php" class="btn pull-right btn-xs btn-primary">Order Report</a>
					</h1>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="row">
						<!-- left column -->
						<div class="col-md-12">
							<!-- general form elements -->
							<div class="box box-primary">
								<div class="box-header with-border">
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<form name="add_order_form" id="add_order_form" enctype="multipart/form-data" action="../php/add/add_order_php.php" method="post"  onsubmit="submit.disabled = true; return true;">
									
									<input type="hidden" name="draft_id" id="draft_id" value="<?php echo $order_draft_id; ?>"/>
									
									<!--Order Date-->
									<div class="form-group col-md-3">
										<label>Order Date</label>
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" required readonly class="form-control pull-right" name="ui_order_date" id="ui_order_date" value="<?php echo date("d/m/Y"); ?>">
										</div>
									</div>
									<!--Order Date-->
									
									<!--Vendor Name-->
									<div class="form-group col-md-3">
										<label>Vendor Name</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-user"></i></span>
											<span id="ui_vendor_span" name="ui_vendor_span"></span>
											<span class="input-group-addon" style="cursor: pointer;" data-toggle="modal" data-target="#add_vendor_modal"><i class="fa fa-plus"></i></span>
										</div>
									</div>
									<!--Vendor Name-->
									
									<!--Customer Name-->
									<div class="form-group col-md-3">
										<label>Customer Name</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-user"></i></span>
											<span id="ui_customer_span" name="ui_customer_span"></span>
											<span class="input-group-addon" style="cursor: pointer;" data-toggle="modal" data-target="#add_customer_modal"><i class="fa fa-plus"></i></span>
										</div>
									</div>
									<!--Customer Name-->

									<!--Project Name-->
									<div class="form-group col-md-3">
										<label>Project Name</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
											<select name="ui_project_name" id="ui_project_name" required class='form-control select2' style='width: 100%;'>
											<option selected disabled hidden value="">Select Customer</option>
											
											</select>
											<span id="span_add_project" class="input-group-addon" style="cursor: pointer;" data-toggle="modal" data-target="#add_project_modal"><i class="fa fa-plus"></i></span>
											</div>
									</div>
									<!--Project Name-->									
									
									<!--Order Placed By-->
									<div class="form-group col-md-3">
										<label>Order Placed By</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-male"></i></span>
											<input type="text" class="form-control" onkeyup="search_func(this.value);" class="form-control" id="ui_order_placed_by" name="ui_order_placed_by">
										</div>
									</div>
									<!--Order Placed By-->

									<!--Confirmation Type-->
									<div class="form-group col-md-3">
										<label>Confirmation Type</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-check"></i></span>
											<select name="ui_confirmation_type" id="ui_confirmation_type" class='form-control selectpicker' style='width: 100%;'>
											<option value="Whatsapp">Whatsapp</option>
											<option value="Email">Email</option>
											<option value="SMS">SMS</option>
											<option value="Call">Call</option>
											</select>
										</div>
									</div>
									<!--Confirmation Type-->									
									
									<!--Assignee Name-->
									<div class="form-group col-md-3">
									<label>Assignee Name</label>
									<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
									<select name="ui_assignee_name" id="ui_assignee_name" class='form-control select2' style='width: 100%;'>
									<option selected disabled hidden>Select Assignee</option>
									<?php
										{
											$sql = "SELECT id, name from users where authenticate<>0  order by name";
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
																				
									<!--Order Status-->
									<div class="form-group col-md-3 col-offset-2">
										<label>Order Status</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-line-chart"></i></span>
											<select name="ui_order_status" required id="ui_order_status" class='form-control selectpicker' style='width: 100%;'>										
											<option value="Order Created" selected>Order Created</option>
											<option value="Order Placed">Order Placed</option>
											<option value="Material Ready To Dispatch">Material Ready To Dispatch</option>
											<option value="Order Partially Delivered">Order Partially Delivered</option>
											<option value="Order Fulfilled">Order Fulfilled</option>
											<option value="Order Cancelled">Order Cancelled</option>
											</select>
										</div>
									</div>
									<!--Order Status-->			
									

									
									<!--Brief Order Detail-->
									<div class="form-group col-md-6">
										<label>Brief Order Detail</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-commenting"></i></span>
											<input type="text" class="form-control" class="form-control" id="ui_brief_order_details" name="ui_brief_order_details">
										</div>
									</div>
									<!--Brief Order Detail-->
									
										<!--Delivery Location-->
									<div class="form-group col-md-3">
										<label>Delivery Location</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-thumb-tack"></i></span>
											<select name="ui_delivery_location" id="ui_delivery_location" class='form-control selectpicker' style='width: 100%;'>
												<option value="Within State">Within State</option>
												<option value="Outside State">Outside State</option>
											</select>
										</div>
									</div>
									<!--Delivery Location-->
									
									<!--With Bill-->
									<div class="form-group col-md-3">
										<label>With Bill</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-file-text"></i></span>
											<select name="ui_with_bill" id="ui_with_bill" class='form-control selectpicker' style='width: 100%;'>
											<option value="With Bill" selected>With Bill</option>
											<option value="Without Bill">Without Bill</option>											
											</select>
										</div>
									</div>
									<!--With Bill-->	
									
									
									<div class="form-group col-md-12">
									<div class="table-responsive">
										<div id="res3"></div>
									</div>
									</div>


									
								
									
									
									<div class="form-group btn-toolbar col-md-12">										
										<input type="button" class="btn btn-primary btn-flat" value="New Product" style="cursor: pointer;" data-toggle="modal" data-target="#add_product_modal"></input>
										<input type="button" class="btn btn-success btn-flat" value="New items" style="cursor: pointer;" data-toggle="modal" data-target="#add_line_item_modal"></input>
										
										<!--	
										<div class="input-group form-group  pull-right col-md-3 col-lg-offset-6 has-success">
										<span class="input-group-addon"><i class="fa fa-calculator"></i></span>
										<input type="number" id="total" name="total" class="form-control" readonly placeholder="Total">
										<span class="input-group-addon">.00</span>
										</div>		
										-->							
									</div>
	 
									
									<!--Estimate Number-->
									<div class="form-group col-md-3">
										<label>Estimate Number</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-calculator"></i></span>
											<input type="text" class="form-control" maxlength="25" class="form-control"  id="ui_estimate_number" name="ui_estimate_number">
										</div>
									</div>
									<!--Estimate Number-->								
									
									<!-- E Sugam Number -->
									<div class="form-group col-md-3">
										<label>E-Sugam Number</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-etsy"></i></span>
											<input type="text" class="form-control" maxlength="25" class="form-control" id="ui_e_sugam_number" name="ui_e_sugam_number">
										</div>
									</div>
									<!-- E Sugam Number -->
									
									<!--Purchase Bill Number-->
									<div class="form-group col-md-3">
										<label>Purchase Bill Number</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-newspaper-o "></i></span>
											<input type="text" class="form-control" maxlength="25" class="form-control" id="ui_purchase_bill_number" name="ui_purchase_bill_number">
										</div>
									</div>
									<!--Purchase Bill Number-->
									
									<!--SS Invoice Number-->
									<div class="form-group col-md-3">
										<label>SS Invoice Number</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-trello"></i></span>
											<input type="text" class="form-control" maxlength="25" class="form-control" id="ui_ss_invoice_number" name="ui_ss_invoice_number">
										</div>
									</div>
									<!--SS Invoice Number-->		
	 
									<!--Transportation Type-->
									<div class="form-group col-md-3">
										<label>Transportation Type</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-truck"></i></span>
											<select name="ui_transport_type" id="ui_transport_type" class='form-control selectpicker' style='width: 100%;'>
											<option value="Carrier Auto">Carrier Auto</option>
											<option value="Passenger Auto">Passenger Auto</option>
											<option value="Heavy Carrier">Heavy Carrier</option>
											<option value="2 Wheeler">2 Wheeler</option>
											<option value="Transport By Vendor">Transport By Vendor</option>
											<option value="Picked By Customer">Picked By Customer</option>
											</select>
										</div>
									</div>
									<!--Transportation Type-->
									
									<!--Transportation Charge-->
									<div class="form-group col-md-3">
										<label>Transportation Charge</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-rupee"></i></span>
											<input type="text" class="form-control" maxlength="7" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="ui_transport_charge" name="ui_transport_charge">
										</div>
									</div>
									<!--Transportation Charge-->												
									
									<!--Delivery Date-->
									<div class="form-group col-md-3">
										<label>Delivery Date</label>
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar-check-o"></i>
											</div>
											<input type="text" readonly class="form-control pull-right" name="ui_delivery_date" value="<?php echo date("d/m/Y"); ?>" id="ui_delivery_date">
										</div>
									</div>
									<!--Delivery Date-->											

									<!--Delivery Remarks-->
									<div class="form-group col-md-6">
										<label>Delivery Remarks</label>
										<textarea class="form-control" rows="4" id="ui_delivery_remarks" name="ui_delivery_remarks"></textarea>
									</div>
									<!--Delivery Remarks-->
									
									<!--Order Remarks-->
									<div class="form-group col-md-6">
										<label>Order Remarks</label>
										<textarea class="form-control" rows="4" id="ui_order_remarks" name="ui_order_remarks"></textarea>
									</div>
									<!--Order Remarks-->
										
									<!-- User ID -->
										<input id="user_id" name="user_id" type="hidden" value="<?php echo $user_result['id'];?>" />
									<!-- User ID -->
									
									
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
										
										<!--Location-->
										<input id="location" name="location" type="hidden" value="<?php echo $user_result['location'];?>"/>
										<!--Location-->
								 <div class="col-lg-offset-10 col-lg-2">
									<button type="submit" class="btn-flat btn btn-success form-control">Create New Order</button>
								</div>										
									</div>
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
			
		<!-- Add Product Modal -->
		<div id="add_product_modal" class="modal fade" role="dialog">
		  <div class="modal-dialog modal-lg">
			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add New Product</h4>
			  </div>
			  <div class="modal-body">
				 <form role="form" id="contact" name="contact" method="post">
					 
					<!--Product Name-->
					<div class="form-group">
					<label>Product Set Name</label>
					<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-user"></i></span>
					<select name="ui_product_set_id" id="ui_product_set_id" class='form-control select2' required style='width: 100%;'>
					<option selected disabled hidden value="0">Select Product Set</option>
					<?php
					{
						$sql = "SELECT * FROM product_set ps, category c,sub_category sc where ps.category_id=c.category_id and ps.sub_category_id=sc.sub_category_id and ps.delete_status<>1";
						$query = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_array($query))
						{
						echo "<option value='" . $row['product_set_id'] . "'>" . $row['category_name']."-". $row['sub_category_name']."-". $row['product_set_product_name']. "</option>";
						}
					} 
					?>
					</select>
					</div>
					</div>
					<!--Product Name-->

					<!--Brand Name-->
					<div class="form-group">
					<label>Brand Name</label>
					<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-user"></i></span>
					<select name="ui_brand_id" id="ui_brand_id" class='form-control select2' required style='width: 100%;'>
					<option selected disabled hidden value="0">Select Brand</option>
					<?php
						{
						$sql = "SELECT * FROM brand where delete_status<>1";
						$query = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_array($query))
						{
							echo "<option value='" . $row['brand_id'] . "'>" . $row['brand_name']. "</option>";
						}
						} 
					?>
					</select>
					</div>
					</div>
					<!--Brand Name-->
					
					<!--Product Name-->
					<div class="form-group">
						<label>Product Name</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-cube"></i></span>
							<input type="text" class="form-control" placeholder="Product Name" id="ui_product_name" maxlength="100" name="ui_product_name"/>
						</div>
					</div>
					<!--Product Name-->
											
					<!--Product Description-->
					<div class="form-group">
					 <label>Product Description</label>
						<textarea class="form-control" id="ui_product_description" name="ui_product_description"></textarea>
					</div>
					<!--Product Description-->
					
					<!--Attributes-->
					<div class="form-group">
					<span id="ui_span"></span>
					</div>
					<!--Attributes-->					
				</form>
			  </div>
			  <div class="modal-footer">
				<button class="btn btn-success" type="button"  onclick="add_new_product();" id="submit">Save</button>
				<button id="submit" type="submit" id="close_category_modal" name="close_category_modal"class="btn btn-default pull-right" data-dismiss="modal">Close</button>
			  </div>
			</div>
		  </div>
		</div>
		<!-- Add Product Modal -->

		<!-- Add Project Modal -->
		<div id="add_project_modal" class="modal fade" role="dialog">
		  <div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add New Project</h4>
			  </div>
			  <div class="modal-body">
				 <form role="form" id="project" name="project" method="post">
					<!--Project Name-->
					<div class="form-group">
					 <label>Project Name</label>
						<input type="text" class="form-control" id="modal_project_name" name="modal_project_name" />
					</div>
					<!--Project Name-->
								
					<!--Save-->
					<div class="form-group">
						<button class="btn btn-success" type="button"  onclick="add_project_modal();" id="submit">Save</button>
					</div>
					<!--Save-->
				</form>
			  </div>
			  <div class="modal-footer">
							
				<button id="submit" type="submit" id="close_project_modal" name="close_project_modal"class="btn btn-default pull-right" data-dismiss="modal">Close</button>
			  </div>
			</div>

		  </div>
		</div>
		<!-- Add Project Modal -->

		<!-- Add Vendor Modal -->
		<div id="add_vendor_modal" class="modal fade" role="dialog">
		  <div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add New Vendor</h4>
			  </div>
			  <div class="modal-body">
				 <form role="form" id="contact" name="contact" method="post">
					<!--Vendor Name-->
					<div class="form-group">
					 <label>Vendor Name</label>
						<input type="text" class="form-control" id="modal_vendor_name" name="modal_vendor_name" style="text-transform:capitalize" maxlength="120"/>
					</div>
					<!--Vendor Name-->
								
					<!--Contact Person-->
					<div class="form-group">
					 <label>Contact Person</label>
						<input type="text" class="form-control" id="modal_vendor_contact_person" name="modal_vendor_contact_person" style="text-transform:capitalize" maxlength="120"/>
					</div>
					<!--Contact Person-->
					
					<!--Contact Number-->
					<div class="form-group">
					 <label>Contact Number</label>
						<input type="text" class="form-control" id="modal_contact_number" name="modal_contact_number" maxlength="50" onkeypress='return event.charCode>= 48 && event.charCode <= 57'/>
					</div>
					<!--Contact Number-->
					
					<!--Email-->
					<div class="form-group">
						<label>Email</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
							<input type="email" class="form-control" placeholder="Ex: abc@gmail.com" id="modal_vendor_email"  maxlength="100" name="modal_vendor_email" type="text"/>
						</div>
					</div>
					<!--Email-->
					
					<!--Vendor Address-->
					<div class="form-group">
					 <label>Vendor Address</label>
						<textarea class="form-control" id="modal_vendor_address" name="modal_vendor_address"></textarea>
					</div>
					<!--Vendor Address-->
					
					<!--Vendor City-->
					<div class="form-group col-md-12">
						<label>Vendor City</label>
						<div class="radio">
							<label>
							<input type="radio" name="vendor_city" id="vendor_city" value="Bangalore" checked/>
							Bangalore
							</label>
						</div>
						<div class="radio">
							<label>
							<input type="radio" name="vendor_city" id="vendor_city" value="Delhi"/>
							Delhi
							</label>
						</div>
						<div class="radio">
							<label>
							<input type="radio" name="vendor_city" id="vendor_city" value="Other"/>
							Other
							</label>
						</div>
					</div>
					<!--Vendor City-->
					
					<!--Save-->
					<div class="form-group">
						<button class="btn btn-success" type="button"  onclick="add_vendor_modal();" id="submit">Save</button>
					</div>
					<!--Save-->
				</form>
			  </div>
			  <div class="modal-footer">
							
				<button id="submit" type="submit" id="close_vendor_modal" name="close_vendor_modal"class="btn btn-default pull-right" data-dismiss="modal">Close</button>
			  </div>
			</div>

		  </div>
		</div>
		<!-- Add Vendor Modal -->


		
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
								<input type="text" class="form-control" id="modal_product_name" name="modal_product_name" autocomplete="off" style="text-transform:capitalize" onkeyup="autocomplet()"/>
							</div>
							<!--Product Name-->
						</div> 
					
			
					
					
					<ul name="products_list" id="products_list"></ul>
					
					<!--Description-->
					<div class="col-md-12">
					<div class="form-group">
					 <label>Description</label>
						<textarea class="form-control" id="modal_product_description" name="modal_product_description"></textarea>
					</div>
					</div>
					<!--Description-->
					
					<!--Product ID-->

						<input type="hidden" id="modal_product_id" name="modal_product_id"/>

					<!--Product ID-->
					
					
					<!--Previous Buy-->
					<div class="col-md-6">
					<div class="form-group">
					 <label>Previous Buy</label>
						<input type="text" class="form-control" id="modal_previous_buy" name="modal_previous_buy" readonly/>
					</div>
					</div>
					<!--Previous Buy-->
					
					
					<!--Previous Sell-->
					<div class="col-md-6">
					<div class="form-group">
					 <label>Previous Sell</label>
						<input type="text" class="form-control" id="modal_previous_sell" name="modal_previous_sell" readonly/>
					</div>
					</div>
					<!--Previous Sell-->
					
					
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
						 <label>Buying Price [MRP]</label>
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
						 <label>Discounted Price [BP]</label>
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
					<div class="col-md-6">
					<div class="form-group">
					 <label>Selling Percent</label>
						<input type="text" class="form-control" id="modal_product_selling_percent"  oninput="product_price_function('D');" onchange="handleChange(this);"  name="modal_product_selling_percent" maxlength="7" onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46'/>
					</div>
					</div>
					<!--Selling Percent-->	

					<!--Selling Price-->
					<div class="col-md-6">
					<div class="form-group">
					 <label>Selling Price</label>
						<input type="text" class="form-control" id="modal_product_selling_price" name="modal_product_selling_price" oninput="product_price_function('P');" maxlength="10" onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46'/>
					</div>
					</div>
					<!--Selling Price-->	
					
					<div class="col-md-4">
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
					<div class="col-md-4">
					<div class="form-group">
					<label>Tax Inclusive </label> 
						<input type="checkbox" class="checkbox" name="modal_tax_inclusive" onclick="product_price_function();" id="modal_tax_inclusive"/>
					</div>	
					</div>					
					<!--Tax Inclusive-->
					
					<!--Total-->
					<div class="col-md-4">
						<div class="form-group">
						 <label>Total</label>
							<input type="text" class="form-control" readonly id="modal_product_total" name="modal_product_total" maxlength="50" onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46'/>
						</div>
					</div>
					<!--Total-->					
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

		<script type="text/javascript">
		$("#save_line_item_submit").click(function() {

			var draft_id= $("#draft_id").val();				
			var product_id=$("#modal_product_id").val();
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
				url: "../php/add_modal/add_order_php.php",
				type: "POST", // you can use GET
				data: {draft_id: draft_id, product_id:product_id ,product_name: product_name, product_description: product_description, product_quantity:product_quantity,product_buying_price:product_buying_price,product_discount_price:product_discount_price,discounted_price:discounted_price,total_of_buying:total_of_buying,product_selling_percent:product_selling_percent,product_selling_price:product_selling_price,product_tax:product_tax,product_tax_inclusive:product_tax_inclusive,product_total:product_total,user_id:user_id,location:location}, // post data
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
					fetchfromMysqlDatabase(draft_id);
				}
			});
		});
		</script>
				
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
						<input type="text" class="form-control" id="modal_customer_name" name="modal_customer_name" style="text-transform:capitalize" maxlength="100"/>
					</div>
					<!--Customer Name-->
								
					<!--Contact Person-->
					<div class="form-group">
					 <label>Contact Person</label>
						<input type="text" class="form-control" id="modal_customer_contact_person" name="modal_customer_contact_person" style="text-transform:capitalize" maxlength="120"/>
					</div>
					<!--Contact Person-->
					
					<!--Contact Number-->
					<div class="form-group">
					 <label>Contact Number</label>
						<input type="text" class="form-control" id="modal_customer_contact_number" name="modal_customer_contact_number"  maxlength="50" onkeypress='return event.charCode>= 48 && event.charCode <= 57'/>
					</div>
					<!--Contact Number-->
					
					<!--Email-->
					<div class="form-group">
						<label>Email</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
							<input type="email" class="form-control" placeholder="Ex: abc@gmail.com" id="modal_customer_email"  maxlength="100" name="modal_customer_email" type="text"/>
						</div>
					</div>
					<!--Email-->
					
					<!--Customer Address-->
					<div class="form-group">
					 <label>Customer Address</label>
						<textarea class="form-control" id="modal_customer_address" name="modal_customer_address"></textarea>
					</div>
					<!--Customer Address-->
					
					<input id="modal_cust_location" name="modal_cust_location" type="hidden" value="<?php echo $user_result['location'];?>" />
					
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

		
		<script>
		function add_project_modal()
		{
			var customer_id= $("#ui_customer_name").val();
			var project_name= $("#modal_project_name").val();
			var user_id= $("#user_id").val();
			var location= $("#location").val();	
			$.ajax(
			{
				url: "../php/add_modal/add_project_php.php",
				type: "POST", // you can use GET
				data: {customer_id:customer_id , project_name: project_name, user_id: user_id, location: location}, // post data
				success: function(data)   // A function to be called if request succeeds
				{
					$("#add_project_modal .close").click()
					$('#modal_project_name').val("");
					$("#ui_customer_name").trigger("change");
				}
			});
		}
		</script>

		<script>
		function add_customer_modal()
		{
			var customer_name= $("#modal_customer_name").val(); 
			var customer_contact_person= $("#modal_customer_contact_person").val();
			var customer_cnt_no= $("#modal_customer_contact_number").val();
			var customer_email= $("#modal_customer_email").val();
			var customer_address= $("#modal_customer_address").val();
			var user_id= $("#user_id").val();
			var customer_location= $("#modal_cust_location").val();
			$.ajax(
			{
				url: "../php/add_modal/add_customer_php.php",
				type: "POST", // you can use GET
				data: {customer_name: customer_name, customer_contact_person: customer_contact_person, customer_cnt_no:customer_cnt_no,customer_email:customer_email,customer_address:customer_address,user_id:user_id,location:customer_location}, // post data
				success: function(data)   // A function to be called if request succeeds
				{
					$("#add_customer_modal .close").click()
					$('#modal_customer_name').val("");
					$('#modal_customer_contact_person').val("");
					$('#modal_customer_contact_number').val("");
					$('#modal_customer_email').val("");
					$('#modal_customer_address').val("");
					fn_fetch_customers(data);	
					$("#ui_customer_name").trigger("change");			
				}
			});
		}
		</script>

		<script>
		function add_vendor_modal()
		{
			var vendor_name= $("#modal_vendor_name").val(); 
			var vendor_contact_person= $("#modal_vendor_contact_person").val();
			var vendor_cnt_no= $("#modal_contact_number").val();
			var vendor_email= $("#modal_vendor_email").val();
			var vendor_address= $("#modal_vendor_address").val();
			var vendor_city= $("#vendor_city").val();
			var user_id= $("#user_id").val();
			var location= $("#location").val();
			$.ajax(
			{
				url: "../php/add_modal/add_vendor_php.php",
				type: "POST", // you can use GET
				data: {vendor_name: vendor_name, contact_person: vendor_contact_person, contact_number:vendor_cnt_no,vendor_email:vendor_email,vendor_city:vendor_city,vendor_address:vendor_address,user_id:user_id,location:location}, // post data
				success: function(data)   // A function to be called if request succeeds
				{
					$("#add_vendor_modal .close").click()
					$('#modal_vendor_name').val("");
					$('#modal_vendor_contact_person').val("");
					
					fn_fetch_vendor(data);
				}
			});
		}
		</script>


		<script>
		function add_new_product()
		{
			var product_set_id= $("#ui_product_set_id").val(); 
			var brand_id= $("#ui_brand_id").val();
			var product_name= $("#ui_product_name").val();
			var product_desc= $("#ui_product_description").val();
			var user_id= $("#user_id").val();
			var location= $("#location").val();
			var att= $(".att_name_order").val();  
			var i=0;
			var k=0;
			var dataarray_attribute_name = [];
			jQuery(".att_name_order").each(function(i, obj) //Attribute Name accessed by class name as it is unable to access using name
			{
				dataarray_attribute_name[k] = $(this).val();
				i= i + 1;
				k=k+1;
			});


			var l=0;
			var dataarray_attribute_id = [];
			jQuery(".att_id_order").each(function(i, obj) //Attribute Name accessed by class name as it is unable to access using name
			{
				dataarray_attribute_id[l] = $(this).val();// obj.val();
				i= i + 1;
				l=l+1;
			});

			var m=0;
			var dataarray_attribute_value = [];
			jQuery(".att_id_values").each(function(i, obj) //Attribute Name accessed by class name as it is unable to access using name
			{
				dataarray_attribute_value[m] = $(this).val();// obj.val();
				i= i + 1;
				m=m+1;
			});

			$.ajax(
			{
				url: "../php/add_modal/add_product.php",
				type: "POST", // you can use GET
				data: {ui_product_set_id: product_set_id, ui_brand_id: brand_id, ui_product_name: product_name, ui_product_description: product_desc,attribute_name_input: dataarray_attribute_name, attribute_id: dataarray_attribute_id, attribute_values: dataarray_attribute_value,user_id:user_id,location:location}, // post data
				success: function(data)   // A function to be called if request succeeds
				{
					$("#add_product_modal .close").click()
					$("#ui_product_set_id").prop("selectedIndex", 0);
					$('#ui_product_set_id').trigger('change');
					$("#ui_brand_id").prop("selectedIndex", 0);
					$('#ui_brand_id').trigger('change');
					$('#ui_product_name').val("");
					$('#ui_product_description').val("");
				}
			});
		}
		</script>

		<!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";?>
		<!--Including Bootstrap and other scripts-->
		
		<script>
		$(function () 
		{
			//Date picker
			$('#ui_order_date').datepicker({
			format: 'dd/mm/yyyy',
			autoclose: true
			});
		});

		$(function () 
		{
			//Date picker
			$('#ui_delivery_date').datepicker({
			format: 'dd/mm/yyyy',
			autoclose: true
			});
		});

		function handleChange(input) 
		{
			if (input.value < 0) input.value = 0;
			//if (input.value > 100) input.value = 100;
		}  
		
		function fn_fetch_customers(customer_id)
		{	
			$.ajax(
			{
				type:'POST',
				url: '../php/get_all_customer.php',
				data: {customer_id:customer_id},
				success:function(data)
				{
					$('#ui_customer_span').html(data);
					$("#ui_customer_name").select2();
					fn_fetch_project();					
				}
			});		
		};
		
		
		function fn_fetch_vendor(vendor_id)
		{	
			$.ajax(
			{
				type:'POST',
				url: '../php/get_all_vendor.php',
				data: {vendor_id:vendor_id},
				success:function(data)
				{
					$('#ui_vendor_span').html(data);
					$("#ui_vendor_name").select2();
									
				}
			});		
		};
		
		
		
		function fetchfromMysqlDatabase(draft_id)
{
$.ajax({
	type: "POST",
	dataType: "html",
	url: "../php/get_order_products.php",
	data: {draft_id:draft_id},
	cache: false,
	beforeSend: function() 
	{
	$('#res3').html('loading please wait...');
	},
	success: function(htmldata) 
	{
	$('#res3').html(htmldata);
	}
});
}
</script>
		
		

			<div class="modal fade" id="myModal" role="dialog">
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
			
			
			
			<script>
function delete_record(e) 
{
     var txt;
    var r = confirm("Confirm Delete");
    if (r == true) {
		//$('#myModal').on('show.bs.modal', function (e) {
       var rowid = e;
					$.ajax({
						type : 'post',
						url : 'delete_record.php', //Here you will fetch records 
						data :  'rowid='+ rowid, //Pass $id
						success : function(data)
						{
							fetchMysqlDatabase(data);
						}
					});
	//	});
    }
	else {
       
    }
  
	
					
					
}
</script>



			<div class="modal fade" id="delete_modal" role="dialog">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Confirm Delete</h4>
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
		$("#save_edit_line_item_submit").click(function() {			
			var order_product_id= $("#edit_draft_id").val();				
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
				url: "../php/add_modal/update_order_php.php",
				type: "POST", // you can use GET
				data: {order_product_id: order_product_id, product_name: product_name, product_description: product_description, product_quantity: product_quantity,product_buying_price: product_buying_price, product_discount_price: product_discount_price, discounted_price: discounted_price, total_of_buying: total_of_buying,product_selling_percent: product_selling_percent, product_selling_price: product_selling_price, product_tax: product_tax, product_tax_inclusive: product_tax_inclusive, product_total: product_total, user_id: user_id,location: location}, // post data
				success: function(data)   // A function to be called if request succeeds
				{					
					$("#myModal .close").click()
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
					fetchMysqlDatabase(data);
				}
			});
		});
		
		
function fetchMysqlDatabase(draft_id)
{
$.ajax({
	type: "POST",
	dataType: "html",
	url: "../php/get_order_products.php",
	data: {draft_id:draft_id},
	cache: false,
	beforeSend: function() 
	{
	$('#res3').html('loading please wait...');
	},
	success: function(htmldata) 
	{
	$('#res3').html(htmldata);
	}
});
}
		</script>
		


	</body>
</html>