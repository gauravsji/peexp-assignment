<!DOCTYPE html>
<html>
	<!-- Including Login Session -->
	<?php include "../extra/session.php";
	$global_total=0;
	?>
	<!-- Including Login Session -->

	<head>
		<!-- Including Bootstrap CSS links -->
		<?php include "../extra/header.html";?>
		<!-- Including Bootstrap CSS links -->
		
		<!-- Push Notification-->
		<script charset="UTF-8" src="//cdn.sendpulse.com/28edd3380a1c17cf65b137fe96516659/js/push/7625e8166a7ca5a1726090cbafc0f211_0.js" async></script>
		<!-- Push Notification-->
	<script>
	function autocomplet() 
	{
		var min_length = 0; 
		// min caracters to display the autocomplete
		var keyword = $("input[name='modal_vendor_name']").val();
		keyword=keyword.replace(/ /g,"%");
		if (keyword.length >= 4) 
		{
			$.ajax({
				url: '../php/get_vendor_name_autocomplete.php',
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

	function set_item(name, number, email) 
	{
		// change input value
		$("input[name='modal_vendor_name']").val(name);
		$("input[name='vendor_number']").val(number);
		$("input[name='vendor_email']").val(email);
		$("ul[name='products_list']").hide();
	}
	
	
	function autocomplete_cust_name() 
	{
		var min_length = 0; 
		// min caracters to display the autocomplete
		var keyword = $("input[name='modal_customer_name']").val();
		keyword=keyword.replace(/ /g,"%");
		if (keyword.length >= 4) 
		{
			$.ajax({
				url: '../php/get_customer_name_autocomplete.php',
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

	function set_item_cust(name, number, email) 
	{
		// change input value
		$("input[name='modal_customer_name']").val(name);
		$("input[name='contact_number']").val(number);
		$("input[name='customer_email']").val(email);
		$("ul[name='products_list']").hide();
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
	</style>
	</head>

	<body class="hold-transition skin-blue fixed sidebar-mini" >
		<div class="wrapper">
			<!--Including Topbar-->
			<?php include "../extra/topbar.php";?>
			<!--Including Topbar-->

			<!--Including Left Nav Bar-->
			<?php include "../extra/left_nav_bar.php";?>
			<!--Including Left Nav Bar-->

			<!-- Content Wrapper, Contains Page Content -->
			<div class="content-wrapper">

					<!-- Main Content -->
					<section class="content ">
						<?php
						$query_count = "SELECT login_count FROM users where email='".$user_result['email']."' and password='25f9e794323b453885f5181f1b624d0b'";
						$result_count = mysqli_query($conn, $query_count);
						$user_count_result = mysqli_fetch_array($result_count,MYSQLI_ASSOC);
						if($user_count_result['login_count']==1)
						{
							echo '<div class="pad">
								<div class="callout callout-info">
									Hurray Successfull Login, Please change your initial password in Profile Section-Change Password.
								</div>
							</div>';
						}
						?>
						<section class="content-header">
							<h1>Pre Enquiry<a class="btn pull-right btn-xs btn-primary" data-toggle="modal" data-target="#add_pre_enquiry_modal">New Pre Enquiry</a></h1>
						</section>				
						
	<!-- Table: Latest Orders -->
	<div class="box">
		<div class="box-body">
			<div class="table-responsive">
				<table id="view_enquiry_html" class="table table-bordered table-striped table-condensed stripe row-border order-column" width="100%" style="border-collapse:collapse;">
					<thead>
						<tr>
						<th width="8%"><center>Date</center></th>
						<th width="10%"><center>Customer Name</center></th>
						<th width="10%"><center>Enquiry Name</center></th>
						<!--<th width="10%"><center>Customer contact</center></th>
						
						
						<th><center>Customer Email</center></th> -->
						<th width="10%"><center>Sales Assignee</center></th>
						<th width="10%"><center>Vendor Assignee</center></th>
						<th><center>Priority</center></th>
						<th><center>Status</center></th>
						<th><center>Action</center></th>
						</tr>
					</thead>							
					
					<tbody>
						<?php
							$i=1;
							$sql = "SELECT * FROM pre_enquiry_details ORDER BY enquiry_date DESC";
							$result = mysqli_query($conn,$sql);
							while ($row = mysqli_fetch_array($result))
							{
								
								echo '<tr>';
								$date = date("d-m-Y", strtotime($row['enquiry_date']));
								echo '<td  width="5%"><center>' .$date . '</center></td>';
								echo '<td  width="5%"><center>' . $row['customer_name'] . '</center></td>';
								echo '<td  width="5%"><center>' . $row['enquiry_name'] . '</center></td>';
								echo '<td><center>'.$row['sales_assignee_name'].'</center></td>';	
								echo '<td  width="5%"><center>' . $row['vendor_assignee_name'] . '</center></td>';

								if( $row['enquiry_priority']=="P1")
								{
									echo '<td style="width:12%"><center><div class="badge bg-teal">' . "P1" . '</div></center></td>';
								}
								else if( $row['enquiry_priority']=="P2" )
								{
									echo '<td style="width:12%;text-align: center;"><div class="badge bg-yellow">' . "P2" . '</div></td>';
								}
								else if( $row['enquiry_priority']=="P3" )
								{
									echo '<td style="width:12%"><center><div class="badge bg-orange">' . "P3" . '</div></center></td>';
								}							
								else{
									echo '<td style="width:12%"><center><div class="badge bg-teal">' . "P1" . '</div></center></td>';
								}
								
								if($row['vendor_assignee_name']=''){
								echo '<td><center><select class="form-control pre_enquiry_status'.$row['pre_enquiry_id'].'" name="pre_enquiry_status'.$row['pre_enquiry_id'].'" id="pre_enquiry_status" data-id="'.$row['pre_enquiry_id'].'">
								<option value="unassigned">  Unassigned</option>
								<option value="price_awaited">Vendor - Price Awaited</option>
								<option value="v_sample_awaited">Vendor - Sample Awaited</option>
								<option value="v_send_for_rework">Vendor - Sent for rework</option>
								<option value="c_quote_sent">Customer - Quote sent</option>
								<option value="c_on_hold">Customer - On hold</option>
								<option value="c_quote_rework">Customer - Quote Rework</option>
								<option value="closed_won">Closed - Won</option>
								<option value="closed_lost">Closed - Lost</option>
								</select></center></td>';
								}
								else{
									echo '<td><center><select class="form-control pre_enquiry_status'.$row['pre_enquiry_id'].'" name="pre_enquiry_status'.$row['pre_enquiry_id'].'" id="pre_enquiry_status" data-id="'.$row['pre_enquiry_id'].'">
								<option value="assigned">Assigned</option>
								<option value="price_awaited">Vendor - Price Awaited</option>
								<option value="v_sample_awaited">Vendor - Sample Awaited</option>
								<option value="v_send_for_rework">Vendor - Sent for rework</option>
								<option value="c_quote_sent">Customer - Quote sent</option>
								<option value="c_on_hold">Customer - On hold</option>
								<option value="c_quote_rework">Customer - Quote Rework</option>
								<option value="closed_won">Closed - Won</option>
								<option value="closed_lost">Closed - Lost</option>
								</select></center></td>';
								}

								echo  '<td data-toggle="collapse" class="accordion-toggle" data-target="#prod';echo $i; echo'" title="View Product"><center><span class="btn btn-primary btn-xs glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;<button class="btn btn-xs btn-primary pre_enq_id" id="pre_enq_id" data-toggle="modal" name="pre_enq_id" value="'.$row['pre_enquiry_id'].'" data-target="#add_vendor_modal" title="Add vendor"><span class="fa fa-user-plus"></span></button>&nbsp;&nbsp;<button class="btn btn-xs btn-primary edit_pre_enq_id" id="edit_pre_enq_id" data-toggle="modal" name="edit_pre_enq_id" value="'.$row['pre_enquiry_id'].'" data-target="#edit_pre_enquiry_modal" title="Edit Pre Enquiry"><span class="fa fa-edit"></span></button></center></td>';
								echo '</tr>';
								
							echo '<tr>
						<td colspan="12" class="hiddenRow">
							<div class="accordian-body collapse" id="prod'; echo $i; echo '">   
								<table id="view_order_product_html" class="table table-bordered table-striped table-fixed">
									<tbody>
										<thead>
										<tr>
										<th><center>Product Name</center></th>
										<th><center>Product Description</center></th>
											<th><center>Product Quantity</center></th>
											<th><center>View</center></th>
										</thead>
									<tr>';
									$sql1 = "SELECT * FROM pre_enquiry_product where pre_enquiry_id=".$row['pre_enquiry_id'];
									$result1 = mysqli_query($conn,$sql1);
									while ($row2 = mysqli_fetch_array($result1))
									{
										
										echo '<tr><td><center>' . $row2['pro_name'] . '</center></td>';
										echo '<td><center>' . $row2['pro_description'] . '</center></td>';
										echo '<td><center>' . $row2['pro_quantity'] . '</center></td>';
										echo '<td><center><button class="btn btn-xs btn-primary pre_enq_id" id="pre_enq_id" data-toggle="modal" name="'.$row2['pre_enquiry_id'].'" value="'.$row2['pre_enquiry_product_id'].'" data-target="#view_vendor_modal" title="Add vendor"><span class="glyphicon glyphicon-eye-open"></span></button></center></td></tr>';
									}				
									echo '</tbody>
								</table>
							</div>
						</td>
						</tr>';
						$i++;
					}
					?>
				</tbody>
			</table>
			</div>	
			
		</div>
	</div>
	</div>
						<!-- Table: Latest Orders -->
				</section>
			</div>
			<!-- Content Wrapper, Contains Page Content -->

			<!-- Main Footer -->
			<footer class="main-footer">
				<div class="pull-right hidden-xs"></div>				
			</footer>
			<!-- Main Footer -->

			<!--Including right slide panel-->
			<?php include "../extra/aside.php";?>
			
			<!-- Add the sidebar's background this div must be placed immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
			<!-- Add the sidebar's background this div must be placed immediately after the control sidebar -->
		<!-- Add Customer Modal -->
	<div id="add_pre_enquiry_modal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Pre Enquiry</h4>
				</div>
				<div class="modal-body">
					<form role="form" id="contact" name="contact" method="post">

						<!--Enquiry Date-->
						<div class="form-group col-md-4">
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
						<div class="form-group col-md-4">
							<label>Customer Name</label>
							<input type="text" class="form-control" style="text-transform:capitalize" onkeyup="autocomplete_cust_name()" id="modal_customer_name" name="modal_customer_name" placeholder="Customer name require" required/>
							<ul name="products_list" id="products_list"></ul>
						</div>
						<!--Customer Name-->

						<!--Customer Name-->
						<div class="form-group col-md-4">
							<label>Enquiry Name</label>
							<input type="text" class="form-control" style="text-transform:capitalize" id="modal_enquiry_name" name="modal_enquiry_name" placeholder="Enquiry name require" required/>
						</div>
						<!--Customer Name-->

						<div class="form-group col-md-4">
							<label>Priority</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-star"></i></span>
								<select name="ui_enquiry_priority" id="ui_enquiry_priority" class='form-control select2' style='width: 100%;'>
									<option disabled hidden>Select</option>
									<option value="P1">P1</option>
									<option value="P2">P2</option>
									<option value="P3">P3</option>
								</select>
							</div>
						</div>

						<!--Contact Number-->
						<div class="form-group col-md-4">
							<label>Contact Number</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
								<input type="text" class="form-control" placeholder="Ex: 9876543210" onkeypress='return event.charCode>= 48 && event.charCode <= 57' id="contact_number" maxlength="50" name="contact_number" type="text" required />
							</div>
						</div>
						<!--Contact Number-->
						<!--Email-->
						<div class="form-group col-md-4">
							<label>Email</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
								<input type="email" class="form-control" placeholder="Ex: abc@gmail.com" style="text-transform:lowercase" id="customer_email"  maxlength="100" name="customer_email" type="text" required placeholder="Email required" />
							</div>
						</div>
						<!--Email-->
						<div class="form-group col-md-3">
							<label>Assignee Sales</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
								<select name="sales_assignee_name" id="sales_assignee_name" class='form-control' style='width: 100%;'>
								<option value="Kunal" <?php if($_SESSION['name']=='Kunal'){ echo 'selected';} ?> >Kunal</option>
								<option value="Aishwarya" <?php if($_SESSION['name']=='Aishwarya Kaul'){ echo 'selected';} ?> >Aishwarya</option>
								<option value="Apoorva" <?php if($_SESSION['name']=='Apoorva Mishra'){ echo 'selected';} ?> >Apoorva</option>
								</select>
							</div>
						</div>
						<div class="form-group col-md-3">
							<label>Assignee Vendor</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
								<select name="vendor_assignee_name" id="vendor_assignee_name" class='form-control select2' style='width: 100%;'>
								<option selected disabled hidden>Select Sales</option>
								<option value="Varun">Varun</option>
								<option value="Naureen">Naureen</option>
								<option value="Chirag">Chirag</option>
								</select>
							</div>
						</div>
						<!--Assignee Name-->
						<!--Assignee Name-->
						<div class="col-md-3 form-group" style="margin-top: 25px;">
							<label class="checkbox-inline">
							<input type="checkbox" name="need_sample" id="need_sample" value="yes" style="margin-top: 1px;"><span>Need sample</span></label>
						</div>
						<div class="col-md-3 form-group" style="margin-top: 25px;">
							<label class="checkbox-inline">
							<input type="checkbox" id="need_alternate" name="need_alternate" value="yes" style="margin-top: 1px;><span">Need alternate</span></span">
						</div>
						<div class="col-md-4 form-group"></div>
						<div class="col-md-12 form-group">
							<fieldset class="row2">
								<center><label>Product Details</label></center>
								<div class="table-responsive">
									<table id="products" class="table table-fixed table-condensed table-bordered" border="0" style="overflow: scroll;">
									<tbody>
									<tr>
										<p>
										<td>
											<center><label for="product_name">Product Name</label></center>
											<input type="text" class="form-control" style="text-transform:capitalize" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode==32' name="pro_name"/>
										</td>
										<td>
											<center><label for="cate_description">Descriptions</label></center>
											<input type="text" class="form-control" name="pro_description"/>
										</td>
										<!--Quantity-->
										<td>
											<center><label for="Quantity">Quantity</label></center>
												<input type="text" class="form-control" id="modal_product_quantity" name="pro_quantity" maxlength="50" onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46'/>
										</td>
										<td>
											<center><label for="contact_delete">Action</label></center>
											<input type='button' name="contact_delete" class="form-control btn btn-danger btn-flat" value="Remove" onClick="deletethisrow('products',this)">
										</td>
										</p>
									</tr>
								</tbody>
							</table>
						</div>
						</fieldset>
					</div>
			<div class="form-group col-md-12">
				<input type="button" class="btn btn-primary btn-flat" value="Add Products" onClick="addRow('products')" /> 
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
						<!--Save-->
						<div class="form-group col-md-12">
							<button class="btn btn-success" type="button" id="add_pre_enquiry" name="add_pre_enquiry">Save</button>
							<button id="submit" type="submit" id="close_customer_modal" name="close_customer_modal"class="btn btn-default pull-right" data-dismiss="modal">Close</button>
						</div>
						<!--Save-->
					</form>
				</div>
				<div class="modal-footer" style="border-top: none;"></div>
			</div>
		</div>
	</div>
	<!-- Add Customer Modal -->
</div>
		<!-- End Of Content Wrapper, Contains Page Content -->

		<!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";?>
	</body>

		<!-- Add Customer Modal -->
	<div id="add_vendor_modal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Enquiry Details</h4>
				</div>
				<div class="modal-body">
					<form role="form" id="contact" name="contact" method="post">
						<!--Customer Name-->
						<div class="form-group col-md-4">
							<label>Vendor Name</label>
							<input type="text" class="form-control" style="text-transform:capitalize" id="modal_vendor_name" name="modal_vendor_name" placeholder="Vendor name require" onkeyup="autocomplet()" style="text-transform:capitalize"/>
							<ul name="products_list" id="products_list"></ul>
						</div>
						<!--Customer Name-->

						<div class="form-group col-md-4">
							<label>Contact Number</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
								<input type="text" class="form-control" placeholder="Ex: 9876543210" onkeypress='return event.charCode>= 48 && event.charCode <= 57' id="vendor_number" maxlength="50" name="vendor_number" type="text"  />
							</div>
						</div>
						<!--Contact Number-->
						<!--Email-->
						<div class="form-group col-md-4">
							<label>Email</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
								<input type="email" class="form-control" placeholder="Ex: abc@gmail.com" style="text-transform:lowercase" id="vendor_email"  maxlength="100" name="vendor_email" type="text"  placeholder="Email required" />
							</div>
						</div>
						<!--Email-->
						<!--<div class="form-group col-md-3">
							<label>Assignee Vendor</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
								<select name="vendor_assignee_name1" id="vendor_assignee_name1" class='form-control select2' style='width: 100%;'>
								<option selected disabled hidden>Select Sales</option>
								<option value="Varun">Varun</option>
								<option value="Naureen">Naureen</option>
								<option value="Chirag">Chirag</option>
								</select>
							</div>
						</div>-->
						<!--Assignee Name-->
						<div class="col-md-4 form-group"></div>
						<div class="col-md-12 form-group">
							<fieldset class="row2">
								<center><label>Product Details</label></center>
								<div class="table-responsive">
								<div id="res3"></div>
						</div>
						</fieldset>
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
						<!--Save-->
						<div class="form-group col-md-12">
							<button class="btn btn-success" type="button" id="add_vendor_details" name="add_vendor_details">Save</button>
							<button id="submit" type="submit" id="close_customer_modal" name="close_customer_modal"class="btn btn-default pull-right" data-dismiss="modal">Close</button>
						</div>
						<!--Save-->
					</form>
				</div>
				<div class="modal-footer" style="border-top: none;"></div>
			</div>
		</div>
	</div>
	<!-- Add Customer Modal -->


		<!-- Add Customer Modal -->
	<div id="view_vendor_modal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Pre Enquiry Vendor Details</h4>
				</div>
				<div class="modal-body">
					<form role="form" id="contact" name="contact" method="post">
						<div class="table-responsive">
								<div id="pre_vendor"></div>
						</div>
					</form>
				</div>
				
			</div>
		</div>
	</div>
	<!-- Add Customer Modal -->

		<!-- Add Customer Modal -->
	<div id="edit_pre_enquiry_modal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit Pre Enquiry</h4>
				</div>
				<div class="modal-body">
				<form role="form" id="pre_enquiry" name="pre_enquiry" method="post">
					<div id="pre_edit_enquiry"></div>
					<!--Save-->
						<div class="form-group col-md-12">
							<button class="btn btn-success" type="button" id="edit_pre_enquiry" name="edit_pre_enquiry">Save</button>
							<button id="submit" type="submit" id="close_customer_modal" name="close_customer_modal"class="btn btn-default pull-right" data-dismiss="modal">Close</button>
						</div>
						<!--Save-->
					</form>
				</form>
				</div>
				<div class="modal-footer" style="border-top: none;"></div>
			</div>
		</div>
	</div>
	<!-- Add Customer Modal -->
	<script>
		$(".pre_enq_id").click(function() {
			var draft_id = $(this).attr("value");
		$.ajax({
			type: "POST",
			dataType: "html",
			url: "../php/get_pre_enquiry_product.php",
			data: {draft_id:draft_id},
			cache: false,
			success: function(htmldata) 
			{
			$('#res3').html(htmldata);
			}
		});
		});

		$(".pre_enq_id").click(function() {
			var draft_id = $(this).attr("value");
			var enquiry_id = $(this).attr("name");
		$.ajax({
			type: "POST",
			dataType: "html",
			url: "../php/get_pre_vendor_price.php",
			data: {draft_id:draft_id,enquiry_id:enquiry_id},
			cache: false,
			success: function(htmldata) 
			{
			$('#pre_vendor').html(htmldata);
			}
		});
		});

		$(".edit_pre_enq_id").click(function() {
			var enquiry_id = $(this).attr("value");
		$.ajax({
			type: "POST",
			dataType: "html",
			url: "../php/edit_pre_enquiry_details.php",
			data: {enquiry_id:enquiry_id},
			cache: false,
			success: function(htmldata) 
			{
			$('#pre_edit_enquiry').html(htmldata);
			}
		});
		});

		$("#add_pre_enquiry").click(function() {			
				var enquiry_date= $("#ui_enquiry_date").val(); 
				var customer_name= $("#modal_customer_name").val();
				var enquiry_priority= $("#ui_enquiry_priority").val();
				var enquiry_name= $("#modal_enquiry_name").val();
				var customer_email= $("#customer_email").val();
				var contact_number= $("#contact_number").val();
				var sales_assignee_name= $("#sales_assignee_name").val();
				var vendor_assignee_name= $("#vendor_assignee_name").val();
				var need_sample='';
				if($('input[name=need_sample]').is(':checked')){
					need_sample = 'yes';
				}
				else{
					need_sample='no';	
					}
				if($('input[name= need_alternate]').is(':checked')){
				   need_alternate= 'yes';
				   }
				   else{
				   	need_alternate = 'no';
				   }
				var pro_name = [];
				$.each($("input[name='pro_name']"), function(){            
				    pro_name.push($(this).val());
				});
				
				var pro_description = [];
				$.each($("input[name='pro_description']"), function(){            
				    pro_description.push($(this).val());
				});
				var pro_quantity = [];
				$.each($("input[name='pro_quantity']"), function(){            
				    pro_quantity.push($(this).val());
				});
			$.ajax(
			{    
				url: "../php/add_modal/add_pre_enquiry_php.php",
				type: "POST", // you can use GET
				data: {enquiry_date: enquiry_date, customer_name: customer_name, enquiry_priority: enquiry_priority, customer_email: customer_email,contact_number: contact_number,need_sample:need_sample, need_alternate :need_alternate, pro_name:pro_name,pro_description:pro_description,pro_quantity:pro_quantity,enquiry_name:enquiry_name,sales_assignee_name:sales_assignee_name,vendor_assignee_name:vendor_assignee_name}, // post data
				success: function(data)   // A function to be called if request succeeds
				{					
					location.reload();
				}
			});
		});

		$("#add_vendor_details").click(function() {			
				var vendor_name= $("#modal_vendor_name").val(); 
				var vendor_email= $("#vendor_email").val();
				var vendor_number= $("#vendor_number").val();
				var vendor_assignee_name1= $("#vendor_assignee_name1").val();
				
				var enquiry_id = [];
				$.each($("input[name='pre_enquiry_id']"), function(){            
				    enquiry_id.push($(this).val());
				});

				var product_id = [];
				$.each($("input[name='pre_enquiry_product_id']"), function(){            
				    product_id.push($(this).val());
				});

				var pro_name_modal = [];
				$.each($("input[name='pro_name_modal']"), function(){            
				    pro_name_modal.push($(this).val());
				});

				var pro_description_modal = [];
				$.each($("input[name='pro_description_modal']"), function(){            
				    pro_description_modal.push($(this).val());
				});

				var pro_quantity_modal = [];
				$.each($("input[name='pro_quantity_modal']"), function(){  
					pro_quantity_modal.push($(this).val());
				});

				var pro_price = [];
				$.each($("input[name='pro_price']"), function(){  
				pro_price.push($(this).val());
				});

				var tax_type = [];
				 $.each($(".tax_type option:selected"), function(){
          		 tax_type.push($(this).text());
				});

				var tax_rate = [];
				 $.each($(".tax_rate option:selected"), function(){
          		 tax_rate.push($(this).text());
				});

			$.ajax(
			{    
				url: "../php/add_modal/add_vendor_details_php.php",
				type: "POST", // you can use GET
				data: {vendor_name: vendor_name, vendor_number: vendor_number, vendor_email: vendor_email,vendor_assignee_name1:vendor_assignee_name1,enquiry_id:enquiry_id,product_id:product_id,pro_name_modal:pro_name_modal,pro_description_modal:pro_description_modal,pro_quantity_modal:pro_quantity_modal,pro_price:pro_price,tax_type:tax_type,tax_rate:tax_rate}, // post data
				success: function(data)   // A function to be called if request succeeds
				{					
					location.reload();
				}
			});
		});

		$("#edit_pre_enquiry").click(function() {
				var edit_enquiry_id= $("#edit_enquiry_id").val(); 
				var customer_name= $("#edit_customer_name").val();
				var enquiry_priority= $("#edit_enquiry_priority").val();
				var enquiry_name= $("#edit_enquiry_name").val();
				var customer_email= $("#edit_customer_email").val();
				var contact_number= $("#edit_contact_number").val();
				var sales_assignee_name= $("#edit_sales_assignee_name").val();
				var vendor_assignee_name= $("#edit_vendor_assignee_name").val();
				var need_sample='';
				if($('input[name=edit_need_sample]').is(':checked')){
					need_sample = 'yes';
				}
				else{
					need_sample='no';	
					}
				if($('input[name= edit_need_alternate]').is(':checked')){
				   need_alternate= 'yes';
				   }
				   else{
				   	need_alternate = 'no';
				   }

				var edit_pro_names = [];
				$.each($("input[name='edit_pro_names']"), function(){            
				    edit_pro_names.push($(this).val());
				});

				var edit_pro_descriptions = [];
				$.each($("input[name='edit_pro_descriptions']"), function(){            
				    edit_pro_descriptions.push($(this).val());
				});

				var edit_pro_quantitys = [];
				$.each($("input[name='edit_pro_quantitys']"), function(){            
				    edit_pro_quantitys.push($(this).val());
				});
				//var edit_enquiry_product_id= $("#edit_enquiry_product_id").val(); 
				var pro_quantity = [];
				$.each($("input[name='edit_pro_quantity']"), function(){            
				    pro_quantity.push($(this).val());
				});
				var edit_enquiry_product_id = [];
				$.each($("input[name='edit_enquiry_product_id']"), function(){            
				    edit_enquiry_product_id.push($(this).val());
				});
			$.ajax(
			{    
				url: "../php/add_modal/edit_pre_enquiry_php.php",
				type: "POST", // you can use GET
				data: {edit_enquiry_id:edit_enquiry_id,edit_enquiry_product_id:edit_enquiry_product_id,customer_name: customer_name, enquiry_priority: enquiry_priority, customer_email: customer_email,contact_number: contact_number,need_sample:need_sample, need_alternate :need_alternate,pro_quantity:pro_quantity,enquiry_name:enquiry_name,sales_assignee_name:sales_assignee_name,vendor_assignee_name:vendor_assignee_name,edit_pro_names:edit_pro_names,edit_pro_descriptions:edit_pro_descriptions,edit_pro_quantitys:edit_pro_quantitys}, // post data
				success: function(data)   // A function to be called if request succeeds
				{					
					//location.reload();
				}
			});
		});

		$(document).ready(function()
		{
			// Handler for .ready() called.
			$("#li_enquiry").addClass("active");
			$("#li_pre_enquiry_report").addClass("active");
			$(function () 
			{
			
			//Date picker
			$('#ui_enquiry_date').datepicker
				({
					format: 'dd/mm/yyyy',
					autoclose: true
				});
			});

		$("select[name^='pre_enquiry_status']")
	  	.change(function () {
	  		var pre_enquiry_id = $(this).attr('data-id');
	  		var domname = 'pre_enquiry_status'+pre_enquiry_id+' ';
		    var pre_enquiry_status =  $("."+domname + "option:selected").val();
		    $.ajax(
			{    
				url: "../php/add_modal/pre_enquiry_status.php",
				type: "POST",
				data: {pre_enquiry_status:pre_enquiry_status,pre_enquiry_id:pre_enquiry_id}, // post data
				success: function(data)   // A function to be called if request succeeds
				{					

				}
			});
		  	})
		});
	 
	</script>
</html>