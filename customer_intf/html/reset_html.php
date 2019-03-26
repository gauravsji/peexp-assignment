<!--
Description: This page is used to reset user password .
Date: 04/07/2017
-->
<!DOCTYPE html>
<html>
<head>
	<!--Including Bootstrap CSS links-->
	<?php include "../extra/header.html";?>
	<!--Including Bootstrap CSS links-->

	<!--Custom CSS Stylesheets-->
	<link href="../css/login_registeration_style.css" rel='stylesheet' type='text/css' />
	<!--Custom CSS Stylesheets-->
</head>
<body>
	 <!--Start main-->
	 <div class="main">
		<div class="login-form">
			<h1>RESET PASSWORD</h1>
				<form name="ResetPasswordForm" method="post" action="../php/updatepassword.php">
					<input type="hidden" name="q" id="q" value="<?php echo $_GET['q'];?>">
					<input type="text" name="remail" id="remail" readonly value="<?php echo $_GET['email'];?>" required placeholder="Enter your Email ID">
					<input type="password" name="newpassword" id="newpassword" required placeholder="Enter password">
					<input type="password" name="confirmpassword" id="confirmpassword" required placeholder="Re-enter password">
					<div class="submit">
						<input type="submit" value="SUBMIT" >
					</div>	
					<p><a href="login_html.php">Already have an account? Login here</a></p></br>
				</form>
		</div>
	<!--End Login Form-->
	</div>
	<!--End Main-->	 		
</body>
	<!--Including Bootstrap and other scripts-->
	<?php include "../extra/footer.html";?>
	<!--Including Bootstrap and other scripts-->
</html>