<?php  
 //Include Database Connection
 include '../../dbconnect/dbconnect.php'; 
 if(isset($_POST["daily_log"]))
 {
  $daily_log =  mysqli_real_escape_string($conn,$_POST["daily_log"]);
  $location = mysqli_real_escape_string($conn,$_POST["location"]);
  $user_id = mysqli_real_escape_string($conn,$_POST["user_id"]); 
  if($_POST["post_id"]>0)  
  {  
    //Update Query  
    $sql = "UPDATE daily_log SET daily_log = '".$daily_log."' WHERE daily_log_id = '".$_POST["post_id"]."'";  
    mysqli_query($conn, $sql); 
	
	if(mysqli_error($conn))
	{
		echo mysqli_error($conn);
	}
	echo $_POST["post_id"];  		
  }  
  else  
  {  
    //Insert Query  
    $sql = "INSERT INTO daily_log(daily_log, data_entered_by, location, post_status) VALUES ('".$daily_log."', '".$user_id."', '".$location."', 'draft')";  
    mysqli_query($conn, $sql);  
	if(mysqli_error($conn))
	{
		echo mysqli_error($conn);
	}	
    echo mysqli_insert_id($conn);  
  }
 }  
 ?>
 