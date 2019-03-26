<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';
	include '../../php/add/add_activity_log.php';
	include '../mail/phpmailer/PHPMailerAutoload.php';
	//Table Names
	$tbl_customer = "customer";
	$tbl_project="project";
	$tbl_contact="contacts";
	$tbl_category="category";

	$error=0;

	//Store Posted Data To PHP Variable
	$customer_name= ucwords(mysqli_real_escape_string($conn,$_POST['customer_name']));
	$firm_name= ucwords(mysqli_real_escape_string($conn,$_POST['firm_name']));
	$customer_city= mysqli_real_escape_string($conn,$_POST['customer_city']);
	$customer_address= mysqli_real_escape_string($conn,$_POST['customer_address']);
	$customer_type_of_firm= mysqli_real_escape_string($conn,$_POST['type_of_firm']);
	$customer_contact_person= ucwords(mysqli_real_escape_string($conn,$_POST['contact_person']));
	$customer_contact_number= mysqli_real_escape_string($conn,$_POST['contact_number']);
	$customer_email= strtolower(mysqli_real_escape_string($conn,$_POST['customer_email']));
	$customer_alternate_email= strtolower(mysqli_real_escape_string($conn,$_POST['customer_alternate_email']));
	$gst_number= mysqli_real_escape_string($conn,$_POST['ui_gst_number']);
	$billing_address= mysqli_real_escape_string($conn,$_POST['billing_address']);
	$customer_alternate_contact=mysqli_real_escape_string($conn,$_POST['customer_alternate_contact']);
	$customer_additional_info=mysqli_real_escape_string($conn,$_POST['additional_info']);
	$user_id= mysqli_real_escape_string($conn,$_POST['user_id']);
	//$location=mysqli_real_escape_string($conn,$_POST['location']);
	//Insert Query
	$query1 = "INSERT INTO $tbl_customer(customer_name,firm_name,customer_city,customer_address,customer_type_of_firm,customer_contact_person,customer_contact_number,customer_alternate_contact_number,customer_email,customer_alternate_email,gst_number,billing_address,customer_additional_info,data_entered_by,location,subset,role,password) VALUES ('$customer_name','$firm_name','$customer_city','$customer_address','$customer_type_of_firm','$customer_contact_person','$customer_contact_number','$customer_alternate_contact','$customer_email','$customer_alternate_email','$gst_number','$billing_address','$customer_additional_info','$user_id','','admin','customer_admin','25f9e794323b453885f5181f1b624d0b')";

	//Execute The Query
	if(mysqli_query($conn, $query1))
	$error=1;

	//Get Last Inserted Id of Customer Table and Create an Adhoc Project a Customer
	$last_inserted_id=mysqli_insert_id($conn);
	//Insert Query
	$query2 = "INSERT INTO project(customer_id,project_name,project_client_name,project_site_address,project_site_incharge_name,project_type_of_project,data_entered_by,billing_details,location,delete_status) VALUES ('$last_inserted_id','Ad Hoc','','$customer_address','','','$user_id','$billing_address','$customer_city',0)";
	//Execute The Query
	if(mysqli_query($conn, $query2)){
	$error=1;
	//Mail to the User
		$mailbody = "Congratulation, you have been successfully registered with my.smartstorey.com . Please log on to my.smartstorey.com with your email and initial pasword as 123456789 <br>Please contact Bangalore@smartstorey.com for any queries.";
		$from_email = "bangalore@smartstorey.com";
		$password = "bang@1234";
		$to_id = $customer_email;
		$message = $mailbody;
		$subject = "Registration Successful";
			$mail = new PHPMailer;
			$mail->Host = 'smtp.zoho.com';
			$mail->Port =465;
			$mail->SMTPSecure = 'tls';
			$mail->SMTPAuth = true;
			$mail->Username = $from_email;
			$mail->Password = $password;
			$mail->setFrom('bangalore@smartstorey.com', 'Smartstorey LLP');
			$mail->addReplyTo('bangalore@smartstorey.com', 'Smartstorey LLP');
			$mail->addAddress($to_id);
			$mail->Subject = $subject;
			$mail->msgHTML($message);
		if (!$mail->send())
		{
			$mail_error = "Mailer Error: " . $mail->ErrorInfo;
			$error = 1;
			//echo $error;
		}
	}


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

	//Store data to category table
	if(isset($_POST)==true && empty($_POST)==false):
		//Store Posted Data To PHP Variable
		$category_name=$_POST['cate_name'];
		$category_description=$_POST['cate_description'];
		foreach($category_name as $a => $b)
		{
			//Pass each variable from php variable array to php variable
			$category_name1=$category_name[$a];
			$category_description1=$category_description[$a];
			//Insert Query
			$query5 = "INSERT INTO $tbl_category(category_name,category_description,data_entered_by,data_entered_by_customer,location) VALUES ('$category_name1','$category_description1','$user_id','$last_inserted_id','$customer_city')";
			if(mysqli_query($conn, $query5))
			$error=1;
		}
	endif;

	//Store data to Sub-User table
	if(isset($_POST)==true && empty($_POST)==false):
		//Store Posted Data To PHP Variable
		$subuser_name=$_POST['subuser_name'];
		$subuser_contact_number=$_POST['subuser_contact_number'];
		$subuser_email=$_POST['subuser_email'];
		$subuser_role=$_POST['subuser_role'];
		$subuser_status=$_POST['subuser_status'];

		foreach($subuser_name as $a => $b)
		{
			//Pass each variable from php variable array to php variable
			$v_subuser_name=$subuser_name[$a];
			$v_subuser_contact_number=$subuser_contact_number[$a];
			$v_subuser_email=$subuser_email[$a];
			$v_subuser_role=$subuser_role[$a];
			$v_subuser_status=$subuser_status[$a];
			//Insert Query
			$subuser_query = "INSERT INTO $tbl_customer(customer_name,firm_name,customer_type_of_firm,customer_contact_number,customer_email,data_entered_by,customer_city,subset,role,subuser_status,password) VALUES ('$v_subuser_name','$firm_name','$customer_type_of_firm','$v_subuser_contact_number','$v_subuser_email','$user_id','$customer_city','$last_inserted_id','$v_subuser_role','$v_subuser_status','25f9e794323b453885f5181f1b624d0b')";
			if(mysqli_query($conn, $subuser_query))
			$error=1;
			//Mail to the User
				$mailbody = "Congratulation, you have been successfully registered with my.smartstorey.com. Please log on to my.smartstorey.com with your email and initial pasword as 123456789 <br>Please contact Bangalore@smartstorey.com for any queries.";

				$from_email = "bangalore@smartstorey.com";
				$password = "bang@1234";
				$to_id = $v_subuser_email;
				$message = $mailbody;
				$subject = "Registration Successful";

				$mail = new PHPMailer;
				$mail->Host = 'smtp.zoho.com';
				$mail->Port =465;
				$mail->SMTPSecure = 'tls';
				$mail->SMTPAuth = true;
				$mail->Username = $from_email;
				$mail->Password = $password;
				$mail->setFrom('bangalore@smartstorey.com', 'Smartstorey LLP');
				$mail->addReplyTo('bangalore@smartstorey.com', 'Smartstorey LLP');
				$mail->addAddress($to_id);
				$mail->Subject = $subject;
				$mail->msgHTML($message);

				if (!$mail->send())
				{
					$mail_error = "Mailer Error: " . $mail->ErrorInfo;
					$error = 1;
					//echo $error;
				}
			$subuser_last_id=mysqli_insert_id($conn);
		}
	endif;


	//Store data to subuser table
	if(isset($_POST)==true && empty($_POST)==false):
		//Store Posted Data To PHP Variable
		$subuser_cate_name=$_POST['subuser_cate_name'];
		foreach($subuser_cate_name as $a => $b)
		{
			//Pass each variable from php variable array to php variable
			$v_subuser_cate_name=$subuser_cate_name[$a];
			//Insert Query
			$query_cate = "INSERT INTO $tbl_category(category_name,category_description,data_entered_by,data_entered_by_customer,location) VALUES ('$v_subuser_cate_name','','$user_id','$subuser_last_id','$customer_city')";
			if(mysqli_query($conn, $query_cate))
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
                echo '<br/><br/><span id="error">please try again!.</span><br/><br/>' ;
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
		fn_add_activity_log("Customer",$last_inserted_id,"Customer Created",$user_id,$conn);
		header("Location:../../html/view_customer_html.php?id=".$last_inserted_id."");
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
