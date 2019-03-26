<?php
	//Include Database Connection
	include_once '../../dbconnect/dbconnect.php';

	//Gather the post data
	$email = mysqli_real_escape_string($conn,$_POST["remail"]);
	$password = mysqli_real_escape_string($conn,$_POST["newpassword"]);
	$confirmpassword = mysqli_real_escape_string($conn,$_POST["confirmpassword"]);
	$hashr = mysqli_real_escape_string($conn,$_POST["q"]);

	//Use the same salt from the forgot_password.php file
	$salt = "498#2D83B631%3800EBD!801600D*7E3CC13";

	//Generate the reset key
	$resetkey = hash('sha512', $salt.$email);

	$query="SELECT * FROM customer WHERE email='$email'";
	$res=mysqli_query($conn ,$query);
	$row = mysqli_fetch_array($res , MYSQLI_BOTH);
	$count = mysqli_num_rows($res);

	//Does the new reset key match the old one?
	if ($resetkey== $hashr)
	{
		if($count==1)
		{
			if ($password == $confirmpassword)
			{
				//Encrypt and secure the password
				$encrypted_password=md5($password);

				// Update the user's password
				$sql = "UPDATE customer SET password ='$encrypted_password' WHERE email = '$email'";

				if(mysqli_query($conn, $sql))
				{
					header("location: ../../html/password_update_success_html.php");
				}
				else
				{
					echo "ERROR:" . mysqli_error($conn);
				}
			}
			else
			echo "Password does not match the confirm password";
		}
		else
		echo "Incorrect Email Address";
	}
	else
	echo "Your password reset key is Invalid".mysqli_error($conn);
	//Close Mysqli Connection
	mysqli_close($conn);
?>
