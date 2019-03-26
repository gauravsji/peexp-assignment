<!DOCTYPE html>
<html>
<!--Including Login Session-->
<?php include "../extra/session.php";
$ss_order_id=$_GET["id"];
$sql1 = "SELECT * FROM ss_order ss, order_account oa, order_transport ot, vendor v, customer c, project p where p.customer_id=ss.customer_id and p.project_id=ss.project_id and ss.customer_id=c.customer_id and ss.order_id=oa.order_id and ss.order_id=ot.order_id and ss.vendor_id=v.vendor_id and ss.order_id = " . $ss_order_id;
$result1 = mysqli_query($conn, $sql1);
$order_result = mysqli_fetch_array($result1,MYSQLI_ASSOC);

$sql2 = "SELECT * FROM order_account where  delete_status<>1 and order_id = " . $_GET["id"];
$result2 = mysqli_query($conn, $sql2);
$order_account_result = mysqli_fetch_array($result2,MYSQLI_ASSOC);

$sql3 = "SELECT * FROM order_transport where  delete_status<>1 and order_id = " . $_GET["id"];
$result3 = mysqli_query($conn, $sql3);
$order_transport_result = mysqli_fetch_array($result3,MYSQLI_ASSOC);

$sql4 = "SELECT * FROM order_product where delete_status<>1 and order_id = " . $_GET["id"];
$result4 = mysqli_query($conn, $sql4);


$sql_email_settings = "SELECT * FROM email_settings where email_module='PURCHASE ORDER'";
		$result_email_settings = mysqli_query($conn, $sql_email_settings);
		$email_settings_result = mysqli_fetch_array($result_email_settings,MYSQLI_ASSOC);
$user_created = "";
?>

