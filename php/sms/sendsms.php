<?php 

// SpringEdge Send SMS class File 
/*
 * USE:
 *  
    include 'sendsms.php';
    $sendsms=new sendsms("1i6xxxxxxxxxxxxxx", "BUxxxx");
    $sendsms->send_sms("99xxxxxxxx", "test sms");
 */

class sendsms
{
 	private $api_url;
 	private $apikey;
 	private $senderid;

	function __construct($apikey,$senderid)
	{
		$this->api_url = 'http://instantalerts.co/api/';
		$this->apikey = $apikey;
		$this->senderid = $senderid;
	}
	
	function send_sms($to, $message, $type="xml")
	{
		$message = urlencode($message);
		$params = "web/send/?apikey=$this->apikey&sender=$this->senderid&to=$to&message=$message";
		$this->execute($params);
	}
	
	function execute($params)
	{
		$eurl = $this->api_url.$params;	
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_POST, 0);
                curl_setopt($ch, CURLOPT_URL, $eurl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $output = curl_exec($ch);
                curl_close($ch);
		$output = file_get_contents($eurl);
        return $output;		
	}    
}
?>
