<?php
	//Start New Or Resume Existing Session
	include_once '../../dbconnect/dbconnect.php';
	
	//Gather The Post Data And Store It To PHP Variable
	$email = mysqli_real_escape_string($conn,$_POST["remail"]);
	$password = mysqli_real_escape_string($conn,$_POST["newpassword"]);
	$confirmpassword = mysqli_real_escape_string($conn,$_POST["confirmpassword"]);

	//Use the same salt from the forgot_password.php file
	$salt = "498#2D83B631%3800EBD!801600D*7E3CC13";

	//Generate the reset key
	$resetkey = hash('sha512', $salt.$email);

	//Query data
	$query="SELECT * FROM users WHERE email='$email'";

	//Execute the Query
	$res=mysqli_query($conn ,$query);
	$row = mysqli_fetch_array($res , MYSQLI_BOTH);
	$count = mysqli_num_rows($res); //if data exists is correct its return value should be 1 row
	if($count==1)
	{
		if ($password == $confirmpassword)
		{
			//Encrypt and secure the password
			$encrypted_password=md5($password);  

			// Update the user's password
			$sql = "UPDATE users SET password ='$encrypted_password' WHERE email = '$email'";
			mysqli_query($conn, $sql);
		}
		else
			echo "Your password does not match.";
	}
	else
		echo "Incorrect Email Address";

	//Close Mysqli Connection
	mysqli_close($conn);
?>