<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';
	include '../../php/add/add_activity_log.php';

	//Table Names 
	$tbl_name = "quick_product"; 

	//Store Posted Data To PHP Variable
	$quick_product_name= ucwords(mysqli_real_escape_string($conn,$_POST['ui_quick_product_name']));
	$quick_product_description= mysqli_real_escape_string($conn,$_POST['ui_quick_product_description']);
	$quick_product_bp= mysqli_real_escape_string($conn,$_POST['ui_quick_product_bp']);
	$quick_product_sp= mysqli_real_escape_string($conn,$_POST['ui_quick_product_sp']);
	$quick_product_tax= mysqli_real_escape_string($conn,$_POST['ui_quick_product_tax']);
		$user_id= mysqli_real_escape_string($conn,$_POST['user_id']);
	
	
	//Insert Query
	$query = "INSERT INTO $tbl_name(quick_product_name,quick_product_description,quick_product_bp,quick_product_sp,quick_product_tax) VALUES ('$quick_product_name','$quick_product_description','$quick_product_bp','$quick_product_sp','$quick_product_tax')";

	//Execute The Query
	if (mysqli_query($conn, $query)) 		
	{
		$error=1;
	}
	//Get Last Inserted Id of Customer Table and Create an Adhoc Project a Customer
	$last_inserted_id=mysqli_insert_id($conn);
	
	$j = 0; //Variable for indexing uploaded image 
    for ($i = 0; $i < count($_FILES['file']['name']); $i++) 
	{//loop to get individual element from the array
		$target_path = "../../uploads/"; //Declaring Path for uploaded images
        $validextensions = array("jpeg", "jpg", "png","pdf","doc","docx","xlsx","xls","JPEG", "JPG", "PNG","PDF","DOC","DOCX","XLSX","XLS");  //Extensions which are allowed
        $ext = explode('.', basename($_FILES['file']['name'][$i]));//explode file name from dot(.) 
		echo "Ext". $ext."</br>";
        $file_extension = end($ext); //store extensions in the variable
        $filename=md5(uniqid());
		echo "Encrypted Filename: ".$filename."</br>";
		echo "Filename: ".$_FILES['file']['name'][$i]."</br>";
		$target_path = $target_path .  $filename . "." . $ext[count($ext) - 1];//set the target path with a new name of image
        $j = $j + 1;//increment the number of uploaded images according to the files in array       
      
	  if (($_FILES["file"]["size"][$i] < 10000000) && in_array($file_extension, $validextensions)) //Approx 10 MB File size
		{
            if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) 
			{
				$image_name= $filename. "." . $ext[count($ext) - 1];
				echo $filename;
				//Insert Query
				$query3="INSERT INTO `photo` (module_id,module_name,photo_name) VALUES ('$last_inserted_id','quick_product','$image_name')"; 

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
		fn_add_activity_log("quick_product",$last_inserted_id,"quick_product Created",$user_id,$conn);
		header("Location:../../html/add_quick_product_html.php");
	}
	else
	{
		//On Error 
		echo mysqli_error($conn);
		header("Location:../../extra/error.php");
	}
		//Close Mysqli Connection
		mysqli_close($conn);
?>