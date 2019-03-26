<?php
//Start New Or Resume Existing Session
session_start();
//Include Database Connection
include '../../dbconnect/dbconnect.php';
require '../../../vendor/autoload.php';
include '../../constants.php';
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

//Table Names
$tbl_name = "rfq";
$error=0;

//Store Posted Data To PHP Variable
$draft_id= mysqli_real_escape_string($conn,$_POST['ui_enquiry_id']);
$date = explode('/', mysqli_real_escape_string($conn, $_POST['ui_rfq_date']));
$time = mktime(0,0,0,$date[1],$date[0],$date[2]);
$enquiry_date = date( 'Y-m-d', $time );

$end_date = explode('/', mysqli_real_escape_string($conn, $_POST['ui_rfq_edd']));
$time = mktime(0,0,0,$end_date[1],$end_date[0],$end_date[2]);
$enquiry_end_date = date( 'Y-m-d', $time );

if(!(isset($_POST['ui_customer_name'])))
{
	$customer_id = NULL;
}
else $customer_id =  mysqli_real_escape_string($conn,$_POST['ui_customer_name']);

if(!(isset($_POST['ui_project_name'])))
{
	$project_id = 'NULL';
}
else $project_id =  mysqli_real_escape_string($conn,$_POST['ui_project_name']);

$assigne_name = mysqli_real_escape_string($conn,$_POST['enquired_by']);
$project_priority = mysqli_real_escape_string($conn,$_POST['ui_enquiry_priority']);
$rfq_name = mysqli_real_escape_string($conn,$_POST['enquiry_name']);
$rfq_details = mysqli_real_escape_string($conn ,$_POST['enquiry_details']);
$remarks = mysqli_real_escape_string($conn ,$_POST['remarks']);
if($_POST['ui_enquiry_status'] == 'Quote Received')
{
	$enquiry_status = "Rework Requested";
}
else
{
	$enquiry_status = $_POST['ui_enquiry_status'];
}

//Update Query
$sql1 = "UPDATE $tbl_name
SET
enquiry_name='$rfq_name',
project_id = $project_id,
enquiry_details='$rfq_details',
enquiry_assignee='$customer_id',
enquiry_status='$enquiry_status',
end_date = '$enquiry_end_date',
enquiry_priority='$project_priority',
po_status = 'pending',
updated_at =  CURDATE()
WHERE rfq_id = $draft_id";


if(mysqli_query($conn, $sql1))
{
	$error=1;
}
else
{
	$error=0;
}
$j = 0; //Variable for indexing uploaded image

    for ($i = 0; $i < count($_FILES['file']); $i++)
	{

		//loop to get individual element from the array
		// $target_path = "../../uploads/"; //Declaring Path for uploaded images
        $validextensions = array("jpeg", "jpg", "png","pdf","doc","docx","xlsx","xls","txt","JPEG", "JPG", "PNG","PDF","DOC","DOCX","XLSX","XLS","TXT");  //Extensions which are allowed
        $ext = explode('.', basename($_FILES['file']['name'][$i]));//explode file name from dot(.)
        $file_extension = end($ext); //store extensions in the variable
        $filename=md5(uniqid());
		// $target_path = $target_path .  $filename . "." . $ext[count($ext) - 1];//set the target path with a new name of image
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
			$query ="INSERT INTO `photo` (module_id,module_name,photo_name,delete_status) VALUES ('$draft_id','rfq','$pathInS3',0)";

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
	// fn_add_activity_log("RFQ",$enquiry_id,"RFQ Updated",$user_id,$conn);

	header("Location:".$GLOBALS['edit_rfq_html']."?id=".$draft_id."");
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
