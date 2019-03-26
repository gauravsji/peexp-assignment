<?php
	//Start New Or Resume Existing Session
	session_start();
	//Include Database Connection
	include '../../dbconnect/dbconnect.php';
	include '../../php/add/add_activity_log.php';

	//Table Names 
	$tbl_name = "task"; 

	//Store Posted Data To PHP Variable
	$task_name= ucwords(mysqli_real_escape_string($conn,$_POST['ui_task_name']));
	$task_description= mysqli_real_escape_string($conn,$_POST['ui_task_description']);
	$task_assignee= mysqli_real_escape_string($conn,$_POST['ui_assignee_name']);
	$task_priority= mysqli_real_escape_string($conn,$_POST['ui_task_priority']);
	$task_status= mysqli_real_escape_string($conn,$_POST['ui_task_status']);
	$task_remarks= mysqli_real_escape_string($conn,$_POST['ui_task_remarks']);
	$location=mysqli_real_escape_string($conn,$_POST['location']);
	$user_id= mysqli_real_escape_string($conn,$_POST['user_id']);
	
	$date = explode('/', mysqli_real_escape_string($conn,$_POST['ui_task_start_date']));
	$time = mktime(0,0,0,$date[1],$date[0],$date[2]);
	$task_start_date = date( 'Y-m-d', $time );

	$date1 = explode('/', mysqli_real_escape_string($conn,$_POST['ui_task_due_date']));
	$time1 = mktime(0,0,0,$date1[1],$date1[0],$date1[2]);
	$task_due_date = date( 'Y-m-d', $time1 );
	
	//Insert Query
	$query = "INSERT INTO $tbl_name(task_name,task_description,task_assignee,task_start_date,task_due_date,task_priority,task_status,task_remarks,task_module_name,task_module_id,data_entered_by,location,created_date,last_update_date, delete_status) VALUES ('$task_name','$task_description','$task_assignee','$task_start_date','$task_due_date','$task_priority','$task_status','$task_remarks','GENERAL','0','$user_id','$location',CURDATE(),CURDATE(),0)";

	//Execute The Query
	if (mysqli_query($conn, $query)) 		
	{
		$error=1;
	}
	//Get Last Inserted Id of Customer Table and Create an Adhoc Project a Customer
	$last_inserted_id=mysqli_insert_id($conn);
	
	$j = 0; //Variable for indexing uploaded image 
    for ($i = 0; $i < count($_FILES['file']['name']); $i++) 
	{//loop to get individual element from the array
		$target_path = "../../uploads/"; //Declaring Path for uploaded images
        $validextensions = array("jpeg", "jpg", "png","pdf","doc","docx","xlsx","xls","JPEG", "JPG", "PNG","PDF","DOC","DOCX","XLSX","XLS");  //Extensions which are allowed
        $ext = explode('.', basename($_FILES['file']['name'][$i]));//explode file name from dot(.) 
		echo "Ext". $ext."</br>";
        $file_extension = end($ext); //store extensions in the variable
        $filename=md5(uniqid());
		echo "Encrypted Filename: ".$filename."</br>";
		echo "Filename: ".$_FILES['file']['name'][$i]."</br>";
		$target_path = $target_path .  $filename . "." . $ext[count($ext) - 1];//set the target path with a new name of image
        $j = $j + 1;//increment the number of uploaded images according to the files in array       
      
	  if (($_FILES["file"]["size"][$i] < 10000000) && in_array($file_extension, $validextensions)) //Approx 10 MB File size
		{
            if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) 
			{
				$image_name= $filename. "." . $ext[count($ext) - 1];
				echo $filename;
				//Insert Query
				$query3="INSERT INTO `photo` (module_id,module_name,photo_name) VALUES ('$last_inserted_id','task','$image_name')"; 

				//Execute The Query
				if (mysqli_query($conn, $query3)) 
				{
				$error=1;
				}
				echo mysqli_error($conn);
				//if file moved to uploads folder
                echo '<br/><br/><span id="noerror">Image uploaded successfully!.</span><br/><br/>';
				$image_name="";
				$target_path="";
            } 
			else 
			{
				//if file was not moved.
                echo '<br/><br/><span id="error">please try again!.</span><br/><br/>';
            }
        } 
		else 
		{
			//if file size and file type was incorrect.
            echo '<br/><br/><span id="error">***Invalid file Size or Type***</span><br/><br/>';
        }
    }	
	
	if ($error==1) 		
	{
		//On Successful
		fn_add_activity_log("Task",$last_inserted_id,"Task Created",$user_id,$conn);
		header("Location:../../html/add_task_html.php");
	}
	else
	{
		//On Error 
		echo mysqli_error($conn);
		header("Location:../../extra/error.php");
	}
		//Close Mysqli Connection
		mysqli_close($conn);
?>