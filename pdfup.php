<?php
    $currentDirectory = getcwd();
    $uploadDirectory = "/uploads/";

    $errors = [];

    $fileExtensionsAllowed = ['pdf','jpg'];

    $fileName = $_FILES['the_file']['name'];
    $fileSize = $_FILES['the_file']['size'];
    $fileTmpName  = $_FILES['the_file']['tmp_name'];
    $fileType = $_FILES['the_file']['type'];
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

    $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 

    if (isset($_POST['submit'])) {

      if (! in_array($fileExtension,$fileExtensionsAllowed)) {
        $errors[] = "This file extension is not allowed. Please upload a PDF/JPG file";
      }

      if($fileExtensionsAllowed=='pdf'){
        if ($fileSize > 15000000) {
            $errors[] = "File exceeds maximum size (15MB)";
          }
      }
      else{
        if ($fileSize > 2000000) {
            $errors[] = "File exceeds maximum size (15MB)";
          }
      }

      if (empty($errors)) {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        if ($didUpload) {
          echo "The file " . basename($fileName) . " has been uploaded";
        } else {
          echo "An error occurred. Please contact the administrator.";
        }
      } else {
        foreach ($errors as $error) {
          echo $error;
        }
      }

   }
?>