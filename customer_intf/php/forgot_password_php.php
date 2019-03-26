<?php
	//Start New Or Resume Existing Session
	session_start();
	
	//Include Database Connection
	include_once '../../dbconnect/dbconnect.php';
	//Include PHPMailerAutoload.php Class
	include 'mail/phpmailer/PHPMailerAutoload.php';
	include 'constants.php';
	$url = $GLOBALS['url'];

	$email = mysqli_real_escape_string($conn,$_POST['login_email']);
	//Query data
	$query="SELECT * FROM customer WHERE email='$email'";
	$res=mysqli_query($conn ,$query);
	$row = mysqli_fetch_array($res , MYSQLI_ASSOC);
	$count = mysqli_num_rows($res); //if record exists 
	$mail = $row['email'];
	$name=$row['name'];

	if($count==1) //To verify entered email id 
	{
		//Create a unique salt that will never leave PHP unencrypted.
		$salt = "498#2D83B631%3800EBD!801600D*7E3CC13";

		//Create the unique user password reset key
		$password = hash('sha512', $salt.$row['email']);

		//Create a url which we will direct them to reset their password
		$pwrurl = $url."/html/reset_html.php?q=".$password."&email=".$email;

		$mailbody = "Dear " . $name . ",<br><br>If this e-mail does not apply to you please ignore it. It appears that you have requested a password reset at our Smartstorey Internal Operations Managing Application.<br><br>To reset your password, please click the link below. If you cannot click it, please paste it into your web browser's address bar.<br><br>" . $pwrurl . "<br><br>Thanks,<br>";

		$from_email = "bangalore@smartstorey.com";                  
		$password = "bang@1234";
		$to_id = $email;
		$message = $mailbody;
		$subject = "Password Reset";

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
			?><script>alert('<?php echo $pwrurl; ?>');</script><?php
		} 

		else 
		{
			header('Location: ../../html/forgot_pass_key_sent.php');
			exit;
		}
	} 
	else
	{
		$_SESSION['errMsg'] = "Email address is not registered with us";
		header('Location:../html/forgot_password_html.php');
	}
	//Close Mysqli Connection
	mysqli_close($conn);
?>