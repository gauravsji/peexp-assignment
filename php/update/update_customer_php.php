<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';
	include '../../php/add/add_activity_log.php';

	//Table Names
	$tbl_name = "customer";
	$tbl_contact="contacts";
	$tb2_contact="category";

	//Store Posted Data To PHP Variable
	$customer_id= mysqli_real_escape_string($conn,$_POST['customer_id']);
	$customer_name= ucwords(mysqli_real_escape_string($conn,$_POST['customer_name']));
	$customer_city= mysqli_real_escape_string($conn,$_POST['customer_city']);
	$customer_address= mysqli_real_escape_string($conn,$_POST['customer_address']);
	$billing_address= mysqli_real_escape_string($conn,$_POST['billing_address']);
	$customer_type_of_firm= mysqli_real_escape_string($conn,$_POST['type_of_firm']);
	$customer_contact_person= ucwords(mysqli_real_escape_string($conn,$_POST['contact_person']));
	$customer_contact_number= mysqli_real_escape_string($conn,$_POST['contact_number']);
	$customer_email= strtolower(mysqli_real_escape_string($conn,$_POST['customer_email']));
	$customer_alternate_email= strtolower(mysqli_real_escape_string($conn,$_POST['customer_alternate_email']));
	$gst_number= mysqli_real_escape_string($conn,$_POST['ui_gst_number']);
	$customer_alternate_contact=mysqli_real_escape_string($conn,$_POST['customer_alternate_contact']);
	$customer_additional_info=mysqli_real_escape_string($conn,$_POST['additional_info']);
	$user_id=mysqli_real_escape_string($conn,$_POST['user_id']);
	$firm_name = mysqli_real_escape_string($conn,$_POST['firm_name']);

	//Update Query
	$sql = "UPDATE $tbl_name
	SET
	firm_name = '$firm_name',
	customer_name = '$customer_name',
	customer_city='$customer_city',
	customer_address='$customer_address',
	billing_address='$billing_address',
	customer_type_of_firm='$customer_type_of_firm',
	customer_contact_person='$customer_contact_person',
	customer_contact_number='$customer_contact_number',
	customer_email='$customer_email',
	customer_alternate_email='$customer_alternate_email',
	gst_number = '$gst_number',
	customer_alternate_contact_number='$customer_alternate_contact',
	customer_additional_info='$customer_additional_info'
	WHERE customer_id = '$customer_id'";

	//Execute The Query
	if (mysqli_query($conn, $sql))
	{
		$error=1;
	}


		//Determine's if a variable is set and is not NULL or Determine's whether a variable is empty
	if(isset($_POST)==true && empty($_POST)==false):
		//Get product_set_attribute data from edit_product_html.php
		$contact_id=$_POST['ui_customer_contact_id'];
		$pcount=count($contact_id);
		$contact_person_name=$_POST['ui_contact_person_name'];
		$contact_person_contact_number=$_POST['ui_contact_number'];
		$contact_person_alternate_contact_number=$_POST['ui_alternate_contact_number'];
		$contact_email=$_POST['ui_contact_person_email'];
		$contact_alternate_email=$_POST['ui_contact_person_alternate_email'];

		//Get product_set_attribute_id and convert it to coma separated values in order to check if it already exists or not
		$string = rtrim(implode(',', $contact_id), ',');
		if($string != '')
		{
			$update_delete_status_contact_sql = "UPDATE $tbl_contact
			SET delete_status=1
			WHERE contact_id NOT IN ($string) AND contact_module_id='$customer_id' and contact_module_name='Customer'";

			if(mysqli_query($conn, $update_delete_status_contact_sql))
			{
				$error=1; //Query executed successfully
			}
			else
			{
				$error=0;
				//echo "</br>Updating Product Set Attribute to delete Error: " . mysqli_connect_error(); //ERROR OCCURRED
			}
		}
		foreach($contact_person_name as $a => $b)
		{
			//Get product_set_attribute array data individually from data obtained from edit_product_html.php in the previous if loop
			$v_contact_id=$contact_id[$a];
			$v_contact_person_name=$contact_person_name[$a];
			$v_contact_person_contact_number=$contact_person_contact_number[$a];

			$v_contact_person_alternate_contact_number=$contact_person_alternate_contact_number[$a];
			$v_contact_email=$contact_email[$a];

			$v_contact_alternate_email=$contact_alternate_email[$a];

			//echo "</br></br>Product set Att Id: ".$v_contact_id;
			//echo "</br>Attribute Id: ".$v_contact_person_name;
			//echo "</br>Attribute Value: ".$v_attribute_value;

			$sql_tbl_contact_update = "UPDATE $tbl_contact
			SET
			contact_person_name='$v_contact_person_name',
			contact_person_contact_number='$v_contact_person_contact_number',
			contact_person_alternate_contact_number='$v_contact_person_alternate_contact_number',
			contact_person_email='$v_contact_email',
			contact_person_alternate_email='$v_contact_alternate_email'
			WHERE contact_id=$v_contact_id";
			mysqli_query($conn, $sql_tbl_contact_update);

			if(mysqli_affected_rows($conn)>-1)
			{
				$error = 1;
			}
			else
			{
			//echo "</br>block 5 insert attribute" ;
			$insert_contact = "INSERT INTO $tbl_contact(contact_module_name,contact_module_id,contact_person_name,contact_person_contact_number,contact_person_alternate_contact_number,contact_person_email,contact_person_alternate_email,delete_status) VALUES ('Customer','$customer_id','$v_contact_person_name','$v_contact_person_contact_number','$v_contact_person_alternate_contact_number','$v_contact_email','$v_contact_alternate_email',0)";
			mysqli_query($conn, $insert_contact);
			}
		}
	endif;

	if(isset($_POST)==true && empty($_POST)==false):
	  //Store Posted Data To PHP Variable
	  $subuser_name=$_POST['subuser_name'];
	  $subuser_contact_number=$_POST['subuser_contact_number'];
	  $subuser_email=$_POST['subuser_email'];
	  $subuser_role=$_POST['subuser_role'];
	  $subuser_status=$_POST['subuser_status'];
		$subuser_id = $_POST['subuser_id'];

	  foreach($subuser_name as $a => $b)
	  {
	  $v_subuser_name=$subuser_name[$a];
	  $v_subuser_contact_number=$subuser_contact_number[$a];
	  $v_subuser_email=$subuser_email[$a];
	  $v_subuser_role=($subuser_role[$a] == 'admin')?"user_admin":"user_user";
	  $v_subuser_status=$subuser_status[$a];
		$v_subuser_id = $subuser_id[$a];
	  //Insert Query


	    //echo "</br></br>Product set Att Id: ".$v_contact_id;
	    //echo "</br>Attribute Id: ".$v_contact_person_name;
	    //echo "</br>Attribute Value: ".$v_attribute_value;
			if($v_subuser_id != $customer_id)
			{
				$sql_tbl_contact_update = "UPDATE $tbl_name
				SET
				customer_name='$v_subuser_name',
				customer_contact_number='$v_subuser_contact_number',
				customer_email='$v_subuser_email',
				subuser_status='$v_subuser_status',
				role = '$v_subuser_role',
				subset='$customer_id'
				WHERE customer_id='$v_subuser_id'";
				if($v_subuser_id != '')
				{
						mysqli_query($conn, $sql_tbl_contact_update);
				}
				else {

					$subuser_query = "INSERT INTO $tbl_name(customer_name,firm_name,customer_contact_number,
						customer_email,data_entered_by_admin,subset,role,subuser_status,password) VALUES ('$v_subuser_name','$firm_name',
							'$v_subuser_contact_number','$v_subuser_email','$user_id','$customer_id','$v_subuser_role','$v_subuser_status','25f9e794323b453885f5181f1b624d0b')";
					mysqli_query($conn, $subuser_query);
				}
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
		$target_path = $target_path .  $filename . "." . $ext[count($ext) - 1];//set the target path with a new name of image
        $j = $j + 1;//increment the number of uploaded images according to the files in array

	  if (($_FILES["file"]["size"][$i] < 10000000) && in_array($file_extension, $validextensions)) //Approx 10 MB File size
		{
            if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path))
			{
				$image_name= $filename. "." . $ext[count($ext) - 1];
				//Insert Query
				$query3="INSERT INTO `photo` (module_id,module_name,photo_name) VALUES ('$customer_id','customer','$image_name')";

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



	if($error==1)
	{
		//On Successful
		fn_add_activity_log("Customer",$customer_id,"Customer Updated",$user_id,$conn);
		header("Location:../../html/view_customer_html.php?id=". $customer_id . "");
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
