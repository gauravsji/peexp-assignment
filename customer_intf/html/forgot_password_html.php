<!--
Description: This page is used to recover the forgotten password.
Date: 04/07/2017
-->
<!DOCTYPE html>
<?php session_start();?>
<html>
	<head>
		<!--Including Bootstrap CSS links-->
		<?php include "../extra/header.html";?>
		<!--Including Bootstrap CSS links-->
		<link href="../css/login_registeration_style.css" rel='stylesheet' type='text/css' />
		<script type = "text/javascript">
			function hideMessage() 
			{
				document.getElementById("errMsg").style.display="none"; 
			}

			function startTimer() 
			{
				var tim = window.setTimeout("hideMessage()", 3000);  // 5000 milliseconds = 5 seconds
			}
		</script>
	</head>
	<body onload = "startTimer()">
		<!--Start main-->
		<div class="main">
			<div class="login-form">
				<h1>FORGOT PASSWORD?</h1>
				<form name="form1" method="post" action="../php/forgot_password_php.php" onsubmit="return validateForm();">
					<input type="text" name="login_email" id="login_email" required placeholder="Enter your Email ID">
					<div class="errormsg" align="center" id="errMsg">
						<font color="red"> <?php 
						if(!empty($_SESSION['errMsg'])) { echo $_SESSION['errMsg']; } ?></font>
					</div>
					<?php unset($_SESSION['errMsg']); ?>
					<div class="submit">
						<input type="submit" value="SUBMIT" >
					</div>	
					<p><a href="login_html.php">Already have an account? Login here</a></p></br>
				</form>
			</div>			
		</div>
		<!--End Main-->	 		
	</body>
	<!--Including Bootstrap and other scripts-->
	<?php include "../extra/footer.html";?>
	<!--Including Bootstrap and other scripts-->

	<script>
		function validateForm() 
		{
		var x = document.forms["form1"]["login_email"].value;
		var atpos = x.indexOf("@");
		var dotpos = x.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) 
		{
			alert("Not a valid e-mail address");
			document.getElementById("login_email").value = "";
			return false;
		}
		}
	</script>
</html>