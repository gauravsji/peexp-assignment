<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';
	include '../../php/add/add_activity_log.php';
	
	//Table names 
	$tbl_enquiry = "enquiry"; 
	$tbl_enquiry_product="enquiry_product";	
	$error=0;

	//Store Posted Data To PHP Variable
	$draft_id= mysqli_real_escape_string($conn,$_POST['draft_id']);
	$date = explode('/', mysqli_real_escape_string($conn, $_POST['ui_enquiry_date']));
	$time = mktime(0,0,0,$date[1],$date[0],$date[2]);
	$enquiry_date = date( 'Y-m-d', $time );	

	if(!(isset($_POST['ui_customer_name'])))
	{
		$customer_id = 'NULL';
	}      
	else $customer_id =  mysqli_real_escape_string($conn,$_POST['ui_customer_name']);

	if(!(isset($_POST['ui_project_name'])))
	{
		$project_id = 'NULL';
	}      
	else $project_id =  mysqli_real_escape_string($conn,$_POST['ui_project_name']);

	if(!(isset($_POST['ui_sales_lead'])))
	{
		$sales_lead_id = 'NULL';
	}      
	else 
	{
		$sales_lead_id =  mysqli_real_escape_string($conn,$_POST['ui_sales_lead']);
	}	
	$enquiry_name=  ucwords(mysqli_real_escape_string($conn,$_POST['enquiry_name']));
	$enquiry_details= mysqli_real_escape_string($conn,$_POST['enquiry_details']);
	$assignee_name= mysqli_real_escape_string($conn,$_POST['ui_assignee_name']);
	$enquiry_status= mysqli_real_escape_string($conn,$_POST['ui_enquiry_status']);
	$enquiry_priority= mysqli_real_escape_string($conn,$_POST['ui_enquiry_priority']);
	$user_id= mysqli_real_escape_string($conn,$_POST['user_id']);
	$location= mysqli_real_escape_string($conn,$_POST['location']);
	$transport_charge= mysqli_real_escape_string($conn,$_POST['transport_charge']);

	
	//Insert Query
	$query1 = "INSERT INTO $tbl_enquiry(customer_id,project_id,sales_lead_id,enquiry_date,enquiry_name,enquiry_details,enquiry_transport_charge,enquiry_assignee,enquiry_status,enquiry_priority,data_entered_by,location,created_date, last_update_date, delete_status) VALUES ($customer_id,$project_id,$sales_lead_id,'$enquiry_date','$enquiry_name','$enquiry_details','$transport_charge','$assignee_name','$enquiry_status','$enquiry_priority','$user_id','$location',CURDATE(),CURDATE(),0)";
	
	//Execute The Query
	if (mysqli_query($conn, $query1)) 
	{
	$error=1;
	}
	else
	{
			echo "Error: ".mysqli_error($conn);
	}
	$last_inserted_id=mysqli_insert_id($conn);
	$enquiry_prod_sql = "SELECT * FROM enquiry_product where enquiry_id='$draft_id'";
	$result_product_clone = mysqli_query($conn, $enquiry_prod_sql);		
	$row_product_clone=mysqli_num_rows($result_product_clone);
		
	for($i=0;$i<$row_product_clone;$i++)
	{
		//Update Query
		$query5="UPDATE $tbl_enquiry_product SET enquiry_id=".$last_inserted_id." WHERE enquiry_id='$draft_id'";
		//Execute The Query
		if(mysqli_query($conn, $query5))
		{
			$error=1;
		}
		else
		{
			echo mysqli_error($conn);
		}
		
	}	

	$j = 0; //Variable for indexing uploaded image 
    for ($i = 0; $i < count($_FILES['file']['name']); $i++) 
	{
		//loop to get individual element from the array
		$target_path = "../../uploads/"; //Declaring Path for uploaded images
        $validextensions = array("jpeg", "jpg", "png","pdf","doc","docx","xlsx","xls","txt","JPEG", "JPG", "PNG","PDF","DOC","DOCX","XLSX","XLS","TXT");  //Extensions which are allowed
        $ext = explode('.', basename($_FILES['file']['name'][$i]));//explode file name from dot(.) 
        $file_extension = end($ext); //store extensions in the variable
        $filename=md5(uniqid());		
		$target_path = $target_path .  $filename . "." . $ext[count($ext) - 1];//set the target path with a new name of image
        $j = $j + 1;//increment the number of uploaded images according to the files in array       
      
	  if (($_FILES["file"]["size"][$i] < 10000000) && in_array($file_extension, $validextensions)) //Approx 10 MB File size
		{
            if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) 
			{
				
				$image_name= $filename. "." . $ext[count($ext) - 1];
				
				//Insert Query
				$query3="INSERT INTO `photo` (module_id,module_name,photo_name) VALUES ('$last_inserted_id','enquiry','$image_name')"; 

				//Execute The Query
				if (mysqli_query($conn, $query3)) 
				{
					$error=1;
				}
				else
				{
					echo mysqli_error($conn);
				}
				//if file moved to uploads folder
                echo 'File uploaded successfully!';
				$image_name="";
				$target_path="";
            } 
			else 
			{
				//if file was not moved.
                echo 'Please try again!';
            }
        } 
		else 
		{
			//if file size and file type was incorrect.
            echo 'Invalid file Size or Type';
        }
    }

	if ($error==1) 
	{
		//On Successful
		fn_add_activity_log("Enquiry",$last_inserted_id,"Enquiry Created",$user_id,$conn);
		header("Location:../../html/view_enquiry_html.php?id=".$last_inserted_id);
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