<?php
include '../dbconnect/dbconnect.php';

//Create a variable
$product_set_id= $_POST['product_set_id'];

$sql = "SELECT * FROM brand b where b.product_set_id=".$product_set_id." and b.delete_status<>1 order by b.brand_name";
$query = mysqli_query($conn, $sql);

$data="<table class='table table-bordered table-striped fixed table-condensed'><thead><tr><th>Brand Name</th><th>Brand Description</th></tr></thead>";
while($row = mysqli_fetch_array($query))
{
$data=$data."<tr><td>".$row['brand_name']."</td><td>".$row['brand_description']."</td></tr>"; 
}
$data=$data."</table>";
echo $data;
?>