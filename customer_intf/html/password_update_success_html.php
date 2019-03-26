<!--
Description: This page is used to display password updated message.
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
				<h1>PASSWORD UPDATED SUCCESSFULL</h1>
					<font color="green"><center><p></br>Successfully updated your password </br> You will be redirected to login page in <span id="counter">3</span> second(s)</p></center></font>
					<script type="text/javascript">
					function countdown() 
					{
					var i = document.getElementById('counter');
					if (parseInt(i.innerHTML)==0) 
					{
					location.href = '../index.php';
					}
					i.innerHTML = parseInt(i.innerHTML)-1;
					}
					setInterval(function(){ countdown(); },1000);
					</script>

					<form name="form1" >
						<div class="submit">
						<a href="login_html.php">
						<div align="center" class="button_style">Click Here To Login</div>
						</a>
						</div>	
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