<head>
    <!--Including Bootstrap CSS links-->
    <?php include "../extra/header.html";?>
    <!--Including Bootstrap CSS links-->
	
				
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

		fetchMysqlDatabase(<?php echo $ss_order_id ?>)
		// Handler for .ready() called.
		$("#li_order").addClass("active");
		$("#li_new_order").addClass("active");

		$('#ui_customer_name').on('change',function()
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
		});

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
                <h1>
					Edit Order: <?php echo $ss_order_id; ?>  <div class="btn-toolbar pull-right">
					<a href="../html/view_order_html.php?id=<?php echo $ss_order_id;?>" class="btn btn-sm btn-primary">View Order</a>  
					<a href="../html/add_order_html.php" class="btn btn-sm btn-primary">New Order</a>  
					<a href="../reports/order_report_html.php" class="btn btn-sm btn-success">Order Report</a>
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
                            <div class="box-header with-border">
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <form name="add_order_form" id="add_order_form" enctype="multipart/form-data" action="../php/update/update_order_php.php" method="post">
								
								<!--Order ID-->
								<input name="ui_ss_order_id" id="ui_ss_order_id" type="hidden" value="<?php echo $ss_order_id;?>">
								<!--Order ID-->
								
								<!--Date-->
								<div class="form-group col-md-3">
									<label>Order Date</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input type="text" readonly class="form-control pull-right" name="ui_order_date" id="ui_order_date" value="<?php echo date('d/m/Y', strtotime($order_result['order_date']));  ?>">
									</div>
								</div>
								<!--Date-->
								
								<!--Vendor Name-->
								<div class="form-group col-md-3">
									<label>Vendor Name</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user"></i></span>
										<select name="ui_vendor_name" id="ui_vendor_name" class='form-control select2' style='width: 100%;'>
										<option selected disabled hidden>Select Vendor</option>
										<?php
										{
											$sql = "SELECT * from vendor where delete_status<>1";
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query))
											{
												if ($row['vendor_id'] == $order_result['vendor_id']):
												{
												echo "<option value='" . $row['vendor_id'] . "' selected>" . $row['vendor_name']. "</option>";
												}
												else:
												{
													echo "<option value='" . $row['vendor_id'] . "'>" . $row['vendor_name']. "</option>";
												}
												endif;
											}
										} 
										?>
										</select>
									</div>
								</div>
								<!--Vendor Name-->
								
								<!--Customer Name-->
								<div class="form-group col-md-3">
									<label>Customer Name</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user"></i></span>
										<select name="ui_customer_name" id="ui_customer_name" class='form-control select2' style='width: 100%;'>
										<option selected disabled hidden>Select Customer</option>
										<?php
										{
											$sql = "SELECT * from customer where delete_status<>1";
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query))
											{
												if ($row['customer_id'] == $order_result['customer_id']):
												{
												echo "<option value='" . $row['customer_id'] . "' selected>" . $row['customer_name']. "</option>";
												}
												else:
												{
													echo "<option value='" . $row['customer_id'] . "'>" . $row['customer_name']. "</option>";
												}
												endif;
												
												
											//echo "<option value='" . $row['customer_id'] . "'>" . $row['customer_name']. "</option>";
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
										<span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
										<select name="ui_project_name" id="ui_project_name" class='form-control select2' style='width: 100%;'>
										<option selected disabled hidden>Select Project</option>
										<?php
										{
											$sql = "SELECT * from project where delete_status<>1 and customer_id = ".$order_result['customer_id'];
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query))
											{
												if ($row['project_id'] == $order_result['project_id']):
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
								
								<!--Order Placed By-->
								<div class="form-group col-md-3">
									<label>Order Placed By</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-male"></i></span>
										<input type="text" class="form-control" maxlength="25" class="form-control" id="ui_order_placed_by" name="ui_order_placed_by" value="<?php echo $order_result['order_placed_by'] ?>">
									</div>
								</div>
								<!--Order Placed By-->

								<!--Confirmation Type-->
								<div class="form-group col-md-3">
									<label>Confirmation Type</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-check"></i></span>
										<select name="ui_confirmation_type" id="ui_confirmation_type" class='form-control selectpicker' style='width: 100%;'>
										<?php
										{
											$sql = "SELECT * from ss_order where delete_status<>1";
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query))
											{
												if ($row['order_id'] == $order_result['order_id']):
												{
													$value_exists = 0;
													if ($order_result['order_confirmation_type']=='Whatsapp')
													{
														$value_exists = 1;
														echo '<option value="Whatsapp" selected>Whatsapp</option>';
														echo '<option value="Email">Email</option>';
														echo '<option value="SMS">SMS</option>';
														echo '<option value="Call">Call</option>';
													}
													else if ($order_result['order_confirmation_type']=='Email')
													{	
														$value_exists = 1;
														echo '<option value="Whatsapp" >Whatsapp</option>';
														echo '<option value="Email" selected>Email</option>';
														echo '<option value="SMS">SMS</option>';
														echo '<option value="Call">Call</option>';
													}	
													else if ($order_result['order_confirmation_type']=='SMS')
													{
														$value_exists = 1;
														echo '<option value="Whatsapp" >Whatsapp</option>';
														echo '<option value="Email" >Email</option>';
														echo '<option value="SMS" selected>SMS</option>';
														echo '<option value="Call">Call</option>';
													}
													else if ($order_result['order_confirmation_type']=='Call')
													{
														$value_exists = 1;
														echo '<option value="Whatsapp" >Whatsapp</option>';
														echo '<option value="Email" >Email</option>';
														echo '<option value="SMS" >SMS</option>';
														echo '<option value="Call" selected>Call</option>';
													}	
													else
													{
														echo "Error";
													}
												}
													else:
													{
														echo "Error";
													}
												endif;
											}
										} 
										if ($value_exists == 0)
										{
														echo '<option value="Whatsapp" >Whatsapp</option>';
														echo '<option value="Email" >Email</option>';
														echo '<option value="SMS" >SMS</option>';
														echo '<option value="Call" selected>Call</option>';
										}
										$value_exists = 0;
										?>
										</select>
									</div>
								</div>
								<!--Confirmation Type-->
								
								<!--Assignee Name-->
								<div class="form-group col-md-3">
									<label>Sales Assignee</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
										<select name="ui_assignee_name" id="ui_assignee_name" class='form-control select2' style='width: 100%;'>
											<option selected disabled hidden>Select Sales Assignee</option>
											<?php
										{
											$sql = "SELECT id, name from users where authenticate<>0  order by name";
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query))
											{
												if ($row['id'] == $order_result['order_assignee']):
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
								<div class="form-group col-md-3">
									<label>Order Status</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-line-chart"></i></span>
										<select name="ui_order_status" id="ui_order_status" class='form-control selectpicker' style='width: 100%;'>
										
										<?php
										{
											$sql = "SELECT * from ss_order where delete_status<>1";
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query))
											{
												if ($row['order_id'] == $order_result['order_id']):
												{
													$value_exists = 0;
													if ($order_result['order_status']=='Order Created')
													{
														$value_exists = 1;
														echo '<option value="Order Created" selected>Order Created</option>';
														echo '<option value="Order Placed">Order Placed</option>';
														echo '<option value="Material Ready To Dispatch">Material Ready To Dispatch</option>';
														echo '<option value="Material Delivered">Material Delivered</option>';
														echo '<option value="Order Partially Delivered">Order Partially Delivered</option>';
														echo '<option value="Order Fulfilled">Order Fulfilled</option>';
														echo '<option value="Order Cancelled" >Order Cancelled</option>';
														
													}
													else if ($order_result['order_status']=='Order Placed')
													{
														$value_exists = 1;
														echo '<option value="Order Created" selected>Order Created</option>';
														echo '<option value="Order Placed" selected>Order Placed</option>';
														echo '<option value="Material Ready To Dispatch">Material Ready To Dispatch</option>';
														echo '<option value="Material Delivered">Material Delivered</option>';
														echo '<option value="Order Partially Delivered">Order Partially Delivered</option>';
														echo '<option value="Order Fulfilled">Order Fulfilled</option>';
														echo '<option value="Order Cancelled" >Order Cancelled</option>';
													}	
													else if ($order_result['order_status']=='Material Ready To Dispatch')
													{
														$value_exists = 1;
														echo '<option value="Order Created" >Order Created</option>';
														echo '<option value="Order Placed">Order Placed</option>';
														echo '<option value="Material Ready To Dispatch" selected>Material Ready To Dispatch</option>';
														echo '<option value="Material Delivered">Material Delivered</option>';
														echo '<option value="Order Partially Delivered">Order Partially Delivered</option>';
														echo '<option value="Order Fulfilled">Order Fulfilled</option>';
														echo '<option value="Order Cancelled" >Order Cancelled</option>';
													}	
													else if ($order_result['order_status']=='Material Delivered')
													{
														$value_exists = 1;
														echo '<option value="Order Created" >Order Created</option>';
														echo '<option value="Order Placed">Order Placed</option>';
														echo '<option value="Material Ready To Dispatch">Material Ready To Dispatch</option>';
														echo '<option value="Material Delivered" selected>Material Delivered</option>';
														echo '<option value="Order Partially Delivered" >Order Partially Delivered</option>';
														echo '<option value="Order Fulfilled">Order Fulfilled</option>';
														echo '<option value="Order Cancelled" >Order Cancelled</option>';
													}
													else if ($order_result['order_status']=='Order Partially Delivered')
													{
														$value_exists = 1;
														echo '<option value="Order Created" >Order Created</option>';
														echo '<option value="Order Placed">Order Placed</option>';
														echo '<option value="Material Ready To Dispatch">Material Ready To Dispatch</option>';
														echo '<option value="Material Delivered">Material Delivered</option>';
														echo '<option value="Order Partially Delivered" selected>Order Partially Delivered</option>';
														echo '<option value="Order Fulfilled">Order Fulfilled</option>';
														echo '<option value="Order Cancelled" >Order Cancelled</option>';
													}													
													else if ($order_result['order_status']=='Order Fulfilled')
													{
														$value_exists = 1;
														echo '<option value="Order Created" >Order Created</option>';
														echo '<option value="Order Placed">Order Placed</option>';
														echo '<option value="Material Ready To Dispatch" >Material Ready To Dispatch</option>';
														echo '<option value="Material Delivered">Material Delivered</option>';
														echo '<option value="Order Partially Delivered">Order Partially Delivered</option>';
														echo '<option value="Order Fulfilled" selected>Order Fulfilled</option>';
														echo '<option value="Order Cancelled" >Order Cancelled</option>';
													}
													else if ($order_result['order_status']=='Order Cancelled')
													{
														$value_exists = 1;
														echo '<option value="Order Created" >Order Created</option>';
														echo '<option value="Order Placed">Order Placed</option>';
														echo '<option value="Material Ready To Dispatch" >Material Ready To Dispatch</option>';
														echo '<option value="Material Delivered">Material Delivered</option>';
														echo '<option value="Order Partially Delivered">Order Partially Delivered</option>';
														echo '<option value="Order Fulfilled" >Order Fulfilled</option>';
														echo '<option value="Order Cancelled" selected>Order Cancelled</option>';
													}
													else
													{
														echo "Error";
													}
												}
													else:
													{
														echo "Error";
													}
													
												endif;
											}
										} 
										
										if ($value_exists == 0)
										{
														echo '<option value="Order Created" selected>Order Created</option>';
														echo '<option value="Order Placed">Order Placed</option>';
														echo '<option value="Material Ready To Dispatch" >Material Ready To Dispatch</option>';
														echo '<option value="Material Delivered">Material Delivered</option>';
														echo '<option value="Order Partially Delivered">Order Partially Delivered</option>';
														echo '<option value="Order Fulfilled" >Order Fulfilled</option>';
														echo '<option value="Order Cancelled" >Order Cancelled</option>';
										}
										$value_exists = 0;
										?>
										
										</select>
									</div>
								</div>
								<!--Order Status-->		
								
								<!--Vendor Assignee Name-->
								<div class="form-group col-md-3">
									<label>Vendor Assignee</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
										<select name="ui_vendor_assignee_name" id="ui_vendor_assignee_name" class='form-control select2' style='width: 100%;'>
											<option selected disabled hidden>Select Vendor Assignee</option>
											<?php
										{
											$sql = "SELECT id, name from users where authenticate<>0  order by name";
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query))
											{
												if ($row['id'] == $order_result['vendor_assignee']):
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
								<!--Vendor Assignee Name-->

								<!--Transport Assignee Name-->
								<div class="form-group col-md-3">
									<label>Transport Assignee</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
										<select name="ui_transport_assignee_name" id="ui_transport_assignee_name" class='form-control select2' style='width: 100%;'>
											<option selected disabled hidden>Select Transport Assignee</option>
											<?php
										{
											$sql = "SELECT id, name from users where authenticate<>0  order by name";
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query))
											{
												if ($row['id'] == $order_result['operations_assignee']):
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
								<!--Transport Name-->
								
								<!--Related Orders-->
								<div class="form-group col-md-6">
									<label>Related Orders</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-male"></i></span>
										<input type="text" class="form-control" maxlength="25" class="form-control" id="ui_related_orders" name="ui_related_orders" value="<?php echo $order_result['related_orders'] ?>">
									</div>
								</div>  
								<!--Related Orders-->
								
					
								<!--Brief Order Detail-->
									<div class="form-group col-md-6">
										<label>Brief Order Detail</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-commenting"></i></span>
											<input type="text" class="form-control" class="form-control" id="ui_brief_order_details" name="ui_brief_order_details" value="<?php echo $order_result['order_brief_details'] ?>">
										</div>
									</div>
									<!--Brief Order Detail-->
									
										<!--Delivery Location-->
									<div class="form-group col-md-3">
										<label>Delivery Location</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-thumb-tack"></i></span>
											<select name="ui_delivery_location" id="ui_delivery_location" class='form-control selectpicker' style='width: 100%;'>
											<?php
										{
											$sql = "SELECT * from order_transport where delete_status<>1";
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query))
											{
												if ($row['order_id'] == $order_transport_result['order_id']):
												{
													if ($order_transport_result['order_delivery_location']=='Within State'):
													{
														echo '<option value="Within State" selected>Within State</option>';
														echo '<option value="Outside State">Outside State</option>';
														
													}
													endif;
													if ($order_transport_result['order_delivery_location']=='Outside State'):
													{
														echo '<option value="Within State" >Within State</option>';
														echo '<option value="Outside State" selected>Outside State</option>';
													}															
													else:
													{
														echo "Error";
													}
													endif;
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
									<!--Delivery Location-->
								
									<!--With Bill-->
									<div class="form-group col-md-3">
										<label>With Bill</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-file-text"></i></span>
											<select name="ui_with_bill" id="ui_with_bill" class='form-control selectpicker' style='width: 100%;'>
											<?php
										{
											$sql = "SELECT order_id,order_with_bill from ss_order where delete_status<>1";
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query))
											{
												if ($row['order_id'] == $order_result['order_id'])
												{
													if ($order_result['order_with_bill']=='With Bill')
													{
														echo '<option value="With Bill" selected>With Bill</option>';
														echo '<option value="Without Bill">Without Bill</option>';
														
													}
													else if ($order_result['order_with_bill']=='Without Bill')
													{
														echo '<option value="With Bill">With Bill</option>';
														echo '<option value="Without Bill" selected>Without Bill</option>';
													}															
													else
													{
														echo '<option value="With Bill" selected>With Bill</option>';
														echo '<option value="Without Bill">Without Bill</option>';
													}
												}
													else
													{
														echo "Error";
													}
											}
										} 
										?>																
											</select>
										</div>
									</div>
									<!--With Bill-->	
									
									
									<div class="form-group col-md-12">
									<div class="table-responsive">
										<div id="res3"></div>
									</div>
									</div>
								
								
								<div class="form-group col-md-12">
									<input type="button" class="btn btn-primary btn-flat" value="New Product" style="cursor: pointer;" data-toggle="modal" data-target="#add_product_modal"></input>					

									<input type="button" class="btn btn-success btn-flat" value="New items" style="cursor: pointer;" data-toggle="modal" data-target="#add_line_item_modal"></input>									
									
									<!--<div class="input-group form-group  pull-right col-md-3 col-lg-offset-6 has-success">
											<span class="input-group-addon"><i class="fa fa-calculator"></i></span>
											<input type="number" id="total" name="total" class="form-control" readonly placeholder="Total">
											<span class="input-group-addon">.00</span>
										</div>-->
								</div>
 
 
 								<!--Estimate Number-->
								<div class="form-group col-md-3">
									<label><a background-color="cyan" href="../html/view_enquiry_html.php?id=<?php echo $order_account_result['order_estimate_number']; ?>">Estimate Number</a></label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-calculator"></i></span>
										<input type="text" class="form-control" maxlength="25" class="form-control"  id="ui_estimate_number" name="ui_estimate_number" value="<?php echo $order_account_result['order_estimate_number'] ?>">
									</div>
								</div>
								<!--Estimate Number-->
								
								
								<!-- E-Sugam Number -->
								<div class="form-group col-md-3">
									<label>E-Sugam Number</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-etsy"></i></span>
										<input type="text" class="form-control" maxlength="25" class="form-control" id="ui_e_sugam_number" name="ui_e_sugam_number" value="<?php echo $order_account_result['order_e_sugam_number'] ?>">
									</div>
								</div>
								<!-- E-Sugam Number -->
								
								<!--Purchase Bill Number-->
								<div class="form-group col-md-3">
									<label>Purchase Bill Number</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-newspaper-o "></i></span>
										<input type="text" class="form-control" maxlength="25" class="form-control" id="ui_purchase_bill_number" name="ui_purchase_bill_number" value="<?php echo $order_account_result['order_purchase_bill_number'] ?>">
									</div>
								</div>
								<!--Purchase Bill Number-->
								
								<!--SS Invoice Number-->
								<div class="form-group col-md-3">
									<label>SS Invoice Number</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-trello"></i></span>
										<input type="text" class="form-control" maxlength="25" class="form-control" id="ui_ss_invoice_number" name="ui_ss_invoice_number" value="<?php echo $order_account_result['order_ss_invoice_number'] ?>">
									</div>
								</div>
								<!--SS Invoice Number-->
	
 
 								<!--Transportation Type-->
								<div class="form-group col-md-3">
									<label>Transportation Type</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-truck"></i></span>
										<select name="ui_transport_type" id="ui_transport_type" class='form-control selectpicker' style='width: 100%;'>
										<?php
										{
											$sql = "SELECT * from order_transport where delete_status<>1";
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query))
											{
												if ($row['order_id'] == $order_transport_result['order_id']):
												{
													if ($order_transport_result['order_transportation_type']=='Carrier Auto'):
													{
														echo '<option value="Carrier Auto" selected>Carrier Auto</option>';
														echo '<option value="Passenger Auto" >Passenger Auto</option>';
														echo '<option value="Heavy Carrier">Heavy Carrier</option>';
														echo '<option value="2 Wheeler">2 Wheeler</option>';
														echo '<option value="Transport By Vendor">Transport By Vendor</option>';
														echo '<option value="Picked By Customer">Picked By Customer</option>';
													}
													endif;
													if ($order_transport_result['order_transportation_type']=='Passenger Auto'):
													{
														echo '<option value="Carrier Auto" >Carrier Auto</option>';
														echo '<option value="Passenger Auto" selected>Passenger Auto</option>';
														echo '<option value="Heavy Carrier">Heavy Carrier</option>';
														echo '<option value="2 Wheeler">2 Wheeler</option>';
														echo '<option value="Transport By Vendor">Transport By Vendor</option>';
														echo '<option value="Picked By Customer">Picked By Customer</option>';
													}	
													endif;
													if ($order_transport_result['order_transportation_type']=='Heavy Carrier'):
													{
														echo '<option value="Carrier Auto" >Carrier Auto</option>';
														echo '<option value="Passenger Auto" >Passenger Auto</option>';
														echo '<option value="Heavy Carrier" selected>Heavy Carrier</option>';
														echo '<option value="2 Wheeler">2 Wheeler</option>';
														echo '<option value="Transport By Vendor">Transport By Vendor</option>';
														echo '<option value="Picked By Customer">Picked By Customer</option>';
													}	
													endif;
													if ($order_transport_result['order_transportation_type']=='2 Wheeler'):
													{
														echo '<option value="Carrier Auto" >Carrier Auto</option>';
														echo '<option value="Passenger Auto" >Passenger Auto</option>';
														echo '<option value="Heavy Carrier" >Heavy Carrier</option>';
														echo '<option value="2 Wheeler" selected>2 Wheeler</option>';
														echo '<option value="Transport By Vendor">Transport By Vendor</option>';
														echo '<option value="Picked By Customer">Picked By Customer</option>';
													}
													endif;
													if ($order_transport_result['order_transportation_type']=='Transport By Vendor'):
													{
														echo '<option value="Carrier Auto" >Carrier Auto</option>';
														echo '<option value="Passenger Auto" >Passenger Auto</option>';
														echo '<option value="Heavy Carrier" >Heavy Carrier</option>';
														echo '<option value="2 Wheeler" >2 Wheeler</option>';
														echo '<option value="Transport By Vendor" selected>Transport By Vendor</option>';
														echo '<option value="Picked By Customer">Picked By Customer</option>';
													}
													endif;
													if ($order_transport_result['order_transportation_type']=='Picked By Customer'):
													{
														echo '<option value="Carrier Auto" >Carrier Auto</option>';
														echo '<option value="Passenger Auto" >Passenger Auto</option>';
														echo '<option value="Heavy Carrier" >Heavy Carrier</option>';
														echo '<option value="2 Wheeler" >2 Wheeler</option>';
														echo '<option value="Transport By Vendor">Transport By Vendor</option>';
														echo '<option value="Picked By Customer" selected>Picked By Customer</option>';
													}														
													else:
													{
														echo "Error";
													}
													endif;
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
								<!--Transportation Type-->
								
								<!--Transportation Charge-->
								<div class="form-group col-md-3">
									<label>Transportation Charge</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-rupee"></i></span>
										<input type="text" class="form-control" maxlength="7" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?php echo $order_transport_result['order_transportation_charge'] ?>" id="ui_transport_charge" name="ui_transport_charge">
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
										<input type="text" class="form-control pull-right" name="ui_delivery_date" id="ui_delivery_date" value="<?php echo date('d/m/Y ', strtotime($order_transport_result['order_delivery_date']));  ?>">
									</div>
								</div>
								<!--Delivery Date-->												
								
								<!--Delivery Remarks-->
								<div class="form-group col-md-6">
									<label>Delivery Remarks</label>
									<textarea class="form-control" rows="4" id="ui_delivery_remarks" maxlength="150" name="ui_delivery_remarks" ><?php echo $order_transport_result['order_delivery_remarks']?></textarea>
								</div>
								<!--Delivery Remarks-->
								
								<!--Order Remarks-->
								<div class="form-group col-md-6">
									<label>Order Remarks</label>
									<textarea class="form-control" rows="4" id="ui_order_remarks" name="ui_order_remarks" maxlength="150" ><?php echo $order_result['order_remarks']?></textarea>
								</div>
								<!--Order Remarks-->
								
								<!-- User ID -->
										<input id="user_id" name="user_id" type="hidden" value="<?php echo $user_result['id'];?>" />
									<!-- User ID -->
									
								
								<div class="clear"></div>
							</fieldset>
						
						<div class="form-group col-md-2">
						
						<button type="button" class="btn btn-primary btn-flat btn-sm pull-left" data-toggle="modal"  data-target="#send_purchase_order">
												<i class="fa fa-plus"></i> Send Purchase Order
											</button>
						</div>
						
						<div class="form-group col-md-2 col-md-offset-8">
                        <button type="submit" data-loading-text="Please Wait..." onclick="myFunction()" class="btn btn-success form-control">Update  </button>
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

    <!--Including Bootstrap and other scripts-->
    <?php include "../extra/footer.html";?>
    <!--Including Bootstrap and other scripts-->
	

	
	

	
	
	
	
	
	
	
	
	
	
	
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
								<input type="text" class="form-control" id="modal_product_name" name="modal_product_name" style="text-transform:capitalize" onkeyup="autocomplet()"/>
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

					<input type="hidden" id="modal_product_id" name="modal_product_id" />

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
						<input type="text" class="form-control" id="modal_product_quantity" oninput="product_price_function();" name="modal_product_quantity" maxlength="50" onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode==46'/>
					</div>
					</div>
					<!--Quantity-->
					
					<!--Buying Price-->
					<div class="col-md-3">
						<div class="form-group">
						 <label>Buying Price [MRP]</label>
							<input type="text" class="form-control" id="modal_product_buying_price" name="modal_product_buying_price" oninput="product_price_function();"  maxlength="50" onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode==46'/>
						</div>
					</div>
					<!--Buying Price-->
					
					<!--Discount Percent-->
					<div class="col-md-2">
					<div class="form-group">
					 <label>Discount Percent</label>
						<input type="text" class="form-control" id="modal_product_discount_percent" onchange="handleChange(this);" oninput="product_price_function();" name="modal_product_discount_percent" maxlength="7" onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode==46'/>
					</div>
					</div>
					<!--Discount Percent-->
					
					<!--Discounted Price-->
					<div class="col-md-2">
						<div class="form-group">
						 <label>Discounted Price [BP]</label>
							<input type="text" class="form-control" readonly id="modal_product_discounted_price" name="modal_product_discounted_price" maxlength="50" onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode==46'/>
						</div>
					</div>
					<!--Discounted Price-->	
					
					
					<!--Total Buying Price-->
					<div class="col-md-2">
						<div class="form-group">
						 <label>Total Buying Price</label>
							<input type="text" class="form-control" readonly id="modal_product_total_of_buying" name="modal_product_total_of_buying" maxlength="50" onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode==46'/>
						</div>
					</div>
					<!--Total Buying Price-->	
					
					<!--Selling Percent-->
					<div class="col-md-6">
					<div class="form-group">
					 <label>Selling Percent</label>
						<input type="text" class="form-control" id="modal_product_selling_percent"  oninput="product_price_function('D');" onchange="handleChange(this);"  name="modal_product_selling_percent" maxlength="3" onkeypress='return event.charCode>= 48 && event.charCode <= 57|| event.charCode==46'/>
					</div>
					</div>
					<!--Selling Percent-->	

					<!--Selling Price-->
					<div class="col-md-6">
					<div class="form-group">
					 <label>Selling Price</label>
						<input type="text" class="form-control" id="modal_product_selling_price" name="modal_product_selling_price" oninput="product_price_function('P');" maxlength="10" onkeypress='return event.charCode>= 48 && event.charCode <= 57|| event.charCode==46'/>
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
							<input type="text" class="form-control" readonly id="modal_product_total" name="modal_product_total" maxlength="50" onkeypress='return event.charCode>= 48 && event.charCode <= 57|| event.charCode==46'/>
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

			var draft_id= <?php echo $ss_order_id; ?>;		
			var product_name= $("#modal_product_name").val(); 
			var product_id=$("#modal_product_id").val();
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
				data: {draft_id: draft_id, product_id:product_id, product_name: product_name, product_description: product_description, product_quantity:product_quantity,product_buying_price:product_buying_price,product_discount_price:product_discount_price,discounted_price:discounted_price,total_of_buying:total_of_buying,product_selling_percent:product_selling_percent,product_selling_price:product_selling_price,product_tax:product_tax,product_tax_inclusive:product_tax_inclusive,product_total:product_total,user_id:user_id,location:location}, // post data
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
		
		
		
	
		
	<!-- Add Product Modal -->
<div id="add_product_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
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
			<option selected disabled hidden value="">Select Product Set</option>
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
			<option selected disabled hidden value="">Select Brand</option>
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
					<input type="text" class="form-control" placeholder="Product Name" id="ui_product_name" maxlength="60" name="ui_product_name"/>
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
				<input type="text" class="form-control" id="modal_vendor_name" name="modal_vendor_name" />
			</div>
			<!--Vendor Name-->
						
			<!--Contact Person-->
			<div class="form-group">
			 <label>Contact Person</label>
				<input type="text" class="form-control" id="modal_vendor_contact_person" name="modal_vendor_contact_person" />
			</div>
			<!--Contact Person-->
			
			<!--Contact Number-->
			<div class="form-group">
			 <label>Contact Number</label>
				<input type="text" class="form-control" id="modal_contact_number" name="modal_contact_number" />
			</div>
			<!--Contact Number-->
			
			<!--Email-->
			<div class="form-group">
				<label>Email</label>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
					<input type="email" class="form-control" placeholder="Ex: abc@gmail.com" id="modal_vendor_email"  maxlength="30" name="modal_vendor_email" type="text" required>
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
				<input type="text" class="form-control" id="modal_customer_name" name="modal_customer_name" />
			</div>
			<!--Customer Name-->
						
			<!--Contact Person-->
			<div class="form-group">
			 <label>Contact Person</label>
				<input type="text" class="form-control" id="modal_customer_contact_person" name="modal_customer_contact_person" />
			</div>
			<!--Contact Person-->
			
			<!--Contact Number-->
			<div class="form-group">
			 <label>Contact Number</label>
				<input type="text" class="form-control" id="modal_customer_contact_number" name="modal_customer_contact_number"  maxlength="30" />
			</div>
			<!--Contact Number-->
			
			<!--Email-->
			<div class="form-group">
				<label>Email</label>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
					<input type="email" class="form-control" placeholder="Ex: abc@gmail.com" id="modal_customer_email"  maxlength="50" name="modal_customer_email" type="text" required>
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


<script>
function add_customer_modal()
{
	var customer_name= $("#modal_customer_name").val(); 
	var customer_contact_person= $("#modal_customer_contact_person").val();
	var customer_cnt_no= $("#modal_customer_contact_number").val();
	var customer_email= $("#modal_customer_email").val();
	var customer_address= $("#modal_customer_address").val();
	$.ajax(
		{
		url: "../php/add_modal/add_customer_php.php",
		type: "POST", // you can use GET
		data: {customer_name: customer_name, customer_contact_person: customer_contact_person, customer_cnt_no:customer_cnt_no,customer_email:customer_email,customer_address:customer_address}, // post data
		success: function(data)   // A function to be called if request succeeds
		{
			$("#add_customer_modal .close").click()
			$('#modal_customer_name').val("");
			$('#modal_customer_contact_person').val("");
			$('#modal_customer_contact_number').val("");
			$('#modal_customer_email').val("");
			$('#modal_customer_address').val("");
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
	var vendor_city= $("#modal_vendor_city").val();
	$.ajax(
		{
		url: "../php/add_modal/add_vendor_php.php",
		type: "POST", // you can use GET
		data: {vendor_name: vendor_name, contact_person: vendor_contact_person, contact_number:vendor_cnt_no,vendor_email:vendor_email,vendor_city:vendor_city,vendor_address:vendor_address}, // post data
		success: function(data)   // A function to be called if request succeeds
		{
			$("#add_vendor_modal .close").click()
			$('#modal_vendor_name').val("");
			$('#modal_vendor_contact_person').val("");
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
	var att= $(".att_name_order").val();  
	var i=0;
	var k=0;
	var dataarray_attribute_name = [];
	jQuery(".att_name_order").each(function(i, obj) //Attribute Name accessed by class name as it is unable to access using name
	{
		dataarray_attribute_name[k] = $(this).val();// obj.val();
		//alert(dataarray_attribute_name[k]);
		i= i + 1;
		k=k+1;
	});
	
	//alert(dataarray_attribute_name);
	
	var l=0;
	var dataarray_attribute_id = [];
	jQuery(".att_id_order").each(function(i, obj) //Attribute Name accessed by class name as it is unable to access using name
	{
		dataarray_attribute_id[l] = $(this).val();// obj.val();
		//alert(dataarray_attribute_id[l]);
		i= i + 1;
		l=l+1;
	});
	
	//alert(dataarray_attribute_id);
	
	
	var m=0;
	var dataarray_attribute_value = [];
	jQuery(".att_id_values").each(function(i, obj) //Attribute Name accessed by class name as it is unable to access using name
	{
		dataarray_attribute_value[m] = $(this).val();// obj.val();
		//alert(dataarray_attribute_value[m]);
		i= i + 1;
		m=m+1;
	});
	//alert(dataarray_attribute_value);
	

$.ajax(
		{
		url: "../php/add_modal/add_product.php",
		type: "POST", // you can use GET
		data: {ui_product_set_id: product_set_id, ui_brand_id: brand_id, ui_product_name: product_name, ui_product_description: product_desc,attribute_name_input: dataarray_attribute_name, attribute_id: dataarray_attribute_id, attribute_values: dataarray_attribute_value}, // post data
		success: function(data)   // A function to be called if request succeeds
		{
			$("#add_product_modal .close").click()
			$('#ui_product_set_id').val("");
		//	$('#ui_brand_id').val("");
			$("#ui_brand_id").val([]);
			$('#ui_product_name').val("");
		}
	});
}
</script>




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


  function handleChange(input) {
    if (input.value < 0) input.value = 0;
   // if (input.value > 100) input.value = 100;
  }
  
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



		<!-- Purchase Order -->
		<div class="modal fade" id="send_purchase_order" role="dialog">
			<div class="modal-dialog modal-lg" style="width: 85%; height:70%;">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Purchase Order from Smartstorey</h4>
					</div>
					<div class="modal-body">

						<!-- Main content -->
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
												<tr><td>Phone: </td><td>+918884732111, +919901650420</td></tr>
												<tr><td>Email: </td><td>vendors@smartstorey.com</td></tr>
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
										<tr><td width="30%"><center><strong><?php echo $order_result['vendor_name'];?></strong></center></td></tr>
										<tr><td width="30%"><center><?php echo $order_result['vendor_address'];?></center><br></td></tr>
										<tr><td width="30%"><center><strong>Email:</strong><center> </td></tr> <tr><td width="30%"><center><?php echo $order_result['vendor_email'];?></center></td></tr>
									</table>
								</div>
								</address>
							</div>
							
							<div class="col-sm-4 invoice-col">
								<address>
									<div class="table-responsive">
										<table class="table table-condensed table-bordered">
											<tr><td width="30%"><center><strong>Order ID:</strong></center></td><td><?php echo $order_result['order_id'];?></td></tr>
											<tr><td width="30%"><center><strong>Order Date:</strong></center></td><td>  <?php echo date("d-m-Y", strtotime($order_result['order_date']));?></td></tr>
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
											<th><center>Buying Price</center></th>			 
											<th><center>Tax</center></th>
											<th><center>Tax I/E</center></th>
											<th><center>Total</center></th>
										</tr>
									</thead>
									<tbody>
										<?php $grand_total_po=0;$count=1; while ($order_product_result = mysqli_fetch_array($result4,MYSQLI_ASSOC)) {?>
										<tr>
											<td><center><?php echo $count;  ?></center></td>
											<td><center><?php echo $order_product_result['order_product_name'];  ?></center></td>
											<td><center><?php echo $order_product_result['order_product_description'];  ?></center></td>			
											<td><center><?php echo $order_product_result['order_product_quantity'];  ?></center></td>
											<td><center><?php echo $order_product_result['order_discounted_price']; ?></center></td>
											<td><center><?php echo $order_product_result['order_tax'];  ?></center></td>
											<td><center><?php if($order_product_result['tax_inclusive']==1)
											{
												echo "Inclusive";
											}
											else
											{
												echo "Exclusive";
											}
											?></center></td>

											<?php //$selling_total=$order_product_result['order_product_quantity']*$order_product_result['order_buying_price']; ?>
											<?php 
												$grand_total_po=$grand_total_po+ $order_product_result['order_total_of_buying'];?>
											<td><center><?php echo $order_product_result['order_total_of_buying']; ?></center></td>
										</tr>
										<?php $count=$count+1;} ?>
									</tbody>
								</table>
							</div>
						</div>

						<div class="row invoice-info">
							<div class="col-sm-2 col-md-offset-10 invoice-col">
								<div class="form-group has-success">
									<label class="control-label" for="inputSuccess">TRANSPORT</label>
									<input type="text" class="form-control" readonly id="transport" value="<?php echo $order_transport_result['order_transportation_charge'];?>">
								</div>
							</div>
							<div class="col-sm-2 col-md-offset-10 invoice-col">
								<div class="form-group has-success">
									<label class="control-label" for="inputSuccess">GRAND TOTAL</label>
									<input type="text" class="form-control" readonly id="grand_total" value="<?php echo $grand_total_po+$order_transport_result['order_transportation_charge'];?>">
								</div>
							</div>
						</div>
						
						<div class="row no-print">
							<hr>
							<div class="form-group col-md-offset-3 col-md-5">
								<label>Subject</label>
								<input type="text" class="form-control" name="email_subject" id="email_subject" maxlength="350" value="<?php echo $email_settings_result['email_subject'];  echo " [PO NO - ".$order_result['order_id'];  echo "]: "; echo $order_result['order_brief_details']; ?>">
							</div>
						</div>
						<div class="row  no-print">	
							<div class="form-group  col-md-offset-1 col-md-5">
								<label>To (Comma Seperated)</label>
								<input type="text" class="form-control" name="po_email_to" id="po_email_to" value="<?php echo $order_result['vendor_email'];?>">
							</div>
							
							<div class="form-group col-md-5">
								<label>CC (Comma Seperated)</label>
								<input type="text" class="form-control" name="email_cc" id="email_cc" value="<?php echo $order_result['vendor_alternate_email'];?>">
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<!--Shipping Address-->
								<div class="form-group">
									<label>Shipping Address [Project Site Address]</label>
									<textarea class="form-control" rows="6" id="ui_shipping_address" name="ui_shipping_address" maxlength="200" ><?php echo $order_result['project_site_address'];?></textarea>
								</div>
								<!--Shipping Address-->
							</div>
							
							<div class="col-md-3">
								<!--Site Incharge Name-->
								<div class="form-group">
									<label>Site Incharge Name</label>
									<input type="text" class="form-control" id="ui_site_incharge_name" name="ui_site_incharge_name" maxlength="200" value="<?php echo $order_result['project_site_incharge_name'];?>"/>
								</div>
								<!--Site Incharge Name-->
								
								<!--Site Incharge Number-->
								<div class="form-group">
									<label>Site Incharge Number</label>
									<input type="text" class="form-control" id="ui_site_incharge_number" name="ui_site_incharge_number" maxlength="200" value="<?php echo $order_result['project_site_incharge_contact_number'];?>"/>
								</div>
								<!--Site Incharge Number-->
							</div>
							
							<!-- Add Shipping Address -->
							<div class="form-group col-md-2">											
							<label>
							Send Shipping Address with PO &nbsp;&nbsp; <div class="input-group"><input type="checkbox" value="Send Shipping Address" name="ui_send_shipping_address_with_po" id="ui_send_shipping_address_with_po" onchange="valueChanged()">
							</div>
							</label>		
							<br>
							<br>
							<br>
							<label>
							Send Site Incharge Details with PO&nbsp;&nbsp; <div class="input-group"><input type="checkbox" value="Send Site Incharge Details" name="ui_send_site_incharge_details_with_po" id="ui_send_site_incharge_details_with_po" onchange="valueChanged()">
							</div>
							</label>											
							</div>
							<!--Add Shipping Address -->
										
							
							
							<div class="col-md-4">
								<!--Order Remarks-->
								<div class=" form-group">
									<label>Message To Vendor</label>
									<textarea class="form-control" rows="6" id="ui_message_to_vendor" name="ui_message_to_vendor" ><?php 							
									if($order_result['order_po_mail_body']=="")
									{
										echo $email_settings_result['email_body'];
									}
									else
									{
										echo $order_result['order_po_mail_body'];
									}
									
									?></textarea>
								</div>
								<!--Order Remarks-->
							</div>
						</div>
						
						<div class="row no-print">
							<div class="form-group col-md-2  col-md-offset-8">
								<form target="_blank" action="../php/purchase_order_pdf.php" action="POST">
									<input type="hidden" name="sorder_id" id="sorder_id" value="<?php echo $order_result['order_id'];?>">
									<button type="submit" id="generate_pdf" name="generate_pdf" class="btn btn-primary pull-right" style="margin-right: 5px;">
										<i class="fa fa-file-pdf-o"></i> Generate PDF
									</button>
								</form>
							</div>

							<div class="form-group col-md-2 col-md-offset-0">
								<!--<form action="../php/send_purchase_order.php" action="POST">
									<input type="hidden" name="id" id="id" value="<?php echo $order_id;?>">
									<button type="submit" class="btn btn-success pull-right"><i class="fa fa-envelope"></i> Send Purchase Order
									</button>
								</form>-->
								
								<button type="submit" id="btn_send_purchase_order" class="btn btn-success pull-right"><i class="fa fa-envelope"></i> Send Purchase Order
									</button>
									
									<input type="hidden" name="order_id" id="order_id" value="<?php echo $_GET["id"]; ?>"/>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		
		<script>
				$("#btn_send_purchase_order").click(function()
			{
				
				var order_id= $("#order_id").val(); 
				var email_subject= $("#email_subject").val(); 
				var po_email_to= $("#po_email_to").val(); 
				var email_cc= $("#email_cc").val(); 
				var user_id= $("#user_id").val(); 
				var ui_shipping_address= $("#ui_shipping_address").val(); 
				var ui_message_to_vendor= $("#ui_message_to_vendor").val();
				var send_PO, site_incharge_name,site_incharge_number,send_site_incharge_details;
				
					if ($('#ui_send_shipping_address_with_po').is(':checked')) 
					{
						send_PO="Send Shipping Address";
					}
					else
					{
						send_PO="Do Not Send Shipping Address";
					}
					
					if ($('#ui_send_site_incharge_details_with_po').is(':checked')) 
					{
						send_site_incharge_details=1;
						site_incharge_name=$("#ui_site_incharge_name").val(); 
						site_incharge_number=$("#ui_site_incharge_number").val(); 
					}
					else
					{
						send_site_incharge_details=0;
						site_incharge_name="No";
						site_incharge_number="No";
					}
				$.ajax(
				{
					url: "../php/send_purchase_order.php",
					type: "POST", // you can use GET
					data: {order_id: order_id,email_subject: email_subject,po_email_to:po_email_to, email_cc:email_cc, ui_shipping_address: ui_shipping_address,ui_message_to_vendor:ui_message_to_vendor,user_id:user_id,send_PO:send_PO,site_incharge_name:site_incharge_name,site_incharge_number:site_incharge_number,send_site_incharge_details:send_site_incharge_details}, // post data
					success: function(data)   // A function to be called if request succeeds
					{		
						alert(data);
						$("#send_purchase_order .close").click();	
					}
				});
			});	
		</script>	
		
		
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
	else 
	{       
    }					
}
</script>

</body>

</html>