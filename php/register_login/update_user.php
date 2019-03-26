<?php
	//Include Database Connection
	include_once '../../dbconnect/dbconnect.php';
	//Include PHPMailerAutoload.php Class
	include '../mail/phpmailer/PHPMailerAutoload.php';
	
	//Table Name
	$tbl_name = "users"; 
	
	//Store Posted Data To PHP Variable
	$id= mysqli_real_escape_string($conn,$_POST["ui_user_id"]);
	$name = mysqli_real_escape_string($conn,$_POST["name"]);
	$email =  mysqli_real_escape_string($conn,$_POST["email"]);
	$role =  mysqli_real_escape_string($conn,$_POST["role"]);
	$location =  mysqli_real_escape_string($conn,$_POST["location"]);
	$authenticate =  mysqli_real_escape_string($conn,$_POST["authenticate"]);
	$phone_number = mysqli_real_escape_string($conn,$_POST["phone_number"]);	
	$alternate_phone_number = mysqli_real_escape_string($conn,$_POST["alternate_phone_number"]);
	
	$date = explode('/', mysqli_real_escape_string($conn, $_POST['date_of_join']));
	$time = mktime(0,0,0,$date[1],$date[0],$date[2]);
	$date_of_join = date( 'Y-m-d', $time );
		
	$date = explode('/', mysqli_real_escape_string($conn, $_POST['date_of_birth']));
	$time = mktime(0,0,0,$date[1],$date[0],$date[2]);
	$date_of_birth = date( 'Y-m-d', $time );
	
	$address =  mysqli_real_escape_string($conn,$_POST["address"]);	
	
	
		$query = "UPDATE $tbl_name SET name='$name',email='$email',role='$role',location='$location' , phone_number='$phone_number', alternate_phone_number='$alternate_phone_number',date_of_join='$date_of_join', date_of_birth='$date_of_birth', address='$address', authenticate='$authenticate' WHERE id=".$id;
			if (mysqli_query($conn, $query)) 
			{
				if($authenticate==1)
				{
					//Mail to the User
					$mailbody = "Greetings your information has been successfully updated with internal.smartstorey.com. <br>Please log on to internal.smartstorey.com with your login credentials. <br>Contact Bangalore@smartstorey.com for any queries. Have a nice day";
					$from_email = "bangalore@smartstorey.com";                  
					$password = "bang@1234";
					$to_id = $email;
					$message = $mailbody;
					$subject = "Data Updated Successful";

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
					} 				
					echo "Data Added";
				}
				else
				{
					echo "Data Added";
				}
				
			}
	//}
	mysqli_close($conn);
?>