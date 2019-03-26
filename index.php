<?php session_start();
if(isset($_SESSION['name']))
{
header("Location:html/dashboard.php"); 
exit();
}
?>

<html>
<head>
<title>
Smartstorey
</title>
</head>
<body>
<?php
header("location:html/login_html.php");
?>
</body>
</html>
