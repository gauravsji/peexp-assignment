<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';

	//Table Names 
	$tbl_name = "daily_log"; // Table name 

	//Store Posted Data To PHP Variable
	$daily_log_id= mysqli_real_escape_string($conn,$_POST['daily_log_id']);
	$daily_log= mysqli_real_escape_string($conn,$_POST['daily_log']);
	$user_id= mysqli_real_escape_string($conn,$_POST['user_id']);

	//Update Query
	$sql = "UPDATE $tbl_name
	SET 
	daily_log='$daily_log',
	daily_log_date_modified=CURRENT_TIMESTAMP
	WHERE daily_log_id = '$daily_log_id'";

	//Execute The Query
	if (mysqli_query($conn, $sql)) 
	{
		//On Successful
		
		
		$sql = "SELECT * FROM daily_log where daily_log_id = " . $daily_log_id;
		$result = mysqli_query($conn, $sql);
		$daily_log_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$old_value=$daily_log_result['daily_log'];
		$transaction_sql="INSERT INTO transaction_audit(module_name, column_name, module_transaction_id, old_value, new_value, changed_by) VALUES ('DAILY_LOG','DAILY_LOG','$daily_log_id','$old_value','$daily_log','$user_id')";
		mysqli_query($conn, $transaction_sql);		
		
		header("Location:../../reports/daily_log_report_html.php");
	}
	else
	{
		//On Error 
		$_SESSION['error']=mysqli_error($conn);
		header("Location:../../extra/error.php");
	}
	//Close Mysqli Connection
	mysqli_close($conn);
?>