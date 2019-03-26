<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';
	include '../../php/add/add_activity_log.php';
	//Table Names 
	$tbl_name = "enquiry"; 
	$tbl_enquiry_product="enquiry_product";

	$error=0;
	
	//Store Posted Data To PHP Variable
	$enquiry_id= $_POST['ui_enquiry_id'];
	$date = explode('/', $_POST['ui_enquiry_date']);
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
	$transport_charge= mysqli_real_escape_string($conn,$_POST['transport_charge']);
	$user_id= mysqli_real_escape_string($conn,$_POST['user_id']);
	
	//Update Query
	$sql1 = "UPDATE $tbl_name
	SET 
	enquiry_date = '$enquiry_date',
	customer_id='$customer_id',
	project_id='$project_id',
	sales_lead_id='$sales_lead_id',
	enquiry_name='$enquiry_name',
	enquiry_details='$enquiry_details',
	enquiry_transport_charge='$transport_charge',
	enquiry_assignee='$assignee_name',
	enquiry_status='$enquiry_status',
	enquiry_priority='$enquiry_priority',
	last_update_date =  CURDATE()
	WHERE enquiry_id = '$enquiry_id'";
	
	if(mysqli_query($conn, $sql1))
	{		
		$error=1;
	}
	else
	{
		$error=0;
	}	
	
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
				$query3="INSERT INTO `photo` (module_id,module_name,photo_name) VALUES ('$enquiry_id','enquiry','$image_name')"; 

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
		fn_add_activity_log("Enquiry",$enquiry_id,"Enquiry Updated",$user_id,$conn);
		header("Location:../../html/edit_enquiry_html.php?id=".$enquiry_id."");
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