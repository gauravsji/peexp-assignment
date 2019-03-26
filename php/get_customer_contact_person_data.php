<?php
//Include database configuration file
include "../extra/session.php";

$customer_id=$_POST['customer_id'];

if(isset($_POST["customer_id"]) && !empty($_POST["customer_id"]))
{

	$sql = "SELECT * FROM customer WHERE delete_status<>1 and customer_id = ".$customer_id." ";
	$result = mysqli_query($conn, $sql);
	$customer_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
    echo $customer_result['customer_contact_person'];
}
?>