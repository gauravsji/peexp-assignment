<?php
include '../../dbconnect/dbconnect.php';

session_start();
if(!isset($_SESSION['id']))
{
header("Location:../html/login_html.php");
exit();
}
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 172800)) {
    //Last request was more than 48 hrs ago
    session_unset();     // unset $_SESSION variable for the run-time
    session_destroy();   // destroy session data in storage
	session_start();
	$_SESSION['errMsg']='No activity from last 2 days, please login again';
	header("Location:../html/login_html.php");
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
$_SESSION['status']= false;
$userid = $_SESSION['id'];
$sql = "SELECT * FROM customer  where customer_id='" . $userid."'";
$result = mysqli_query($conn , $sql);
$user_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
echo mysqli_error($conn);

$query= "SELECT * FROM settings where user_id='".$user_result['customer_id']."'";
$settings_result_set = mysqli_query($conn, $query);
$settings_result = mysqli_fetch_array($settings_result_set,MYSQLI_ASSOC);

?>
