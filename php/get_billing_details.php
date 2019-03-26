<?php
//Include database configuration file
include "../extra/session.php";

$customer_id=$_POST['customer_id'];

if(isset($_POST["customer_id"]))
{
    //Get all state data
    $query = $conn->query("SELECT * FROM customer WHERE delete_status<>1 and customer_id = ".$customer_id." ");
    $result2 = mysqli_query($conn, $query);
	$customer_result = mysqli_fetch_array($result2,MYSQLI_ASSOC);
	
	echo ( $customer_result['billing_address']);
    
}
?>