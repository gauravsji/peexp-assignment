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
			<h1>PASSWORD RESET KEY SUCCESSFULLY SENT TO YOUR MAIL</h1>
				<font color="green"><center><p></br>You will be redirected to login page in <span id="counter">5</span> second(s)</p></center></font>
				<script type="text/javascript">
				function countdown() 
				{
					var i = document.getElementById('counter');
					if (parseInt(i.innerHTML)==1) 
					{
						location.href = '../index.php';
					}
					i.innerHTML = parseInt(i.innerHTML)-1;
				}
				setInterval(function(){ countdown(); },1000);
				</script>

				<form name="form1" >
					<div class="submit">
						<a  href="login_html.php">
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