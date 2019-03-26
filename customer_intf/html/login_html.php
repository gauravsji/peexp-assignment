<?php
    ob_start();
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
			<!--Including Bootstrap CSS links-->
			<?php include "../../extra/header.html";?>
			<!--Including Bootstrap CSS links-->

		<!--Custom CSS Stylesheets-->
		<link href="../../css/login_registeration_style.css" rel='stylesheet' type='text/css' />
		<!--Custom CSS Stylesheets-->
	</head>
	<body>
		 <!--Start main-->
		 <div class="main">
			<div class="login-form animated jello">
				<h1>SMARTSTOREY INTERNAL MANAGEMENT</h1>

					<form name="form1" method="post" action="../php/login_php.php" role="form">
            		<input type="text" name="firm_name" id="firm_name"  class="text" required placeholder="Firm Name" maxlength="50">
						<input type="text" name="login_email" id="login_email"  class="text" required placeholder="Email" maxlength="30">
						<input type="password" name="login_password" id="login_password" value="Password" pattern=".{5,15}" required title="5 to 15 characters" required placeholder="Password" maxlength="15">
						<div class="errormsg" align="center" id="errMsg">
							<font color="red"><?php if(!empty($_SESSION['errMsg'])) { echo $_SESSION['errMsg'];  echo "</br>";} ?></font>
						</div>

						<?php unset($_SESSION['errMsg']); ?>
						<div class="submit">
							<input type="submit" class="loginbtn" name="login" value="LOGIN">
						</div>
						<p><a href="forgot_password_html.php">Forgot Password?</a></p>
					</form>
			</div>
		<!--End Login Form-->
		</div>
		<!--End Main-->
	</body>
		<!--Including Bootstrap and other scripts-->
		<?php include "../../extra/footer.html";
		ob_end_flush();
		?>
		<!--Including Bootstrap and other scripts-->
</html>