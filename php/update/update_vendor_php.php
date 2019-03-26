<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';
	include '../../php/add/add_activity_log.php';

	//Table Names
	$tbl_vendor = "vendor";  
	$tbl_vendor_brand = "vendor_brand";
	$tbl_vendor_product = "vendor_product";
	$tbl_contact="contacts";
	
	$error=0;

	//Store Posted Data To PHP Variable
	$vendor_id= mysqli_real_escape_string($conn,$_POST['vendor_id']);
	$vendor_name= ucwords(mysqli_real_escape_string($conn,$_POST['vendor_name']));
	$contact_person= ucwords(mysqli_real_escape_string($conn,$_POST['contact_person']));
	$contact_number= mysqli_real_escape_string($conn,$_POST['contact_number']);
	$contact_alternate_number= mysqli_real_escape_string($conn,$_POST['alternate_contact_number']);
	$vendor_email=strtolower(mysqli_real_escape_string($conn,$_POST['vendor_email']));
	$alternate_vendor_email= strtolower( mysqli_real_escape_string($conn,$_POST['alternate_vendor_email']));
	$vendor_website= strtolower( mysqli_real_escape_string($conn,$_POST['vendor_website']));
	$vendor_gstin_number= strtoupper(mysqli_real_escape_string($conn,$_POST['vendor_gstin_number']));
	$vendor_tin_number= mysqli_real_escape_string($conn,$_POST['vendor_tin_number']);
	$vendor_city= mysqli_real_escape_string($conn,$_POST['vendor_city']);	
	$bank_name= ucwords(mysqli_real_escape_string($conn,$_POST['bank_name']));
	$bank_account_number= mysqli_real_escape_string($conn,$_POST['bank_account_number']);
	$bank_ifsc_code= mysqli_real_escape_string($conn,$_POST['bank_ifsc_code']);	
	$bank_address= mysqli_real_escape_string($conn,$_POST['vendor_bank_address']);		
	$ui_authenticated= mysqli_real_escape_string($conn,$_POST['ui_authenticated']);
	$vendor_address= mysqli_real_escape_string($conn,$_POST['vendor_address']);
	$vendor_brands_dealing= mysqli_real_escape_string($conn,$_POST['vendor_brands_dealing']);
	$vendor_additional_info= mysqli_real_escape_string($conn,$_POST['vendor_additional_info']);
	$location= mysqli_real_escape_string($conn,$_POST['location']);
	$user_id=mysqli_real_escape_string($conn,$_POST['user_id']);


	$sql = "UPDATE $tbl_vendor
	SET 
	vendor_name='$vendor_name',
	vendor_city='$vendor_city',
	vendor_contact_person='$contact_person',
	vendor_contact_number='$contact_number',
	vendor_alternate_contact_number='$contact_alternate_number',
	vendor_email='$vendor_email',
	vendor_alternate_email='$alternate_vendor_email',
	vendor_website='$vendor_website',
	vendor_tin_number='$vendor_tin_number',	
	vendor_gstin_number='$vendor_gstin_number',
	vendor_bank_name='$bank_name',
	vendor_bank_account_number='$bank_account_number',
	vendor_ifsc_code='$bank_ifsc_code',
	vendor_bank_address='$bank_address',	
	vendor_address='$vendor_address',
	vendor_brands_dealing='$vendor_brands_dealing',
	vendor_additional_info='$vendor_additional_info',
	authenticate='$ui_authenticated'
	WHERE vendor_id = '$vendor_id'";
	if (mysqli_query($conn, $sql)) 
	{
	$error=1;
	}	
	echo mysqli_error($conn);
	
	
	//Determine's if a variable is set and is not NULL or Determine's whether a variable is empty	
	if(isset($_POST)==true && empty($_POST)==false): 
		//Get product_set_attribute data from edit_product_html.php
		$contact_id=$_POST['ui_customer_contact_id'];
		$pcount=count($contact_id);
		$contact_person_name=$_POST['ui_contact_person_name'];		
		$contact_person_contact_number=$_POST['ui_contact_number'];		
		$contact_person_alternate_contact_number=$_POST['ui_alternate_contact_number'];		
		$contact_email=$_POST['ui_contact_person_email'];
		$contact_alternate_email=$_POST['ui_contact_person_alternate_email'];
		
		//Get product_set_attribute_id and convert it to coma separated values in order to check if it already exists or not
		$string = rtrim(implode(',', $contact_id), ',');
		$update_delete_status_contact_sql = "UPDATE $tbl_contact
		SET delete_status=1
		WHERE contact_id NOT IN ($string) AND contact_module_id='$vendor_id' and contact_module_name='Vendor'";
		if(mysqli_query($conn, $update_delete_status_contact_sql))
		{
			$error=1; //Query executed successfully
		}
		else
		{
			$error=0;
			//echo "</br>Updating Product Set Attribute to delete Error: " . mysqli_connect_error(); //ERROR OCCURRED
		}

		foreach($contact_person_name as $a => $b)
		{
			//Get product_set_attribute array data individually from data obtained from edit_product_html.php in the previous if loop
			$v_contact_id=$contact_id[$a];
			$v_contact_person_name=$contact_person_name[$a];
			$v_contact_person_contact_number=$contact_person_contact_number[$a];
			
			$v_contact_person_alternate_contact_number=$contact_person_alternate_contact_number[$a];
			$v_contact_email=$contact_email[$a];
			
			$v_contact_alternate_email=$contact_alternate_email[$a];
					
			//echo "</br></br>Product set Att Id: ".$v_contact_id;
			//echo "</br>Attribute Id: ".$v_contact_person_name;
			//echo "</br>Attribute Value: ".$v_attribute_value;
			
			$sql_tbl_contact_update = "UPDATE $tbl_contact
			SET
			contact_person_name='$v_contact_person_name',
			contact_person_contact_number='$v_contact_person_contact_number',
			contact_person_alternate_contact_number='$v_contact_person_alternate_contact_number',
			contact_person_email='$v_contact_email',
			contact_person_alternate_email='$v_contact_alternate_email'
			WHERE contact_id=$v_contact_id";
			mysqli_query($conn, $sql_tbl_contact_update);
			
			echo mysqli_error($conn);
			
			if(mysqli_affected_rows($conn)>-1)
			{
				$error = 1;
			}
			else 
			{
			//echo "</br>block 5 insert attribute" ;
			$insert_contact = "INSERT INTO $tbl_contact(contact_module_name,contact_module_id,contact_person_name,contact_person_contact_number,contact_person_alternate_contact_number,contact_person_email,contact_person_alternate_email,delete_status) VALUES ('Customer','$customer_id','$v_contact_person_name','$v_contact_person_contact_number','$v_contact_person_alternate_contact_number','$v_contact_email','$v_contact_alternate_email',0)";	
			mysqli_query($conn, $insert_contact);
			}				
		}
	endif;		
	
	
	$j = 0; //Variable for indexing uploaded image 
    for ($i = 0; $i < count($_FILES['file']['name']); $i++) 
	{//loop to get individual element from the array
		$target_path = "../../uploads/"; //Declaring Path for uploaded images
        $validextensions = array("jpeg", "jpg", "png","pdf","doc","docx","xlsx","xls","JPEG", "JPG", "PNG","PDF","DOC","DOCX","XLSX","XLS");  //Extensions which are allowed
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
				$query3="INSERT INTO `photo` (module_id,module_name,photo_name) VALUES ('$vendor_id','vendor','$image_name')"; 

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
	
	
	if ($error==1) 
	{
		//On Successful
		fn_add_activity_log("Vendor",$vendor_id,"Vendor Updated",$user_id,$conn);
		header("Location:../../html/view_vendor_html.php?id=". $vendor_id . "");
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