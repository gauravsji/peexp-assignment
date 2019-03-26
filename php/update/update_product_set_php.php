<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';
	include '../../php/add/add_activity_log.php';
		
	$i=0;
	//Table names
	$tbl_product_set = "product_set"; 
	$tbl_product_set_attribute="product_set_attribute";
	$error=0;
	
	//Get product_set Posted Values In PHP Variables
	$product_set_id= mysqli_real_escape_string($conn,$_POST['ui_product_set_id']);
	$category_id= mysqli_real_escape_string($conn,$_POST['ui_category_id']);
	$sub_category_id= mysqli_real_escape_string($conn,$_POST['ui_sub_category_id']);
	$product_set_name= mysqli_real_escape_string($conn,$_POST['ui_product_set_name']);
	$default_size= mysqli_real_escape_string($conn,$_POST['ui_default_size']);
	$tax= mysqli_real_escape_string($conn,$_POST['tax']);
	$unit_of_measurement= mysqli_real_escape_string($conn,$_POST['ui_unit_of_measurement']);
	$product_set_description= mysqli_real_escape_string($conn,$_POST['ui_product_set_description']);
	$user_id= mysqli_real_escape_string($conn,$_POST['user_id']);
	if(mysqli_real_escape_string($conn,isset($_POST['installation_needed'])))
	{
	$installation_needed= mysqli_real_escape_string($conn,$_POST['installation_needed']);
	}
	else
	{
		$installation_needed=0;
	}
	
	$ui_certify= mysqli_real_escape_string($conn,$_POST['ui_certify']);

	//Update product_set Table
	$update_product_set_sql = "UPDATE $tbl_product_set
	SET category_id = '$category_id',
    sub_category_id='$sub_category_id',
    product_set_product_name='$product_set_name',
    product_set_description='$product_set_description',
	product_set_tax='$tax',
    product_set_default_size='$default_size',
    product_set_unit_of_measurement='$unit_of_measurement',
    product_set_installation='$installation_needed',
	certify='$ui_certify'
	WHERE product_set_id = '$product_set_id'";
	if(mysqli_query($conn, $update_product_set_sql))
	{
		$error=1; //Query executed successfully
	}
	else
	{
		$error=0;
		echo mysqli_error($conn);
		//echo "</br>Inserting into Product Set Error: " . mysqli_connect_error(); //ERROR OCCURRED
	}

	//Determine's if a variable is set and is not NULL or Determine's whether a variable is empty	
	if(isset($_POST)==true && empty($_POST)==false): 
		//Get product_set_attribute data from edit_product_html.php
		$psattribute_id=$_POST['ui_psattribute_id'];
		$pcount=count($psattribute_id);
		$attribute_id=$_POST['ui_attribute_id'];
		$attribute_value=$_POST['ui_attribute_value'];
		
		//Get product_set_attribute_id and convert it to coma separated values in order to check if it already exists or not
		//print "Prod delete id".$psattribute_id;
		

		$string = rtrim(implode(',', $psattribute_id), ', ');
		print_r($string);
		$update_delete_status_p_s_attribute_sql = "UPDATE $tbl_product_set_attribute
		SET delete_status=1
		WHERE product_set_attribute_id NOT IN ($string) AND product_set_id=".$product_set_id;
		if(mysqli_query($conn, $update_delete_status_p_s_attribute_sql))
		{
			$error=1; //Query executed successfully
		}
		else
		{
			$error=0;
			echo mysqli_error($conn);
			//echo "</br>Updating Product Set Attribute to delete Error: " . mysqli_connect_error(); //ERROR OCCURRED
		}

		foreach($attribute_id as $a => $b)
		{
			//Get product_set_attribute array data individually from data obtained from edit_product_html.php in the previous if loop
			$v_psattribute_id=mysqli_real_escape_string($conn,$psattribute_id[$a]);
			$v_attribute_id=mysqli_real_escape_string($conn,$attribute_id[$a]);
			$v_attribute_value=$attribute_value[$a];
			echo "</br></br>Product set Att Id: ".$v_psattribute_id;
			echo "</br>Attribute Id: ".$v_attribute_id;
			echo "</br>Attribute Value: ".$v_attribute_value;
			
			$sql_tbl_product_set_attribute = "UPDATE $tbl_product_set_attribute
			SET
			product_set_attribute_value='$v_attribute_value'
			WHERE product_set_attribute_id=$v_psattribute_id";
			mysqli_query($conn, $sql_tbl_product_set_attribute);
			echo mysqli_error($conn);
			
			if(mysqli_affected_rows($conn)>-1)
			{
				$error = 1;
				
			}
			else 
			{
			$insert_p_s_attribute = "INSERT INTO $tbl_product_set_attribute (product_set_id,product_set_attribute_id_fk_key_value,product_set_attribute_value,delete_status) VALUES ('$product_set_id','$v_attribute_id','$v_attribute_value','0')";	
			mysqli_query($conn, $insert_p_s_attribute);
			echo mysqli_error($conn);
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
				$query3="INSERT INTO `photo` (module_id,module_name,photo_name) VALUES ('$product_set_id','product_set','$image_name')"; 

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
	
echo $error;
echo $product_set_id;
	if ($error==1) 
	{
		//On Successful
		fn_add_activity_log("Product Set",$product_set_id,"Product Set Updated",$user_id,$conn);
		header("Location:../../html/view_product_set_html.php?id=". $product_set_id . "");
	}
	else
	{
		//On Error 
		$_SESSION['error']=mysqli_error($conn);
		header("Location:../../extra/error.php");
		//echo mysqli_error($conn);
	}
	//Close Mysqli Connection
	mysqli_close($conn);
?>