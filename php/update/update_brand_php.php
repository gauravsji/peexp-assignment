<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';
	include '../../php/add/add_activity_log.php';
	
	//Table Names 
	$tbl_name = "brand";

	$error=0;
	
	//Store Posted Data To PHP Variable
	$brand_id= mysqli_real_escape_string($conn,$_POST['ui_brand_id']);
	$product_set_id= mysqli_real_escape_string($conn,$_POST['ui_product_set_id']);
	$brand_name= ucwords(mysqli_real_escape_string($conn,$_POST['ui_brand_name']));
	$description= mysqli_real_escape_string($conn,$_POST['ui_brand_description']);
	$company_connect= ucwords(mysqli_real_escape_string($conn,$_POST['ui_company_connect']));
	$contact_number= mysqli_real_escape_string($conn,$_POST['ui_contact_number']);
	$contact_email= strtolower(mysqli_real_escape_string($conn,$_POST['ui_connect_email']));
	$contact_address= mysqli_real_escape_string($conn,$_POST['ui_address']);
	$contact_additional_info= mysqli_real_escape_string($conn,$_POST['ui_additional_info']);	
	$user_id= mysqli_real_escape_string($conn,$_POST['user_id']);
	$customer_disc= mysqli_real_escape_string($conn,$_POST['ui_cust_disc']);

	//Update Query
	$sql = "UPDATE $tbl_name
	SET 
	product_set_id='$product_set_id',
	brand_name='$brand_name',
	brand_description='$description',
	brand_company_connect='$company_connect',
	brand_company_connect_contact_number='$contact_number',
	brand_company_connect_email='$contact_email',
	brand_company_connect_address='$contact_address',
	brand_company_connect_additional_info='$contact_additional_info',
	customer_average_disc = '$customer_disc',
	data_entered_by='$user_id'
	WHERE brand_id = '$brand_id'";

	//Execute The Query
	if (mysqli_query($conn, $sql)) 
	{
		$error=1;
	}	
		
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
				$query3="INSERT INTO `photo` (module_id,module_name,photo_name) VALUES ('$brand_id','brand','$image_name')"; 

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
	echo mysqli_error($conn);
	
	if ($error==1) 
	{
		//On Successful
		fn_add_activity_log("Brand",$brand_id,"Brand Updated",$user_id,$conn);
		header("Location:../../html/view_brand_html.php?id=". $brand_id . "");
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