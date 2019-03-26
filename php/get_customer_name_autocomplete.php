<?php
include '../dbconnect/dbconnect.php';

// PDO connect *********
function connect($host,$username,$password,$dbname) 
{
	return new PDO('mysql:host='.$host.';dbname='.$dbname.'', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));	
}

$pdo = connect($host,$username,$password,$dbname);
$keyword = '%'.$_POST['keyword'].'%'; 
$sql = "SELECT * FROM customer WHERE customer_name LIKE (:keyword)";
$query = $pdo->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$list = $query->fetchAll();
foreach ($list as $rs) {
	// put in bold the written text
	//$country_name = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['customer_name']);
	// add new option
    echo '<li onclick="set_item_cust(\''.str_replace("'", "\'", $rs['customer_name']).'\',\''.str_replace("'", "\'", $rs['customer_contact_number']).'\',\''.str_replace("'", "\'", $rs['customer_email']).'\')">'.$rs['customer_name'].'</li>';

   }
?>