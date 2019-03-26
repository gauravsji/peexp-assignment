<?php
session_start();
include '../../dbconnect/dbconnect.php';
include '../../php/add/add_activity_log.php';
//Table name 
$tbl_product = "product"; 
$tbl_product_attribute="product_attribute";

//Create a variable
$product_set_id= mysqli_real_escape_string($conn,$_POST['ui_product_set_id']);
$brand_id= mysqli_real_escape_string($conn,$_POST['ui_brand_id']);
$product_name= ucfirst(mysqli_real_escape_string($conn,$_POST['ui_product_name']));
$product_description= mysqli_real_escape_string($conn,$_POST['ui_product_description']);

$user_id= mysqli_real_escape_string($conn,$_POST['user_id']);
$location= mysqli_real_escape_string($conn,$_POST['location']);
$global_attribute_values="";

$sql = "INSERT INTO $tbl_product(product_set_id,brand_id,product_name,product_description,data_entered_by,location,delete_status) VALUES ('$product_set_id','$brand_id','$product_name','$product_description','$user_id','$location',0)";
mysqli_query($conn, $sql);
$last_id = mysqli_insert_id($conn); 

$attribute_name=$_POST['attribute_name_input'];
$attribute_id=$_POST['attribute_id'];
$attribute_values=$_POST['attribute_values'];
foreach($attribute_name as $a => $b)
{
	$v_att_name=$attribute_name[$a];
	$v_att_val=$attribute_values[$a];

	$att_n_sql = "SELECT * FROM key_value k,product_set_attribute ps where k.key_value_id=ps.product_set_attribute_id_fk_key_value and ps.product_set_attribute_id=" . $v_att_val;
	$result_att_name = mysqli_query($conn, $att_n_sql);
	$attribute_name_result = mysqli_fetch_array($result_att_name,MYSQLI_ASSOC);	

	if($global_attribute_values=="")
			{				
				$global_attribute_values=$global_attribute_values.$attribute_name_result['value'];
				$global_attribute_values=$global_attribute_values. '-' .$attribute_name_result['product_set_attribute_value'];
			}
			else
			{
				$global_attribute_values=$global_attribute_values. '-' .$attribute_name_result['value'];
				$global_attribute_values=$global_attribute_values. '-' .$attribute_name_result['product_set_attribute_value'];
			}

	$sql2 = "INSERT INTO $tbl_product_attribute(product_id,product_set_attribute_id,delete_status) VALUES ('$last_id','$v_att_val',0)";	
	if(mysqli_query($conn, $sql2))
	$error=1;//Query Successful
}

	$product_set_query= "SELECT product_set_product_name FROM product_set where product_set_id='".$product_set_id."'";
	$product_set_result_set = mysqli_query($conn, $product_set_query);
	$product_set_result = mysqli_fetch_array($product_set_result_set,MYSQLI_ASSOC);
	
	$brand_query= "SELECT brand_name FROM brand where brand_id='".$brand_id."'";
	$brand_result_set = mysqli_query($conn, $brand_query);
	$brand_result = mysqli_fetch_array($brand_result_set,MYSQLI_ASSOC);
	
	$brand_name=$brand_result['brand_name'];
	$product_set_name=$product_set_result['product_set_product_name'];
	$auto_complete_product_name=$product_set_name."-".$brand_name."-".$product_name."-".$global_attribute_values;
	
	$update_query="UPDATE $tbl_product
		SET 
		auto_complete_product_name = '$auto_complete_product_name'
		where product_id='$last_id'";
	mysqli_query($conn, $update_query);
$er=mysqli_error($conn);
fn_add_activity_log("Product",$last_id,"Product Created",$user_id,$conn);
echo "alert(".$er.")";

echo $last_id;
mysqli_close($conn);
?>