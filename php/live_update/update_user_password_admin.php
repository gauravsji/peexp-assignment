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
	$user_id = mysqli_real_escape_string($conn,$_POST['user_id']);
	$to_email= mysqli_real_escape_string($conn,$_POST['user_email']);
	
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
	$random_pwd = randomPassword();
	$hashed_password=md5($random_pwd); 
	//Execute the query
	$query = "UPDATE users SET password ='$hashed_password' WHERE id = '$user_id'";
	if (mysqli_query($conn, $query)) 
	{
		//Mail to the User
		$mailbody = "Congratulation, your password has been successfully reset. <br>Login to internal.smartstorey.com with your updated password '".$random_pwd."' . <br> Please contact Bangalore@smartstorey.com for any queries.";
		
		$from_email = "developer@smartstorey.com";                  
		$password = "developer@1";
		$to_id = $to_email;
		$message = $mailbody;
		$subject = "Password Reset Successful";

		$mail = new PHPMailer;
		$mail->Host = 'smtp.zoho.com';
		$mail->Port =465;
		$mail->SMTPSecure = 'tls';
		$mail->SMTPAuth = true;
		$mail->Username = $from_email;
		$mail->Password = $password;
		$mail->setFrom('developer@smartstorey.com', 'Smartstorey LLP');
		$mail->addReplyTo('developer@smartstorey.com', 'Smartstorey LLP');
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
		$mailbody_admin="Dear Admin, <br> User password has been reset to '".$random_pwd."' at internal.smartstorey.com. These are the following details.<br><br>Name: " . $name . "<br>Email: " . $to_email ."";
		$adminmail="vikas.jain@smartstorey.com";

		$from_email = "developer@smartstorey.com";                  
		$password = "developer@1";
		$to_id = "developer@smartstorey.com";
		$message = $mailbody_admin;
		$subject = "New User Registered";

		$mail = new PHPMailer;
		$mail->Host = 'smtp.zoho.com';
		$mail->Port =465;
		$mail->SMTPSecure = 'tls';
		$mail->SMTPAuth = true;
		$mail->Username = $from_email;
		$mail->Password = $password;
		$mail->setFrom('developer@smartstorey.com', 'Smartstorey LLP');
		$mail->addReplyTo('developer@smartstorey.com', 'Smartstorey LLP');
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
		//header("Location:../../html/register_success_html.php");
	}
	else
	{
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	
	mysqli_close($conn);
?>