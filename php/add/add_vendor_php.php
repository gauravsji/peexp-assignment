<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';
	include '../../php/add/add_activity_log.php';
	
	//Table names 
	$tbl_name = "vendor"; 
	$tbl_contact="contacts";
	
	$error=0;

	//Store Posted Data To PHP Variable
	$vendor_name= ucwords(mysqli_real_escape_string($conn,$_POST['vendor_name']));
	$contact_person= ucwords(mysqli_real_escape_string($conn,$_POST['contact_person']));
	$contact_number= mysqli_real_escape_string($conn,$_POST['contact_number']);
	$contact_alternate_number= mysqli_real_escape_string($conn,$_POST['alternate_contact_number']);
	$vendor_email= strtolower(mysqli_real_escape_string($conn,$_POST['vendor_email']));
	$alternate_vendor_email= strtolower(mysqli_real_escape_string($conn,$_POST['alternate_vendor_email']));
	$vendor_website= strtolower(mysqli_real_escape_string($conn,$_POST['vendor_website']));
	$vendor_gstin_number= strtoupper(mysqli_real_escape_string($conn,$_POST['vendor_gstin_number']));
	$vendor_tin_number= mysqli_real_escape_string($conn,$_POST['vendor_tin_number']);
	$vendor_city= mysqli_real_escape_string($conn,$_POST['vendor_city']);
	$ui_authenticated= mysqli_real_escape_string($conn,$_POST['ui_authenticated']);
	
	
	$bank_name= ucwords(mysqli_real_escape_string($conn,$_POST['bank_name']));
	$bank_account_number= mysqli_real_escape_string($conn,$_POST['bank_account_number']);
	$bank_ifsc_code= mysqli_real_escape_string($conn,$_POST['bank_ifsc_code']);	
	$bank_address= mysqli_real_escape_string($conn,$_POST['vendor_bank_address']);	
	
	
	$vendor_address= mysqli_real_escape_string($conn,$_POST['vendor_address']);	
	$vendor_brands_dealing= mysqli_real_escape_string($conn,$_POST['vendor_brands_dealing']);
	$vendor_additional_info= mysqli_real_escape_string($conn,$_POST['vendor_additional_info']);
	$user_id= mysqli_real_escape_string($conn,$_POST['user_id']);
	$location= mysqli_real_escape_string($conn,$_POST['location']);

	//Insert Query
	$sql = "INSERT INTO $tbl_name(vendor_name,vendor_city,vendor_contact_person,vendor_contact_number,vendor_alternate_contact_number,vendor_email,vendor_alternate_email,vendor_website,vendor_tin_number,vendor_gstin_number, vendor_bank_name, vendor_bank_account_number, vendor_ifsc_code, vendor_bank_address,vendor_address,vendor_brands_dealing,vendor_additional_info,authenticate,data_entered_by,location,delete_status) VALUES ('$vendor_name','$vendor_city','$contact_person','$contact_number','$contact_alternate_number','$vendor_email','$alternate_vendor_email','$vendor_website','$vendor_tin_number','$vendor_gstin_number','$bank_name','$bank_account_number','$bank_ifsc_code','$bank_address','$vendor_address','$vendor_brands_dealing','$vendor_additional_info','$ui_authenticated','$user_id','$location',0)";

	//Execute The Query
	if (mysqli_query($conn, $sql)) 
	{
		$error=1;
	}						
	
	$last_inserted_id=mysqli_insert_id($conn);
	
	//Store data to contact table
	if(isset($_POST)==true && empty($_POST)==false): 
		//Store Posted Data To PHP Variable
		$contact_person_name=$_POST['ui_contact_person_name'];
		$contact_number=$_POST['ui_contact_number'];
		$contact_alternate_number=$_POST['ui_alternate_contact_number'];
		$contact_person_email=$_POST['ui_contact_person_email'];
		$contact_alternative_email=$_POST['ui_contact_person_alternate_email'];

		foreach($contact_person_name as $a => $b)
		{
			//Pass each variable from php variable array to php variable
			$v_contact_person_name=$contact_person_name[$a];
			$v_contact_number=$contact_number[$a];
			$v_contact_alternate_number=$contact_alternate_number[$a];
			$v_contact_person_email=$contact_person_email[$a];
			$v_contact_alternative_email=$contact_alternative_email[$a];
			//Insert Query
			$query4 = "INSERT INTO $tbl_contact(contact_module_name,contact_module_id,contact_person_name,contact_person_contact_number,contact_person_alternate_contact_number,contact_person_email,contact_person_alternate_email,delete_status) VALUES ('Vendor','$last_inserted_id','$v_contact_person_name','$v_contact_number','$v_contact_alternate_number','$v_contact_person_email','$v_contact_alternative_email',0)";	

			if(mysqli_query($conn, $query4))
			$error=1;
		}
	endif;	
		
	$j = 0; //Variable for indexing uploaded image 
    for ($i = 0; $i < count($_FILES['file']['name']); $i++) 
	{//loop to get individual element from the array
		$target_path = "../../uploads/"; //Declaring Path for uploaded images
        $validextensions = array("jpeg", "jpg", "png","pdf","doc","docx","xlsx","xls","JPEG", "JPG", "PNG","PDF","DOC","DOCX","XLSX","XLS");  //Extensions which are allowed
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
				$query3="INSERT INTO `photo` (module_id,module_name,photo_name) VALUES ('$last_inserted_id','vendor','$image_name')"; 

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
		fn_add_activity_log("Vendor",$last_inserted_id,"Vendor Created",$user_id,$conn);
		header("Location:../../html/view_vendor_html.php?id=".$last_inserted_id);
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