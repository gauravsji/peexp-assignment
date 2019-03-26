<?php
	session_start();
	$_SESSION['errMsg'] = "";
	include '../dbconnect/dbconnect.php';
	include '../php/send_mail.php';
	include 'mail/phpmailer/PHPMailerAutoload.php';
	include 'add/add_activity_log.php';


	//Create a variable
	$mailbody="";
	$ss_order_id= mysqli_real_escape_string($conn,$_POST['order_id']);
	$po_email_to= mysqli_real_escape_string($conn,$_POST['po_email_to']);
	$email_subject= mysqli_real_escape_string($conn,$_POST['email_subject']);
	$ui_shipping_address= mysqli_real_escape_string($conn,$_POST['ui_shipping_address']);
	$ui_shipping_address = nl2br($ui_shipping_address);
	$ui_message_to_vendor= mysqli_real_escape_string($conn,$_POST['ui_message_to_vendor']);
	$email_cc= mysqli_real_escape_string($conn,$_POST['email_cc']);
	$send_site_incharge_details= mysqli_real_escape_string($conn,$_POST['send_site_incharge_details']);
	$site_incharge_name= mysqli_real_escape_string($conn,$_POST['site_incharge_name']);
	$site_incharge_number= mysqli_real_escape_string($conn,$_POST['site_incharge_number']);
	$transport_charge_details= mysqli_real_escape_string($conn,$_POST['send_transport_charge_details']);

	$user_id= mysqli_real_escape_string($conn,$_POST['user_id']);


	$user_sql = "SELECT phone_number FROM users where id=".$user_id;
	$result_user = mysqli_query($conn, $user_sql);
	$user_phno_result = mysqli_fetch_array($result_user,MYSQLI_ASSOC);


	$send_PO= mysqli_real_escape_string($conn,$_POST['send_PO']);

	if($send_PO=='Do Not Shipping Address')
	{
		$send_PO="";
	}
	//$ss_order_id=$_GET['id'];
	$sql = "SELECT * FROM ss_order o, vendor v where o.vendor_id=v.vendor_id and o.delete_status<>1 and o.order_id =" . $ss_order_id;
	$result = mysqli_query($conn, $sql);
	$order_result = mysqli_fetch_array($result,MYSQLI_ASSOC);

	$to_email_address=$po_email_to;
	$mail_first_column = "Dear ".$order_result['vendor_name'].",<br><br>
	".$ui_message_to_vendor;

	$query_result1 = "SELECT * FROM order_product where delete_status<>1 and order_id=".$ss_order_id;
	$order_product_result = mysqli_query($conn, $query_result1);

	$query_result2 = "SELECT * FROM order_transport where delete_status<>1 and order_id=".$ss_order_id;
	$order_transport_result = mysqli_query($conn, $query_result2);
	$order_trans_result = mysqli_fetch_array($order_transport_result,MYSQLI_ASSOC);

	if($transport_charge_details==1)
	{
	$transport_charge = $order_trans_result['order_transportation_charge'];
	}
	else
	{
	$transport_charge = 0;
	}

	$mailbody.="<br><br>
	<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'>
	<head>
			<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
			<title>Purchase Order From Smartstorey</title>
			<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
	</head>
	<body style='border: 1px solid #cccccc;'>
	<table style='border: 1px solid #cccccc;  box-shadow: 3px 3px 3px #888888;' cellpadding='0' cellspacing='0' width='100%'>
	<tbody>";


$mailbody.="<tr bgcolor='#ffb732' width='100%'><td bgcolor='#ffb732'><table><tr>
			<td bgcolor='#ffb732' width='25%' align='left' style='padding: 10px 10px 10px 10px;'>
				<h2><font face='verdana'>SMARTSTOREY</font><h2>
			</td>
			<td align='right' width='60%'><h3> PO: ".$order_result['order_id']."</h3></td>
			</tr></table></td>
			</tr>";
