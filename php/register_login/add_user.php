<?php
	//Include Database Connection
	include_once '../../dbconnect/dbconnect.php';
	//Include PHPMailerAutoload.php Class
	include '../mail/phpmailer/PHPMailerAutoload.php';
	
	//Table Name
	$tbl_name = "users"; 
	
	//Store Posted Data To PHP Variable
	$name = mysqli_real_escape_string($conn,$_POST["name"]);
	$email =  mysqli_real_escape_string($conn,$_POST["email"]);
	$role =  mysqli_real_escape_string($conn,$_POST["role"]);
	$location =  mysqli_real_escape_string($conn,$_POST["location"]);
	
	$phone_number = mysqli_real_escape_string($conn,$_POST["phone_number"]);	
	$alternate_phone_number = mysqli_real_escape_string($conn,$_POST["alternate_phone_number"]);
	
	$date = explode('/', mysqli_real_escape_string($conn, $_POST['date_of_join']));
	$time = mktime(0,0,0,$date[1],$date[0],$date[2]);
	$date_of_join = date( 'Y-m-d', $time );
		
	$date = explode('/', mysqli_real_escape_string($conn, $_POST['date_of_birth']));
	$time = mktime(0,0,0,$date[1],$date[0],$date[2]);
	$date_of_birth = date( 'Y-m-d', $time );
	
	
	$address =  mysqli_real_escape_string($conn,$_POST["address"]);	

	function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
	}
	$hashed_password=md5(randomPassword()); 

	$query = "SELECT * FROM $tbl_name WHERE email='$email'";
	$res   = mysqli_query($conn, $query);
	if ($res->num_rows) 
	{
		//If User exists
		echo "Email address already exists";
		exit();
	} 
	else 
	{
		$query = "INSERT INTO $tbl_name(name,email,password, phone_number, alternate_phone_number, date_of_join, date_of_birth,address,role,location,login_count,authenticate) VALUES ('$name','$email','$hashed_password','$phone_number','$alternate_phone_number','$date_of_join','$date_of_birth','$address','$role','$location',0,1)";
			if (mysqli_query($conn, $query)) 
			{
				//Get Last Inserted ID
				$last_inserted_id=mysqli_insert_id($conn);
				$sql_test = "SELECT role FROM users where id='" . $last_inserted_id."'";
				$result_test = mysqli_query($conn, $sql_test);
				$user_test_result = mysqli_fetch_array($result_test,MYSQLI_ASSOC);

				if($user_test_result['role']=="Admin")
				{
				$query_settings = "INSERT INTO settings(`user_id`, `view_all_daily_log`, `view_all_sales_lead`, `view_all_enquiry`, `view_all_sales_order`, `view_all_customer`, `view_all_product_set`, `view_all_product`, `view_all_category`, `view_all_sub_category`, `view_all_brand`, `view_all_vendor`, `view_all_task`, `view_all_payment`, `view_all_transport_team`, `view_all_sample`,`view_key_value`) VALUES ('$last_inserted_id',0,0,0,0,0,1,1,1,1,1,0,0,0,0,0,1)";
				}
				else
				{
					$query_settings = "INSERT INTO settings(`user_id`, `view_all_daily_log`, `view_all_sales_lead`, `view_all_enquiry`, `view_all_sales_order`, `view_all_customer`, `view_all_product_set`, `view_all_product`, `view_all_category`, `view_all_sub_category`, `view_all_brand`, `view_all_vendor`, `view_all_task`, `view_all_payment`, `view_all_transport_team`, `view_all_sample`,`view_key_value`) VALUES ('$last_inserted_id',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0)";
				}
				mysqli_query($conn, $query_settings);
				echo "User Data Successfully Added";
				//Mail to the User
				$mailbody = "Congratulation, you have been successfully registered with internal.smartstorey.com. Please log on to internal.smartstorey.com with your email and initial pasword as '".randomPassword()."' <br>Please contact Bangalore@smartstorey.com for any queries.";
				
				$from_email = "bangalore@smartstorey.com";                  
				$password = "bang@1234";
				$to_id = $email;
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
					$error = "Mailer Error: " . $mail->ErrorInfo;
					//echo $error;
				} 
			}
	}
	mysqli_close($conn);
?>