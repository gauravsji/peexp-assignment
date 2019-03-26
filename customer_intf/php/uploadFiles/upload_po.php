<?php
	// This file demonstrates file upload to an S3 bucket. This is for using file upload via a
	// file compared to just having the link. If you are doing it via link, refer to this:
	// https://gist.github.com/keithweaver/08c1ab13b0cc47d0b8528f4bc318b49a
	//
	// You must setup your bucket to have the proper permissions. To learn how to do this
	// refer to:
	// https://github.com/keithweaver/python-aws-s3
	// https://www.youtube.com/watch?v=v33Kl-Kx30o

	// I will be using composer to install the needed AWS packages.
	// The PHP SDK:
	// https://github.com/aws/aws-sdk-php
	// https://packagist.org/packages/aws/aws-sdk-php
	//
	// Run:$ composer require aws/aws-sdk-php
	require '../../../vendor/autoload.php';
	include '../../dbconnect/dbconnect.php';
	use Aws\S3\S3Client;
	use Aws\S3\Exception\S3Exception;
	// AWS Info
	$bucketName = 'smartstorey-datastore';
	$IAM_KEY = 'AKIAJ5J5LHS7XAZ2W53A';
	$IAM_SECRET = '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';
	$tbl_name = 'po';
	$tbl_rfq = 'rfq';
	$po_number  = $_POST['po_number'];
	$modal_id  = $_POST['modal_id'];
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

	$allowed =  array('pdf');
	$filename = $_FILES['excel_file']['name'];
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	if(!in_array($ext,$allowed) ) {
	    echo 'Please Upload pdf file';
	}




	$baseName = basename($_FILES["excel_file"]['name'],'.pdf').'_'.time().'.'.pathinfo($filename, PATHINFO_EXTENSION);

	// For this, I would generate a unqiue random string for the key name. But you can do whatever.
	$keyName = 'po_uploads/' .$baseName;
	$pathInS3 = 'https://s3.ap-south-1.amazonaws.com/' . $bucketName . '/' . $keyName;

	// Add it to S3
	try {
		// Uploaded:
		$file = $_FILES["excel_file"]['tmp_name'];
		$s3->putObject(
			array(
				'Bucket'=>$bucketName,
				'Key' =>  $keyName,
				'SourceFile' => $file,
				'StorageClass' => 'REDUCED_REDUNDANCY'
			)
		);
		$error =0;
		$query = "INSERT INTO $tbl_name (rfq_id,po_path,po_number,delete_status,date) VALUES ($modal_id,'$pathInS3','$po_number',0,CURDATE())";
		if(mysqli_query($conn, $query))
		{
			$error =1;
		}
		else {
			$error = 0;
		}
		$update_rfq_query = "UPDATE $tbl_rfq
												SET
												po_status='pending'
												where rfq_id ='$modal_id'";
		if(mysqli_query($conn, $update_rfq_query))
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
	if ($error==1)
	{
		echo "Done";
		//On Successful
		// fn_add_activity_log("RFQ",$enquiry_id,"RFQ Updated",$user_id,$conn);

		// header("Location:../../html/view_rfq_html.php?id=".$modal_id."");
	}
	else
	{
		//On Error
		$_SESSION['error']=mysqli_error($conn);

		echo "Error";

		// header("Location:../../extra/error.php");
	}
	// Now that you have it working, I recommend adding some checks on the files.
	// Example: Max size, allowed file types, etc.
?>
