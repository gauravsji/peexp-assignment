<?php 
ob_start();
session_start();
if(isset($_SESSION['id']))
{
header("Location:php/dashboard.php"); 
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
ob_end_flush();
?>
</body>
</html>
