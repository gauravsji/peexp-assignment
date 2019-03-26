<!DOCTYPE html>
<html>
<!--Including Login Session-->
<?php include "../extra/session.php";
	$product_set_id=$_GET["id"];
	$sql = "SELECT * FROM product_set where delete_status<>1 and product_set_id = " . $product_set_id;
	$result = mysqli_query($conn, $sql);
	$product_result = mysqli_fetch_array($result,MYSQLI_ASSOC);

	$sql4 = "SELECT * FROM product_set_attribute where delete_status<>1 and product_set_id = " . $product_set_id;
	$product_attr_result = mysqli_query($conn, $sql4);

	?>
<!--Including Login Session-->

<head>
    <!--Including Bootstrap CSS links-->
    <?php include "../extra/header.html";?>
    <!--Including Bootstrap CSS links-->

	
<script type="text/javascript" src="../dist/js/line_items_script.js"></script>

	<script type="text/javascript">
		$(document).ready(function()
		{
			
			$("[name='ui_attribute_id']").attr("disabled", true);// attr("disabled", true); 
			
			
	// Handler for .ready() called.
	$("#li_product").addClass("active");
	$("#li_add_product_set").addClass("active");

			$('#ui_category_id').on('change',function()
			{
				var catID = $(this).val();
				if(catID)
				{
					$.ajax(
					{
						type:'POST',
						url:'../php/ajaxData.php',
						data: { p_Category: catID,p_Subcategory:''},
						success:function(html)
						{
							$('#ui_sub_category_id').html(html);
						}
					}); 
				}
				else
				{
					$('#ui_sub_category_id').html('<option value="">Select category first</option>');
				}
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

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
        Edit Product Set <a href="../reports/product_set_report_html.php" class="btn pull-right btn-sm btn-primary">Product Set Report</a>
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
                            <div class="box-body pad">
                                <form action="../php/update/update_product_set_php.php" method="POST" enctype="multipart/form-data" onsubmit="submit.disabled = true; return true;">
                                   
									<input type="hidden" name="ui_product_set_id" id="ui_product_set_id" value="<?php echo $product_set_id;  ?>"/>
									
									<!--Category Name-->
									<div class="form-group col-md-3">
									 <label>Category Name</label>
									  <div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-server"></i></span>
									<select name="ui_category_id" id="ui_category_id" class='form-control select2' style='width: 100%;'>
										<option selected disabled hidden>Select Category</option>
									  	<?php
										{
											$sql = "SELECT * from category where delete_status<>1";
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query))
											{
												if ($row['category_id'] == $product_result['category_id']):
												{
												echo "<option value='" . $row['category_id'] . "' selected>" . $row['category_name']. "</option>";
												}
												else:
												{
													echo "<option value='" . $row['category_id'] . "'>" . $row['category_name']. "</option>";
												}
												endif;
											}
										} 
										?>
									</select>
									</div>
									</div>
									<!--Category Name-->

									<!--Sub Category Name-->
									<div class="form-group col-md-3">
										<label>Sub Category Name</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-clone"></i></span>
											<select name="ui_sub_category_id" id="ui_sub_category_id" class='form-control select2' required style='width: 100%;'>
											<option hidden>Select Category</option>
											<?php
										{
											$sql = "SELECT * from sub_category where delete_status<>1";
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query))
											{
												if ($row['sub_category_id'] == $product_result['sub_category_id']):
												{
												echo "<option value='" . $row['sub_category_id'] . "' selected>" . $row['sub_category_name']. "</option>";
												}
												else:
												{
													echo "<option value='" . $row['sub_category_id'] . "'>" . $row['sub_category_name']. "</option>";
												}
												endif;
											}
										} 
										?>
											</select>
										</div>
									</div>
									<!--Sub Category Name-->

									<!--Product Name-->
									<div class="form-group col-md-3">
									 <label>Product Set Name</label>
									  <div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
									  <input type="text" class="form-control" placeholder="Product Name" id="ui_product_set_name" name="ui_product_set_name" maxlength="70" value="<?php echo $product_result['product_set_product_name'];  ?>"/>
									</div>
									</div>
									<!--Product Name-->
									
									<!--Defaut Size-->
									<div class="form-group col-md-3">
										<label>Defaut Size</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-arrows-h"></i></span>
												<input type="text" class="form-control" id="ui_default_size" name="ui_default_size" value="<?php echo $product_result['product_set_default_size'];  ?>"/>
										</div>
									</div>
									<!--Defaut Size-->
									
									<!--Description-->
									<div class="form-group col-md-6">
										<label>Description</label>
										<textarea class="form-control" rows="3" placeholder="Ex: CenturyPly IS:710 Marine Grade ply" id="ui_product_set_description" name="ui_product_set_description" ><?php echo $product_result['product_set_description'];  ?></textarea>
									</div>									
									<!--Description-->		
		
									<!--Tax-->
									<div class="form-group col-md-3">
									 <label>Tax</label>
									  <div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-percent"></i></span>
									<select name="tax" id="tax" class='form-control select2' required style='width: 100%;'>
										<option selected disabled hidden value="">Select Tax</option>
										
										<?php
										{
											$sql ="SELECT * FROM key_value where key_column = 'TAX' and delete_status<>1";
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query))
											{
												if ($row['value'] == $product_result['product_set_tax']):
												{
												echo "<option value='" . $row['value'] . "' selected>" . $row['value']. "</option>";
												}
												else:
												{
													echo "<option value='" . $row['value'] . "'>" . $row['value']. "</option>";
												}
												endif;
											}
										} 
										?>
										
									</select>
									</div>
									</div>
									<!--Tax-->
									
									<!--Unit Of Measurement-->
									<div class="form-group col-md-3">
									 <label>Unit Of Measurement</label>
									  <div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-user"></i></span>
									<select name="ui_unit_of_measurement" id="ui_unit_of_measurement" class='form-control select2' style='width: 100%;'>
										<option selected disabled hidden>Select Unit</option>
										
										<?php
										{
											$sql ="SELECT * FROM key_value where key_column = 'UNIT_OF_MEASUREMENT' and delete_status<>1";
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query))
											{
												if ($row['value'] == $product_result['product_set_unit_of_measurement']):
												{
												echo "<option value='" . $row['value'] . "' selected>" . $row['value']. "</option>";
												}
												else:
												{
													echo "<option value='" . $row['value'] . "'>" . $row['value']. "</option>";
												}
												endif;
											}
										} 
										?>
										
									</select>
									</div>
									</div>
									<!--Unit Of Measurement-->
									
									<!-- Installation Needed-->
									<div class="form-group col-md-12">
									<div class="input-group">
										<label>
											<input type="checkbox" value="yes" <?php if($product_result['product_set_installation'] == 'yes'){ ?> checked <?php } ?> name="installation_needed" id="installation_needed" class="flat-red">
											&nbsp;&nbsp;Installation Needed
										</label>
										</div>
									</div>
									 <!--Installation Needed-->
									 
									 
									 	<!--Certify-->
									<div class="form-group col-md-3">
										<label>Active/Inactive</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-check"></i></span>
											<select name="ui_certify" id="ui_certify" class='form-control selectpicker' style='width: 100%;'>
												<option value="">Select</option>																	
												
										<?php
										{
											$sql1 = "SELECT * from product_set";
											$query1 = mysqli_query($conn, $sql1);
											while($row = mysqli_fetch_array($query1))
											{
												if ($row['product_set_id'] == $product_result['product_set_id']):
												{
													if ($product_result['certify']=='Active'):
													{
														echo '<option value="Active" selected>Active</option>';
														echo '<option value="Inactive">Inactive</option>';														
													}	
													endif;
													if ($product_result['certify']=='Inactive'):
													{
														echo '<option value="Active">Active</option>';
														echo '<option value="Inactive" selected>Inactive</option>';
													}	
													endif;
													if ($product_result['certify']!='Active' && $product_result['certify']!='Inactive'):
													{
														echo '<option value="Active">Active</option>';
														echo '<option value="Inactive">Inactive</option>';
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
									<!--Certify-->
									 
							
									<div class="form-group col-md-12">								
										<fieldset class="row2">
										<label>Attribute</label>
										<div class="table-responsive">
											<table id="dataTable" class="table table-fixed table-condensed table-bordered" border="0" style="overflow: scroll;">
												<tbody>
													<?php while ($product_at = mysqli_fetch_array($product_attr_result,MYSQLI_ASSOC)) {?>
													<tr>
														<p>
														
														<td>
															<input type="hidden" name="ui_psattribute_id[]" value="<?php echo $product_at['product_set_attribute_id'];  ?>"/>
														</td>
														<td>
															<!--Attribute Name-->
															<div class="form-group">
																<label>Attribute Name</label>
																<div  class="input-group ">
																	<select name="ui_attribute_id[]" class='form-control selectpicker' style='width: 100%;'>
																	<option selected disabled hidden>Select Attribute Name</option>
																	<?php
																	{
																		$sqlu = "SELECT * FROM key_value where key_column = 'ATTRIBUTE' and delete_status<>1";
																		$queryu = mysqli_query($conn, $sqlu);
																		while($roww = mysqli_fetch_array($queryu))
																		{
																			if($product_at['product_set_attribute_id_fk_key_value']==$roww['key_value_id'])
																			{
																				echo "<option value='" . $roww['key_value_id'] . "' selected>" . $roww['value']. "</option>";
																			}
																			else
																			{
																				echo "<option value='" . $roww['key_value_id'] . "' >" . $roww['value']. "</option>";
																			}
																		}
																	} 
																	?>
																	</select>																	
																</div>
																<div class="has-error">
																	<span class="help-block">Do Not Change This, it won't Change</span>	</div>		
																</div>													
															</div>
															
															<!--Attribute Name-->
														</td>
														<td>
															<label for="DESCRIPTION">Attribute Value</label>
															<input type="text" class="form-control" required="required" name="ui_attribute_value[]" value="<?php echo $product_at['product_set_attribute_value'];  ?>" >
														</td>

														<td>
															<label for="SELLING_PRICE">Delete</label>
															<input type='button' class="form-control btn btn-danger btn-flat" value="Remove" onClick="Editdeletethisrow('dataTable',this)">
														</td>

														</p>
													</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
								
								<div class="form-group col-md-12">
									<input type="button" class="btn btn-primary btn-flat" value="Add Attribute" onClick="EditaddRow('dataTable')" /> 
								</div>
								
								
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
											<input id="user_id" name="user_id" type="hidden" value="<?php echo $user_result['id'];?>" />
										<!-- User ID -->
										
								
											<div class="col-lg-offset-10 col-lg-2">
										<button type="submit" data-loading-text="Please Wait..." class="btn btn-success form-control">Update  </button>
									</div>
																		
                                   <!-- <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-primary btn-flat">Update</button>
                                    </div>-->

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
</body>

</html>