$mailbody.="<tr>
				<td style='padding: 15px 15px 15px 15px;'>".$mail_first_column ."</td>
			</tr>";

	if(($send_PO!='Do Not Send Shipping Address')||($send_site_incharge_details==1))
	{
		$mailbody.="<tr><td style='padding: 10px 10px 10px 10px;'>
					<table width='100%'>
						<tr style='border: 2px solid #cccccc;'>
							<th align='left'>BILL TO</th>
							<th></th>
							<th align='left'>SHIP TO</th>
						</tr>";
		$mailbody.="<tr style='border: 2px solid #cccccc;'>
						<td style='padding: 10px 10px 10px 10px; border: 1px solid #cccccc; border-radius: 6px;' width='50%' align='left'>Smartstorey<br>D2, 3rd Floor, Sampurna Chambers,<br>Vasavi Temple Street, <br>Basavangudi,Bengaluru <br>Karnataka - 560004<br><br>GSTIN: 29ADCFS7940N1ZC</td><td style='padding: 10px 10px 10px 10px;'></td>";
		$mailbody.="<td style='padding: 10px 10px 10px 10px; border: 1px solid #cccccc;  border-radius: 6px;' width='50%'><table>";

		if($send_site_incharge_details==1)
		{
		$mailbody.="<tr><td align='left'>".$site_incharge_name."</td></tr>
					<tr><td align='left'>".$site_incharge_number."</td></tr>";
		}
		if($send_PO!='Do Not Send Shipping Address')
		{
		$mailbody.="<tr><td align='left'>".$ui_shipping_address."</td></tr>";
		}
		$mailbody.="</table></td>
					</tr>
					</table>
					</td>
					</tr>";
	}

	else
	{
		$mailbody.="<tr><td style='padding: 10px 10px 10px 10px;'>
						<table width='100%'>
						<tr style='border: 1px solid #cccccc;'>
							<th colspan='2' align='center' style='border: 1px solid #cccccc;' >BILL TO</th>
						</tr>";
		$mailbody.="<tr  style='border: 1px solid #cccccc;'>
						<td colspan='2' style='padding: 20px 20px 20px 20px; border: 1px solid #cccccc;  border-radius: 6px;'>Smartstorey<br>D2, 3rd Floor, Sampurna Chambers,<br>Vasavi Temple Street, <br>Basavangudi,Bengaluru <br>Karnataka - 560004<br>GSTIN: 29ADCFS7940N1ZC<br>Phone: +91-".$user_phno_result['phone_number']."</td>
					</tr>
					</table>
					</td>
					</tr>";
	}

