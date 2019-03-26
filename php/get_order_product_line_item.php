<?php
include '../dbconnect/dbconnect.php';

// PDO connect *********
function connect($host,$username,$password,$dbname) 
{
	return new PDO('mysql:host='.$host.';dbname='.$dbname.'', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));	
}

$pdo = connect($host,$username,$password,$dbname);
$keyword = '%'.$_POST['keyword'].'%'; 
$sql = "SELECT * FROM product WHERE auto_complete_product_name LIKE (:keyword)";
$query = $pdo->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$list = $query->fetchAll();
foreach ($list as $rs) {
	// put in bold the written text
	$country_name = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['auto_complete_product_name']);
	// add new option
    echo '<li onclick="set_item(\''.str_replace("'", "\'", $rs['auto_complete_product_name']).'\','.$rs['product_id'].')">'.$country_name.'</li>';
}
?>