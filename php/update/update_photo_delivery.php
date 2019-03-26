<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';
	include '../../php/add/add_activity_log.php';
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
	$error=0;
	//Store Posted Data To PHP Variable
	$order_id= $_GET['id'];


	$j = 0; //Variable for indexing uploaded image

    for ($i = 0; $i < count($_FILES['file']); $i++) 
	{

		//loop to get individual element from the array
		// $target_path = "../../uploads/"; //Declaring Path for uploaded images
        $validextensions = array("jpeg", "jpg", "png");  //Extensions which are allowed
        $ext = explode('.', basename($_FILES['file']['name'][$i]));//explode file name from dot(.) 
        $file_extension = end($ext); //store extensions in the variable
        $filename=md5(uniqid());		
		// $target_path = $target_path .  $filename . "." . $ext[count($ext) - 1];//set the target path with a new name of image
        $j = $j + 1;//increment the number of uploaded images according to the files in array

        $baseName = basename($_FILES["file"]['name'][$i]);
	$keyName = 'proof_of_delivery_photo/' .$baseName;
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
			$query ="INSERT INTO `proof_of_delivery_photo` (module_id,module_name,photo_name,delete_status) VALUES ('$order_id','order','$pathInS3',0)"; 

			if(mysqli_query($conn, $query))
			{
				$error =1;
			}
			else {
				$error = 0;
			}
		} catch (S3Exception $e) {
			die('Error S3 :' . $e->getMessage());
		} catch (Exception $e) {
			// var_dump($_FILES['file']['name'][0]);
			die('Error :' . $e->getMessage());
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
		header("Location:../../html/view_order_html.php?id=".$order_id."");
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
