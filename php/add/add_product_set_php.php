<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';
	include '../../php/add/add_activity_log.php';

	//Table Names 
	$tbl_product_set = "product_set"; 
	$tbl_product_attribute="product_set_attribute"; 
	
	$error=0;

	//Store Posted Data To PHP Variable
	$product_name= ucwords(mysqli_real_escape_string($conn,$_POST['ui_product_name']));
	$category= mysqli_real_escape_string($conn,$_POST['ui_category']);
	$sub_category_id= mysqli_real_escape_string($conn,$_POST['ui_sub_category']);
	$default_size= ucwords(mysqli_real_escape_string($conn,$_POST['ui_default_size']));
	$tax= mysqli_real_escape_string($conn,$_POST['tax']);
	$unit_of_measurement= mysqli_real_escape_string($conn,$_POST['ui_key_value']);
	$product_description= mysqli_real_escape_string($conn,$_POST['ui_product_description']);
	$installation_needed= mysqli_real_escape_string($conn,$_POST['installation_needed']);
	$ui_certify= mysqli_real_escape_string($conn,$_POST['ui_certify']);
	$user_id= mysqli_real_escape_string($conn,$_POST['user_id']);
	$location=mysqli_real_escape_string($conn,$_POST['location']);
	
	//$auto_complete_product_name=$product_name.">".$category_name.">".$sub_category_name.">".$product_description;
	//Insert Query
	$query1 = "INSERT INTO $tbl_product_set(category_id,sub_category_id,product_set_product_name,product_set_description,product_set_tax,product_set_default_size,product_set_unit_of_measurement,product_set_installation,certify,data_entered_by,location,delete_status) VALUES ('$category','$sub_category_id','$product_name','$product_description','$tax','$default_size','$unit_of_measurement','$installation_needed','$ui_certify','$user_id','$location',0)";

	//Execute The Query
	if (mysqli_query($conn, $query1)) 
	$error=1;

	//Store data to enquiry_product table
	if(isset($_POST)==true && empty($_POST)==false): 
		//Store Posted Data To PHP Variable
		$attribute_id=$_POST['ui_attribute_id'];
		$attribute_value=$_POST['ui_attribute_value'];

		//Get Last Inserted ID
		$last_inserted_id=mysqli_insert_id($conn);

		foreach($attribute_id as $a => $b)
		{
			//Pass each variable from php variable array to php variable
			$v_attribute_id=$attribute_id[$a];
			$v_attribute_value=$attribute_value[$a];

			//Insert Query
			$query2 = "INSERT INTO $tbl_product_attribute(product_set_id,product_set_attribute_id_fk_key_value,product_set_attribute_value,delete_status) VALUES ('$last_inserted_id','$v_attribute_id','$v_attribute_value',0)";	

			if(mysqli_query($conn, $query2))
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
				$query3="INSERT INTO `photo` (module_id,module_name,photo_name) VALUES ('$last_inserted_id','product_set','$image_name')"; 

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
		fn_add_activity_log("Product Set",$last_inserted_id,"Product Set Created",$user_id,$conn);
		header("Location:../../html/add_product_set_html.php");
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