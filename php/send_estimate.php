<?php
	session_start();
	$_SESSION['errMsg'] = "";
	include '../dbconnect/dbconnect.php';
	include '../php/send_mail.php';
	include 'mail/phpmailer/PHPMailerAutoload.php';
	include 'add/add_activity_log.php';
	
	$enquiry_id= mysqli_real_escape_string($conn,$_POST['enquiry_id']);
	$email_subject= mysqli_real_escape_string($conn,$_POST['email_subject']);
	$email_cc= mysqli_real_escape_string($conn,$_POST['email_cc']);
	$ui_email_to= mysqli_real_escape_string($conn,$_POST['ui_email_to']);
	$user_id= mysqli_real_escape_string($conn,$_POST['user_id']);
	$billing_address= mysqli_real_escape_string($conn,$_POST['billing_address']);
	$billing_address = str_replace("\n", "<br>", $billing_address);
	$shipping_address= mysqli_real_escape_string($conn,$_POST['shipping_address']);
	$shipping_address = str_replace("\n", "<br>", $shipping_address);
	$email_body= mysqli_real_escape_string($conn,$_POST['email_body']);	
	$email_body = str_replace("\n", "<br>", $email_body);
	$sql = "SELECT * FROM enquiry e
			LEFT OUTER JOIN sales_lead sl ON e.sales_lead_id=sl.sales_lead_id
			LEFT OUTER JOIN customer c ON e.customer_id=c.customer_id
			LEFT OUTER JOIN project p ON e.project_id = p.project_id
			LEFT OUTER JOIN users u ON u.id = e.enquiry_assignee
			WHERE e.delete_status <> 1 and e.enquiry_id =" . $enquiry_id ;
	$result = mysqli_query($conn, $sql);
	$enquiry_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$grand_total=0;
	$name="";
	$to_email_address="";
	$mobile_number=$enquiry_result['phone_number'];
	if(($enquiry_result['customer_name']=="")||($enquiry_result['customer_name']=="0"))
	{
		$name=$enquiry_result['sales_lead_name'];
		$to_email_address=$ui_email_to; 
		//$billing_address=$enquiry_result['sales_lead_address'];
	}
	else
	{	
		$name=$enquiry_result['customer_name'];
		$to_email_address=$ui_email_to;
		//$billing_address=$enquiry_result['sales_lead_address'];
	}
	
	
	$mail_first_column = "Dear ".$name.",<br><br>";	
	$mail_first_column.= $email_body;
		
	$mailbody.="<br><br>
	<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'>
	<head>
			<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
			<title>Estimate From Smartstorey</title>
			<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
	</head>
	<body style='border: 1px solid #cccccc;'>
	<table style='border: 1px solid #cccccc;  box-shadow: 3px 3px 3px #888888;' cellpadding='0' cellspacing='0' width='100%'> 
	<tbody>";
	
	$mailbody.="<tr bgcolor='#ffb732' width='100%'><td bgcolor='#ffb732'><table><tr>
			<td bgcolor='#ffb732' width='25%' align='left' style='padding: 10px 10px 10px 10px;'>
				<h2><font face='verdana'>SMARTSTOREY</font><h2>
			</td>
			<td align='right' width='60%'><h3> ESTIMATE: ".$enquiry_result['enquiry_id']."</h3></td>
			</tr></table></td>
			</tr>";
	
	$mailbody.="<tr>
				<td style='padding: 15px 15px 15px 15px;'>".$mail_first_column ."</td>
			</tr>";
	
	
	
		$mailbody.="<tr><td style='padding: 10px 10px 10px 10px;'>
					<table width='100%'>
						<tr style='border: 2px solid #cccccc;'>
							<th align='left'>BILLING ADDRESS</th>
							<th></th>
							<th align='left'>SHIPPING ADDRESS</th>
						</tr>";
		$mailbody.="<tr style='border: 2px solid #cccccc;'>
						<td style='padding: 10px 10px 10px 10px; border: 1px solid #cccccc; border-radius: 6px;' width='50%' align='left'>".$billing_address."</td>
						
						<td style='padding: 10px 10px 10px 10px;'></td>";					
						
						
		$mailbody.="<td style='padding: 10px 10px 10px 10px; border: 1px solid #cccccc;  border-radius: 6px;' width='50%' align='left'>".$shipping_address."</td>
					</tr>
					</table>
					</td>
					</tr>";	
					
					
		
	
	
	$query_result1 = 'SELECT * FROM enquiry e,enquiry_product ep where e.enquiry_id='.$enquiry_id.' and e.enquiry_id=ep.enquiry_id and ep.delete_status<>1';
	$enquiry_product_result = mysqli_query($conn, $query_result1);
	
	
	
		
