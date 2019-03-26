 <?php
 //export.php
 include '../../dbconnect/dbconnect.php';
 $debug = "1";
 $enquiry_id = $_POST["modal_id"];
 $tbl_name = 'customer_rfq_enquiry';
 if(!empty($_FILES["excel_file"]))
 {
		$debug .=  "2";
      $file_array = explode(".", $_FILES["excel_file"]["name"]);
      if($file_array[1] == "xls" || $file_array[1] == "xlsx" || $file_array[1] == "csv" )
      {
		       $debug .=  "3";
           include("../excel/Classes/PHPExcel/IOFactory.php");
           $output = '';
           $output .= "
                <table class='table table-bordered'>
                     <tr>
                          <th>Product name</th>
                          <th>Description</th>
                          <th>Quantity</th>
                          </tr>
                     ";
           $object = PHPExcel_IOFactory::load($_FILES["excel_file"]["tmp_name"]);
           foreach($object->getWorksheetIterator() as $worksheet)
           {
				        $debug .=  "4";
	              $highestRow = $worksheet->getHighestRow();
                for($row=2; $row<=$highestRow; $row++)
                {
                  $enquiry_status='';
                  $delete_status=0;
      						$enquiry_product_name= mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
      						$enquiry_product_description= mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
      						$enquiry_product_quantity= mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
                  // $enquiry_remarks=mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
      						$delete_status= 0;
					        $query = "INSERT INTO $tbl_name(
                    product_enquiry_id,
                    product_name,
                    product_description,
                    product_quantity,
                    product_remarks,
                    product_status,
                    delete_status,
		    created_at,
		    updated_at
                  )
                    VALUES ($enquiry_id,'$enquiry_product_name','$enquiry_product_description',$enquiry_product_quantity,'','$enquiry_status',$delete_status,CURDATE(),CURDATE())";
					try {
            mysqli_query($conn, $query);
				}
				  catch(Exception $e)
				   { echo $e;}
                     $output .= '
                     <tr>
                          <td><input type="text" class="form-control" id="excel_product_name" name="excel_product_name" style="text-transform:capitalize" value="'.$enquiry_product_name.'"/></td>
                          <td><input type="text" class="form-control" id="excel_price" name="excel_price" style="text-transform:capitalize" value="'.$enquiry_product_description.'"/></td>
						  <td><input type="text" class="form-control" id="excel_quantity" name="excel_quantity" style="text-transform:capitalize" value="'.$enquiry_product_quantity.'"/></td>
                     </tr>
                     ';
                }
           }
           $output .= '</table>';
		    $output .= "  <label class='text-success'><h3>Data Inserted</h3></label> ";
           echo $output;
      }
      else
      {
           echo '<label class="text-danger">Invalid File</label>';
      }
	 // echo $debug;
 }

 ?>

