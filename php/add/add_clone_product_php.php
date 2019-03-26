<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';

	//Table Names 
	$tbl_product = "product"; 
	$tbl_product_attribute = "product_attribute"; 

	$error=0;
		
	//Store Posted Data To PHP Variable
	$product_set_id= mysqli_real_escape_string($conn,$_POST['ui_product_set_id']);
	$brand_id="";
	if(isset($_POST['ui_brand_id']))
	{
	$brand_id= mysqli_real_escape_string($conn,$_POST['ui_brand_id']);
	}	
	$product_name= ucwords(mysqli_real_escape_string($conn,$_POST['ui_product_name']));
	$product_description= mysqli_real_escape_string($conn,$_POST['ui_product_description']);
	$product_mrp= mysqli_real_escape_string($conn,$_POST['ui_mrp']);
	$hsn_code= mysqli_real_escape_string($conn,$_POST['ui_hsn_code']);
	$location=mysqli_real_escape_string($conn,$_POST['location']);
	$user_id= mysqli_real_escape_string($conn,$_POST['user_id']);
	if(isset($_POST['ui_unbranded']))
	{
	$ui_unbranded= mysqli_real_escape_string($conn,$_POST['ui_unbranded']);
	}
	else
	{
		$ui_unbranded= "";
	}
	$global_attribute_values="";

	//Insert Query
	$query1 = "INSERT INTO $tbl_product(product_set_id,product_unbranded,brand_id,product_name,product_description,product_mrp,product_hsn_code,data_entered_by,location,delete_status) VALUES ('$product_set_id','$ui_unbranded','$brand_id','$product_name','$product_description','$product_mrp','$hsn_code','$user_id','$location',0)";
	
	//Execute The Query
	if (mysqli_query($conn, $query1)) 
	$error=1;

	$last_inserted_id=mysqli_insert_id($conn);
	
	//Store data to product_attribute table
	if(isset($_POST)==true && empty($_POST)==false): 
		//Store Posted Data To PHP Variable
		$product_set_attribute_id=$_POST['attribute_values'];
		
		foreach($product_set_attribute_id as $a => $b)
		{
			//Pass each variable from php variable array to php variable
			$v_att_id=$product_set_attribute_id[$a];
			$v_att_val=$product_set_attribute_id[$a];		
			
			$att_n_sql = "SELECT * FROM key_value k,product_set_attribute ps where k.key_value_id=ps.product_set_attribute_id_fk_key_value and ps.product_set_attribute_id=" . $v_att_id;
			$result_att_name = mysqli_query($conn, $att_n_sql);
			$attribute_name_result = mysqli_fetch_array($result_att_name,MYSQLI_ASSOC);	
			if($global_attribute_values=="")
			{				
				$global_attribute_values=$global_attribute_values.$attribute_name_result['value'];
				$global_attribute_values=$global_attribute_values. '-' .$attribute_name_result['product_set_attribute_value'];
			}
			else
			{
				$global_attribute_values=$global_attribute_values. '-' .$attribute_name_result['value'];
				$global_attribute_values=$global_attribute_values. '-' .$attribute_name_result['product_set_attribute_value'];
			}
			//Insert Query
			$query2 = "INSERT INTO $tbl_product_attribute(product_id,product_set_attribute_id,delete_status) VALUES ('$last_inserted_id','$v_att_id',0)";	
			
			//Execute The Query
			if(mysqli_query($conn, $query2))
			$error=1;
		}
	endif;
	
	$product_set_query= "SELECT product_set_product_name FROM product_set where product_set_id='".$product_set_id."'";
	$product_set_result_set = mysqli_query($conn, $product_set_query);
	$product_set_result = mysqli_fetch_array($product_set_result_set,MYSQLI_ASSOC);
	
	$brand_query= "SELECT brand_name FROM brand where brand_id='".$brand_id."'";
	$brand_result_set = mysqli_query($conn, $brand_query);
	$brand_result = mysqli_fetch_array($brand_result_set,MYSQLI_ASSOC);
	
	$brand_name=$brand_result['brand_name'];
	$product_set_name=$product_set_result['product_set_product_name'];
	$auto_complete_product_name=$product_set_name."-".$brand_name."-".$product_name."-".$global_attribute_values;
	
	$update_query="UPDATE $tbl_product
		SET 
		auto_complete_product_name = '$auto_complete_product_name'
		where product_id='$last_inserted_id'";
	mysqli_query($conn, $update_query);
	
	echo mysqli_error($conn);
	
	
	
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
				$query3="INSERT INTO `photo` (module_id,module_name,photo_name) VALUES ('$last_inserted_id','product','$image_name')"; 

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
		header("Location:../../html/view_product_html.php?id=". $last_inserted_id . "");
		//header("Location:../../html/clone_product_html.php".$.");
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