<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';
	include '../../constants.php';
	// include '../../php/add/add_activity_log.php';

	//Table Names
	$tbl_customer = "customer";
	$tbl_project="project";
	$tbl_contact="contacts";

	$error=0;

	//Store Posted Data To PHP Variable
	$customer_name= ucwords(mysqli_real_escape_string($conn,$_POST['customer_name']));
	$customer_city= null;
	$customer_address= null;
	$customer_type_of_firm= Null;
	$customer_contact_person= Null;
	$customer_contact_number= mysqli_real_escape_string($conn,$_POST['contact_number']);
	$customer_email= strtolower(mysqli_real_escape_string($conn,$_POST['customer_email']));
	$customer_alternate_email= null;
	$gst_number= null;
	$billing_address= null;
	$customer_alternate_contact=null;
	$customer_additional_info=null;
	$category = implode(",",$_POST['ui_category_name']);
	$role = ($_POST['ui_customer_role'] == "admin"? "user_admin":"user_user");
	$user_id= mysqli_real_escape_string($conn,$_POST['user_id']);
	$user_id = NULL;
	$location=mysqli_real_escape_string($conn,$_POST['location']);
	$subset = mysqli_real_escape_string($conn,$_POST['group_id']);
	$password=md5(12345);
	//Insert Query
	$query1 = "INSERT INTO $tbl_customer(customer_name,customer_city,customer_address,customer_type_of_firm,customer_contact_person,customer_contact_number,customer_alternate_contact_number,customer_email,customer_alternate_email,gst_number,billing_address,customer_additional_info,location ,subset,role,delete_status,password,category) VALUES ('$customer_name','$customer_city','$customer_address','$customer_type_of_firm','$customer_contact_person','$customer_contact_number','$customer_alternate_contact','$customer_email','$customer_alternate_email','$gst_number','$billing_address','$customer_additional_info','$location','$subset','$role',0,'$password','$category')";
	//Execute The Query

	if(mysqli_query($conn, $query1))
	$error=1;

	//Get Last Inserted Id of Customer Table and Create an Adhoc Project a Customer
	$last_inserted_id=mysqli_insert_id($conn);

	//Store data to contact table
	if(isset($_POST)==true && empty($_POST)==false):
		//Store Posted Data To PHP Variable
		$contact_person_name=$_POST['ui_contact_person_name'];
		$contact_number=$_POST['ui_contact_number'];
		$contact_alternate_number=$_POST['ui_alternate_contact_number'];
		$contact_person_email=$_POST['ui_contact_person_email'];
		$contact_alternative_email=$_POST['ui_contact_person_alternate_email'];

		foreach($contact_person_name as $a => $b)
		{
			//Pass each variable from php variable array to php variable
			$v_contact_person_name=$contact_person_name[$a];
			$v_contact_number=$contact_number[$a];
			$v_contact_alternate_number=$contact_alternate_number[$a];
			$v_contact_person_email=$contact_person_email[$a];
			$v_contact_alternative_email=$contact_alternative_email[$a];
			//Insert Query
			$query4 = "INSERT INTO $tbl_contact(contact_module_name,contact_module_id,contact_person_name,contact_person_contact_number,contact_person_alternate_contact_number,contact_person_email,contact_person_alternate_email,delete_status) VALUES ('Customer','$last_inserted_id','$v_contact_person_name','$v_contact_number','$v_contact_alternate_number','$v_contact_person_email','$v_contact_alternative_email',0)";

			if(mysqli_query($conn, $query4))
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
				$query3="INSERT INTO `photo` (module_id,module_name,photo_name) VALUES ('$last_inserted_id','customer','$image_name')";

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
		// fn_add_activity_log("Customer",$last_inserted_id,"Customer Created",$user_id,$conn);

		header("Location:".$GLOBALS['view_user_html']."?id=".$last_inserted_id."");
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
