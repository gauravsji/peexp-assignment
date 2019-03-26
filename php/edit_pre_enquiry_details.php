<?php
require_once("../dbconnect/dbconnect.php");
$enquiry_id=$_POST['enquiry_id'];
$fetch_data = "SELECT * FROM pre_enquiry_details where pre_enquiry_id=".$enquiry_id;
$fetch_edit = mysqli_query($conn,$fetch_data);
while ($rowss = mysqli_fetch_array($fetch_edit))
{
?>
		<!--Enquiry Date-->
		<div class="form-group col-md-4">
			<label>Enquiry Date</label>
			<div class="input-group date">
				<div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				</div>
				<input type="text" readonly class="form-control" name="edit_enquiry_date" value="<?php echo date("d/m/Y"); ?>" id="edit_enquiry_date" disabled/>
			</div>
		</div>
		<input type="hidden" class="form-control" name="edit_enquiry_id" value="<?php echo $rowss['pre_enquiry_id'] ?>" id="edit_enquiry_id"/>
		<!--Enquiry Date-->
		<!--Customer Name-->
		<div class="form-group col-md-4">
			<label>Customer Name</label>
			<input type="text" class="form-control" style="text-transform:capitalize" id="edit_customer_name" name="edit_customer_name" value="<?php echo $rowss['customer_name'];?>" placeholder="Customer name require" required/>
		</div>
		<!--Customer Name-->

		<!--Customer Name-->
		<div class="form-group col-md-4">
			<label>Enquiry Name</label>
			<input type="text" class="form-control" style="text-transform:capitalize" id="edit_enquiry_name" name="edit_enquiry_name" value="<?php echo $rowss['enquiry_name'];?>" placeholder="Enquiry name require" required/>
		</div>
		<!--Customer Name-->

		<div class="form-group col-md-4">
			<label>Priority</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-star"></i></span>
				<select name="edit_enquiry_priority" id="edit_enquiry_priority" class='form-control select2' style='width: 100%;'>
					<option disabled hidden>Select</option>
					<option value="LOW" <?php if($rowss['enquiry_priority']=='LOW'){ echo 'selected';} ?>>LOW</option>
					<option value="MEDIUM" <?php if($rowss['enquiry_priority']=='MEDIUM'){ echo 'selected';} ?>>MEDIUM</option>
					<option value="HIGH" <?php if($rowss['enquiry_priority']=='HIGH'){ echo 'selected';} ?>>HIGH</option>
					<option value="CRITICAL" <?php if($rowss['enquiry_priority']=='CRITICAL'){ echo 'selected';} ?>>CRITICAL</option>
				</select>
			</div>
		</div>

		<!--Contact Number-->
		<div class="form-group col-md-4">
			<label>Contact Number</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
				<input type="text" class="form-control" placeholder="Ex: 9876543210" onkeypress='return event.charCode>= 48 && event.charCode <= 57' id="edit_contact_number" maxlength="50" name="edit_contact_number" type="text" value="<?php echo $rowss['contact_number'];?>" required />
			</div>
		</div>
		<!--Contact Number-->
		<!--Email-->
		<div class="form-group col-md-4">
			<label>Email</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
				<input type="email" class="form-control" placeholder="Ex: abc@gmail.com" style="text-transform:lowercase" id="edit_customer_email"  maxlength="100" name="edit_customer_email" type="text" value="<?php echo $rowss['customer_email'];?>" required placeholder="Email required" />
			</div>
		</div>
		<!--Email-->
		<div class="form-group col-md-3">
			<label>Assignee Sales</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
				<select name="edit_sales_assignee_name" id="edit_sales_assignee_name" class='form-control' style='width: 100%;'>
				<option selected disabled hidden>Select Sales</option>
				<option value="Kunal" <?php if($rowss['sales_assignee_name']=='Kunal'){ echo 'selected';} ?>>Kunal</option>
				<option value="Aishwarya" <?php if($rowss['sales_assignee_name']=='Aishwarya'){ echo 'selected';} ?>>Aishwarya</option>
				<option value="Apoorva" <?php if($rowss['sales_assignee_name']=='Apoorva'){ echo 'selected';} ?>>Apoorva</option>
				</select>
			</div>
		</div>
		<div class="form-group col-md-3">
			<label>Assignee Vendor</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
				<select name="edit_vendor_assignee_name" id="edit_vendor_assignee_name" class='form-control select2' style='width: 100%;'>
				<option selected disabled hidden>Select Sales</option>
				<option value="Varun" <?php if($rowss['vendor_assignee_name']=='Varun'){ echo 'selected';} ?>>Varun</option>
				<option value="Naureen" <?php if($rowss['vendor_assignee_name']=='Naureen'){ echo 'selected';} ?>>Naureen</option>
				<option value="Chirag" <?php if($rowss['vendor_assignee_name']=='Chirag'){ echo 'selected';} ?>>Chirag</option>
				</select>
			</div>
		</div>
		<!--Assignee Name-->
		<!--Assignee Name-->
		<div class="col-md-3 form-group" style="margin-top: 25px;">
			<label class="checkbox-inline">
			<input type="checkbox" name="edit_need_sample" id="edit_need_sample" value="yes" style="margin-top: 1px;" <?php if($rowss['need_sample']=='yes'){ echo 'checked';} ?>><span>Need sample</span></label>
		</div>
		<div class="col-md-3 form-group" style="margin-top: 25px;">
			<label class="checkbox-inline">
			<input type="checkbox" id="edit_need_alternate" name="edit_need_alternate" value="yes" style="margin-top: 1px;" <?php if($rowss['need_alternate']=='yes'){ echo 'checked';} ?>><span">Need alternate</span></span">
		</div>
		<?php
	}
	?>
		<div class="col-md-4 form-group"></div>
		<div class="col-md-12 form-group">
			<fieldset class="row2">
				<center><label>Product Details</label></center>
				<div class="table-responsive">
					<table id="edit_products" class="table table-fixed table-condensed table-bordered" border="0" style="overflow: scroll;">
					<tbody>
					<?php
					$fetch_data = "SELECT * FROM pre_enquiry_product where pre_enquiry_id=".$enquiry_id;
					$fetch_edit = mysqli_query($conn,$fetch_data);
					while ($rowss = mysqli_fetch_array($fetch_edit))
					{
					?>
					<tr>
						<p>
						<td>
						<input type="hidden" class="form-control" name="edit_enquiry_product_id" value="<?php echo $rowss['pre_enquiry_product_id'] ?>" id="edit_enquiry_product_id"/>
							<center><label for="product_name">Product Name</label></center>
							<input type="text" class="form-control" style="text-transform:capitalize" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode==32' name="edit_pro_name" value="<?php echo $rowss['pro_name'];?>" disabled/>
						</td>
						<td>
							<center><label for="cate_description">Descriptions</label></center>
							<input type="text" class="form-control" name="edit_pro_description" value="<?php echo $rowss['pro_description'] ?>" disabled/>
						</td>
						<!--Quantity-->
						<td>
							<center><label for="Quantity">Quantity</label></center>
								<input type="text" class="form-control" id="edit_pro_quantity" name="edit_pro_quantity" maxlength="50" onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46' value="<?php echo $rowss['pro_quantity'];?>" />
						</td>
						<td>
							<center><label for="contact_delete">Action</label></center>
							<input type='button' name="contact_delete" class="form-control btn btn-danger btn-flat" value="Remove" onClick="deletethisrow('edit_products',this)">
						</td>
						</p>
					</tr>
					<?php
				}
				?>
				
				</tbody>
			</table>
		</div>
		</fieldset>
	</div>
	
			<div class="form-group col-md-12">
				<input type="button" class="btn btn-primary btn-flat" id="edit_new_row" value="Add Products"/> 
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

