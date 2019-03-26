<!DOCTYPE html>
<html>
<!--Including Login Session-->
<?php include "../extra/session.php";
$id=$_GET["id"];	
$type=$_GET["type"];
$product_list = "";
$prod_item=$_POST["prod_item"];	//Type will be Enquiry or clone
for ($aCntr = 0; $aCntr < count($prod_item); $aCntr++) 
{
	$product_list  = $product_list . $prod_item[$aCntr];
	if ($aCntr < (count($prod_item)-1))
	{
		$product_list = $product_list . ",";
	}
	
}
echo $product_list;
$order_draft_id= uniqid();	//It will create unique draft ID 
if($type=="Enquiry")
{
	$sql1 = "insert into order_product 
(order_id, order_product_name, order_product_description, order_product_quantity, order_buying_price, order_discounted_price, order_discount_percent, order_total_of_buying, order_selling_percentage, order_selling_price, order_tax, tax_inclusive, order_total) 
(SELECT '".$order_draft_id."' as order_id, enquiry_product_name , enquiry_product_description, enquiry_product_quantity
, enquiry_buying_price, enquiry_discounted_price, enquiry_discount_percent, enquiry_total_of_buying, enquiry_selling_percentage, enquiry_selling_price, enquiry_tax,tax_inclusive
, enquiry_total  FROM enquiry_product where enquiry_id=".$id." and delete_status<>1 and enquiry_product_id in (".$product_list."));";

	$result1 = mysqli_query($conn, $sql1);
	//$order_result = mysqli_fetch_array($result1,MYSQLI_ASSOC);
	
	$sql2 = "SELECT * FROM enquiry where enquiry_id = " . $id;
	$result2 = mysqli_query($conn, $sql2);
	$enquiry_result = mysqli_fetch_array($result2,MYSQLI_ASSOC);

}
else
{
	$sql1 = "SELECT * FROM ss_order ss, order_account oa, order_transport ot, vendor v, customer c, project p where p.customer_id=ss.customer_id and p.project_id=ss.project_id and ss.customer_id=c.customer_id and ss.order_id=oa.order_id and ss.order_id=ot.order_id and ss.vendor_id=v.vendor_id and ss.order_id = " . $id;
	$result1 = mysqli_query($conn, $sql1);
	$order_result = mysqli_fetch_array($result1,MYSQLI_ASSOC);

	$sql4 = "SELECT * FROM order_product where delete_status<>1 and order_id = " . $_GET["id"];
	$result4 = mysqli_query($conn, $sql4);
	
	$sql2 = "SELECT * FROM order_account where  delete_status<>1 and order_id = " . $_GET["id"];
$result2 = mysqli_query($conn, $sql2);
$order_account_result = mysqli_fetch_array($result2,MYSQLI_ASSOC);

$sql3 = "SELECT * FROM order_transport where  delete_status<>1 and order_id = " . $_GET["id"];
$result3 = mysqli_query($conn, $sql3);
$order_transport_result = mysqli_fetch_array($result3,MYSQLI_ASSOC);


}



