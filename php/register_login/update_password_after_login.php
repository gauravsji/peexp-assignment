<?php
	//Include Database Connection
	include_once '../../dbconnect/dbconnect.php';
	
	//Store Posted Data To PHP Variable
	$old_password = mysqli_real_escape_string($conn,$_POST["old_password"]);
	$new_password =  mysqli_real_escape_string($conn,$_POST["new_password"]);
	$confirm_password =  mysqli_real_escape_string($conn,$_POST["confirm_password"]);
	$user_email =  mysqli_real_escape_string($conn,$_POST["user_email"]);

	//Encrypt and secure the password
	$password=md5($old_password); 

	//Query
	$query="SELECT * FROM users WHERE email='$user_email' and password='$password'";
	$res=mysqli_query($conn ,$query);
	$row = mysqli_fetch_array($res , MYSQLI_BOTH);
	$count = mysqli_num_rows($res); //if uname/pass is correct its return value should be 1 row

	if($count==1)
	{
		if($new_password == $confirm_password)
		{
			//Encrypt and secure the password
			$encrypted_password=md5($new_password); 
			//Update the user's password
			$sql = "UPDATE users SET password ='$encrypted_password' WHERE email = '$user_email'";
			if(mysqli_query($conn, $sql))	
			{	
				echo "Password Updated";
			} 
			else
				echo mysqli_error($conn);
		}
		else
			echo "Your password does not match.";
	}
	else
		echo "Incorrect Old Password";
	//Close Mysqli Connection
	mysqli_close($conn);
?>