<?php 
// include send sms class
include 'sendsms.php'; 
// create object of class
$sendsms = new sendsms("115b31j7si60b80w4l3u0u6i40ul09x925v", "FBSTRY");  //API key, Sender
// call send sms function
$sendsms->send_sms("9483803739", "Greetings from Fabstorey! We have received your order OD203339697788320200 amounting to Rs.41119 and it is being processed.");
echo "<script> alert('SMS Sent');</script>";
?>