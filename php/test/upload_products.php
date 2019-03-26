 <?php  
 //export.php  
 include '../../dbconnect/dbconnect.php';
 $debug = "1";
 if(!empty($_FILES["excel_file"]))  
 {  
		$debug .=  "2";
      $file_array = explode(".", $_FILES["excel_file"]["name"]);  
      if($file_array[1] == "xls")  
      { 
		$debug .=  "3";  
		
           include("../excel/Classes/PHPExcel/IOFactory.php");  
           $output = '';  
           $output .= "  
           <label class='text-success'>Data Inserted</label>  
                <table class='table table-bordered'>  
                     <tr>  
                          <th>Product name</th>  
                          <th>Price</th>  
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
                     $product = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(1, $row)->getValue());  
                     $price = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(2, $row)->getValue());  
                     $quantity = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(3, $row)->getValue());  
                     //$postal_code = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(4, $row)->getValue());  
                     //$country = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(5, $row)->getValue());  
                     $query = "  
                     INSERT INTO tbl_customer_test  
                     (CustomerName, Address, City, PostalCode, Country)   
                     VALUES ('".$name."', '".$address."', '".$city."', '".$postal_code."', '".$country."')  
                     ";  
                  //   mysqli_query($conn, $query);  
                     $output .= '  
                     <tr>  
                          <td><input type="text" class="form-control" id="excel_product_name" name="excel_product_name" style="text-transform:capitalize" value="'.$product.'"/></td>  
                          <td><input type="text" class="form-control" id="excel_price" name="excel_price" style="text-transform:capitalize" value="'.$price.'"/></td>  
						  <td><input type="text" class="form-control" id="excel_quantity" name="excel_quantity" style="text-transform:capitalize" value="'.$quantity.'"/></td>  
                     </tr>  
                     ';  
                }  
           }  
           $output .= '</table>';  
           echo $output;  
      }  
      else  
      {  
           echo '<label class="text-danger">Invalid File</label>';  
      }  
	 // echo $debug;  
 }  
 ?>  