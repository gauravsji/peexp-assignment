<?php
  $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
    if(in_array($_FILES["file"]["type"],$allowedFileType)){
      $targetPath = '../../uploads/'.$_FILES['file']['name'];
      move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
      $sheetCount = count($Reader->sheets());
      var_dump($sheetCount);
      for($i=0;$i<$sheetCount;$i++)
      {
        $Reader->ChangeSheet($i);
        foreach ($Reader as $Row)
        {
          $name = "";
          if(isset($Row[0])) {
              $name = mysqli_real_escape_string($conn,$Row[0]);
              echo "name";
          }
          else {
            echo "hello";
          }
        }
      }
    }
    else {
      echo "Invalid type";
    }
    die;

if(isset($_FILES["file"]["type"]))
  echo $_FILES["file"]["type"];
$val = json_encode($_POST,true);
echo $val;



?>
