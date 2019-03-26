<!DOCTYPE html>
<html>
    <!--Including Login Session-->
    <?php
    include "../extra/session.php";
    $customer_id = $_SESSION['id'];
    $groupId = $_SESSION['groupId'];
    $rfq_draft_id= mt_rand();
    ?>
    <!--Including Login Session-->

    <head>
      <!-- Including Bootstrap CSS links -->
  		<?php include "../extra/header.html";?>
  		<!-- Including Bootstrap CSS links -->

  		<!-- Push Notification-->
  		<script charset="UTF-8" src="//cdn.sendpulse.com/28edd3380a1c17cf65b137fe96516659/js/push/7625e8166a7ca5a1726090cbafc0f211_0.js" async></script>
  		<!-- Push Notification-->

      
      <!-- Stylings of the Page -->
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

        <!-- Scriptings of the page -->
        <script type="text/javascript">
        // autocomplet : Excutes the function On change of the Product Name text
        function autocomplet()
        {
          var min_length = 0; // min caracters to display the autocomplete
          var keyword = $("input[name='modal_product_name']").val();
          keyword=keyword.replace(/ /g,"%");
          if (keyword.length >= 4)
          {
            $.ajax({
              url: '../php/get_product_line_item.php',
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

        // autocomplet : To Edit the autocompleted text
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

        //To set the item of the autoselected prduct
        function set_item(item, id)
      	{
      		// change input value
      		$("input[name='modal_product_name']").val(item);
      		//alert(id);
      		$("input[name='modal_product_id']").val(id);
      		// hide proposition list
      		$("ul[name='products_list']").hide();

      	}

        //Date Picker
        $(function ()
				{
					//Date picker
					$('#ui_rfq_date').datepicker
					({
						format: 'dd/mm/yyyy',
						autoclose: true
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
			<div class="content-wrapper ">
				<!-- Content Header (Page header) -->
				<section class="content-header">

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
									<form action="../php/add/add_pi_request.php" method="POST" enctype = "multipart/form-data"  onsubmit="submit.disabled = true; return true;">

										<!--RFQ Draft ID-->
										<input type="hidden" name="draft_id" id="draft_id" value="<?php echo $rfq_draft_id; ?>"/>
                    <input type="hidden" name="enquired_by" id="enquired_by" value="<?php echo $_SESSION['id']; ?>"/>

                    <!--RFQ Draft ID-->

										<!--RFQ Date-->
										<div class="form-group col-md-3">
											<label>Date</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text"  readonly class="form-control" name="ui_rfq_date" value="<?php echo date("d/m/Y"); ?>" id="ui_rfq_date"/>
											</div>
										</div>
										<!--RFQ Date-->

                    <!--Project Name-->
										<div class="form-group col-md-3">
											<label>Project Name</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-archive"></i></span>
												<select name="ui_project_name" id="ui_project_name" required class='form-control select2' style='width: 100%;'>
													<option selected disabled hidden value="">Select Project</option>
                          <?php
                          if($groupId == $customer_id)
                          {
                            $query = $conn->query("SELECT * FROM customer c,project p where p.customer_id=c.customer_id and p.delete_status<>1 and c.delete_status<>1  and c.subset='".$groupId."'");
                          }
                          else
                          {
                            $query = $conn->query("SELECT * FROM customer WHERE delete_status<>1 and customer_id = ".$customer_id." ");
                          }


                            //Count total number of rows
                            $rowCount = $query->num_rows;

                            //Display states list
                            if($rowCount > 0)
                          {
                                echo '<option value="">Select Project</option>';
                                while($row = $query->fetch_assoc())
                            {
                              if ($row['project_id'] == $project_id)
                                echo '<option value="'.$row['project_id'].'" selected>'.$row['project_name'].'</option>';
                              else
                                echo '<option value="'.$row['project_id'].'" >'.$row['project_name'].'</option>';
                                }
                            }
                          else
                          {
                                echo '<option value="">Project unavailable</option>';
                            }
                          ?>
                        </select>
											</div>
										</div>

                    <!--Assignee Name-->
										<div class="form-group col-md-3">
											<label>Assignee Name</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-archive"></i></span>
												<select name="ui_customer_name" id="ui_customer_name" required class='form-control select2' style='width: 100%;'>
													<option selected disabled hidden value="">Select Person</option>
                          <?php
                            $query = $conn->query("SELECT * FROM customer WHERE subset= ".$groupId." ");

                            //Count total number of rows
                            $rowCount = $query->num_rows;

                            //Display states list
                            if($rowCount > 0)
                          {
                                echo '<option value="">Select Person</option>';
                                while($row = $query->fetch_assoc())
                            {
                              if ($row['customer_id'] == $customer_id)
                                echo '<option value="'.$row['customer_id'].'" selected>Self</option>';
                              else
                                echo '<option value="'.$row['customer_id'].'" >'.$row['customer_name'].'</option>';
                                }
                            }
                          else
                          {
                                echo '<option value="">People unavailable</option>';
                            }
                          ?>
                        </select>
											</div>
										</div>
										<!--Project Name-->
                    <!--PRIORITY-->
                    <div class="form-group col-md-3">
											<label>Project Priority</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-archive"></i></span>
												<select name="ui_project_priority" id="ui_project_priority" required class='form-control select2' style='width: 100%;'>
													<option selected disabled hidden value="">Select Project</option>
                          <option value="LOW">Low</option>
                          <option value="MEDIUM">Medium</option>
                          <option value="HIGH">High</option>
                          <option value="URGENT">Urgent</option>
                          <option value ="CRITICAL">Critical</option>
                        </select>
											</div>
										</div>

										<!--Product Name-->
										<div class="form-group col-md-3">
											<label>RFQ Name</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-archive"></i></span>
                        <input type="text" class="form-control"  name="rfq_name" id="rfq_name" style="text-transform:capitalize" required/>
											</div>
										</div>
										<!--Product Name-->
										<!--EDD Date-->
										<div class="form-group col-md-3">
											<label>Expected Delivery Date</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="date" class="form-control" name="ui_rfq_edd"  id="ui_rfq_edd" required/>
											</div>
										</div>
										<!--RFQ Date-->
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
                      <input type="button" class="btn btn-primary btn-flat" style="cursor: pointer;" data-toggle="modal" data-target="#div_upload_product" value="Upload Excel">
                    </div>
      							<!--RFQ Details-->
										<div class="form-group col-md-12">
											<label>RFQ Details</label>
											<textarea id="rfq_details" name="rfq_details" class="form-control" rows="7"></textarea>
										</div>
										<!--RFQ Details-->

										<!-- File Upload -->
										<!-- <div class="form-group col-md-12">
										<div id="maindiv">
											<div id="formdiv">
                        <h4 class="h4">Attachments</h4>
												First Field is Compulsory. Only JPEG, PNG, JPG, PDF, DOC, DOCX, XLS, XLSX Type files allowed. File Size Should Be Less Than 1.5 MB.
                        <hr/>
                        <h5 class="h5">Upload Product through excel.
                          <button class="btn btn-sm btn-info" style="cursor: pointer;" data-toggle="modal" data-target="#excel_upload">Upload Excel</button>
                        </h5>
                        <hr/> -->
                        <script>
                        function excel_download()
                                {
                                  console.log("Hey There");
                                  // var csvContent = "...csv content...";
                                  // var encodedUri = encodeURI(csvContent);
                                  // var link = document.createElement("a");
                                  // link.setAttribute("href", "data:text/csv;charset=utf-8,\uFEFF" + encodedUri);
                                  // link.setAttribute("download","report.csv");
                                  // link.click();
                                  var downloadLink = document.createElement("a");
                                 downloadLink.download = name;
                                 var uri = encodeURI("data:text/csv;charset=utf-8,item_name,item_quantity,decsription");
                                 downloadLink.href = uri;

                                 document.body.appendChild(downloadLink);
                                 downloadLink.click();
                                 document.body.removeChild(downloadLink);
                                  // window.open("data:text/csv;charset=utf-8,\uFEFF,,")


                                }

                        </script>
<!--
                        <div id="filediv" align="center" style="display:block"><input name="file[]" type="file" id="file"/></div><br/>
												<input type="button" id="add_more" class="upload" value="Add More Files"/>
											</div>
										</div>
										</div> -->
										<!-- File Upload -->

										<!-- Save -->
										<div class="col-lg-offset-10 col-lg-2">
										<button type="submit" data-loading-text="Please Wait..." class="btn btn-success form-control" name = 'btn' onclick="sendValue()">Save  </button>
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
    					 <a href="../test/pi_upload.csv" download>Download Format</a>
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
    					<button id="submit" type="submit" id="close_upload_product_submit" name="close_upload_product_submit"class="btn btn-default pull-right" data-dismiss="modal" onclick="fetch_enquiry_products_after_add('<?php echo $rfq_draft_id; ?>')">Close</button>
    				</div>
    			</div>
    		</div>
    	</div>
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
                        <input type="text" class="form-control" id="modal_product_name" name="modal_product_name" autocomplete="off" style="text-transform:capitalize" onkeyup="autocomplet()" required/>
      								</div>
      								<!--Product Name-->
      							</div>
                    <ul name="products_list" id="products_list"></ul>

                    <!-- Modal Prduct Id -->

                    <input type="hidden" id="modal_product_id" name="modal_product_id"/>

                    <input type="hidden" >

      							<!--Description-->
      							<div class="col-md-12">
      								<div class="form-group">
      									<label>Description</label>
      									<textarea class="form-control" id="modal_product_description" name="modal_product_description"></textarea>
      								</div>
      							</div>
      							<!--Description-->



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
      					<button id="submit" type="submit" id="close_line_items_modal" name="close_line_items_modal"class="btn btn-default pull-right" data-dismiss="modal">Close</button>
      				</div>
      			</div>
      		</div>
      	</div>
      	<!-- Add Line Item Modal -->
        <script>
          $("#save_line_item_submit").click(function() {
            console.log("In the Enquiry Save Line item Function 461");
            var draft_id= $("#draft_id").val();
            var product_id=$("#modal_product_id").val();
            var product_name= $("#modal_product_name").val();
            var product_description= $("#modal_product_description").val();
            var product_quantity= $("#modal_product_quantity").val();
            var product_remarks = $("#modal_product_remarks").val();

            $.ajax(
            {
              url: "../php/add_model/add_customer_enquiry_product.php",
              type: "POST", // you can use GET
              data: {draft_id: draft_id, product_id:product_id ,product_name: product_name, product_description: product_description, product_quantity:product_quantity,product_remarks:product_remarks}, // post data
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

          function fetch_enquiry_products_after_add(draft_id)
        	{
        		$.ajax({
        			type: "POST",
        			dataType: "html",
        			url: "../php/get/get_customer_enquiry_product.php",
        			data: {draft_id:draft_id},
        			cache: false,
        			beforeSend: function()
        			{
        				$('#enquiry_line_item_div').html('loading please wait...');
        			},
        			success: function(htmldata)
        			{
        				$('#enquiry_line_item_div').html(htmldata);
                $('#result').html('');

        			}
        		});
        	}
        </script>
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
		 <?php
		   include "../extra/footer.html";
       ob_end_flush();
		 ?>
		<!--Including Bootstrap and other scripts-->
    <script>
    $(document).on('click', '#upload_product_submit', function(){
          $('#export_excel').submit();
      });
       $('#export_excel').on('submit', function(event){
         event.preventDefault();

        console.log("Entered Upload Block");
        var modal_id=$("#draft_id").val();
        console.log(modal_id);
        var formData = new FormData(this);

        formData.append('modal_id', modal_id);
         $.ajax({

          url:"../test/export.php",
          method:"POST",
          data:formData,
          contentType:false,
          processData:false,
          success:function(data){
            console.log("Data Successfully Uploaded");
            $('#result').html(data);
            $('#excel_file').val('');
          }

         });
      });
    </script>
		<script>
    $(document).ready(function()
		{
			// Handler for .ready() called.
			$("#li_rfq").addClass("active");
			$("#li_add_rfq").addClass("active");

		});
    </script>
	</body>
</html>