$mailbody.="<tr style='border: 1px solid #cccccc;'><td bgcolor='#ffffff' style='padding: 10px 10px 10px 10px;'><table align='center' style='border: 1px solid #cccccc;' cellpadding='5px' cellspacing='0' width='99%' style='padding: 10px 10px 10px 10px;'>
<tr style='border: 1px solid #cccccc; padding: 10px 10px 10px 10px;'><th align='center' style='border: 1px solid #cccccc;  padding: 6px 6px 6px 6px;'>Product Name</th><th align='center' style='border: 1px solid #cccccc;  padding: 6px 6px 6px 6px;'>Product Description</th><th align='center' style='border: 1px solid #cccccc;  padding: 6px 6px 6px 6px;'>Quantity</th><th align='center' style='border: 1px solid #cccccc;  padding: 6px 6px 6px 6px;'>Price</th><th align='center' style='border: 1px solid #cccccc;  padding: 6px 6px 6px 6px;'>Tax</th><th align='center' style='border: 1px solid #cccccc;  padding: 6px 6px 6px 6px;'>Tax I/E</th><th align='center' style='border: 1px solid #cccccc;  padding: 6px 6px 6px 6px;'>Total</th></tr>";

	while($row = mysqli_fetch_array($enquiry_product_result,MYSQLI_ASSOC))
	{
		$mailbody.="<tr style='border: 1px solid #cccccc;'><td width='25%' align ='center' style='border: 1px solid #cccccc;'>".$row['enquiry_product_name']."</td>";
		$mailbody.="<td width='20%' align ='center' style='border: 1px solid #cccccc;'>".$row['enquiry_product_description']."</td>";
		$mailbody.="<td width='20%' align ='center' style='border: 1px solid #cccccc;'>".$row['enquiry_product_quantity']."</td>";
		$mailbody.="<td width='10%' align ='center' style='border: 1px solid #cccccc;'>".$row['enquiry_selling_price']."</td>";
		$mailbody.="<td width='5%' align ='center' style='border: 1px solid #cccccc;'>".$row['enquiry_tax']."</td>";
		$mailbody.="<td width='10%' align ='center' style='border: 1px solid #cccccc;'>"; 
		if($row['tax_inclusive']==1) 
		{
			$mailbody.="Inclusive";
		}
		else
		{
			$mailbody.="Exclusive";
		}
			$mailbody.="<td width='10%' align ='center' style='border: 1px solid #cccccc;'>".$row['enquiry_total']."</td>";
			$grand_total=$grand_total+$row['enquiry_total'];
			$mailbody.="</td></tr>";
	}	
	$final_total=0;
	if(($enquiry_result['enquiry_transport_charge']!="")||($enquiry_result['enquiry_transport_charge']>0))
	{
		$mailbody.="<tr style='border: 1px solid #cccccc;'><td width='10%' align ='right' colspan='6' style='border: 1px solid #cccccc;'><strong>Shipping and Handling Charges</strong></td>";
		$mailbody.="<td align='center' style='border: 1px solid #cccccc;'>".$enquiry_result['enquiry_transport_charge']."</td></tr>";
		$mailbody.="<tr style='border: 1px solid #cccccc;'><td width='10%' align ='right' colspan='6' style='border: 1px solid #cccccc;'><strong>Total</strong></td>";
		$final_total=$enquiry_result['enquiry_transport_charge']+$grand_total;
		$mailbody.="<td align='center' style='border: 1px solid #cccccc;'>".$final_total."</td></tr>";
	}
	else
	{
	$mailbody.="<tr style='border: 1px solid #cccccc;'><td width='10%' align ='right' colspan='6' style='border: 1px solid #cccccc;'><strong>Total</strong></td>";
	$mailbody.="<td align='center' style='border: 1px solid #cccccc;'>".$grand_total."</td></tr>";
	}
	$mailbody.="</table></td></tr>";

	
	
	
		$mailbody.="<tr><td style='padding: 10px 10px 10px 10px;'>
					<table width='100%'>";
		$mailbody.="<tr style='border: 2px solid #cccccc;'>
						<td style='padding: 10px 10px 10px 10px; border: 1px solid #cccccc; border-radius: 6px;' width='50%' align='left'>
						Smartstorey<br>
						D2, 3rd Floor, Sampurna Chambers,<br>
						Vasavi Temple Street, <br>
						Basavangudi,Bengaluru <br>
						Karnataka - 560004<br><br>
						GSTIN: 29ADCFS7940N1ZC</td>
						
						<td style='padding: 10px 10px 10px 10px;'></td>";					
						
						
		$mailbody.="<td style='padding: 10px 10px 10px 10px; border: 1px solid #cccccc;  border-radius: 6px;' width='50%' align='left'>A/C Name: SmartStorey LLP<br>Bank Name: Axis Bank<br>A/C Number: 916020053390262<br>IFSC Code: UTIB0001496<br></td>
					</tr>
					</table>
					</td>
					</tr>";	
					
					
	$mailbody.="<tr><td colspan='7' bgcolor='#ffb732' style='padding: 10px 10px 10px 10px;'><center>For any queries contact us at +91-".$mobile_number." or mail us at sales@smartstorey.com</center></td></tr></tbody></table></body></html><br>";

	
	$new_sql = "select * from email_settings where email_module='ESTIMATE'" ;
	$result_new = mysqli_query($conn, $new_sql);
	$result_email_settings = mysqli_fetch_array($result_new,MYSQLI_ASSOC);

	$mail_from_address = $result_email_settings['email_address']; //From which email address to send estimate email              
	$mail_password = $result_email_settings['email_password'];	//Password of from email address
	$mail_to_address = $to_email_address;	//To which email address to sent the estimate email
	$mail_subject = $email_subject;	//Subject of the estimate email
	$mail_body = $mailbody;	//Estimate email body
	$mail_host = $result_email_settings['email_host'];	//Ex:	smtp.zoho.com
	$mail_port = $result_email_settings['email_port'];	//Ex: 465
	$mail_title = "Smartstorey";	//Title for the email

	if(send_email(trim($mail_from_address),trim($mail_password),$mail_to_address,$mail_subject,$mail_body,$mail_host,trim($mail_port),$mail_title,$email_cc)=="Email Sent")
	{
		$add_estimate_to_enquiry_query ="Update enquiry SET enquiry_estimate_message = '$email_body' where enquiry_id='".$enquiry_id."'";
		if(mysqli_query($conn, $add_estimate_to_enquiry_query))
		{
		}
		else
		{
			echo mysqli_error($conn);
		}
		fn_add_activity_log("Enquiry",$enquiry_id,"Estimate Sent",$user_id,$conn);
		echo "Email Sent"; 
	}
	else
	{
		echo "Error";
	}
	mysqli_close($conn);
?>