$mailbody.="<tr style='border: 1px solid #cccccc;'><td bgcolor='#ffffff' style='padding: 10px 10px 10px 10px;'><table align='center' style='border: 1px solid #cccccc;' cellpadding='5px' cellspacing='0' width='99%' style='padding: 10px 10px 10px 10px;'>
<tr style='border: 1px solid #cccccc; padding: 10px 10px 10px 10px;'><th align='center' style='border: 1px solid #cccccc;  padding: 6px 6px 6px 6px;'>Product Name</th><th align='center' style='border: 1px solid #cccccc;  padding: 6px 6px 6px 6px;'>Product Description</th><th align='center' style='border: 1px solid #cccccc;  padding: 6px 6px 6px 6px;'>Quantity</th><th align='center' style='border: 1px solid #cccccc;  padding: 6px 6px 6px 6px;'>Price</th><th align='center' style='border: 1px solid #cccccc;  padding: 6px 6px 6px 6px;'>Tax</th><th align='center' style='border: 1px solid #cccccc;  padding: 6px 6px 6px 6px;'>Tax I/E</th><th align='center' style='border: 1px solid #cccccc;  padding: 6px 6px 6px 6px;'>Total</th></tr>";
	$grand_total=0;
	$tot=0;
	while($row = mysqli_fetch_array($order_product_result,MYSQLI_ASSOC))
	{
	$mailbody.="<tr style='border: 1px solid #cccccc;'><td width='30%' align ='center' style='border: 1px solid #cccccc;'>".$row['order_product_name']."</td>";
	$mailbody.="<td max-width='20%' align ='center' style='border: 1px solid #cccccc;'>".$row['order_product_description']."</td>";
	$mailbody.="<td width='10%' align ='center' style='border: 1px solid #cccccc;'>".$row['order_product_quantity']."</td>";
	$mailbody.="<td width='10%' align ='center' style='border: 1px solid #cccccc;'>".$row['order_discounted_price']."</td>";
	$mailbody.="<td width='10%' align ='center' style='border: 1px solid #cccccc;'>".$row['order_tax']."</td>";
	$mailbody.="<td width='10%' align ='center' style='border: 1px solid #cccccc;'>";
	if($row['tax_inclusive']==1)
	{
	$mailbody.="Inclusive";
	}
	else
	{
	$mailbody.="Exclusive";
	}
	//$tot=$row['order_product_quantity']*$row['order_discounted_price'];
	$mailbody.="<td width='10%' align ='center' style='border: 1px solid #cccccc;'>".$row['order_total_of_buying']."</td>";
	$grand_total=$grand_total+$row['order_total_of_buying'];
	$mailbody.="</td></tr>";
	}
	$mailbody.="<tr style='border: 1px solid #cccccc;'><td width='10%' colspan='6' align='right'><strong>Total</strong></td>";
	$mailbody.="<td align='center' style='border: 1px solid #cccccc;'>".$grand_total."</td></tr>";

	if($transport_charge<>0)
	{
	$mailbody.="<tr style='border: 1px solid #cccccc;'><td width='10%' colspan='6' align='right'><strong>Shipping and Handling Charges</strong></td>";
	$mailbody.="<td align='center' style='border: 1px solid #cccccc;'>".$transport_charge."</td></tr>";
	$transport=$grand_total+$transport_charge;
	$mailbody.="<tr style='border: 1px solid #cccccc;'><td width='10%' colspan='6' align='right'><strong>Grand Total</strong></td>";
	$mailbody.="<td align='center' style='border: 1px solid #cccccc;'>".$transport."</td></tr>";
	}

	$mailbody.="</table></td></tr>";

	$mailbody.="<tr><td colspan='7' bgcolor='#ffb732' style='padding: 10px 10px 10px 10px;'><center>For any queries contact us at +91-".$user_phno_result['phone_number']." or mail us at vendors@smartstorey.com</center></td></tr></tbody></table></body></html><br>";

	$new_sql = "select * from email_settings where email_module='PURCHASE ORDER'" ;
	$result_new = mysqli_query($conn, $new_sql);
	$result_email_settings = mysqli_fetch_array($result_new,MYSQLI_ASSOC);

	$mail_from_address = $result_email_settings['email_address']; //From which email address to send purchase order email
	$mail_password = $result_email_settings['email_password'];	//Password of from email address
	$mail_to_address = $to_email_address;	//To which email address to sent the purchase order email
	$mail_subject = $email_subject;	//Subject of the purchase order email
	$mail_body = $mailbody;	//Purchase order email body
	$mail_host = $result_email_settings['email_host'];	//Ex:smtp.zoho.com
	$mail_port = $result_email_settings['email_port'];	//Ex:465
	$mail_title = "Smartstorey";	//Title for the email

	if(send_email(trim($mail_from_address),trim($mail_password),$mail_to_address,$mail_subject,$mail_body,$mail_host,trim($mail_port),$mail_title,$email_cc)=="Email Sent")
	{
		$add_po_to_order_query ="Update ss_order SET order_po_mail_body = '$ui_message_to_vendor' where order_id='".$ss_order_id."'";
		if(mysqli_query($conn, $add_po_to_order_query))
		{
		}
		else
		{
			echo mysqli_error($conn);
		}

		fn_add_activity_log("Order",$ss_order_id,"Purchase Order Sent",$user_id,$conn);
		echo "Email Sent";
	}
	else
	{
		echo "error";
	}

	mysqli_close($conn);
?>
