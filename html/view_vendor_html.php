<!--
Description: View Vendor module displays the vendor information.
Date: 30/06/2017
-->
<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";
		$vendor_id=$_GET["id"];
		$sql = "SELECT * FROM vendor where vendor_id =". $vendor_id;
		$result = mysqli_query($conn, $sql);
		$vendor_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
	?>
	<!--Including Login Session-->
	<head>
		<!--Including Bootstrap CSS links-->
		<?php include "../extra/header.html";?>
		<!--Including Bootstrap CSS links-->
	</head>

	<body class="hold-transition skin-blue fixed sidebar-mini">
		<div class="wrapper">
		<!--Including Topbar-->
		<?php include "../extra/topbar.php";?>
		<!--Including Topbar-->

		<!--Left Side Panel Which Contains Navigation Menu-->
		<?php include "../extra/left_nav_bar.php";?>
		<!--Left Side Panel Which Contains Navigation Menu-->

		<!--Content Wrapper, contains page content-->
		<div class="content-wrapper">
			<section class="content-header">
				<h1>
					Vendor Details
					<a href="../reports/vendor_report_html.php" class="btn pull-right">
						<button type="button" class="btn btn-primary ">
							<i class="fa fa-arrow-left"></i> Back To Report
						</button>
					</a>
				</h1>
			</section>

			<!--Main content-->
			<section class="content">
				<div class="box">
					<div class="box-body pad">			
						<div class="row">
							<div class="col-xs-12">
								<h2 class="page-header">
									<center>  Name: <?php echo $vendor_result['vendor_name'] ?> </center> 
									<div class="btn-toolbar">
										<?php echo '<a class="btn btn-primary btn-flat pull-right" href="../html/edit_vendor_html.php?id='.$vendor_id.'"';'>'?>
											<button type="button" class="btn btn-primary ">
												<i class="fa fa-edit"></i> Edit
											</button>
										</a> 		  

										<button type="button" class="btn btn-primary btn-flat pull-right" data-toggle="modal" data-target="#add_brand">
											<i class="fa fa-plus"></i> Add Brand
										</button>

										<button type="button" class="btn btn-primary btn-flat pull-right" data-toggle="modal" data-target="#add_product">
											<i class="fa fa-plus"></i> Add Product
										</button>
									</div>
								</h2>
							</div>
						</div>
						<div class="row invoice-info">
							<div class="col-sm-5 invoice-col">
								<address>
									<div class="table-responsive">
										<table class="table table-condensed">
											<tr><td width="25%"><center>Contact Person:</center> </td><td> <center><strong>  <?php echo $vendor_result['vendor_contact_person'] ?></strong></center></td></tr>			
											<tr><td width="25%"><center>Email:</center> </td><td> <center><strong>  <?php echo $vendor_result['vendor_email'] ?></strong></center></td></tr>
											<tr><td width="25%"><center>Contact Number:</center> </td><td> <center><strong>  <?php echo $vendor_result['vendor_contact_number'] ?></strong></center></td></tr>
											<tr><td width="25%"><center>Alternate Contact Number:</center> </td><td> <center><strong>  <?php echo $vendor_result['vendor_alternate_contact_number'] ?></strong></center></td></tr>
											<tr><td width="25%"><center>Alternate Email:</center> </td><td> <center><strong>  <?php echo $vendor_result['vendor_alternate_email'] ?></strong></center></td></tr>
											<tr><td width="25%"><center>City:</center> </td><td> <center><strong>   <?php echo $vendor_result['vendor_city'] ?></strong></center></td></tr>
											<tr><td width="25%"><center>GSTIN Number:</center> </td><td> <center><strong><?php echo $vendor_result['vendor_gstin_number'] ?></strong></center></td></tr>
										</table>
									</div>	
								</address>
							</div>
							
							<div class="col-sm-3 invoice-col">
								<address>
									<div class="table-responsive">
										<table class="table table-condensed">
											<tr><td> <center>Address</center></td></tr>
											<tr><td><strong><?php echo $vendor_result['vendor_address'] ?></strong></td></tr>
										</table>
									</div>	
								</address>
							</div>

							<div class="col-sm-4 invoice-col">
								<div class="table-responsive">
									<table class="table table-condensed">
										<tr><td><center>Deals With</center></td></tr>
										<tr><td><strong><?php echo $vendor_result['vendor_brands_dealing']?></strong></td></tr>
										<tr><td><center>Additional Info</center></td></tr>
										<tr><td><strong><?php echo $vendor_result['vendor_additional_info']?></strong></td></tr>
									</table>
								</div>	
							</div>
						</div>
						
						<div class="page-header">
							Brands
						</div>
						<div class="table-responsive">
							<table class="table table-bordered table-condensed table-sm" id="view_vendor_brand_html" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th><center>Brand Name</center></th>
										<th><center>Discount</center></th>
										<th><center>Delete</center></th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sql = "SELECT * FROM vendor_brand vb, brand b where vb.delete_status<>1 and vb.brand_id=b.brand_id and vb.vendor_id= " . $vendor_id;
									$result = mysqli_query($conn,$sql);
									while ($row = mysqli_fetch_array($result))
									{
										// Print out the contents of the entry
										echo '<tr>';										
										echo '<td><center>' . $row['brand_name'] . '</center></td>';
										echo '<td align="center" contenteditable="true" onBlur=\'saveToDatabase(this,"vendor_discount",'. $row['vendor_brand_id'].')\' onClick="showEdit(this)">'.$row['vendor_discount'].'</td>';	
										echo  "<td><center> <a href='../php/delete/delete_vendor_brand.php?id=" . $row['vendor_brand_id'] . "' class='btn btn-danger'>Delete</a></center></td></tr>";										
									}
									?>
								</tbody>
							</table>
						</div>

						<div class="page-header">
						Products
						</div>
						<div class="table-responsive">
							<table class="table table-bordered table-condensed table-sm table-responsive" id="view_vendor_product_html"cellspacing="0" width="100%">
								<thead>
									<tr>
									<th><center>Product Name</center></th>
									<th><center>Product Price</center></th>
									<th><center>Delete</center></th></tr>
								</thead>
								<tbody>
									<?php
									$sql = "SELECT * FROM vendor_product vp, product p where vp.delete_status<>1 and vp.product_id=p.product_id and vp.vendor_id= " . $vendor_id;
									$result = mysqli_query($conn,$sql);
									while ($row = mysqli_fetch_array($result))
									{
										// Print out the contents of the entry
										echo '<tr>';
										echo '<td><center>' . $row['product_name'] . '</center></td>';
										echo '<td align="center" contenteditable="true" onBlur=\'saveToDatabase(this,"product_vendor_price",'. $row['vendor_product_id'].')\' onClick="showEdit(this)">'.$row['product_vendor_price'].'</td>';			
										echo  "<td><center> <a href='../php/delete/delete_vendor_product.php?id=" . $row['vendor_product_id'] . "' class='btn btn-danger'>Delete</a></center></td></tr>";
									}
									?>
								</tbody>
							</table>
						</div>
						
						<!--This row will not appear when printing-->
						<div class="row no-print">
							<div class="col-xs-12">
							</div>
						</div>

						<?php
						$contact_sql = "SELECT * FROM contacts where delete_status<>1 and contact_module_id= " . $vendor_id." and contact_module_name='Vendor'";
						$contact_result = mysqli_query($conn,$contact_sql);
						while ($contact_row = mysqli_fetch_array($contact_result))
						{
							echo '<div class="row invoice invoice-info"> 
							<div class="page-header">
								<center><strong>CONTACTS</strong></center>	
							</div>
							<div class="col-sm-4 invoice-col">
								<address>
									<strong>Person Name:</strong> '. $contact_row["contact_person_name"] .'<br>
									<strong>Contact Number:</strong>  '. $contact_row["contact_person_contact_number"] .'<br>
									<strong>Alternate Number:</strong>  '. $contact_row["contact_person_alternate_contact_number"] .'<br>			
								</address>
							</div>
							<div class="col-sm-4 invoice-col">
								<strong>Email:</strong>  '. $contact_row["contact_person_email"] .'<br>
								<strong>Alternate Email:</strong>  '. $contact_row["contact_person_alternate_email"] .'<br>
							</div>
							</div>';
						}
						?>

						<div class="page-header">
						Files				
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
									$sql = "SELECT * FROM photo p, vendor v where p.delete_status<>1 and p.module_name='vendor' and p.module_id=v.vendor_id and v.vendor_id= " . $vendor_id;
									$result = mysqli_query($conn,$sql);
									while ($row = mysqli_fetch_array($result))
									{
										//Print out the contents of the entry
										if((substr($row['photo_name'], -3))=="pdf")
										{
											echo '<tr><td><center><a href="../uploads/'.$row['photo_name'].'"/>Open PDF Attachment</a></td>';
										}
										else if((substr($row['photo_name'], -4))=="docx")
										{
											echo '<tr><td><center><a href="../uploads/'.$row['photo_name'].'"/>Open Word Attachment</a></td>';
										}
										else if((substr($row['photo_name'], -3))=="doc")
										{
											echo '<tr><td><center><a href="../uploads/'.$row['photo_name'].'"/>Open Word Attachment</a></td>';
										}
										else if((substr($row['photo_name'], -4))=="xlsx")
										{
											echo '<tr><td><center><a href="../uploads/'.$row['photo_name'].'"/>Open Excel Attachment</a></td>';
										}
										else if((substr($row['photo_name'], -3))=="xls")
										{
											echo '<tr><td><center><a href="../uploads/'.$row['photo_name'].'"/>Open Excel Attachment</a></td>';
										}
										else
										{
											echo '<tr><td><center><img width="35%" class="fancybox" height="35%" src="../uploads/'.$row['photo_name'].'"/></center></td>';
										}					
										echo '<td><center><a title="Delete" onclick="return confirm(\"Delete this record?\")" class="btn btn-danger" href="../php/delete/delete_vendor_photo.php?id=' . $row['photo_id'] . '">Delete</a></center></td></tr>';					
									}
									?>
								</tbody>
							</table>
						</div>  
					</div>  
				</div>
			</section>
		</div>

		<!--Main Footer-->
		<footer class="main-footer">
		</footer>

		<!--Including right slide panel-->
		<?php include "../extra/aside.php";?>
		<!--Including right slide panel-->
		<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
		<div class="control-sidebar-bg"></div>
		</div>
		<!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";?>
		<!--Including Bootstrap and other scripts-->

		<!--Add Brand-->
		<div id="add_brand" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!--Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Brand</h4>
					</div>
					<div class="modal-body">
						<!--Brand Name-->
						<div class="form-group">
							<label>Brand Name</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-tag"></i></span>
								<select name="ui_modal_brand_id" id="ui_modal_brand_id" class='form-control select2' required style='width: 100%;'>
									<option selected disabled hidden value="">Select Brand</option>
									<?php
									{ 						
										$sql1 = "SELECT * FROM brand where brand_id NOT IN (select brand_id from vendor_brand where vendor_id=".$vendor_id.") and delete_status<>1";
										$query1 = mysqli_query($conn, $sql1);
										while($row1 = mysqli_fetch_array($query1))
										{
											echo "<option value='" . $row1['brand_id'] . "'>" . $row1['brand_name']." </option>";
										}
									} 
									?>
								</select>
							</div>
						</div>
						<!--Brand Name-->


						<!--Discount-->
						<div class="form-group">
						<label>Discount</label>
						<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-percent"></i></span>
						<input type="text" class="form-control" placeholder="Discount" id="ui_modal_vendor_brand_discount" name="ui_modal_vendor_brand_discount"/>
						</div>
						</div>
						<!--Discount-->
					</div>	  

					<div class="modal-footer">
						<!--Save-->
						<div class="form-group">
							<button class="btn btn-success" type="button" id="modal_submit">Save</button>
						</div>
						<!--Save-->
						
						<!--Close-->
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<!--Close-->
					</div>
				</div>
			</div>
		</div>
		<!--Add Brand-->

		<!--Add Product-->
		<div id="add_product" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!--Modal Content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Product</h4>
					</div>
					<div class="modal-body">
						<!--Product Name-->
						<div class="form-group">
							<label>Product Name</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
								<select name="ui_product_id" id="ui_product_id" class='form-control select2' required style='width: 100%;'>
									<option selected disabled hidden value="">Select Product</option>
									<?php
									{ 						
										$sql1 = "SELECT * FROM product where product_id NOT IN (select product_id from vendor_product where vendor_id=".$vendor_id.") and delete_status<>1";
										$query1 = mysqli_query($conn, $sql1);
										while($row1 = mysqli_fetch_array($query1))
										{
											echo "<option value='" . $row1['product_id'] . "'>" . $row1['product_name']." </option>";
										}
									} 
									?>
								</select>
							</div>
						</div>
						<!--Product Name-->

						<!--Price-->
						<div class="form-group">
							<label>Price</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-money"></i></span>
								<input type="text" class="form-control" placeholder="Price" id="ui_modal_vendor_product_price" name="ui_modal_vendor_product_price"/>
							</div>
						</div>
						<!--Price-->
					</div>	  

					<div class="modal-footer">
						<!--Save-->
						<div class="form-group">
							<button class="btn btn-success" type="button" id="modal_product_submit">Save</button>
						</div>
						<!--Save-->
						
						<!--Close-->
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<!--Close-->
					</div>
				</div>
			</div>
		</div>
		<!--Add Product-->

		<script>
			$(document).ready(function()
			{
				// Handler for .ready() called.
				$("#li_vendor").addClass("active");
				$("#li_vendor_report").addClass("active");

				$('#view_vendor_brand_html').DataTable({
					"aLengthMenu": [[25, 50, 75, 100 , -1], [25, 50, 75, 100, "All"]],
					"iDisplayLength": 0
				});

				$('#view_vendor_product_html').DataTable({
					"aLengthMenu": [[25, 50, 75, 100 , -1], [25, 50, 75, 100, "All"]],
					"iDisplayLength": 0
				});

				$("#modal_submit").click(function()
				{
					var vendor_id= <?php echo $vendor_result['vendor_id'];?>;
					var brand_id= $("#ui_modal_brand_id").val(); 
					var discount= $("#ui_modal_vendor_brand_discount").val();
					$.ajax(
					{
						url: "../php/add_modal/add_vendor_discount_php.php",
						type: "POST", // you can use GET
						data: {vendor_id:vendor_id,brand_id: brand_id, discount: discount}, // post data
						success: function(data)   // A function to be called if request succeeds
						{
							$("#add_brand .close").click();
							window.location.reload();					
							$('#ui_modal_vendor_brand_discount').val("");
							$('#ui_modal_brand_id').val("");
						}
					});
				});

				$("#modal_product_submit").click(function()
				{
					var vendor_id= <?php echo $vendor_result['vendor_id'];?>;
					var product_id= $("#ui_product_id").val(); 
					var product_price= $("#ui_modal_vendor_product_price").val();
					$.ajax(
					{
						url: "../php/add_modal/add_vendor_product_php.php",
						type: "POST", //You can use GET
						data: {vendor_id:vendor_id,product_id: product_id, product_price: product_price}, //Post data
						success: function(data)   //A function to be called if request succeeds
						{
							$("#add_product .close").click();
							window.location.reload();								
						}
					});
				});
			});

			function showEdit(editableObj) 
			{
				jQuery(editableObj).css("background","#FFFFFF");
			} 

			function saveToDatabase(editableObj,column,id) 
			{
				jQuery(editableObj).css("background","#FFFFFF");
				jQuery.ajax({
					url: "../php/live_update/update_vendor_brand.php",
					type: "POST",
					data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
					success: function(data)
					{
						jQuery(editableObj).css("background","#f9f9f9");
					}        
				});
			}
		</script>	
	</body>
</html>