<?php
	function role_activity_permissions($role,$conn)
	{
    date_default_timezone_set('UTC');
    $tbl_roles = "roles_and_permissions";
    $rolesAndPermissions = "SELECT * FROM $tbl_roles WHERE role_name ='$role'";
		$rolesResults = mysqli_query($conn, $rolesAndPermissions);
		//Count the number of the results from the roles_and_permissions
		$count=mysqli_num_rows($rolesResults);
		$rolesArray = [];
		if($count == 0)
    {
      $date = date('Y-m-d h:i:s A');
      $insertRoleQuery = "INSERT INTO $tbl_roles(role_name,permission_name,created_at,updated_at) VALUES ('$role','customer_panel','$date','$date')";
      $results = mysqli_query($conn, $insertRoleQuery);
  	}
		$selectQuery = "SELECT * FROM $tbl_roles WHERE role_name = '$role'";
		$results = mysqli_query($conn, $selectQuery);
		$resultCount=mysqli_num_rows($results);
		while($row = mysqli_fetch_array($results))
		{
			array_push($rolesArray,$row['permission_name']);
		}
		return $rolesArray;

	}
?>
