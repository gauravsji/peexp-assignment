<?php
	//Start New Or Resume Existing Session
	session_start();
	
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';
	//Include PHPMailerAutoload.php Class
	include '../mail/phpmailer/PHPMailerAutoload.php';
	
	// Table Names
	$tbl_name = "users"; 

	//Store Posted Data To PHP Variable
	$name= mysqli_real_escape_string($conn,$_POST['register_name']);
	$to_email= mysqli_real_escape_string($conn,$_POST['register_email']);
	$password1 = mysqli_real_escape_string($conn,$_POST['register_password1']);
	$password2 = mysqli_real_escape_string($conn,$_POST['register_password2']);
	$location = mysqli_real_escape_string($conn,$_POST['location']);
	$roles = mysqli_real_escape_string($conn,$_POST['role']);

	$query = "SELECT * FROM $tbl_name WHERE email='$to_email'";
	$res   = mysqli_query($conn, $query);
	if ($res->num_rows) 
	{
		//If User exists
		$_SESSION['errMsg'] = "Email address already exists";
		header("Location:../../html/register_html.php");
		exit();
	} 
	else 
	{
		if ($password1 == $password2) 
		{
			// Encrypted Password with md5
			$hashed_password=md5($password1); 
			//Execute the query
			$query = "INSERT INTO $tbl_name(name,email,password,role,location,login_count) VALUES ('$name','$to_email','$hashed_password','$roles','$location',0)";
			if (mysqli_query($conn, $query)) 
			{
				//Mail to the User
				$mailbody = "Congratulation, you have been successfully registered with internal.smartstorey.com. <br>Login to internal.smartstorey.com with your email and initial password 123456789 . <br> Please contact Bangalore@smartstorey.com for any queries.";
				
				$from_email = "bangalore@smartstorey.com";                  
				$password = "bang@1234";
				$to_id = $to_email;
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
					?><script>alert('<?php echo $error ?>');</script><?php
				} 
				else 
				{

				}
				//Mail to Admin
				$mailbody_admin="Dear Admin, <br> New user has been registered at internal.smartstorey.com. These are the following details.<br><br>Name: " . $name . "<br>Email: " . $to_email ."";
				$adminmail="vikas.jain@smartstorey.com";

				$from_email = "bangalore@smartstorey.com";                  
				$password = "bang@1234";
				$to_id = "bangalore@smartstorey.com";
				$message = $mailbody_admin;
				$subject = "New User Registered";

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
					?><script>alert('<?php echo $error ?>');</script><?php
				} 

				else 
				{
				
				}
				header("Location:../../html/register_success_html.php");
			}
			else
			{
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		} 
		else 
		{
			$_SESSION['errMsg'] = "Enter same password";
			header("Location:../../html/register_html.php");
		}
	}
	mysqli_close($conn);
?>