$sql_email_settings = "SELECT * FROM email_settings where email_module='PURCHASE ORDER'";
$result_email_settings = mysqli_query($conn, $sql_email_settings);
$email_settings_result = mysqli_fetch_array($result_email_settings,MYSQLI_ASSOC);
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
	function edit_set_item(item) 
	{
		// change input value
		$("input[name='edit_modal_product_name']").val(item);
		// hide proposition list
		$("ul[name='edit_products_list']").hide();
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
	function set_item(item) 
	{
		// change input value
		$("input[name='modal_product_name']").val(item);
		// hide proposition list
		$("ul[name='products_list']").hide();
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

		fetchMysqlDatabase("<?php if($type=="Enquiry")
{ echo $order_draft_id; } else echo $id;?>")
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
			function product_price_function() 
			{
				var quantity=document.getElementById('modal_product_quantity').value;
				var buying_price=document.getElementById('modal_product_buying_price').value;
				var discount_percent=document.getElementById('modal_product_discount_percent').value;
				var selling_percent=document.getElementById('modal_product_selling_percent').value;
				var tax_string=document.getElementById('modal_product_tax').value;
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
			
				var c = a* (1+(selling_percent/100));
				c=c.toFixed(2);	
				document.getElementById('modal_product_selling_price').value=c;
				
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
					New Order  <div class="btn-toolbar pull-right">
					
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
                                <form name="add_order_form" id="add_order_form" enctype="multipart/form-data" action="../php/add/add_order_php.php" method="post">
								
								
								<input type="hidden" name="draft_id" id="draft_id" value="<?php echo $order_draft_id; ?>"/>
								
								
								<!--Order ID-->
								<input name="ui_ss_order_id" id="ui_ss_order_id" type="hidden" value="<?php echo $id;?>">
								<!--Order ID-->
								
								<!--Location-->
										<input id="location" name="location" type="hidden" value="<?php echo $user_result['location'];?>"/>
								<!--Location-->
								
								<!--Date-->
								<div class="form-group col-md-3">
									<label>Order Date</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input type="text" readonly class="form-control pull-right" name="ui_order_date" id="ui_order_date" value="<?php echo date("d/m/Y"); ?>"">
									</div>
								</div>
								<!--Date-->
								
								<!--Vendor Name-->
								<div class="form-group col-md-3">
									<label>Vendor Name</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user"></i></span>
										<select name="ui_vendor_name" id="ui_vendor_name" class='form-control select2' style='width: 100%;' required>
										<option selected disabled hidden>Select Vendor</option>
										<?php
										{
											if($type!="Enquiry")
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
else
{
	
	$sql = "SELECT * from vendor where delete_status<>1";
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query))
											{												
												echo "<option value='" . $row['vendor_id'] . "' >" . $row['vendor_name']. "</option>";											
												
											}
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
										<select name="ui_customer_name" id="ui_customer_name" class='form-control select2' style='width: 100%;' required>
										<option selected disabled hidden>Select Customer</option>
										<?php
										{
											if($type!="Enquiry")
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
											else
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
												
												
											//echo "<option value='" . $row['customer_id'] . "'>" . $row['customer_name']. "</option>";
											}
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
										<select name="ui_project_name" id="ui_project_name" class='form-control select2' style='width: 100%;' required>
										<option selected disabled hidden>Select Project</option>
										<?php
										{
											if($type!="Enquiry")
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
																							
												//echo "<option value='" . $row['project_id'] . "'>" . $row['project_name']. "</option>";
											}
											}
											else
											{
												if ( $enquiry_result['customer_id'] == "" )
												{
											$sql = "SELECT * from project where delete_status<>1";
												}
												else
												{
											$sql = "SELECT * from project where delete_status<>1 and customer_id = ".$enquiry_result['customer_id'];
												}
													
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
																							
												//echo "<option value='" . $row['project_id'] . "'>" . $row['project_name']. "</option>";
											}
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
										<input type="text" class="form-control" maxlength="25" class="form-control" id="ui_order_placed_by" name="ui_order_placed_by" value="<?php if($type!="Enquiry") { echo $order_result['order_placed_by']; } ?>">
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
											if($type!="Enquiry")
											{
											$sql = "SELECT * from ss_order where delete_status<>1";
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query))
											{
												if ($row['order_id'] == $order_result['order_id']):
												{
													if ($order_result['order_confirmation_type']=='Whatsapp'):
													{
														echo '<option value="Whatsapp" selected>Whatsapp</option>';
														echo '<option value="Email">Email</option>';
														echo '<option value="SMS">SMS</option>';
														echo '<option value="Call">Call</option>';
													}
													endif;
													if ($order_result['order_confirmation_type']=='Email'):
													{
														echo '<option value="Whatsapp" >Whatsapp</option>';
														echo '<option value="Email" selected>Email</option>';
														echo '<option value="SMS">SMS</option>';
														echo '<option value="Call">Call</option>';
													}	
													endif;
													if ($order_result['order_confirmation_type']=='SMS'):
													{
														echo '<option value="Whatsapp" >Whatsapp</option>';
														echo '<option value="Email" >Email</option>';
														echo '<option value="SMS" selected>SMS</option>';
														echo '<option value="Call">Call</option>';
													}
													endif;
													if ($order_result['order_confirmation_type']==''):
													{
														echo '<option value="Whatsapp" >Whatsapp</option>';
														echo '<option value="Email" >Email</option>';
														echo '<option value="SMS" >SMS</option>';
														echo '<option value="Call" selected>Call</option>';
													}	
													endif;
													if ($order_result['order_confirmation_type']==''):
													{
														echo '<option value="Whatsapp" >Whatsapp</option>';
														echo '<option value="Email" >Email</option>';
														echo '<option value="SMS" >SMS</option>';
														echo '<option value="Call">Call</option>';
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
											else
											{
													echo '<option value="Whatsapp" selected>Whatsapp</option>';
													echo '<option value="Email">Email</option>';
													echo '<option value="SMS">SMS</option>';
													echo '<option value="Call">Call</option>';
											}
										} 
										?>
										</select>
									</div>
								</div>
								<!--Confirmation Type-->
								
								<!--Assignee Name-->
								<div class="form-group col-md-3">
									<label>Assignee</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
										<select name="ui_assignee_name" id="ui_assignee_name" class='form-control select2' style='width: 100%;'>
											<option selected disabled hidden>Select Assignee</option>
											<?php
											{
												if($type!="Enquiry")
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
												else
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
										<select name="ui_order_status" id="ui_order_status" class='form-control selectpicker' style='width: 100%;' required>
										
										<?php
										{
											if($type!="Enquiry")
											{
											$sql = "SELECT * from ss_order where delete_status<>1";
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query))
											{
												if ($row['order_id'] == $order_result['order_id']):
												{
													if ($order_result['order_status']=='Order Created'):
													{
														echo '<option value="Order Created" selected>Order Created</option>';
														echo '<option value="Order Placed">Order Placed</option>';
														echo '<option value="Material Ready To Dispatch">Material Ready To Dispatch</option>';
														echo '<option value="Order Partially Delivered">Order Partially Delivered</option>';
														echo '<option value="Order Fulfilled">Order Fulfilled</option>';
														
													}
													endif;
													if ($order_result['order_status']=='Order Placed'):
													{
														echo '<option value="Order Created" selected>Order Created</option>';
														echo '<option value="Order Placed" selected>Order Placed</option>';
														echo '<option value="Material Ready To Dispatch">Material Ready To Dispatch</option>';
														echo '<option value="Order Partially Delivered">Order Partially Delivered</option>';
														echo '<option value="Order Fulfilled">Order Fulfilled</option>';
													}	
													endif;
													if ($order_result['order_status']=='Material Ready To Dispatch'):
													{
														echo '<option value="Order Created" >Order Created</option>';
														echo '<option value="Order Placed">Order Placed</option>';
														echo '<option value="Material Ready To Dispatch" selected>Material Ready To Dispatch</option>';
														echo '<option value="Order Partially Delivered">Order Partially Delivered</option>';
														echo '<option value="Order Fulfilled">Order Fulfilled</option>';
													}	
													endif;
													if ($order_result['order_status']=='Order Partially Delivered'):
													{
														echo '<option value="Order Created" >Order Created</option>';
														echo '<option value="Order Placed">Order Placed</option>';
														echo '<option value="Material Ready To Dispatch">Material Ready To Dispatch</option>';
														echo '<option value="Order Partially Delivered" selected>Order Partially Delivered</option>';
														echo '<option value="Order Fulfilled">Order Fulfilled</option>';
													}	
													endif;
													if ($order_result['order_status']=='Order Fulfilled'):
													{
														echo '<option value="Order Created" >Order Created</option>';
														echo '<option value="Order Placed">Order Placed</option>';
														echo '<option value="Material Ready To Dispatch" >Material Ready To Dispatch</option>';
														echo '<option value="Order Partially Delivered">Order Partially Delivered</option>';
														echo '<option value="Order Fulfilled" selected>Order Fulfilled</option>';
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
											else
											{
												echo '<option value="Order Created" selected>Order Created</option>';
														echo '<option value="Order Placed">Order Placed</option>';
														echo '<option value="Material Ready To Dispatch">Material Ready To Dispatch</option>';
														echo '<option value="Order Partially Delivered">Order Partially Delivered</option>';
														echo '<option value="Order Fulfilled">Order Fulfilled</option>';
											}
										} 
										?>
										
										</select>
									</div>
								</div>
								<!--Order Status-->								
					
								<!--Brief Order Detail-->
									<div class="form-group col-md-6">
										<label>Brief Order Detail</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-commenting"></i></span>
											<input type="text" class="form-control" class="form-control" id="ui_brief_order_details" name="ui_brief_order_details" value="<?php if($type!="Enquiry") { echo $order_result['order_brief_details']; } else { echo $enquiry_result['enquiry_name']; }?>">
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
											if($type!="Enquiry")
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
											else
											{
												echo '<option value="Within State" selected>Within State</option>';
														echo '<option value="Outside State">Outside State</option>';
										}
										} 
										?>										
											</select>
										</div>
									</div>
									<!--Delivery Location-->
								
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
									<label>Estimate Number</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-calculator"></i></span>
										<input type="text" class="form-control" maxlength="25" class="form-control"  id="ui_estimate_number" name="ui_estimate_number" value="<?php if($type!="Enquiry") { echo $order_account_result['order_estimate_number'];} else { echo $id; } ?>">
									</div>
								</div>
								<!--Estimate Number-->
								
								
								<!-- E-Sugam Number -->
								<div class="form-group col-md-3">
									<label>E-Sugam Number</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-etsy"></i></span>
										<input type="text" class="form-control" maxlength="25" class="form-control" id="ui_e_sugam_number" name="ui_e_sugam_number" value="<?php if($type!="Enquiry") { echo $order_account_result['order_e_sugam_number']; } ?>">
									</div>
								</div>
								<!-- E-Sugam Number -->
								
								<!--Purchase Bill Number-->
								<div class="form-group col-md-3">
									<label>Purchase Bill Number</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-newspaper-o "></i></span>
										<input type="text" class="form-control" maxlength="25" class="form-control" id="ui_purchase_bill_number" name="ui_purchase_bill_number" value="<?php if($type!="Enquiry") { echo $order_account_result['order_purchase_bill_number']; } ?>">
									</div>
								</div>
								<!--Purchase Bill Number-->
								
								<!--SS Invoice Number-->
								<div class="form-group col-md-3">
									<label>SS Invoice Number</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-trello"></i></span>
										<input type="text" class="form-control" maxlength="25" class="form-control" id="ui_ss_invoice_number" name="ui_ss_invoice_number" value="<?php if($type!="Enquiry") { echo $order_account_result['order_ss_invoice_number']; } ?>">
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
											if($type!="Enquiry")
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
											
											else
											{
													echo '<option value="Carrier Auto" selected>Carrier Auto</option>';
														echo '<option value="Passenger Auto" >Passenger Auto</option>';
														echo '<option value="Heavy Carrier">Heavy Carrier</option>';
														echo '<option value="2 Wheeler">2 Wheeler</option>';
														echo '<option value="Transport By Vendor">Transport By Vendor</option>';
														echo '<option value="Picked By Customer">Picked By Customer</option>';
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
										<input type="text" class="form-control" maxlength="7" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?php if($type!="Enquiry") { echo $order_transport_result['order_transportation_charge']; } else { echo $enquiry_result['enquiry_transport_charge'];} ?>" id="ui_transport_charge" name="ui_transport_charge">
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
										<input type="text" class="form-control pull-right" name="ui_delivery_date" id="ui_delivery_date" value="<?php echo date("d/m/Y");?>">
									</div>
								</div>
								<!--Delivery Date-->												
								
								<!--Delivery Remarks-->
								<div class="form-group col-md-6">
									<label>Delivery Remarks</label>
									<textarea class="form-control" rows="4" id="ui_delivery_remarks" maxlength="150" name="ui_delivery_remarks" ><?php if($type!="Enquiry") { echo $order_transport_result['order_delivery_remarks']; }?></textarea>
								</div>
								<!--Delivery Remarks-->
								
								<!--Order Remarks-->
								<div class="form-group col-md-6">
									<label>Order Remarks</label>
									<textarea class="form-control" rows="4" id="ui_order_remarks" name="ui_order_remarks" maxlength="150" ><?php if($type!="Enquiry") { echo $order_result['order_remarks']; }?></textarea>
								</div>
								<!--Order Remarks-->
								<!--File Upload
								<div class="form-group col-md-3">
								<label>File Upload</label></br>
								<input type="file" name="file"/>
								</div>
								File Upload-->
								
								<div class="clear"></div>
							</fieldset>
						
						
						<div class="form-group col-md-2 col-md-offset-10">
                        <button type="submit" data-loading-text="Please Wait..." onclick="myFunction()" class="btn btn-success form-control">Save  </button>
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
						 <label>Buying Price</label>
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
						 <label>Discounted Price</label>
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
						<input type="text" class="form-control" id="modal_product_selling_percent"  oninput="product_price_function();" onchange="handleChange(this);"  name="modal_product_selling_percent" maxlength="3" onkeypress='return event.charCode>= 48 && event.charCode <= 57|| event.charCode==46'/>
					</div>
					</div>
					<!--Selling Percent-->	

					<!--Selling Price-->
					<div class="col-md-6">
					<div class="form-group">
					 <label>Selling Price</label>
						<input type="text" class="form-control" id="modal_product_selling_price" name="modal_product_selling_price" maxlength="10" onkeypress='return event.charCode>= 48 && event.charCode <= 57|| event.charCode==46'/>
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

			var draft_id= <?php echo $id; ?>;		
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
				data: {draft_id: draft_id, product_name: product_name, product_description: product_description, product_quantity:product_quantity,product_buying_price:product_buying_price,product_discount_price:product_discount_price,discounted_price:discounted_price,total_of_buying:total_of_buying,product_selling_percent:product_selling_percent,product_selling_price:product_selling_price,product_tax:product_tax,product_tax_inclusive:product_tax_inclusive,product_total:product_total,user_id:user_id,location:location}, // post data
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
    if (input.value > 100) input.value = 100;
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