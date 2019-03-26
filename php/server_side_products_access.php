<?php
	/* Database connection start */
	include '../dbconnect/dbconnect.php';

	//Storing  request (ie, get/post) global array to a variable  
	$requestData= $_REQUEST;

	$columns = array( 
	//datatable column index  => database column name
	0 =>'product_id', 
	1 =>'product_name', 
	2 => 'auto_complete_product_name',
	3 => 'product_mrp',
	4 => 'product_set_product_name',
	5 => 'brand_name',
	6 => 'name'
	);

	//Getting total number records without any search
	$sql = "SELECT product_id, product_name,auto_complete_product_name,product_mrp,product_set_product_name,brand_name,product_unbranded,name,product_id FROM product p
			LEFT OUTER JOIN product_set ps ON p.product_set_id=ps.product_set_id
			LEFT OUTER JOIN brand b ON p.brand_id=b.brand_id												
			LEFT OUTER JOIN users u ON u.id =  p.data_entered_by
			WHERE p.delete_status <> 1";

	$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;  //When there is no search parameter then total number rows = total number filtered rows.

	$sql = "SELECT product_id, product_name,auto_complete_product_name,product_mrp,product_set_product_name,brand_name,product_unbranded,name,product_id FROM product p
			LEFT OUTER JOIN product_set ps ON p.product_set_id=ps.product_set_id
			LEFT OUTER JOIN brand b ON p.brand_id=b.brand_id												
			LEFT OUTER JOIN users u ON u.id =  p.data_entered_by
			WHERE p.delete_status <> 1";
	
	if( !empty($requestData['search']['value']) ) 
	{  
		//If there is a search parameter, $requestData['search']['value'] contains search parameter
		$sql.=" AND ( product_name LIKE '".$requestData['search']['value']."%' ";    
		$sql.=" OR auto_complete_product_name LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR product_set_product_name LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR brand_name LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR name LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR product_mrp LIKE '".$requestData['search']['value']."%' )";
	}
	$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
	$totalFiltered = mysqli_num_rows($query); //When there is a search parameter then we have to modify total number filtered rows as per search result. 
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	/* $requestData['order'][0]['column'] contains column index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
	$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");

	$data = array();
	while( $row=mysqli_fetch_array($query) ) 
	{  
		//Preparing an array
		$nestedData=array(); 

		$nestedData[] = $row["product_id"];
		$nestedData[] = $row["product_name"];
		$nestedData[] = $row["auto_complete_product_name"];
		$nestedData[] = $row["product_mrp"];
		$nestedData[] = $row["product_set_product_name"];
		if(($row["product_unbranded"]=="Unbranded"))
		{
			$nestedData[] = "<div class='bg-red badge'>UNBRANDED</div>";
		}
		else
		{
			$nestedData[] = $row["brand_name"];
		}
		$nestedData[] = $row["name"];

		$data[] = $nestedData;
	}
	$json_data = array(
	"draw"            => intval( $requestData['draw'] ),   
	//For every request/draw by clientside, they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
	"recordsTotal"    => intval( $totalData ),  
	//Total number of records
	"recordsFiltered" => intval( $totalFiltered ), 
	//Total number of records after searching, if there is no searching then totalFiltered = totalData
	"data"            => $data   
	//Total data array
	);

	echo json_encode($json_data);  //Send data as JSON format
?>
