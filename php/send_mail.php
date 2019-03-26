<?php 
/*
Date: 29/06/2017
Developer: Punith Bandodekar
Email: visitpunith@ymail.com
Company: Smartstorey LLP

EXAMPLE SEND EMAIL FUNCTION ARGUMENTS
$mail_from_address: From which mail id you will be sending mail
$mail_password:  From mail password
$mail_to_address:  To which mail address email should be sent
$mail_subject:  Subject of the email
$mail_body:  Body of the email
$mail_host: smtp.zoho.com
$mail_port: 465
$mail_title: Smartstorey
*/
function send_email($mail_from_address,$mail_password,$mail_to_address,$mail_subject,$mail_body,$mail_host,$mail_port,$mail_title,$mail_cc)
{
	$mail = new PHPMailer;	//New PHPmailer Object

	$mail->Host = $mail_host;	//Specify main and backup SMTP servers

	$mail->Port =$mail_port;	//TCP port to connect to

	$mail->SMTPSecure = 'tls';	//Enable TLS encryption, `ssl` also accepted

	$mail->SMTPAuth = true;	//Enable SMTP authentication

	$mail->Username = $mail_from_address;	//SMTP username

	$mail->Password = $mail_password;	//SMTP password

	$mail->setFrom($mail_from_address, $mail_title);	//Enter the address that the e-mail should appear to come from. The optional second parameter to this function is the name that will be displayed as the sender instead of the email address itself.

	$mail->addReplyTo($mail_from_address, $mail_title);

	$mail->addBCC($mail_from_address);

	$to_addresses = explode(',', $mail_to_address);
	foreach ($to_addresses as $to_address) 
	{
		$mail->addAddress($to_address);	//Add a Recipient
	}
	
	//$mail->addAddress($mail_to_address);	
	
	$addresses = explode(',', $mail_cc);
	foreach ($addresses as $address) 
	{
		$mail->AddCC($address);
	}
		
	$mail->Subject = $mail_subject;	//Mail Subject
	$mail_body_new="";
	$mail_body_new=str_replace("\r\n","",$mail_body);
	
	$mail->msgHTML($mail_body_new);	//Mail Body

	if (!$mail->send())	//If mail not sent
	{
		return "Email Not Sent"; //If email sent successfully
	} 
	else 
	{
		return "Email Sent";	//If email is successfully sent
	}
}
?>