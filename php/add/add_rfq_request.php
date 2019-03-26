<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';
	require '../../vendor/autoload.php';
	use Aws\S3\S3Client;
	use Aws\S3\Exception\S3Exception;
	// AWS Info
	$bucketName = 'smartstorey-datastore';
	$IAM_KEY = 'AKIAJ5J5LHS7XAZ2W53A';
	$IAM_SECRET = '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';
	// Connect to AWS
	try {
		// You may need to change the region. It will say in the URL when the bucket is open
		// and on creation.
		$s3 = S3Client::factory(
			array(
				'credentials' => array(
					'key' => $IAM_KEY,
					'secret' => $IAM_SECRET
				),
				'version' => 'latest',
				'region'  => 'ap-south-1'
			)
		);
	} catch (Exception $e) {
		// We use a die, so if this fails. It stops here. Typically this is a REST call so this would
		// return a json object.
		die("Error: " . $e->getMessage());
	}



	//Table names
	$tbl_enquiry = "rfq";
	$tbl_enquiry_product="customer_rfq_enquiry";
	$error=0;

	//Store Posted Data To PHP Variable
	$draft_id= mysqli_real_escape_string($conn,$_POST['draft_id']);
	$date = explode('/', mysqli_real_escape_string($conn, $_POST['ui_rfq_date']));
	$time = mktime(0,0,0,$date[1],$date[0],$date[2]);
	$enquiry_date = date( 'Y-m-d', $time );

        $end_date = explode('/', mysqli_real_escape_string($conn, $_POST['ui_edd_date']));
	$time = mktime(0,0,0,$end_date[1],$end_date[0],$end_date[2]);
	$enquiry_end_date = date( 'Y-m-d', $time );

	if(!(isset($_POST['ui_customer_span'])))
	{
		$customer_id = NULL;
	}
	else $customer_id =  mysqli_real_escape_string($conn,$_POST['ui_customer_span']);

	if(!(isset($_POST['ui_project_name'])))
	{
		$project_id = 'NULL';
	}
	else $project_id =  mysqli_real_escape_string($conn,$_POST['ui_project_name']);

	if(!(isset($_POST['ui_sales_lead'])))
	{
		$sales_lead_id = NULL;
	}
	else
	{
		$sales_lead_id =  mysqli_real_escape_string($conn,$_POST['ui_sales_lead']);
	}
  $sales_lead_id = NULL;

  $assigne_name = mysqli_real_escape_string($conn,$_POST['enquired_by']);
  $project_priority = mysqli_real_escape_string($conn,$_POST['ui_project_priority']);
  $rfq_name = mysqli_real_escape_string($conn,$_POST['rfq_name']);
  $rfq_details = mysqli_real_escape_string($conn ,$_POST['rfq_details']);

  $enquiry_status = mysqli_real_escape_string($conn ,'Awaiting Quote');
	//Insert Query
	$query1 = "INSERT INTO $tbl_enquiry(
    customer_id,project_id,enquiry_date,enquiry_name,
    enquiry_details,enquiry_assignee,enquiry_status,enquiry_priority,delete_status,data_entered_by_admin,end_date,created_at,updated_at,pi_status) VALUES (
    $customer_id,$project_id,'$enquiry_date',
    '$rfq_name','$rfq_details','$customer_id','$enquiry_status','$project_priority',0,'$assigne_name','$enquiry_end_date',CURDATE(),CURDATE(),'Awaiting')";

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
	$enquiry_prod_sql = "SELECT * FROM $tbl_enquiry_product where  product_enquiry_id ='$draft_id'";
	$result_product_clone = mysqli_query($conn, $enquiry_prod_sql);
	$row_product_clone=mysqli_num_rows($result_product_clone);

	for($i=0;$i<$row_product_clone;$i++)
	{
		//Update Query
		$query5="UPDATE $tbl_enquiry_product SET  product_enquiry_id=".$last_inserted_id." WHERE  product_enquiry_id='$draft_id'";

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

        $baseName = basename($_FILES["file"]['name'][$i]);
	$keyName = 'uploads/' .$baseName;
	$pathInS3 = 'https://s3.ap-south-1.amazonaws.com/' . $bucketName . '/' . $keyName;

	  if (($_FILES["file"]["size"][$i] < 10000000) && in_array($file_extension, $validextensions)) //Approx 10 MB File size
		{

				// Add it to S3
			try {
			// Uploaded:
			$file = $_FILES["file"]['tmp_name'][$i];
			$s3->putObject(
				array(
					'Bucket'=>$bucketName,
					'Key' =>  $keyName,
					'SourceFile' => $file,
					'StorageClass' => 'REDUCED_REDUNDANCY'
				)
			);
			$error =0;
			$query ="INSERT INTO `photo` (module_id,module_name,photo_name,delete_status) VALUES ('$last_inserted_id','rfq','$pathInS3',0)";
			if(mysqli_query($conn, $query))
			{
				$error =1;
			}
			else {
				$error = 0;
			}
		} catch (S3Exception $e) {
			die('Error:' . $e->getMessage());
		} catch (Exception $e) {
			die('Error:' . $e->getMessage());
		}
                echo 'File uploaded successfully!';

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
		// fn_add_activity_log("Enquiry",$last_inserted_id,"Enquiry Created",$user_id,$conn);
		header("Location:../../html/view_rfq_enquiry.php?id=".$last_inserted_id);
	}
	else
	{
		//On Error
		$_SESSION['error']=mysqli_error($conn);

		// header("Location:../../extra/error.php");
	}
	//Close Mysqli Connection
	mysqli_close($conn);
?>
