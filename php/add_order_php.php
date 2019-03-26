<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';

	//Table Names 
	$tbl_ss_order = "ss_order";
	$tbl_order_product ="order_product";
	$tbl_order_transport ="order_transport";
	$tbl_order_account ="order_account";
	$tbl_order_product_clone ="order_product_clone";
	
	$error=0;

	//Store Posted Data To PHP Variable
	$date = explode('/', mysqli_real_escape_string($conn,$_POST['ui_order_date']));
	$time = mktime(0,0,0,$date[1],$date[0],$date[2]);
	$order_date = date( 'Y-m-d', $time );
	$draft_id= mysqli_real_escape_string($conn,$_POST['draft_id']);
	$vendor_id= mysqli_real_escape_string($conn,$_POST['ui_vendor_name']);
	$customer_id= mysqli_real_escape_string($conn,$_POST['ui_customer_name']);
	$project_id= mysqli_real_escape_string($conn,$_POST['ui_project_name']);
	$order_placed_by= mysqli_real_escape_string($conn,$_POST['ui_order_placed_by']);
	$confirmation_type= mysqli_real_escape_string($conn,$_POST['ui_confirmation_type']);
	$order_assignee_name= mysqli_real_escape_string($conn,$_POST['ui_assignee_name']);
	$order_status= mysqli_real_escape_string($conn,$_POST['ui_order_status']);
	$order_remarks= mysqli_real_escape_string($conn,$_POST['ui_order_remarks']);

	//User Name Who Submitted The Data
	$order_by=mysqli_real_escape_string($conn,$_POST['user_id']);
	$location=mysqli_real_escape_string($conn,$_POST['location']);
	
	//Insert Query
	$query1 = "INSERT INTO $tbl_ss_order(vendor_id,customer_id,project_id,order_date,order_placed_by,order_confirmation_type,order_assignee,order_status,order_remarks,data_entered_by,location,delete_status) VALUES ('$vendor_id','$customer_id','$project_id','$order_date','$order_placed_by','$confirmation_type','$order_assignee_name','$order_status','$order_remarks','$order_by','$location',0)";
	
	//Execute The Query
	if(mysqli_query($conn, $query1))
	echo mysqli_error($conn);
	$error=1;

	//Get Last Inserted ID
	$last_inserted_id=mysqli_insert_id($conn);
		
	$j = 0; //Variable for indexing uploaded image 
    for ($i = 0; $i < count($_FILES['file']['name']); $i++) 
	{//loop to get individual element from the array
		$target_path = "../../uploads/"; //Declaring Path for uploaded images
        $validextensions = array("jpeg", "jpg", "png","pdf","doc","docx","xlsx","xls","txt","JPEG", "JPG", "PNG","PDF","DOC","DOCX","XLSX","XLS","TXT");  //Extensions which are allowed
        $ext = explode('.', basename($_FILES['file']['name'][$i]));//explode file name from dot(.) 
		echo "Ext". $ext."</br>";
        $file_extension = end($ext); //store extensions in the variable
        $filename=md5(uniqid());
		echo "Filename: ".$filename."</br>";
		$target_path = $target_path .  $filename . "." . $ext[count($ext) - 1];//set the target path with a new name of image
        $j = $j + 1;//increment the number of uploaded images according to the files in array       
      
	  if (($_FILES["file"]["size"][$i] < 10000000) && in_array($file_extension, $validextensions)) //Approx 10 MB File size
		{
            if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) 
			{
				$image_name= $filename. "." . $ext[count($ext) - 1];
				echo $filename;
				//Insert Query
				$query3="INSERT INTO `photo` (module_id,module_name,photo_name) VALUES ('$last_inserted_id','order','$image_name')"; 

				//Execute The Query
				if (mysqli_query($conn, $query3)) 
				{
				$error=1;
				}
				echo mysqli_error($conn);
				//if file moved to uploads folder
                echo '<br/><br/><span id="noerror">Image uploaded successfully!.</span><br/><br/>';
				$image_name="";
				$target_path="";
            } 
			else 
			{
				//if file was not moved.
                echo '<br/><br/><span id="error">please try again!.</span><br/><br/>';
            }
        } 
		else 
		{
			//if file size and file type was incorrect.
            echo '<br/><br/><span id="error">***Invalid file Size or Type***</span><br/><br/>';
        }
    }
	
	
	//Store Posted Data To PHP Variable
	$v_transportation_type=mysqli_real_escape_string($conn,$_POST['ui_transport_type']);
	$v_transportation_charge=mysqli_real_escape_string($conn,$_POST['ui_transport_charge']);
	$v_delivery_status=mysqli_real_escape_string($conn,$_POST['ui_delivery_status']);
	$date = explode('/', mysqli_real_escape_string($conn,$_POST['ui_delivery_date']));
	$time = mktime(0,0,0,$date[1],$date[0],$date[2]);
	$v_delivery_date = date( 'Y-m-d', $time );
	$v_delivery_remarks=mysqli_real_escape_string($conn,$_POST['ui_delivery_remarks']);

	//Insert Query
	$query3 = "INSERT INTO $tbl_order_transport(order_id,order_transportation_type,order_transportation_charge,order_delivery_status,order_delivery_date,order_delivery_remarks,delete_status) VALUES ('$last_inserted_id','$v_transportation_type','$v_transportation_charge','$v_delivery_status','$v_delivery_date','$v_delivery_remarks',0)";	

	//Execute The Query
	if(mysqli_query($conn, $query3)) echo mysqli_error($conn);
	$error=1;

	//Store Posted Data To PHP Variable
	$v_estimate_number=mysqli_real_escape_string($conn,$_POST['ui_estimate_number']);
	$v_e_sugam_number=mysqli_real_escape_string($conn,$_POST['ui_e_sugam_number']);
	$v_purchase_bill_number=mysqli_real_escape_string($conn,$_POST['ui_purchase_bill_number']);
	$v_ss_invoice_number=mysqli_real_escape_string($conn,$_POST['ui_ss_invoice_number']);

	//Insert Query
	$query4 = "INSERT INTO $tbl_order_account(order_id,order_estimate_number,order_e_sugam_number,order_purchase_bill_number,order_ss_invoice_number,delete_status) VALUES ('$last_inserted_id','$v_estimate_number','$v_e_sugam_number','$v_purchase_bill_number','$v_ss_invoice_number',0)";	

	//Execute The Query
	if(mysqli_query($conn, $query4)) echo mysqli_error($conn);
	$error=1;
	
	
	
	$order_prod_sql = "SELECT * FROM order_product where order_id='$draft_id'";
	echo $order_prod_sql;
	$result_product_clone = mysqli_query($conn, $order_prod_sql);		
	echo mysqli_error($conn);
	$row_product_clone=mysqli_num_rows($result_product_clone);
	
	
	for($i=0;$i<$row_product_clone;$i++)
	{
	//Update Query
	$query5="UPDATE $tbl_order_product SET order_id=".$last_inserted_id." WHERE order_id='$draft_id'";
	echo $query5;
	//Execute The Query
	if(mysqli_query($conn, $query5)) 
	echo mysqli_error($conn);
	$error=1;
	}
	
	if($error==1)
	{
		//On Successful
		header("Location:../../html/edit_order_html.php?id=". $last_inserted_id . "");
	}
	else
	{
		//On Error 
		$_SESSION['error']=mysqli_error($conn);
		header("Location:../../extra/error.php");
	}
	//Close Mysqli Connection
	mysqli_close($conn);
?>