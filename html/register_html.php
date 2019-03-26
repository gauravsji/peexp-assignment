<!--
Description: This page is used to register the user.
Date: 04/07/2017
-->
<?php session_start();
if(isset($_SESSION['name']))
{
header("Location:dashboard.php"); 
exit();
}

?>
<!DOCTYPE html>
<html>
<head>
	<!--Including Bootstrap CSS links-->
	<?php include "../extra/header.html";?>
	<!--Including Bootstrap CSS links-->

	<!--Custom CSS Stylesheets-->
	<link href="../css/login_registeration_style.css" rel='stylesheet' type='text/css' />
	<!--Custom CSS Stylesheets-->

<script>
function validateForm() {
    var x = document.forms["form1"]["register_email"].value;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) 
	{
        alert("Not a valid e-mail address");
		document.getElementById("register_email").value = "";
        return false;
    }
}
</script>
</head>
<body>
	 <!--Start main-->
	 <div class="main">
		<div class="login-form">
			<h1>SMARTSTOREY OPERATIONS MANAGEMENT REGISTERATION</h1>
				<form name="form1" method="post" action="../php/register_login/register_php.php" onsubmit="return validateForm();">
					<input type="text" name="register_name" id="register_name" class="text" placeholder="Name" required maxlength="40">
					<input type="text" name="register_email" id="register_email" class="text" placeholder="Email Address" required maxlength="30">
					<input type="password" name="register_password1" id="register_password1" placeholder="Enter Password" pattern=".{7,15}" required title="7 to 15 characters" required maxlength="15">
					<input type="password" name="register_password2" id="register_password2" placeholder="Reenter Password" pattern=".{7,15}" required title="7 to 15 characters" required maxlength="15">
					
					<div class="form-group">
					<select name="location" class="form-control" required>
					  <option value="Bangalore">Bangalore</option>
					  <option value="Delhi">Delhi</option>
					</select>
					</div>
					
		            <div class="form-group">
					<select name="role" class="form-control" required>
					  <option value="Admin">Admin</option>
					  <option value="Accounts">Accounts</option>
					  <option value="Operations">Operations</option>
					</select>
					</div>

				    <div class="errormsg" align="center" id="errMsg">
						<font color="red"> <?php if(!empty($_SESSION['errMsg'])) { echo $_SESSION['errMsg']; } ?></font>
					</div>
					<?php unset($_SESSION['errMsg']); ?>

					<div class="submit">
						<input type="submit" value="REGISTER" >
					</div>	
					<p><a href="login_html.php">Already have an account! Login</a></p></br>
					<p><a href="forgot_password_html.php">Forgot Password ?</a></p>
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