<script>
  $("#edit_new_row").on('click',function(){
    var data="<tr><td>\n\
				<input type='hidden' class='form-control' name='edit_enquiry_product_id' value='' id='edit_enquiry_product_id'/>\n\
							<center><label for='product_name'>Product Name</label></center>\n\
							<input type='text' class='form-control' style='text-transform:capitalize' onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode==32' name='edit_pro_names' value=''/>\n\
						</td>\n\
						<td>\n\
							<center><label for='cate_description'>Descriptions</label></center>\n\
							<input type='text' class='form-control' name='edit_pro_descriptions' value='' />\n\
						</td>\n\
						<!--Quantity-->\n\
						<td>\n\
							<center><label for='Quantity'>Quantity</label></center>\n\
								<input type='text' class='form-control' id='edit_pro_quantity' name='edit_pro_quantitys' maxlength='50' onkeypress='return event.charCode>= 48 && event.charCode <= 57 || event.charCode ==46' value=''/>\n\
						</td>\n\
						<td>\n\
							<center><label for='contact_delete'>Action</label></center>\n\
							<input type='button' name='contact_delete' class='form-control btn btn-danger btn-flat removepara' value='Remove' >\n\
						</td>\n\
						</tr>";
        $('#edit_products').append(data);
});
  	$("body").on("click", ".removepara", function () {
		$(this).parent().parent().remove();
	});
</script>