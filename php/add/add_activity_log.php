<?php	
	include '../dbconnect/dbconnect.php';
	function fn_add_activity_log($module_name,$module_id,$activity_message,$activity_by,$conn)
	//function fn_add_activity_log($conn)
	{
		//Insert Query
		$query = "INSERT INTO activity_log(module_name, module_id, activity_message, activity_by, activity_date_time) VALUES ('$module_name',$module_id,'$activity_message',$activity_by,NOW())";
		//Execute The Query
		if (mysqli_query($conn, $query)) 
		{
			//echo "Activity Logged";
		}
	}
?>